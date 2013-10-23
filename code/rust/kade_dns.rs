use std::libc::{c_int, c_char, size_t};
use std::cast;
use std::ptr;
use std::str;
use std::vec;

static ns_s_qd: c_int = 0; /*%< Query: Question. */
static ns_s_zn: c_int = 0; /*%< Update: Zone. */
static ns_s_an: c_int = 1; /*%< Query: Answer. */
static ns_s_pr: c_int = 1; /*%< Update: Prerequisites. */
static ns_s_ns: c_int = 2; /*%< Query: Name servers. */
static ns_s_ud: c_int = 2; /*%< Update: Update. */
static ns_s_ar: c_int = 3; /*%< Query|Update: Additional records. */
static ns_s_max: c_int = 4;

enum ns_type {
  ns_t_invalid = 0,   /*%< Cookie. */
  ns_t_a = 1,         /*%< Host address. */
  ns_t_ns = 2,        /*%< Authoritative server. */
  ns_t_md = 3,        /*%< Mail destination. */
  ns_t_mf = 4,        /*%< Mail forwarder. */
  ns_t_cname = 5,     /*%< Canonical name. */
  ns_t_soa = 6,       /*%< Start of authority zone. */
  ns_t_mb = 7,        /*%< Mailbox domain name. */
  ns_t_mg = 8,        /*%< Mail group member. */
  ns_t_mr = 9,        /*%< Mail rename name. */
  ns_t_null = 10,     /*%< Null resource record. */
  ns_t_wks = 11,      /*%< Well known service. */
  ns_t_ptr = 12,      /*%< Domain name pointer. */
  ns_t_hinfo = 13,    /*%< Host information. */
  ns_t_minfo = 14,    /*%< Mailbox information. */
  ns_t_mx = 15,       /*%< Mail routing information. */
  ns_t_txt = 16,      /*%< Text strings. */
  ns_t_rp = 17,       /*%< Responsible person. */
  ns_t_afsdb = 18,    /*%< AFS cell database. */
  ns_t_x25 = 19,      /*%< X_25 calling address. */
  ns_t_isdn = 20,     /*%< ISDN calling address. */
  ns_t_rt = 21,       /*%< Router. */
  ns_t_nsap = 22,     /*%< NSAP address. */
  ns_t_nsap_ptr = 23, /*%< Reverse NSAP lookup (deprecated). */
  ns_t_sig = 24,      /*%< Security signature. */
  ns_t_key = 25,      /*%< Security key. */
  ns_t_px = 26,       /*%< X.400 mail mapping. */
  ns_t_gpos = 27,     /*%< Geographical position (withdrawn). */
  ns_t_aaaa = 28,     /*%< Ip6 Address. */
  ns_t_loc = 29,      /*%< Location Information. */
  ns_t_nxt = 30,      /*%< Next domain (security). */
  ns_t_eid = 31,      /*%< Endpoint identifier. */
  ns_t_nimloc = 32,   /*%< Nimrod Locator. */
  ns_t_srv = 33,      /*%< Server Selection. */
  ns_t_atma = 34,     /*%< ATM Address */
  ns_t_naptr = 35,    /*%< Naming Authority PoinTeR */
  ns_t_kx = 36,       /*%< Key Exchange */
  ns_t_cert = 37,     /*%< Certification record */
  ns_t_a6 = 38,       /*%< IPv6 address (deprecated, use ns_t_aaaa) */
  ns_t_dname = 39,    /*%< Non-terminal DNAME (for IPv6) */
  ns_t_sink = 40,     /*%< Kitchen sink (experimentatl) */
  ns_t_opt = 41,      /*%< EDNS0 option (meta-RR) */
  ns_t_apl = 42,      /*%< Address prefix list (RFC3123) */
  ns_t_tkey = 249,    /*%< Transaction key */
  ns_t_tsig = 250,    /*%< Transaction signature. */
  ns_t_ixfr = 251,    /*%< Incremental zone transfer. */
  ns_t_axfr = 252,    /*%< Transfer zone of authority. */
  ns_t_mailb = 253,   /*%< Transfer mailbox records. */
  ns_t_maila = 254,   /*%< Transfer mail agent records. */
  ns_t_any = 255,     /*%< Wildcard match. */
  ns_t_zxfr = 256,    /*%< BIND-specific, nonstandard. */
  ns_t_max = 65536
}

enum ns_class {
  ns_c_invalid = 0, /*%< Cookie. */
  ns_c_in = 1,      /*%< Internet. */
  ns_c_2 = 2,       /*%< unallocated/unsupported. */
  ns_c_chaos = 3,   /*%< MIT Chaos-net. */
  ns_c_hs = 4,      /*%< MIT Hesiod. */
  /* Query class values which do not appear in resource records */
  ns_c_none = 254,  /*%< for prereq. sections in update requests */
  ns_c_any = 255,   /*%< Wildcard match. */
  ns_c_max = 65536
}

struct mx_info {
  priority: u16,
  name: ~str
}

struct ns_msg {
  _msg: *u8,
  _eom: *u8,
  _id: u16,
  _flags: u16,
  _counts: [u16, ..ns_s_max],
  _sections: [*u8, ..ns_s_max],
  _sect: c_int, /* enum */
  _rrnum: c_int,
  _msg_ptr: *u8
}
impl ns_msg {
  fn new() -> ns_msg {
    ns_msg {
      _msg: ptr::null(),
      _eom: ptr::null(),
      _id: 0u16,
      _flags: 0u16,
      _counts: [0u16, ..ns_s_max],
      _sections: [ptr::null(), ..ns_s_max],
      _sect: 0,
      _rrnum: 0,
      _msg_ptr: ptr::null()
    }
  }
  fn count(&self, section: c_int) -> int {
    return self._counts[section] as int;
  }
}

static NS_MAX_DNAME: int = 1025;

struct ns_rr {
  name: [c_char, ..NS_MAX_DNAME],
  _rr_type: u16,
  rr_class: u16,
  ttl: u32,
  rdlength: u16,
  rdata: *u8
}
impl ns_rr {
  fn new() -> ns_rr {
    ns_rr {
      name: [0 as c_char, ..NS_MAX_DNAME],
      _rr_type: 0u16,
      rr_class: 0u16,
      ttl: 0u32,
      rdlength: 0u16,
      rdata: ptr::null()
    }
  }
  fn rr_type(&self) -> ns_type {
    unsafe { cast::transmute(self._rr_type as u64) }
  }
}

#[link_args = "-lresolv"]
extern {
  fn __res_query(dname: *c_char,
                 rclass: c_int,
                 rtype: c_int,
                 answer: *mut u8,
                 len: c_int) -> c_int;
  fn ns_initparse(buffer: *u8, buffer_len: c_int, msg: *mut ns_msg) -> c_int;
  fn ns_parserr(msg: *ns_msg, section: c_int, idx: c_int, rr: *mut ns_rr) -> c_int;
  fn ns_name_uncompress(msg: *u8, eom: *u8, src: *u8, dst: *mut i8, dst_size: size_t) -> c_int;
}

#[fixed_stack_segment]
#[inline(never)]
pub fn mx_ping(address : &str) -> Result<Option<~[mx_info]>, ()> {
  let mut response = vec::from_elem(1024, 0u8);
  let response_len = do address.with_c_str |c_address| {
    unsafe {
      __res_query(c_address, ns_c_in as c_int, ns_t_mx as c_int,
                  vec::raw::to_mut_ptr(response),
                  response.len() as c_int)
    }
  };
  if (response_len < 0) {
    warn!(fmt!("res_query failed"));
    return Err(())
  }

  let mut msg = ns_msg::new();
  unsafe {
    if (ns_initparse(vec::raw::to_ptr(response), response_len, &mut msg) == -1) {
      warn!("ns_initparse failed");
      return Err(())
    }
  }

  let mut result : ~[mx_info] = ~[];
  let mut rr = ns_rr::new();
  for i in range(0, msg.count(ns_s_an)) {
    if (unsafe{ns_parserr(&msg, ns_s_an, i as c_int, &mut rr)} != 0) {
      warn!("ns_parserr failed");
      return Err(())
    }
    match rr.rr_type() {
      ns_t_mx => {
        let mut mx_data = vec::from_elem(1024, 0i8);
        let priority: u16 = unsafe {
          *ptr::offset(rr.rdata, 0) as u16 * 256 + (*ptr::offset(rr.rdata, 1) as u16)
        };
        if (unsafe{ns_name_uncompress(msg._msg,
                                      msg._eom,
                                      ptr::offset(rr.rdata, 2),
                                      vec::raw::to_mut_ptr(mx_data),
                                      mx_data.len() as size_t)} < 0) {
          warn!("ns_name_uncompress failed");
          return Err(())
        }
        let name = unsafe { str::raw::from_c_str(vec::raw::to_ptr(mx_data)) };
        result.push(mx_info { priority: priority, name: name });
      }
      ns_t_cname => { return Ok(None) }
      _ => { return Err(())}
    }
  }

  Ok(Some(result))
}
