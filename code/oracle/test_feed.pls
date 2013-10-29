create or replace PROCEDURE        test_feed as
  v_xml blob;
BEGIN
  WITH a AS(
      SELECT dat, naslov, tekst
      FROM   novine.vijest
      order by 1 desc
  )
  SELECT
    XMLElement("rss",
     XMLAttributes('2.0' as "version"),
     XMLElement("channel",
      XMLElement("title",'Title: Vijesti najnovije'),
      XMLElement("link",'http://www.emajliramokade.com'),
      XMLElement("description",'Kade, mi ih e-majliramo'),
      XMLElement("language", 'hr'),
      (
       XMLAgg(
        XMLElement("item",
         XMLElement("pubDate",to_char(a.dat,'DAY, DD MON YYYY HH24:MI:SS')),
         XMLElement("title", a.naslov),
         XMLElement("description", a.tekst)
       )
      )
     )
    )
  ).getblobval(nls_charset_id('AL32UTF8')) into v_xml
  from a;
  owa_util.mime_header('text/xml');
  wpg_docload.download_file(v_xml);
  dbms_lob.freetemporary(v_xml);
END;
/

grant execute on test_feed to public;