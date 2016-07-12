

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organizer`
--
CREATE DATABASE "paperwork";
\c paperwork

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE "notes" (
  "note_id" bigserial NOT NULL,
  "note_title" text ,
  "note_text" text,
  "note_created" timestamp ,
  "note_modified" timestamp );

