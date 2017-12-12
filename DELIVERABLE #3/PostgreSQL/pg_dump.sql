--
-- PostgreSQL database dump
--

-- Dumped from database version 10.1
-- Dumped by pg_dump version 10.1

-- Started on 2017-12-05 18:54:24

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE postgres;
--
-- TOC entry 2812 (class 1262 OID 12938)
-- Name: postgres; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE postgres WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';


ALTER DATABASE postgres OWNER TO postgres;

\connect postgres

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2813 (class 1262 OID 12938)
-- Dependencies: 2812
-- Name: postgres; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE postgres IS 'default administrative connection database';


--
-- TOC entry 2 (class 3079 OID 12924)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2816 (class 0 OID 0)
-- Dependencies: 2
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- TOC entry 1 (class 3079 OID 16384)
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- TOC entry 2817 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 197 (class 1259 OID 16393)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE users (
    id integer NOT NULL,
    email character varying(50) NOT NULL,
    password_hash character varying(256) NOT NULL,
    primavera_id character varying(12) NOT NULL
);


ALTER TABLE users OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 16396)
-- Name: Users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Users_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Users_id_seq" OWNER TO postgres;

--
-- TOC entry 2818 (class 0 OID 0)
-- Dependencies: 198
-- Name: Users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Users_id_seq" OWNED BY users.id;


--
-- TOC entry 199 (class 1259 OID 16398)
-- Name: objectives; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE objectives (
    id integer NOT NULL,
    type character varying(10) NOT NULL,
    limit_value double precision NOT NULL,
    representative_id integer NOT NULL
);


ALTER TABLE objectives OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 16401)
-- Name: objectives_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE objectives_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE objectives_id_seq OWNER TO postgres;

--
-- TOC entry 2819 (class 0 OID 0)
-- Dependencies: 200
-- Name: objectives_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE objectives_id_seq OWNED BY objectives.id;


--
-- TOC entry 2678 (class 2604 OID 16403)
-- Name: objectives id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY objectives ALTER COLUMN id SET DEFAULT nextval('objectives_id_seq'::regclass);


--
-- TOC entry 2677 (class 2604 OID 16404)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('"Users_id_seq"'::regclass);


--
-- TOC entry 2806 (class 0 OID 16398)
-- Dependencies: 199
-- Data for Name: objectives; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO objectives (id, type, limit_value, representative_id) VALUES (2, 'products', 11, 1);
INSERT INTO objectives (id, type, limit_value, representative_id) VALUES (1, 'clients', 11, 1);
INSERT INTO objectives (id, type, limit_value, representative_id) VALUES (3, 'earnings', 2000, 1);


--
-- TOC entry 2804 (class 0 OID 16393)
-- Dependencies: 197
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2820 (class 0 OID 0)
-- Dependencies: 198
-- Name: Users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Users_id_seq"', 1, false);


--
-- TOC entry 2821 (class 0 OID 0)
-- Dependencies: 200
-- Name: objectives_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('objectives_id_seq', 1, false);


--
-- TOC entry 2680 (class 2606 OID 16406)
-- Name: users Users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT "Users_pkey" PRIMARY KEY (id);


--
-- TOC entry 2682 (class 2606 OID 16408)
-- Name: objectives objectives_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY objectives
    ADD CONSTRAINT objectives_pkey PRIMARY KEY (id);


--
-- TOC entry 2815 (class 0 OID 0)
-- Dependencies: 7
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2017-12-05 18:54:25

--
-- PostgreSQL database dump complete
--

