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
        // DB::unprepared('
        //     CREATE OR REPLACE VIEW sales_summary_daily AS
        //     SELECT
        //         s.id_local,
        //         s.date::DATE AS sale_date,
        //         sd.id_product,
        //         SUM(sd.quantity) AS quantity,
        //         SUM(sd.product_price) AS total_amount,
        //         p.foreign_name AS product_name
        //     FROM
        //         sales s
        //     JOIN
        //         sale_detail sd ON s.id_sales = sd.id_sales
        //     JOIN
        //         product p ON p.id_product = sd.id_product
        //     WHERE p.group_code = \'00999\'
        //     GROUP BY
        //         sd.id_product,
        //         s.date::DATE,
        //         p.foreign_name,
        //         s.id_local
        //     ORDER BY sale_date ASC;
        // ');

        DB::unprepared('
            CREATE OR REPLACE FUNCTION rpt_list_product_sales_accumulate_by_day(
                p_start_date DATE DEFAULT NULL::DATE,
                p_end_date DATE DEFAULT NULL::DATE,
                p_id_local INTEGER DEFAULT NULL::INTEGER
            ) RETURNS TABLE (
                id_product_v VARCHAR,
                product_name_v VARCHAR
            )AS $$
                BEGIN
                RETURN QUERY
                SELECT
                    DISTINCT
                        id_product::VARCHAR as id_product_v,
                        product_name as product_name_v
                FROM sales_summary_daily sacc
                WHERE (p_start_date IS NULL OR sacc.sale_date::DATE BETWEEN p_start_date AND COALESCE(p_end_date,CURRENT_DATE))
                AND (p_id_local IS NULL OR p_id_local= sacc.id_local);

                END
            $$ LANGUAGE PLPGSQL;
        ');

        DB::unprepared('
            CREATE OR REPLACE FUNCTION rpt_list_sales_accumulate_by_day(
                p_start_date DATE DEFAULT NULL::DATE,
                p_end_date DATE DEFAULT NULL::DATE,
                p_id_local INTEGER DEFAULT NULL::INTEGER
            ) RETURNS TABLE (
                id_local_v VARCHAR,
                sale_date_v DATE,
                id_product_v VARCHAR,
                quantity_v DECIMAL,
                total_amount_v DECIMAL,
                product_name_v VARCHAR
            )AS $$
                BEGIN
                RETURN QUERY
                SELECT
                    id_local::VARCHAR AS id_local_v,
                    sale_date AS sale_date_v,
                    id_product::VARCHAR AS id_product_v,
                    quantity AS quantity_v,
                    total_amount AS total_amount_v,
                    product_name AS product_name_v
                FROM sales_summary_daily sacc
                WHERE (p_start_date IS NULL OR (sacc.sale_date::DATE BETWEEN p_start_date AND COALESCE(p_end_date,CURRENT_DATE)))
                AND (p_id_local IS NULL OR p_id_local= sacc.id_local)
                ORDER BY sacc.sale_date ASC;
                END
            $$ LANGUAGE PLPGSQL;
        ');

        DB::unprepared('
            CREATE OR REPLACE FUNCTION rpt_list_resumen_sales_accumulate_by_day(
                p_start_date DATE DEFAULT NULL::DATE,
                p_end_date DATE DEFAULT NULL::DATE,
                p_id_local INTEGER DEFAULT NULL::INTEGER
            )RETURNS TABLE (
                id_product_v VARCHAR,
                product_name_v VARCHAR,
                average_v DECIMAL,
                galones_v DECIMAL,
                soles_v DECIMAL
            )AS
            $$
                BEGIN
                    RETURN QUERY
                    SELECT
                    sacc.id_product::VARCHAR AS id_product_v,
                    sacc.product_name AS product_name_v,
                    ROUND (AVG(sacc.quantity),2) AS average_v,
                    SUM(sacc.quantity) AS galones_v,
                    SUM(sacc.total_amount) AS soles_v
                    FROM sales_summary_daily sacc
                    WHERE (p_start_date IS NULL OR (sacc.sale_date::DATE BETWEEN p_start_date AND COALESCE(p_end_date,CURRENT_DATE)))
                    AND (p_id_local IS NULL OR (sacc.id_local=p_id_local))
                    GROUP BY sacc.product_name,sacc.id_product;
                END;
            $$ LANGUAGE PLPGSQL;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS rpt_list_product_sales_accumulate_by_day(p_start_date DATE DEFAULT NULL::DATE, p_end_date DATE DEFAULT NULL::DATE, p_id_local INTEGER DEFAULT NULL::INTEGER);');
        DB::unprepared('DROP FUNCTION IF EXISTS rpt_list_sales_accumulate_by_day(p_start_date DATE DEFAULT NULL::DATE, p_end_date DATE DEFAULT NULL::DATE, p_id_local INTEGER DEFAULT NULL::INTEGER);');
        DB::unprepared('DROP FUNCTION IF EXISTS rpt_list_resumen_sales_accumulate_by_day(p_start_date DATE DEFAULT NULL::DATE, p_end_date DATE DEFAULT NULL::DATE, p_id_local INTEGER DEFAULT NULL::INTEGER);');
        DB::unprepared('DROP VIEW IF EXISTS sales_summary_daily;');
    }
};
