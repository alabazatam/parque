--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.4
-- Dumped by pg_dump version 9.5.4

-- Started on 2016-09-25 16:25:44 VET

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
-- TOC entry 2364 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 181 (class 1259 OID 16496)
-- Name: caracteristicas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE caracteristicas (
    id_caracteristica integer NOT NULL,
    nom_caracteristica character varying(100) NOT NULL,
    status integer DEFAULT 1 NOT NULL
);


ALTER TABLE caracteristicas OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 16500)
-- Name: caracteristicas_id_caracteristica_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE caracteristicas_id_caracteristica_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE caracteristicas_id_caracteristica_seq OWNER TO postgres;

--
-- TOC entry 2365 (class 0 OID 0)
-- Dependencies: 182
-- Name: caracteristicas_id_caracteristica_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE caracteristicas_id_caracteristica_seq OWNED BY caracteristicas.id_caracteristica;


--
-- TOC entry 183 (class 1259 OID 16502)
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
-- TOC entry 184 (class 1259 OID 16506)
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
-- TOC entry 2366 (class 0 OID 0)
-- Dependencies: 184
-- Name: connections_history_id_connection_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE connections_history_id_connection_seq OWNED BY connections_history.id_connection;


--
-- TOC entry 185 (class 1259 OID 16508)
-- Name: espacios_imagenes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE espacios_imagenes (
    id_espacio integer NOT NULL,
    imagen character varying(100) NOT NULL,
    id_espacios_imagenes integer NOT NULL,
    orden integer
);


ALTER TABLE espacios_imagenes OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 16511)
-- Name: espacio_imagenes_id_espacios_imagenes_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE espacio_imagenes_id_espacios_imagenes_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE espacio_imagenes_id_espacios_imagenes_seq OWNER TO postgres;

--
-- TOC entry 2367 (class 0 OID 0)
-- Dependencies: 186
-- Name: espacio_imagenes_id_espacios_imagenes_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE espacio_imagenes_id_espacios_imagenes_seq OWNED BY espacios_imagenes.id_espacios_imagenes;


--
-- TOC entry 187 (class 1259 OID 16513)
-- Name: espacios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE espacios (
    id_espacio integer NOT NULL,
    nom_espacio character varying(100) NOT NULL,
    des_espacio character varying(100),
    status integer DEFAULT 1 NOT NULL,
    capacidad integer NOT NULL,
    ut integer,
    id_tipo_espacio integer,
    id_zona_ubicacion integer NOT NULL,
    date_created timestamp without time zone DEFAULT now() NOT NULL,
    date_updated timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE espacios OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 16519)
-- Name: espacios_caracteristicas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE espacios_caracteristicas (
    id_espacio integer NOT NULL,
    id_caracteristica integer NOT NULL
);


ALTER TABLE espacios_caracteristicas OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 16522)
-- Name: kioskos_id_espacio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE kioskos_id_espacio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE kioskos_id_espacio_seq OWNER TO postgres;

--
-- TOC entry 2368 (class 0 OID 0)
-- Dependencies: 189
-- Name: kioskos_id_espacio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE kioskos_id_espacio_seq OWNED BY espacios.id_espacio;


--
-- TOC entry 190 (class 1259 OID 16524)
-- Name: parentescos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE parentescos (
    id_parentesco integer NOT NULL,
    nom_parentesco character varying(50) NOT NULL,
    status integer DEFAULT 1 NOT NULL,
    date_created timestamp without time zone DEFAULT now() NOT NULL,
    date_updated timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE parentescos OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 16530)
-- Name: parentescos_id_parentesco_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE parentescos_id_parentesco_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE parentescos_id_parentesco_seq OWNER TO postgres;

--
-- TOC entry 2369 (class 0 OID 0)
-- Dependencies: 191
-- Name: parentescos_id_parentesco_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE parentescos_id_parentesco_seq OWNED BY parentescos.id_parentesco;


--
-- TOC entry 192 (class 1259 OID 16532)
-- Name: solicitudes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE solicitudes (
    id_solicitud integer NOT NULL,
    id_espacio integer NOT NULL,
    id_zona_ubicacion integer NOT NULL,
    id_tipo_espacio integer,
    id_user integer,
    fec_reservacion date NOT NULL,
    status integer,
    date_created timestamp without time zone NOT NULL,
    date_updated timestamp without time zone NOT NULL,
    costo numeric(10,2) DEFAULT 0 NOT NULL,
    valor_ut numeric(10,2) DEFAULT 0 NOT NULL,
    cant_ut integer DEFAULT 1 NOT NULL,
    referencia_bancaria character varying(80),
    fec_pago date
);


ALTER TABLE solicitudes OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 16538)
-- Name: solicitudes_id_solicitud_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE solicitudes_id_solicitud_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE solicitudes_id_solicitud_seq OWNER TO postgres;

--
-- TOC entry 2370 (class 0 OID 0)
-- Dependencies: 193
-- Name: solicitudes_id_solicitud_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE solicitudes_id_solicitud_seq OWNED BY solicitudes.id_solicitud;


--
-- TOC entry 194 (class 1259 OID 16540)
-- Name: solicitudes_invitados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE solicitudes_invitados (
    id_solicitud integer,
    nacion character varying(1) DEFAULT 'V'::character varying NOT NULL,
    cedula character varying(10) NOT NULL,
    nombre1 character varying(50) NOT NULL,
    nombre2 character varying(50),
    apellido1 character varying(50) NOT NULL,
    apellido2 character varying(50),
    id_parentesco integer NOT NULL,
    id_solinvi integer NOT NULL,
    date_created timestamp without time zone DEFAULT now() NOT NULL,
    date_updated timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE solicitudes_invitados OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 16545)
-- Name: solicitudes_invitados_id_solinvi_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE solicitudes_invitados_id_solinvi_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE solicitudes_invitados_id_solinvi_seq OWNER TO postgres;

--
-- TOC entry 2371 (class 0 OID 0)
-- Dependencies: 195
-- Name: solicitudes_invitados_id_solinvi_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE solicitudes_invitados_id_solinvi_seq OWNED BY solicitudes_invitados.id_solinvi;


--
-- TOC entry 196 (class 1259 OID 16547)
-- Name: solicitudes_movimientos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE solicitudes_movimientos (
    id_mov integer NOT NULL,
    id_solicitud integer NOT NULL,
    status integer,
    date_created timestamp without time zone DEFAULT now() NOT NULL,
    id_user integer NOT NULL,
    observacion text
);


ALTER TABLE solicitudes_movimientos OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 16554)
-- Name: solicitudes_movimientos_id_mov_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE solicitudes_movimientos_id_mov_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE solicitudes_movimientos_id_mov_seq OWNER TO postgres;

--
-- TOC entry 2372 (class 0 OID 0)
-- Dependencies: 197
-- Name: solicitudes_movimientos_id_mov_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE solicitudes_movimientos_id_mov_seq OWNED BY solicitudes_movimientos.id_mov;


--
-- TOC entry 198 (class 1259 OID 16556)
-- Name: status; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE status (
    id_status integer NOT NULL,
    name character varying(100) NOT NULL,
    date_created timestamp without time zone NOT NULL,
    date_updated timestamp without time zone NOT NULL
);


ALTER TABLE status OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 16559)
-- Name: tipo_espacio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipo_espacio (
    id_tipo_espacio integer NOT NULL,
    nom_tipo_espacio character varying(50) NOT NULL,
    status integer DEFAULT 1 NOT NULL,
    date_created timestamp without time zone DEFAULT now(),
    date_updated timestamp without time zone DEFAULT now()
);


ALTER TABLE tipo_espacio OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 16565)
-- Name: tipo_espacio_id_tipo_espacio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipo_espacio_id_tipo_espacio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipo_espacio_id_tipo_espacio_seq OWNER TO postgres;

--
-- TOC entry 2373 (class 0 OID 0)
-- Dependencies: 200
-- Name: tipo_espacio_id_tipo_espacio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipo_espacio_id_tipo_espacio_seq OWNED BY tipo_espacio.id_tipo_espacio;


--
-- TOC entry 201 (class 1259 OID 16567)
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
-- TOC entry 202 (class 1259 OID 16574)
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
    date_updated timestamp without time zone NOT NULL,
    image character varying(100)
);


ALTER TABLE users_data OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 16583)
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
-- TOC entry 2374 (class 0 OID 0)
-- Dependencies: 203
-- Name: users_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_user_seq OWNED BY users.id_user;


--
-- TOC entry 204 (class 1259 OID 16585)
-- Name: ut; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE ut (
    id_ut integer NOT NULL,
    date_created timestamp without time zone DEFAULT now() NOT NULL,
    date_updated timestamp without time zone DEFAULT now() NOT NULL,
    valor numeric(10,2)
);


ALTER TABLE ut OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16590)
-- Name: ut_id_ut_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ut_id_ut_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ut_id_ut_seq OWNER TO postgres;

--
-- TOC entry 2375 (class 0 OID 0)
-- Dependencies: 205
-- Name: ut_id_ut_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ut_id_ut_seq OWNED BY ut.id_ut;


--
-- TOC entry 206 (class 1259 OID 16592)
-- Name: zona_ubicacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE zona_ubicacion (
    id_zona_ubicacion integer NOT NULL,
    des_zona_ubicacion character varying NOT NULL,
    status integer DEFAULT 1 NOT NULL,
    date_created timestamp without time zone DEFAULT now() NOT NULL,
    date_updated timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE zona_ubicacion OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16601)
-- Name: zona_ubicacion_id_zona_ubicacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE zona_ubicacion_id_zona_ubicacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE zona_ubicacion_id_zona_ubicacion_seq OWNER TO postgres;

--
-- TOC entry 2376 (class 0 OID 0)
-- Dependencies: 207
-- Name: zona_ubicacion_id_zona_ubicacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE zona_ubicacion_id_zona_ubicacion_seq OWNED BY zona_ubicacion.id_zona_ubicacion;


--
-- TOC entry 2141 (class 2604 OID 16603)
-- Name: id_caracteristica; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caracteristicas ALTER COLUMN id_caracteristica SET DEFAULT nextval('caracteristicas_id_caracteristica_seq'::regclass);


--
-- TOC entry 2143 (class 2604 OID 16604)
-- Name: id_connection; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY connections_history ALTER COLUMN id_connection SET DEFAULT nextval('connections_history_id_connection_seq'::regclass);


--
-- TOC entry 2148 (class 2604 OID 16605)
-- Name: id_espacio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY espacios ALTER COLUMN id_espacio SET DEFAULT nextval('kioskos_id_espacio_seq'::regclass);


--
-- TOC entry 2144 (class 2604 OID 16606)
-- Name: id_espacios_imagenes; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY espacios_imagenes ALTER COLUMN id_espacios_imagenes SET DEFAULT nextval('espacio_imagenes_id_espacios_imagenes_seq'::regclass);


--
-- TOC entry 2152 (class 2604 OID 16607)
-- Name: id_parentesco; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parentescos ALTER COLUMN id_parentesco SET DEFAULT nextval('parentescos_id_parentesco_seq'::regclass);


--
-- TOC entry 2156 (class 2604 OID 16608)
-- Name: id_solicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes ALTER COLUMN id_solicitud SET DEFAULT nextval('solicitudes_id_solicitud_seq'::regclass);


--
-- TOC entry 2159 (class 2604 OID 16609)
-- Name: id_solinvi; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes_invitados ALTER COLUMN id_solinvi SET DEFAULT nextval('solicitudes_invitados_id_solinvi_seq'::regclass);


--
-- TOC entry 2162 (class 2604 OID 16610)
-- Name: id_mov; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes_movimientos ALTER COLUMN id_mov SET DEFAULT nextval('solicitudes_movimientos_id_mov_seq'::regclass);


--
-- TOC entry 2166 (class 2604 OID 16611)
-- Name: id_tipo_espacio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_espacio ALTER COLUMN id_tipo_espacio SET DEFAULT nextval('tipo_espacio_id_tipo_espacio_seq'::regclass);


--
-- TOC entry 2171 (class 2604 OID 16612)
-- Name: id_user; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id_user SET DEFAULT nextval('users_id_user_seq'::regclass);


--
-- TOC entry 2177 (class 2604 OID 16613)
-- Name: id_ut; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ut ALTER COLUMN id_ut SET DEFAULT nextval('ut_id_ut_seq'::regclass);


--
-- TOC entry 2181 (class 2604 OID 16614)
-- Name: id_zona_ubicacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY zona_ubicacion ALTER COLUMN id_zona_ubicacion SET DEFAULT nextval('zona_ubicacion_id_zona_ubicacion_seq'::regclass);


--
-- TOC entry 2331 (class 0 OID 16496)
-- Dependencies: 181
-- Data for Name: caracteristicas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2377 (class 0 OID 0)
-- Dependencies: 182
-- Name: caracteristicas_id_caracteristica_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('caracteristicas_id_caracteristica_seq', 1, false);


--
-- TOC entry 2333 (class 0 OID 16502)
-- Dependencies: 183
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
INSERT INTO connections_history VALUES (13, 1, 'MDEANDRADE', '127.0.0.1', '2016-09-11 15:13:55.041579');
INSERT INTO connections_history VALUES (14, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 17:47:16.225055');
INSERT INTO connections_history VALUES (15, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 17:49:15.864419');
INSERT INTO connections_history VALUES (16, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 17:50:40.100405');
INSERT INTO connections_history VALUES (17, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 17:51:00.136919');
INSERT INTO connections_history VALUES (18, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 17:59:23.50084');
INSERT INTO connections_history VALUES (19, 1, 'mdeandrade', '127.0.0.1', '2016-09-11 18:00:03.829056');
INSERT INTO connections_history VALUES (20, 1, 'mdeandrade', '127.0.0.1', '2016-09-14 18:46:29.724027');
INSERT INTO connections_history VALUES (21, 1, 'mdeandrade', '127.0.0.1', '2016-09-14 21:49:42.177905');
INSERT INTO connections_history VALUES (22, 1, 'mdeandrade', '127.0.0.1', '2016-09-15 18:31:17.321826');
INSERT INTO connections_history VALUES (23, 1, 'mdeandrade', '127.0.0.1', '2016-09-15 21:07:06.160261');
INSERT INTO connections_history VALUES (24, 7, 'admin', '127.0.0.1', '2016-09-19 17:52:50.885581');
INSERT INTO connections_history VALUES (25, 7, 'admin', '127.0.0.1', '2016-09-20 10:25:11.65102');
INSERT INTO connections_history VALUES (26, 7, 'admin', '127.0.0.1', '2016-09-20 10:41:53.0823');
INSERT INTO connections_history VALUES (27, 7, 'admin', '127.0.0.1', '2016-09-22 20:06:35.772953');
INSERT INTO connections_history VALUES (28, 7, 'admin', '127.0.0.1', '2016-09-22 20:28:18.491156');
INSERT INTO connections_history VALUES (29, 7, 'admin', '127.0.0.1', '2016-09-23 20:03:14.348726');


--
-- TOC entry 2378 (class 0 OID 0)
-- Dependencies: 184
-- Name: connections_history_id_connection_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('connections_history_id_connection_seq', 29, true);


--
-- TOC entry 2379 (class 0 OID 0)
-- Dependencies: 186
-- Name: espacio_imagenes_id_espacios_imagenes_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('espacio_imagenes_id_espacios_imagenes_seq', 136, true);


--
-- TOC entry 2337 (class 0 OID 16513)
-- Dependencies: 187
-- Data for Name: espacios; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO espacios VALUES (10, 'KIOSKO 10', 'KIOSKO 10', 1, 35, 10, 1, 1, '2016-09-11 20:03:57.571002', '2016-09-11 20:03:57.571002');
INSERT INTO espacios VALUES (11, 'ssss', 'sssssssssss', 1, 34, 1, 1, 1, '2016-09-14 21:10:55.97144', '2016-09-14 21:10:55.97144');
INSERT INTO espacios VALUES (12, 'KIOSKO 12', '24224424', 1, 35, 6, 1, 1, '2016-09-14 21:12:07.983308', '2016-09-14 21:12:47.162556');
INSERT INTO espacios VALUES (3, 'KIOSKO 3', 'KIOSKO 3', 1, 35, 10, 1, 1, '2016-09-11 19:31:32.512193', '2016-09-14 21:21:47.36557');
INSERT INTO espacios VALUES (5, 'KIOSKO 4', 'KIOSKO 4', 1, 35, 10, 1, 1, '2016-09-11 19:41:53.943233', '2016-09-14 21:21:48.773805');
INSERT INTO espacios VALUES (6, 'KIOSKO 4', 'KIOSKO 4', 1, 35, 10, 1, 1, '2016-09-11 19:57:48.360527', '2016-09-14 21:21:49.431319');
INSERT INTO espacios VALUES (7, 'KIOSKO 4', 'KIOSKO 4', 1, 35, 10, 1, 1, '2016-09-11 19:59:07.310877', '2016-09-14 21:21:50.12374');
INSERT INTO espacios VALUES (8, 'KIOSKO 8', 'KIOSKO 8', 1, 35, 10, 1, 1, '2016-09-11 19:59:49.582871', '2016-09-14 21:21:52.260707');
INSERT INTO espacios VALUES (9, 'KIOSKO 8', 'KIOSKO 8', 1, 35, 10, 1, 1, '2016-09-11 20:01:14.27341', '2016-09-14 21:21:54.056332');
INSERT INTO espacios VALUES (4, 'KIOSKO 4', 'KIOSKO 4', 1, 35, 10, 1, 1, '2016-09-11 19:34:18.371738', '2016-09-14 21:21:55.110753');
INSERT INTO espacios VALUES (1, 'KIOSCO 1', 'KIOSCO 1', 1, 35, 10, 1, 1, '2016-09-11 19:29:17.814676', '2016-09-14 21:23:35.61164');
INSERT INTO espacios VALUES (2, 'KIOSCO 2', 'KIOSCO 2', 1, 35, 10, 1, 1, '2016-09-11 19:30:48.129466', '2016-09-19 18:40:57.522246');


--
-- TOC entry 2338 (class 0 OID 16519)
-- Dependencies: 188
-- Data for Name: espacios_caracteristicas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2335 (class 0 OID 16508)
-- Dependencies: 185
-- Data for Name: espacios_imagenes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO espacios_imagenes VALUES (2, 'ESPACIO_2_1.png', 133, 1);
INSERT INTO espacios_imagenes VALUES (2, 'ESPACIO_2_2.png', 134, 2);
INSERT INTO espacios_imagenes VALUES (2, 'ESPACIO_2_3.png', 135, 3);
INSERT INTO espacios_imagenes VALUES (2, 'ESPACIO_2_4.png', 136, 4);
INSERT INTO espacios_imagenes VALUES (1, 'ESPACIO_1_1.png', 129, 1);
INSERT INTO espacios_imagenes VALUES (1, 'ESPACIO_1_2.png', 130, 2);
INSERT INTO espacios_imagenes VALUES (1, 'ESPACIO_1_3.png', 131, 3);


--
-- TOC entry 2380 (class 0 OID 0)
-- Dependencies: 189
-- Name: kioskos_id_espacio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('kioskos_id_espacio_seq', 12, true);


--
-- TOC entry 2340 (class 0 OID 16524)
-- Dependencies: 190
-- Data for Name: parentescos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2381 (class 0 OID 0)
-- Dependencies: 191
-- Name: parentescos_id_parentesco_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('parentescos_id_parentesco_seq', 1, false);


--
-- TOC entry 2342 (class 0 OID 16532)
-- Dependencies: 192
-- Data for Name: solicitudes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO solicitudes VALUES (17, 1, 1, 1, 7, '2016-09-10', 8, '2016-09-20 11:46:12', '2016-09-23 22:57:29', 1770.00, 177.00, 10, NULL, NULL);
INSERT INTO solicitudes VALUES (18, 1, 1, 1, 7, '2016-09-27', 5, '2016-09-20 11:49:54', '2016-09-23 22:59:44', 1770.00, 177.00, 10, 'dkjfghkjdfhgkhdjf', '2016-09-23');


--
-- TOC entry 2382 (class 0 OID 0)
-- Dependencies: 193
-- Name: solicitudes_id_solicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('solicitudes_id_solicitud_seq', 18, true);


--
-- TOC entry 2344 (class 0 OID 16540)
-- Dependencies: 194
-- Data for Name: solicitudes_invitados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2383 (class 0 OID 0)
-- Dependencies: 195
-- Name: solicitudes_invitados_id_solinvi_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('solicitudes_invitados_id_solinvi_seq', 1, false);


--
-- TOC entry 2346 (class 0 OID 16547)
-- Dependencies: 196
-- Data for Name: solicitudes_movimientos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO solicitudes_movimientos VALUES (1, 18, 1, '2016-09-20 11:49:54', 7, NULL);


--
-- TOC entry 2384 (class 0 OID 0)
-- Dependencies: 197
-- Name: solicitudes_movimientos_id_mov_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('solicitudes_movimientos_id_mov_seq', 1, true);


--
-- TOC entry 2348 (class 0 OID 16556)
-- Dependencies: 198
-- Data for Name: status; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO status VALUES (0, 'DESACTIVADO', '2016-09-11 00:00:00', '2016-09-11 00:00:00');
INSERT INTO status VALUES (1, 'ACTIVO', '2016-09-11 00:00:00', '2016-09-11 00:00:00');
INSERT INTO status VALUES (2, 'Solicitud creada en espera de autorización para pago', '2016-09-22 20:44:58.942234', '2016-09-22 20:44:58.942234');
INSERT INTO status VALUES (3, 'Solicitud por pagar', '2016-09-22 21:05:21.31772', '2016-09-22 21:05:21.31772');
INSERT INTO status VALUES (4, 'Solicitud en validación de pago', '2016-09-22 21:06:04.791215', '2016-09-22 21:06:04.791215');
INSERT INTO status VALUES (6, 'Validación de lista de invitados', '2016-09-22 21:07:35.618952', '2016-09-22 21:07:35.618952');
INSERT INTO status VALUES (7, 'Solicitud completada', '2016-09-22 21:07:50.963269', '2016-09-22 21:07:50.963269');
INSERT INTO status VALUES (8, 'Solicitud cancelada', '2016-09-22 21:10:25.351672', '2016-09-22 21:10:25.351672');
INSERT INTO status VALUES (5, 'Pago procesado, Cargar lista de invitados', '2016-09-22 21:06:26.46444', '2016-09-22 21:06:26.46444');


--
-- TOC entry 2349 (class 0 OID 16559)
-- Dependencies: 199
-- Data for Name: tipo_espacio; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipo_espacio VALUES (2, 'tipo prueba 2', 1, '2016-09-15 18:58:28.334524', '2016-09-15 18:58:46.612327');
INSERT INTO tipo_espacio VALUES (1, 'tipo de prueba', 1, '2016-09-15 18:53:00.5153', '2016-09-15 18:58:54.923235');


--
-- TOC entry 2385 (class 0 OID 0)
-- Dependencies: 200
-- Name: tipo_espacio_id_tipo_espacio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipo_espacio_id_tipo_espacio_seq', 2, true);


--
-- TOC entry 2351 (class 0 OID 16567)
-- Dependencies: 201
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO users VALUES (8, 'tamara', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, '2016-04-02 20:55:08', '2016-06-18 13:42:51', '', NULL, 'SEC');
INSERT INTO users VALUES (9, 'reporte', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, '2016-04-02 20:55:08', '2016-06-18 13:42:51', '', NULL, 'REP');
INSERT INTO users VALUES (7, 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, '2016-05-08 11:51:43', '2016-09-11 14:55:36.718971', '', NULL, 'ADM');
INSERT INTO users VALUES (10, 'admin2', '18bfddf1020067bbd33fad652bc8f1a59b2427ff8c7ebfd62bbfef6c2dddff49', 1, '2016-09-04 10:32:25', '2016-09-11 14:55:37.865733', NULL, NULL, 'ADM');
INSERT INTO users VALUES (1, 'mdeandrade', '18bfddf1020067bbd33fad652bc8f1a59b2427ff8c7ebfd62bbfef6c2dddff49', 1, '2016-04-02 20:55:08', '2016-09-11 17:52:12', '', NULL, 'ADM');


--
-- TOC entry 2352 (class 0 OID 16574)
-- Dependencies: 202
-- Data for Name: users_data; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO users_data VALUES (7, 'Marcos ', 'arlindo', 'DE ANDRADE', 'CARRERA', 'V', '18020594', NULL, 'M', '04268141850', NULL, '2016-04-03 17:41:26', '2016-04-03 17:41:26', NULL);
INSERT INTO users_data VALUES (8, 'Marcos', 'arlindo', 'DE ANDRADE', 'CARRERA', 'V', '18020594', NULL, 'M', '04142695880', NULL, '2016-04-03 17:44:48', '2016-04-03 17:44:48', NULL);
INSERT INTO users_data VALUES (9, 'jean', 'maiker', 'de andrade', 'carrera ', 'V', '20303709', NULL, 'M', '04163030894', NULL, '2016-04-03 20:38:36', '2016-04-03 20:38:36', NULL);
INSERT INTO users_data VALUES (10, 'jean', 'maiker', 'de andrade', 'carrera', 'V', '20303709', NULL, 'M', '04163030894', NULL, '2016-04-03 20:50:13', '2016-04-03 20:50:22', NULL);
INSERT INTO users_data VALUES (1, 'MARCOS', 'ARLINDO', 'DE ANDRADE', 'CARRERA', 'V', '18020594', NULL, 'M', '04268141850', '04268141850', '2016-04-02 21:28:41', '2016-09-15 21:57:54.968835', 'mdeandrade.jpg');


--
-- TOC entry 2386 (class 0 OID 0)
-- Dependencies: 203
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_user_seq', 1, false);


--
-- TOC entry 2354 (class 0 OID 16585)
-- Dependencies: 204
-- Data for Name: ut; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO ut VALUES (1, '2016-09-15 19:08:44.83429', '2016-09-15 19:08:44.83429', 177.00);


--
-- TOC entry 2387 (class 0 OID 0)
-- Dependencies: 205
-- Name: ut_id_ut_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ut_id_ut_seq', 1, true);


--
-- TOC entry 2356 (class 0 OID 16592)
-- Dependencies: 206
-- Data for Name: zona_ubicacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO zona_ubicacion VALUES (2, 'zona de prueba2', 1, '2016-09-14 21:58:55.275527', '2016-09-14 21:58:55.275527');
INSERT INTO zona_ubicacion VALUES (3, 'zona de prueba3', 1, '2016-09-14 21:58:55.275527', '2016-09-14 21:58:55.275527');
INSERT INTO zona_ubicacion VALUES (4, '89898', 1, '2016-09-15 18:36:40.682512', '2016-09-15 18:36:40.682512');
INSERT INTO zona_ubicacion VALUES (5, 'asdasda', 1, '2016-09-15 18:38:39.78745', '2016-09-15 18:38:39.78745');
INSERT INTO zona_ubicacion VALUES (6, 'sfsdfsd', 1, '2016-09-15 18:38:58.882072', '2016-09-15 18:38:58.882072');
INSERT INTO zona_ubicacion VALUES (7, 'sdfsdfsdfd', 1, '2016-09-15 18:39:31.999195', '2016-09-15 18:39:31.999195');
INSERT INTO zona_ubicacion VALUES (1, 'zona de pruebassssssssss', 1, '2016-09-15 18:39:40.429766', '2016-09-15 18:40:14.31048');


--
-- TOC entry 2388 (class 0 OID 0)
-- Dependencies: 207
-- Name: zona_ubicacion_id_zona_ubicacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('zona_ubicacion_id_zona_ubicacion_seq', 7, true);


--
-- TOC entry 2183 (class 2606 OID 16616)
-- Name: caracteristicas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caracteristicas
    ADD CONSTRAINT caracteristicas_pkey PRIMARY KEY (id_caracteristica);


--
-- TOC entry 2185 (class 2606 OID 16618)
-- Name: connections_history_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY connections_history
    ADD CONSTRAINT connections_history_pkey PRIMARY KEY (id_connection);


--
-- TOC entry 2187 (class 2606 OID 16620)
-- Name: espacio_imagenes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY espacios_imagenes
    ADD CONSTRAINT espacio_imagenes_pkey PRIMARY KEY (id_espacios_imagenes);


--
-- TOC entry 2191 (class 2606 OID 16622)
-- Name: espacios_caracteristicas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY espacios_caracteristicas
    ADD CONSTRAINT espacios_caracteristicas_pkey PRIMARY KEY (id_espacio, id_caracteristica);


--
-- TOC entry 2189 (class 2606 OID 16624)
-- Name: kioskos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY espacios
    ADD CONSTRAINT kioskos_pkey PRIMARY KEY (id_espacio);


--
-- TOC entry 2193 (class 2606 OID 16626)
-- Name: parentescos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parentescos
    ADD CONSTRAINT parentescos_pkey PRIMARY KEY (id_parentesco);


--
-- TOC entry 2197 (class 2606 OID 16628)
-- Name: solicitudes_invitados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes_invitados
    ADD CONSTRAINT solicitudes_invitados_pkey PRIMARY KEY (id_solinvi);


--
-- TOC entry 2199 (class 2606 OID 16630)
-- Name: solicitudes_movimientos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes_movimientos
    ADD CONSTRAINT solicitudes_movimientos_pkey PRIMARY KEY (id_mov);


--
-- TOC entry 2195 (class 2606 OID 16632)
-- Name: solicitudes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes
    ADD CONSTRAINT solicitudes_pkey PRIMARY KEY (id_solicitud);


--
-- TOC entry 2201 (class 2606 OID 16634)
-- Name: status_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY status
    ADD CONSTRAINT status_pkey PRIMARY KEY (id_status);


--
-- TOC entry 2203 (class 2606 OID 16636)
-- Name: tipo_espacio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_espacio
    ADD CONSTRAINT tipo_espacio_pkey PRIMARY KEY (id_tipo_espacio);


--
-- TOC entry 2207 (class 2606 OID 16638)
-- Name: users_data_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users_data
    ADD CONSTRAINT users_data_pkey PRIMARY KEY (id_user);


--
-- TOC entry 2205 (class 2606 OID 16640)
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id_user);


--
-- TOC entry 2209 (class 2606 OID 16642)
-- Name: ut_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ut
    ADD CONSTRAINT ut_pkey PRIMARY KEY (id_ut);


--
-- TOC entry 2211 (class 2606 OID 16644)
-- Name: zona_ubicacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY zona_ubicacion
    ADD CONSTRAINT zona_ubicacion_pkey PRIMARY KEY (id_zona_ubicacion);


--
-- TOC entry 2212 (class 2606 OID 16645)
-- Name: connections_history_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY connections_history
    ADD CONSTRAINT connections_history_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user);


--
-- TOC entry 2213 (class 2606 OID 16650)
-- Name: kioskos_id_tipo_espacio_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY espacios
    ADD CONSTRAINT kioskos_id_tipo_espacio_fkey FOREIGN KEY (id_tipo_espacio) REFERENCES tipo_espacio(id_tipo_espacio);


--
-- TOC entry 2214 (class 2606 OID 16655)
-- Name: solicitudes_invitados_id_parentesco_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes_invitados
    ADD CONSTRAINT solicitudes_invitados_id_parentesco_fkey FOREIGN KEY (id_parentesco) REFERENCES parentescos(id_parentesco);


--
-- TOC entry 2215 (class 2606 OID 16660)
-- Name: solicitudes_invitados_id_solicitud_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes_invitados
    ADD CONSTRAINT solicitudes_invitados_id_solicitud_fkey FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud);


--
-- TOC entry 2216 (class 2606 OID 16665)
-- Name: users_data_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users_data
    ADD CONSTRAINT users_data_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user);


--
-- TOC entry 2363 (class 0 OID 0)
-- Dependencies: 7
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2016-09-25 16:25:44 VET

--
-- PostgreSQL database dump complete
--

