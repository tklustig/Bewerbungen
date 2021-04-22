CREATE TABLE "bewerbungen" (
  "bew_id" integer NOT NULL,
  "datum" date NOT NULL,
  "firma" varchar(100) COLLATE utf8_german2_ci NOT NULL,
  "rechtsart" integer DEFAULT NULL,
  "stadt" varchar(100) COLLATE utf8_german2_ci NOT NULL,
  "plz" integer NOT NULL,
  "strasse_nr" varchar(100) COLLATE utf8_german2_ci DEFAULT NULL,
  "ansprech_person" varchar(100) COLLATE utf8_german2_ci DEFAULT NULL,
  "email" varchar(50) COLLATE utf8_german2_ci NOT NULL,
  "feedback" integer DEFAULT NULL,
  "bemerkung" varchar(150) COLLATE utf8_german2_ci DEFAULT NULL

);
CREATE TABLE "nachricht" (
  "id_message" integer NOT NULL,
  "notiz" varchar(25) COLLATE utf8_german2_ci NOT NULL

);
INSERT INTO "nachricht" VALUES(1, 'Ja');
INSERT INTO "nachricht" VALUES(2, 'Nein');
INSERT INTO "nachricht" VALUES(3, 'steht noch aus');

CREATE TABLE "rechtsform" (
  "id_recht" integer NOT NULL,
  "art" varchar(20) COLLATE utf8_german2_ci NOT NULL

);
INSERT INTO "rechtsform" VALUES(1, 'Einzelunternehmen');
INSERT INTO "rechtsform" VALUES(2, 'GbR');
INSERT INTO "rechtsform" VALUES(3, 'GmbH & Co.KG');
INSERT INTO "rechtsform" VALUES(4, 'KG');
INSERT INTO "rechtsform" VALUES(5, 'OHG');
INSERT INTO "rechtsform" VALUES(6, 'AG');
INSERT INTO "rechtsform" VALUES(7, 'GmbH');
INSERT INTO "rechtsform" VALUES(8, 'eG');
INSERT INTO "rechtsform" VALUES(9, 'KGaA');
INSERT INTO "rechtsform" VALUES(10, 'Stiftung');

