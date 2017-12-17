PGDMP                         u            postgres    10.1    10.1     �
           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            �
           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            �
           1262    12938    postgres    DATABASE     �   CREATE DATABASE postgres WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';
    DROP DATABASE postgres;
             postgres    false            �
           1262    12938    postgres    COMMENT     N   COMMENT ON DATABASE postgres IS 'default administrative connection database';
                  postgres    false    2812                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            �
           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    4                        3079    12924    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            �
           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    2                        3079    16384 	   adminpack 	   EXTENSION     A   CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;
    DROP EXTENSION adminpack;
                  false                        0    0    EXTENSION adminpack    COMMENT     M   COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';
                       false    1            �            1259    16409    users    TABLE     �   CREATE TABLE users (
    id integer NOT NULL,
    email character varying(50) NOT NULL,
    password_hash character varying(256) NOT NULL,
    primavera_id character varying(12) NOT NULL
);
    DROP TABLE public.users;
       public         postgres    false    4            �            1259    16412    Users_id_seq    SEQUENCE        CREATE SEQUENCE "Users_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public."Users_id_seq";
       public       postgres    false    197    4                       0    0    Users_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE "Users_id_seq" OWNED BY users.id;
            public       postgres    false    198            �            1259    16414 
   objectives    TABLE     �   CREATE TABLE objectives (
    id integer NOT NULL,
    type character varying(10) NOT NULL,
    limit_value double precision NOT NULL,
    representative_id integer NOT NULL
);
    DROP TABLE public.objectives;
       public         postgres    false    4            �            1259    16417    objectives_id_seq    SEQUENCE     �   CREATE SEQUENCE objectives_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.objectives_id_seq;
       public       postgres    false    199    4                       0    0    objectives_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE objectives_id_seq OWNED BY objectives.id;
            public       postgres    false    200            v
           2604    16419    objectives id    DEFAULT     `   ALTER TABLE ONLY objectives ALTER COLUMN id SET DEFAULT nextval('objectives_id_seq'::regclass);
 <   ALTER TABLE public.objectives ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    200    199            u
           2604    16420    users id    DEFAULT     X   ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('"Users_id_seq"'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    198    197            �
          0    16414 
   objectives 
   TABLE DATA                     public       postgres    false    199   �       �
          0    16409    users 
   TABLE DATA                     public       postgres    false    197   @                  0    0    Users_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('"Users_id_seq"', 2, true);
            public       postgres    false    198                       0    0    objectives_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('objectives_id_seq', 1, false);
            public       postgres    false    200            x
           2606    16422    users Users_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY users
    ADD CONSTRAINT "Users_pkey" PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.users DROP CONSTRAINT "Users_pkey";
       public         postgres    false    197            z
           2606    16424    objectives objectives_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY objectives
    ADD CONSTRAINT objectives_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.objectives DROP CONSTRAINT objectives_pkey;
       public         postgres    false    199            �
   �   x���v
Q���W�O�JM.�,K-V��L�Q(�,H�Q����,�/K�)r�R�R�S�JA��3S4�}B]�4�t���SJ�K��u�XӚ˓j TO�����|c����Ey�y� � Vpq AW]T      �
   �   x�̻�0 Н��$��R���$AWr���&I+���x��v}sX�g�F�e�g�ς-���8A�6?�����v<]��e�`)Ձp�.��n�j������\�4J#�����R���8A��Z�F�&BV����>I��.�     