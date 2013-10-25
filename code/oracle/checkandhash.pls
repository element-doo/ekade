create or replace function        checkAndHash( emajl varchar2 ) return raw
is
  retVal raw(20);
  pragma autonomous_transaction;
begin
  retVal := dbms_crypto.hash(utl_i18n.string_to_raw('TajnaSolOdjave:' || EMAJL), 3);
  
  merge into odjava t1 
  using (select retVal rv from dual) t2
  on (t1.email_hash=t2.rv)
  when matched then update set t1.datum_slanja=sysdate
  when not matched then insert (email_hash, datum_slanja ) values (t2.rv, sysdate);

  COMMIT;
  
  -- explodirat ce ako je unsubscribed jer nece naci nista (NO_DATA_FOUND)
  select email_hash into retVal
  from odjava where email_hash = retVal and datum_odjave is null;
  
  return retVal;
end;