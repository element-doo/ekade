set define off
set verify off
set feedback off
WHENEVER SQLERROR EXIT SQL.SQLCODE ROLLBACK
begin wwv_flow.g_import_in_progress := true; end;
/
 
--       AAAA       PPPPP   EEEEEE  XX      XX
--      AA  AA      PP  PP  EE       XX    XX
--     AA    AA     PP  PP  EE        XX  XX
--    AAAAAAAAAA    PPPPP   EEEE       XXXX
--   AA        AA   PP      EE        XX  XX
--  AA          AA  PP      EE       XX    XX
--  AA          AA  PP      EEEEEE  XX      XX
prompt  Set Credentials...
 
begin
 
  -- Assumes you are running the script connected to SQL*Plus as the Oracle user APEX_040200 or as the owner (parsing schema) of the application.
  wwv_flow_api.set_security_group_id(p_security_group_id=>nvl(wwv_flow_application_install.get_workspace_id,2316720251453129));
 
end;
/

begin wwv_flow.g_import_in_progress := true; end;
/
begin 

select value into wwv_flow_api.g_nls_numeric_chars from nls_session_parameters where parameter='NLS_NUMERIC_CHARACTERS';

end;

/
begin execute immediate 'alter session set nls_numeric_characters=''.,''';

end;

/
begin wwv_flow.g_browser_language := 'en'; end;
/
prompt  Check Compatibility...
 
begin
 
-- This date identifies the minimum version required to import this file.
wwv_flow_api.set_version(p_version_yyyy_mm_dd=>'2012.01.01');
 
end;
/

prompt  Set Application Offset...
 
begin
 
   -- SET APPLICATION OFFSET
   wwv_flow_api.g_id_offset := nvl(wwv_flow_application_install.get_offset,0);
null;
 
end;
/

 
begin
 
wwv_flow_api.remove_restful_service (
  p_id => 2432314419499488 + wwv_flow_api.g_id_offset
 ,p_name => 'ekade.novosti'
  );
 
null;
 
end;
/

 
begin
 
wwv_flow_api.remove_restful_service (
  p_id => 2438817393601895 + wwv_flow_api.g_id_offset
 ,p_name => 'odjave'
  );
 
null;
 
end;
/

prompt  ...restful service
--
--application/restful_services/ekade_novosti
 
begin
 
wwv_flow_api.create_restful_module (
  p_id => 2432314419499488 + wwv_flow_api.g_id_offset
 ,p_name => 'ekade.novosti'
 ,p_uri_prefix => 'novosti/'
 ,p_parsing_schema => 'NOVINE'
 ,p_items_per_page => 25
 ,p_status => 'PUBLISHED'
  );
 
wwv_flow_api.create_restful_template (
  p_id => 2432615851528266 + wwv_flow_api.g_id_offset
 ,p_module_id => 2432314419499488 + wwv_flow_api.g_id_offset
 ,p_uri_template => 'objavi/'
 ,p_priority => 0
 ,p_etag_type => 'NONE'
  );
 
wwv_flow_api.create_restful_handler (
  p_id => 2432705247534675 + wwv_flow_api.g_id_offset
 ,p_template_id => 2432615851528266 + wwv_flow_api.g_id_offset
 ,p_source_type => 'PLSQL'
 ,p_format => 'DEFAULT'
 ,p_method => 'POST'
 ,p_require_https => 'NO'
 ,p_source => 
'begin'||unistr('\000a')||
'insert into vijest (naslov,tekst)'||unistr('\000a')||
'values'||unistr('\000a')||
'(:NASLOV, :TEKST);'||unistr('\000a')||
'commit;'||unistr('\000a')||
'end;'
  );
 
wwv_flow_api.create_restful_param (
  p_id => 2432832605542557 + wwv_flow_api.g_id_offset
 ,p_handler_id => 2432705247534675 + wwv_flow_api.g_id_offset
 ,p_name => 'NASLOV'
 ,p_bind_variable_name => 'NASLOV'
 ,p_source_type => 'URI'
 ,p_access_method => 'IN'
 ,p_param_type => 'STRING'
  );
 
wwv_flow_api.create_restful_param (
  p_id => 2432909880545550 + wwv_flow_api.g_id_offset
 ,p_handler_id => 2432705247534675 + wwv_flow_api.g_id_offset
 ,p_name => 'TEKST'
 ,p_bind_variable_name => 'TEKST'
 ,p_source_type => 'URI'
 ,p_access_method => 'IN'
 ,p_param_type => 'STRING'
  );
 
wwv_flow_api.create_restful_template (
  p_id => 2460429360295882 + wwv_flow_api.g_id_offset
 ,p_module_id => 2432314419499488 + wwv_flow_api.g_id_offset
 ,p_uri_template => 'vijesti2'
 ,p_priority => 0
 ,p_etag_type => 'NONE'
  );
 
wwv_flow_api.create_restful_handler (
  p_id => 2460507327298907 + wwv_flow_api.g_id_offset
 ,p_template_id => 2460429360295882 + wwv_flow_api.g_id_offset
 ,p_source_type => 'FEED'
 ,p_format => 'DEFAULT'
 ,p_method => 'GET'
 ,p_require_https => 'NO'
 ,p_source => 
'select dat,naslov,tekst from vijest order by 1 desc'
  );
 
null;
 
end;
/

prompt  ...restful service
--
--application/restful_services/odjave
 
begin
 
wwv_flow_api.create_restful_module (
  p_id => 2438817393601895 + wwv_flow_api.g_id_offset
 ,p_name => 'odjave'
 ,p_uri_prefix => 'odjave/'
 ,p_parsing_schema => 'NOVINE'
 ,p_items_per_page => 25
 ,p_status => 'PUBLISHED'
  );
 
wwv_flow_api.create_restful_template (
  p_id => 2440016757705835 + wwv_flow_api.g_id_offset
 ,p_module_id => 2438817393601895 + wwv_flow_api.g_id_offset
 ,p_uri_template => 'check/{EMAJL}'
 ,p_priority => 0
 ,p_etag_type => 'HASH'
  );
 
wwv_flow_api.create_restful_handler (
  p_id => 2440109203883390 + wwv_flow_api.g_id_offset
 ,p_template_id => 2440016757705835 + wwv_flow_api.g_id_offset
 ,p_source_type => 'QUERY_1_ROW'
 ,p_format => 'DEFAULT'
 ,p_method => 'GET'
 ,p_require_https => 'NO'
 ,p_source => 
'SELECT novine.checkandhash(:EMAJL) emhash FROM DUAL'||unistr('\000a')||
''
  );
 
wwv_flow_api.create_restful_param (
  p_id => 2440216523913900 + wwv_flow_api.g_id_offset
 ,p_handler_id => 2440109203883390 + wwv_flow_api.g_id_offset
 ,p_name => 'EMAJL'
 ,p_bind_variable_name => 'EMAJL'
 ,p_source_type => 'URI'
 ,p_access_method => 'IN'
 ,p_param_type => 'STRING'
  );
 
wwv_flow_api.create_restful_template (
  p_id => 2438912185601895 + wwv_flow_api.g_id_offset
 ,p_module_id => 2438817393601895 + wwv_flow_api.g_id_offset
 ,p_uri_template => 'odjave/{INHASH}'
 ,p_priority => 0
 ,p_etag_type => 'NONE'
  );
 
wwv_flow_api.create_restful_handler (
  p_id => 2439004330601895 + wwv_flow_api.g_id_offset
 ,p_template_id => 2438912185601895 + wwv_flow_api.g_id_offset
 ,p_source_type => 'PLSQL'
 ,p_format => 'DEFAULT'
 ,p_method => 'PUT'
 ,p_require_https => 'NO'
 ,p_source => 
'BEGIN'||unistr('\000a')||
'UPDATE odjava'||unistr('\000a')||
'SET DATUM_ODJAVE = SYSDATE'||unistr('\000a')||
'WHERE EMAIL_HASH=:INHASH;'||unistr('\000a')||
'COMMIT;'||unistr('\000a')||
'END;'
  );
 
wwv_flow_api.create_restful_param (
  p_id => 2461731474599269 + wwv_flow_api.g_id_offset
 ,p_handler_id => 2439004330601895 + wwv_flow_api.g_id_offset
 ,p_name => 'INHASH'
 ,p_bind_variable_name => 'INHASH'
 ,p_source_type => 'URI'
 ,p_access_method => 'IN'
 ,p_param_type => 'STRING'
  );
 
null;
 
end;
/

commit;
begin
execute immediate 'begin sys.dbms_session.set_nls( param => ''NLS_NUMERIC_CHARACTERS'', value => '''''''' || replace(wwv_flow_api.g_nls_numeric_chars,'''''''','''''''''''') || ''''''''); end;';
end;
/
set verify on
set feedback on
set define on
prompt  ...done
