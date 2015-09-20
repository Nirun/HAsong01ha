<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 7/2/2556
 * Time: 2:41 น.
 * To change this template use File | Settings | File Templates.
 */
class Report_m extends CI_Model
{
    var $context = array();

    function __construct()
    {
        parent::__construct();

    }

    function getActiveCourses(){
        $this->db->select('*');
        $this->db->from('tbl_courses');
        $this->db->where('isdelete', 0);
        //$this->db->where('IsActive', 0);
        if(isset($this->context["year"]) && trim($this->context["year"]!="")){
            $this->db->where('gen_year',$this->context["year"]);
        }

        $this->db->order_by('coursecode', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function paid1()
    {
        $sql = "";
        $courseID = $this->context['courseID'];
        $typeID = $this->context['typeID'];

        $condition ="";
        if($typeID != 0){
            $condition = " and registerBy=".$typeID ;
        }else{
            $condition ="";
        }

        $sql = '
                select
                    seatNo as seatNo,
                    case when prefix= 6  then  prefix_other
                             else title_th end as title,
                    t.name,t.lastname,
                    coalesce(h.name,hospitalother) as hospital,
                    case when ifnull(IsRep,0) <> 0 then type_name
                             else "" end as registerype1,
                    type_name as registerype,
                    i.name as receiptname,
                    concat(d.address," ",coalesce("",pv.PROVINCE_NAME)," ",d.postcode) as receiptaddress1,
                    i.address as receiptaddress2,
                    r.billing_ref1 as Ref1,
                    r.billing_ref2 as Ref2,
                    receipt_date as receiptdate,
                    case when r.refID = 0  then ifnull(Qty,1)
                             else "" end as qty,
                    case when ifnull(Qty,0) <> 0  then Qty * price
                             when ifnull(Qty,0) = 0 and r.refID <> 0 then ""
                             else price end as total
                    ,IsRep
                    from tbl_registration r
                    inner join tbl_trainees as t on r.traineeID = t.traineeID  and t.isdelete= 0
                    left join (
                        select  refID,1 as IsRep, count(registrationID) as Qty
                        from tbl_registration
                        where courseID = '.$courseID.'
                                  and IsPaid =1 and refID <> 0
                        group by refID
                    )rr on r.registrationID= rr.refID
                    left join tbl_prefix_name as p on  t.prefix = p.id
                    left join hospital as h on  h.hospitalID = t.hospitalID
                    left join province as pv on h.provinceid = pv.PROVINCE_ID
                    left join tbl_address as d on  d.traineeID = t.traineeID
                    join tbl_register_type as tr on  r.registerBy = tr.type_id
                    left join tbl_receipt_info as i on r.registrationID = i.register_id
                    join tbl_courses as c  on c.courseID = r.courseID
                    left join tbl_seats as s on r.registrationID = s.registrationID
                    where r.courseID = '.$courseID.'
                          and `receipt_date` <> "0000-00-00 00:00:00"
                          and r.IsPaid =1  '.$condition.'
                    order by receiptdate desc,r.billing_ref2 desc
               ';
        $query = $this->db->query($sql);
        return $query->result_array();

    }

    function receipt()
    {
        $sql = "";
        $courseID = $this->context['courseID'];
        $typeID = $this->context['typeID'];

        $condition ="";
        if($typeID != 0){
            $condition = " and registerBy=".$typeID ;
        }else{
            $condition ="";
        }

        $sql = '
                select
                    seatNo as seatNo,
                    case when prefix= 6  then  prefix_other
                             else title_th end as title,
                    t.name,t.lastname,t.hospitalid,r.refid,
                    hs.hospitalname,hs.hospitalother,
                    coalesce(hs.hospitalname,hs.hospitalother) as hospital,
                    coalesce(h.name,t.hospitalother) as hospital22,
                    type_name as registerype,
                    case when i.name = "" then CONCAT(t.name, " ", t.lastname)
                              else ifnull(i.name,CONCAT(t.name, " ", t.lastname))  end as receiptname,
                    i.address as receiptaddress,i.soi,i.road,i.district,i.province,i.postcode,
                    r.billing_ref1 as Ref1,
                    r.billing_ref2 as Ref2,
                    receipt_date as receiptdate,
                    price
                from tbl_registration r
                    inner join tbl_trainees as t on r.traineeID = t.traineeID  and t.isdelete= 0
                    left join tbl_prefix_name as p on  t.prefix = p.id
                    left join hospital as h on  h.hospitalID = t.hospitalID
                    left join province as pv on h.provinceid = pv.PROVINCE_ID
                    join tbl_register_type as tr on  r.registerBy = tr.type_id
                    join tbl_receipt_info as i on r.registrationID = i.register_id
                    join tbl_courses as c  on c.courseID = r.courseID
                    join tbl_seats as s on r.registrationID = s.registrationID
                    join (
                          select ts.hospitalID,ts.traineeID,hh.name hospitalname,ts.hospitalother
                          from tbl_trainees ts
                               join tbl_registration rr on rr.traineeID = ts.traineeID  and ts.isdelete= 0 and rr.isdelete = 0
                               left join hospital hh on ts.hospitalID = hh.hospitalID
                          where rr.courseID = '.$courseID.' and rr.IsPaid =1
                          group by ts.hospitalID,ts.traineeID,hh.name,ts.hospitalother
                    ) hs  on hs.traineeID = r.billing_ref1
                where r.courseID = '.$courseID.'
                      and `receipt_date` <> "0000-00-00 00:00:00"
                      and r.IsPaid =1 and r.isdelete = 0 '.$condition.'
                order by seatNo asc
        ';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function register(){
        $sql = "";
        $courseID = $this->context['courseID'];
        $sql = '
                select
                    seatNo as seatNo,
                    case when prefix= 6  then  prefix_other
                         else p.title_th end as title,
                    t.name,t.lastname,
                    coalesce(hs.hospitalname,hs.hospitalother) as hospital,
                    coalesce(h.name,t.hospitalother) as hospital22,
                    o.title_th  as occupation,
                    r.billing_ref2 as Ref2
                from tbl_registration r
                    inner join tbl_trainees as t on r.traineeID = t.traineeID  and t.isdelete= 0
                    left join tbl_prefix_name as p on  t.prefix = p.id
                    left join hospital as h on  h.hospitalID = t.hospitalID
                    left join province as pv on h.provinceid = pv.PROVINCE_ID
                    left join tbl_address as d on  d.traineeID = t.traineeID
                    left join tbl_occupation  as o on  o.id =t.professiontypeID
                    join tbl_courses as c  on c.courseID = r.courseID
                    join tbl_seats as s on r.registrationID = s.registrationID
                    join (
                          select ts.hospitalID,ts.traineeID,hh.name hospitalname,ts.hospitalother
                          from tbl_trainees ts
                               join tbl_registration rr on rr.traineeID = ts.traineeID  and ts.isdelete= 0 and rr.isdelete = 0
                               left join hospital hh on ts.hospitalID = hh.hospitalID
                          where rr.courseID = '.$courseID.' and rr.IsPaid =1
                          group by ts.hospitalID,ts.traineeID,hh.name,ts.hospitalother
                    ) hs  on hs.traineeID = r.billing_ref1
                where r.courseID = '.$courseID.'
                      and r.IsPaid =1 and r.isdelete = 0
                order by seatNo asc
                ';
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    function paid()
    {
        $sql = "";
        $courseID = $this->context['courseID'];
        $typeID = $this->context['typeID'];

        $condition ="";
        if($typeID != 0){
            $condition = " and registerBy=".$typeID ;
        }else{
            $condition ="";
        }

        $sql = '
                select
                    seatNo as seatNo,
                    case when prefix= 6  then  prefix_other
                             else title_th end as title,
                    t.name,t.lastname,
                    coalesce(hs.hospitalname,hs.hospitalother) as hospital,
                    type_name as registerype,
                    case when i.name = "" then CONCAT(t.name, " ", t.lastname)
                              else ifnull(i.name,CONCAT(t.name, " ", t.lastname))  end as receiptname,
                    i.address as receiptaddress,i.soi,i.road,i.district,i.province,i.postcode,
                    r.billing_ref1 as Ref1,
                    r.billing_ref2 as Ref2,
                    receipt_date as receiptdate,
                    price
                from tbl_registration r
                    inner join tbl_trainees as t on r.traineeID = t.traineeID  and t.isdelete= 0
                    left join tbl_prefix_name as p on  t.prefix = p.id
                    left join hospital as h on  h.hospitalID = t.hospitalID
                    left join province as pv on h.provinceid = pv.PROVINCE_ID
                    join tbl_register_type as tr on  r.registerBy = tr.type_id
                    join tbl_receipt_info as i on r.registrationID = i.register_id
                    join tbl_courses as c  on c.courseID = r.courseID
                    join tbl_seats as s on r.registrationID = s.registrationID
                    join (
                          select ts.hospitalID,ts.traineeID,hh.name hospitalname,ts.hospitalother
                          from tbl_trainees ts
                               join tbl_registration rr on rr.traineeID = ts.traineeID  and ts.isdelete= 0 and rr.isdelete = 0
                               left join hospital hh on ts.hospitalID = hh.hospitalID
                          where rr.courseID = '.$courseID.' and rr.IsPaid =1
                          group by ts.hospitalID,ts.traineeID,hh.name,ts.hospitalother
                    ) hs  on hs.traineeID = r.billing_ref1
                where r.courseID = '.$courseID.'
                      and `receipt_date` <> "0000-00-00 00:00:00"
                      and r.IsPaid =1 and r.isdelete = 0 '.$condition.'
                order by seatNo asc
               ';
        $query = $this->db->query($sql);
        return $query->result_array();

    }

}
