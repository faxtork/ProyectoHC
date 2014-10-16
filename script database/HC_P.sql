--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: administrador; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE administrador (
    pk bigint NOT NULL,
    nombre character varying(50) NOT NULL,
    clave character varying(100) NOT NULL,
    contacto character varying(50),
    rut character varying(20) NOT NULL,
    administradorgeneral_fk bigint NOT NULL,
    facultad_fk integer NOT NULL,
    descripcion text
);


ALTER TABLE public.administrador OWNER TO sesparza;

--
-- Name: administradorgeneral; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE administradorgeneral (
    pk integer NOT NULL,
    nombre character varying(50) NOT NULL,
    clave character varying(100) NOT NULL,
    contacto character varying(50),
    rut character varying(20) NOT NULL,
    descripcion text,
    administradorgeneral_fk integer NOT NULL
);


ALTER TABLE public.administradorgeneral OWNER TO sesparza;

--
-- Name: administradorGeneral_pk_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE "administradorGeneral_pk_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."administradorGeneral_pk_seq" OWNER TO sesparza;

--
-- Name: administradorGeneral_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE "administradorGeneral_pk_seq" OWNED BY administradorgeneral.pk;


--
-- Name: administrador_grado_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE administrador_grado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.administrador_grado_seq OWNER TO sesparza;

--
-- Name: administrador_grado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE administrador_grado_seq OWNED BY administrador.facultad_fk;


--
-- Name: administrador_pk_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE administrador_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.administrador_pk_seq OWNER TO sesparza;

--
-- Name: administrador_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE administrador_pk_seq OWNED BY administrador.pk;


--
-- Name: asignaturas; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE asignaturas (
    pk bigint NOT NULL,
    departamento_fk integer NOT NULL,
    codigo character varying(8) NOT NULL,
    nombre character varying(50) NOT NULL,
    descripcion text
);


ALTER TABLE public.asignaturas OWNER TO sesparza;

--
-- Name: asignaturas_pk_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE asignaturas_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.asignaturas_pk_seq OWNER TO sesparza;

--
-- Name: asignaturas_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE asignaturas_pk_seq OWNED BY asignaturas.pk;


--
-- Name: asistencia; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE asistencia (
    pk bigint NOT NULL,
    firma integer,
    fecha date DEFAULT now() NOT NULL,
    docente_fk integer NOT NULL
);


ALTER TABLE public.asistencia OWNER TO sesparza;

--
-- Name: bitacora; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE bitacora (
    pk integer NOT NULL,
    ip character varying NOT NULL,
    fecha date DEFAULT now() NOT NULL,
    administrador_fk bigint NOT NULL
);


ALTER TABLE public.bitacora OWNER TO sesparza;

--
-- Name: bitacora_pk_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE bitacora_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bitacora_pk_seq OWNER TO sesparza;

--
-- Name: bitacora_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE bitacora_pk_seq OWNED BY bitacora.pk;


--
-- Name: codigocarrera; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE codigocarrera (
    pk integer NOT NULL,
    codigo character varying(10),
    carrera character varying(50),
    escuelas_fk integer
);


ALTER TABLE public.codigocarrera OWNER TO sesparza;

--
-- Name: cursos; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE cursos (
    pk bigint NOT NULL,
    semestre integer DEFAULT 0 NOT NULL,
    anio integer NOT NULL,
    asignatura_fk bigint NOT NULL,
    docente_fk bigint NOT NULL,
    seccion text NOT NULL
);


ALTER TABLE public.cursos OWNER TO sesparza;

--
-- Name: cursos_pk_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE cursos_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cursos_pk_seq OWNER TO sesparza;

--
-- Name: cursos_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE cursos_pk_seq OWNED BY cursos.pk;


--
-- Name: departamentos; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE departamentos (
    pk integer NOT NULL,
    facultad_fk integer NOT NULL,
    departamento character varying(50) NOT NULL,
    descripcion text
);


ALTER TABLE public.departamentos OWNER TO sesparza;

--
-- Name: departamentos_pk_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE departamentos_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.departamentos_pk_seq OWNER TO sesparza;

--
-- Name: departamentos_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE departamentos_pk_seq OWNED BY departamentos.pk;


--
-- Name: docentes; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE docentes (
    pk bigint NOT NULL,
    nombres character varying(50) NOT NULL,
    apellidos character varying(50) NOT NULL,
    rut character varying(20) NOT NULL,
    departamento_fk integer NOT NULL
);


ALTER TABLE public.docentes OWNER TO sesparza;

--
-- Name: docentes_pk_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE docentes_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.docentes_pk_seq OWNER TO sesparza;

--
-- Name: docentes_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE docentes_pk_seq OWNED BY docentes.pk;


--
-- Name: escuelas; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE escuelas (
    pk integer NOT NULL,
    departamento_fk integer NOT NULL,
    escuela character varying(50) NOT NULL,
    descripcion text
);


ALTER TABLE public.escuelas OWNER TO sesparza;

--
-- Name: escuelas_pk_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE escuelas_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.escuelas_pk_seq OWNER TO sesparza;

--
-- Name: escuelas_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE escuelas_pk_seq OWNED BY escuelas.pk;


--
-- Name: facultades; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE facultades (
    pk integer NOT NULL,
    facultad character varying NOT NULL,
    descripcion text
);


ALTER TABLE public.facultades OWNER TO sesparza;

--
-- Name: facultades_pk_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE facultades_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.facultades_pk_seq OWNER TO sesparza;

--
-- Name: facultades_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE facultades_pk_seq OWNED BY facultades.pk;


--
-- Name: periodos; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE periodos (
    pk integer NOT NULL,
    numero integer NOT NULL,
    periodo character varying(50) NOT NULL,
    inicio time without time zone NOT NULL,
    termino time without time zone NOT NULL
);


ALTER TABLE public.periodos OWNER TO sesparza;

--
-- Name: periodos_pk_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE periodos_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.periodos_pk_seq OWNER TO sesparza;

--
-- Name: periodos_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE periodos_pk_seq OWNED BY periodos.pk;


--
-- Name: reservas; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE reservas (
    pk bigint NOT NULL,
    fecha date NOT NULL,
    sala_fk integer NOT NULL,
    periodo_fk integer NOT NULL,
    curso_fk bigint NOT NULL,
    adm_fk bigint,
    estado text
);


ALTER TABLE public.reservas OWNER TO sesparza;

--
-- Name: reservas_pk_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE reservas_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reservas_pk_seq OWNER TO sesparza;

--
-- Name: reservas_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE reservas_pk_seq OWNED BY reservas.pk;


--
-- Name: salas; Type: TABLE; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE TABLE salas (
    pk integer NOT NULL,
    facultad_fk integer NOT NULL,
    sala character varying(50) NOT NULL,
    estado boolean DEFAULT true,
    descripcion text DEFAULT 'apta para el uso'::text
);


ALTER TABLE public.salas OWNER TO sesparza;

--
-- Name: salas_pk_seq; Type: SEQUENCE; Schema: public; Owner: sesparza
--

CREATE SEQUENCE salas_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.salas_pk_seq OWNER TO sesparza;

--
-- Name: salas_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sesparza
--

ALTER SEQUENCE salas_pk_seq OWNED BY salas.pk;


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY administrador ALTER COLUMN pk SET DEFAULT nextval('administrador_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY administradorgeneral ALTER COLUMN pk SET DEFAULT nextval('"administradorGeneral_pk_seq"'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY asignaturas ALTER COLUMN pk SET DEFAULT nextval('asignaturas_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY bitacora ALTER COLUMN pk SET DEFAULT nextval('bitacora_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY cursos ALTER COLUMN pk SET DEFAULT nextval('cursos_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY departamentos ALTER COLUMN pk SET DEFAULT nextval('departamentos_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY docentes ALTER COLUMN pk SET DEFAULT nextval('docentes_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY escuelas ALTER COLUMN pk SET DEFAULT nextval('escuelas_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY facultades ALTER COLUMN pk SET DEFAULT nextval('facultades_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY periodos ALTER COLUMN pk SET DEFAULT nextval('periodos_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY reservas ALTER COLUMN pk SET DEFAULT nextval('reservas_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY salas ALTER COLUMN pk SET DEFAULT nextval('salas_pk_seq'::regclass);


--
-- Data for Name: administrador; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO administrador VALUES (1, 'jose', '1ec4ed037766aa181d8840ad04b9fc6e195fd37dedc04c98a5767a67d3758ece', 'jose@utem.cl', '21776304-5', 1, 1, 'usuario administrador');
INSERT INTO administrador VALUES (48, 'jose2', 'b8b9b90248616b9e6e3db1c619da7a6a83ae9001b74ecfb5d3041fbbdffa8958', '', '21.898.784-2', 1, 2, 'usuario administrador');


--
-- Name: administradorGeneral_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('"administradorGeneral_pk_seq"', 4, true);


--
-- Name: administrador_grado_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('administrador_grado_seq', 2, true);


--
-- Name: administrador_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('administrador_pk_seq', 48, true);


--
-- Data for Name: administradorgeneral; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO administradorgeneral VALUES (1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin@admin.cl', '15.458.819-8', 'administrador general gente de sisei', 1);
INSERT INTO administradorgeneral VALUES (4, 'i', 'de7d1b721a1e0632b7cf04edf5032c8ecffa9f9a08492152b926f1a5a7e765d7', 'i', '24.587.215-1', 'Administrador General', 1);


--
-- Data for Name: asignaturas; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO asignaturas VALUES (104, 1, 'INF-762', 'Computacion Paralela', '');
INSERT INTO asignaturas VALUES (93, 1, 'INF-648', 'Analisis de Algoritmo', '');
INSERT INTO asignaturas VALUES (34, 1, 'INF-626', 'Lenguaje de Expresiones', '');
INSERT INTO asignaturas VALUES (55, 1, 'INF-642', 'Lenguaje de Programacion', '');
INSERT INTO asignaturas VALUES (111, 1, 'INF-752', 'Gestion Financiera de TI', '');
INSERT INTO asignaturas VALUES (82, 1, 'INF-653', 'Simulacion de Sistemas', '');
INSERT INTO asignaturas VALUES (103, 1, 'INF-750', 'Optimizacion de Sistemas', '');
INSERT INTO asignaturas VALUES (73, 1, 'INF-644', 'Teorias Automatas', '');
INSERT INTO asignaturas VALUES (1, 1, 'EFE', 'Computacion Movil', '');
INSERT INTO asignaturas VALUES (105, 1, 'INF-658', 'Auditoria de Sistemas', '');
INSERT INTO asignaturas VALUES (65, 1, 'INF-631', 'Bases de Datos', '');
INSERT INTO asignaturas VALUES (2, 17, 'MATPC601', 'Álgebra', '');
INSERT INTO asignaturas VALUES (3, 17, 'MATPC605', 'Álgebra Lineal', '');


--
-- Name: asignaturas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('asignaturas_pk_seq', 3, true);


--
-- Data for Name: asistencia; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO asistencia VALUES (1, 1, '2014-06-04', 1);


--
-- Data for Name: bitacora; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO bitacora VALUES (1, '192.168.0.1', '2014-06-04', 1);


--
-- Name: bitacora_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('bitacora_pk_seq', 1, false);


--
-- Data for Name: codigocarrera; Type: TABLE DATA; Schema: public; Owner: sesparza
--



--
-- Data for Name: cursos; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO cursos VALUES (52, 2, 2014, 111, 13, '2');
INSERT INTO cursos VALUES (58, 2, 2014, 73, 3, '411');
INSERT INTO cursos VALUES (59, 2, 2014, 104, 4, '2');
INSERT INTO cursos VALUES (62, 2, 2014, 34, 13, '1a');
INSERT INTO cursos VALUES (63, 2, 2014, 65, 10, '22');
INSERT INTO cursos VALUES (64, 2, 2014, 65, 9, '4122');
INSERT INTO cursos VALUES (65, 2, 2014, 104, 14, '2');
INSERT INTO cursos VALUES (45, 2, 2014, 104, 9, '2');
INSERT INTO cursos VALUES (46, 2, 2014, 3, 16, '1');
INSERT INTO cursos VALUES (49, 2, 2014, 34, 13, '1');
INSERT INTO cursos VALUES (50, 2, 2014, 34, 19, '1');
INSERT INTO cursos VALUES (51, 2, 2014, 34, 17, '2');
INSERT INTO cursos VALUES (53, 2, 2014, 34, 11, '1');
INSERT INTO cursos VALUES (54, 2, 2014, 34, 13, '1');
INSERT INTO cursos VALUES (55, 2, 2014, 34, 15, '1');
INSERT INTO cursos VALUES (56, 2, 2014, 65, 17, '2');
INSERT INTO cursos VALUES (57, 2, 2014, 65, 17, '2');
INSERT INTO cursos VALUES (60, 2, 2014, 73, 3, '411');
INSERT INTO cursos VALUES (61, 2, 2014, 82, 12, '412');
INSERT INTO cursos VALUES (43, 2, 2014, 73, 3, '411');
INSERT INTO cursos VALUES (66, 2, 2014, 111, 8, '22');
INSERT INTO cursos VALUES (67, 2, 2014, 1, 7, 'xd');


--
-- Name: cursos_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('cursos_pk_seq', 67, true);


--
-- Data for Name: departamentos; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO departamentos VALUES (2, 1, 'Industria', '');
INSERT INTO departamentos VALUES (1, 1, 'Informática y Computación', '');
INSERT INTO departamentos VALUES (7, 1, 'Electricidad', '');
INSERT INTO departamentos VALUES (8, 1, 'Mecánica', '');
INSERT INTO departamentos VALUES (9, 2, 'Gestión Organizacional', '');
INSERT INTO departamentos VALUES (10, 2, 'Economía, Recursos Naturales y Comercio Inter.', '');
INSERT INTO departamentos VALUES (11, 2, 'Contabilidad y Gestión Financiera', '');
INSERT INTO departamentos VALUES (12, 2, 'Gestión de la Información', '');
INSERT INTO departamentos VALUES (13, 2, 'Estadística y Econometría', '');
INSERT INTO departamentos VALUES (14, 4, 'Prevención de Riesgos y Medio Ambiente', '');
INSERT INTO departamentos VALUES (15, 4, 'Ciencias de la Construcción', '');
INSERT INTO departamentos VALUES (16, 4, 'Planificación y Ordenamiento Territorial', '');
INSERT INTO departamentos VALUES (17, 1, 'Ciencias', 'plan comun de Ingeniería');


--
-- Name: departamentos_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('departamentos_pk_seq', 17, true);


--
-- Data for Name: docentes; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO docentes VALUES (1, 'Mauro', 'Castillo Valdes', '001', 1);
INSERT INTO docentes VALUES (2, 'Francisco Alberto ', 'Cofré Gajardo', '002', 1);
INSERT INTO docentes VALUES (3, 'Ricardo Osvaldo', 'Corbinaud Perez', '003', 1);
INSERT INTO docentes VALUES (4, 'Victor Heughes', 'Escobar Jeria', '004', 1);
INSERT INTO docentes VALUES (5, 'Oscar', 'Magna Veloso', '005', 1);
INSERT INTO docentes VALUES (6, 'Patricia', 'Mellado Acevedo', '006', 1);
INSERT INTO docentes VALUES (7, 'Rene', 'Peña Aguilar', '007', 1);
INSERT INTO docentes VALUES (8, 'Héctor Manuel', 'Pincheira Conejeros', '008', 1);
INSERT INTO docentes VALUES (9, 'Sara', 'Rojas Aldea', '009', 1);
INSERT INTO docentes VALUES (10, 'Marta', 'Rojas Estay', '010', 1);
INSERT INTO docentes VALUES (11, 'Maria Victoria', 'Vallejos Amado', '011', 1);
INSERT INTO docentes VALUES (13, 'Alejandro', 'Reyes', '013', 1);
INSERT INTO docentes VALUES (14, 'Sergio', 'Muñoz', '014', 1);
INSERT INTO docentes VALUES (15, 'Jorge', 'Pavez', '015', 1);
INSERT INTO docentes VALUES (16, 'Jorge', 'Morris', '016', 1);
INSERT INTO docentes VALUES (17, 'Rene', 'Peña', '017', 1);
INSERT INTO docentes VALUES (12, 'Santiago', 'Zapata Caceres', '17.680.010-0', 1);
INSERT INTO docentes VALUES (19, 'NN', 'NN', 'NN', 1);
INSERT INTO docentes VALUES (22, 'NN', 'NN', '', 9);
INSERT INTO docentes VALUES (18, 'Tibor', 'Valdebenito Gutierrez', '6.897.604-9', 8);


--
-- Name: docentes_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('docentes_pk_seq', 22, true);


--
-- Data for Name: escuelas; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO escuelas VALUES (2, 2, 'Industria y Civil industrial', '');
INSERT INTO escuelas VALUES (1, 1, 'Informática', 'Carreras ingenieria en informatica y civil en computacion');
INSERT INTO escuelas VALUES (3, 7, 'Electrónica', '');
INSERT INTO escuelas VALUES (4, 8, 'Mecánica', '');


--
-- Name: escuelas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('escuelas_pk_seq', 4, true);


--
-- Data for Name: facultades; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO facultades VALUES (1, 'Ingenieria', 'La Facultad de Ingeniería está ubicada en el Campus Macul, en Av. José Pedro Alessandri 1242, Ñuñoa, Santiago.');
INSERT INTO facultades VALUES (2, 'Adm. y Economía', 'La Facultad de Administración y Economía está ubicada en el Campus Providencia en Dr. Hernán Alessandri 722, Providencia, Metro Salvador.');
INSERT INTO facultades VALUES (4, 'Humanidades', 'La Facultad de Ciencias de la Construcción y Ordenamiento Territorial está ubicada en el Campus Área Central en la calle Dieciocho 390 Santiago Centro, Metro Toesca.');
INSERT INTO facultades VALUES (30, 'Ciencias', 'Fac. Ciencias Nat y Medio Ambiente');


--
-- Name: facultades_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('facultades_pk_seq', 38, true);


--
-- Data for Name: periodos; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO periodos VALUES (1, 1, '1', '08:00:00', '09:30:00');
INSERT INTO periodos VALUES (2, 2, '2', '09:40:00', '11:10:00');
INSERT INTO periodos VALUES (3, 3, '3', '11:20:00', '12:50:00');
INSERT INTO periodos VALUES (4, 4, '4', '13:00:00', '14:30:00');
INSERT INTO periodos VALUES (5, 5, '5', '14:40:00', '16:10:00');
INSERT INTO periodos VALUES (6, 6, '6', '16:20:00', '17:50:00');
INSERT INTO periodos VALUES (7, 7, '7', '18:00:00', '19:30:00');
INSERT INTO periodos VALUES (8, 8, '8', '19:00:00', '20:30:00');
INSERT INTO periodos VALUES (9, 9, '9', '20:40:00', '22:10:00');


--
-- Name: periodos_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('periodos_pk_seq', 1, false);


--
-- Data for Name: reservas; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO reservas VALUES (68, '2014-07-07', 1, 1, 43, 1, NULL);
INSERT INTO reservas VALUES (69, '2014-08-19', 14, 2, 45, 1, NULL);
INSERT INTO reservas VALUES (70, '2014-08-21', 14, 2, 45, 1, NULL);
INSERT INTO reservas VALUES (71, '2014-08-21', 14, 3, 45, 1, NULL);
INSERT INTO reservas VALUES (72, '2014-08-21', 14, 2, 46, 1, NULL);
INSERT INTO reservas VALUES (73, '2014-08-25', 14, 1, 49, 1, NULL);
INSERT INTO reservas VALUES (74, '2014-08-27', 14, 1, 49, 1, NULL);
INSERT INTO reservas VALUES (75, '2014-08-28', 14, 1, 49, 1, NULL);
INSERT INTO reservas VALUES (76, '2014-08-25', 17, 1, 50, 1, NULL);
INSERT INTO reservas VALUES (77, '2014-08-27', 17, 1, 50, 1, NULL);
INSERT INTO reservas VALUES (78, '2014-08-29', 17, 1, 50, 1, NULL);
INSERT INTO reservas VALUES (79, '2014-09-01', 18, 1, 52, 1, NULL);
INSERT INTO reservas VALUES (80, '2014-09-03', 9, 1, 53, 1, NULL);
INSERT INTO reservas VALUES (81, '2014-09-04', 9, 1, 53, 1, NULL);
INSERT INTO reservas VALUES (82, '2014-09-05', 9, 1, 53, 1, NULL);
INSERT INTO reservas VALUES (83, '2014-09-03', 11, 1, 55, 1, NULL);
INSERT INTO reservas VALUES (87, '2014-09-03', 8, 2, 57, 1, NULL);
INSERT INTO reservas VALUES (88, '2014-09-04', 8, 2, 57, 1, NULL);
INSERT INTO reservas VALUES (89, '2014-09-05', 8, 2, 57, 1, NULL);
INSERT INTO reservas VALUES (90, '2014-09-08', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (91, '2014-09-15', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (92, '2014-09-22', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (94, '2014-10-06', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (95, '2014-10-13', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (96, '2014-10-20', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (97, '2014-10-27', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (98, '2014-11-03', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (99, '2014-11-10', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (100, '2014-11-17', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (101, '2014-11-24', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (102, '2014-12-01', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (103, '2014-12-08', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (104, '2014-12-15', 16, 1, 58, 1, NULL);
INSERT INTO reservas VALUES (105, '2014-09-08', 2, 2, 59, 1, NULL);
INSERT INTO reservas VALUES (106, '2014-09-17', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (107, '2014-09-19', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (108, '2014-09-24', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (109, '2014-09-26', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (110, '2014-10-01', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (111, '2014-10-03', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (112, '2014-10-08', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (113, '2014-10-10', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (114, '2014-10-15', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (115, '2014-10-17', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (116, '2014-10-22', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (117, '2014-10-24', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (118, '2014-10-29', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (119, '2014-10-31', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (120, '2014-11-05', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (121, '2014-11-07', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (122, '2014-11-12', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (123, '2014-11-14', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (124, '2014-11-19', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (125, '2014-11-21', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (126, '2014-11-26', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (127, '2014-11-28', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (128, '2014-12-03', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (129, '2014-12-05', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (130, '2014-12-10', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (131, '2014-12-12', 3, 1, 60, 1, NULL);
INSERT INTO reservas VALUES (132, '2014-09-19', 9, 1, 61, 1, NULL);
INSERT INTO reservas VALUES (133, '2014-09-26', 9, 1, 61, 1, NULL);
INSERT INTO reservas VALUES (134, '2014-10-03', 9, 1, 61, 1, NULL);
INSERT INTO reservas VALUES (135, '2014-09-16', 27, 2, 62, 1, NULL);
INSERT INTO reservas VALUES (136, '2014-09-18', 27, 2, 62, 1, NULL);
INSERT INTO reservas VALUES (137, '2014-09-18', 27, 3, 62, 1, NULL);
INSERT INTO reservas VALUES (138, '2014-09-23', 27, 2, 62, 1, NULL);
INSERT INTO reservas VALUES (141, '2014-09-16', 20, 8, 63, 1, NULL);
INSERT INTO reservas VALUES (142, '2014-09-16', 20, 9, 63, 1, NULL);
INSERT INTO reservas VALUES (143, '2014-09-16', 21, 9, 64, 1, NULL);
INSERT INTO reservas VALUES (93, '2014-09-29', 16, 1, 43, 1, NULL);
INSERT INTO reservas VALUES (145, '2014-09-23', 20, 2, 66, 1, NULL);
INSERT INTO reservas VALUES (139, '2014-09-25', 27, 2, 62, 1, NULL);
INSERT INTO reservas VALUES (140, '2014-09-25', 27, 3, 62, 1, NULL);


--
-- Name: reservas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('reservas_pk_seq', 145, true);


--
-- Data for Name: salas; Type: TABLE DATA; Schema: public; Owner: sesparza
--

INSERT INTO salas VALUES (5, 1, 'M1-305', true, 'apta para el uso');
INSERT INTO salas VALUES (6, 1, 'M1-306', true, 'apta para el uso');
INSERT INTO salas VALUES (7, 1, 'M1-307', true, 'apta para el uso');
INSERT INTO salas VALUES (8, 1, 'M2-201', true, 'apta para el uso');
INSERT INTO salas VALUES (9, 1, 'M2-202', true, 'apta para el uso');
INSERT INTO salas VALUES (10, 1, 'M2-203', true, 'apta para el uso');
INSERT INTO salas VALUES (11, 1, 'M2-204', true, 'apta para el uso');
INSERT INTO salas VALUES (12, 1, 'M2-301', true, 'apta para el uso');
INSERT INTO salas VALUES (13, 1, 'M2-302', true, 'apta para el uso');
INSERT INTO salas VALUES (14, 1, 'M2-303', true, 'apta para el uso');
INSERT INTO salas VALUES (15, 1, 'M2-304', true, 'apta para el uso');
INSERT INTO salas VALUES (16, 1, 'M3-101', true, 'apta para el uso');
INSERT INTO salas VALUES (17, 1, 'M3-102', true, 'apta para el uso');
INSERT INTO salas VALUES (18, 1, 'M3-103', true, 'apta para el uso');
INSERT INTO salas VALUES (19, 1, 'M3-104', true, 'apta para el uso');
INSERT INTO salas VALUES (20, 1, 'M3-201', true, 'apta para el uso');
INSERT INTO salas VALUES (21, 1, 'M3-202', true, 'apta para el uso');
INSERT INTO salas VALUES (22, 1, 'M3-203', true, 'apta para el uso');
INSERT INTO salas VALUES (23, 1, 'M3-204', true, 'apta para el uso');
INSERT INTO salas VALUES (24, 1, 'M3-301', true, 'apta para el uso');
INSERT INTO salas VALUES (25, 1, 'M3-303', true, 'apta para el uso');
INSERT INTO salas VALUES (26, 1, 'M3-304', true, 'apta para el uso');
INSERT INTO salas VALUES (27, 1, 'M3-400', true, 'apta para el uso');
INSERT INTO salas VALUES (28, 1, 'M3-402', true, 'apta para el uso');
INSERT INTO salas VALUES (29, 1, 'M6-205', true, 'apta para el uso');
INSERT INTO salas VALUES (30, 1, 'M6-206', true, 'apta para el uso');
INSERT INTO salas VALUES (31, 1, 'M6-209', true, 'apta para el uso');
INSERT INTO salas VALUES (32, 1, 'M6-210', true, 'apta para el uso');
INSERT INTO salas VALUES (33, 1, 'M6-212', true, 'apta para el uso');
INSERT INTO salas VALUES (34, 1, 'M6-214', true, 'apta para el uso');
INSERT INTO salas VALUES (35, 1, 'M6-325', true, 'apta para el uso');
INSERT INTO salas VALUES (36, 1, 'M6-326', true, 'apta para el uso');
INSERT INTO salas VALUES (37, 1, 'M6-327', true, 'apta para el uso');
INSERT INTO salas VALUES (38, 1, 'M6-330', true, 'apta para el uso');
INSERT INTO salas VALUES (39, 1, 'M6-331', true, 'apta para el uso');
INSERT INTO salas VALUES (41, 1, 'Lab-1', true, 'apta para el uso');
INSERT INTO salas VALUES (42, 1, 'Lab-2', true, 'apta para el uso');
INSERT INTO salas VALUES (43, 1, 'Lab-3', true, 'apta para el uso');
INSERT INTO salas VALUES (44, 1, 'Lab-4', true, 'apta para el uso');
INSERT INTO salas VALUES (45, 1, 'Lab-5', true, 'apta para el uso');
INSERT INTO salas VALUES (46, 1, 'Lab-6', true, 'apta para el uso');
INSERT INTO salas VALUES (47, 1, 'Lab-7', true, 'apta para el uso');
INSERT INTO salas VALUES (48, 2, 'M7-402', true, 'apta para el uso');
INSERT INTO salas VALUES (4, 1, 'M1-304', true, 'apta para el uso');
INSERT INTO salas VALUES (3, 1, 'M1-303', true, 'apta para el uso');
INSERT INTO salas VALUES (2, 1, 'M1-302', true, 'apta para el uso');
INSERT INTO salas VALUES (1, 1, 'M1-301', false, 'bloqueada');


--
-- Name: salas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: sesparza
--

SELECT pg_catalog.setval('salas_pk_seq', 55, true);


--
-- Name: administradorGeneral_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY administradorgeneral
    ADD CONSTRAINT "administradorGeneral_pkey" PRIMARY KEY (pk);


--
-- Name: administrador_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY administrador
    ADD CONSTRAINT administrador_pkey PRIMARY KEY (pk);


--
-- Name: asignaturas_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY asignaturas
    ADD CONSTRAINT asignaturas_pkey PRIMARY KEY (pk);


--
-- Name: asistencia_docente_fk_key; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY asistencia
    ADD CONSTRAINT asistencia_docente_fk_key UNIQUE (docente_fk);


--
-- Name: asistencia_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY asistencia
    ADD CONSTRAINT asistencia_pkey PRIMARY KEY (pk);


--
-- Name: bitacora_administrador_fk_key; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY bitacora
    ADD CONSTRAINT bitacora_administrador_fk_key UNIQUE (administrador_fk);


--
-- Name: bitacora_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY bitacora
    ADD CONSTRAINT bitacora_pkey PRIMARY KEY (pk);


--
-- Name: codigocarrera_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY codigocarrera
    ADD CONSTRAINT codigocarrera_pkey PRIMARY KEY (pk);


--
-- Name: cursos_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY cursos
    ADD CONSTRAINT cursos_pkey PRIMARY KEY (pk);


--
-- Name: departamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (pk);


--
-- Name: docentes_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY docentes
    ADD CONSTRAINT docentes_pkey PRIMARY KEY (pk);


--
-- Name: docentes_rut_key; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY docentes
    ADD CONSTRAINT docentes_rut_key UNIQUE (rut);


--
-- Name: escuelas_escuela_key; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY escuelas
    ADD CONSTRAINT escuelas_escuela_key UNIQUE (escuela);


--
-- Name: escuelas_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY escuelas
    ADD CONSTRAINT escuelas_pkey PRIMARY KEY (pk);


--
-- Name: facultades_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY facultades
    ADD CONSTRAINT facultades_pkey PRIMARY KEY (pk);


--
-- Name: periodos_numero_key; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY periodos
    ADD CONSTRAINT periodos_numero_key UNIQUE (numero);


--
-- Name: periodos_periodo_key; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY periodos
    ADD CONSTRAINT periodos_periodo_key UNIQUE (periodo);


--
-- Name: periodos_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY periodos
    ADD CONSTRAINT periodos_pkey PRIMARY KEY (pk);


--
-- Name: reservas_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_pkey PRIMARY KEY (pk);


--
-- Name: salas_pkey; Type: CONSTRAINT; Schema: public; Owner: sesparza; Tablespace: 
--

ALTER TABLE ONLY salas
    ADD CONSTRAINT salas_pkey PRIMARY KEY (pk);


--
-- Name: asignaturas_codigo_nombre_key; Type: INDEX; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE UNIQUE INDEX asignaturas_codigo_nombre_key ON asignaturas USING btree (codigo, nombre);


--
-- Name: salas_facultad_fk_sala_key; Type: INDEX; Schema: public; Owner: sesparza; Tablespace: 
--

CREATE UNIQUE INDEX salas_facultad_fk_sala_key ON salas USING btree (facultad_fk, sala);


--
-- Name: administradorGeneral_administradorGeneral_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY administradorgeneral
    ADD CONSTRAINT "administradorGeneral_administradorGeneral_fk_fkey" FOREIGN KEY (administradorgeneral_fk) REFERENCES administradorgeneral(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: administrador_administradorGeneral_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY administrador
    ADD CONSTRAINT "administrador_administradorGeneral_fk_fkey" FOREIGN KEY (administradorgeneral_fk) REFERENCES administradorgeneral(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: administrador_facultad_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY administrador
    ADD CONSTRAINT administrador_facultad_fk_fkey FOREIGN KEY (facultad_fk) REFERENCES facultades(pk);


--
-- Name: asignaturas_departamento_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY asignaturas
    ADD CONSTRAINT asignaturas_departamento_fk_fkey FOREIGN KEY (departamento_fk) REFERENCES departamentos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: asistencia_docente_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY asistencia
    ADD CONSTRAINT asistencia_docente_fk_fkey FOREIGN KEY (docente_fk) REFERENCES docentes(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: bitacora_administrador_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY bitacora
    ADD CONSTRAINT bitacora_administrador_fk_fkey FOREIGN KEY (administrador_fk) REFERENCES administrador(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: codigocarrera_escuelas_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY codigocarrera
    ADD CONSTRAINT codigocarrera_escuelas_fk_fkey FOREIGN KEY (escuelas_fk) REFERENCES escuelas(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cursos_asignatura_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY cursos
    ADD CONSTRAINT cursos_asignatura_fk_fkey FOREIGN KEY (asignatura_fk) REFERENCES asignaturas(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cursos_docente_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY cursos
    ADD CONSTRAINT cursos_docente_fk_fkey FOREIGN KEY (docente_fk) REFERENCES docentes(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: departamentos_facultad_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamentos_facultad_fk_fkey FOREIGN KEY (facultad_fk) REFERENCES facultades(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: docentes_departamento_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY docentes
    ADD CONSTRAINT docentes_departamento_fk_fkey FOREIGN KEY (departamento_fk) REFERENCES departamentos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: escuelas_departamento_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY escuelas
    ADD CONSTRAINT escuelas_departamento_fk_fkey FOREIGN KEY (departamento_fk) REFERENCES departamentos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reservas_adm_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_adm_fk_fkey FOREIGN KEY (adm_fk) REFERENCES administrador(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reservas_curso_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_curso_fk_fkey FOREIGN KEY (curso_fk) REFERENCES cursos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reservas_periodo_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_periodo_fk_fkey FOREIGN KEY (periodo_fk) REFERENCES periodos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reservas_sala_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_sala_fk_fkey FOREIGN KEY (sala_fk) REFERENCES salas(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: salas_facultad_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sesparza
--

ALTER TABLE ONLY salas
    ADD CONSTRAINT salas_facultad_fk_fkey FOREIGN KEY (facultad_fk) REFERENCES facultades(pk) ON UPDATE CASCADE ON DELETE CASCADE;


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

