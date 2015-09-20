<?php

class Course_m extends CI_Model
{
    var $context = array();

    function __construct()
    {
        parent::__construct();

    }
	
	function getCountCourseList()
    {
        $this->db->from('tbl_courses as c ');
        //$this->db->join('tbl_registration as r', 'c.courseID = r.courseID', 'left');
        $this->db->where('c.IsDelete', 0);
        return $this->db->count_all_results();
    }

    function getCourseList()
    {

        $this->db->select('c.courseID,startdate,enddate,coursecode,coursename,
                           generation,limittrainees,CntReg');
        $this->db->from('tbl_courses as c');
        $this->db->join('tbl_registration as r', 'c.courseID = r.courseID', 'left');
        $this->db->join('( select courseID,count(r.traineeID) as CntReg
                            from tbl_registration  as r inner join tbl_trainees as t on r.traineeID = t.traineeID
                            where t.isdelete=0
                            group by courseID) as cr','c.courseID = cr.courseID', 'left');

		if ( $this->context['courseID'] != 0) {
			$this->db->where('r.courseID', $this->context['courseID']);
		}		
        $this->db->where('c.IsDelete', 0);
        $this->db->group_by('c.courseID,startdate,enddate,coursecode,coursename,generation,limittrainees');
        $this->db->limit($this->context['limit'], $this->context['page']);		 
        $query = $this->db->get();
        return $query->result_array();
    }	

	function searchCourse()
    {
        $this->db->select('c.courseID,startdate,enddate,coursecode,coursename,
                           generation,limittrainees,CntReg');

        $this->db->from('tbl_courses as c');
        $this->db->join('tbl_registration as r', 'c.courseID = r.courseID', 'left');
        $this->db->join('( select courseID,count(r.traineeID) as CntReg
                            from tbl_registration  as r inner join tbl_trainees as t on r.traineeID = t.traineeID
                            where t.isdelete=0
                            group by courseID) as cr','c.courseID = cr.courseID', 'left');

		$this->db->where('c.coursecode', $this->context['coursecode']);
        $this->db->where('c.IsDelete', 0);
        $this->db->group_by('c.courseID,startdate,enddate,coursecode,coursename,generation,limittrainees');
        $this->db->limit($this->context['limit'], $this->context['page']);		
        $query = $this->db->get();
        return $query->result_array();

    }

    function countsearchCourse(){

        $this->db->select('c.courseID,startdate,enddate,coursecode,coursename,
                           generation,limittrainees,CntReg');

        $this->db->from('tbl_courses as c');
        $this->db->join('tbl_registration as r', 'c.courseID = r.courseID', 'left');
        $this->db->join('( select courseID,count(r.traineeID) as CntReg
                            from tbl_registration  as r inner join tbl_trainees as t on r.traineeID = t.traineeID
                            where t.isdelete=0
                            group by courseID) as cr','c.courseID = cr.courseID', 'left');
        $this->db->where('c.coursecode', $this->context['coursecode']);
        $this->db->where('c.IsDelete', 0);

        $this->db->group_by('c.courseID,startdate,enddate,coursecode,coursename,generation,limittrainees');
        return  $this->db->count_all_results();
    }
	
	function getAllCourses()
    {
        $this->db->select('*');
        $this->db->from('tbl_courses');
        $this->db->where('isdelete',0);
        $this->db->order_by('coursecode','asc');
        $query = $this->db->get();
        return $query->result_array();
    }

	function getOptionals()
    {
        return $this->db->get('tbl_optionals')->result_array();
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

    function getCountCourseRegister($id)
    {
        /*$this->db->from('tbl_registration');
        $this->db->where('courseID', $id);
        */

        $this->db->select('r.traineeID');
        $this->db->from('tbl_registration as r');
        $this->db->join('tbl_trainees as t', 'r.traineeID = t.traineeID', 'inner');
        $this->db->where('r.courseID', $id);
        $this->db->where('t.isdelete', 0);

        return $this->db->count_all_results();
    }

    function getRegistrationList($id)
    {
        $this->db->select('t.traineeID,prefix,title_th,prefix_other,t.name,t.lastname,
                           t.hospitalID,h.name as hospitalname,pv.PROVINCE_NAME as province,hospitalother,
                           registrationtype,type_name,registerdatetime,
                           r.paymentID,pm.paymenttypeID,paymenttype,detail,cheuqeno,bankname,paiddatetime,
                           registerstatus,IsPaid');
        $this->db->from('tbl_registration as r');
        $this->db->join('tbl_trainees as t', 'r.traineeID = t.traineeID', 'inner');
        $this->db->join('tbl_prefix_name as p', 't.prefix = p.id', 'inner');
        $this->db->join('tbl_register_type as tr', 't.registrationtype = tr.type_id', 'inner');
        $this->db->join('hospital as h', 'h.hospitalID = t.hospitalID', 'left');
        $this->db->join('province as pv', 'h.provinceid = pv.PROVINCE_ID', 'left');
        $this->db->join('tbl_payment as pm', 'pm.paymentID = r.paymentID', 'left');
        $this->db->join('tbl_paymenttype as pt', 'pm.paymenttypeID = pt.paymenttypeID', 'left');
        $this->db->where('r.courseID', $id);
        $this->db->where('t.isdelete', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getDocsList($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_docs');
        $this->db->where('courseID', $id);
        $this->db->where('isdelete', 0);
        $this->db->order_by('docID','asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCourseName($id)
    {
        $query = $this->db->query('SELECT concat(coursecode,":",coursename) as precourse
                                   FROM tbl_courses WHERE courseID ='.$id.' LIMIT 1');
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
        $this->db->join('tbl_changetraineehistory as c', 'c.mastertraineeID = t.traineeID','inner');
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
        $this->db->where('name',$this->context['fname']);
        $this->db->where('lastname',$this->context['lname']);
        $this->db->where('isdelete',0);
        $this->db->limit(1, 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $row = $query->row();
            return $row->traineeID;
        }

        return 0;
    }

    function getTraineeDetails($id){
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
        $this->db->join('province as pvs', 'a.provinceid = pvs.PROVINCE_ID', 'left');
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
        $query = $this->db->get();
        return $query->result_array();
    }

    function getRegistrationListbyTrainee($id,$tid='')
    {

        $sql = '
                select  t.traineeID,prefix,title_th,prefix_other,t.name,t.lastname,cardID,photo,
                        c.startdate,c.enddate,c.coursecode,c.generation,coursename,place,
                        t.hospitalID,hospitalother,h.name as hospitalname,pv.PROVINCE_NAME as province,
                        registrationtype,type_name,registerdatetime,
                        r.paymentID,pm.paymenttypeID,paymenttype,detail,cheuqeno,bankname,paiddatetime,
                        registerstatus,IsPaid
                from
                        tbl_registration as r
                        inner join tbl_trainees as t on r.traineeID = t.traineeID
                        inner join tbl_prefix_name as p on t.prefix = p.id
                        inner join tbl_register_type as tr on t.registrationtype = tr.type_id
                        left join tbl_courses as c on c.courseID=r.courseID
                        left join hospital as h on h.hospitalID = t.hospitalID
                        left join province as pv on h.provinceid = pv.PROVINCE_ID
                        left join tbl_payment as pm on pm.paymentID = r.paymentID
                        left join tbl_paymenttype as pt  on pm.paymenttypeID = pt.paymenttypeID';
        if ($tid != ''){
            $sql .=' where r.courseID ='.$id.' and t.traineeID in ('.$tid.') and t.isdelete=0';
        }else{
            $sql .=' where r.courseID ='.$id.' and t.isdelete=0';
        }
        $query = $this->db->query($sql);

        return $query->result_array();
    }

    function addCourse()
    {
        $data = array(
            'coursecode' => $this->input->post('coursecode'),
            'coursename' => $this->input->post('coursename'),
            'generation' => $this->input->post('generation'),
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
			'map' => $this->context['picture'],
            'IsDelete' => 0,
            'createdatetime' => date('Y-m-d H:i:s'),
            'createuser' => $this->context['adminID']
        );

        $this->db->trans_begin();
        $chkInsert = $this->db->insert('tbl_courses', $data);
        $courseID = $this->db->insert_id();

        if (!$chkInsert) {
            $this->db->trans_rollback();
        } else {

            //precourse
            $presourse = $this->input->post('precourseID');
            if($presourse !== "")
            {
                $courselist = explode(",", $presourse);
                for($i = 0; $i < count($courselist); $i++){
                    $data2 = array(
                        'precourseID' => $courselist[$i],
                        'courseID' =>  $courseID
                    );
                   $this->db->insert('tbl_prerequisite', $data2);
                   $id = $courseID;
                }

            }else{
                $id = $courseID;
            }

            //optionals
            $optional = $this->input->post('optional');
            if(!empty($optional)) {
                foreach( $optional as $key => $value){
                    $data3 = array(
                        'courseID' => $courseID,
                        'optionalID' => $value
                    );
                    $this->db->insert('tbl_courseoptionals', $data3);
                    $id = $courseID;
                }

            }else{
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
            'updateuser' => $this->context['adminID']
        );

        if ($this->context['picture'] != '') {
            //delete map in real path
            /*$oldmap = $this->input->post('oldmap');
            unlink(realpath(Setting::$PATH_MAP .$oldmap));
            */
            $data['map'] = $this->context['picture'];
        }

        $this->db->trans_begin();
        $this->db->where('courseID', $courseID);
        $chkUpdate = $this->db->update('tbl_courses', $data);

        //delete courseoptionalID before insert new
        $optID = $this->input->post('optionalID');
        $this->db->where('courseID',  $courseID);
        $this->db->delete('tbl_courseoptionals');

        //delete precourseID before insert new
        $precourse = $this->input->post('precourseID');
        $this->db->where('courseID',  $courseID);
        $this->db->delete('tbl_prerequisite');

        if (!$chkUpdate) {
            $this->db->trans_rollback();
        } else {
            //precourse
            $courselist = explode(",", $precourse);
            if($precourse !== "")
            {
                for($i = 0; $i < count($courselist); $i++){
                    //echo  $courselist[$i] ."<br />";
                    if($courselist[$i] != 0){
                        $data2 = array(
                            'precourseID' => $courselist[$i],
                            'courseID' =>  $courseID
                        );
                        $this->db->insert('tbl_prerequisite', $data2);
                    }
                }
            }

            //optionals
            $optional = $this->input->post('optional');
            if(!empty($optional)) {
                foreach( $optional as $key => $value){
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

    function uploaddocs ($id)
    {
        // files
        $config['upload_path'] = setting::$PATH_PDF;
        $config['allowed_types']  = 'doc|docx|pdf';
        $config['file_name'] = 'screenshot';
        $config['max_size'] = '5120';
        $config['overwrite'] = true;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        foreach($_FILES['fileToUpload'] as $key => $file)
        {
            $i = 0;
            foreach ($file as $item)
            {
                $data[$i][$key] = $item;
                $i++;
            }
        }


        $i = 0;
        $docslist = $this->input->post('doctitle');
        if (is_array($docslist)){
            foreach ($docslist as $key => $value)
            {
                $data[$i]['title'] = $value;
                $i++;
            }
        }

        $i = 0;
        $showlist = $this->input->post('isShow');
        if (is_array($showlist)){
            foreach ($showlist as $key => $value)
            {
                $data[$i]['isshow'] = $value;
                $i++;

            }
        }

        $i = 0;
        $idlist = $this->input->post('docID');
        if (is_array($idlist)){
            foreach ($idlist as $key => $value)
            {
                $data[$i]['docID'] = $value;
                $i++;
            }
        }

        $i = 0;
        $oldlist = $this->input->post('oldfile');
        if (is_array($oldlist)){
            foreach ($oldlist as $key => $value)
            {
                $data[$i]['oldfile'] = $value;
                $i++;
            }
        }

        $file = ''; // reset
        $_FILES = $data; // re-declarate

        for($j=0;$j<count($data);$j++)
        {
           $config['file_name'] = $data[$j]['name'];
           $this->upload->initialize($config);
           if($this->upload->do_upload($j)){
               $file = $this->upload->data();
           }
            //echo $data[$j]['name']."<br>".$data[$j]['title']."<br>";
            if ($data[$j]['title'] != ''){
                if(!empty($data[$j]['isshow'])){
                    $show = $data[$j]['isshow'];
                }else{
                    $show = "off";
                }

                if($show == "on"){
                    $isshow = 1;
                }else{
                    $isshow = 0;
                }
                //echo $isshow."<br>";

                $filename = $data[$j]['name'];
                $dtitle = $data[$j]['title'];
                $createdate = date('Y-m-d H:i:s');
                $uID = $this->context['adminID'];

                if ($data[$j]['docID']!= ''){
                    $dID = $data[$j]['docID'];
                }else{
                    $dID = '';
                }


                $sql = '';

                if($dID == ''){
                    $sql =" INSERT INTO `tbl_docs` (courseID,title,filename,file,IsShow,IsDelete,createdatetime,createuser)
                            VALUES ($id,'$dtitle','$filename','$filename',$isshow,0,'$createdate',$uID)
                          ";
                    $this->db->query($sql);
                }else{
                    if ($filename != ''){
                        $sql ="Update `tbl_docs`
                               Set  title ='$dtitle',
                                    filename ='$filename',
                                    file='$filename',
                                    IsShow=$isshow,
                                    lastupdatetime='$createdate',
                                    updateuser=$uID
                               Where docID = $dID
                               ";
                        $this->db->query($sql);
                    }else{
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
            'mastertraineeID' =>$this->context['tID'],
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
        $tid = $this->context['tID'];

        if ($checkall == "on"){
            $res = $this->getRegistrationListbyTrainee($cid,'');
        }else{
           $res = $this->getRegistrationListbyTrainee($cid,$tid);
        }
        return $res;

    }

    function valid_course()
    {
        $ok = false;
        $code = $this->input->post('coursecode');
        $gen = $this->input->post('generation');
        $query = $this->db->get_where('tbl_courses', array('coursecode' => $code,'generation' => $gen));
        if ($query->num_rows() === 0) {
            $ok = true;
        }
        return $ok;
    }
}

