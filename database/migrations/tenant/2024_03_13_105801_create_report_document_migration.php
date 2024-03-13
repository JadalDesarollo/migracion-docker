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
            CREATE OR REPLACE FUNCTION rtp_document_report(
                p_client_name VARCHAR DEFAULT NULL::VARCHAR,
                p_document_number VARCHAR DEFAULT NULL:: VARCHAR,
                p_fecha_desde DATE DEFAULT NULL::DATE,
                p_fecha_hasta DATE DEFAULT NULL::DATE,
                p_situation VARCHAR DEFAULT NULL:: VARCHAR
            )
            RETURNS TABLE(
                document_type VARCHAR,
                document_number VARCHAR,
                name_client VARCHAR,
                discount DECIMAL,
                total_amount DECIMAL,
                broadcast_date DATE ,
                situacion VARCHAR
            ) AS
            $$
            BEGIN
                RETURN QUERY
                SELECT
                    sdt.name AS document_type,
                    sdoc.document_number AS document_number,
                    c.first_name AS name_client,
                    s.total_discount AS discount,
                    s.total_amount AS total_amount,
                    sdoc.broadcast_date AS broadcast_date,
                    sdoc.situation AS situation
                FROM
                    sales AS s
                LEFT JOIN
                    client_sale AS cs ON cs.id_sales = s.id_sales
                LEFT JOIN
                    client AS c ON c.id_client = cs.id_client
                INNER JOIN
                    sale_document_type AS sdt ON s.document_code = sdt.document_code
                INNER JOIN
                    sale_document AS sdoc ON sdoc.id_sales = s.id_sales
                WHERE
                    (p_client_name IS NULL OR (c.first_name ILIKE \'%\' || p_client_name || \'%\' OR c.last_name ILIKE \'%\' || p_client_name || \'%\'))
                    AND (p_fecha_desde IS NULL OR sdoc.broadcast_date::DATE >= p_fecha_desde)
                    AND (p_fecha_hasta IS NULL OR sdoc.broadcast_date::DATE <= p_fecha_hasta)
                    AND (p_document_number IS NULL OR sdoc.document_number LIKE \'%\' || p_document_number || \'%\')
                    AND (p_situation IS NULL OR sdoc.situation = p_situation);
            END
            $$
            LANGUAGE PLPGSQL;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS rtp_document_report(p_client_name VARCHAR DEFAULT NULL::VARCHAR, p_document_number VARCHAR DEFAULT NULL:: VARCHAR, p_fecha_desde DATE DEFAULT NULL::DATE, p_fecha_hasta DATE DEFAULT NULL::DATE, p_situation VARCHAR DEFAULT NULL:: VARCHAR);');
    }
};
