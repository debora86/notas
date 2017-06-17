--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.6
-- Dumped by pg_dump version 9.5.6

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: notas; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE notas IS 'sistemas de notas';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: notas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE notas (
    cod_nota integer NOT NULL,
    det_nota character varying(500) NOT NULL,
    fecha_crea date,
    bool_eliminado character varying(10),
    finalizado integer DEFAULT 0
);


ALTER TABLE notas OWNER TO postgres;

--
-- Name: COLUMN notas.cod_nota; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN notas.cod_nota IS 'codigo de nota';


--
-- Name: COLUMN notas.det_nota; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN notas.det_nota IS 'detalle de nota';


--
-- Name: COLUMN notas.fecha_crea; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN notas.fecha_crea IS 'fecha de creacion de nota';


--
-- Name: COLUMN notas.bool_eliminado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN notas.bool_eliminado IS 'eliminado logico de nota';


--
-- Name: notas_cod_nota_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE notas_cod_nota_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE notas_cod_nota_seq OWNER TO postgres;

--
-- Name: notas_cod_nota_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE notas_cod_nota_seq OWNED BY notas.cod_nota;


--
-- Name: cod_nota; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notas ALTER COLUMN cod_nota SET DEFAULT nextval('notas_cod_nota_seq'::regclass);


--
-- Data for Name: notas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY notas (cod_nota, det_nota, fecha_crea, bool_eliminado, finalizado) FROM stdin;
2	otro mas	2017-06-16	false	0
3	y otro nota mas	2017-06-16	false	0
1	caracoles	2017-06-16	true	0
5	vamos a ver	2017-06-17	false	0
6	una cracoles	2017-06-17	false	0
\.


--
-- Name: notas_cod_nota_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('notas_cod_nota_seq', 6, true);


--
-- Name: notas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notas
    ADD CONSTRAINT notas_pkey PRIMARY KEY (cod_nota);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

