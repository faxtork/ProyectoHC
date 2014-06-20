--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- Data for Name: administrador; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO administrador VALUES (1, 'jose', '4321', 'jose@utem.cl', '21776304-5');
INSERT INTO administrador VALUES (31, 'sebastian', 'nose', 'nose@jaja', 'nose');
INSERT INTO administrador VALUES (30, 'juancho2.0', 'nose', 'nose@jaja.com', 'nosexd');


--
-- Name: administrador_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('administrador_pk_seq', 32, true);


--
-- Data for Name: facultades; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO facultades VALUES (1, 'Ingenieria', 'La Facultad de Ingeniería está ubicada en el Campus Macul, en Av. José Pedro Alessandri 1242, Ñuñoa, Santiago.');
INSERT INTO facultades VALUES (2, 'Adm. y Economía', 'La Facultad de Administración y Economía está ubicada en el Campus Providencia en Dr. Hernán Alessandri 722, Providencia, Metro Salvador.');
INSERT INTO facultades VALUES (4, 'Central', 'La Facultad de Ciencias de la Construcción y Ordenamiento Territorial está ubicada en el Campus Área Central en la calle Dieciocho 390 Santiago Centro, Metro Toesca.');


--
-- Data for Name: departamentos; Type: TABLE DATA; Schema: public; Owner: postgres
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


--
-- Data for Name: asignaturas; Type: TABLE DATA; Schema: public; Owner: postgres
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


--
-- Name: asignaturas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('asignaturas_pk_seq', 1, false);


--
-- Data for Name: docentes; Type: TABLE DATA; Schema: public; Owner: postgres
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


--
-- Data for Name: asistencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO asistencia VALUES (1, 1, '2014-06-04', 1);


--
-- Data for Name: bitacora; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO bitacora VALUES (1, '192.168.0.1', '2014-06-04', 1);


--
-- Name: bitacora_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('bitacora_pk_seq', 1, false);


--
-- Data for Name: cursos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO cursos VALUES (18, 1, 2014, 82, 14, 1);
INSERT INTO cursos VALUES (19, 1, 2014, 103, 13, 1);


--
-- Name: cursos_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cursos_pk_seq', 19, true);


--
-- Name: departamentos_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('departamentos_pk_seq', 16, true);


--
-- Name: docentes_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('docentes_pk_seq', 1, false);


--
-- Data for Name: escuelas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO escuelas VALUES (2, 2, 'Industria y Civil industrial', '');
INSERT INTO escuelas VALUES (1, 1, 'Informática', 'Carreras ingenieria en informatica y civil en computacion');
INSERT INTO escuelas VALUES (3, 7, 'Electrónica', '');
INSERT INTO escuelas VALUES (4, 8, 'Mecánica', '');


--
-- Name: escuelas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('escuelas_pk_seq', 4, true);


--
-- Name: facultades_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('facultades_pk_seq', 27, true);


--
-- Data for Name: periodos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO periodos VALUES (1, 1, '1', '08:00:00', '09:30:00');
INSERT INTO periodos VALUES (2, 2, '2', '09:40:00', '11:10:00');
INSERT INTO periodos VALUES (4, 4, '4', '13:00:00', '14:30:00');
INSERT INTO periodos VALUES (5, 5, '5', '14:40:00', '16:10:00');
INSERT INTO periodos VALUES (6, 6, '6', '16:20:00', '17:50:00');
INSERT INTO periodos VALUES (7, 7, '7', '18:00:00', '19:30:00');
INSERT INTO periodos VALUES (8, 8, '8', '19:00:00', '20:30:00');
INSERT INTO periodos VALUES (9, 9, '9', '20:40:00', '22:10:00');
INSERT INTO periodos VALUES (3, 3, '3', '11:20:00', '12:50:00');


--
-- Name: periodos_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('periodos_pk_seq', 1, false);


--
-- Data for Name: salas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO salas VALUES (1, 1, 'M1-301');
INSERT INTO salas VALUES (2, 1, 'M1-302');
INSERT INTO salas VALUES (3, 1, 'M1-303');
INSERT INTO salas VALUES (4, 1, 'M1-304');
INSERT INTO salas VALUES (5, 1, 'M1-305');
INSERT INTO salas VALUES (6, 1, 'M1-306');
INSERT INTO salas VALUES (7, 1, 'M1-307');
INSERT INTO salas VALUES (8, 1, 'M2-201');
INSERT INTO salas VALUES (9, 1, 'M2-202');
INSERT INTO salas VALUES (10, 1, 'M2-203');
INSERT INTO salas VALUES (11, 1, 'M2-204');
INSERT INTO salas VALUES (12, 1, 'M2-301');
INSERT INTO salas VALUES (13, 1, 'M2-302');
INSERT INTO salas VALUES (14, 1, 'M2-303');
INSERT INTO salas VALUES (15, 1, 'M2-304');
INSERT INTO salas VALUES (16, 1, 'M3-101');
INSERT INTO salas VALUES (17, 1, 'M3-102');
INSERT INTO salas VALUES (18, 1, 'M3-103');
INSERT INTO salas VALUES (19, 1, 'M3-104');
INSERT INTO salas VALUES (20, 1, 'M3-201');
INSERT INTO salas VALUES (21, 1, 'M3-202');
INSERT INTO salas VALUES (22, 1, 'M3-203');
INSERT INTO salas VALUES (23, 1, 'M3-204');
INSERT INTO salas VALUES (24, 1, 'M3-301');
INSERT INTO salas VALUES (25, 1, 'M3-303');
INSERT INTO salas VALUES (26, 1, 'M3-304');
INSERT INTO salas VALUES (27, 1, 'M3-400');
INSERT INTO salas VALUES (28, 1, 'M3-402');
INSERT INTO salas VALUES (29, 1, 'M6-205');
INSERT INTO salas VALUES (30, 1, 'M6-206');
INSERT INTO salas VALUES (31, 1, 'M6-209');
INSERT INTO salas VALUES (32, 1, 'M6-210');
INSERT INTO salas VALUES (33, 1, 'M6-212');
INSERT INTO salas VALUES (34, 1, 'M6-214');
INSERT INTO salas VALUES (35, 1, 'M6-325');
INSERT INTO salas VALUES (36, 1, 'M6-326');
INSERT INTO salas VALUES (37, 1, 'M6-327');
INSERT INTO salas VALUES (38, 1, 'M6-330');
INSERT INTO salas VALUES (39, 1, 'M6-331');


--
-- Data for Name: reservas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO reservas VALUES (43, '2014-06-10', 1, 5, 18, 1);
INSERT INTO reservas VALUES (44, '2014-06-17', 1, 5, 18, 1);
INSERT INTO reservas VALUES (45, '2014-06-24', 1, 5, 18, 1);
INSERT INTO reservas VALUES (46, '2014-06-16', 1, 2, 19, 1);
INSERT INTO reservas VALUES (47, '2014-06-23', 1, 2, 19, 1);
INSERT INTO reservas VALUES (48, '2014-06-30', 1, 2, 19, 1);


--
-- Name: reservas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('reservas_pk_seq', 48, true);


--
-- Name: salas_pk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('salas_pk_seq', 40, true);


--
-- PostgreSQL database dump complete
--

