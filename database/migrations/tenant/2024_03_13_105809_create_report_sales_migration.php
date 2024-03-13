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
            CREATE OR REPLACE FUNCTION rpt_sales_report(
                local_id INTEGER DEFAULT NULL::INTEGER,
                fecha_desde DATE DEFAULT NULL::DATE,
                fecha_hasta DATE DEFAULT NULL::DATE
            ) RETURNS TABLE (
                date DATE,
                document_type VARCHAR,
                Document_number VARCHAR,
                ruc VARCHAR,
                client_name VARCHAR,
                sale_valor DECIMAL,
                tax DECIMAL,
                total DECIMAL
            ) AS $$
            BEGIN
                RETURN QUERY
                SELECT
                    s.date::DATE,
                    sdt.name AS document_type,
                    sd.document_number AS Document_number,
                    c.document_number AS ruc,
                    c.first_name AS client_name,
                    s.subtotal AS sale_valor,
                    s.total_tax AS tax,
                    s.total_amount AS total
                FROM
                    sales AS s
                LEFT JOIN
                    sale_document AS sd ON sd.id_sales = s.id_sales
                LEFT JOIN
                    sale_document_type sdt ON sdt.document_code = s.document_code
                LEFT JOIN
                    client_sale AS cs ON s.id_sales = cs.id_sales
                LEFT JOIN
                    client AS c ON cs.id_client = c.id_client
                WHERE
                    (fecha_desde IS NULL OR s.date::DATE BETWEEN fecha_desde AND COALESCE(fecha_hasta, CURRENT_DATE))
                    AND (local_id IS NULL OR s.id_local = local_id)
                ORDER BY date DESC;
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
        DB::unprepared('DROP FUNCTION IF EXISTS rpt_sales_report(local_id INTEGER DEFAULT NULL::INTEGER, fecha_desde DATE DEFAULT NULL::DATE, fecha_hasta DATE DEFAULT NULL::DATE);');
    }
};
