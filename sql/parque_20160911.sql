--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.4
-- Dumped by pg_dump version 9.5.4

-- Started on 2016-09-11 14:58:22 VET

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12435)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2220 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 185 (class 1259 OID 16417)
-- Name: connections_history; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE connections_history (
    id_connection integer NOT NULL,
    id_user integer NOT NULL,
    login character varying(100) NOT NULL,
    ip character varying(50) NOT NULL,
    date_created timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE connections_history OWNER TO postgres;

--
-- TOC entry 184 (class 1259 OID 16415)
-- Name: connections_history_id_connection_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE connections_history_id_connection_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE connections_history_id_connection_seq OWNER TO postgres;

--
-- TOC entry 2221 (class 0 OID 0)
-- Dependencies: 184
-- Name: connections_history_id_connection_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE connections_history_id_connection_seq OWNED BY connections_history.id_connection;


--
-- TOC entry 186 (class 1259 OID 16429)
-- Name: status; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE status (
    id_status integer NOT NULL,
    name character varying(50) NOT NULL,
    date_created timestamp without time zone NOT NULL,
    date_updated timestamp without time zone NOT NULL
);


ALTER TABLE status OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 16387)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE users (
    id_user integer NOT NULL,
    login character varying(100) NOT NULL,
    password character varying(100) NOT NULL,
    status integer DEFAULT 1 NOT NULL,
    date_created timestamp without time zone NOT NULL,
    date_updated timestamp without time zone NOT NULL,
    mail character varying(45) DEFAULT NULL::character varying,
    mail_alternative character varying(45) DEFAULT NULL::character varying,
    rol character varying(50) DEFAULT NULL::character varying
);


ALTER TABLE users OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 16395)
-- Name: users_data; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE users_data (
    id_user integer NOT NULL,
    first_name character varying(200) NOT NULL,
    second_name character varying(45) DEFAULT NULL::character varying,
    first_last_name character varying(45) NOT NULL,
    second_last_name character varying(45) DEFAULT NULL::character varying,
    nationality character varying(1) NOT NULL,
    document character varying(45) NOT NULL,
    birthdate date,
    gender character varying(1) NOT NULL,
    phone character varying(45) NOT NULL,
    phone1 character varying(45) DEFAULT NULL::character varying,
    date_created timestamp without time zone NOT NULL,
    date_updated timestamp without time zone NOT NULL
);


ALTER TABLE users_data OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 16385)
-- Name: users_id_user_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_id_user_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_user_seq OWNER TO postgres;

--
-- TOC entry 2222 (class 0 OID 0)
-- Dependencies: 181
-- Name: users_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_user_seq OWNED BY users.id_user;


--
-- TOC entry 2081 (class 2604 OID 16420)
-- Name: id_connection; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY connections_history ALTER COLUMN id_connection SET DEFAULT nextval('connections_history_id_connection_seq'::regclass);


--
-- TOC entry 2073 (class 2604 OID 16390)
-- Name: id_user; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id_user SET DEFAULT nextval('users_id_user_seq'::regclass);


--
-- TOC entry 2211 (class 0 OID 16417)
-- Dependencies: 185
-- Data for Name: connections_history; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO connections_history VALUES (1, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 14:33:01.709027');
INSERT INTO connections_history VALUES (2, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 14:36:11.590116');
INSERT INTO connections_history VALUES (3, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 14:38:56.169614');
INSERT INTO connections_history VALUES (4, 1, 'MDEANDRADE', '127.0.0.1', '2016-09-11 14:41:11.281488');
INSERT INTO connections_history VALUES (5, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 14:44:25.490898');
INSERT INTO connections_history VALUES (6, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 14:45:54.381579');
INSERT INTO connections_history VALUES (7, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 14:47:05.397272');
INSERT INTO connections_history VALUES (8, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 14:47:36.871062');
INSERT INTO connections_history VALUES (9, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 14:48:05.002686');
INSERT INTO connections_history VALUES (10, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 14:49:52.95499');
INSERT INTO connections_history VALUES (11, 1, 'MDEANDRADE', '127.0.0.1', '2016-09-11 14:56:21.149104');
INSERT INTO connections_history VALUES (12, 1, 'MDEANDRADE', '127.0.0.1', '2016-09-11 14:57:19.232845');


--
-- TOC entry 2223 (class 0 OID 0)
-- Dependencies: 184
-- Name: connections_history_id_connection_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('connections_history_id_connection_seq', 12, true);


--
-- TOC entry 2212 (class 0 OID 16429)
-- Dependencies: 186
-- Data for Name: status; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO status VALUES (0, 'DESACTIVADO', '2016-09-11 00:00:00', '2016-09-11 00:00:00');
INSERT INTO status VALUES (1, 'ACTIVO', '2016-09-11 00:00:00', '2016-09-11 00:00:00');


--
-- TOC entry 2208 (class 0 OID 16387)
-- Dependencies: 182
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO users VALUES (8, 'tamara', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, '2016-04-02 20:55:08', '2016-06-18 13:42:51', '', NULL, 'SEC');
INSERT INTO users VALUES (9, 'reporte', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, '2016-04-02 20:55:08', '2016-06-18 13:42:51', '', NULL, 'REP');
INSERT INTO users VALUES (7, 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, '2016-05-08 11:51:43', '2016-09-11 14:55:36.718971', '', NULL, 'ADM');
INSERT INTO users VALUES (10, 'admin2', '18bfddf1020067bbd33fad652bc8f1a59b2427ff8c7ebfd62bbfef6c2dddff49', 1, '2016-09-04 10:32:25', '2016-09-11 14:55:37.865733', NULL, NULL, 'ADM');
INSERT INTO users VALUES (1, 'mdeandrade', '18bfddf1020067bbd33fad652bc8f1a59b2427ff8c7ebfd62bbfef6c2dddff49', 1, '2016-04-02 20:55:08', '2016-09-11 14:57:31.059071', '', NULL, 'ADM');


--
-- TOC entry 2209 (class 0 OID 16395)
-- Dependencies: 183
-- Data for Name: users_data; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO users_data VALUES (1, 'MARCOS', 'ARLINDO', 'DE ANDRADE', 'CARRERA', 'V', '18020594', NULL, 'M', '04268141850', NULL, '2016-04-02 21:28:41', '2016-04-02 21:28:41');
INSERT INTO users_data VALUES (7, 'Marcos ', 'arlindo', 'DE ANDRADE', 'CARRERA', 'V', '18020594', NULL, 'M', '04268141850', NULL, '2016-04-03 17:41:26', '2016-04-03 17:41:26');
INSERT INTO users_data VALUES (8, 'Marcos', 'arlindo', 'DE ANDRADE', 'CARRERA', 'V', '18020594', NULL, 'M', '04142695880', NULL, '2016-04-03 17:44:48', '2016-04-03 17:44:48');
INSERT INTO users_data VALUES (9, 'jean', 'maiker', 'de andrade', 'carrera ', 'V', '20303709', NULL, 'M', '04163030894', NULL, '2016-04-03 20:38:36', '2016-04-03 20:38:36');
INSERT INTO users_data VALUES (10, 'jean', 'maiker', 'de andrade', 'carrera', 'V', '20303709', NULL, 'M', '04163030894', NULL, '2016-04-03 20:50:13', '2016-04-03 20:50:22');


--
-- TOC entry 2224 (class 0 OID 0)
-- Dependencies: 181
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_user_seq', 1, false);


--
-- TOC entry 2088 (class 2606 OID 16422)
-- Name: connections_history_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY connections_history
    ADD CONSTRAINT connections_history_pkey PRIMARY KEY (id_connection);


--
-- TOC entry 2090 (class 2606 OID 16433)
-- Name: status_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY status
    ADD CONSTRAINT status_pkey PRIMARY KEY (id_status);


--
-- TOC entry 2086 (class 2606 OID 16404)
-- Name: users_data_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users_data
    ADD CONSTRAINT users_data_pkey PRIMARY KEY (id_user);


--
-- TOC entry 2084 (class 2606 OID 16402)
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id_user);


--
-- TOC entry 2092 (class 2606 OID 16423)
-- Name: connections_history_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY connections_history
    ADD CONSTRAINT connections_history_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user);


--
-- TOC entry 2091 (class 2606 OID 16410)
-- Name: users_data_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users_data
    ADD CONSTRAINT users_data_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user);


--
-- TOC entry 2219 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2016-09-11 14:58:22 VET

--
-- PostgreSQL database dump complete
--

