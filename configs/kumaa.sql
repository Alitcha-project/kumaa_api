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

CREATE TABLE public."Commentaire" (
  id_commentaire smallserial NOT NULL,
  text_commentaire text NOT NULL,
  date_post_commentaire date NOT NULL,
  date_edit_commentaire date NOT NULL,
  article_id_commentaire integer NOT NULL,
  CONSTRAINT "Commentaire_pk" PRIMARY KEY (id_commentaire),
  CONSTRAINT "Commentaire_article_fk" FOREIGN KEY (article_id_commentaire)REFERENCES Article(id_article)
);