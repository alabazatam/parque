--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.13
-- Dumped by pg_dump version 9.3.13
-- Started on 2016-10-01 23:44:50 VET

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 1 (class 3079 OID 11829)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2214 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 171 (class 1259 OID 56337)
-- Name: caracteristicas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE caracteristicas (
    id_caracteristica integer NOT NULL,
    nom_caracteristica character varying(100) NOT NULL,
    status integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.caracteristicas OWNER TO postgres;

--
-- TOC entry 172 (class 1259 OID 56341)
-- Name: caracteristicas_id_caracteristica_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE caracteristicas_id_caracteristica_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.caracteristicas_id_caracteristica_seq OWNER TO postgres;

--
-- TOC entry 2215 (class 0 OID 0)
-- Dependencies: 172
-- Name: caracteristicas_id_caracteristica_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE caracteristicas_id_caracteristica_seq OWNED BY caracteristicas.id_caracteristica;


--
-- TOC entry 173 (class 1259 OID 56343)
-- Name: connections_history; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE connections_history (
    id_connection integer NOT NULL,
    id_user integer NOT NULL,
    login character varying(100) NOT NULL,
    ip character varying(50) NOT NULL,
    date_created timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.connections_history OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 56347)
-- Name: connections_history_id_connection_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE connections_history_id_connection_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.connections_history_id_connection_seq OWNER TO postgres;

--
-- TOC entry 2216 (class 0 OID 0)
-- Dependencies: 174
-- Name: connections_history_id_connection_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE connections_history_id_connection_seq OWNED BY connections_history.id_connection;


--
-- TOC entry 175 (class 1259 OID 56349)
-- Name: espacios_imagenes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE espacios_imagenes (
    id_espacio integer NOT NULL,
    imagen character varying(100) NOT NULL,
    id_espacios_imagenes integer NOT NULL,
    orden integer
);


ALTER TABLE public.espacios_imagenes OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 56352)
-- Name: espacio_imagenes_id_espacios_imagenes_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE espacio_imagenes_id_espacios_imagenes_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.espacio_imagenes_id_espacios_imagenes_seq OWNER TO postgres;

--
-- TOC entry 2217 (class 0 OID 0)
-- Dependencies: 176
-- Name: espacio_imagenes_id_espacios_imagenes_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE espacio_imagenes_id_espacios_imagenes_seq OWNED BY espacios_imagenes.id_espacios_imagenes;


--
-- TOC entry 177 (class 1259 OID 56354)
-- Name: espacios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public.espacios OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 56360)
-- Name: espacios_caracteristicas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE espacios_caracteristicas (
    id_espacio integer NOT NULL,
    id_caracteristica integer NOT NULL
);


ALTER TABLE public.espacios_caracteristicas OWNER TO postgres;

--
-- TOC entry 179 (class 1259 OID 56363)
-- Name: kioskos_id_espacio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE kioskos_id_espacio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.kioskos_id_espacio_seq OWNER TO postgres;

--
-- TOC entry 2218 (class 0 OID 0)
-- Dependencies: 179
-- Name: kioskos_id_espacio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE kioskos_id_espacio_seq OWNED BY espacios.id_espacio;


--
-- TOC entry 180 (class 1259 OID 56365)
-- Name: parentescos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE parentescos (
    id_parentesco integer NOT NULL,
    nom_parentesco character varying(50) NOT NULL,
    status integer DEFAULT 1 NOT NULL,
    date_created timestamp without time zone DEFAULT now() NOT NULL,
    date_updated timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.parentescos OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 56371)
-- Name: parentescos_id_parentesco_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE parentescos_id_parentesco_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.parentescos_id_parentesco_seq OWNER TO postgres;

--
-- TOC entry 2219 (class 0 OID 0)
-- Dependencies: 181
-- Name: parentescos_id_parentesco_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE parentescos_id_parentesco_seq OWNED BY parentescos.id_parentesco;


--
-- TOC entry 182 (class 1259 OID 56373)
-- Name: solicitudes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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
    fec_pago date,
    recibo character varying(255)
);


ALTER TABLE public.solicitudes OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 56379)
-- Name: solicitudes_id_solicitud_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE solicitudes_id_solicitud_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.solicitudes_id_solicitud_seq OWNER TO postgres;

--
-- TOC entry 2220 (class 0 OID 0)
-- Dependencies: 183
-- Name: solicitudes_id_solicitud_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE solicitudes_id_solicitud_seq OWNED BY solicitudes.id_solicitud;


--
-- TOC entry 184 (class 1259 OID 56381)
-- Name: solicitudes_invitados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE solicitudes_invitados (
    id_solicitud integer,
    nacion character varying(1) DEFAULT 'V'::character varying NOT NULL,
    cedula character varying(10),
    nombre1 character varying(50),
    nombre2 character varying(50),
    apellido1 character varying(50),
    apellido2 character varying(50),
    id_parentesco integer,
    id_solinvi integer NOT NULL,
    date_created timestamp without time zone DEFAULT now() NOT NULL,
    date_updated timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.solicitudes_invitados OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 56387)
-- Name: solicitudes_invitados_id_solinvi_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE solicitudes_invitados_id_solinvi_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.solicitudes_invitados_id_solinvi_seq OWNER TO postgres;

--
-- TOC entry 2221 (class 0 OID 0)
-- Dependencies: 185
-- Name: solicitudes_invitados_id_solinvi_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE solicitudes_invitados_id_solinvi_seq OWNED BY solicitudes_invitados.id_solinvi;


--
-- TOC entry 186 (class 1259 OID 56389)
-- Name: solicitudes_movimientos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE solicitudes_movimientos (
    id_mov integer NOT NULL,
    id_solicitud integer NOT NULL,
    status integer,
    date_created timestamp without time zone DEFAULT now() NOT NULL,
    id_user integer NOT NULL,
    observacion text
);


ALTER TABLE public.solicitudes_movimientos OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 56396)
-- Name: solicitudes_movimientos_id_mov_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE solicitudes_movimientos_id_mov_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.solicitudes_movimientos_id_mov_seq OWNER TO postgres;

--
-- TOC entry 2222 (class 0 OID 0)
-- Dependencies: 187
-- Name: solicitudes_movimientos_id_mov_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE solicitudes_movimientos_id_mov_seq OWNED BY solicitudes_movimientos.id_mov;


--
-- TOC entry 188 (class 1259 OID 56398)
-- Name: status; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE status (
    id_status integer NOT NULL,
    name character varying(100) NOT NULL,
    date_created timestamp without time zone NOT NULL,
    date_updated timestamp without time zone NOT NULL
);


ALTER TABLE public.status OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 56401)
-- Name: tipo_espacio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo_espacio (
    id_tipo_espacio integer NOT NULL,
    nom_tipo_espacio character varying(50) NOT NULL,
    status integer DEFAULT 1 NOT NULL,
    date_created timestamp without time zone DEFAULT now(),
    date_updated timestamp without time zone DEFAULT now()
);


ALTER TABLE public.tipo_espacio OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 56407)
-- Name: tipo_espacio_id_tipo_espacio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipo_espacio_id_tipo_espacio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_espacio_id_tipo_espacio_seq OWNER TO postgres;

--
-- TOC entry 2223 (class 0 OID 0)
-- Dependencies: 190
-- Name: tipo_espacio_id_tipo_espacio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipo_espacio_id_tipo_espacio_seq OWNED BY tipo_espacio.id_tipo_espacio;


--
-- TOC entry 199 (class 1259 OID 56515)
-- Name: ubicaciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ubicaciones (
    id_ubi integer NOT NULL,
    nom_ubi character varying(100) NOT NULL,
    status integer DEFAULT 1 NOT NULL,
    date_created timestamp without time zone DEFAULT now() NOT NULL,
    date_updated timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.ubicaciones OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 56513)
-- Name: ubicacion_id_ubi_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ubicacion_id_ubi_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ubicacion_id_ubi_seq OWNER TO postgres;

--
-- TOC entry 2224 (class 0 OID 0)
-- Dependencies: 198
-- Name: ubicacion_id_ubi_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ubicacion_id_ubi_seq OWNED BY ubicaciones.id_ubi;


--
-- TOC entry 191 (class 1259 OID 56409)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 56416)
-- Name: users_data; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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
    image character varying(100),
    id_ubi integer
);


ALTER TABLE public.users_data OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 56425)
-- Name: users_id_user_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_id_user_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_user_seq OWNER TO postgres;

--
-- TOC entry 2225 (class 0 OID 0)
-- Dependencies: 193
-- Name: users_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_user_seq OWNED BY users.id_user;


--
-- TOC entry 194 (class 1259 OID 56427)
-- Name: ut; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ut (
    id_ut integer NOT NULL,
    date_created timestamp without time zone DEFAULT now() NOT NULL,
    date_updated timestamp without time zone DEFAULT now() NOT NULL,
    valor numeric(10,2)
);


ALTER TABLE public.ut OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 56432)
-- Name: ut_id_ut_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ut_id_ut_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ut_id_ut_seq OWNER TO postgres;

--
-- TOC entry 2226 (class 0 OID 0)
-- Dependencies: 195
-- Name: ut_id_ut_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ut_id_ut_seq OWNED BY ut.id_ut;


--
-- TOC entry 196 (class 1259 OID 56434)
-- Name: zona_ubicacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE zona_ubicacion (
    id_zona_ubicacion integer NOT NULL,
    des_zona_ubicacion character varying NOT NULL,
    status integer DEFAULT 1 NOT NULL,
    date_created timestamp without time zone DEFAULT now() NOT NULL,
    date_updated timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.zona_ubicacion OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 56443)
-- Name: zona_ubicacion_id_zona_ubicacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE zona_ubicacion_id_zona_ubicacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.zona_ubicacion_id_zona_ubicacion_seq OWNER TO postgres;

--
-- TOC entry 2227 (class 0 OID 0)
-- Dependencies: 197
-- Name: zona_ubicacion_id_zona_ubicacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE zona_ubicacion_id_zona_ubicacion_seq OWNED BY zona_ubicacion.id_zona_ubicacion;


--
-- TOC entry 1989 (class 2604 OID 56445)
-- Name: id_caracteristica; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caracteristicas ALTER COLUMN id_caracteristica SET DEFAULT nextval('caracteristicas_id_caracteristica_seq'::regclass);


--
-- TOC entry 1991 (class 2604 OID 56446)
-- Name: id_connection; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY connections_history ALTER COLUMN id_connection SET DEFAULT nextval('connections_history_id_connection_seq'::regclass);


--
-- TOC entry 1996 (class 2604 OID 56447)
-- Name: id_espacio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY espacios ALTER COLUMN id_espacio SET DEFAULT nextval('kioskos_id_espacio_seq'::regclass);


--
-- TOC entry 1992 (class 2604 OID 56448)
-- Name: id_espacios_imagenes; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY espacios_imagenes ALTER COLUMN id_espacios_imagenes SET DEFAULT nextval('espacio_imagenes_id_espacios_imagenes_seq'::regclass);


--
-- TOC entry 2000 (class 2604 OID 56449)
-- Name: id_parentesco; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parentescos ALTER COLUMN id_parentesco SET DEFAULT nextval('parentescos_id_parentesco_seq'::regclass);


--
-- TOC entry 2004 (class 2604 OID 56450)
-- Name: id_solicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes ALTER COLUMN id_solicitud SET DEFAULT nextval('solicitudes_id_solicitud_seq'::regclass);


--
-- TOC entry 2008 (class 2604 OID 56451)
-- Name: id_solinvi; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes_invitados ALTER COLUMN id_solinvi SET DEFAULT nextval('solicitudes_invitados_id_solinvi_seq'::regclass);


--
-- TOC entry 2010 (class 2604 OID 56452)
-- Name: id_mov; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes_movimientos ALTER COLUMN id_mov SET DEFAULT nextval('solicitudes_movimientos_id_mov_seq'::regclass);


--
-- TOC entry 2014 (class 2604 OID 56453)
-- Name: id_tipo_espacio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_espacio ALTER COLUMN id_tipo_espacio SET DEFAULT nextval('tipo_espacio_id_tipo_espacio_seq'::regclass);


--
-- TOC entry 2030 (class 2604 OID 56518)
-- Name: id_ubi; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ubicaciones ALTER COLUMN id_ubi SET DEFAULT nextval('ubicacion_id_ubi_seq'::regclass);


--
-- TOC entry 2019 (class 2604 OID 56454)
-- Name: id_user; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id_user SET DEFAULT nextval('users_id_user_seq'::regclass);


--
-- TOC entry 2025 (class 2604 OID 56455)
-- Name: id_ut; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ut ALTER COLUMN id_ut SET DEFAULT nextval('ut_id_ut_seq'::regclass);


--
-- TOC entry 2029 (class 2604 OID 56456)
-- Name: id_zona_ubicacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY zona_ubicacion ALTER COLUMN id_zona_ubicacion SET DEFAULT nextval('zona_ubicacion_id_zona_ubicacion_seq'::regclass);


--
-- TOC entry 2179 (class 0 OID 56337)
-- Dependencies: 171
-- Data for Name: caracteristicas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2228 (class 0 OID 0)
-- Dependencies: 172
-- Name: caracteristicas_id_caracteristica_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('caracteristicas_id_caracteristica_seq', 1, false);


--
-- TOC entry 2181 (class 0 OID 56343)
-- Dependencies: 173
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
INSERT INTO connections_history VALUES (30, 7, 'admin', '127.0.0.1', '2016-09-29 20:34:16.057373');
INSERT INTO connections_history VALUES (31, 7, 'admin', '127.0.0.1', '2016-09-30 20:33:01.799887');
INSERT INTO connections_history VALUES (32, 7, 'admin', '127.0.0.1', '2016-09-30 21:11:31.755154');
INSERT INTO connections_history VALUES (33, 7, 'admin', '127.0.0.1', '2016-10-01 09:34:38.980724');
INSERT INTO connections_history VALUES (34, 7, 'admin', '127.0.0.1', '2016-10-01 22:44:17.001785');


--
-- TOC entry 2229 (class 0 OID 0)
-- Dependencies: 174
-- Name: connections_history_id_connection_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('connections_history_id_connection_seq', 34, true);


--
-- TOC entry 2230 (class 0 OID 0)
-- Dependencies: 176
-- Name: espacio_imagenes_id_espacios_imagenes_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('espacio_imagenes_id_espacios_imagenes_seq', 136, true);


--
-- TOC entry 2185 (class 0 OID 56354)
-- Dependencies: 177
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
INSERT INTO espacios VALUES (2, 'KIOSCO 2', 'KIOSCO 2', 1, 2, 10, 1, 1, '2016-09-11 19:30:48.129466', '2016-09-19 18:40:57.522246');


--
-- TOC entry 2186 (class 0 OID 56360)
-- Dependencies: 178
-- Data for Name: espacios_caracteristicas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2183 (class 0 OID 56349)
-- Dependencies: 175
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
-- TOC entry 2231 (class 0 OID 0)
-- Dependencies: 179
-- Name: kioskos_id_espacio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('kioskos_id_espacio_seq', 12, true);


--
-- TOC entry 2188 (class 0 OID 56365)
-- Dependencies: 180
-- Data for Name: parentescos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO parentescos VALUES (1, 'Conocido(a)', 1, '2016-09-29 20:52:14.464282', '2016-09-29 20:52:14.464282');
INSERT INTO parentescos VALUES (2, 'Familiar', 1, '2016-09-29 20:52:30.392811', '2016-09-29 20:52:30.392811');


--
-- TOC entry 2232 (class 0 OID 0)
-- Dependencies: 181
-- Name: parentescos_id_parentesco_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('parentescos_id_parentesco_seq', 2, true);


--
-- TOC entry 2190 (class 0 OID 56373)
-- Dependencies: 182
-- Data for Name: solicitudes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO solicitudes VALUES (17, 1, 1, 1, 7, '2016-09-10', 8, '2016-09-20 11:46:12', '2016-09-23 22:57:29', 1770.00, 177.00, 10, NULL, NULL, NULL);
INSERT INTO solicitudes VALUES (18, 1, 1, 1, 7, '2016-09-27', 7, '2016-09-20 11:49:54', '2016-09-30 21:19:38', 1770.00, 177.00, 10, 'dkjfghkjdfhgkhdjf', '2016-09-23', NULL);
INSERT INTO solicitudes VALUES (19, 1, 1, 1, 7, '2016-10-01', 7, '2016-09-30 21:22:02', '2016-09-30 21:37:41', 1770.00, 177.00, 10, 'ttttttttttt', '2016-09-30', NULL);
INSERT INTO solicitudes VALUES (20, 9, 1, 1, 7, '2016-10-08', 7, '2016-10-01 09:36:26', '2016-10-01 09:41:02', 1770.00, 177.00, 10, 'gdfgdfgdf', '2016-10-27', NULL);
INSERT INTO solicitudes VALUES (21, 1, 1, 1, 7, '2016-10-30', 7, '2016-10-01 09:42:45', '2016-10-01 09:57:29', 1770.00, 177.00, 10, 'asdasdas', '2016-10-27', NULL);
INSERT INTO solicitudes VALUES (22, 2, 1, 1, 7, '2016-10-02', 7, '2016-10-01 10:03:59', '2016-10-01 10:09:43', 1770.00, 177.00, 10, '564564564564564565', '2016-10-27', NULL);
INSERT INTO solicitudes VALUES (23, 2, 1, 1, 7, '2016-10-01', 6, '2016-10-01 10:17:38', '2016-10-01 23:42:36', 1770.00, 177.00, 10, 'sadasdasdasdasdas', '2016-10-21', 'recibo_23.jpg');


--
-- TOC entry 2233 (class 0 OID 0)
-- Dependencies: 183
-- Name: solicitudes_id_solicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('solicitudes_id_solicitud_seq', 23, true);


--
-- TOC entry 2192 (class 0 OID 56381)
-- Dependencies: 184
-- Data for Name: solicitudes_invitados; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 55, '2016-09-29 22:57:49.493372', '2016-09-29 22:57:49.493372');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, 2, 41, '2016-09-30 20:33:37.992911', '2016-09-30 20:33:37.992911');
INSERT INTO solicitudes_invitados VALUES (18, 'V', '18020594', NULL, 'fffff', '77888', 'ffffff', NULL, 37, '2016-09-30 20:34:57.968907', '2016-09-30 20:34:57.968907');
INSERT INTO solicitudes_invitados VALUES (19, 'V', '18020594', 'Marcos', 'Arlindo', 'De Andrade', 'Carrera', 2, 56, '2016-09-30 21:37:26.393852', '2016-09-30 21:37:26.393852');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 38, '2016-09-29 22:57:44.086193', '2016-09-29 22:57:44.086193');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 39, '2016-09-29 22:57:44.255889', '2016-09-29 22:57:44.255889');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 40, '2016-09-29 22:57:44.447272', '2016-09-29 22:57:44.447272');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 42, '2016-09-29 22:57:47.52018', '2016-09-29 22:57:47.52018');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 43, '2016-09-29 22:57:47.65998', '2016-09-29 22:57:47.65998');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 44, '2016-09-29 22:57:47.804547', '2016-09-29 22:57:47.804547');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 45, '2016-09-29 22:57:47.948469', '2016-09-29 22:57:47.948469');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 46, '2016-09-29 22:57:48.118679', '2016-09-29 22:57:48.118679');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 47, '2016-09-29 22:57:48.258297', '2016-09-29 22:57:48.258297');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 48, '2016-09-29 22:57:48.398001', '2016-09-29 22:57:48.398001');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 49, '2016-09-29 22:57:48.554598', '2016-09-29 22:57:48.554598');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 50, '2016-09-29 22:57:48.718354', '2016-09-29 22:57:48.718354');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 51, '2016-09-29 22:57:48.869292', '2016-09-29 22:57:48.869292');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 52, '2016-09-29 22:57:49.030741', '2016-09-29 22:57:49.030741');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 53, '2016-09-29 22:57:49.182002', '2016-09-29 22:57:49.182002');
INSERT INTO solicitudes_invitados VALUES (18, 'V', NULL, NULL, NULL, NULL, NULL, NULL, 54, '2016-09-29 22:57:49.332223', '2016-09-29 22:57:49.332223');
INSERT INTO solicitudes_invitados VALUES (21, 'V', '18020594', 'Marcos', 'Arlindo', 'De Andrade', 'Carrera', NULL, 57, '2016-10-01 09:56:39.761644', '2016-10-01 09:56:39.761644');
INSERT INTO solicitudes_invitados VALUES (23, 'V', '18020594', 'MArcos', NULL, 'De Andrade', NULL, 1, 88, '2016-10-01 14:05:00.515017', '2016-10-01 14:05:00.515017');
INSERT INTO solicitudes_invitados VALUES (23, 'V', '123456', 'Hello', 'Hello', 'Hello', 'Hello', 2, 89, '2016-10-01 23:42:32.933813', '2016-10-01 23:42:32.933813');


--
-- TOC entry 2234 (class 0 OID 0)
-- Dependencies: 185
-- Name: solicitudes_invitados_id_solinvi_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('solicitudes_invitados_id_solinvi_seq', 89, true);


--
-- TOC entry 2194 (class 0 OID 56389)
-- Dependencies: 186
-- Data for Name: solicitudes_movimientos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO solicitudes_movimientos VALUES (12, 23, 3, '2016-10-01 13:54:11', 7, 'ggggggggggggggg');
INSERT INTO solicitudes_movimientos VALUES (16, 23, 5, '2016-10-01 14:06:24', 7, 'Observacion');
INSERT INTO solicitudes_movimientos VALUES (17, 23, 5, '2016-10-01 14:21:40', 7, 'Observacion');
INSERT INTO solicitudes_movimientos VALUES (18, 23, 5, '2016-10-01 14:22:00', 7, 'Observacion');
INSERT INTO solicitudes_movimientos VALUES (15, 23, 6, '2016-10-01 14:05:03', 7, '454545');
INSERT INTO solicitudes_movimientos VALUES (14, 23, 5, '2016-10-01 13:56:52', 7, '5454''''');
INSERT INTO solicitudes_movimientos VALUES (13, 23, 4, '2016-10-01 13:56:13', 7, '4545454');
INSERT INTO solicitudes_movimientos VALUES (11, 23, 5, '2016-10-01 13:53:08', 7, '4545');
INSERT INTO solicitudes_movimientos VALUES (10, 23, 5, '2016-10-01 13:52:43', 7, '454545');
INSERT INTO solicitudes_movimientos VALUES (19, 23, 6, '2016-10-01 14:26:10', 7, NULL);
INSERT INTO solicitudes_movimientos VALUES (20, 23, 6, '2016-10-01 14:27:09', 7, NULL);
INSERT INTO solicitudes_movimientos VALUES (21, 23, 5, '2016-10-01 14:27:34', 7, 'Debe cargar todos los invitados');
INSERT INTO solicitudes_movimientos VALUES (22, 23, 6, '2016-10-01 14:31:35', 7, NULL);
INSERT INTO solicitudes_movimientos VALUES (23, 23, 5, '2016-10-01 23:41:58', 7, '');
INSERT INTO solicitudes_movimientos VALUES (24, 23, 6, '2016-10-01 23:42:36', 7, NULL);


--
-- TOC entry 2235 (class 0 OID 0)
-- Dependencies: 187
-- Name: solicitudes_movimientos_id_mov_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('solicitudes_movimientos_id_mov_seq', 24, true);


--
-- TOC entry 2196 (class 0 OID 56398)
-- Dependencies: 188
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
-- TOC entry 2197 (class 0 OID 56401)
-- Dependencies: 189
-- Data for Name: tipo_espacio; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipo_espacio VALUES (2, 'tipo prueba 2', 1, '2016-09-15 18:58:28.334524', '2016-09-15 18:58:46.612327');
INSERT INTO tipo_espacio VALUES (1, 'tipo de prueba', 1, '2016-09-15 18:53:00.5153', '2016-09-15 18:58:54.923235');


--
-- TOC entry 2236 (class 0 OID 0)
-- Dependencies: 190
-- Name: tipo_espacio_id_tipo_espacio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipo_espacio_id_tipo_espacio_seq', 2, true);


--
-- TOC entry 2237 (class 0 OID 0)
-- Dependencies: 198
-- Name: ubicacion_id_ubi_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ubicacion_id_ubi_seq', 1, true);


--
-- TOC entry 2207 (class 0 OID 56515)
-- Dependencies: 199
-- Data for Name: ubicaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO ubicaciones VALUES (1, 'DIRECCION DE TECNOLOGÍA', 1, '2016-10-01 22:48:42.576608', '2016-10-01 22:48:42.576608');


--
-- TOC entry 2199 (class 0 OID 56409)
-- Dependencies: 191
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO users VALUES (9, 'reporte', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, '2016-04-02 20:55:08', '2016-06-18 13:42:51', '', NULL, 'REP');
INSERT INTO users VALUES (10, 'admin2', '18bfddf1020067bbd33fad652bc8f1a59b2427ff8c7ebfd62bbfef6c2dddff49', 1, '2016-09-04 10:32:25', '2016-09-11 14:55:37.865733', NULL, NULL, 'ADM');
INSERT INTO users VALUES (1, 'mdeandrade', '18bfddf1020067bbd33fad652bc8f1a59b2427ff8c7ebfd62bbfef6c2dddff49', 1, '2016-04-02 20:55:08', '2016-10-01 13:59:10.915165', '', NULL, 'ADM');
INSERT INTO users VALUES (7, 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, '2016-05-08 11:51:43', '2016-10-01 13:59:12.301315', '', NULL, 'ADM');
INSERT INTO users VALUES (8, 'tamara', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, '2016-04-02 20:55:08', '2016-10-01 13:59:13.4353', '', NULL, 'SEC');


--
-- TOC entry 2200 (class 0 OID 56416)
-- Dependencies: 192
-- Data for Name: users_data; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO users_data VALUES (8, 'Marcos', 'arlindo', 'DE ANDRADE', 'CARRERA', 'V', '18020594', NULL, 'M', '04142695880', NULL, '2016-04-03 17:44:48', '2016-04-03 17:44:48', NULL, NULL);
INSERT INTO users_data VALUES (9, 'jean', 'maiker', 'de andrade', 'carrera ', 'V', '20303709', NULL, 'M', '04163030894', NULL, '2016-04-03 20:38:36', '2016-04-03 20:38:36', NULL, NULL);
INSERT INTO users_data VALUES (10, 'jean', 'maiker', 'de andrade', 'carrera', 'V', '20303709', NULL, 'M', '04163030894', NULL, '2016-04-03 20:50:13', '2016-04-03 20:50:22', NULL, NULL);
INSERT INTO users_data VALUES (1, 'MARCOS', 'ARLINDO', 'DE ANDRADE', 'CARRERA', 'V', '18020594', NULL, 'M', '04268141850', '04268141850', '2016-04-02 21:28:41', '2016-09-15 21:57:54.968835', 'mdeandrade.jpg', NULL);
INSERT INTO users_data VALUES (7, 'Marcos ', 'arlindo', 'DE ANDRADE', 'CARRERA', 'V', '18020594', NULL, 'M', '04268141850', '', '2016-04-03 17:41:26', '2016-10-01 23:07:01.636779', NULL, 1);


--
-- TOC entry 2238 (class 0 OID 0)
-- Dependencies: 193
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_user_seq', 1, false);


--
-- TOC entry 2202 (class 0 OID 56427)
-- Dependencies: 194
-- Data for Name: ut; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO ut VALUES (1, '2016-09-15 19:08:44.83429', '2016-09-15 19:08:44.83429', 177.00);


--
-- TOC entry 2239 (class 0 OID 0)
-- Dependencies: 195
-- Name: ut_id_ut_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ut_id_ut_seq', 1, true);


--
-- TOC entry 2204 (class 0 OID 56434)
-- Dependencies: 196
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
-- TOC entry 2240 (class 0 OID 0)
-- Dependencies: 197
-- Name: zona_ubicacion_id_zona_ubicacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('zona_ubicacion_id_zona_ubicacion_seq', 7, true);


--
-- TOC entry 2035 (class 2606 OID 56458)
-- Name: caracteristicas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY caracteristicas
    ADD CONSTRAINT caracteristicas_pkey PRIMARY KEY (id_caracteristica);


--
-- TOC entry 2037 (class 2606 OID 56460)
-- Name: connections_history_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY connections_history
    ADD CONSTRAINT connections_history_pkey PRIMARY KEY (id_connection);


--
-- TOC entry 2039 (class 2606 OID 56462)
-- Name: espacio_imagenes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY espacios_imagenes
    ADD CONSTRAINT espacio_imagenes_pkey PRIMARY KEY (id_espacios_imagenes);


--
-- TOC entry 2043 (class 2606 OID 56464)
-- Name: espacios_caracteristicas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY espacios_caracteristicas
    ADD CONSTRAINT espacios_caracteristicas_pkey PRIMARY KEY (id_espacio, id_caracteristica);


--
-- TOC entry 2041 (class 2606 OID 56466)
-- Name: kioskos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY espacios
    ADD CONSTRAINT kioskos_pkey PRIMARY KEY (id_espacio);


--
-- TOC entry 2045 (class 2606 OID 56468)
-- Name: parentescos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY parentescos
    ADD CONSTRAINT parentescos_pkey PRIMARY KEY (id_parentesco);


--
-- TOC entry 2049 (class 2606 OID 56470)
-- Name: solicitudes_invitados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY solicitudes_invitados
    ADD CONSTRAINT solicitudes_invitados_pkey PRIMARY KEY (id_solinvi);


--
-- TOC entry 2051 (class 2606 OID 56472)
-- Name: solicitudes_movimientos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY solicitudes_movimientos
    ADD CONSTRAINT solicitudes_movimientos_pkey PRIMARY KEY (id_mov);


--
-- TOC entry 2047 (class 2606 OID 56474)
-- Name: solicitudes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY solicitudes
    ADD CONSTRAINT solicitudes_pkey PRIMARY KEY (id_solicitud);


--
-- TOC entry 2053 (class 2606 OID 56476)
-- Name: status_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY status
    ADD CONSTRAINT status_pkey PRIMARY KEY (id_status);


--
-- TOC entry 2055 (class 2606 OID 56478)
-- Name: tipo_espacio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_espacio
    ADD CONSTRAINT tipo_espacio_pkey PRIMARY KEY (id_tipo_espacio);


--
-- TOC entry 2065 (class 2606 OID 56523)
-- Name: ubicacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ubicaciones
    ADD CONSTRAINT ubicacion_pkey PRIMARY KEY (id_ubi);


--
-- TOC entry 2059 (class 2606 OID 56480)
-- Name: users_data_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users_data
    ADD CONSTRAINT users_data_pkey PRIMARY KEY (id_user);


--
-- TOC entry 2057 (class 2606 OID 56482)
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id_user);


--
-- TOC entry 2061 (class 2606 OID 56484)
-- Name: ut_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ut
    ADD CONSTRAINT ut_pkey PRIMARY KEY (id_ut);


--
-- TOC entry 2063 (class 2606 OID 56486)
-- Name: zona_ubicacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY zona_ubicacion
    ADD CONSTRAINT zona_ubicacion_pkey PRIMARY KEY (id_zona_ubicacion);


--
-- TOC entry 2066 (class 2606 OID 56487)
-- Name: connections_history_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY connections_history
    ADD CONSTRAINT connections_history_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user);


--
-- TOC entry 2067 (class 2606 OID 56492)
-- Name: kioskos_id_tipo_espacio_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY espacios
    ADD CONSTRAINT kioskos_id_tipo_espacio_fkey FOREIGN KEY (id_tipo_espacio) REFERENCES tipo_espacio(id_tipo_espacio);


--
-- TOC entry 2068 (class 2606 OID 56497)
-- Name: solicitudes_invitados_id_parentesco_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes_invitados
    ADD CONSTRAINT solicitudes_invitados_id_parentesco_fkey FOREIGN KEY (id_parentesco) REFERENCES parentescos(id_parentesco);


--
-- TOC entry 2069 (class 2606 OID 56502)
-- Name: solicitudes_invitados_id_solicitud_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solicitudes_invitados
    ADD CONSTRAINT solicitudes_invitados_id_solicitud_fkey FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud);


--
-- TOC entry 2071 (class 2606 OID 56524)
-- Name: users_data_id_ubi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users_data
    ADD CONSTRAINT users_data_id_ubi_fkey FOREIGN KEY (id_ubi) REFERENCES ubicaciones(id_ubi);


--
-- TOC entry 2070 (class 2606 OID 56507)
-- Name: users_data_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users_data
    ADD CONSTRAINT users_data_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user);


--
-- TOC entry 2213 (class 0 OID 0)
-- Dependencies: 7
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2016-10-01 23:44:50 VET

--
-- PostgreSQL database dump complete
--

