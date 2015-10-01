<?php

class Course_m extends CI_Model
{
    var $context = array();

    function __construct()
    {
        parent::__construct();

    }

    function getCountCourseList($cYear = false)
    {
        $arr = $this->context['filter'];

        if(empty($arr)){
            $sql = "SELECT c.courseID FROM (tbl_courses as c)
            LEFT JOIN ( select s.courseID,count(seatID) CntReg from tbl_seats s
            inner join tbl_registration r on s.registrationID = r.registrationID and r.isdelete =0
            inner join tbl_trainees as t on r.traineeid = t.traineeid and t.isdelete = 0 group by s.courseID ) as r ON c.courseID = r.courseID
            WHERE c.IsDelete = 0 AND c.IsActive = 0 ";
            if($cYear){
                $sql .=" AND c.gen_year = ".date('Y');
            }
            $sql .=" GROUP BY c.courseID, startdate, enddate, coursecode, coursename, generation, limittrainees, c.IsActive ORDER BY startdate asc";
            $res = $this->db->query($sql);
            $total = (count($res->result_array()));
        }else{
            $_course = (isset($arr['course'])) ? (int)$arr['course'] : 0;
            $_month = (isset($arr['month'])) ? (int)$arr['month'] : 0;
            $_year = (isset($arr['year'])) ? (int)$arr['year'] : 0;
            $_status = (isset($arr['status'])) ? (int)$arr['status'] : '';

            $this->db->select('c.courseID,startdate,enddate,coursecode,coursename,
                           generation,limittrainees,IsActive,CntReg');
            $this->db->from('tbl_courses as c');
            $this->db->join('(
            select s.courseID,count(seatID) CntReg
            from tbl_seats  s
            inner join tbl_registration r on s.registrationID = r.registrationID
            inner join tbl_trainees as t on r.traineeid = t.traineeid and t.isdelete = 0
            group by s.courseID
        ) as r ', 'c.courseID = r.courseID', 'left');

            /*filter*/
            // ($_course != '') ? $this->db->where('c.coursecode', $_course) : '';

            ($_course != 0) ? $this->db->where('c.courseID', $_course) : '';
            ($_month != 0) ? $this->db->where('month(startdate)', $_month) : '';
            ($_year != 0) ? $this->db->where('year(startdate)', $_year - 543) : '';
            ($_status != '') ? $this->db->where('c.IsActive', $_status) : '';

            $this->db->where('c.IsDelete', 0);
            $this->db->group_by('c.courseID,startdate,enddate,coursecode,coursename,generation,limittrainees,c.IsActive');
            $res = $this->db->get()->result_array();
            $total = count($res);
        }

        return $total;

    }

    function getCourseList($cYear = false)
    {
        $this->db->select('c.courseID,startdate,enddate,coursecode,coursename,
                           generation,limittrainees,IsActive,CntReg');
        $this->db->from('tbl_courses as c');
        $this->db->join('(
            select s.courseID,count(seatID) CntReg
            from tbl_seats  s
            inner join tbl_registration r on s.registrationID = r.registrationID and r.isdelete =0
            inner join tbl_trainees as t on r.traineeid = t.traineeid and t.isdelete = 0
            group by s.courseID
        ) as r ', 'c.courseID = r.courseID', 'left');

        if ($this->context['courseID'] != 0) {
            $this->db->where('r.courseID', $this->context['courseID']);
        }
        $this->db->where('c.IsDelete', 0);
        $this->db->where('c.IsActive', 0);
        if($cYear){
            $this->db->where('c.gen_year', date('Y'));
        }

        $this->db->group_by('c.courseID,startdate,enddate,coursecode,coursename,generation,limittrainees,c.IsActive');
       if($cYear){
           $this->db->order_by('c.courseID', 'desc');
       }
        else{
            $this->db->order_by('startdate', 'asc');
        }

        $this->db->limit($this->context['limit'], $this->context['page']);
        $query = $this->db->get();
       // print_r($this->db->select()->queries);
        return $query->result_array();
    }

    function searchCourse()
    {
        $arr = $this->context['filter'];
        //$_course = (isset($arr['course'])) ? $arr['course'] : '';
        $_course = (isset($arr['course'])) ? (int)$arr['course'] : 0;
        $_month = (isset($arr['month'])) ? (int)$arr['month'] : 0;
        $_year = (isset($arr['year'])) ? (int)$arr['year'] : 0;
        $_status = (isset($arr['status'])) ? (int)$arr['status'] : '';

        $this->db->select('c.courseID,startdate,enddate,coursecode,coursename,
                           generation,limittrainees,IsActive,CntReg');
        $this->db->from('tbl_courses as c');
        $this->db->join('(
            select s.courseID,count(seatID) CntReg
            from tbl_seats  s
            inner join tbl_registration r on s.registrationID = r.registrationID
            inner join tbl_trainees as t on r.traineeid = t.traineeid and t.isdelete = 0
            group by s.courseID
        ) as r ', 'c.courseID = r.courseID', 'left');

        /*filter*/
        // ($_course != '') ? $this->db->where('c.coursecode', $_course) : '';

        ($_course != 0) ? $this->db->where('c.courseID', $_course) : '';
        ($_month != 0) ? $this->db->where('month(startdate)', $_month) : '';
        ($_year != 0) ? $this->db->where('year(startdate)', $_year - 543) : '';
        ($_status != '') ? $this->db->where('c.IsActive', $_status) : '';
        $this->db->where('c.IsDelete', 0);
        $this->db->group_by('c.courseID,startdate,enddate,coursecode,coursename,generation,limittrainees,c.IsActive');
        $this->db->order_by('startdate', 'asc');

        //var_dump($this->db);

        $this->db->limit($this->context['limit'], $this->context['page']);
        $query = $this->db->get();
        return $query->result_array();

    }

    function countsearchCourse()
    {
        $arr = $this->context['filter'];
        //$_course = (isset($arr['course'])) ? $arr['course'] : '';
        $_course = (isset($arr['course'])) ? (int)$arr['course'] : 0;
        $_month = (isset($arr['month'])) ? (int)$arr['month'] : 0;
        $_year = (isset($arr['year'])) ? (int)$arr['year'] : 0;

        $this->db->select('c.courseID,startdate,enddate,coursecode,coursename,
                           generation,limittrainees,CntReg');
        $this->db->from('tbl_courses as c');
        $this->db->join('(
            select s.courseID,count(seatID) CntReg
            from tbl_seats  s
            inner join tbl_registration r on s.registrationID = r.registrationID
            inner join tbl_trainees as t on r.traineeid = t.traineeid and t.isdelete = 0
            group by s.courseID
        ) as r ', 'c.courseID = r.courseID', 'inner');

        /*filter*/
        //($_course != '') ? $this->db->where('c.coursecode', $_course) : '';
        ($_course != 0) ? $this->db->where('c.courseID', $_course) : '';
        ($_month != 0) ? $this->db->where('month(startdate)', $_month) : '';
        ($_year != 0) ? $this->db->where('year(startdate)', $_year - 543) : '';

        $this->db->where('c.IsDelete', 0);

        $this->db->group_by('c.courseID,startdate,enddate,coursecode,coursename,generation,limittrainees');
        return $this->db->count_all_results();
    }

    function getAllCourses($IsActive = false)
    {
        $this->db->select('*');
        $this->db->from('tbl_courses');
        $this->db->where('isdelete', 0);
        ($IsActive) ? $this->db->where('IsActive', 0) : null;
//        $this->db->order_by('coursecode', 'asc');
        $this->db->order_by('gen_year', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCourseCode()
    {
        $this->db->select('*');
        $this->db->from('tbl_courses');
        $this->db->where('isdelete', 0);
        $this->db->where('IsActive', 0);
//        $this->db->order_by('coursecode', 'asc');
        $this->db->order_by('gen_year', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getOptionals()
    {
        return $this->db->get('tbl_optionals')->result_array();
    }

    function getCourseType()
    {
        return $this->db->get('tbl_coursetype')->result_array();
    }

    function getCourse($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_courses');
        $this->db->where('courseID', $id);
        $this->db->limit(1, 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCourseOptionals($id)
    {
        $this->db->select('courseoptID,optionalID');
        $this->db->from('tbl_courseoptionals');
        $this->db->where('courseID', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCourseOptionalsList($id)
    {
        $this->db->select('optional');
        $this->db->from('tbl_courseoptionals');
        $this->db->join('tbl_optionals', 'tbl_courseoptionals.optionalID = tbl_optionals.optionalID', 'inner');
        $this->db->where('tbl_courseoptionals.courseID', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCountCourseRegister($id = 0, $ispaid)
    {
        $this->db->select('r.registrationID');
        $this->db->from('tbl_registration r');
        $this->db->join('tbl_trainees as t', 'r.traineeid = t.traineeid', 'inner');

        /*filter*/
        ($id != 0) ? $this->db->where('r.courseID', $id) : '';
        ($ispaid != 0) ? $this->db->where('r.IsPaid', $ispaid) : '';

        $this->db->where('r.refType', 0);
        $this->db->where('t.isdelete', 0);
        $this->db->where('r.isdelete', 0);

        $this->db->group_by('r.courseID');
        return $this->db->count_all_results();
    }

    function getCountPaid($id = 0)
    {
        $this->db->select('seatID');
        $this->db->from('tbl_seats s');
        $this->db->join('tbl_registration r', 's.registrationID = r.registrationID', 'inner');
        $this->db->join('tbl_trainees as t', 'r.traineeid = t.traineeid', 'inner');

        /*filter*/
        ($id != 0) ? $this->db->where('s.courseID', $id) : '';
        $this->db->where('r.isdelete', 0);

        $this->db->group_by('s.courseID');
        return $this->db->count_all_results();
    }

    function getCoursesByMonth($m)
    {
        $this->db->select('*');
        $this->db->from('tbl_courses');
        $where = "(isActive = 0) and (IsDelete = 0) and (month(startdate) = " . $m . " or month(enddate) = " . $m . ")";
        $this->db->where($where);
        $this->db->order_by('coursetypeID', 'DESC');
        $this->db->order_by('startdate', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getRegisterCoursesByMonth($m)
    {
        $current = date('Y-m-d :00:00:00');
        $this->db->select('*');
        $this->db->from('tbl_courses');
        // $where = "(isActive = 0) and (IsDelete = 0) and (month(registstartdate) = " . $m . " or month(registenddate) = " . $m . ")";
        $where = "(isActive = 0) and (IsDelete = 0) and (registstartdate <= '" . $current . "' and  registenddate >= '" . $current . "')";
        $this->db->where($where);
        $this->db->order_by('courseTypeID', 'desc');
        $this->db->order_by('registstartdate', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getRegistrationList($id = 0)
    {
        $sql = '
                 select
                    seatno,r.registrationID,r.courseID, r.registerdatetime,tr.type_name, r.registerBy,r.IsPaid,r.receipt_date,r.refID,r.reftype,
                    t.traineeID,t.prefix,p.title_th,t.prefix_other,t.name,t.lastname,t.positionID,o.title_th as occupation,positionother,
                    concat(d.address," ",coalesce(d.address,pv.PROVINCE_NAME)," ",d.postcode) as address,
                    t.email,d.tel,d.mobile,
                    t.hospitalID,h.name as hospitalname,pv.PROVINCE_NAME as province,hospitalother,
                    ct.title_th as cprefix ,ct.prefix_other as cpother,ct.name as cpname ,ct.lastname as cplastname,f.food
                from  tbl_seats as s
                    inner join tbl_registration as r on s.registrationID = r.registrationID and r.isdelete =0
                    inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete =0
                    inner join tbl_register_type as tr on r.registerBy= tr.type_id
                    left join tbl_prefix_name as p on t.prefix = p.id
                    left join tbl_occupation  as o on  o.id =t.positionID
                    left join tbl_address as d on  d.traineeID = t.traineeID
                    left join hospital as h on h.hospitalID = t.hospitalID
                    left join province as pv on h.provinceid = pv.PROVINCE_ID
                    left join tbl_changetraineehistory as c on r.traineeID = c.mastertraineeID and c.isChange = 0
                    left join (
                       select  tt.traineeID,pp.title_th,tt.prefix_other,tt.name,tt.lastname
                       from tbl_trainees  tt
                       inner join tbl_prefix_name as pp on tt.prefix = pp.id
                    )ct on ct.traineeID = c.traineeID
                    left join tbl_food_type as f on f.food_id = r.food_id
                where r.courseID = ' . $id . ' and  r.IsPaid = 1
                order by seatno asc
               ';

        $query = $this->db->query($sql);
        return $query->result_array();


    }

    function getDocsList($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_docs');
        $this->db->where('courseID', $id);
        $this->db->where('isdelete', 0);
        $this->db->order_by('docID', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCourseName($id)
    {
        $query = $this->db->query('SELECT concat(coursecode,":",coursename," รุ่นที่ ",generation) as precourse
                                   FROM tbl_courses WHERE courseID =' . $id . ' LIMIT 1');
        $row = $query->row();
        return $row->precourse;
    }

    function getPrecourse($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_prerequisite');
        $this->db->where('courseID', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getChangeTraineeHistory($id)
    {
        $this->db->select('t.prefix as mprefix,p.title_th  as mtitle,t.prefix_other as mpreother,
                           t.name as mname,t.lastname as mlastname,tcprefix,tctitle,tcpreother,
                           c.name,c.lastname,c.changedatetime');
        $this->db->from('tbl_trainees as t');
        $this->db->join('tbl_prefix_name as p', 't.prefix = p.id', 'inner');
        $this->db->join('tbl_changetraineehistory as c', 'c.mastertraineeID = t.traineeID', 'inner');
        $this->db->join('(select tc.traineeID,tc.prefix as tcprefix,pp.title_th  as tctitle,tc.prefix_other as tcpreother
                          from tbl_trainees as tc inner join tbl_prefix_name as pp on tc.prefix = pp.id ) as th',
            'th.traineeID = c.traineeID');
        $this->db->where('c.courseID', $id);
        $this->db->where('c.isChange', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    function checkTrainee()
    {
        $this->db->select('traineeID');
        $this->db->from('tbl_trainees');
        $this->db->where('name', $this->context['fname']);
        $this->db->where('lastname', $this->context['lname']);
        $this->db->where('isdelete', 0);
        $this->db->limit(1, 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->traineeID;
        }

        return 0;
    }

    function getTraineeDetails($id)
    {
        $this->db->select(' t.traineeID,prefix,p.title_th as title,prefix_other,t.name,t.lastname,cardID,photo,
                            email,cohosname,cohoslastname,cohostel,cohosmobile,cohosfax,cohosemail,
                            t.professiontypeID,o.title_th as occupation,professionother,
                            t.hospitalID,hospitalother,h.name as hospitalname,pv.PROVINCE_NAME as province,
                            t.positionID,position,positionother,registrationtype,type_name as typename,
                            address_type_name,a.address as taddress, pvs.PROVINCE_NAME as tprovince,
                            a.postcode,a.tel,a.mobile,a.fax
                            ');
        $this->db->from('tbl_trainees as t');
        $this->db->join('tbl_prefix_name as p', 't.prefix = p.id', 'left');
        $this->db->join('tbl_register_type as tr', 't.registrationtype = tr.type_id', 'left');
        $this->db->join('tbl_professiontype as pt', 't.professiontypeID = pt.professiontypeID', 'left');
        $this->db->join('tbl_position as ps', 'ps.positionID = t.positionID', 'left');
        $this->db->join('tbl_occupation as o', 't.positionID = o.id', 'left');
        $this->db->join('hospital as h', 'h.hospitalID = t.hospitalID', 'left');
        $this->db->join('province as pv', 'h.provinceid = pv.PROVINCE_ID', 'left');
        $this->db->join('tbl_address as a ', 'a.traineeID = t.traineeID and  a.IsDelete = 0', 'left');
        $this->db->join('tbl_address_type as at', 'a.placetype = at.address_type_id', 'left');
        $this->db->join('province as pvs', 'a.provinceid = pvs.PROVINCE_CODE', 'left');
        $this->db->where('t.traineeID', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCourseByTrainee($id = 0)
    {
        $this->db->select('c.startdate,c.enddate,c.coursecode,c.generation,coursename,
                           r.paymentID,pt.paymenttype,p.detail,p.cheuqeno,
                           p.bankname,rt.type_name as typename');
        $this->db->from('tbl_registration as r');
        $this->db->join('tbl_trainees as t', 'r.traineeID=t.traineeID', 'left');
        $this->db->join('tbl_register_type as rt', 'rt.type_id=t.registrationtype', 'left');
        $this->db->join('tbl_courses as c', 'c.courseID=r.courseID', 'left');
        $this->db->join('tbl_payment as p', 'p.paymentID=r.paymentID', 'left');
        $this->db->join('tbl_paymenttype as pt', 'pt.paymenttypeID=p.paymenttypeID', 'left');
        $this->db->order_by('r.registrationID', 'desc');
        $this->db->where('r.traineeID', $id);
        $this->db->where('r.isdelete', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getRegistrationListbyTrainee($id, $rid = 0)
    {
        $sql = '
                select  r.registrationID,t.traineeID,t.prefix,p.title_th,t.prefix_other,t.name,t.lastname,t.cardID,t.photo,
                        c.startdate,c.enddate,c.coursecode,c.generation,coursename,place,
                        t.hospitalID,hospitalother,h.name as hospitalname,pv.PROVINCE_NAME as province,
                        registrationtype,type_name,registerdatetime,registerstatus,IsPaid,
                        ct.title_th as cprefix ,ct.prefix_other as cpother,ct.name as cpname,ct.lastname as cplastname,
                        ct.cardID as cpcardID ,ct.photo as cpphoto,c.gen_year,s.seatNo
                from
                        tbl_registration as r
                        inner join tbl_trainees as t on r.traineeID = t.traineeID and r.isdelete = 0
                        inner join tbl_prefix_name as p on t.prefix = p.id
                        inner join tbl_register_type as tr on t.registrationtype = tr.type_id
                        left join tbl_courses as c on c.courseID=r.courseID
                        left join hospital as h on h.hospitalID = t.hospitalID
                        left join province as pv on h.provinceid = pv.PROVINCE_ID
                        left join tbl_changetraineehistory as ch on r.traineeID = ch.mastertraineeID and ch.isChange = 0
                        left join (
                           select  tt.traineeID,tt.prefix,pp.title_th,tt.prefix_other,tt.name,tt.lastname,tt.cardID,tt.photo
                           from tbl_trainees  tt
                           inner join tbl_prefix_name as pp on tt.prefix = pp.id
                        )ct on ct.traineeID = ch.traineeID
                         left join tbl_seats as s on s.registrationID = r.registrationID
                ';
        if ($rid != 0) {
            $sql .= ' where r.courseID =' . $id . ' and r.registrationID in (' . $rid . ')';
        } else {
            $sql .= ' where r.courseID =' . $id;
        }


        $sql .= ' and  r.IsPaid = 1 and r.reftype <> 1
                  order by r.registrationID asc
                ';

        $query = $this->db->query($sql);

        return $query->result_array();
    }

    function getCoursePayment()
    {
        $arr = $this->context['filter'];
        //$_course = (isset($arr['course'])) ? $arr['course'] : '';
        $_course = (isset($arr['course'])) ? (int)$arr['course'] : 0;
        $_month = (isset($arr['month'])) ? (int)$arr['month'] : 0;
        $_year = (isset($arr['year'])) ? (int)$arr['year'] : 0;
        $_ref1 = (isset($arr['ref1'])) ? $arr['ref1'] : '';
        $_ref2 = (isset($arr['ref2'])) ? $arr['ref2'] : '';

        if (!empty($arr)) {
            $condition = '';
            if ($_course != '') {
                //$condition .= " and coursecode =  '" . $_course . "' ";
                $condition .= ' and r.courseid =  ' . $_course;
            } else {
                $condition .= '';
            }

            if ($_month != 0) {
                $condition .= ' and month(startdate) =' . $_month . '';
            } else {
                $condition .= '';
            }

            if ($_year != '') {
                $year = $_year;
            } else {
                $year = 0;
            }

            if ($year != 0) {
                $year = $_year - 543;
                $condition .= ' and year(startdate) =' . $year . '';
            } else {
                $condition .= '';
            }

            if ($_ref1 != '') {
                $condition .= " and r.billing_ref1 =  '" . $_ref1 . "' ";
            } else {
                $condition .= '';
            }

            if ($_ref2 != '') {
                $condition .= " and r.billing_ref2 =  '" . $_ref2 . "' ";
            } else {
                $condition .= '';
            }

            if ($condition != '') {
                $sql = 'select  c.courseID
                        from tbl_registration  r
                        inner join  tbl_courses c on c.courseID = r.courseID and r.isdelete=0
                        left join tbl_ref_no as rn on r.registrationID = rn.registrationID
                        where c.isdelete = 0 ' . $condition . '
                        group by courseID';

                $query = $this->db->query($sql);
                return $query->result_array();
            }
        }
    }

    function getPaymentList($id = 0)
    {
        $arr = $this->context['filter'];
        $_ref1 = (isset($arr['ref1'])) ? $arr['ref1'] : '';
        $_ref2 = (isset($arr['ref2'])) ? $arr['ref2'] : '';

        $condition = '';

        if ($id != 0) {
            $condition .= ' and r.courseID =' . $id . '';
        } else {
            $condition .= '';
        }

        if ($_ref1 != '') {
            $condition .= " and r.billing_ref1 =  '" . $_ref1 . "' ";
        } else {
            $condition .= '';
        }

        if ($_ref2 != '') {
            $condition .= " and r.billing_ref2 =  '" . $_ref2 . "' ";
        } else {
            $condition .= '';
        }

        if ($condition != '') {
            $sql = 'select
                        r.registrationID,r.courseID,r.traineeID,r.refID,r.reftype,
                        r.registerby,r.billing_ref1,r.billing_ref2,
                        case when (r.refID=0 and r.reftype = 1 and  r.registerby = 3)
                             then (select count(rr.registrationID) from tbl_registration rr where rr.refID = r.registrationID and rr.isdelete=0)
                             else 1 end as member,
                        r.receipt_date,
                        r.registerdatetime,
                        datediff(now(),r.registerdatetime) as dateOver,
                        r.ReQueue_Date,
                        r.IsPaid,r.paymentID,
                        prefix,title_th,prefix_other,t.name,t.lastname,
                        h.name as hospitalname,pv.PROVINCE_NAME as province,hospitalother,
                        type_name
                    from tbl_registration r
                    inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete = 0
                    inner join tbl_prefix_name as p on  t.prefix = p.id
                    inner join tbl_register_type as tr on r.registerby= tr.type_id
                    left join hospital as h on  h.hospitalID = t.hospitalID
                    left join province as pv on h.provinceid = pv.PROVINCE_ID
                    left join tbl_ref_no as rn on r.registrationID = rn.registrationID
                    where r.refID = 0 and r.isdelete=0   ' . $condition . '
                    order by r.registrationID asc
                    ';
            $query = $this->db->query($sql);
            return $query->result_array();
        }

    }

    function getReceiptDetails($id, $rtype, $refid)
    {
        $condition = '';
        if ($rtype == 3 && $refid == 0) {
            $condition .= " r.refid = " . $id;
        } else {
            $condition .= " r.registrationID = " . $id;
        }

        $sql = 'select  r.registrationID,r.paymentid, r.billing_ref1,r.billing_ref2,
                         case when r.registrationID > 9999 then rn.billing_ref2
                              else r.billing_ref2  end as billing_ref22,
                        ri.name, ri.address,r.receipt_date
                from  tbl_registration as r
                left join tbl_payment as p on p.paymentid = r.paymentid
                left join tbl_receipt_info as ri on ri.register_id = r.registrationid
                left join tbl_ref_no as rn on r.registrationID = rn.registrationID
                where r.isdelete=0 and ' . $condition . '
                group by r.paymentid, r.billing_ref1, r.billing_ref2, ri.name, ri.address';

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getReceiptInfo($id, $rtype, $refid)
    {
        $condition = '';
        if ($rtype == 3 && $refid == 0) {
            $condition .= " r.refid = " . $id;
        } else {
            $condition .= " r.registrationID = " . $id;
        }

        $sql = 'select  r.registrationID, r.billing_ref1,r.billing_ref2,
                        ri.name, ri.address,r.receipt_date
                from  tbl_registration as r
                left join tbl_payment as p on p.paymentid = r.paymentid
                left join tbl_receipt_info as ri on ri.register_id = r.registrationid
                left join tbl_ref_no as rn on r.registrationID = rn.registrationID
                where r.isdelete=0 and ' . $condition . '
                group by r.paymentid, r.billing_ref1, r.billing_ref2, ri.name, ri.address';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getTraineesList($id, $rtype, $refid)
    {

        $condition = '';
        if ($rtype == 3 && $refid == 0) {
            $condition .= " r.refid = " . $id;
        } else {
            $condition .= " r.registrationID = " . $id;
        }

        $sql = 'select  r.registrationid,prefix,title_th,prefix_other, t.name, t.lastname, refid, r.traineeid, registerby
                from tbl_registration as r
                inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete = 0
                left join tbl_prefix_name as p on  t.prefix = p.id
                where ispaid <> 1 and r.isdelete=0 and ' . $condition;

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getCourseConfirm($id, $pid = 0, $rtype = 0)
    {
        $sql = 'select r.courseid,paymentid,refid,
                c.coursecode,c.coursename,c.startdate,c.enddate,c.place,prefix,title_th,prefix_other,t.name,t.lastname,
                r.registerdatetime,r.ReQueue_Date
                from tbl_registration as r
                inner join tbl_courses  as c on r.courseID = c.courseID and r.isdelete = 0
                inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete = 0
                left join tbl_prefix_name as p on  t.prefix = p.id
                where r.registrationid =  ' . $id;

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getCourseDetails($id, $pid = 0, $rtype = 0)
    {
        $sql = 'select r.courseid,paymentid,refid,
                c.coursecode,c.coursename,c.startdate,c.enddate,c.place,prefix,title_th,prefix_other,t.name,t.lastname,
                r.registerdatetime, ADDDATE(r.ReQueue_Date,7) duedate
                from tbl_registration as r
                inner join tbl_courses  as c on r.courseID = c.courseID
                inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete = 0
                left join tbl_prefix_name as p on  t.prefix = p.id
                where r.registrationid =  ' . $id;

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getTraineesDetails($id, $rtype, $refid)
    {

        $condition = '';
        if ($rtype == 3 && $refid == 0) {
            $condition .= " r.refid = " . $id;
        } else {
            $condition .= " r.registrationID = " . $id;
        }

        $sql = 'select  r.registrationid,prefix,title_th,prefix_other, t.name, t.lastname, refid, r.traineeid, registerby
                from tbl_registration as r
                inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete = 0
                left join tbl_prefix_name as p on  t.prefix = p.id
                where ispaid <> 1  and ' . $condition;

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getSeatList($id, $rtype, $refid)
    {
        $condition = '';
        if ($rtype == 3 && $refid == 0) {
            $condition .= " r.refid = " . $id;
        } else {
            $condition .= " r.registrationID = " . $id;
        }
        $sql = 'select  r.registrationid,prefix,title_th,prefix_other,t.name,t.lastname,s.seatno
                from tbl_registration as r
                inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete = 0
                left join tbl_prefix_name as p on  t.prefix = p.id
                inner join tbl_seats as s on s.registrationID= r.registrationID
                where r.isdelete = 0 and ' . $condition;

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getReceiptEmails($id)
    {
        $this->db->select('email');
        $this->db->from('tbl_trainees');
        $this->db->where('traineeid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }


    function addCourse()
    {
        $data = array(
            'coursecode' => $this->input->post('coursecode'),
            'coursename' => $this->input->post('coursename'),
            'generation' => $this->input->post('generation'),
            'coursetypeID' => $this->input->post('coursetype'),
            'qualification' => $this->input->post('qualification'),
            'objective' => $this->input->post('objective'),
            'content' => $this->input->post('content'),
            'startdate' => $this->input->post('startdate'),
            'enddate' => $this->input->post('enddate'),
            'days' => $this->input->post('days'),
            'registstartdate' => $this->input->post('registstartdate'),
            'registenddate' => $this->input->post('registenddate'),
            'limittrainees' => $this->input->post('limittrainees'),
            'price' => $this->input->post('price'),
            'optionalother' => $this->input->post('optionalother'),
            'speaker' => $this->input->post('speaker'),
            'place' => $this->input->post('place'),
            'maplink' => $this->input->post('maplink'),
            'gen_year' => $this->input->post('gen_year'),
            'payenddate' => $this->input->post('payenddate'),
            'map' => $this->context['picture'],
            'IsDelete' => 0,
            'createdatetime' => date('Y-m-d H:i:s'),
            'createuser' => $this->context['adminID'],
            'group_condition' => $this->context['group_condition']

        );

        $this->db->trans_begin();
        $chkInsert = $this->db->insert('tbl_courses', $data);
        $courseID = $this->db->insert_id();

        if (!$chkInsert) {
            $this->db->trans_rollback();
        } else {

            //precourse
            $presourse = $this->input->post('precourseID');
            if ($presourse !== "") {
                $courselist = explode(",", $presourse);
                for ($i = 0; $i < count($courselist); $i++) {
                    $data2 = array(
                        'precourseID' => $courselist[$i],
                        'courseID' => $courseID
                    );
                    $this->db->insert('tbl_prerequisite', $data2);
                    $id = $courseID;
                }

            } else {
                $id = $courseID;
            }

            //optionals
            $optional = $this->input->post('optional');
            if (!empty($optional)) {
                foreach ($optional as $key => $value) {
                    $data3 = array(
                        'courseID' => $courseID,
                        'optionalID' => $value
                    );
                    $this->db->insert('tbl_courseoptionals', $data3);
                    $id = $courseID;
                }

            } else {
                $id = $courseID;
            }

            if (!$id) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        }
        return $id;

    }

    function editCourse()
    {
        $ok = false;
        $courseID = $this->input->post('courseID');
        $data = array(
            'coursecode' => $this->input->post('coursecode'),
            'coursename' => $this->input->post('coursename'),
            'generation' => $this->input->post('generation'),
            'coursetypeID' => $this->input->post('coursetype'),
            'qualification' => $this->input->post('qualification'),
            'objective' => $this->input->post('objective'),
            'content' => $this->input->post('content'),
            'startdate' => $this->input->post('startdate'),
            'enddate' => $this->input->post('enddate'),
            'days' => $this->input->post('days'),
            'registstartdate' => $this->input->post('registstartdate'),
            'registenddate' => $this->input->post('registenddate'),
            'limittrainees' => $this->input->post('limittrainees'),
            'price' => $this->input->post('price'),
            'optionalother' => $this->input->post('optionalother'),
            'speaker' => $this->input->post('speaker'),
            'place' => $this->input->post('place'),
            'maplink' => $this->input->post('maplink'),
            'IsDelete' => 0,
            'lastupdatetime' => date('Y-m-d H:i:s'),
            'updateuser' => $this->context['adminID'],
            'gen_year' => $this->input->post('gen_year'),
            'payenddate' => $this->input->post('payenddate'),
            'group_condition' => $this->context['group_condition']
        );

        if ($this->context['picture'] != '') {
            //delete map in real path
            $oldmap = $this->input->post('oldmap');
            //unlink(realpath(Setting::$PATH_MAP . $oldmap));
            $data['map'] = $this->context['picture'];
        }

        $this->db->trans_begin();
        $this->db->where('courseID', $courseID);
        $chkUpdate = $this->db->update('tbl_courses', $data);

        //delete courseoptionalID before insert new
        $optID = $this->input->post('optionalID');
        $this->db->where('courseID', $courseID);
        $this->db->delete('tbl_courseoptionals');

        //delete precourseID before insert new
        $precourse = $this->input->post('precourseID');
        $this->db->where('courseID', $courseID);
        $this->db->delete('tbl_prerequisite');

        if (!$chkUpdate) {
            $this->db->trans_rollback();
        } else {
            //precourse
            $courselist = explode(",", $precourse);
            if ($precourse !== "") {
                for ($i = 0; $i < count($courselist); $i++) {
                    //echo  $courselist[$i] ."<br />";
                    if ($courselist[$i] != 0) {
                        $data2 = array(
                            'precourseID' => $courselist[$i],
                            'courseID' => $courseID
                        );
                        $this->db->insert('tbl_prerequisite', $data2);
                    }
                }
            }

            //optionals
            $optional = $this->input->post('optional');
            if (!empty($optional)) {
                foreach ($optional as $key => $value) {
                    $data3 = array(
                        'courseID' => $courseID,
                        'optionalID' => $value
                    );
                    $this->db->insert('tbl_courseoptionals', $data3);
                }
            }

            $ok = true;
            $this->db->trans_commit();
        }
        return $ok;
    }

    function delcourse($id)
    {
        $data = array(
            'IsDelete' => 1,
            'deleteuser' => $this->context['adminID']
        );
        $this->db->where('courseID', $id);
        $res = $this->db->update('tbl_courses', $data);
        return $res;
    }

    function updatestatus($id)
    {
        $data = array(
            'IsActive' => (int)$this->context['IsActive'],
            'lastupdatetime' => date('Y-m-d H:i:s'),
            'updateuser' => $this->context['adminID']
        );

        $this->db->where('courseID', $id);
        $this->db->update('tbl_courses', $data);
    }

    function uploadmap()
    {
        $this->load->library('upload');
        $config['upload_path'] = setting::$PATH_MAP;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->upload->initialize($config);
        if ($this->upload->do_upload('picture')) {
            $data = $this->upload->data();
            $picture = $data['file_name'];
        } else {
            $picture = '';
        }

        return $picture;
    }

    function uploaddocs($id)
    {
        // files
        $config['upload_path'] = setting::$PATH_PDF;
        $config['allowed_types'] = 'doc|docx|pdf';
        $config['file_name'] = 'screenshot';
        $config['max_size'] = '5120';
        $config['overwrite'] = true;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        foreach ($_FILES['fileToUpload'] as $key => $file) {
            $i = 0;
            foreach ($file as $item) {
                $data[$i][$key] = $item;
                $i++;
            }
        }


        $i = 0;
        $docslist = $this->input->post('doctitle');
        if (is_array($docslist)) {
            foreach ($docslist as $key => $value) {
                $data[$i]['title'] = $value;
                $i++;
            }
        }

        $i = 0;
        $showlist = $this->input->post('isShow');
        if (is_array($showlist)) {
            foreach ($showlist as $key => $value) {
                $data[$i]['isshow'] = $value;
                $i++;

            }
        }

        $i = 0;
        $idlist = $this->input->post('docID');
        if (is_array($idlist)) {
            foreach ($idlist as $key => $value) {
                $data[$i]['docID'] = $value;
                $i++;
            }
        }

        $i = 0;
        $oldlist = $this->input->post('oldfile');
        if (is_array($oldlist)) {
            foreach ($oldlist as $key => $value) {
                $data[$i]['oldfile'] = $value;
                $i++;
            }
        }

        $file = ''; // reset
        $_FILES = $data; // re-declarate

        for ($j = 0; $j < count($data); $j++) {
            $config['file_name'] = $data[$j]['name'];
            $this->upload->initialize($config);
            if ($this->upload->do_upload($j)) {
                $file = $this->upload->data();
            }
            //echo $data[$j]['name']."<br>".$data[$j]['title']."<br>";
            if ($data[$j]['title'] != '') {
                if (!empty($data[$j]['isshow'])) {
                    $show = $data[$j]['isshow'];
                } else {
                    $show = "off";
                }

                if ($show == "on") {
                    $isshow = 1;
                } else {
                    $isshow = 0;
                }
                //echo $isshow."<br>";

                $filename = $data[$j]['name'];
                $dtitle = $data[$j]['title'];
                $createdate = date('Y-m-d H:i:s');
                $uID = $this->context['adminID'];

                if ($data[$j]['docID'] != '') {
                    $dID = $data[$j]['docID'];
                } else {
                    $dID = '';
                }


                $sql = '';

                if ($dID == '') {
                    $sql = " INSERT INTO `tbl_docs` (courseID,title,filename,file,IsShow,IsDelete,createdatetime,createuser)
                             VALUES ($id,'$dtitle','$filename','$filename',$isshow,0,'$createdate',$uID)
                          ";
                    $this->db->query($sql);
                } else {
                    if ($filename != '') {
                        $sql = "Update `tbl_docs`
                               Set  title ='$dtitle',
                                    filename ='$filename',
                                    file='$filename',
                                    IsShow=$isshow,
                                    lastupdatetime='$createdate',
                                    updateuser=$uID
                               Where docID = $dID
                               ";
                        $this->db->query($sql);
                    } else {
                        $sql = '';
                    }
                }
                //echo $sql;
                //$this->db->query($sql);
            }
        }
    }

    function deldocs($id)
    {
        $data = array(
            'IsDelete' => 1,
            'lastupdatetime' => date('Y-m-d H:i:s'),
            'deleteuser' => $this->context['adminID']
        );
        $this->db->where('docID', $id);
        $res = $this->db->update('tbl_docs', $data);
        return $res;
    }

    function addchangetrainee()
    {
        $changeID = 0;
        $data = array(
            'courseID' => $this->context['cID'],
            'mastertraineeID' => $this->context['tID'],
            'traineeID' => $this->context['traineeID'],
            'name' => $this->context['fname'],
            'lastname' => $this->context['lname'],
            'changedatetime' => date('Y-m-d H:i:s'),
            'changeuser' => $this->context['adminID']
        );

        $data2 = array(
            'isChange' => 1,
            'lastupdatetime' => date('Y-m-d H:i:s'),
            'updateuser' => $this->context['adminID']
        );

        $this->db->trans_begin();

        //update status
        $this->db->where('courseID', $this->context['cID']);
        $this->db->where('mastertraineeID', $this->context['tID']);
        $this->db->update('tbl_changetraineehistory', $data2);

        //insert new
        $chkInsert = $this->db->insert('tbl_changetraineehistory', $data);

        if (!$chkInsert) {
            $this->db->trans_rollback();
        } else {
            $changeID = $this->db->insert_id();
            $this->db->trans_commit();
        }

        return $changeID;
    }

    function previewtags()
    {
        $checkall = $this->context['checkall'];
        $cid = $this->context['cID'];
        $rid = $this->context['rID'];

        if ($checkall == "on") {
            $res = $this->getRegistrationListbyTrainee($cid, 0);
        } else {
            $res = $this->getRegistrationListbyTrainee($cid, $rid);
        }
        return $res;

    }

    function addreceiptdetails($regid)
    {
        /* Update receiptdatetime*/
        $data = array(
            'IsPaid' => 1,
            'receipt_date' => $this->context['receipt_date'],
            'update_user' => $this->context['adminID'],
            'update_datetime' => date('Y-m-d H:i:s')
        );
        $this->db->where('registrationID', $regid);
        $res = $this->db->update('tbl_registration', $data);

        /*Generate seat no*/
        $courseID = $this->context['courseID'];
        $numDigits = $this->context['digit'];
        $ok = 0;
        if ($res == 1) {
            $query = $this->db->query(' select count(seatno) as seatno
                                        from tbl_seats
                                        where courseID =' . $courseID . '
                                        group by courseID');
            $row = $query->row();
            if (!empty($row->seatno)) {
                $no = $row->seatno + 1;
            } else {
                $no = 1;
            }
            $seatno = sprintf("%0" . $numDigits . "d", $no);
            $data1 = array(
                'seatNo' => $seatno,
                'registrationID' => $regid,
                'courseID' => $courseID,
                'updateuser' => $this->context['adminID'],
                'updatedatetime' => date('Y-m-d H:i:s')
            );
            $this->db->trans_begin();
            $chkInsert = $this->db->insert('tbl_seats', $data1);
            if (!$chkInsert) {
                $this->db->trans_rollback();
                $ok = 0;
            } else {
                $this->db->trans_commit();
                $ok = 1;
            }
        }
        return $ok;
    }

    function updateIsPaid($id)
    {
        $data = array(
            'IsPaid' => 1,
            'receipt_date' => $this->context['receipt_date'],
            'update_user' => $this->context['adminID'],
            'update_datetime' => date('Y-m-d H:i:s')
        );
        $this->db->where('registrationID', $id);
        $res = $this->db->update('tbl_registration', $data);
    }

    function valid_course()
    {
        $ok = false;
        $code = $this->input->post('coursecode');
        $gen = $this->input->post('generation');
        $query = $this->db->get_where('tbl_courses', array('coursecode' => $code, 'generation' => $gen));
        if ($query->num_rows() === 0) {
            $ok = true;
        }
        return $ok;
    }

    function updateRegisIsDelete($rid, $typeid)
    {
        $data = array(
            'isDelete' => 1,
            'update_user' => $this->context['adminID'],
            'update_datetime' => date('Y-m-d H:i:s')
        );

        if ($typeid == 1) {
            $this->db->where('registrationID', $rid);
        } else if ($typeid == 3) {
            $this->db->where('refID', $rid);
            $this->db->or_where('registrationID', $rid);
        }

        $res = $this->db->update('tbl_registration', $data);
    }

    function updateRequeueDate($rid, $typeid)
    {
        $data = array(
            'IsPaid' => 2,
            'ReQueue_Date' => date('Y-m-d H:i:s'),
            'update_user' => $this->context['adminID'],
            'update_datetime' => date('Y-m-d H:i:s')
        );

        if ($typeid == 1) {
            $this->db->where('registrationID', $rid);
        } else if ($typeid == 3) {
            $this->db->where('refID', $rid);
            $this->db->or_where('registrationID', $rid);
        }

        $res = $this->db->update('tbl_registration', $data);
    }

    function getPosition(){
        $data = $this->db->get('tbl_position');
        return $data->result_array();
    }
    function getCourseById($id){
        $this->db->select('*');
        $this->db->from('tbl_courses');
        $this->db->where_in('courseID', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}

