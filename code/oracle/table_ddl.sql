--------------------------------------------------------
--  DDL for Table ODJAVA
--------------------------------------------------------

  CREATE TABLE "NOVINE"."ODJAVA" 
   (	"EMAIL_HASH" RAW(20), 
	"DATUM_SLANJA" DATE DEFAULT SYSDATE, 
	"DATUM_ODJAVE" DATE
   );
--------------------------------------------------------
--  DDL for Table VIJEST
--------------------------------------------------------

  CREATE TABLE "NOVINE"."VIJEST" 
   (	"DAT" DATE DEFAULT sysdate, 
	"NASLOV" VARCHAR2(100 BYTE), 
	"TEKST" VARCHAR2(1000 BYTE)
   );
--------------------------------------------------------
--  DDL for Index PK_NOVINE
--------------------------------------------------------

  CREATE UNIQUE INDEX "NOVINE"."PK_NOVINE" ON "NOVINE"."ODJAVA" ("EMAIL_HASH");
--------------------------------------------------------
--  Constraints for Table ODJAVA
--------------------------------------------------------

  ALTER TABLE "NOVINE"."ODJAVA" MODIFY ("DATUM_SLANJA" NOT NULL ENABLE);
  ALTER TABLE "NOVINE"."ODJAVA" ADD PRIMARY KEY ("EMAIL_HASH") USING INDEX ENABLE;
  ALTER TABLE "NOVINE"."ODJAVA" MODIFY ("EMAIL_HASH" NOT NULL ENABLE);
