--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: ubv; Tablespace: 
--

CREATE TABLE usuarios (
    nombre character(45),
    apellido character(45),
    ci integer NOT NULL,
    clave character(45),
    tipo character(45)
);


ALTER TABLE public.usuarios OWNER TO ubv;

--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: ubv
--

COPY usuarios (nombre, apellido, ci, clave, tipo) FROM stdin;
leibnitz                                     	villanueva                                   	17926271	123                                          	admin                                        
\.


--
-- Name: usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: ubv; Tablespace: 
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (ci);


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

