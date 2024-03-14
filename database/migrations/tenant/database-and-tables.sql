-- Database generated with pgModeler (PostgreSQL Database Modeler).
-- pgModeler version: 1.1.0-beta1
-- PostgreSQL version: 16.0
-- Project Site: pgmodeler.io
-- Model Author: Jadal Global

-- Database creation must be performed outside a multi lined SQL file. 
-- These commands were put in this file only as a convenience.
-- 
-- -- object: "DBJS_GLOBAL" | type: DATABASE --
-- -- DROP DATABASE IF EXISTS "DBJS_GLOBAL";
-- CREATE DATABASE "DBJS_GLOBAL";
-- -- ddl-end --
-- 

-- object: public.person | type: TABLE --
-- DROP TABLE IF EXISTS public.person CASCADE;

-- Prepended SQL commands --
DROP SCHEMA public CASCADE;
CREATE SCHEMA public;
-- ddl-end --

CREATE TABLE public.person (
	id_person serial NOT NULL,
	first_name varchar(255),
	last_name varchar(255),
	document_number varchar(45),
	telphone_number varchar(45),
	email varchar(45),
	state bit,
	date_of_birth date,
	creation_date timestamp,
	id_document_type integer,
	CONSTRAINT id PRIMARY KEY (id_person)
);
-- ddl-end --
ALTER TABLE public.person OWNER TO postgres;
-- ddl-end --

-- object: public.client | type: TABLE --
-- DROP TABLE IF EXISTS public.client CASCADE;
CREATE TABLE public.client (
	id_client serial NOT NULL,
	client_code varchar(45),
	id_type_client integer,
-- 	id_person integer NOT NULL,
-- 	first_name varchar(255),
-- 	last_name varchar(255),
-- 	document_number varchar(45),
-- 	telphone_number varchar(45),
-- 	email varchar(45),
-- 	state bit,
-- 	date_of_birth date,
-- 	creation_date timestamp,
-- 	id_document_type integer,
	CONSTRAINT "CLIENT_pk" PRIMARY KEY (id_client)
)
 INHERITS(public.person);
-- ddl-end --
ALTER TABLE public.client OWNER TO postgres;
-- ddl-end --
ALTER TABLE public.client ENABLE ROW LEVEL SECURITY;
-- ddl-end --

-- object: public.supplier | type: TABLE --
-- DROP TABLE IF EXISTS public.supplier CASCADE;
CREATE TABLE public.supplier (
	id_supplier serial NOT NULL,
	CONSTRAINT "SUPPLIER_pk" PRIMARY KEY (id_supplier)
);
-- ddl-end --
ALTER TABLE public.supplier OWNER TO postgres;
-- ddl-end --

-- object: public.user_view | type: TABLE --
-- DROP TABLE IF EXISTS public.user_view CASCADE;
CREATE TABLE public.user_view (
	id_user_view serial NOT NULL,
	username varchar,
	CONSTRAINT user_view_pk PRIMARY KEY (id_user_view)
);
-- ddl-end --
ALTER TABLE public.user_view OWNER TO postgres;
-- ddl-end --

-- object: public.employee | type: TABLE --
-- DROP TABLE IF EXISTS public.employee CASCADE;
CREATE TABLE public.employee (
	id_employee serial NOT NULL,
	employee_code varchar(45),
	id_user_view integer,
-- 	id_person integer NOT NULL,
-- 	first_name varchar(255),
-- 	last_name varchar(255),
-- 	document_number varchar(45),
-- 	telphone_number varchar(45),
-- 	email varchar(45),
-- 	state bit,
-- 	date_of_birth date,
-- 	creation_date timestamp,
-- 	id_document_type integer,
	CONSTRAINT "EMPLOYEE_pk" PRIMARY KEY (id_employee)
)
 INHERITS(public.person);
-- ddl-end --
ALTER TABLE public.employee OWNER TO postgres;
-- ddl-end --

-- object: public.driver | type: TABLE --
-- DROP TABLE IF EXISTS public.driver CASCADE;
CREATE TABLE public.driver (
	id_driver serial NOT NULL,
	code_driver varchar,
	license varchar(45),
-- 	id_person integer NOT NULL,
-- 	first_name varchar(255),
-- 	last_name varchar(255),
-- 	document_number varchar(45),
-- 	telphone_number varchar(45),
-- 	email varchar(45),
-- 	state bit,
-- 	date_of_birth date,
-- 	creation_date timestamp,
-- 	id_document_type integer,
	CONSTRAINT "DRIVER_pk" PRIMARY KEY (id_driver)
)
 INHERITS(public.person);
-- ddl-end --
ALTER TABLE public.driver OWNER TO postgres;
-- ddl-end --

INSERT INTO public.driver (id_driver, license, id_person, first_name, last_name, document_number, telphone_number, email, state, date_of_birth, creation_date, id_document_type) VALUES (DEFAULT, E'0', DEFAULT, E'CHOFER VARIOS', DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT);
-- ddl-end --

-- object: public.product | type: TABLE --
-- DROP TABLE IF EXISTS public.product CASCADE;
CREATE TABLE public.product (
	id_product serial NOT NULL,
	description varchar(255),
	foreign_name varchar,
	product_code varchar(45),
	state bit,
	"updatedAt" timestamp,
	group_code varchar(45),
	CONSTRAINT "PRODUCT_pk" PRIMARY KEY (id_product)
);
-- ddl-end --
ALTER TABLE public.product OWNER TO postgres;
-- ddl-end --

-- object: public.discount | type: TABLE --
-- DROP TABLE IF EXISTS public.discount CASCADE;
CREATE TABLE public.discount (
	id_discount serial NOT NULL,
	percentage varchar(45),
	amount decimal,
	description varchar,
	CONSTRAINT "DISCOUNT_pk" PRIMARY KEY (id_discount)
);
-- ddl-end --
ALTER TABLE public.discount OWNER TO postgres;
-- ddl-end --

-- object: public.vehicle | type: TABLE --
-- DROP TABLE IF EXISTS public.vehicle CASCADE;
CREATE TABLE public.vehicle (
	id_vehicle serial NOT NULL,
	vehicle_plate varchar(45),
	vehicle_code varchar(45),
	CONSTRAINT "VEHICLE_pk" PRIMARY KEY (id_vehicle)
);
-- ddl-end --
ALTER TABLE public.vehicle OWNER TO postgres;
-- ddl-end --

-- object: public.currency | type: TABLE --
-- DROP TABLE IF EXISTS public.currency CASCADE;
CREATE TABLE public.currency (
	id_currency serial NOT NULL,
	currency_code varchar(255),
	currency_type varchar(255),
	simple_description varchar(255),
	complete_description varchar(250),
	CONSTRAINT "CURRENCY_pk" PRIMARY KEY (id_currency)
);
-- ddl-end --
ALTER TABLE public.currency OWNER TO postgres;
-- ddl-end --

INSERT INTO public.currency (currency_code, currency_type, simple_description, complete_description) VALUES (E'D', E'DOLAR', E'USD', E'DOLARES AMERICANOS');
-- ddl-end --
INSERT INTO public.currency (currency_code, currency_type, simple_description, complete_description) VALUES (E'S', E'SOLES', E'SOL', E'SOLES');
-- ddl-end --

-- object: public.document_type | type: TABLE --
-- DROP TABLE IF EXISTS public.document_type CASCADE;
CREATE TABLE public.document_type (
	id_document_type serial NOT NULL,
	name varchar(45),
	description varchar(255),
	CONSTRAINT "DOCUMENT_TYPE_pk" PRIMARY KEY (id_document_type)
);
-- ddl-end --
ALTER TABLE public.document_type OWNER TO postgres;
-- ddl-end --

INSERT INTO public.document_type (id_document_type, name, description) VALUES (DEFAULT, E'tipo 2 ', E'descripcion test');
-- ddl-end --

-- object: public.store_house | type: TABLE --
-- DROP TABLE IF EXISTS public.store_house CASCADE;
CREATE TABLE public.store_house (
	id_store_house serial NOT NULL,
	CONSTRAINT "STORE_HOUSE_pk" PRIMARY KEY (id_store_house)
);
-- ddl-end --
ALTER TABLE public.store_house OWNER TO postgres;
-- ddl-end --

-- object: public.local | type: TABLE --
-- DROP TABLE IF EXISTS public.local CASCADE;
CREATE TABLE public.local (
	id_local serial NOT NULL,
	name varchar,
	local_code varchar(45),
	telphone_number varchar(45),
	address varchar(250),
	CONSTRAINT "LOCAL_pk" PRIMARY KEY (id_local)
);
-- ddl-end --
ALTER TABLE public.local OWNER TO postgres;
-- ddl-end --

INSERT INTO public.local (id_local, name, local_code, telphone_number, address) VALUES (DEFAULT, E'BACKOFFICE_DENNIS..', E'001', E'5742752', E'Av test ');
-- ddl-end --

-- object: public.transaction | type: TABLE --
-- DROP TABLE IF EXISTS public.transaction CASCADE;
CREATE TABLE public.transaction (
	id_transaction serial NOT NULL,
	date timestamp,
	id_user_view integer,
	id_employee integer,
	description varchar,
	CONSTRAINT transaction_pk PRIMARY KEY (id_transaction)
);
-- ddl-end --
ALTER TABLE public.transaction OWNER TO postgres;
-- ddl-end --

-- object: public.sale | type: TABLE --
-- DROP TABLE IF EXISTS public.sale CASCADE;
CREATE TABLE public.sale (
	id_sales serial NOT NULL,
	pos_id varchar(45),
	state varchar,
	total_amount decimal,
	subtotal decimal,
	total_tax decimal,
	total_discount decimal,
	id_local integer,
	document_code varchar,
-- 	id_transaction integer NOT NULL,
-- 	date timestamp,
-- 	description varchar,
-- 	id_user_view integer,
-- 	id_employee integer,
	CONSTRAINT "SALES_pk" PRIMARY KEY (id_sales)
)
 INHERITS(public.transaction);
-- ddl-end --
ALTER TABLE public.sale OWNER TO postgres;
-- ddl-end --

-- object: public.payment_method | type: TABLE --
-- DROP TABLE IF EXISTS public.payment_method CASCADE;
CREATE TABLE public.payment_method (
	id_payment_method serial NOT NULL,
	name varchar(255),
	description varchar(255),
	payment_code varchar,
	CONSTRAINT "PAYMENT_METHOD_pk" PRIMARY KEY (id_payment_method)
);
-- ddl-end --
ALTER TABLE public.payment_method OWNER TO postgres;
-- ddl-end --

INSERT INTO public.payment_method (id_payment_method, name, description, payment_code) VALUES (DEFAULT, E'EFECTIVO', DEFAULT, E'00001');
-- ddl-end --
INSERT INTO public.payment_method (id_payment_method, name, description, payment_code) VALUES (DEFAULT, E'TARJETA DE CREDITO', DEFAULT, E'00002');
-- ddl-end --
INSERT INTO public.payment_method (id_payment_method, name, description, payment_code) VALUES (DEFAULT, E'CHEQUE', DEFAULT, E'00003');
-- ddl-end --
INSERT INTO public.payment_method (id_payment_method, name, description, payment_code) VALUES (DEFAULT, E'CREDITO', DEFAULT, E'00004');
-- ddl-end --
INSERT INTO public.payment_method (id_payment_method, name, description, payment_code) VALUES (DEFAULT, E'NOTA DE CREDITO', DEFAULT, E'00006');
-- ddl-end --
INSERT INTO public.payment_method (id_payment_method, name, description, payment_code) VALUES (DEFAULT, E'TRANSF. BANCARIA', DEFAULT, E'00007');
-- ddl-end --
INSERT INTO public.payment_method (id_payment_method, name, description, payment_code) VALUES (DEFAULT, E'''NOTA DE CREDITO''', DEFAULT, E'888');
-- ddl-end --
INSERT INTO public.payment_method (id_payment_method, name, description, payment_code) VALUES (DEFAULT, E'C. DE RETENCION', DEFAULT, E'99977');
-- ddl-end --
INSERT INTO public.payment_method (id_payment_method, name, description, payment_code) VALUES (DEFAULT, E'DEP. BANC.TERCEROS', DEFAULT, E'99981');
-- ddl-end --
INSERT INTO public.payment_method (id_payment_method, name, description, payment_code) VALUES (DEFAULT, E'O.COMPRA', DEFAULT, E'99999');
-- ddl-end --

-- object: public.sale_document | type: TABLE --
-- DROP TABLE IF EXISTS public.sale_document CASCADE;
CREATE TABLE public.sale_document (
	id_sale_document serial NOT NULL,
	id_sales integer,
	date timestamp,
	document_number varchar,
	broadcast_date date,
	situation varchar(255),
	CONSTRAINT sale_document_pk PRIMARY KEY (id_sale_document)
);
-- ddl-end --
ALTER TABLE public.sale_document OWNER TO postgres;
-- ddl-end --

-- object: public.sale_detail | type: TABLE --
-- DROP TABLE IF EXISTS public.sale_detail CASCADE;
CREATE TABLE public.sale_detail (
	id_sale_detail serial NOT NULL,
	quantity decimal,
	id_product integer,
	id_sales integer,
	product_price decimal,
	tax_detail jsonb,
	CONSTRAINT "SALE_DETAIL_pk" PRIMARY KEY (id_sale_detail)
);
-- ddl-end --
ALTER TABLE public.sale_detail OWNER TO postgres;
-- ddl-end --

-- object: public.sale_order | type: TABLE --
-- DROP TABLE IF EXISTS public.sale_order CASCADE;
CREATE TABLE public.sale_order (
	id_sale_order serial NOT NULL,
	observations varchar,
-- 	id_sale_document integer NOT NULL,
-- 	date timestamp,
-- 	document_number varchar,
-- 	broadcast_date date,
-- 	situation varchar(255),
-- 	id_sales integer,
	CONSTRAINT pushaser_order_pk PRIMARY KEY (id_sale_order)
)
 INHERITS(public.sale_document);
-- ddl-end --
ALTER TABLE public.sale_order OWNER TO postgres;
-- ddl-end --

-- object: public.sale_boleta | type: TABLE --
-- DROP TABLE IF EXISTS public.sale_boleta CASCADE;
CREATE TABLE public.sale_boleta (
	id_sale_boleta serial NOT NULL,
	description varchar(255),
-- 	id_sale_document integer NOT NULL,
-- 	date timestamp,
-- 	document_number varchar,
-- 	broadcast_date date,
-- 	situation varchar(255),
-- 	id_sales integer,
	CONSTRAINT sale_boleta_pk PRIMARY KEY (id_sale_boleta)
)
 INHERITS(public.sale_document);
-- ddl-end --
ALTER TABLE public.sale_boleta OWNER TO postgres;
-- ddl-end --

-- object: public.driver_sale | type: TABLE --
-- DROP TABLE IF EXISTS public.driver_sale CASCADE;
CREATE TABLE public.driver_sale (
	id_driver_sale serial NOT NULL,
	id_sales integer,
	id_driver integer,
	id_vehicle integer,
	CONSTRAINT driver_sale_pk PRIMARY KEY (id_driver_sale)
);
-- ddl-end --
ALTER TABLE public.driver_sale OWNER TO postgres;
-- ddl-end --

-- object: public.payment | type: TABLE --
-- DROP TABLE IF EXISTS public.payment CASCADE;
CREATE TABLE public.payment (
	id_payment serial NOT NULL,
	date timestamp,
	id_sales integer,
	id_payment_method integer,
	state bit,
	description varchar,
	id_currency integer,
	amount decimal,
	CONSTRAINT payement_pk PRIMARY KEY (id_payment)
);
-- ddl-end --
ALTER TABLE public.payment OWNER TO postgres;
-- ddl-end --

-- object: public.address | type: TABLE --
-- DROP TABLE IF EXISTS public.address CASCADE;
CREATE TABLE public.address (
	id_address serial NOT NULL,
	address varchar(255),
	CONSTRAINT address_pk PRIMARY KEY (id_address)
);
-- ddl-end --
ALTER TABLE public.address OWNER TO postgres;
-- ddl-end --

-- object: public.person_address | type: TABLE --
-- DROP TABLE IF EXISTS public.person_address CASCADE;
CREATE TABLE public.person_address (
);
-- ddl-end --

-- object: id_person_address | type: COLUMN --
-- ALTER TABLE public.person_address DROP COLUMN IF EXISTS id_person_address CASCADE;
ALTER TABLE public.person_address ADD COLUMN id_person_address serial NOT NULL;
-- ddl-end --


-- object: id_address | type: COLUMN --
-- ALTER TABLE public.person_address DROP COLUMN IF EXISTS id_address CASCADE;
ALTER TABLE public.person_address ADD COLUMN id_address integer;
-- ddl-end --


-- object: id_person | type: COLUMN --
-- ALTER TABLE public.person_address DROP COLUMN IF EXISTS id_person CASCADE;
ALTER TABLE public.person_address ADD COLUMN id_person integer;
-- ddl-end --



-- object: person_address_pk | type: CONSTRAINT --
-- ALTER TABLE public.person_address DROP CONSTRAINT IF EXISTS person_address_pk CASCADE;
ALTER TABLE public.person_address ADD CONSTRAINT person_address_pk PRIMARY KEY (id_person_address);
-- ddl-end --

ALTER TABLE public.person_address OWNER TO postgres;
-- ddl-end --

-- object: public.sale_detail_discount | type: TABLE --
-- DROP TABLE IF EXISTS public.sale_detail_discount CASCADE;
CREATE TABLE public.sale_detail_discount (
	id_sale_detail_discount integer NOT NULL,
	id_sale_detail integer,
	id_discount integer,
	CONSTRAINT sale_detail_discount_pk PRIMARY KEY (id_sale_detail_discount)
);
-- ddl-end --
ALTER TABLE public.sale_detail_discount OWNER TO postgres;
-- ddl-end --

-- object: public.driver_vehicle | type: TABLE --
-- DROP TABLE IF EXISTS public.driver_vehicle CASCADE;
CREATE TABLE public.driver_vehicle (
	id_driver_vehicle serial NOT NULL,
	id_vehicle integer,
	id_driver integer,
	CONSTRAINT id_driver_vehicle_pk PRIMARY KEY (id_driver_vehicle)
);
-- ddl-end --
ALTER TABLE public.driver_vehicle OWNER TO postgres;
-- ddl-end --

-- object: public.sale_factura | type: TABLE --
-- DROP TABLE IF EXISTS public.sale_factura CASCADE;
CREATE TABLE public.sale_factura (
	id_sale_factura serial NOT NULL,
	expiration_date date,
	id_emisor varchar(45),
	id_receptor varchar(45),
	payment_conditions varchar(250),
	observations varchar(255),
-- 	id_sale_document integer NOT NULL,
-- 	date timestamp,
-- 	document_number varchar,
-- 	broadcast_date date,
-- 	situation varchar(255),
-- 	id_sales integer,
	CONSTRAINT sale_factura_pk PRIMARY KEY (id_sale_factura)
)
 INHERITS(public.sale_document);
-- ddl-end --
ALTER TABLE public.sale_factura OWNER TO postgres;
-- ddl-end --

-- object: public.client_sale | type: TABLE --
-- DROP TABLE IF EXISTS public.client_sale CASCADE;
CREATE TABLE public.client_sale (
	id_client_sale serial NOT NULL,
	id_sales integer,
	id_client integer,
	CONSTRAINT client_sale_pk PRIMARY KEY (id_client_sale)
);
-- ddl-end --
ALTER TABLE public.client_sale OWNER TO postgres;
-- ddl-end --

-- object: public.proforma | type: TABLE --
-- DROP TABLE IF EXISTS public.proforma CASCADE;
CREATE TABLE public.proforma (
	id_proforma serial NOT NULL,
	broadcast_date date,
	id_currency integer,
	id_local integer,
-- 	id_transaction integer NOT NULL,
-- 	date timestamp,
-- 	description varchar,
-- 	id_user_view integer,
-- 	id_employee integer,
	CONSTRAINT proforma_pk PRIMARY KEY (id_proforma)
)
 INHERITS(public.transaction);
-- ddl-end --
ALTER TABLE public.proforma OWNER TO postgres;
-- ddl-end --

-- object: public.order_v | type: TABLE --
-- DROP TABLE IF EXISTS public.order_v CASCADE;
CREATE TABLE public.order_v (
	id_order serial NOT NULL,
	id_proforma integer,
-- 	id_transaction integer NOT NULL,
-- 	date timestamp,
-- 	description varchar,
-- 	id_user_view integer,
-- 	id_employee integer,
	CONSTRAINT order_pk PRIMARY KEY (id_order)
)
 INHERITS(public.transaction);
-- ddl-end --
ALTER TABLE public.order_v OWNER TO postgres;
-- ddl-end --

-- object: currency_fk | type: CONSTRAINT --
-- ALTER TABLE public.proforma DROP CONSTRAINT IF EXISTS currency_fk CASCADE;
ALTER TABLE public.proforma ADD CONSTRAINT currency_fk FOREIGN KEY (id_currency)
REFERENCES public.currency (id_currency) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: local_fk | type: CONSTRAINT --
-- ALTER TABLE public.proforma DROP CONSTRAINT IF EXISTS local_fk CASCADE;
ALTER TABLE public.proforma ADD CONSTRAINT local_fk FOREIGN KEY (id_local)
REFERENCES public.local (id_local) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: public.tax_type | type: TABLE --
-- DROP TABLE IF EXISTS public.tax_type CASCADE;
CREATE TABLE public.tax_type (
	id_type_tax serial NOT NULL,
	CONSTRAINT tax_type_pk PRIMARY KEY (id_type_tax)
);
-- ddl-end --
ALTER TABLE public.tax_type OWNER TO postgres;
-- ddl-end --

-- object: public.tax_type_product | type: TABLE --
-- DROP TABLE IF EXISTS public.tax_type_product CASCADE;
CREATE TABLE public.tax_type_product (
	id_tax_type_product serial NOT NULL,
	id_type_tax integer,
	id_product integer,
	CONSTRAINT tax_type_product_pk PRIMARY KEY (id_tax_type_product)
);
-- ddl-end --
ALTER TABLE public.tax_type_product OWNER TO postgres;
-- ddl-end --

-- object: tax_type_fk | type: CONSTRAINT --
-- ALTER TABLE public.tax_type_product DROP CONSTRAINT IF EXISTS tax_type_fk CASCADE;
ALTER TABLE public.tax_type_product ADD CONSTRAINT tax_type_fk FOREIGN KEY (id_type_tax)
REFERENCES public.tax_type (id_type_tax) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: product_fk | type: CONSTRAINT --
-- ALTER TABLE public.tax_type_product DROP CONSTRAINT IF EXISTS product_fk CASCADE;
ALTER TABLE public.tax_type_product ADD CONSTRAINT product_fk FOREIGN KEY (id_product)
REFERENCES public.product (id_product) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: product_fk | type: CONSTRAINT --
-- ALTER TABLE public.sale_detail DROP CONSTRAINT IF EXISTS product_fk CASCADE;
ALTER TABLE public.sale_detail ADD CONSTRAINT product_fk FOREIGN KEY (id_product)
REFERENCES public.product (id_product) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: sale_fk | type: CONSTRAINT --
-- ALTER TABLE public.sale_detail DROP CONSTRAINT IF EXISTS sale_fk CASCADE;
ALTER TABLE public.sale_detail ADD CONSTRAINT sale_fk FOREIGN KEY (id_sales)
REFERENCES public.sale (id_sales) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: sale_detail_fk | type: CONSTRAINT --
-- ALTER TABLE public.sale_detail_discount DROP CONSTRAINT IF EXISTS sale_detail_fk CASCADE;
ALTER TABLE public.sale_detail_discount ADD CONSTRAINT sale_detail_fk FOREIGN KEY (id_sale_detail)
REFERENCES public.sale_detail (id_sale_detail) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: discount_fk | type: CONSTRAINT --
-- ALTER TABLE public.sale_detail_discount DROP CONSTRAINT IF EXISTS discount_fk CASCADE;
ALTER TABLE public.sale_detail_discount ADD CONSTRAINT discount_fk FOREIGN KEY (id_discount)
REFERENCES public.discount (id_discount) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: sale_fk | type: CONSTRAINT --
-- ALTER TABLE public.driver_sale DROP CONSTRAINT IF EXISTS sale_fk CASCADE;
ALTER TABLE public.driver_sale ADD CONSTRAINT sale_fk FOREIGN KEY (id_sales)
REFERENCES public.sale (id_sales) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: public.order_sale_document | type: TABLE --
-- DROP TABLE IF EXISTS public.order_sale_document CASCADE;
CREATE TABLE public.order_sale_document (
	id_order_sale_document serial NOT NULL,
	id_order integer,
	id_sale_document integer,
	CONSTRAINT order_sale_document_pk PRIMARY KEY (id_order_sale_document)
);
-- ddl-end --
ALTER TABLE public.order_sale_document OWNER TO postgres;
-- ddl-end --

-- object: user_view_fk | type: CONSTRAINT --
-- ALTER TABLE public.transaction DROP CONSTRAINT IF EXISTS user_view_fk CASCADE;
ALTER TABLE public.transaction ADD CONSTRAINT user_view_fk FOREIGN KEY (id_user_view)
REFERENCES public.user_view (id_user_view) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: employee_fk | type: CONSTRAINT --
-- ALTER TABLE public.transaction DROP CONSTRAINT IF EXISTS employee_fk CASCADE;
ALTER TABLE public.transaction ADD CONSTRAINT employee_fk FOREIGN KEY (id_employee)
REFERENCES public.employee (id_employee) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: order_v_fk | type: CONSTRAINT --
-- ALTER TABLE public.order_sale_document DROP CONSTRAINT IF EXISTS order_v_fk CASCADE;
ALTER TABLE public.order_sale_document ADD CONSTRAINT order_v_fk FOREIGN KEY (id_order)
REFERENCES public.order_v (id_order) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: order_sale_document_uq | type: CONSTRAINT --
-- ALTER TABLE public.order_sale_document DROP CONSTRAINT IF EXISTS order_sale_document_uq CASCADE;
ALTER TABLE public.order_sale_document ADD CONSTRAINT order_sale_document_uq UNIQUE (id_order);
-- ddl-end --

-- object: sale_fk | type: CONSTRAINT --
-- ALTER TABLE public.sale_document DROP CONSTRAINT IF EXISTS sale_fk CASCADE;
ALTER TABLE public.sale_document ADD CONSTRAINT sale_fk FOREIGN KEY (id_sales)
REFERENCES public.sale (id_sales) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: sale_document_uq | type: CONSTRAINT --
-- ALTER TABLE public.sale_document DROP CONSTRAINT IF EXISTS sale_document_uq CASCADE;
ALTER TABLE public.sale_document ADD CONSTRAINT sale_document_uq UNIQUE (id_sales);
-- ddl-end --

-- object: user_view_fk | type: CONSTRAINT --
-- ALTER TABLE public.employee DROP CONSTRAINT IF EXISTS user_view_fk CASCADE;
ALTER TABLE public.employee ADD CONSTRAINT user_view_fk FOREIGN KEY (id_user_view)
REFERENCES public.user_view (id_user_view) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: employee_uq | type: CONSTRAINT --
-- ALTER TABLE public.employee DROP CONSTRAINT IF EXISTS employee_uq CASCADE;
ALTER TABLE public.employee ADD CONSTRAINT employee_uq UNIQUE (id_user_view);
-- ddl-end --

-- object: sale_fk | type: CONSTRAINT --
-- ALTER TABLE public.payment DROP CONSTRAINT IF EXISTS sale_fk CASCADE;
ALTER TABLE public.payment ADD CONSTRAINT sale_fk FOREIGN KEY (id_sales)
REFERENCES public.sale (id_sales) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: payment_uq | type: CONSTRAINT --
-- ALTER TABLE public.payment DROP CONSTRAINT IF EXISTS payment_uq CASCADE;
ALTER TABLE public.payment ADD CONSTRAINT payment_uq UNIQUE (id_sales);
-- ddl-end --

-- object: proforma_fk | type: CONSTRAINT --
-- ALTER TABLE public.order_v DROP CONSTRAINT IF EXISTS proforma_fk CASCADE;
ALTER TABLE public.order_v ADD CONSTRAINT proforma_fk FOREIGN KEY (id_proforma)
REFERENCES public.proforma (id_proforma) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: order_v_uq | type: CONSTRAINT --
-- ALTER TABLE public.order_v DROP CONSTRAINT IF EXISTS order_v_uq CASCADE;
ALTER TABLE public.order_v ADD CONSTRAINT order_v_uq UNIQUE (id_proforma);
-- ddl-end --

-- object: vehicle_fk | type: CONSTRAINT --
-- ALTER TABLE public.driver_vehicle DROP CONSTRAINT IF EXISTS vehicle_fk CASCADE;
ALTER TABLE public.driver_vehicle ADD CONSTRAINT vehicle_fk FOREIGN KEY (id_vehicle)
REFERENCES public.vehicle (id_vehicle) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: driver_fk | type: CONSTRAINT --
-- ALTER TABLE public.driver_vehicle DROP CONSTRAINT IF EXISTS driver_fk CASCADE;
ALTER TABLE public.driver_vehicle ADD CONSTRAINT driver_fk FOREIGN KEY (id_driver)
REFERENCES public.driver (id_driver) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: sale_fk | type: CONSTRAINT --
-- ALTER TABLE public.client_sale DROP CONSTRAINT IF EXISTS sale_fk CASCADE;
ALTER TABLE public.client_sale ADD CONSTRAINT sale_fk FOREIGN KEY (id_sales)
REFERENCES public.sale (id_sales) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: client_sale_uq | type: CONSTRAINT --
-- ALTER TABLE public.client_sale DROP CONSTRAINT IF EXISTS client_sale_uq CASCADE;
ALTER TABLE public.client_sale ADD CONSTRAINT client_sale_uq UNIQUE (id_sales);
-- ddl-end --

-- object: public.product_price | type: TABLE --
-- DROP TABLE IF EXISTS public.product_price CASCADE;
CREATE TABLE public.product_price (
	id_product_price serial NOT NULL,
	price decimal,
	id_product integer,
	id_currency integer,
	id_list_price integer,
	CONSTRAINT price_pk PRIMARY KEY (id_product_price)
);
-- ddl-end --
ALTER TABLE public.product_price OWNER TO postgres;
-- ddl-end --

-- object: product_fk | type: CONSTRAINT --
-- ALTER TABLE public.product_price DROP CONSTRAINT IF EXISTS product_fk CASCADE;
ALTER TABLE public.product_price ADD CONSTRAINT product_fk FOREIGN KEY (id_product)
REFERENCES public.product (id_product) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: product_price_uq | type: CONSTRAINT --
-- ALTER TABLE public.product_price DROP CONSTRAINT IF EXISTS product_price_uq CASCADE;
ALTER TABLE public.product_price ADD CONSTRAINT product_price_uq UNIQUE (id_product);
-- ddl-end --

-- object: public.client_price_product | type: TABLE --
-- DROP TABLE IF EXISTS public.client_price_product CASCADE;
CREATE TABLE public.client_price_product (
	id_client_price_product serial NOT NULL,
	price decimal,
	id_client integer,
	id_product integer,
	id_currency integer,
	CONSTRAINT client_price_product_pk PRIMARY KEY (id_client_price_product)
);
-- ddl-end --
ALTER TABLE public.client_price_product OWNER TO postgres;
-- ddl-end --

-- object: product_fk | type: CONSTRAINT --
-- ALTER TABLE public.client_price_product DROP CONSTRAINT IF EXISTS product_fk CASCADE;
ALTER TABLE public.client_price_product ADD CONSTRAINT product_fk FOREIGN KEY (id_product)
REFERENCES public.product (id_product) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: client_fk | type: CONSTRAINT --
-- ALTER TABLE public.client_price_product DROP CONSTRAINT IF EXISTS client_fk CASCADE;
ALTER TABLE public.client_price_product ADD CONSTRAINT client_fk FOREIGN KEY (id_client)
REFERENCES public.client (id_client) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: public.type_client | type: TABLE --
-- DROP TABLE IF EXISTS public.type_client CASCADE;
CREATE TABLE public.type_client (
	id_type_client serial NOT NULL,
	name varchar,
	description varchar,
	CONSTRAINT type_client_pk PRIMARY KEY (id_type_client)
);
-- ddl-end --
ALTER TABLE public.type_client OWNER TO postgres;
-- ddl-end --

INSERT INTO public.type_client (id_type_client, name, description) VALUES (DEFAULT, E'type 1 ', E'descripcion tipo test');
-- ddl-end --

-- object: public.price_list | type: TABLE --
-- DROP TABLE IF EXISTS public.price_list CASCADE;
CREATE TABLE public.price_list (
	id_list_price serial NOT NULL,
	code varchar,
	description varchar,
	CONSTRAINT price_list_pk PRIMARY KEY (id_list_price)
);
-- ddl-end --
ALTER TABLE public.price_list OWNER TO postgres;
-- ddl-end --

INSERT INTO public.price_list (id_list_price, code, description) VALUES (DEFAULT, E'C4312S', E'Test list price');
-- ddl-end --

-- object: public.card | type: TABLE --
-- DROP TABLE IF EXISTS public.card CASCADE;
CREATE TABLE public.card (
	id_card serial NOT NULL,
	name varchar,
	description varchar,
	bank varchar,
	CONSTRAINT card_pk PRIMARY KEY (id_card)
);
-- ddl-end --
ALTER TABLE public.card OWNER TO postgres;
-- ddl-end --

-- object: public.card_payment | type: TABLE --
-- DROP TABLE IF EXISTS public.card_payment CASCADE;
CREATE TABLE public.card_payment (
	id_card_payment serial NOT NULL,
	id_card integer,
	id_payment integer,
	CONSTRAINT card_payment_pk PRIMARY KEY (id_card_payment)
);
-- ddl-end --
ALTER TABLE public.card_payment OWNER TO postgres;
-- ddl-end --

-- object: driver_fk | type: CONSTRAINT --
-- ALTER TABLE public.driver_sale DROP CONSTRAINT IF EXISTS driver_fk CASCADE;
ALTER TABLE public.driver_sale ADD CONSTRAINT driver_fk FOREIGN KEY (id_driver)
REFERENCES public.driver (id_driver) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: vehicle_fk | type: CONSTRAINT --
-- ALTER TABLE public.driver_sale DROP CONSTRAINT IF EXISTS vehicle_fk CASCADE;
ALTER TABLE public.driver_sale ADD CONSTRAINT vehicle_fk FOREIGN KEY (id_vehicle)
REFERENCES public.vehicle (id_vehicle) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: currency_fk | type: CONSTRAINT --
-- ALTER TABLE public.client_price_product DROP CONSTRAINT IF EXISTS currency_fk CASCADE;
ALTER TABLE public.client_price_product ADD CONSTRAINT currency_fk FOREIGN KEY (id_currency)
REFERENCES public.currency (id_currency) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: currency_fk | type: CONSTRAINT --
-- ALTER TABLE public.product_price DROP CONSTRAINT IF EXISTS currency_fk CASCADE;
ALTER TABLE public.product_price ADD CONSTRAINT currency_fk FOREIGN KEY (id_currency)
REFERENCES public.currency (id_currency) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: price_list_fk | type: CONSTRAINT --
-- ALTER TABLE public.product_price DROP CONSTRAINT IF EXISTS price_list_fk CASCADE;
ALTER TABLE public.product_price ADD CONSTRAINT price_list_fk FOREIGN KEY (id_list_price)
REFERENCES public.price_list (id_list_price) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: type_client_fk | type: CONSTRAINT --
-- ALTER TABLE public.client DROP CONSTRAINT IF EXISTS type_client_fk CASCADE;
ALTER TABLE public.client ADD CONSTRAINT type_client_fk FOREIGN KEY (id_type_client)
REFERENCES public.type_client (id_type_client) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: document_type_fk | type: CONSTRAINT --
-- ALTER TABLE public.person DROP CONSTRAINT IF EXISTS document_type_fk CASCADE;
ALTER TABLE public.person ADD CONSTRAINT document_type_fk FOREIGN KEY (id_document_type)
REFERENCES public.document_type (id_document_type) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: address_fk | type: CONSTRAINT --
-- ALTER TABLE public.person_address DROP CONSTRAINT IF EXISTS address_fk CASCADE;
ALTER TABLE public.person_address ADD CONSTRAINT address_fk FOREIGN KEY (id_address)
REFERENCES public.address (id_address) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: card_fk | type: CONSTRAINT --
-- ALTER TABLE public.card_payment DROP CONSTRAINT IF EXISTS card_fk CASCADE;
ALTER TABLE public.card_payment ADD CONSTRAINT card_fk FOREIGN KEY (id_card)
REFERENCES public.card (id_card) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: payment_method_fk | type: CONSTRAINT --
-- ALTER TABLE public.payment DROP CONSTRAINT IF EXISTS payment_method_fk CASCADE;
ALTER TABLE public.payment ADD CONSTRAINT payment_method_fk FOREIGN KEY (id_payment_method)
REFERENCES public.payment_method (id_payment_method) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: client_fk | type: CONSTRAINT --
-- ALTER TABLE public.client_sale DROP CONSTRAINT IF EXISTS client_fk CASCADE;
ALTER TABLE public.client_sale ADD CONSTRAINT client_fk FOREIGN KEY (id_client)
REFERENCES public.client (id_client) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: payment_fk | type: CONSTRAINT --
-- ALTER TABLE public.card_payment DROP CONSTRAINT IF EXISTS payment_fk CASCADE;
ALTER TABLE public.card_payment ADD CONSTRAINT payment_fk FOREIGN KEY (id_payment)
REFERENCES public.payment (id_payment) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: currency_fk | type: CONSTRAINT --
-- ALTER TABLE public.payment DROP CONSTRAINT IF EXISTS currency_fk CASCADE;
ALTER TABLE public.payment ADD CONSTRAINT currency_fk FOREIGN KEY (id_currency)
REFERENCES public.currency (id_currency) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: sale_document_fk | type: CONSTRAINT --
-- ALTER TABLE public.order_sale_document DROP CONSTRAINT IF EXISTS sale_document_fk CASCADE;
ALTER TABLE public.order_sale_document ADD CONSTRAINT sale_document_fk FOREIGN KEY (id_sale_document)
REFERENCES public.sale_document (id_sale_document) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: order_sale_document_uq1 | type: CONSTRAINT --
-- ALTER TABLE public.order_sale_document DROP CONSTRAINT IF EXISTS order_sale_document_uq1 CASCADE;
ALTER TABLE public.order_sale_document ADD CONSTRAINT order_sale_document_uq1 UNIQUE (id_sale_document);
-- ddl-end --

-- object: local_fk | type: CONSTRAINT --
-- ALTER TABLE public.sale DROP CONSTRAINT IF EXISTS local_fk CASCADE;
ALTER TABLE public.sale ADD CONSTRAINT local_fk FOREIGN KEY (id_local)
REFERENCES public.local (id_local) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: person_fk | type: CONSTRAINT --
-- ALTER TABLE public.person_address DROP CONSTRAINT IF EXISTS person_fk CASCADE;
ALTER TABLE public.person_address ADD CONSTRAINT person_fk FOREIGN KEY (id_person)
REFERENCES public.person (id_person) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: person_address_uq | type: CONSTRAINT --
-- ALTER TABLE public.person_address DROP CONSTRAINT IF EXISTS person_address_uq CASCADE;
ALTER TABLE public.person_address ADD CONSTRAINT person_address_uq UNIQUE (id_person);
-- ddl-end --

-- object: public.sale_document_type | type: TABLE --
-- DROP TABLE IF EXISTS public.sale_document_type CASCADE;
CREATE TABLE public.sale_document_type (
	document_code varchar NOT NULL,
	name varchar,
	description varchar,
	CONSTRAINT sale_document_type_pk PRIMARY KEY (document_code)
);
-- ddl-end --
ALTER TABLE public.sale_document_type OWNER TO postgres;
-- ddl-end --

INSERT INTO public.sale_document_type (document_code, name, description) VALUES (E'00001', E'FACTURA ', E'FACTURA ELECTRONICA');
-- ddl-end --
INSERT INTO public.sale_document_type (document_code, name, description) VALUES (E'00002', E'R.H', DEFAULT);
-- ddl-end --
INSERT INTO public.sale_document_type (document_code, name, description) VALUES (E'00003', E'BOLETA', E'BOLETA ELECTRONICA');
-- ddl-end --
INSERT INTO public.sale_document_type (document_code, name, description) VALUES (E'00007', E'NOTA DE CREDIDO', DEFAULT);
-- ddl-end --
INSERT INTO public.sale_document_type (document_code, name, description) VALUES (E'00008', E'NOTA DE DEBITO', DEFAULT);
-- ddl-end --
INSERT INTO public.sale_document_type (document_code, name, description) VALUES (E'00009', E'GUIA DE REMISION', DEFAULT);
-- ddl-end --
INSERT INTO public.sale_document_type (document_code, name, description) VALUES (E'00012', E'TICKET', DEFAULT);
-- ddl-end --
INSERT INTO public.sale_document_type (document_code, name, description) VALUES (E'99999', E'NOTA DE VENTA', DEFAULT);
-- ddl-end --
INSERT INTO public.sale_document_type (document_code, name, description) VALUES (E'99998', E'SEFARIN', DEFAULT);
-- ddl-end --

-- object: sale_document_type_fk | type: CONSTRAINT --
-- ALTER TABLE public.sale DROP CONSTRAINT IF EXISTS sale_document_type_fk CASCADE;
ALTER TABLE public.sale ADD CONSTRAINT sale_document_type_fk FOREIGN KEY (document_code)
REFERENCES public.sale_document_type (document_code) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --


