

--
-- Database for paperwork
--

CREATE DATABASE "paperwork";
\c paperwork


--
-- Table structure for table `notes`
--

CREATE TABLE "notes" (
  "note_id" bigserial NOT NULL,
  "note_title" text ,
  "note_text" text,
  "note_created" timestamp ,
  "note_modified" timestamp );

