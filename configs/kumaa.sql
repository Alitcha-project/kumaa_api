-- SQLBook: Code
-- Database generated with pgModeler (PostgreSQL Database Modeler).
-- pgModeler version: 0.9.4
-- PostgreSQL version: 13.0
-- Project Site: pgmodeler.io
-- Model Author: ---

-- Database creation must be performed outside a multi lined SQL file. 
-- These commands were put in this file only as a convenience.
-- 
-- object: kumaa | type: DATABASE --
DROP DATABASE IF EXISTS kumaa;
CREATE DATABASE kumaa;
-- ddl-end --

CREATE TABLE public."Article" (
	id_article smallserial NOT NULL,
	text_article text NOT NULL,
	date_post_article date NOT NULL,
	date_edit_article date NOT NULL,
	CONSTRAINT "Article_pk" PRIMARY KEY (id_article)
);