--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

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
-- Name: administrador; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE administrador (
    pk bigint NOT NULL,
    nombre character varying(50) NOT NULL,
    clave character varying(50) NOT NULL,
    contacto character varying(50),
    rut character varying(20) NOT NULL
);


ALTER TABLE public.administrador OWNER TO postgres;

--
-- Name: administrador_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE administrador_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.administrador_pk_seq OWNER TO postgres;

--
-- Name: administrador_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE administrador_pk_seq OWNED BY administrador.pk;


--
-- Name: asignaturas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE asignaturas (
    pk bigint NOT NULL,
    departamento_fk integer NOT NULL,
    codigo character varying(8) NOT NULL,
    nombre character varying(50) NOT NULL,
    descripcion text
);


ALTER TABLE public.asignaturas OWNER TO postgres;

--
-- Name: asignaturas_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE asignaturas_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.asignaturas_pk_seq OWNER TO postgres;

--
-- Name: asignaturas_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE asignaturas_pk_seq OWNED BY asignaturas.pk;


--
-- Name: asistencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE asistencia (
    pk bigint NOT NULL,
    firma integer,
    fecha date DEFAULT now() NOT NULL,
    docente_fk integer NOT NULL
);


ALTER TABLE public.asistencia OWNER TO postgres;

--
-- Name: bitacora; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE bitacora (
    pk integer NOT NULL,
    ip character varying NOT NULL,
    fecha date DEFAULT now() NOT NULL,
    administrador_fk bigint NOT NULL
);


ALTER TABLE public.bitacora OWNER TO postgres;

--
-- Name: bitacora_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE bitacora_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bitacora_pk_seq OWNER TO postgres;

--
-- Name: bitacora_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE bitacora_pk_seq OWNED BY bitacora.pk;


--
-- Name: cursos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cursos (
    pk bigint NOT NULL,
    semestre integer DEFAULT 0 NOT NULL,
    anio integer NOT NULL,
    asignatura_fk bigint NOT NULL,
    docente_fk bigint NOT NULL,
    seccion integer NOT NULL
);


ALTER TABLE public.cursos OWNER TO postgres;

--
-- Name: cursos_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cursos_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cursos_pk_seq OWNER TO postgres;

--
-- Name: cursos_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cursos_pk_seq OWNED BY cursos.pk;


--
-- Name: departamentos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE departamentos (
    pk integer NOT NULL,
    facultad_fk integer NOT NULL,
    departamento character varying(50) NOT NULL,
    descripcion text
);


ALTER TABLE public.departamentos OWNER TO postgres;

--
-- Name: departamentos_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE departamentos_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.departamentos_pk_seq OWNER TO postgres;

--
-- Name: departamentos_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE departamentos_pk_seq OWNED BY departamentos.pk;


--
-- Name: docentes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE docentes (
    pk bigint NOT NULL,
    nombres character varying(50) NOT NULL,
    apellidos character varying(50) NOT NULL,
    rut character varying(20) NOT NULL,
    departamento_fk integer NOT NULL
);


ALTER TABLE public.docentes OWNER TO postgres;

--
-- Name: docentes_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE docentes_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.docentes_pk_seq OWNER TO postgres;

--
-- Name: docentes_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE docentes_pk_seq OWNED BY docentes.pk;


--
-- Name: escuelas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE escuelas (
    pk integer NOT NULL,
    departamento_fk integer NOT NULL,
    escuela character varying(50) NOT NULL,
    descripcion text
);


ALTER TABLE public.escuelas OWNER TO postgres;

--
-- Name: escuelas_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE escuelas_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.escuelas_pk_seq OWNER TO postgres;

--
-- Name: escuelas_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE escuelas_pk_seq OWNED BY escuelas.pk;


--
-- Name: facultades; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE facultades (
    pk integer NOT NULL,
    facultad character varying NOT NULL,
    descripcion text
);


ALTER TABLE public.facultades OWNER TO postgres;

--
-- Name: facultades_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE facultades_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.facultades_pk_seq OWNER TO postgres;

--
-- Name: facultades_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE facultades_pk_seq OWNED BY facultades.pk;


--
-- Name: periodos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE periodos (
    pk integer NOT NULL,
    numero integer NOT NULL,
    periodo character varying(50) NOT NULL,
    inicio time without time zone NOT NULL,
    termino time without time zone NOT NULL
);


ALTER TABLE public.periodos OWNER TO postgres;

--
-- Name: periodos_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE periodos_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.periodos_pk_seq OWNER TO postgres;

--
-- Name: periodos_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE periodos_pk_seq OWNED BY periodos.pk;


--
-- Name: reservas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE reservas (
    pk bigint NOT NULL,
    fecha date NOT NULL,
    sala_fk integer NOT NULL,
    periodo_fk integer NOT NULL,
    curso_fk bigint NOT NULL,
    adm_fk bigint
);


ALTER TABLE public.reservas OWNER TO postgres;

--
-- Name: reservas_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE reservas_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reservas_pk_seq OWNER TO postgres;

--
-- Name: reservas_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE reservas_pk_seq OWNED BY reservas.pk;


--
-- Name: salas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE salas (
    pk integer NOT NULL,
    facultad_fk integer NOT NULL,
    sala character varying(50) NOT NULL
);


ALTER TABLE public.salas OWNER TO postgres;

--
-- Name: salas_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE salas_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.salas_pk_seq OWNER TO postgres;

--
-- Name: salas_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE salas_pk_seq OWNED BY salas.pk;


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY administrador ALTER COLUMN pk SET DEFAULT nextval('administrador_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asignaturas ALTER COLUMN pk SET DEFAULT nextval('asignaturas_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY bitacora ALTER COLUMN pk SET DEFAULT nextval('bitacora_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cursos ALTER COLUMN pk SET DEFAULT nextval('cursos_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY departamentos ALTER COLUMN pk SET DEFAULT nextval('departamentos_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docentes ALTER COLUMN pk SET DEFAULT nextval('docentes_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY escuelas ALTER COLUMN pk SET DEFAULT nextval('escuelas_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY facultades ALTER COLUMN pk SET DEFAULT nextval('facultades_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY periodos ALTER COLUMN pk SET DEFAULT nextval('periodos_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reservas ALTER COLUMN pk SET DEFAULT nextval('reservas_pk_seq'::regclass);


--
-- Name: pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY salas ALTER COLUMN pk SET DEFAULT nextval('salas_pk_seq'::regclass);


--
-- Data for Name: administrador; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY administrador (pk, nombre, clave, contacto, rut) FROM stdin;
1	jose	4321	jose@utem.cl	21776304-5
31	sebastian	nose	nose@jaja	nose
30	juancho2.0	nose	nose@jaja.com	nosexd
\.


--
-- Name: administrador_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('administrador_pk_seq', 32, true);


--
-- Data for Name: asignaturas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY asignaturas (pk, departamento_fk, codigo, nombre, descripcion) FROM stdin;
104	1	INF-762	Computacion Paralela	
93	1	INF-648	Analisis de Algoritmo	
34	1	INF-626	Lenguaje de Expresiones	
55	1	INF-642	Lenguaje de Programacion	
111	1	INF-752	Gestion Financiera de TI	
82	1	INF-653	Simulacion de Sistemas	
103	1	INF-750	Optimizacion de Sistemas	
73	1	INF-644	Teorias Automatas	
1	1	EFE	Computacion Movil	
105	1	INF-658	Auditoria de Sistemas	
65	1	INF-631	Bases de Datos	
\.


--
-- Name: asignaturas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('asignaturas_pk_seq', 1, false);


--
-- Data for Name: asistencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY asistencia (pk, firma, fecha, docente_fk) FROM stdin;
1	1	2014-06-04	1
\.


--
-- Data for Name: bitacora; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY bitacora (pk, ip, fecha, administrador_fk) FROM stdin;
1	192.168.0.1	2014-06-04	1
\.


--
-- Name: bitacora_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('bitacora_pk_seq', 1, false);


--
-- Data for Name: cursos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cursos (pk, semestre, anio, asignatura_fk, docente_fk, seccion) FROM stdin;
12	1	2014	82	12	1
\.


--
-- Name: cursos_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cursos_pk_seq', 16, true);


--
-- Data for Name: departamentos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY departamentos (pk, facultad_fk, departamento, descripcion) FROM stdin;
2	1	Industria	
1	1	Informática y Computación	
7	1	Electricidad	
8	1	Mecánica	
9	2	Gestión Organizacional	
10	2	Economía, Recursos Naturales y Comercio Inter.	
11	2	Contabilidad y Gestión Financiera	
12	2	Gestión de la Información	
13	2	Estadística y Econometría	
14	4	Prevención de Riesgos y Medio Ambiente	
15	4	Ciencias de la Construcción	
16	4	Planificación y Ordenamiento Territorial	
\.


--
-- Name: departamentos_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('departamentos_pk_seq', 16, true);


--
-- Data for Name: docentes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY docentes (pk, nombres, apellidos, rut, departamento_fk) FROM stdin;
1	Mauro	Castillo Valdes	001	1
2	Francisco Alberto 	Cofré Gajardo	002	1
3	Ricardo Osvaldo	Corbinaud Perez	003	1
4	Victor Heughes	Escobar Jeria	004	1
5	Oscar	Magna Veloso	005	1
6	Patricia	Mellado Acevedo	006	1
7	Rene	Peña Aguilar	007	1
8	Héctor Manuel	Pincheira Conejeros	008	1
9	Sara	Rojas Aldea	009	1
10	Marta	Rojas Estay	010	1
11	Maria Victoria	Vallejos Amado	011	1
13	Alejandro	Reyes	013	1
14	Sergio	Muñoz	014	1
15	Jorge	Pavez	015	1
16	Jorge	Morris	016	1
17	Rene	Peña	017	1
12	Santiago	Zapata Caceres	17.680.010-0	1
\.


--
-- Name: docentes_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('docentes_pk_seq', 1, false);


--
-- Data for Name: escuelas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY escuelas (pk, departamento_fk, escuela, descripcion) FROM stdin;
2	2	Industria y Civil industrial	
1	1	Informática	Carreras ingenieria en informatica y civil en computacion
3	7	Electrónica	
4	8	Mecánica	
\.


--
-- Name: escuelas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('escuelas_pk_seq', 4, true);


--
-- Data for Name: facultades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY facultades (pk, facultad, descripcion) FROM stdin;
1	Ingenieria	La Facultad de Ingeniería está ubicada en el Campus Macul, en Av. José Pedro Alessandri 1242, Ñuñoa, Santiago.
4	Central	La Facultad de Ciencias de la Construcción y Ordenamiento Territorial está ubicada en el Campus Área Central en la calle Dieciocho 390 Santiago Centro, Metro Toesca.
2	Adm. y Economía	La Facultad de Administración y Economía está ubicada en el Campus Providencia en Dr. Hernán Alessandri 722, Providencia, Metro Salvador.
\.


--
-- Name: facultades_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('facultades_pk_seq', 4, true);


--
-- Data for Name: periodos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY periodos (pk, numero, periodo, inicio, termino) FROM stdin;
1	1	1	08:00:00	09:30:00
2	2	2	09:40:00	11:10:00
4	4	4	13:00:00	14:30:00
5	5	5	14:40:00	16:10:00
6	6	6	16:20:00	17:50:00
7	7	7	18:00:00	19:30:00
8	8	8	19:00:00	20:30:00
9	9	9	20:40:00	22:10:00
3	3	3	11:20:00	12:50:00
\.


--
-- Name: periodos_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('periodos_pk_seq', 1, false);


--
-- Data for Name: reservas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY reservas (pk, fecha, sala_fk, periodo_fk, curso_fk, adm_fk) FROM stdin;
23	2014-06-09	1	1	12	1
24	2014-06-16	1	1	12	1
25	2014-06-23	1	1	12	1
26	2014-06-30	1	1	12	1
\.


--
-- Name: reservas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('reservas_pk_seq', 38, true);


--
-- Data for Name: salas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY salas (pk, facultad_fk, sala) FROM stdin;
1	1	M1-301
2	1	M1-302
3	1	M1-303
4	1	M1-304
5	1	M1-305
6	1	M1-306
7	1	M1-307
8	1	M2-201
9	1	M2-202
10	1	M2-203
11	1	M2-204
12	1	M2-301
13	1	M2-302
14	1	M2-303
15	1	M2-304
16	1	M3-101
17	1	M3-102
18	1	M3-103
19	1	M3-104
20	1	M3-201
21	1	M3-202
22	1	M3-203
23	1	M3-204
24	1	M3-301
25	1	M3-303
26	1	M3-304
27	1	M3-400
28	1	M3-402
29	1	M6-205
30	1	M6-206
31	1	M6-209
32	1	M6-210
33	1	M6-212
34	1	M6-214
35	1	M6-325
36	1	M6-326
37	1	M6-327
38	1	M6-330
39	1	M6-331
\.


--
-- Name: salas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('salas_pk_seq', 40, true);


--
-- Name: administrador_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY administrador
    ADD CONSTRAINT administrador_pkey PRIMARY KEY (pk);


--
-- Name: asignaturas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY asignaturas
    ADD CONSTRAINT asignaturas_pkey PRIMARY KEY (pk);


--
-- Name: asistencia_docente_fk_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY asistencia
    ADD CONSTRAINT asistencia_docente_fk_key UNIQUE (docente_fk);


--
-- Name: asistencia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY asistencia
    ADD CONSTRAINT asistencia_pkey PRIMARY KEY (pk);


--
-- Name: bitacora_administrador_fk_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY bitacora
    ADD CONSTRAINT bitacora_administrador_fk_key UNIQUE (administrador_fk);


--
-- Name: bitacora_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY bitacora
    ADD CONSTRAINT bitacora_pkey PRIMARY KEY (pk);


--
-- Name: cursos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cursos
    ADD CONSTRAINT cursos_pkey PRIMARY KEY (pk);


--
-- Name: departamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (pk);


--
-- Name: docentes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY docentes
    ADD CONSTRAINT docentes_pkey PRIMARY KEY (pk);


--
-- Name: docentes_rut_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY docentes
    ADD CONSTRAINT docentes_rut_key UNIQUE (rut);


--
-- Name: escuelas_escuela_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY escuelas
    ADD CONSTRAINT escuelas_escuela_key UNIQUE (escuela);


--
-- Name: escuelas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY escuelas
    ADD CONSTRAINT escuelas_pkey PRIMARY KEY (pk);


--
-- Name: facultades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY facultades
    ADD CONSTRAINT facultades_pkey PRIMARY KEY (pk);


--
-- Name: periodos_numero_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY periodos
    ADD CONSTRAINT periodos_numero_key UNIQUE (numero);


--
-- Name: periodos_periodo_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY periodos
    ADD CONSTRAINT periodos_periodo_key UNIQUE (periodo);


--
-- Name: periodos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY periodos
    ADD CONSTRAINT periodos_pkey PRIMARY KEY (pk);


--
-- Name: reservas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_pkey PRIMARY KEY (pk);


--
-- Name: salas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY salas
    ADD CONSTRAINT salas_pkey PRIMARY KEY (pk);


--
-- Name: asignaturas_codigo_nombre_key; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX asignaturas_codigo_nombre_key ON asignaturas USING btree (codigo, nombre);


--
-- Name: salas_facultad_fk_sala_key; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX salas_facultad_fk_sala_key ON salas USING btree (facultad_fk, sala);


--
-- Name: asignaturas_departamento_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asignaturas
    ADD CONSTRAINT asignaturas_departamento_fk_fkey FOREIGN KEY (departamento_fk) REFERENCES departamentos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: asistencia_docente_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asistencia
    ADD CONSTRAINT asistencia_docente_fk_fkey FOREIGN KEY (docente_fk) REFERENCES docentes(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: bitacora_administrador_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY bitacora
    ADD CONSTRAINT bitacora_administrador_fk_fkey FOREIGN KEY (administrador_fk) REFERENCES administrador(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cursos_asignatura_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cursos
    ADD CONSTRAINT cursos_asignatura_fk_fkey FOREIGN KEY (asignatura_fk) REFERENCES asignaturas(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cursos_docente_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cursos
    ADD CONSTRAINT cursos_docente_fk_fkey FOREIGN KEY (docente_fk) REFERENCES docentes(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: departamentos_facultad_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamentos_facultad_fk_fkey FOREIGN KEY (facultad_fk) REFERENCES facultades(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: docentes_departamento_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docentes
    ADD CONSTRAINT docentes_departamento_fk_fkey FOREIGN KEY (departamento_fk) REFERENCES departamentos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: escuelas_departamento_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY escuelas
    ADD CONSTRAINT escuelas_departamento_fk_fkey FOREIGN KEY (departamento_fk) REFERENCES departamentos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reservas_adm_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_adm_fk_fkey FOREIGN KEY (adm_fk) REFERENCES administrador(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reservas_curso_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_curso_fk_fkey FOREIGN KEY (curso_fk) REFERENCES cursos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reservas_periodo_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_periodo_fk_fkey FOREIGN KEY (periodo_fk) REFERENCES periodos(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: reservas_sala_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reservas
    ADD CONSTRAINT reservas_sala_fk_fkey FOREIGN KEY (sala_fk) REFERENCES salas(pk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: salas_facultad_fk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
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

