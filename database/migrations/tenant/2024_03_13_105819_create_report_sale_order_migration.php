<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE OR REPLACE VIEW view_list_sale_order AS
            SELECT
                s.pos_id AS pos_v,
                so.document_number AS document_number,
                c.first_name AS client_v,
                c.id_client AS id_client_v,
                c.document_number AS document_client_v,
                so.date AS date_v,
                json_agg(
                    json_build_object(
                        \'product\',
                        p.foreign_name,
                        \'quantity\',
                        sd.quantity
                    )
                ) AS sale_detail_v,
                s.total_Amount AS total_v,
                d.first_name AS driver_v,
                v.vehicle_plate AS placa_v
            FROM
                sale_order AS so
                INNER JOIN sale AS s ON s.id_sales = so.id_sales
                INNER JOIN client_sale AS cs ON cs.id_sales = s.id_sales
                INNER JOIN client AS c On c.id_client = cs.id_client
                LEFT JOIN sale_detail AS sd ON sd.id_sales = so.id_sales
                INNER JOIN product AS p ON sd.id_product = p.id_product
                LEFT JOIN driver_sale AS ds ON ds.id_sales = s.id_sales
                LEFT JOIN driver AS d ON d.id_driver = ds.id_driver
                LEFT JOIN vehicle AS v ON v.id_vehicle = ds.id_vehicle
            GROUP BY
                so.document_number,
                so.date,
                s.total_Amount,
                d.first_name,
                v.vehicle_plate,
                s.pos_id,
                c.first_name,
                c.document_number,
                c.id_client
            ORDER BY
                so.date ASC;
        ');

        DB::unprepared('
            CREATE OR REPLACE FUNCTION list_client_order_sale(
                start_date DATE DEFAULT NULL::DATE,
                end_date DATE DEFAULT NULL::DATE
            )
            RETURNS TABLE (
                id_client INTEGER,
                client VARCHAR(255),
                document_client VARCHAR(255)
            )AS
            $$
                BEGIN
                    RETURN QUERY
                    SELECT
                        DISTINCT
                        id_client_v AS id_client,
                        client_v AS client,
                        document_client_v AS document_client
                    FROM view_list_sale_order
                    WHERE start_date IS NULL OR date_v BETWEEN start_date AND end_date;

                END;
            $$ LANGUAGE PLPGSQL;
        ');

        DB::unprepared('
            CREATE OR REPLACE FUNCTION list_detail_order_sale(
                p_start_date DATE DEFAULT NULL::DATE,
                p_end_date DATE DEFAULT NULL::DATE,
                p_id_client INTEGER DEFAULT NULL::INTEGER
            )
            RETURNS TABLE (
                id_client INTEGER,
                client VARCHAR(255),
                sales_per_client JSON
            ) AS $$
            BEGIN
                RETURN QUERY
                SELECT
                    fecha.id_cliente AS id_client,
                    c.first_name AS client,
                    json_agg(
                        json_build_object(
                            \'date\', fecha.fecha,
                            \'sales\', fecha.sales_per_date
                        ) ORDER BY fecha.fecha DESC
                    ) AS sales_per_client
                FROM
                    (SELECT
                        s.id_client_v AS id_cliente,
                        s.fecha AS fecha,
                        json_agg(
                            json_build_object(
                                \'sale_document\', s.document_number,
                                \'sale_detail\', s.sale_detail_v,
                                \'total_sale\', s.total_v,
                                \'driver\', s.driver_v,
                                \'vehicle_plate\', s.placa_v,
                                \'date\', s.fecha_hora
                            )
                        ) AS sales_per_date
                    FROM
                        (SELECT
                            s.id_client_v,
                            s.date_v::DATE AS fecha,
                            s.date_v AS fecha_hora,
                            s.document_number,
                            s.sale_detail_v,
                            s.total_v,
                            s.driver_v,
                            s.placa_v
                        FROM
                            view_list_sale_order AS s) AS s
                    GROUP BY
                        s.id_client_v,
                        s.fecha
                    ORDER BY
                        s.fecha DESC
                    ) AS fecha
                INNER JOIN
                    client AS c ON fecha.id_cliente = c.id_client
                WHERE (p_start_date IS NULL OR fecha.fecha BETWEEN p_start_date AND p_end_date)
                    AND (p_id_client IS NULL OR fecha.id_cliente = p_id_client)
                GROUP BY
                    fecha.id_cliente,
                    c.first_name
                ORDER BY
                    fecha.id_cliente;
            END;
            $$ LANGUAGE PLPGSQL;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS list_client_order_sale(start_date DATE DEFAULT NULL::DATE, end_date DATE DEFAULT NULL::DATE);');
        DB::unprepared('DROP FUNCTION IF EXISTS list_detail_order_sale(p_start_date DATE DEFAULT NULL::DATE, p_end_date DATE DEFAULT NULL::DATE, p_id_client INTEGER DEFAULT NULL::INTEGER);');
        DB::unprepared('DROP VIEW IF EXISTS view_list_sale_order;');
    }
};
