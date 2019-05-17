<?php
class site_model extends Model
{
	function site_model()
	{
		parent::Model();
    }

	function gettbl($tbl)
	{
		$this->db->where('status',1);
		$this->db->order_by("id","desc");
		$query = $this->db->get($tbl);
		return $query;
	}
    function gettblwidthid($tbl,$id)
	{
		if($id!=''){
			$this->db->where('id',$id);
		}
		$query = $this->db->get($tbl);
        if($query->num_rows() > 0)
        {
          $row = $query->row();//mysql_fetch_assoc($db_qr->result);
          return $row;
        }

	}
    function gettblwidthidandkey($tbl,$key,$id)
	{
		if($id!=''){
			$this->db->where($key,$id);
		}
		$query = $this->db->get($tbl);
        if($query->num_rows() > 0)
        {
          $row = $query->row();//mysql_fetch_assoc($db_qr->result);
          return $row;
        }

	}
    function ListDistrictByProvince($province)
    {
        if(intval($province)>0){
        $query="select * from city2 as c where c.cit_parent='".$province."'";
        $db_qr = $this->db->query($query);
        if($db_qr->num_rows() > 0)
        {
            $tg1="";
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
                }
        }
        return $tg1;
        }else{return null ;}

    }
		function checknamecty($name){
			$query.="select * from user_company  where usc_company='".$name."'";
	        $sql=$this->db->query($query);
	        $row="";
	        if($sql->num_rows()> 0)
	        {
	            $row=$sql->row();
	        }
	        return $row;
		}
	function add_tbl($tbl,$data,$id)
    {
        if($id=='')
        {
            $this->db->insert($tbl,$data);
        }
        else
        {
            $this->db->where('id',$id);
            $this->db->update($tbl,$data);
        }
    }
		function getclassbytopic($topic){
			$query='select idlophoc from topic where ID='.$topic.' ';
			$db_qr=$this->db->query($query);
			$data='';
			if($db_qr->num_rows()>0){
				$data=$db_qr->row()->idlophoc;
			}
			return $data;
		}
		function getclassbysubject($idsubject){
				$areaclass=$this->db->select('areaclass');
				$areaclass=$this->db->get_where('subject',array('ID'=>$idsubject))->row()->areaclass;
				$data='';
				if(!empty($areaclass)){
					$query='select id,name from lophoc where id IN('.$areaclass.')';
					$data=$this->db->query($query)->result();
				}
				return $data;
			}
	function gettbl_limited($tbl,$id,$start_row,$limit)
	{
		$sql = "SELECT * FROM $tbl WHERE status=1";
		if($id!='' AND $tbl=='baiviet'){
			$sql .= " AND cid=$id";
		}
		$sql .= " ORDER BY id DESC";
		if($limit!=''){
			$sql .= " LIMIT $start_row,$limit";
		}
		$query=$this->db->query($sql);
		return $query;
	}
	function gettopicbyclassandsubject($idClass,$subject){
		$query='select DISTINCT ID from topic where FIND_IN_SET('.$idClass.',idlophoc) and SubjectID='.$subject.' ';
		$db_qr=$this->db->query($query);
		$data='';
		if($db_qr->num_rows()>0){
			foreach ($db_qr->result() as $value) {
				$data1[]=$value->ID;
			}
		}
		$data=implode(',',$data1);
		return $data;
	}
	function GetListTeacherBySearchClass($subject,$place,$class,$page,$perpage)
	{
			$query='select ut.*,u.`Name`
			,u.UserName
			,u.Phone
			,u.Email
			,u.CityID
			,u.CityName
			,u.Address
			,u.Description
			,u.UserType
			,u.CreateDate
			,u.CreateBy
			,u.Image
			,u.Latitude
			,u.Longitude
			,u.IsSearch
			 from users as u JOIN userteacher as ut on u.UserID=ut.UserID
			where u.`Delete`=0 and u.Active=1 and u.IsSearch=1';
			if(intval($place) > 0){
				$query.=' and u.CityID='.intval($place).'';
			}
			if( ($subject>0 && $class>0 ) || ($subject>0 && $class==0) ){
				$listtopic=$this->gettopicbyclassandsubject($class,$subject);
				if(!empty($listtopic)){
					$query.=' and u.UserID in ( select UserID from usersubject where ( SubjectID='.$subject.' and idClass2='.$class.') OR ( TopicID in ('.$listtopic.') OR ( SubjectID='.$subject.' and idClass2=0 and TopicID=0 ) ) )';
				}else{
					$query.=' and u.UserID in ( select UserID from usersubject where ( SubjectID='.$subject.' and idClass2='.$class.') OR ( SubjectID='.$subject.' and idClass2=0 and TopicID=0 ) )';
				}
			}
			if($subject ==0 && $class >0){
				$listtopic=$this->gettopicbyclassandsubject($class,0);
				if(!empty($listtopic)){
					$query.=' and u.UserID in ( select UserID from usersubject where ( idClass2='.$class.') or (TopicID in ('.$listtopic.') or ( idClass2=0 and TopicID=0 ) ) )';
				}else{
					$query.=' and u.UserID in ( select UserID from usersubject where ( idClass2='.$class.' ) or ( idClass2=0 and TopicID=0 ) ) ';
				}
			}
			$query.=" ORDER BY u.CreateDate desc";

			$total=$this->db->query($query)->num_rows();
			// if(!empty($page) && !empty($perpage)){
				$query.=" LIMIT ".$page.",".$perpage;
			// }
			$db_qr = $this->db->query($query);
			$tg1="";
			if($db_qr->num_rows() > 0)
			{
					foreach($db_qr->result() as $itemcat)
					{
							$tg1[]=$itemcat;
					}
			}
			return array('total'=>$total,'data'=>$tg1);
	}
	function countusergetaccuracycode($userid)
	{
			$timenow = date("Y-m-d",time());
			$query="select COUNT(*) as sobanghi from comfirmtable where Type=3 and Status=0 and UserID='".$userid."' and CreateDate >= '".$timenow."' " ;
			$db_qr = $this->db->query($query);
			$tg1=0;
			if($db_qr->num_rows() > 0)
			{
					 $tg1=$db_qr->row()->sobanghi;
			}
			return $tg1;
	}
	function UpdateAccuracyCode($iduser,$type) //phỏng theo chức năng lấy lại mật khẩu
		{
					$check=$this->db->select('UserName,Name');
					$check=$this->db->get_where('users',array('UserID'=>$iduser))->row();
					$phone=$check->UserName;
					$name=$check->Name;

					$body=file_get_contents(base_url().'EmailTemplate/SendForgotPassword.htm');
					$body=str_replace('<%name%>',$lsttopic->Name,$body);
					$body=str_replace('<%email%>',$lsttopic->Email,$body);
					$body=str_replace('<%code%>',$lsttopic->UserName,$body);

					$code=rand(100000,999999);
					$Description="Lấy lại mã kích hoạt";
					$countuserforgot=$this->countusergetaccuracycode($iduser);
					if($countuserforgot < 3){
					$CreateDate=date("Y-m-d H:i:s",time());
					$queryconfirm="INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate,IP)
																					VALUES('".$iduser."','".$code."','3','0','".$body."','".$Description."','".$CreateDate."','".$CreateDate."','".$IP."')";
					$queryconfirm1='UPDATE `comfirmtable` SET `Code` = '.$code.' WHERE UserID = '.$iduser.' and Type='.$type.' ';
					$this->db->query($queryconfirm);
					$this->db->query($queryconfirm1);
					$arrp=['VTT','VMS','VNP'];
					$re=gettelcofromphonenumber($phone);
					$iscall=0;
					// if(in_array($re, $arrp)){
					// 		$arrphone=['phone_number'=>"'$phone'",'name'=>"'$name'"];
					// 		$message=buildsendautocall($arrphone,$code);
					// 		$Statuscode=1;
					// 		$iscall=1;
					// }else{
							date_default_timezone_set("Asia/Bangkok");
							$gio= date("H",time());
							// if(intval($gio) >7 && $gio < 22 ){
									$message=formatsmsmessage(2,$code);
									$Statuscode=sendsms($phone,$message);
							// }
					// }
					// $smslog=$this->InsertLogSms($code,$Statuscode,'2',$iscall);
					$body = base64_encode($body);
					$result=['kq'=>true,'data'=>'Mã kích hoạt đã được gửi lại vào sđt của bạn: '.$phone.', vui lòng kiểm tra và nhập lại mã.','code'=>"$code",'unam'=>"$username"];
					}else{
							$result=['kq'=>false,'check'=>true,'data'=>''];
					}
					return $result;
		}
	function updateissearchuser1($userid,$issearch)
	{
			$query="select * from users where UserID='".$userid."'";
			$db_qr = $this->db->query($query);
			$flag=false;
			if($db_qr->num_rows() > 0)
			{
							$query1="UPDATE `users` SET `IsSearch2` = '".intval($issearch)."' WHERE UserID = '".$userid."'";
							$tg1=$this->db->query($query1);
							$flag=true;
			}
			return $flag;
	}
	function base_limited($tbl,$cate,$exp,$note,$start_row,$limit)
	{
		$sql = "SELECT id,alias,image,view,love,download,price FROM $tbl WHERE status=1";
		if($cate>0){
			$sql .= " AND FIND_IN_SET($cate,cate_id)";
		}
		if($exp>0){
			$sql .= " AND exp=$exp";
		}
		if($note>0){
			$sql .= " AND nhucau=$note";
		}
		$sql .= " ORDER BY id DESC";
		if($limit!=''){
			$sql .= " LIMIT $start_row,$limit";
		}
		$query=$this->db->query($sql);
		return $query;
	}

	function GetListClassBySearchLopHoc($subject,$place)
	{
		 $query="SELECT t.*,u.`Name`,u.Phone as sodienthoaidk
			,u.Email
			,u.CityID
			,u.CityName,u.`Image`
			,u.Address as diachidk
			,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
			 from teacherclass as t left join users as u on t.UserID=u.UserID
				left JOIN (select ClassID,
			SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
			SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
			 from uservsclass as uc
			GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
			$query.=" where 1=1 and t.`Active`=1";

			if(intval($place)>0 ){
					$query.=" and t.City ='".intval($place)."'";
			}
			if(intval($subject) >0){
					$query.=" and t.SubjectID='".intval($subject)."'";
			}

			$query.=" order by t.ClassID,t.UpdateDate desc";
			// $query.=" limit ".$page.",".$perpage;

			$db_qr = $this->db->query($query);
			$tg1="";
			if($db_qr->num_rows() > 0)
			{
					foreach($db_qr->result() as $itemcat)
					{
							$tg1[]=$itemcat;
					}
			}
			return $tg1;
	}
	function selectCtrl($catid,$name,$class)
    {
        echo "<select name='".$name."' class='".$class."'>\n";
		echo "<option value='0'> -- Chọn chuyên mục -- </option>";
        $this->show_category($catid);
        echo "</select>";
    }
	function show_category($catid,$parent_id="0",$insert_text="-")
    {
        $this->db->where('uid',$parent_id);
        $this->db->order_by('id','asc');
        $sql=$this->db->get('tbl_chuyenmuc');
        foreach($sql->result() as $itemcat)
        {
			if($itemcat->id==$catid){
				echo '<option selected="selected" value="'.$itemcat->id.'">'.$insert_text.$itemcat->name."</option>";
			}
			else{
				echo "<option value='".$itemcat->id."'>".$insert_text.$itemcat->name."</option>";
			}
            $this->show_category($catid,$itemcat->id,$insert_text."---");
        }
        return true;
    }
	function selectprovince($name,$class,$title)
    {
        //'select * FROM city where cit_id <> 1 and cit_id <> 45 ORDER BY `cit_name`';
        //$this->db->where('uid',$parent_id);
        //$this->db->order_by('id','asc');
        //$sql=$this->db->get('tbl_chuyenmuc');
        //echo "<select name='".$name."' class='".$class."' title='".$title."'>\n";
        $tg="";
        $sql="select * FROM city where cit_id = 1 or cit_id = 45 ORDER BY `cit_name`";
        $query=$this->db->query($sql);
        foreach($query->result() as $itemcat)
        {
            $tg[]=$itemcat;
        }
        $sql1="select * FROM city where cit_id <> 1 and cit_id <> 45 ORDER BY `cit_name`";
        $query1=$this->db->query($sql1);
        foreach($query1->result() as $itemcat1)
        {
            $tg[]=$itemcat1;
        }
        //foreach($query->result() as $itemcat)
//        {
//            echo "<option value='".$itemcat->cit_id."'>".$itemcat->cit_name."</option>";
//        }
//        echo "</select>";
        return $tg;
    }
    function SelectProvinceByID($id)
    {
        $sql="select * FROM city where cit_id='".trim($id)."' ORDER BY `cit_name`";
        $query=$this->db->query($sql);
        $kq="";
        if($id > 0){
        if($query->num_rows()> 0)
        {
        $row = $query->row();
        $kq=$row->cit_name;
        }}
        else{$kq='Toàn quốc';}
        return $kq;
    }
    function SelectProvinceByID1($id)
    {
        $sql="select * FROM city where cit_id='".intval($id)."' ORDER BY `cit_name`";
        $query=$this->db->query($sql);
        $kq="";
        if($query->num_rows()> 0)
        {
        $kq = $query->row();

        }
        return $kq;
    }
    function selectsubjectbyid($id)
    {
        $sql="select * FROM subject where ID='".intval($id)."'";
        $query=$this->db->query($sql);
        $kq="";

        if($query->num_rows()> 0)
        {
        $kq = $query->row();

        }
        return $kq;
    }
	function search_limited($tbl,$txt,$start_row,$limit)
	{
		$sql="SELECT * FROM $tbl WHERE status=1";
		if($txt!=""){
			$txt = str_replace('+',' ', $txt);
			$sql .=" AND name LIKE '%$txt%'";
		}
		$sql .=" ORDER BY ngaybd DESC";
		if($limit!=''){
			$sql .= " LIMIT $start_row,$limit";
		}
		$query=$this->db->query($sql);
		return $query;
	}
	function getlogin($name,$pass)
    {
        $query="select * FROM `users` where UserName ='".strtolower($name)."' and `Password` ='".md5($pass)."'";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            $row=$sql->row();


        }
        return $row;
    }
    function GetLoginTeacher($name,$pass)
    {
        $query="select * from users where (UserName ='".$name."' or Phone ='".$name."') and `Password`='".$pass ."'";// and UserType =1
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            $row=$sql->row();
        }
        return $row;
    }
    function GetLoginusers($name,$pass)
    {
        $query="select * from users where (UserName ='".$name."' or Phone ='".$name."') and `Password`='".$pass ."'";// and UserType =0
        //var_dump($query);die();
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            $row=$sql->row();
        }
        return $row;
    }
    function UpdateUserType($userid,$usertype,$acctype)
    {
        $kq=0;
        $query="Update users set UserType='".$usertype."',Accounttype='".$acctype."' where UserID='".$userid."'";
        //var_dump($query);die();
        $sql=$this->db->query($query);
        if($sql){
            $kq=1;
        }
        return $kq;
    }
    function GetUserForgot($name)
    {
        $query="select * from users where (UserName ='".$name."' or Phone ='".$name."')";// and `Active`='1'
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            $row=$sql->row();


        }
        return $row;
    }
    function getcandidatebyID($id)
    {
        $query="select * FROM `users` as u left JOIN cv as c on u.UserID=c.cv_user_id where u.UserID ='".intval($id)."' AND u.`Active`=1";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            $row=$sql->row();
        }
        return $row;
    }
    function GetListCandidate($where,$limit,$order)
    {
        $query="select * FROM `user` as u left JOIN cv as c on u.use_id=c.cv_user_id where ";
        if($where != ""){
            $query.=$where;
        }
        if($order != "")
        {
            $query.=$order;
        }
        if(intval($limit)>0){
            $query.=" LIMIT 0,".$limit;
        }
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
            }
        }
        return $row;
    }

    function getlogincompany($name,$pass)
    {
        $query="select * from users where UserName ='".strtolower($name)."' and Password ='".md5($pass)."'";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            $row=$sql->row();


        }
        return $row;
    }
    function GetTopNew($length)
    {
         $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id ";
                    $query.="where n.new_han_nop > '".$timenow1."' and( n.new_hot = 0 or n.new_do = 0 or n.new_gap = 0)
                    order by n.new_hot desc,
                    n.new_do desc,
                    n.new_gap desc,
                    n.new_cao desc, n.new_id desc limit 0,".$length;

          //var_dump($query);
        $sql=$this->db->query($query);
        $row="";
        $arrth="";

        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;

            }
        }
        return $row;
    }
		function GetTopNewParttime($length)
    {
         $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
										n.new_active,
                    n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id ";
                  $query.="where n.new_han_nop > '".$timenow1."' and( n.new_hot = 0 or n.new_do = 0 or n.new_gap = 0) and n.`type`=1 and n.new_active = 1 and u.usc_active =0
                    order by n.new_hot desc,
                    n.new_do desc,
                    n.new_gap desc,
                    n.new_cao desc, n.new_id desc limit 0,".$length;

          //var_dump($query);
        $sql=$this->db->query($query);
        $row="";
        $arrth="";

        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;

            }
        }
        return $row;
    }
    function ResultNewParttime($key,$ca,$nganh,$tinh,$page,$perpage)
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_type,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id ";
                    $query.="where  n.`type`=1"; //n.new_han_nop > '".$timenow1."' and
        if(!empty($key)&& $key!='all'){
            $query.=" and n.new_title like '%".str_replace(' ','%',$key)."%'";
        }
        if(intval($ca)>0){
            if(intval($ca)==1){
                $query.=" and n.new_type = 2";
            }else{
                $query.=" and n.new_type = 3";
            }
        }
        if(intval($nganh)>0){
            $query.=" and FIND_IN_SET('".$nganh."' , n.new_cat_id)";
        }
        if(intval($tinh)>0){
            $query.=" and FIND_IN_SET('".$tinh."' , n.new_city)";
        }
                    $query.=" order by n.new_hot desc,
                    n.new_do desc,
                    n.new_gap desc,
                    n.new_cao desc, n.new_id desc";
        $query.=" limit ".$page.",".$perpage;
        //var_dump($query);die()   ;
        $sql=$this->db->query($query);
        $row="";
        $arrth="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
            }
        }
        return $row;
    }
    function CountResultNewParttime($key,$ca,$nganh,$tinh)
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_type,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id ";
                    $query.="where n.new_han_nop > '".$timenow1."' and n.`type`=1";
        if(!empty($key)&& $key!='all'){
            $query.=" and n.new_title like '%".str_replace(' ','%',$key)."%'";
        }
        if(intval($ca)>0){
            if(intval($ca)==1){
                $query.=" and n.new_type = 2";
            }else{
                $query.=" and n.new_type = 3";
            }
        }
        if(intval($nganh)>0){
            $query.=" and FIND_IN_SET('".$nganh."' , n.new_cat_id)";
        }
        if(intval($tinh)>0){
            $query.=" and FIND_IN_SET('".$tinh."' , n.new_city)";
        }
                    $query.=" order by n.new_hot desc,
                    n.new_do desc,
                    n.new_gap desc,
                    n.new_cao desc, n.new_id desc";
        //var_dump($query);
        $sql=$this->db->query($query);
        $row="";

        if($sql->num_rows()> 0)
        {

                $row=$sql->num_rows();

        }
        return $row;
    }
		function GetTopNewFulltime($length)
    {
         $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
										n.new_active,
                    n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id ";
                    $query.="where n.new_han_nop > '".$timenow1."' and( n.new_hot = 0 or n.new_do = 0 or n.new_gap = 0) and n.`type`=0 and n.new_active =1 and u.usc_active =0
                    order by n.new_hot desc,
                    n.new_do desc,
                    n.new_gap desc,
                    n.new_cao desc, n.new_id desc limit 0,".$length;

          //var_dump($query);
        $sql=$this->db->query($query);
        $row= array();
        // Lionel 5
        $arrth="";

        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;

            }
        }
        return $row;
    }
    function GetResultNewFulltime($key,$nganh,$tinh,$page,$perpage)
    {
         $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id ";
                    $query.="where n.new_han_nop > '".$timenow1."' and n.`type`='0'" ;
        if(!empty($key)&& $key!='all'){
            $query.=" and n.new_title like '%".str_replace(' ','%',$key)."%'";
        }

        if(intval($nganh)>0){
            $query.=" and FIND_IN_SET('".$nganh."' , n.new_cat_id)";
        }
        if(intval($tinh)>0){
            $query.=" and FIND_IN_SET('".$tinh."' , n.new_city)";
        }
                    $query.="order by n.new_hot desc,
                    n.new_do desc,
                    n.new_gap desc,
                    n.new_cao desc, n.new_id desc limit ".$page.",".$perpage;

        $sql=$this->db->query($query);
        $row= array();
        // Lionel 10
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;

            }
        }
        return $row;
    }
		function GetallcompanybyCity($place,$page,$perpage){
				$query="select t.* from user_company as t where 1=1 and t.usc_active =0 ";
				if(intval($place) > 0){
					$query.=' and t.usc_city='.intval($place).' ';
				}
				$query.="order by t.usc_id desc";
				$total=$this->db->query($query)->num_rows();
				$query.=" LIMIT ".$page.",".$perpage;
				$db_qr =	$this->db->query($query);
				$tg1="";
				if($db_qr->num_rows() >0)
				{
						foreach($db_qr->result() as $items)
						{
								$tg1[] =$items;
						}
				}
				return array('data'=>$tg1,'total'=>$total) ;
		}
    function GetCountResultNewFulltime($key,$nganh,$tinh)
    {
         $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id ";
                    $query.="where n.new_han_nop > '".$timenow1."' and n.`type`='0'" ;
        if(!empty($key)&& $key!='all'){
            $query.=" and n.new_title like '%".str_replace(' ','%',$key)."%'";
        }

        if(intval($nganh)>0){
            $query.=" and FIND_IN_SET('".$nganh."' , n.new_cat_id)";
        }
        if(intval($tinh)>0){
            $query.=" and FIND_IN_SET('".$tinh."' , n.new_city)";
        }
                    $query.="order by n.new_hot desc,
                    n.new_do desc,
                    n.new_gap desc,
                    n.new_cao desc, n.new_id desc";

          //var_dump($query);
        $sql=$this->db->query($query);
        $row="";

        if($sql->num_rows()> 0)
        {

                $row=$sql->num_rows();


        }
        return $row;
    }
		function GetFeaturedParttime($length)
    {
         $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
										n.new_active,
                    n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id ";
                    $query.="where n.new_han_nop > '".$timenow1."' and( n.new_hot = 1 or n.new_do = 1 or n.new_gap = 1) and n.`type`=1 and n.new_active =1 and u.usc_active=0
                    order by n.new_hot desc,
                    n.new_do desc,
                    n.new_gap desc,
                    n.new_cao desc, n.new_id desc limit 0,".$length;

          //var_dump($query);
        $sql=$this->db->query($query);
        $row="";
        $arrth="";

        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;

            }
        }
        return $row;
    }
    function GetFeaturedAllJob($length)
    {
         $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id ";
                    $query.="where n.new_han_nop > '".$timenow1."' and( n.new_hot = 1 or n.new_do = 1 or n.new_gap = 1) and u.usc_active=0
                    order by n.new_hot desc,
                    n.new_do desc,
                    n.new_gap desc,
                    n.new_cao desc, n.new_id desc limit 0,".$length;

          //var_dump($query);
        $sql=$this->db->query($query);
        $row="";
        $arrth="";

        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;

            }
        }
        return $row;
    }
    function GetITJob($length)
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id ";
                    $query.="where n.new_han_nop > '".$timenow1."' and (FIND_IN_SET(13,n.new_cat_id) or FIND_IN_SET(26,n.new_cat_id) or FIND_IN_SET(39,n.new_cat_id))
                    order by n.new_hot desc,
                    n.new_do desc,
                    n.new_gap desc,
                    n.new_cao desc, n.new_id desc limit 0,".$length;

          //var_dump($query);
        $sql=$this->db->query($query);
        $row= array();
        // Lionel 8
        $arrth="";

        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;

            }
        }
        return $row;
    }
		function getconfirmuserregisterbycode($code,$username)
		{
			// $code="$code";
			// $username="$username";
			 $arr=['kq'=>false];
			 $query="select * from users where (UserName ='"."$username"."' or Phone ='"."$username"."')";
			 $db_qr = $this->db->query($query);
						if($db_qr->num_rows() > 0)
						{
								$item=$db_qr->row();
								$query="select * from comfirmtable where Code='".$code."'  and UserID='".$item->UserID."' and Type IN(1,2) and `Status`=0 order by CreateDate desc";//and Type='0'
								$db_qr = $this->db->query($query);
								if($db_qr->num_rows() > 0)
								{
									foreach ($db_qr->result() as $value) {
										$item2=$value;
										$query1="UPDATE `comfirmtable` SET `Status` = '1' WHERE Id = '".$item2->Id."'";
										$tg=$this->db->query($query1);
										$query1="UPDATE `users` SET `Active` = '1' WHERE UserID = '".$item->UserID."'";
										$tg1=$this->db->query($query1);
										$arr=['kq'=>true,'mk'=>$code];
									}

								}
						}
			 return $arr;
		}
    function getjobmanager($length)
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id
                    where n.new_han_nop > '".$timenow1."' and n.new_cap_bac in(2,4,5,6,7) and usc_active = 0
                    order by n.new_hot desc,
                    n.new_do desc,
                    n.new_gap desc,
                    n.new_cao desc, n.new_id desc limit 0,".$length;
        $sql=$this->db->query($query);
        $row="";
        $arrth="";

        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;

            }
        }
        return $row;
    }
    function getjobstudent($length)
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id
                    where n.new_han_nop > '".$timenow1."' and n.new_cap_bac in(0,1,3) and u.usc_active = 0
                    order by n.new_hot desc,
                    n.new_do desc,
                    n.new_gap desc,
                    n.new_cao desc, n.new_id desc limit 0,".$length;
        $sql=$this->db->query($query);
        $row= array();
        // Lionel 9
        $arrth="";

        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;

            }
        }
        return $row;
    }
		function Sumlistnew($idcompany)
		{
			$result = 'SELECT SUM(new_active) AS total_capacity FROM new where new_user_id = '.$idcompany.'';
			$row=$this->db->query($result);
			$sum = $row->row();
			return $sum;
		}
		function Getallcompanybypage($page,$perpage){
				$query="select * FROM user_company as t where 1=1 and t.usc_active=0";
				$query.=" ORDER BY t.usc_id desc";
				$total=$this->db->query($query)->num_rows();
				$query.=" limit ".$page.",".$perpage;
				$db_qr =	$this->db->query($query);
				$tg1="";
				if($db_qr->num_rows() >0)
				{
						foreach($db_qr ->result() as $items)
						{
								$tg1[] =		$items;
						}

				}
				return array('data'=>$tg1,'total'=>$total) ;
		}
    function gettopcountjobbycat()
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select c.cat_id,c.cat_name, COUNT(n.new_money)as tongbanghi
                from new as n ,category as c
                where n.new_han_nop > '".$timenow1."' and n.`type`=0 and FIND_IN_SET(c.cat_id , n.new_cat_id)
                GROUP BY c.cat_id
        order by COUNT(n.new_money) desc
        limit 0,15";
        $sql=$this->db->query($query);
        $row= array();
        // Lionel 6
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
            }
        }
        return $row;
    }
		function gettopcandidate($length)
    {
        $query="select u.UserID,
                u.`Name`,
                u.UserName,
                u.Phone,
                u.Email,
                u.CityID,
                u.CityName,
                u.Address,
                u.Description,
                u.UserType,
                u.CreateDate,
                u.Image,
                u.Latitude,
                u.Longitude,
                u.Sex,
                u.Exp,
                u.Bonus,
                u.Birth,
                u.Accounttype,
                u.HonNhan,
								u.IsSearch2
                ,c.* from users as u left JOIN cv as c on c.cv_user_id = u.UserID
                					where (u.UserType=3 or FIND_IN_SET(3,u.Accounttype)) and u.IsSearch2=1 and u.Active=1 and u.`Delete`=0
                order by u.UserID desc";
        $query.=" limit 0,".$length;
        $sql=$this->db->query($query);
        $row= array();
        // Lionel 7
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
            }
        }
        return $row;
    }
    function GetTopCompany($lenght)
    {
        $query="SELECT u.usc_id,u.usc_create_time,u.usc_company,u.usc_logo,u.usc_size,COUNT(n.new_id) as sobaiviet,p.point_usc,u.usc_address
                from user_company as u
                		JOIN tbl_point_company as p on u.usc_id=p.usc_id
                		join new as n on u.usc_id = n.new_user_id
                where u.usc_id IN (SELECT new_user_id FROM new WHERE (new_hot = 0 OR new_do = 0 OR new_gap = 0 OR new_cao = 0))
                GROUP BY u.usc_id
                order by n.new_hot desc,n.new_do desc,n.new_gap desc,n.new_cao desc,u.usc_id desc
                limit ".$lenght;
        $row="";
        $sql=$this->db->query($query);
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
            }
        }
        return $row;
    }
    function detailjobbyid($id)
    {
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,
                    u.usc_create_time,
                    u.usc_company,
                    u.usc_logo,
                    u.usc_name_add,
                    u.usc_address,
                    u.usc_name_phone,
                    u.usc_phone,
                    u.usc_name_email,
                    u.usc_size,
                    u.UserID,
                    nm.new_mota,
                    nm.new_yeucau,
                    nm.new_quyenloi,
                    nm.new_ho_so,
                    nm.meta_title,
                    nm.meta_desc,
                    nm.meta_keywork
                    from new as n left join user_company as u on n.new_user_id=u.usc_id left join new_multi as nm on n.new_id=nm.new_id";
        $query .=" Where n.new_id='".$id."'";
        //var_dump($query);
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            $row=$sql->row();
        }
        return $row;
    }
    function detailjobbycreate($id,$userid)
    {
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,
                    u.usc_create_time,
                    u.usc_company,
                    u.usc_logo,
                    u.usc_name_add,
                    u.usc_address,
                    u.usc_name_phone,
                    u.usc_phone,
                    u.usc_name_email,
                    u.usc_size,
                    u.UserID,
                    nm.new_mota,
                    nm.new_yeucau,
                    nm.new_quyenloi,
                    nm.new_ho_so,
                    nm.meta_title,
                    nm.meta_desc,
                    nm.meta_keywork

                    from new as n left join user_company as u on n.new_user_id=u.usc_id left join new_multi as nm on n.new_id=nm.new_id";
        $query .=" Where n.new_id='".$id."' and u.usc_id='".$userid."'";
        //var_dump($query);
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            $row=$sql->row();
        }
        return $row;
    }
		function GetListclass($order,$perpage)
		{
	$query="select t.*from teacherclass as t";
	$query.=" where t.Active =1 and t.SubjectID >0 ";
		if(strtolower($order)=='last'){
				$query.=" ORDER BY t.CreateDate desc";
		}else if(strtolower($order)=='pricelow'){
				$query.=" ORDER BY t.Money ASC";
		}else if(strtolower($order)=='pricehigh'){
				$query.=" ORDER BY t.Money DESC";
		}
		//var_dump($query);die();
		$total=$this->db->query($query)->num_rows();
		$query.=" LIMIT ".$perpage;
		$db_qr = $this->db->query($query);
		$tg1="";
		if($db_qr->num_rows() > 0)
		{
				foreach($db_qr->result() as $itemcat)
				{
						$tg1[]=$itemcat;
				}
		}
		return $tg1;
	}
	    function GetDetailCompanyByID($id)
	    {
	        $query="SELECT u.usc_id,u.usc_email,u.usc_website,u.usc_phone,u.usc_id,u.usc_create_time,u.usc_company,u.usc_logo,u.usc_size,u.usc_address ,c.usc_company_info,u.UserID from user_company as u left join user_company_multi as c on u.usc_id=c.usc_id where u.UserID='".intval($id)."'";
	        $sql=$this->db->query($query);
	        $row="";
	        if($sql->num_rows()> 0)
	        {
	            $row=$sql->row();
	        }
	        return $row;
	    }
			function GetDetailCompanyByID1($id)
	    {
	        $query="SELECT u.usc_id,u.usc_email,u.usc_website,u.usc_phone,u.usc_id,u.usc_create_time,u.usc_company,u.usc_logo,u.usc_size,u.usc_address ,c.usc_company_info,u.UserID from user_company as u left join user_company_multi as c on u.usc_id=c.usc_id where u.usc_id='".intval($id)."'";
	        $sql=$this->db->query($query);
	        $row="";
	        if($sql->num_rows()> 0)
	        {
	            $row=$sql->row();
	        }
	        return $row;
	    }

		function GetMoreJobByCompany($id){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_company
                    from new as n left join user_company as u on n.new_user_id=u.usc_id
                    where n.new_han_nop > '".$timenow1."'";
                    $query .=" and n.new_user_id ='".$id."'";
                    $query.=" order by n.new_id desc limit 0,6";

                    $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
                }



        }
        return $row;
    }
    function GetCountJobByProvince($type,$cat,$pro,$keywork)
    {
        //type =1:viec lam them, 2: viec lam nganh nghe tại, 3: tìm việc làm
        //$query="select t.cit_id,t.cit_name,SUM(t.sobanghi) as tongbanghi from ((select c.cit_id,c.cit_name, COUNT(n.new_money)as sobanghi
//                from new as n ,city as c
//                where n.new_han_nop > 0  and LENGTH(n.new_city)>= 3 and FIND_IN_SET(c.cit_id , n.new_city)
//                GROUP BY c.cit_id)
//union ALL
//(
//select c.cit_id,c.cit_name, COUNT(n.new_money)as sobanghi
//                from new as n ,city as c
//                where n.new_han_nop > 0  and LENGTH(n.new_city)< 3 and n.new_city=c.cit_id
//                GROUP BY c.cit_id
//)) as t
//GROUP BY t.cit_id";

$query="select c.cit_id,c.cit_name, COUNT(n.new_money)as tongbanghi
                from new as n ,city as c
                where n.new_han_nop > 0  and FIND_IN_SET(c.cit_id , n.new_city)
                GROUP BY c.cit_id";

        $sql=$this->db->query($query);
            $row="";
            if($sql->num_rows()> 0)
            {
                foreach($sql->result() as $item){
                        $item1['cit_id']=$item->cit_id;
                        $item1['cit_name']=$item->cit_name;
                        $item1['tongbanghi']=$item->tongbanghi;
                        if($type < 3){
                        $urltt="";
                        if(intval($item->cit_id)>=1){
                            $urltt="-tai-".vn_str_filter(Getcitybyindex($item->cit_id));
                        }
                        $urlnn="";
                        if(intval($cat)>=1){
                            $urlnn="-".vn_str_filter(GetCategory($cat));
                        }
                        $link=base_url()."viec-lam".$urlnn.$urltt."-c".intval($cat)."p".$item->cit_id.".html";
                        }else{
                            $link=base_url()."tim-viec-lam&keywork=".$keywork."&dd=".intval($item->cit_id)."&nn=".intval($cat);
                        }
                        $item1['url']=$link;
                        $row[]=$item1;
                    }



            }
            return $row;
    }
    function GetCounJobByCategory($type,$cat,$pro,$keywork)
    {
        //type =1:viec lam them, 2: viec lam nganh nghe tại, 3: tìm việc làm
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        //var_dump($type,$cat,$pro,$keywork);
        //$query="select t.cat_id,t.cat_name,SUM(t.sobanghi) as tongbanghi from ((select c.cat_id,c.cat_name, COUNT(n.new_money)as sobanghi
//                from new as n ,category as c
//                where n.new_han_nop > '".$timenow1."'  and LENGTH(n.new_cat_id)>= 3 and FIND_IN_SET(c.cat_id , n.new_cat_id)
//                GROUP BY c.cat_id)
//        union ALL
//        (
//        select c.cat_id,c.cat_name, COUNT(n.new_money)as sobanghi
//                        from new as n ,category as c
//                        where n.new_han_nop > '".$timenow1."'  and LENGTH(n.new_cat_id)< 3 and n.new_cat_id=c.cat_id
//                        GROUP BY c.cat_id
//        )) as t
//        GROUP BY t.cat_id";
$query="select c.cat_id,c.cat_name, COUNT(n.new_money)as tongbanghi
                from new as n ,category as c
                where n.new_han_nop > '".$timenow1."'  and FIND_IN_SET(c.cat_id , n.new_cat_id)
                GROUP BY c.cat_id";
        $sql=$this->db->query($query);
            $row="";
            if($sql->num_rows()> 0)
            {
                foreach($sql->result() as $item){
                        $item1['cat_id']=$item->cat_id;
                        $item1['cat_name']=$item->cat_name;
                        $item1['tongbanghi']=$item->tongbanghi;
                        if($type < 3){
                        $urltt="";
                        if(intval($pro)>=1){
                            $urltt="-tai-".vn_str_filter(Getcitybyindex($pro));
                        }
                        $urlnn="";
                        if(intval($item->cat_id)>=1){
                            $urlnn="-".vn_str_filter(GetCategory($item->cat_id));
                        }
                        $link=base_url()."viec-lam".$urlnn.$urltt."-c".intval($item->cat_id)."p".intval($pro).".html";
                        }else{
                            $link=base_url()."tim-viec-lam&keywork=".$keywork."&dd=".intval($pro)."&nn=".intval($item->cat_id);
                        }
                        $item1['url']=$link;
                        $row[]=$item1;
                    }

            }
            return $row;
    }
    function GetCountCandiByCity($keywork,$cat,$type)
    {
        $query="select u.use_city,IFNULL(c.cit_name, 'Chưa cập nhật') as tinhthanh ,COUNT(u.use_city) as soungvien from `user` as u left join city as c on u.use_city=c.cit_id
        GROUP BY u.use_city";
        $sql=$this->db->query($query);
        $row="";
        //var_dump($keywork,$cat,$type);
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                        $item1['use_city']=$item->use_city;
                        $item1['tinhthanh']=$item->tinhthanh;
                        $item1['soungvien']=$item->soungvien;
                        if($type <=2){
                        $urltt="";
                        if(intval($item->use_city)>=1){
                            $urltt="-tai-".vn_str_filter($item->tinhthanh);
                        }else{
                            $urltt="-chua-cap-nhat";
                        }
                        $urlnn="";
                        if(intval($cat)>=1){
                            $urlnn="-".vn_str_filter(GetCategory($cat));

                        }
                        $link=base_url()."ung-vien".$urlnn.$urltt."-u".intval($cat)."s".$item->use_city.".html";
                        }else{
                         $link=base_url()."tim-ung-vien&keywork=".$keywork."&dd=".$item->use_city."&nn=".intval($cat);
                        }
                        $item1['url']=$link;
                        $row[]=$item1;
                    }

        }
        return $row;
    }
    function GetCountCandiByCategory($keywork,$cate,$type)
    {
        $query="select c1.cv_cate_id,IFNULL(c.cat_name, 'Chưa cập nhật') as nganhnghe ,COUNT(c1.cv_cate_id) as soungvien
        from `user` as u join cv as c1 on c1.cv_user_id=u.use_id
        			left join category as c on c.cat_id=c1.cv_cate_id
        GROUP BY c1.cv_cate_id";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                        $item1['cv_cate_id']=$item->cv_cate_id;
                        $item1['nganhnghe']=$item->nganhnghe;
                        $item1['soungvien']=$item->soungvien;
                        if($type <=2){
                        $urltt="";
                        if(intval($cate)>=1){
                            $urltt="-tai-".vn_str_filter(Getcitybyindex($cate));
                        }else{
                            $urltt="-chua-cap-nhat";
                        }
                        $urlnn="";
                        if(intval($item->cv_cate_id)>=1){
                            $urlnn="-".vn_str_filter(GetCategory($item->cv_cate_id));
                        }
                        $link=base_url()."ung-vien".$urlnn.$urltt."-u".intval($item->cv_cate_id)."s".intval($cate).".html";
                        }else{
                         $link=base_url()."tim-ung-vien&keywork=".$keywork."&dd=".intval($cate)."&nn=".intval($item->cv_cate_id);
                        }
                        $item1['url']=$link;
                        $row[]=$item1;
                    }

        }
        return $row;
    }
    function GetSalaryByCandi()
    {
        $query="select c.cv_money_id,COUNT(c.cv_user_id) as sobanghi,
                CASE c.cv_money_id
                				  WHEN 0 THEN N'Thỏa thuận'
                				  WHEN 1 THEN N'1 - 3 triệu'
                				  WHEN 2 THEN N'3 - 5 triệu'
                				  WHEN 3 THEN N'5 - 7 triệu'
                				  WHEN 4 THEN N'7 - 10 triệu'
                					WHEN 5 THEN N'10 - 15 triệu'
                					WHEN 6 THEN N'15 - 20 triệu'
                					WHEN 7 THEN N'20 - 30 triệu'
                					WHEN 8 THEN N'Trên 30 triệu'
                			   END As NameMoney
                from `user` as u join cv as c on c.cv_user_id=u.use_id
                group by c.cv_money_id";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
                }
        }
        return $row;
    }
    function GetExpbyCandi()
    {
        $query="select c.cv_exp,COUNT(c.cv_user_id) as sobanghi,
                CASE c.cv_exp
                				  WHEN 0 THEN N'Chưa có kinh nghiệm'
                				  WHEN 1 THEN N'0 - 1 năm kinh nghiệm'
                				  WHEN 2 THEN N'1 - 2 năm kinh nghiệm'
                				  WHEN 3 THEN N'2 - 5 năm kinh nghiệm'
                				  WHEN 4 THEN N'5 - 10 năm kinh nghiệm'
              				    WHEN 5 THEN N'Hơn 10 năm kinh nghiệm'
                				END As NameExp
                from `user` as u join cv as c on c.cv_user_id=u.use_id
where c.cv_exp < 6
                group by c.cv_exp";
                $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
                }
        }
        return $row;
    }
    function GetFilterABCBycandi($city,$cat,$type)
    {
        $arrabc=GetABC();
        $row="";
        for($i=0;$i<count($arrabc);$i++){
            if($type==1){
                $link="tim-ung-vien&keywork=".$arrabc[$i]."&dd=".intval($city)."&nn=".intval($cat)."";
                $item1['url']=base_url().$link;
                $item1['name']=$arrabc[$i];
            }else{

            }
            $row[]=$item1;
        }
        return $row;

    }
		function FindCandiBySearch($key,$nganh,$tinh,$page,$perpage){
        $query="select u.UserID,
u.`Name`,
u.UserName,
u.Phone,
u.`Email`,
u.CityID,
u.CityName,
u.Address,
u.Description,
u.UserType,
u.CreateDate,
u.Image,
u.Latitude,
u.Longitude,
u.Sex,
u.Exp,
u.Bonus,
u.Birth,
u.UpdateDate,
u.Accounttype,
u.HonNhan,
u.IsSearch2
,c.*
        from `users` as u join cv as c on u.UserID=c.cv_user_id
        where u.Active =1 and u.IsSearch2=1 and (u.UserType=3 or FIND_IN_SET(3,u.Accounttype))";
        if(!empty($key) && $key !='all'){
            $query.=" and u.`Name` like '%".str_replace(' ','%',$key)."%'";
        }
        if(intval($nganh)>0){
           $query.=" and (c.cv_cate_id ='".intval($nganh)."' or FIND_IN_SET('".$nganh."',c.cate_extra))";
        }
        if(intval($tinh)>0){
           $query.=" and (c.cv_city_id ='".intval($tinh)."' or FIND_IN_SET('".$tinh."',c.city_extra))";
        }

        $query.=" order by u.UserID desc";
        $query.=" limit ".$page.",".$perpage;

        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
            }
        }
        return $row;

    }
		function TotalFindCandiBySearch($key,$nganh,$tinh){
        $query="select	u.UserID,
u.`Name`,
u.UserName,
u.Phone,
u.Email,
u.CityID,
u.CityName,
u.Address,
u.Description,
u.UserType,
u.CreateDate,
u.Image,
u.Latitude,
u.Longitude,
u.Sex,
u.Exp,
u.Bonus,
u.Birth,
u.UpdateDate,
u.Accounttype,
u.HonNhan,
u.IsSearch2
,c.*
        from `users` as u join cv as c on u.UserID=c.cv_user_id
        where u.Active =1 and u.IsSearch2=1 and (u.UserType=3 or FIND_IN_SET(3,u.Accounttype))";
         if(!empty($key) && $key !='all'){
            $query.=" and u.`Name` like '%".str_replace(' ','%',$key)."%'";
        }
        if(intval($nganh)>0){
           $query.=" and (c.cv_cate_id ='".intval($nganh)."' or FIND_IN_SET('".$nganh."',c.cate_extra))";
        }
        if(intval($tinh)>0){
           $query.=" and (c.cv_city_id ='".intval($tinh)."' or FIND_IN_SET('".$tinh."',c.city_extra))";
        }

        $query.=" order by u.UserID desc";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            $row=$sql->num_rows();
        }
        return $row;

    }
    function GetCityByCompany($nganhnghe,$findkey,$type)
    {
        $query="SELECT cit_id,cit_name from city ORDER BY cit_id asc";
        $sql=$this->db->query($query);
            $row="";
        if($sql->num_rows()> 0)
            {
                foreach($sql->result() as $item){
                        $item1['cit_id']=$item->cit_id;
                        $item1['cit_name']=$item->cit_name;
                        //$item1['tongbanghi']=$item->tongbanghi;
                       if($findkey !=''){
                        $link=base_url()."nha-tuyen-dung&keywork=".$findkey."&c=".$item->cit_id."&n=".$nganhnghe."&type=1";
                        }else{
                            $link=base_url()."nha-tuyen-dung&keywork=&c=".$item->cit_id."&n=".$nganhnghe."&type=1";
                        }
                        $item1['url']=$link;
                        $row[]=$item1;
                    }



            }
            return $row;
    }
    function GetCatByCompany($city,$findkey,$type)
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.'- 30 day');
        $query="SELECT c.cat_id,c.cat_name,COUNT(n.new_user_id) as socongty from new as n,category as c WHERE n.new_han_nop > '".$timenow1."' and FIND_IN_SET(c.cat_id,n.new_cat_id)
GROUP BY c.cat_id";
        $sql=$this->db->query($query);
            $row="";
        if($sql->num_rows()> 0)
            {
                foreach($sql->result() as $item){
                        $item1['cat_id']=$item->cat_id;
                        $item1['cat_name']=$item->cat_name;
                        $item1['socongty']=$item->socongty;
                       if($findkey !=''){
                        $link=base_url()."nha-tuyen-dung&keywork=".$findkey."&c=".$city."&n=".$item->cat_id."&type=1";
                        }else{
                           $link=base_url()."nha-tuyen-dung&keywork=&c=".$city."&n=".$item->cat_id."&type=1";
                        }
                        $item1['url']=$link;
                        $row[]=$item1;
                    }



            }
            return $row;
    }
    function GetFilterABCByType($city,$cat,$type)
    {
        $arrabc=GetABC();
        $row="";
        for($i=0;$i<count($arrabc);$i++){
            if($type==1){
                $link="nha-tuyen-dung&keywork=".$arrabc[$i]."&c=".$city."&n=".$cat."&type=2";
                $item1['url']=$link;
                $item1['name']=$arrabc[$i];
            }else{

            }
            $row[]=$item1;
        }
        return $row;

    }
    function GetCountJobbyEdu()
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select e.EduID,e.TitleEdu,COUNT(n.new_id) as sobanghi,ValueOption from new as n, edulevel as e
                WHERE n.new_han_nop > '".$timenow1."' and n.new_bang_cap in (e.ValueOption)
                GROUP BY e.EduID";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
            {
                foreach($sql->result() as $item){

                        $row[]=$item;
                    }



            }
        return $row;
    }
    function GetCountJobByLevel()
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select e.LevelID,e.Title,COUNT(n.new_id) as sobanghi from new as n, `level` as e
                    WHERE n.new_han_nop >'".$timenow1."' and n.new_cap_bac =e.LevelID
                    GROUP BY e.LevelID";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
            {
                foreach($sql->result() as $item){

                        $row[]=$item;
                    }



            }
        return $row;
    }
    function GetCountJobByEXP()
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select e.ExperienceID,e.TitleEX,COUNT(n.new_id) as sobanghi,e.ValueOption from new as n, experience as e
                WHERE n.new_han_nop > '".$timenow1."' and n.new_exp =e.ValueOption
                GROUP BY e.ExperienceID";
          $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
            {
                foreach($sql->result() as $item){

                        $row[]=$item;
                    }
            }
        return $row;
    }
    function GetLisCompanyByFillter($findkey,$category,$city,$type,$page,$perpage)
    {
        $query="SELECT u.usc_id,u.usc_create_time,u.usc_company,u.usc_logo,u.usc_size,COUNT(n.new_id) as sobaiviet,p.point_usc,u.usc_address  from user_company as u
		JOIN tbl_point_company as p on u.usc_id=p.usc_id
		join new as n on u.usc_id = n.new_user_id where 1=1";
        if(intval($category)>0){
            $query.=" and FIND_IN_SET('".$category."',n.new_cat_id)";
        }
        if(intval($city)>0){
            $query.=" and FIND_IN_SET('".$city."',n.new_city)";
        }
        if($type==2){
            if($findkey != ''){
                if($findkey=='0-9'){
                    $query.=" and(u.usc_company BETWEEN '0' AND '9')";
                }else{
                    $query.=" and u.usc_company like '".$findkey."%'";
                }
            }
        }else{
            if($findkey !=''){
                $findkey=preg_replace('/([^\pL\.\ ]+)/u', '', strip_tags($findkey));
                $query.=" and u.usc_company like '%".str_replace(' ','%',$findkey)."%'";
            }

        }
        $query.=" GROUP BY u.usc_id";
        $total=$this->db->query($query)->num_rows();
        //var_dump($total);die();
        $query.=" order by sobaiviet desc limit ".$page.",".$perpage;;
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
            }
        }
        return array('data'=>$row,'total'=>$total);
    }
    function GetListJobforfilter($keywork,$cookjobedu,$cookjobexperion,$cookjoblevel,$cookjobupdate,$idcat,$idpro,$page,$perpage)
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        if(!empty($cookjobupdate)){
            if($cookjobupdate=="week"){
                $timenow1 = strtotime($timenow.' - 7 day');
            }
            if($cookjobupdate=="twoweek"){
                $timenow1 = strtotime($timenow.' - 14 day');
            }
            if($cookjobupdate=="month"){
                $timenow1 = strtotime($timenow.' - 30 day');
            }
            if($cookjobupdate=="twomonth"){
                $timenow1 = strtotime($timenow.' - 60 day');
            }
            if($cookjobupdate=="all"){
                //$timenow1 = strtotime($timenow.' - 360 day');
            }
        }
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_create_time,u.usc_company,u.usc_logo
                    from new as n left join user_company as u on n.new_user_id=u.usc_id
                    where 1=1";
                   if(intval($idcat)>0){
                    $query.=" And FIND_IN_SET('".$idcat."',n.new_cat_id)";
                   }
                   if(intval($idpro)>0){
                    $query.=" and FIND_IN_SET('".$idpro."',n.new_city)";
                   }
                   if(isset($cookjobedu) && $cookjobedu !='') {
                    $query.=" and n.new_bang_cap in(".$cookjobedu.")";
                   }
                   if(!empty($cookjobexperion)  && $cookjobexperion !='') {
                    $query.=" and n.new_exp='".$cookjobexperion."'";
                   }
                   if(!empty($cookjoblevel)  && $cookjoblevel !='') {
                    $query.=" and n.new_cap_bac ='".$cookjoblevel."'";
                   }
                   if(!empty($cookjobupdate) && $cookjobupdate!='all'  && $cookjobupdate !='') {
                    $query.=" and n.new_han_nop >'".$timenow1."'";
                   }
                   if($keywork !=''){
                    $keywork=preg_replace('/([^\pL\.\ ]+)/u', '', strip_tags($keywork));
                    $query.=" and n.new_title like '%".str_replace(' ','%',$keywork)."%'";
                   }
                    $query.=" order by n.new_id desc";
                  //var_dump($query);

        $total=$this->db->query($query)->num_rows();
        $query.=" limit ".$page.",".$perpage;
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
            }
        }
        return array('data'=>$row,'total'=>$total);
    }
    function GetListJobbyCatAndProvince($cookjobedu,$cookjobexperion,$cookjoblevel,$cookjobupdate,$idcat,$idpro,$page,$perpage)
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        if(!empty($cookjobupdate)){
            if($cookjobupdate=="week"){
                $timenow1 = strtotime($timenow.' - 7 day');
            }
            if($cookjobupdate=="twoweek"){
                $timenow1 = strtotime($timenow.' - 14 day');
            }
            if($cookjobupdate=="month"){
                $timenow1 = strtotime($timenow.' - 30 day');
            }
            if($cookjobupdate=="twomonth"){
                $timenow1 = strtotime($timenow.' - 60 day');
            }
            if($cookjobupdate=="all"){
                //$timenow1 = strtotime($timenow.' - 360 day');
            }
        }
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_create_time,u.usc_company,u.usc_logo
                    from new as n left join user_company as u on n.new_user_id=u.usc_id
                    where 1=1";
                   if(intval($idcat)>0){
                    $query.=" And FIND_IN_SET('".$idcat."',n.new_cat_id)";
                   }
                   if(intval($idpro)>0){
                    $query.=" and FIND_IN_SET('".$idpro."',n.new_city)";
                   }
                   if(isset($cookjobedu) && $cookjobedu !='') {
                    $query.=" and n.new_bang_cap in(".$cookjobedu.")";
                   }
                   if(!empty($cookjobexperion)  && $cookjobexperion !='') {
                    $query.=" and n.new_exp='".$cookjobexperion."'";
                   }
                   if(!empty($cookjoblevel)  && $cookjoblevel !='') {
                    $query.=" and n.new_cap_bac ='".$cookjoblevel."'";
                   }
                   if(!empty($cookjobupdate) && $cookjobupdate!='all'  && $cookjobupdate !='') {
                    $query.=" and n.new_han_nop >'".$timenow1."'";
                   }
                    $query.=" order by n.new_id desc limit ".$page.",".$perpage;
                  //var_dump($query);
                    $sql=$this->db->query($query);
                    $query1="select count(*) as sobanghi,
                    SUM(CASE WHEN n.new_han_nop > '".$timenow1."' THEN 1 ELSE 0 END) AS tinconhan
                    from new as n where 1=1";
                    if(intval($idcat)>0){
                    $query1.=" And FIND_IN_SET('".$idcat."',n.new_cat_id)";
                   }
                   if(intval($idpro)>0){
                    $query1.=" and FIND_IN_SET('".$idpro."',n.new_city)";
                   }
                   if(isset($cookjobedu) && $cookjobedu !='') {
                    $query1.=" and n.new_bang_cap in(".$cookjobedu.")";
                   }
                   if(!empty($cookjobexperion) && $cookjobexperion !='') {
                    $query1.=" and n.new_exp='".$cookjobexperion."'";
                   }
                   if(!empty($cookjoblevel) && $cookjoblevel !='') {
                    $query1.=" and n.new_cap_bac ='".$cookjoblevel."'";
                   }
                   if(!empty($cookjobupdate) && $cookjobupdate!='all' && $cookjobupdate !='') {
                    $query1.=" and n.new_han_nop >'".$timenow1."'";
                   }
        $query1.=" order by n.new_id desc";
         //var_dump($query1);
        $sql1=$this->db->query($query1);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
            }
        }
        return array('data'=>$row,'total'=>$sql1->row());
    }
    function GetRelativeJobdetail($catid,$idnew){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.new_id,
                    n.new_title,
                    n.new_cat_id,
                    n.new_city,
                    n.new_qh_id,
                    n.new_money,
                    n.new_cap_bac,
                    n.new_exp,
                    n.new_bang_cap,
                    n.new_gioi_tinh,
                    n.new_so_luong,
                    n.new_hinh_thuc,
                    n.new_user_id,
                    n.new_do_tuoi,
                    n.new_type,
                    n.new_over,
                    n.new_view_count,
                    n.new_han_nop,
                    n.new_post,
                    n.new_renew,
                    n.new_hot,
                    n.new_do,
                    n.new_gap,
                    n.new_cao,
                    n.new_thuc,
                    n.new_order,
                    n.source,u.usc_company
                    from new as n left join user_company as u on n.new_user_id=u.usc_id
                    where n.new_han_nop > '".$timenow1."'";
                    $arr=explode(',',$catid);
                    for($i=0;$i< count($arr);$i++){
                        $query.=" And FIND_IN_SET(".$arr[$i].",n.new_cat_id)";
                    }
                    $query .=" and n.new_id <>'".$idnew."'";
                    $query.=" order by n.new_id desc limit 0,6";
                    //var_dump($query);
                    $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
                }
        }
        return $row;
    }
    function getconfig()
    {
        $this->db->where('id',1);
        $this->db->order_by('id','desc');
        $sql=$this->db->get('tbl_footer');
        if($sql->num_rows() > 0)
        {
          $row = $sql->row();//mysql_fetch_assoc($db_qr->result);
          return $row;
        }
    }
    function create_token($userid,$ip,$type)
    {
       //if (function_exists('com_create_guid') === true)
       //{
       //  return trim(com_create_guid(), '{}');
       //}
       $timecreate = date("Y-m-d H:i:s",time());
       $timexpired = strtotime('+90 minutes',time());
       $timexpired = date("Y-m-d H:i:s",$timexpired);
       $token = $this->v4_guid();//sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
       $db_token =$this->db->query("INSERT INTO tokens(UserId,AuthToken,IssuedOn,ExpiresOn,IP,Type)
                               VALUES('".$userid."','".$token."','".$timecreate."','".$timexpired."','".$ip."','".$type."')");
       //var_dump($db_token);die();
       //unset($db_token);
       return $token;
    }
    function v4_guid() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

          // 32 bits for "time_low"
          mt_rand(0, 0xffff), mt_rand(0, 0xffff),

          // 16 bits for "time_mid"
          mt_rand(0, 0xffff),

          // 16 bits for "time_hi_and_version",
          // four most significant bits holds version number 4
          mt_rand(0, 0x0fff) | 0x4000,

          // 16 bits, 8 bits for "clk_seq_hi_res",
          // 8 bits for "clk_seq_low",
          // two most significant bits holds zero and one for variant DCE1.1
          mt_rand(0, 0x3fff) | 0x8000,

          // 48 bits for "node"
          mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
      }
    function Checktoken($token,$userid)
    {
       $now = 0;
       $db_qr = $this->db->query("SELECT * FROM tokens WHERE AuthToken = '".$token."' AND userid = '".$userid."' LIMIT 1");
       if($db_qr->num_rows() > 0)
       {
          $row = $db_qr->row();//mysql_fetch_assoc($db_qr->result);
          $expired = $row['ExpiresOn'];
          $expired = strtotime($expired);
          if($expired < time())
          {
             $now = 0;
          }
          else
          {
             $now = 1;
          }
       }
       return $now;
    }
    function GetTokenByUserID($userid)
    {
       $now = "";
       $db_qr = $this->db->query("SELECT * FROM tokens WHERE UserId = '".$userid."' ORDER By TokenId DESC LIMIT 1");
       if($db_qr->num_rows() > 0)
       {
          $row =$db_qr->row();// mysql_fetch_assoc($db_qr->result);
          $expired = $row['ExpiresOn'];
          $expired = strtotime($expired);
          if($expired < time())
          {
             $now = "";
          }
          else
          {
             $now = $row['AuthToken'];
          }
       }
       return $now;
    }
    function ChecktokenExpired($token)
    {
       $now = 0;
       $db_qr = $this->db->query("SELECT * FROM tokens WHERE 	AuthToken = '".$token."' ORDER BY TokenId DESC LIMIT 1");
       if($db_qr->num_rows() > 0)
       {
          $row = $db_qr->row();// mysql_fetch_assoc($db_qr->result);
          $expired = $row['ExpiresOn'];
          $expired = strtotime($expired);
          if($expired < time())
          {
             $now = 0;
          }
          else
          {
             $now = $row['UserId'];
          }
       }
       return $now;
    }
    function deltokenbyuserid($userid)
    {
        $db_qr = $this->db->query("delete FROM tokens WHERE UserId = '".$userid."'");
        return 1;
    }
    function GetWordtime()
    {
        $query="select * from worktime order by worktimeID ASC";
        $db_qr = $this->db->query($query);
        if($db_qr->num_rows() > 0)
        {
            $tg1="";
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function GetSex()
    {
        $query="select * from sex order by SexID ASC";
         $db_qr = $this->db->query($query);
        if($db_qr->num_rows() > 0)
        {
            $tg1="";
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }

    function EmailNofity($findkey)
    {
        $query="Select Email from EmailNotify where Email like'%".$findkey."%'";
        $dbcompany = $this->db->query($query);
        if($dbcompany->num_rows() > 0)
        {
            $data=array('kq'=>false,'msg'=>'Bạn đã đăng ký nhận thông tin trước đó');
        }else{
            $timecreate = date("Y-m-d H:i:s",time());
            $query ="INSERT INTO EmailNotify(Email,CreateDate,`Order`)VALUES('".strtolower($findkey)."','".$timecreate."',0)";
            //var_dump($query);die();
            $db_token =$this->db->query($query);
            $data=array('kq'=>true,'msg'=>'Bạn đã đăng ký nhận thông tin thành công');
        }
        return $data;
    }
    function GetCategoryWithLink()
    {
        //$query="select c.cat_id,c.cat_name from category as c limit 64";
        $query="select c.cat_id,c.cat_name,COUNT(n.new_id)as tinconhan from category as c, new as n where FIND_IN_SET(c.cat_id,n.new_cat_id) and n.new_han_nop >'".time()."' GROUP BY c.cat_id ORDER BY tinconhan desc limit 64";
        $db_qr = $this->db->query($query);
        if($db_qr->num_rows() > 0)
        {
            $tg1="";
            foreach($db_qr->result() as $itemcat)
            {
                //viec-lam-viec-lam-ban-hang-c10p0.html
                $item['id']=$itemcat->cat_id;
                $item['soluongbai']=$itemcat->tinconhan;
                $item['name']=$itemcat->cat_name;
                $item['url']=base_url()."viec-lam-".vn_str_filter($itemcat->cat_name)."-c".$itemcat->cat_id."p0.html";
                $tg1[]=$item;
            }
        }
        return $tg1;
    }
    function GetProvinceWithLink()
    {
        $query="select c.cit_id,c.cit_name from city as c";
        $db_qr = $this->db->query($query);
        if($db_qr->num_rows() > 0)
        {
            $tg1="";
            foreach($db_qr->result() as $itemcat)
            {
                //viec-lam-viec-lam-ban-hang-c10p0.html
                $item['name']=$itemcat->cit_name;
                $item['url']=base_url()."viec-lam-tai-".vn_str_filter($itemcat->cit_name)."-c0p".$itemcat->cit_id.".html";
                $tg1[]=$item;
            }
        }
        return $tg1;
    }
    function RegisterCandi($name,$email,$pass,$phone,$city,$ngaysinh,$gioitinh,$honnhan,$cvtitle,$bangcap,$hinhthuclamviec,$capbac,$noilamvieckhac,$nganhnghe,$extrann,$muctieu,$kynang,$diachi,$mucluong,$kinhnghiem,$district,$school,$schooltype,$xeploaihoctap,$languagecandi)
    {
        $queryket="select * from `users` where UserName = '".$phone."'";
        $db_qr = $this->db->query($queryket);
        $CreateDate=date("Y-m-d H:i:s",time());
        if($db_qr->num_rows() > 0)
        {
            return array('userid'=>0,'code'=>'');
            }else{
                $IP=getUserIP();
        $countuser=$this->countuserbyip($IP);
        if($countuser <=10){
        //$query="Insert into user(use_email,use_first_name,use_pass,use_type,use_create_time,use_update_time,use_phone,use_city,use_authentic,use_gioi_tinh,use_birth_day,use_address,use_hon_nhan)";
        //$query.="values('".$email."','".$name."','".md5($pass)."','0','".time()."','".time()."','".$phone."','".intval($city)."','0','".intval($gioitinh)."','".strtotime($ngaysinh)."','".$diachi."','".intval($honnhan)."')";
        $query="Insert into users(`Name`,UserName,Phone,Email,CityID,CityName,Address,Description,UserType,`Password`,CreateDate,CreateBy,Image,Active,`Delete`,Latitude,Longitude,Sex,Exp,Bonus,Birth,Accounttype,IP)";
        $query.="values('".$name."','".trim($phone)."','".trim($phone)."','".$email."','".$city."','".Getcitybyindex($city)."','".$diachi."','".$muctieu." ".$kynang."','3','".md5($pass)."','".$CreateDate."','1','','1','0','','','".intval($gioitinh)."','".$kinhnghiem."','".$kynang."','".$ngaysinh."','3','".$IP."')";

        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id();
        $query="INSERT INTO cv(cv_user_id,cv_title,cv_hocvan,cv_loaihinh_id,cv_capbac_id,cv_money_id,cv_exp,cv_kynang,cv_muctieu,cv_cate_id,cate_extra,cv_city_id,city_extra,district,school,schooltype,xeploaihoctap,language)
        VALUES(".$insertid.",'".$cvtitle."','".intval($bangcap)."','".intval($hinhthuclamviec)."','".intval($capbac)."','".intval($mucluong)."','".intval($kinhnghiem)."','".$kynang."','".$muctieu."','".intval($nganhnghe)."','".$extrann."','".intval($city)."','".intval($noilamvieckhac)."','".intval($district)."','".$school."','".$schooltype."','".intval($xeploaihoctap)."','".intval($languagecandi)."')";
        $insert=$this->db->query($query);
        $type=1;
        $code=rand(100000,999999);
        $body=file_get_contents(base_url().'EmailTemplate/XacThucEmail.htm');
        $body=str_replace('<%name%>',$name,$body);
        $body=str_replace('<%email%>',$phone,$body);
        $body=str_replace('<%code%>',$code,$body);
        $body=str_replace('<%type%>',$type,$body);

        $Description="Đăng ký tài khoản";
            $data="";

            $queryconfrim="INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate)
                                                   VALUES('".$insertid."','".$code."','1','0','".$body."','".$Description."','".$CreateDate."','".$CreateDate."')";
        $insert=$this->db->query($queryconfrim);

    	$subject='[timviec24h] Kích hoạt tài khoản đăng ký';
		$header='Từ: timviec24h.net.vn';
        $body = base64_encode($body);
		$this->CreateSendMail($email,$email,"","",$subject,$body);
         return array('userid'=>$insertid,'code'=>$code,'username'=>"$phone");

         }else{
            $result=['userid'=>0,'check'=>true,'data'=>'Vượt quá số lần đăng ký'];
            return $result;
         }
         }
    }
    function RegisterCompany($tencongty,$phone,$email,$city,$pass,$website,$addresscom)
    {
        $queryket="select * from `users` where UserName = '".$phone."'";
        $db_qr = $this->db->query($queryket);
        if($db_qr->num_rows() > 0)
        {
            return array('userid'=>0,'code'=>'');
            }else{
              $IP=getUserIP();
        $countuser=$this->countuserbyip($IP);
        if($countuser <=10){
            $CreateDate=date("Y-m-d H:i:s",time());
        $type=2;
        $queryu="Insert into users(`Name`,UserName,Phone,Email,CityID,CityName,Address,Description,UserType,`Password`,CreateDate,CreateBy,Image,Active,`Delete`,Latitude,Longitude,Sex,Exp,Bonus,Birth,Accounttype,IP)";
        $queryu.="values('".$tencongty."','".trim($phone)."','".trim($phone)."','".$email."','".$city."','".Getcitybyindex($city)."','".$addresscom."','','4','".md5($pass)."','".$CreateDate."','1','','1','0','','','0','','','','4','".$IP."')";

        $insert=$this->db->query($queryu);
        $insertid=$this->db->insert_id();
        $idconfirm=$insertid;
        $query1="select * from user_company where usc_company LIKE '%".strtolower($tencongty)."%' OR usc_email ='".$email."'";
        $insert1=$this->db->query($query1);
        if($insert1->num_rows()>0){
            $row=$insert1->row();
            $qr="update user_company set usc_name_phone='".$phone."',usc_name_email='".$email."',usc_address='".$addresscom."',usc_phone='".$phone."',usc_city='".$city."',usc_website='".$website."',UserID='".$insertid."' where usc_id='".$row->usc_id."'";
            $sql=$this->db->query($qr);
            if($sql)
            {
                $qr="select * from user_company_multi where usc_id='".$row->usc_id."'";
                $sql=$this->db->query($qr);
                if($sql->num_rows()>0){
                }else{
                   $query="INSERT INTO user_company_multi(usc_id)VALUES(".$row->usc_id.")";
                    $insert=$this->db->query($query);
                }
            }
        }else{
        $query="Insert into user_company(usc_email,usc_name,usc_name_add,usc_name_phone,usc_name_email,usc_pass,usc_company,usc_type,usc_address,usc_phone,usc_website,usc_city,usc_create_time,usc_update_time,usc_authentic,UserID)";
        $query.="values('".$email."','".$tencongty."','".$addresscom."','".$phone."','".$email."','".md5($pass)."','".$tencongty."','0','".$addresscom."','".$phone."','".$website."','".$city."','".time()."','".time()."','0','".$insertid."')";
        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id();
        $query="INSERT INTO user_company_multi(usc_id)VALUES(".$insertid.")";
        $insert=$this->db->query($query);
        }
        $code=rand(100000,999999);
        $body=file_get_contents(base_url().'EmailTemplate/XacThucEmail.htm');
        $body=str_replace('<%name%>',$name,$body);
        $body=str_replace('<%email%>',$phone,$body);
        $body=str_replace('<%code%>',$code,$body);
        $body=str_replace('<%type%>',$type,$body);

        $Description="Đăng ký tài khoản công ty";
        $data="";

        $queryconfrim="INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate)
                                                   VALUES('".$idconfirm."','".$code."','2','0','".$body."','".$Description."','".$CreateDate."','".$CreateDate."')";
        $insert=$this->db->query($queryconfrim);

    	$subject='[timviec24h] Kích hoạt tài khoản đăng ký';
		$header='Từ: timviec24h.net.vn';
        $body = base64_encode($body);
		$this->CreateSendMail($email,$email,"","",$subject,$body);
         return array('userid'=>$insertid,'code'=>$code,'username'=>$phone);
         }else{
            return array('userid'=>0,'check'=>true,'data'=>'Vượt quá số lượng đăng ký');
         }
         }
    }
    function getconfirmuser($code,$email,$type){
        $arr=['kq'=>false];
        if(intval($type)<2){
            $query="select * from `users` where UserName ='".$email."' and `Active`=0";
            //var_dump($query);
            $db_qr = $this->db->query($query);
            if($db_qr->num_rows() > 0)
            {
                $item=$db_qr->row();

                $query="select * from comfirmtable where Code='".$code."' and Type='".$type."' and UserID='".$item->UserID."'";
                $db_qr = $this->db->query($query);
                if($db_qr->num_rows() > 0)
                {
                    $item2=$db_qr->row();;
                    $query1="UPDATE `comfirmtable` SET `Status` = '1' WHERE Id = '".$item2->Id."'";
                    $tg=$this->db->query($query1);
                    $query1="UPDATE `users` SET `Active` = '1' WHERE use_id = '".$item->UserID."'";
                    $tg1=$this->db->query($query1);
                    $arr=['kq'=>true];
                }
            }else{
                $arr=['kq'=>true];
            }

        }else{
            $query="select * from `users` where UserName ='".$email."' and `Active`=0";
            //var_dump($query);
            $db_qr = $this->db->query($query);
            if($db_qr->num_rows() > 0)
            {
                $item=$db_qr->row();
                $query="select * from comfirmtable where Code='".$code."' and Type='".$type."' and UserID='".$item->usc_id."'";
                $db_qr = $this->db->query($query);
                if($db_qr->num_rows() > 0)
                {
                    $item2=$db_qr->row();
                    $query1="UPDATE `comfirmtable` SET `Status` = '1' WHERE Id = '".$item2->Id."'";
                    $tg=$this->db->query($query1);
                    $query1="UPDATE `users` SET `Active` = '1' WHERE use_id = '".$item->UserID."'";
                    $tg1=$this->db->query($query1);
                    $arr=['kq'=>true];
                }
            }else{
                $arr=['kq'=>true];
            }
        }
        return $arr;
    }
    function getconfirmuserbycode($code,$username)
    {
       $arr=['kq'=>false];
       $query="select * from users where (UserName ='".$username."' or Phone ='".$username."')";// and `Active`=1
       $db_qr = $this->db->query($query);
            if($db_qr->num_rows() > 0)
            {
                $item=$db_qr->row();
                $query="select * from comfirmtable where Code='".$code."' and UserID='".$item->UserID."' and `Status`=0 order by CreateDate desc";//and Type='0'
                $db_qr = $this->db->query($query);
                if($db_qr->num_rows() > 0)
                {
                    $item2=$db_qr->row();
                    $query1="UPDATE `comfirmtable` SET `Status` = '1' WHERE Id = '".$item2->Id."'";
                    $tg=$this->db->query($query1);
                    $query1="UPDATE `users` SET `Password` = '".md5($code)."' WHERE UserID = '".$item->UserID."'";
                    $tg1=$this->db->query($query1);
                    $arr=['kq'=>true,'mk'=>$code];
                }
            }
       return $arr;
    }

    function DemGiaSuTheoMonHoc()
    {
        $query="select s.ID,s.SubjectName,COUNT(u.SubjectID) as sogiasu from `subject` as s left JOIN usersubject as u on s.ID=u.SubjectID
group by s.ID";
        $db_qr = $this->db->query($query);
        $tg1= array();
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function TimGiaSuTheoMonHoc($key)
    {
        $query="select s.ID,s.SubjectName,COUNT(u.SubjectID) as sogiasu from `subject` as s left JOIN usersubject as u on s.ID=u.SubjectID
where s.SubjectName like '%".str_replace(' ','%',$key)."%'
group by s.ID";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function DemGiaSuTheoTinhThanh()
    {
        $query="select c1.cit_name,c1.cit_id,IFNULL(SUM(c2.sogiasu),0) as giasutt  from city as c1 left join (select c.cit_id,c.cit_name,COUNT(u.UserID) as sogiasu from city as c left JOIN users as u on c.cit_id=u.CityID
		where u.Active=1 and u.`Delete`=0 and u.UserType=1
group by c.cit_id) as c2 on c1.cit_id=c2.cit_id
GROUP BY c1.cit_id";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function timgiasutheotinhthanh($key)
    {
        $query="select c1.cit_name,c1.cit_id,IFNULL(SUM(c2.sogiasu),0) as giasutt  from city as c1 left join (select c.cit_id,c.cit_name,COUNT(u.UserID) as sogiasu from city as c left JOIN users as u on c.cit_id=u.CityID
		where u.Active=1 and u.`Delete`=0 and u.UserType=1
group by c.cit_id) as c2 on c1.cit_id=c2.cit_id
where c1.cit_name like '%".str_replace(' ','%',$key)."%'
GROUP BY c1.cit_id";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function GetListClassHome($number){
        $query="select * from teacherclass ORDER BY ClassID desc limit 0,".$number;
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function getitemlinkseobuysearch($sub,$city,$lophoc,$type)
    {
        $query="select * from linkseo where cityid='".intval($city)."' and subjectid='".intval($sub)."' and `type`='".intval($type)."' and lophoc='".intval($lophoc)."'";

        $news_cat = $this->db->query($query);
        $tg="";
        if($news_cat->num_rows()> 0)
            {
                $tg=$news_cat->row();
                }
                return $tg;
    }
		function GetListClassBySearch($keywork,$subject,$topic,$place,$type,$sex,$page,$perpage)
		{
       $query="select t.*,u.`Name`,u.Phone as sodienthoaidk
        ,u.Email
        ,u.CityID
        ,u.CityName,u.`Image`
        ,u.Address as diachidk
        ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
        from teacherclass as t left join users as u on t.UserID=u.UserID
        left JOIN (select ClassID,
        SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
        SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
         from uservsclass as uc
        GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
        $query.=" where t.ClassTitle <> '' and t.`Active`=1";
        if(!empty($keywork) && strtolower($keywork)!='all'){
            $query.=" and t.ClassTitle like '%".str_replace(' ','%',$keywork)."%'";
        }
        if(intval($place)>0 ){
            $query.=" and t.City ='".intval($place)."'";
        }
        if(intval($subject) >0 && intval($topic)==0){
            $query.=" and t.SubjectID='".intval($subject)."'";
        }
        if(intval($subject)>0 && intval($topic) >0){
					$query.=" and ( ( t.SubjectID='".intval($subject)."' and FIND_IN_SET('".intval($topic)."',t.TopicArr) ) or ( t.SubjectID='".intval($subject)."' and t.TopicArr='' and t.classArr='' ) or(  t.SubjectID='".intval($subject)."' and t.TopicArr='') ) ";
				}
        if(intval($sex)>0){
            $query.=" and FIND_IN_SET('".intval($sex)."',t.TeacherSex)";
        }
        if(intval($type)>0){
            $query.=" and FIND_IN_SET('".intval($type)."',t.LearnType)";
        }
        $query.=" order by t.ClassID,t.UpdateDate desc";
        $query.=" limit ".$page.",".$perpage;

        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
		function GetListClassBySearchTotal($keywork,$subject,$topic,$place,$type,$sex)
		{
       $query="select t.*,u.`Name`,u.Phone as sodienthoaidk
        ,u.Email
        ,u.CityID
        ,u.CityName,u.`Image`
        ,u.Address as diachidk
        ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
         from teacherclass as t left join users as u on t.UserID=u.UserID
        	left JOIN (select ClassID,
        SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
        SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
         from uservsclass as uc
        GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
        $query.=" where t.ClassTitle <> '' and t.`Active`=1";
        if(!empty($keywork) && strtolower($keywork)!='all'){
            $query.=" and t.ClassTitle like '%".str_replace(' ','%',$keywork)."%'";
        }
        if(intval($place)>0 ){
            $query.=" and t.City ='".intval($place)."'";
        }
				if(intval($subject) >0 && intval($topic)==0){
            $query.=" and t.SubjectID='".intval($subject)."'";
        }
        if(intval($subject)>0 && intval($topic) >0){
					$query.=" and ( ( t.SubjectID='".intval($subject)."' and FIND_IN_SET('".intval($topic)."',t.TopicArr) ) or ( t.SubjectID='".intval($subject)."' and t.TopicArr='' and t.classArr='' ) or(  t.SubjectID='".intval($subject)."' and t.TopicArr='') ) ";
				}
        if(intval($sex)>0){
            $query.=" and FIND_IN_SET('".intval($sex)."',t.TeacherSex)";
        }
        if(intval($type)>0){
            $query.=" and FIND_IN_SET('".intval($type)."',t.LearnType)";
        }
        $query.=" order by t.ClassID desc";

        $db_qr = $this->db->query($query);
        $tg1=0;
        if($db_qr->num_rows() > 0)
        {

                $tg1=$db_qr->num_rows();

        }
        return $tg1;
    }
    function GetListClassbyUserOnline()
    {
        $query="select * from teacherclass as t where t.ClassTitle <> '' and t.`Active`=1 and t.UserID in (SELECT UserId FROM tokens as tk where tk.ExpiresOn > NOW())";
        $query.=" order by t.ClassID desc";
        $query.=" limit 0,20";
         $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function SearchClassbyUserOnline($key,$city)
    {
        $query="select * from teacherclass as t where t.ClassTitle <> '' and t.`Active`=1 and t.UserID in (SELECT UserId FROM tokens as tk where tk.ExpiresOn > NOW())";
        if(!empty($key)){
            $query.=" and t.ClassTitle like '%".str_replace(' ','%',$key)."%'";

        }
        if(intval($city)>0){
           $query.=" and t.City='".intval($city)."'";
        }
        $query.=" order by t.ClassID desc";
        $query.=" limit 0,20";
         $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function GetListTeacher($number)
    {
        $query="select ut.*,u.`Name`
                ,u.UserName
                ,u.Phone
                ,u.Email
                ,u.CityID
                ,u.CityName
                ,u.Address
                ,u.Description
                ,u.UserType
                ,u.CreateDate
                ,u.CreateBy
                ,u.Image
                ,u.Latitude
                ,u.Longitude
								,u.Active
                 from users as u JOIN userteacher as ut on u.UserID=ut.UserID
								 where u.`Delete`=0 and u.Email <>'' and u.Active=1 and u.IsSearch=1 and u.UserID in ( select DISTINCT UserID from usersubject where SubjectID in(1,2,3,4,5,6,7,8,10,11,12,13,14,15,16))
                ORDER BY u.CreateDate desc LIMIT 0,".$number;
                $db_qr = $this->db->query($query);
        // Lionel 1
        $tg1=array();
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function GetTeacherOnline($number)
    {
        $query="select ut.*,u.`Name`
                ,u.UserName
                ,u.Phone
                ,u.Email
                ,u.CityID
                ,u.CityName
                ,u.Address
                ,u.Description
                ,u.UserType
                ,u.CreateDate
                ,u.CreateBy
                ,u.Image
                ,u.Latitude
                ,u.Longitude
                 from users as u JOIN userteacher as ut on u.UserID=ut.UserID
                where  u.Email <>'' and ut.UserID in (SELECT UserId FROM tokens as tk where tk.ExpiresOn > NOW()) limit 0, ".$number;
        $db_qr = $this->db->query($query);
        $tg1= array();
        // Lionel 14
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function GetTeacherOnlinebySearch($city,$tag)
    {
        $query="select ut.*,u.`Name`
                ,u.UserName
                ,u.Phone
                ,u.Email
                ,u.CityID
                ,u.CityName
                ,u.Address
                ,u.Description
                ,u.UserType
                ,u.CreateDate
                ,u.CreateBy
                ,u.Image
                ,u.Latitude
                ,u.Longitude
                 from users as u JOIN userteacher as ut on u.UserID=ut.UserID
                where u.Email <>'' and ut.UserID in (SELECT UserId FROM tokens as tk where tk.ExpiresOn > NOW())";

        if(!empty($tag)){
            $query.="  and (ut.TitleView like '%".str_replace(' ','%',$tag)."%' or u.`Name` like '%".str_replace(' ','%',$tag)."%')";
        }
        if(intval($city)>0){
            $query.=" and u.CityID='".intval($city)."'";
        }
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
		function GetTeacherFeature()
    {
        $query="select ut.*,u.`Name`
                ,u.UserName
                ,u.Phone
                ,u.Email
                ,u.CityID
                ,u.CityName
                ,u.Address
                ,u.Description
                ,u.UserType
                ,u.CreateDate
                ,u.CreateBy
                ,u.Image
                ,u.Latitude
                ,u.Longitude
								,u.IsSearch
								from users as u JOIN userteacher as ut on u.UserID=ut.UserID where u.IsSearch=1 and u.Active=1 and u.Email <>''
                ORDER BY ut.Free DESC
                limit 0, 7";
        $db_qr = $this->db->query($query);
        $tg1= array();
        // Lionel 13
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function GetTeacherMore($id)
    {
        $query="select ut.*,u.`Name`
                ,u.UserName
                ,u.Phone
                ,u.Email
                ,u.CityID
                ,u.CityName
                ,u.Address
                ,u.Description
                ,u.UserType
                ,u.CreateDate
                ,u.CreateBy
                ,u.Image
                ,u.Latitude
                ,u.Longitude

                from users as u JOIN userteacher as ut on u.UserID=ut.UserID where u.Active=1 and u.Email <>'' and ut.UserID <>'".intval($id)."'
                ORDER BY ut.Free DESC
                limit 0, 5";
        $db_qr = $this->db->query($query);
        $tg1=array();
        // Lionel 15
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
		function GetListTeacherBySearch($keywork,$subject,$topic,$place,$type,$sex,$order,$page,$perpage)
    {
        $query="select ut.*,u.`Name`
        ,u.UserName
        ,u.Phone
        ,u.Email
        ,u.CityID
        ,u.CityName
        ,u.Address
        ,u.Description
        ,u.UserType
        ,u.CreateDate
        ,u.CreateBy
        ,u.Image
        ,u.Latitude
        ,u.Longitude
				,u.IsSearch
         from users as u JOIN userteacher as ut on u.UserID=ut.UserID
        where u.Email <>'' and u.`Delete`=0 and u.Active=1 and u.IsSearch=1";
        if(!empty($keywork) && strtolower($keywork)!='all'){
            $query.=" and (ut.TitleView like '%".str_replace(' ','%',$keywork)."%' or u.`Name` like '%".str_replace(' ','%',$keywork)."%')";
        }
        if(intval($place) > 0){
            $query.=" and u.CityID='".intval($place)."'";
        }
        if(intval($type) > 0){
            $query.=" and ut.WorkID='".intval($type)."'";
        }
        if(intval($sex)>0){
            $query.=" and u.sex ='".intval($sex)."'";
        }
				if(intval($subject)>0){
						if(intval($topic)==0){
							$query.=" and u.UserID in ( select DISTINCT UserID from usersubject where SubjectID =".intval($subject).") ";
						}else{
							$query.=" and u.UserID in ( select DISTINCT UserID from usersubject where ( SubjectID =".intval($subject)." and TopicID=".intval($topic)." ) ";
							$listclass=$this->getclassbytopic($topic);
							if(!empty($listclass)){
								$query.="OR ( SubjectID=".intval($subject)." and idClass2 in (".$listclass.") ) ";
							}
							$query.=")";
						}
        }
        if(strtolower($order)=='last'){
            $query.=" ORDER BY u.CreateDate desc";
        }else if(strtolower($order)=='pricelow'){
            $query.=" ORDER BY ut.Free asc";
        }else if(strtolower($order)=='pricehigh'){
            $query.=" ORDER BY ut.Free desc";
        }
        //var_dump($query);die();
        $total=$this->db->query($query)->num_rows();
        $query.=" LIMIT ".$page.",".$perpage;
        $db_qr = $this->db->query($query);
        $tg1= array();
        // Lionel 12
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return array('total'=>$total,'data'=>$tg1);
    }
    function CountTeacherbyCity()
    {
        $query="select c1.cit_id,c1.cit_name,IFNULL(c2.sogiaovien,0) as tongsogiaovien from city as c1 left JOIN (select c.cit_id,c.cit_name,COUNT(u.CityID)as sogiaovien from city as c left JOIN users as u on c.cit_id=u.CityID
where u.UserType=1
GROUP BY c.cit_id) c2 on c1.cit_id=c2.cit_id
group by c1.cit_id";
$db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function GetListTeacherTLH($number){
        $query="select ut.*,u.`Name`
,u.UserName
,u.Phone
,u.Email
,u.CityID
,u.CityName
,u.Address
,u.Description
,u.UserType
,u.CreateDate
,u.CreateBy
,u.Image
,u.Latitude
,u.Longitude

 from users as u JOIN userteacher as ut on u.UserID=ut.UserID
where u.Email <>'' and u.`Delete`=0 and u.Active=1 and u.UserType=1 and u.UserID in ( select DISTINCT UserID from usersubject where SubjectID in(1,2,3))
ORDER BY u.CreateDate desc LIMIT 0,".$number;
$db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function GetListTeacherVSD($number){
        $query="select ut.*,u.`Name`
        ,u.UserName
        ,u.Phone
        ,u.Email
        ,u.CityID
        ,u.CityName
        ,u.Address
        ,u.Description
        ,u.UserType
        ,u.CreateDate
        ,u.CreateBy
        ,u.Image
        ,u.Latitude
        ,u.Longitude
         from users as u JOIN userteacher as ut on u.UserID=ut.UserID
        where u.Email <>'' and u.`Delete`=0 and u.Active=1 and u.UserType=1 and u.UserID in ( select DISTINCT UserID from usersubject where SubjectID in(1,2,3))
        ORDER BY u.CreateDate desc LIMIT 0,".$number;
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function GetFirstUserTeacher($userid)
    {
        $query="select ut.*,u.`Name`
,u.UserName
,u.Phone
,u.Email
,u.CityID
,u.CityName
,u.Address
,u.Description
,u.UserType,IFNULL(t.solopdaday,0) as solopday
 from userteacher as ut left JOIN users as u on ut.UserID=u.UserID
																left join (select UserID,COUNT(ClassID)as solopdaday from uservsclass where Active=1) as t on t.UserID=ut.UserID
where u.Active=1 and u.`Delete`=0 and u.UserID='".$userid."'";
       $db_qr = $this->db->query($query);
       $tg1="";
        if($db_qr->num_rows() > 0)
        {

                $tg1=$db_qr->row();

        }
        return $tg1;
    }
    function GetFirstClass($id)
    {
        $query="select tc.*,t.denghiday,t.dongyday,tm.MetaTitle,tm.MetaDesc,tm.MetaKeywork
                ,u.`Name`
                ,u.Phone as Phoneu
                ,u.Email
                ,u.CityID
                ,u.CityName
                ,u.Address as Addressu
                ,u.Description
                ,u.UserType
                ,u.Image
 from teacherclass as tc left JOIN (select ClassID,
        SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
        SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
         from uservsclass as uc
        GROUP BY ClassID) t on tc.ClassID=t.ClassID
				LEFT JOIN teacherclassmeta as tm on tc.ClassID=tm.ClassID left join users as u on tc.UserID=u.UserID
where tc.ClassID='".$id."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            $tg1=$db_qr->row();
        }
        return $tg1;
    }
    function GetFirstClassByUserClassID($id,$userid)
    {
        $query="select t.*,t1.MetaDesc,
t1.MetaTitle,
t1.MetaKeywork,
t1.Latitude,
t1.Longitude
 from teacherclass as t LEFT JOIN teacherclassmeta as t1 on t1.ClassID=t.ClassID where t.UserID='".$userid."' and t.ClassID='".$id."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            $tg1=$db_qr->row();
        }
        return $tg1;
    }
    function GetFirstTeacher($id)
    {
        $query="select ut.*,u.`Name`
                ,u.Phone as phoneu
                ,u.Email
                ,u.CityID
                ,u.CityName
                ,u.Address as Addressu
                ,u.Description
                ,u.CreateDate
                ,u.Image
                ,u.Latitude
                ,u.Longitude
                ,u.Sex,u.Exp,u.Bonus,u.Birth
                from userteacher as ut LEFT JOIN users as u on ut.UserID=u.UserID
                where  u.Active=1 and ut.UserID='".intval($id)."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            $tg1=$db_qr->row();
        }
        return $tg1;
    }
    function GetTopicbyUserID($id)
    {
        $query="select u.TopicID,u.TopicName,u.UserID from usersubject as u WHERE u.UserID='".$id."'";
        $db_qr = $this->db->query($query);
        $tg1=array();
        // Lionel 16
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
		function GetListClassRelative($idclass,$idSubject){
        $query="select tc.*,u.`Name`
                ,u.Phone as Phoneu
                ,u.Email
                ,u.CityID
                ,u.CityName
                ,u.Address as Addressu
                ,u.Description
                ,u.UserType
                ,u.Image
								,u.Active
                from teacherclass as tc left join users as u on tc.UserID=u.UserID
                where tc.`Active`=1 and tc.SubjectID='".intval($idSubject)."' and u.Active=1 and tc.ClassID <>'".$idclass."' order by tc.ClassID desc limit 0,12";
                $db_qr = $this->db->query($query);
        $tg1= array();
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
		function GetTopClassByMoney($number)
    {
        $query="select t.*,u.`Name`,u.Phone as sodienthoaidk
        ,u.Email
        ,u.CityID
        ,u.CityName,u.`Image`
        ,u.Address as diachidk
        ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
         from teacherclass as t left join users as u on t.UserID=u.UserID
        	left JOIN (select ClassID,
        SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
        SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
         from uservsclass as uc
        GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
        $query.=" where t.ClassTitle <>'' and t.`Active`=1 and u.Active=1 order by t.UpdateDate desc limit 0,".$number;

         $db_qr = $this->db->query($query);
        $tg1= array();
        // Lionel 2
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }

		function AllGetTopClassByMoney($number)
    {
        $query="select t.*,u.`Name`,u.Phone as sodienthoaidk
				,u.Active
        ,u.Email
        ,u.CityID
        ,u.CityName,u.`Image`
        ,u.Address as diachidk
        ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
         from teacherclass as t left join users as u on t.UserID=u.UserID
        	left JOIN (select ClassID,
        SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
        SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
         from uservsclass as uc
        GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
        $query.=" where t.ClassTitle <>'' and 1=1 and t.`Active`=1 and u.Active=1 order by t.Money desc limit 0,".$number;
         $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
		function GetClassTop($number)
    {
        $query="select t.*,u.`Name`,u.Phone as sodienthoaidk
        ,u.Email
        ,u.CityID
        ,u.CityName,u.`Image`
        ,u.Address as diachidk
				,u.Active
        ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
         from teacherclass as t left join users as u on t.UserID=u.UserID
        	left JOIN (select ClassID,
        SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
        SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
         from uservsclass as uc
        GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
        $query.=" where t.ClassTitle <>'' and 1=1 and t.`Active`=1 and u.Active=1 order by t.UpdateDate, t.ClassID desc limit 0,".$number;
         $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function CountClassByCity()
    {
        $query="select c1.cit_id,c1.cit_name,IFNULL(t1.sobaiviet,0) as tongsobai from city as c1 left join (select c.cit_id,c.cit_name,COUNT(t.ClassID) as sobaiviet
	from city as c left JOIN teacherclass as t on c.cit_id=t.City
where t.ClassID not in(select DISTINCT u.ClassID  from uservsclass as u where u.Active=1)
GROUP BY c.cit_id) as t1 on c1.cit_id=t1.cit_id	";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function GetTeacherType()
    {
        $query="select ID,NameType from teachtype as t order by ID asc";
        $db_qr = $this->db->query($query);
        $tg1 = array();
        // Lionel 4
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function Danhsachloptheomonhoc()
    {
        $query="select s2.ID,s2.SubjectName,IFNULL(s1.sobanghi,0) as tongbanghi from `subject` as s2 left JOIN(select s.ID,s.SubjectName,COUNT(t.SubjectID) as sobanghi from `subject` as s left JOIN teacherclass as t on s.ID=t.SubjectID
        where t.ClassID not in (select u.ClassID from uservsclass as u where u.Active=1)
        group by s.ID) as s1 on s1.ID=s2.ID";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function ListSubject()
    {
        $query="select * from subject";
       $db_qr = $this->db->query($query);
       $tg1= array();
        // Lionel 3
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function ListSubjectByKey($key)
    {
        $query="select * from `subject` where SubjectName like '%".$key."%'";
       $db_qr = $this->db->query($query);
       $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function ListTopic()
    {
        $query="select * from topic";
       $db_qr = $this->db->query($query);
       $tg1="";
        if($db_qr->num_rows() > 0)
        {

            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }

        }
        return $tg1;
    }
    function ListTopicBySubject($idsub)
    {
        $query="select * from topic where SubjectID='".intval($idsub)."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {

                foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }

        }
        return $tg1;
    }
    function Listtopicbysubjectandidtopic($idsub,$idtopic){
        $query="select * from topic where SubjectID='".intval($idsub)."' and FIND_IN_SET(id,'".$idtopic."')";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {

                foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }

        }
        return $tg1;
    }
    function GetSubjectByID($idsubject)
    {
        $query="select * from subject where ID='".intval($idsubject)."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            $tg1=$db_qr->row();
        }
        return $tg1;
    }
    function InsertUser($Name,$username,$Phone,$Email,$CityID,$CityName,$Address,$Description,$UserType,$Password,$CreateBy,$Image,$Latitude,$Longitude,$Sex,$Exp,$Bonus,$Birth)
    {
        $queryket="select * from users where UserName='".$username."'";
        $db_qr = $this->db->query($queryket);
        if($db_qr->num_rows() > 0)
        {
            return array('userid'=>0,'code'=>'');
        }else{
            $IP=getUserIP();
        $countuser=$this->countuserbyip($IP);
        if($countuser <=10){
        $CreateDate=date("Y-m-d H:i:s",time());
        $query="Insert into users(`Name`,UserName,Phone,Email,CityID,CityName,Address,Description,UserType,`Password`,CreateDate,CreateBy,Image,Active,`Delete`,Latitude,Longitude,Sex,Exp,Bonus,Birth,Accounttype,IP)";
        $query.="values('".$Name."','".trim($username)."','".trim($Phone)."','".$Email."','".$CityID."','".$CityName."','".$Address."','".$Description."','".$UserType."','".md5($Password)."','".$CreateDate."','".$CreateBy."','".$Image."','0','0','".$Latitude."','".$Longitude."','".intval($Sex)."','".$Exp."','".$Bonus."','".$Birth."','".$UserType."','".$IP."')";
        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id();
        $code=rand(100000,999999);
        $body=file_get_contents(base_url().'EmailTemplate/XacThucEmail.htm');
        $body=str_replace('<%name%>',$name,$body);
        $body=str_replace('<%email%>',$username,$body);
        $body=str_replace('<%code%>',$code,$body);
        $Description="Đăng ký tài khoản";
        $queryconfrim="INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate,IP)
                                                   VALUES('".$insertid."','".$code."','1','0','".$body."','".$Description."','".$CreateDate."','".$CreateDate."','".$IP."')";
        $insert=$this->db->query($queryconfrim);
        //$arrphone=['phone_number'=>"'$username'",'name'=>"'$Name'"];
//        $message=buildsendautocall($arrphone,$code);//formatsmsmessage(2,$code);
//        $Statuscode=1;
        //$resultautocall=buildsendautocall($arrphone,$code);
        date_default_timezone_set("Asia/Bangkok");
        $gio= date("H",time());
        $iscall=0;
        if(intval($gio) >7 && $gio < 22 ){
            $message=formatsmsmessage(2,$code);
            $Statuscode=sendsms($username,$message);
        }else{
            $arrp=['VTT','VMS','VNP'];
            $re=gettelcofromphonenumber($username);
            if(in_array($re, $arrp)){
                $arrphone=['phone_number'=>"'$username'",'name'=>"'$Name'"];
                $message=buildsendautocall($arrphone,$code);
                $Statuscode=1;
                //$k1=$this->updatecomfirmiscall($insertid,$code);
                $iscall=1;
            }
        }
        $smslog=$this->InsertLogSms($code,$Statuscode,'1',$iscall);
    	$subject='[giasu365] Kích hoạt tài khoản đăng ký';
        $body = base64_encode($body);
        //$this->CreateSendMail($Email,$Email,"","",$subject,$body);
        $result=['kq'=>true,'data'=>$insertid,'code'=>$code];
        return $result;
        }else{
            $result=['kq'=>false,'check'=>true,'data'=>'Vượt quá số lần đăng ký'];
            return $result;
        }
        }
    }
    function InsertUserSMS($Name,$username,$Phone,$Email,$CityID,$CityName,$Address,$Description,$UserType,$Password,$CreateBy,$Image,$Latitude,$Longitude,$Sex,$Exp,$Bonus,$Birth,$sms)
    {
        $queryket="select * from users where UserName='".$username."'";
        $db_qr = $this->db->query($queryket);
        if($db_qr->num_rows() > 0)
        {
            return array('userid'=>0,'code'=>'');
        }else{
        $CreateDate=date("Y-m-d H:i:s",time());
        $query="Insert into users(`Name`,UserName,Phone,Email,CityID,CityName,Address,Description,UserType,`Password`,CreateDate,CreateBy,Image,Active,`Delete`,Latitude,Longitude,Sex,Exp,Bonus,Birth,Accounttype,SendNotify)";
        $query.="values('".$Name."','".trim($username)."','".trim($Phone)."','".$Email."','".$CityID."','".$CityName."','".$Address."','".$Description."','".$UserType."','".md5($Password)."','".$CreateDate."','".$CreateBy."','".$Image."','0','0','".$Latitude."','".$Longitude."','".intval($Sex)."','".$Exp."','".$Bonus."','".$Birth."','".$UserType."','".$sms."')";
        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id();
        $code=rand(100000,999999);
        $body=file_get_contents(base_url().'EmailTemplate/XacThucEmail.htm');
        $body=str_replace('<%name%>',$name,$body);
        $body=str_replace('<%email%>',$username,$body);
        $body=str_replace('<%code%>',$code,$body);
        $Description="Đăng ký tài khoản";
        $queryconfrim="INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate)
                                                   VALUES('".$insertid."','".$code."','1','0','".$body."','".$Description."','".$CreateDate."','".$CreateDate."')";
        $insert=$this->db->query($queryconfrim);
        $arrp=['VTT','VMS','VNP'];
        $re=gettelcofromphonenumber($username);
        $iscall=0;
        if(in_array($re, $arrp)){
            $arrphone=['phone_number'=>"'$username'",'name'=>"'$Name'"];
            $message=buildsendautocall($arrphone,$code);
            $Statuscode=1;
            $iscall=1;
            //$k1=$this->updatecomfirmiscall($insertid,$code);
        }else{
            // date_default_timezone_set("Asia/Bangkok");
            // $gio= date("H",time());
            // if(intval($gio) >7 && $gio < 22 ){
                $message=formatsmsmessage(2,$code);
                $Statuscode=sendsms($username,$message);
            // }
        }
        $smslog=$this->InsertLogSms($code,$Statuscode,'1',$iscall);
    	$subject='[giasu365] Kích hoạt tài khoản đăng ký';
        $body = base64_encode($body);
        //$this->CreateSendMail($Email,$Email,"","",$subject,$body);
        $result=['kq'=>true,'data'=>$insertid,'code'=>$code];
        return $result;
        }
    }
    function updateuserssendsms($userid,$sms)
    {
        $queryket="select * from users where UserID='".$userid."'";
        $db_qr = $this->db->query($queryket);
        $result=['kq'=>false,'data'=>0];
        if($db_qr->num_rows() > 0)
        {
            $query="UPDATE users set SendNotify='".intval($sms)."' where UserID='".$userid."'";
            $update=$this->db->query($query);
                $result=['kq'=>true,'data'=>0];
        }
        return $result;
    }
    function UpdateUsers($userid,$Name,$CityID,$CityName,$Address,$Description,$Image,$Sex,$Exp,$Bonus,$Birth)
    {
        $queryket="select * from users where UserID='".$userid."'";
        $db_qr = $this->db->query($queryket);
        $result=['kq'=>false,'data'=>0];
        $date = date("Y-m-d H:i:s");
        $CreateDate=date("Y-m-d H:i:s",time());
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            if(empty($Image)){
                $Image=$tg->Image;
            }
            if((!empty($tg->UpdateDate) && (strtotime($tg->UpdateDate . "+5 minutes") < time()))||(empty($tg->UpdateDate))){
                $query="UPDATE users set `Name`='".$Name."',CityID='".$CityID."',CityName='".$CityName."',Address='".$Address."',Description='".$Description."'
                        ,Image='".$Image."',Sex='".intval($Sex)."',Exp='".$Exp."',Bonus='".$Bonus."',Birth='".$Birth."',UpdateDate='".$CreateDate."' where UserID='".$userid."'";
                $update=$this->db->query($query);
                $result=['kq'=>true,'data'=>0];
                return $result;
            }else{
                return $result;
            }
        }
    }
    function UpdateUsers2($userid,$Name,$CityID,$CityName,$Address,$Description,$Image,$Sex,$Exp,$Bonus,$Birth,$email)
    {
        $queryket="select * from users where UserID='".$userid."'";
        $db_qr = $this->db->query($queryket);
        $result=['kq'=>false,'data'=>''];
        $date = date("Y-m-d H:i:s");
        $CreateDate=date("Y-m-d H:i:s",time());
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            if($email==$tg->Email){
                //$result=['kq'=>false,'data'=>'email đã tồn tại'];
                $email==$tg->Email;
                //return $result;
            }
            if(empty($Image)){
                $Image=$tg->Image;
            }
            $query="UPDATE users set `Name`='".$Name."',Email='".$email."',CityID='".$CityID."',CityName='".$CityName."',Address='".$Address."',Description='".$Description."'
                        ,Image='".$Image."',Sex='".intval($Sex)."',Exp='".$Exp."',Bonus='".$Bonus."',Birth='".$Birth."',UpdateDate='".$CreateDate."' where UserID='".$userid."'";
            $update=$this->db->query($query);
            $result=['kq'=>true,'data'=>''];
            return $result;
        }
    }
		function InsertTeacherTopic($SubjectID,$SubjectName,$TopicID,$TopicName,$UserID,$idClass,$idClass2=0)
    {
        $CreateDate=date("Y-m-d H:i:s",time());
        $result=['kq'=>false,'data'=>''];
        $query="Insert into usersubject(SubjectID,idClass,SubjectName,TopicID,TopicName,UserID,CreateDate,idClass2)
                VALUES('".$SubjectID."','".$idClass."','".$SubjectName."','".$TopicID."','".$TopicName."','".$UserID."','".$CreateDate."','".$idClass2."')";
            $insert=$this->db->query($query);

        return $insert;
    }
    function DeleteTeacherTopic($UserID)
    {

        $query="delete from usersubject where UserID='".$UserID."'";
            $insert=$this->db->query($query);
        return $insert;
    }
    function GetUserByUserID($userid)
    {
        $query1="select * from users where UserID='".$userid."'";
        $db_qr = $this->db->query($query1);
        $tg="";
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
        }
            return $tg;
    }
    function UpdateTeacher($UserID,$WorkID,$WorkingName,$TeachType,$Free,$MonMorning,$MonAfter,$MonNight,$TueMorning,$TueAfter,$TueNight,
                    $WeMorning,$WeAfter,$WeNight,$ThuMorning,$ThuAfter,$ThuNight,$FriMorning,$FriAfter,$FriNight,$SatMorning,$SatAfter
                    ,$SatNight,$SunMorning,$SunAfter,$SunNight,$ImgPassport,$TitleView,$Orther,$School,$Major,$Graduationyear,$Workplace)
    {
        $result=['kq'=>false,'data'=>''];
        $query1="select * from userteacher where UserID='".$UserID."'";
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            if(empty($ImgPassport)){
                $ImgPassport=$tg->ImgPassport;
            }
            $CreateDate=date("Y-m-d H:i:s",time());
            $query="UPDATE userteacher set WorkID='".$WorkID."',WorkingName='".$WorkingName."',TeachType='".$TeachType."',Free='".$Free."'
                    ,MonMorning='".$MonMorning."',MonAfter='".$MonAfter."',MonNight='".$MonNight."',TueMorning='".$TueMorning."',TueAfter='".$TueAfter."'
                    ,TueNight='".$TueNight."',WeMorning='".$WeMorning."',WeAfter='".$WeAfter."',WeNight='".$WeNight."',ThuMorning='".$ThuMorning."',ThuAfter='".$ThuAfter."'
                    ,ThuNight='".$ThuNight."',FriMorning='".$FriMorning."',FriAfter='".$FriAfter."',FriNight='".$FriNight."',SatMorning='".$SatMorning."'
                    ,SatAfter='".$SatAfter."' ,SatNight='".$SatNight."',SunMorning='".$SunMorning."',SunAfter='".$SunAfter."',SunNight='".$SunNight."'
                    ,ImgPassport='".$ImgPassport."',TitleView='".$TitleView."',UpdateDate='".$CreateDate."'
                    ,Orther='".$Orther."',School='".$School."',Major='".$Major."',Graduationyear='".$Graduationyear."',Workplace='".$Workplace."',idClass='".$idClassArr."' where ID='".$tg->ID."'";
                    $insert=$this->db->query($query);
                    $result=['kq'=>true];
        }else{
            $CreateDate=date("Y-m-d H:i:s",time());
            $query="Insert into userteacher(UserID,WorkID,WorkingName,TeachType,Free,MonMorning,MonAfter,MonNight,TueMorning,TueAfter,TueNight,
    WeMorning,WeAfter,WeNight,ThuMorning,ThuAfter,ThuNight,FriMorning,FriAfter,FriNight,SatMorning,SatAfter,SatNight,SunMorning,SunAfter,SunNight,
    ImgEdu,ImgPassport,Vip,TitleView,UpdateDate,Orther,School,Major,Graduationyear,Workplace,idClass)VALUES('".$UserID."','".$WorkID."','".$WorkingName."',
                '".$TeachType."','".$Free."','".$MonMorning."','".$MonAfter."','".$MonNight."','".$TueMorning."','".$TueAfter."','".$TueNight."',
                '".$WeMorning."','".$WeAfter."','".$WeNight."','".$ThuMorning."','".$ThuAfter."','".$ThuNight."','".$FriMorning."','".$FriAfter."','".$FriNight."',
                '".$SatMorning."','".$SatAfter."','".$SatNight."','".$SunMorning."','".$SunAfter."','".$SunNight."','','".$ImgPassport."'
                ,'0','".$TitleView."','".$CreateDate."','".$Orther."','".$School."','".$Major."','".$Graduationyear."','".$Workplace."','".$idClassArr."')";
                $insert=$this->db->query($query);
            $insertid=$this->db->insert_id();
            if($insertid > 0){
               $result=['kq'=>true,'data'=>$insertid];
            }
        }

        return $result;
    }
    function InsertTeacher($UserID,$WorkID,$WorkingName,$TeachType,$Free,$MonMorning,$MonAfter,$MonNight,$TueMorning,$TueAfter,$TueNight,
                    $WeMorning,$WeAfter,$WeNight,$ThuMorning,$ThuAfter,$ThuNight,$FriMorning,$FriAfter,$FriNight,$SatMorning,$SatAfter
                    ,$SatNight,$SunMorning,$SunAfter,$SunNight,$ImgEdu,$ImgPassport,$Vip,$TitleView,$Orther,$School,$Major,$Graduationyear,$Workplace)
    {
        $result=['kq'=>false,'data'=>''];
        $CreateDate=date("Y-m-d H:i:s",time());
        $query="Insert into userteacher(UserID,WorkID,WorkingName,TeachType,Free,MonMorning,MonAfter,MonNight,TueMorning,TueAfter,TueNight,
WeMorning,WeAfter,WeNight,ThuMorning,ThuAfter,ThuNight,FriMorning,FriAfter,FriNight,SatMorning,SatAfter,SatNight,SunMorning,SunAfter,SunNight,
ImgEdu,ImgPassport,Vip,TitleView,UpdateDate,Orther,School,Major,Graduationyear,Workplace)VALUES('".$UserID."','".$WorkID."','".$WorkingName."',
            '".$TeachType."','".$Free."','".$MonMorning."','".$MonAfter."','".$MonNight."','".$TueMorning."','".$TueAfter."','".$TueNight."',
            '".$WeMorning."','".$WeAfter."','".$WeNight."','".$ThuMorning."','".$ThuAfter."','".$ThuNight."','".$FriMorning."','".$FriAfter."','".$FriNight."',
            '".$SatMorning."','".$SatAfter."','".$SatNight."','".$SunMorning."','".$SunAfter."','".$SunNight."','".$ImgEdu."','".$ImgPassport."'
            ,'".$Vip."','".$TitleView."','".$CreateDate."','".$Orther."','".$School."','".$Major."','".$Graduationyear."','".$Workplace."')";
            $insert=$this->db->query($query);
        $insertid=$this->db->insert_id();
        if($insertid > 0){
           $result=['kq'=>true,'data'=>$insertid];
        }
        return $result;
    }
		function UpdateClass($classid,$ClassTitle,$SubjectID,$SubjectName,$TopicArr,$Money,$Hours,$LearnType,$Phone,$City,$Address,$CMonMorning,$CMonAfter,$CMonNight
    ,$CTueMorning,$CTueAfter,$CTueNight,$CWeMorning,$CWeAfter,$CWeNight,$CThuMorning,$CThuAfter,$CThuNight,$CFriMorning,$CFriAfter,$CFriNight,$CSatMorning
    ,$CSatAfter,$CSatNight,$CSunMorning,$CSunAfter,$CSunNight,$DescClass,$InWeek,$Student,$TeacherSex,$ExpectedDate,$TeachType,$consult,$classarr,$facebook)
    {
        $CreateDate=date("Y-m-d H:i:s",time());
        $result=['kq'=>false,'data'=>0];
        $query="UPDATE teacherclass set ClassTitle='".$ClassTitle."',SubjectID='".$SubjectID."',SubjectName='".$SubjectName."',TopicArr='".$TopicArr."',Money='".$Money."',Hours='".$Hours."'
                ,LearnType='".$LearnType."',Phone='".$Phone."',City='".$City."',Address='".$Address."',CMonMorning='".$CMonMorning."',CMonAfter='".$CMonAfter."',
                CMonNight='".$CMonNight."',CTueMorning='".$CTueMorning."',CTueAfter='".$CTueAfter."',CTueNight='".$CTueNight."',CWeMorning='".$CWeMorning."',CWeAfter='".$CWeAfter."',
                CWeNight='".$CWeNight."',CThuMorning='".$CThuMorning."',CThuAfter='".$CThuAfter."',CThuNight='".$CThuNight."',CFriMorning='".$CFriMorning."',CFriAfter='".$CFriAfter."',CFriNight='".$CFriNight."',CSatMorning='".$CSatMorning."',
CSatAfter='".$CSatAfter."',CSatNight='".$CSatNight."',CSunMorning='".$CSunMorning."',CSunAfter='".$CSunAfter."',CSunNight='".$CSunNight."',UpdateDate='".$CreateDate."',DescClass='".$DescClass."',InWeek='".$InWeek."',Student='".$Student."',TeacherSex='".$TeacherSex."',
TeachType='".$TeachType."',consult='".$consult."',classArr='".$classarr."',Facebook='".$facebook."' Where ClassID='".$classid."'";
        $insert=$this->db->query($query);

        if($insert){
           $result=['kq'=>true,'data'=>$insertid];
        }
        return $result;
    }
    function refreshclass($userid)
    {
        $queryket="select * from users where UserID='".$userid."'";
        $db_qr = $this->db->query($queryket);
        $result=['kq'=>false,'data'=>0];
        $date = date("Y-m-d H:i:s");
        $CreateDate=date("Y-m-d H:i:s",time());
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();

            if((!empty($tg->UpdateDate) && (strtotime($tg->UpdateDate . "+1440 minutes") < time()))||(empty($tg->UpdateDate))){
                $query="UPDATE users set UpdateDate='".$CreateDate."' where UserID='".$userid."'";
                $update=$this->db->query($query);
                $result=['kq'=>true,'data'=>0];
                return $result;
            }else{
                return $result;
            }
        }
    }
		function InsertClass($ClassTitle,$SubjectID,$SubjectName,$TopicArr,$Money,$Hours,$LearnType,$Phone,$City,$Address,$CMonMorning,$CMonAfter,$CMonNight
    ,$CTueMorning,$CTueAfter,$CTueNight,$CWeMorning,$CWeAfter,$CWeNight,$CThuMorning,$CThuAfter,$CThuNight,$CFriMorning,$CFriAfter,$CFriNight,$CSatMorning
    ,$CSatAfter,$CSatNight,$CSunMorning,$CSunAfter,$CSunNight,$CreateBy,$DescClass,$InWeek,$Student,$TeacherSex,$ExpectedDate,$UserID,$TeachType,$consult,$classarr,$facebook)
    {
        $CreateDate=date("Y-m-d H:i:s",time());
        $result=['kq'=>false,'data'=>0];
        $query="insert into teacherclass(ClassTitle,SubjectID,SubjectName,TopicArr,Money,Hours,LearnType,Phone,City,Address,CMonMorning,CMonAfter,
CMonNight,CTueMorning,CTueAfter,CTueNight,CWeMorning,CWeAfter,CWeNight,CThuMorning,CThuAfter,CThuNight,CFriMorning,CFriAfter,CFriNight,CSatMorning,
CSatAfter,CSatNight,CSunMorning,CSunAfter,CSunNight,Active,Hot,Vip,CreateDate,UpdateDate,CreateBy,DescClass,InWeek,Student,TeacherSex,ExpectedDate,UserID,
TeachType,consult,classArr,Facebook)VALUES('".$ClassTitle."','".$SubjectID."','".$SubjectName."','".$TopicArr."','".$Money."','".$Hours."','".$LearnType."'
                    ,'".$Phone."','".$City."','".$Address."','".$CMonMorning."','".$CMonAfter."','".$CMonNight."','".$CTueMorning."'
                    ,'".$CTueAfter."','".$CTueNight."','".$CWeMorning."','".$CWeAfter."','".$CWeNight."','".$CThuMorning."','".$CThuAfter."','".$CThuNight."'
                    ,'".$CFriMorning."','".$CFriAfter."','".$CFriNight."','".$CSatMorning."','".$CSatAfter."','".$CSatNight."','".$CSunMorning."','".$CSunAfter."'
                    ,'".$CSunNight."','1','0','0','".$CreateDate."','".$CreateDate."','".$CreateBy."','".$DescClass."','".$InWeek."','".$Student."','".$TeacherSex."'
                    ,'".$CreateDate."','".$UserID."','".$TeachType."','".$consult."','".$classarr."','".$facebook."')";
        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id();
        if($insertid > 0){
           $result=['kq'=>true,'data'=>$insertid];
        }
        return $result;
    }
    function InsertClassMeta($ClassID,$MetaDesc,$MetaTitle,$MetaKeywork,$Latitude,$Longitude)
    {
        $result=['kq'=>false,'data'=>0];
        $query="insert into teacherclassmeta(ClassID,MetaDesc,MetaTitle,MetaKeywork,Latitude,Longitude)
                        VALUES('".$ClassID."','".$MetaDesc."','".$MetaTitle."','".$MetaKeywork."','".$Latitude."','".$Longitude."')";
        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id();
        if($insertid > 0){
           $result=['kq'=>true,'data'=>$insertid];
        }
        return $result;
    }
    function insertsendnotifymoney($UserID,$TransferType,$TransferBank,$CustomerName,$CustomerBN,$TransferDate,$ReceiveBank,$Amount,$Note)
    {
        $result=['kq'=>false,'data'=>0];
        $CreateDate=date("Y-m-d H:i:s",time());
        $query="insert into sendnotifymonney(UserID,TransferType,TransferBank,CustomerName,CustomerBN,TransferDate,ReceiveBank,Amount,CreateDate,Status,Note)
                        VALUES('".$UserID."','".$TransferType."','".$TransferBank."','".$CustomerName."','".$CustomerBN."','".$TransferDate."','".$ReceiveBank."','".floatval($Amount)."','".$CreateDate."','0','".$Note."')";
        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id();
        if($insertid > 0){
           $result=['kq'=>true,'data'=>''];
        }
        return $result;
    }
    function InsertLogSms($Code,$Statuscode,$Type,$iscall)
    {
        $result=['kq'=>false,'data'=>0];
        $CreateDate=date("Y-m-d H:i:s",time());
        $query="insert into smslog(Code,Statuscode,CreateDate,Type,IsCall)VALUES('".$Code."','".$Statuscode."','".$CreateDate."','".$Type."','".$iscall."')";
            $insert=$this->db->query($query);
            $insertid=$this->db->insert_id();
            if($insertid > 0){
               $result=['kq'=>true,'data'=>$insertid];
            }
        return $result;
    }
    function GetListdistrictbycity()
    {
        $query="select * from city2 where cit_parent <>0";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function GetBankUsed()
    {
        $query="select * from banktable where `Active` =1";
        $db_qr = $this->db->query($query);
        $tg1= array();
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function GetListBank()
    {
        $query="select * from banktable";
        $db_qr = $this->db->query($query);
        $tg1= array();
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function getbalace($userid)
    {
        $query="select * from balance where UserId='".$userid."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            $tg1=$db_qr->row();
        }
        return $tg1;
    }
    function getcountclassvsuser($userid)
    {
        //0 de nghi day,1 dang day,2 đã dừng,3 tạm nghỉ
        $query="select UserID,
                SUM(CASE WHEN c1.Active = 1 THEN 1 ELSE 0 END) as lopdaday,
                SUM(CASE WHEN c1.Active = 0 THEN 1 ELSE 0 END) as lopdenghiday
                from uservsclass as c1 where c1.UserID='".$userid."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            $tg1=$db_qr->row();
        }
        return $tg1;
    }
    function getcountclasssave($userid)
    {
        $query="select COUNT(ClassID) as solopdaluu,UserID from usersaveclass where UserID='".$userid."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            $tg1=$db_qr->row();
        }
        return $tg1;
    }
    function getcountclassinvite($user){
        $query="select COUNT(ClassID) as solopdamoi,UserID from classvsuser where UserID='".$user."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            $tg1=$db_qr->row();
        }
        //var_dump($tg1);die();
        return $tg1;
    }
    function adduservsclass($userid,$classid,$active){
        $result=['kq'=>false,'data'=>0];
        $CreateDate=date("Y-m-d H:i:s",time());
        $query1="select * from uservsclass where UserID ='".$userid."' and ClassID='".$classid."'";
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() <= 0)
        {
        $query="insert into uservsclass(UserID,ClassID,Active)VALUES('".$userid."','".$classid."','".$active."')";
            $insert=$this->db->query($query);
            $insertid=$this->db->insert_id();
            if($insertid > 0){
               $result=['kq'=>true,'data'=>$insertid];
            }
        }
        return $result;
    }
    function adduservsusers($userid,$saveuser,$active){
        $result=['kq'=>false,'data'=>0];
        $CreateDate=date("Y-m-d H:i:s",time());
        $query1="select * from usersaveuser where UserID ='".$userid."' and SaveUserID='".$saveuser."'";
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() <= 0)
        {
        $query="insert into usersaveuser(UserID,SaveUserID,Active,Createdate)VALUES('".$userid."','".$saveuser."','".$active."','".$CreateDate."')";
            $insert=$this->db->query($query);
            $insertid=$this->db->insert_id();
            if($insertid > 0){
               $result=['kq'=>true,'data'=>$insertid];
            }
        }
        return $result;
    }
    function addclassvsuser($userid,$classid,$active){
        $result=['kq'=>false,'data'=>0];
        $CreateDate=date("Y-m-d H:i:s",time());
        $query1="select * from classvsuser where UserID ='".$userid."' and ClassID='".$classid."'";
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() <= 0)
        {
        $query="insert into classvsuser(UserID,ClassID,CreateDate,Active)VALUES('".$userid."','".$classid."','".$CreateDate."','".$active."')";
            $insert=$this->db->query($query);
            $insertid=$this->db->insert_id();
            if($insertid > 0){
               $result=['kq'=>true,'data'=>$insertid];
            }
        }
        return $result;
    }
    function addlogpoint($UserID,$Type,$price,$CreateBy,$Trace)
    {
        $result=['kq'=>false,'data'=>0];
        $CreateDate=date("Y-m-d H:i:s",time());
        $query="select * from logpoint where UserID='".$UserID."' and Trace='".$Trace."' and Type=1 and CreateDate > '".date("Y-m-d",time())."'";
        //var_dump($query);die();
        $db_qr = $this->db->query($query);
        if($db_qr->num_rows() <= 0)
        {
            $point=$this->sumpointbyuserid($UserID);
            if($point!=""){
                if($point->point > (-1 * $price)){
                    $query="insert into logpoint(UserID,Type,Status,Price,CreateDate,UpdateDate,CreateBy,Trace)VALUES('".$UserID."','".$Type."','1','".$price."','".$CreateDate."','".$CreateDate."','1','".$Trace."')";
                    $insert=$this->db->query($query);
                    if($insert){
                        $result=['kq'=>true];
                    }
                }

            }else{
                if($Trace =='users_0'){
                    $query="insert into logpoint(UserID,Type,Status,Price,CreateDate,UpdateDate,CreateBy,Trace)VALUES('".$UserID."','".$Type."','1','".$price."','".$CreateDate."','".$CreateDate."','1','".$Trace."')";
                    $insert=$this->db->query($query);
                    if($insert){
                        $result=['kq'=>true];
                    }
                }
            }

        }
        return $result;
    }
    function getlogpoint($userid,$trace)
    {
        $query="select * from logpoint where UserID='".$userid."' and Trace='".$trace."' and Type=2 and CreateDate > '".date("Y-m-d",time())."'";
        $db_qr = $this->db->query($query);
        $tg1 = "";
        if($db_qr->num_rows() > 0)
        {
            //foreach($db_qr->result() as $itemcat)
            //{
                $tg1=1;
            //}
        }
        return $tg1;
    }
    function getpointconfig()
    {
        $query="SELECT * from configpoint";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            //foreach($db_qr->result() as $itemcat)
            //{
                $tg1=$db_qr->row();
            //}
        }
        return $tg1;
    }
    function addviewuserid($userid)
    {
        $query="select * from viewuser where UserID='".$userid."'";
        $db_qr = $this->db->query($query);
        $tg1=0;
        if($db_qr->num_rows() > 0)
        {
            $result=$db_qr->row();
            $query1="update viewuser set View=(View+ 1) where ID='".$result->ID."'";
            $insert=$this->db->query($query1);
            if($insert){
                $tg1=$result->View + 1;
                }

        }else{
            $query1="insert viewuser(UserID,View)values('".$userid."','1')";
            $insert=$this->db->query($query1);
            $tg1=1;
        }
        return $tg1;
    }
    function getviewuserid($userid)
    {
        $query="select * from viewuser where UserID='".$userid."'";
        $db_qr = $this->db->query($query);
        $tg1=0;
        if($db_qr->num_rows() > 0)
        {
            $result=$db_qr->row();
            $tg1=$result->View;
            }
            return $tg1;
    }
    function addviewclass($userid)
    {
        $query="select * from viewclass where ClassID='".$userid."'";
        $db_qr = $this->db->query($query);
        $tg1=0;
        if($db_qr->num_rows() > 0)
        {
            $result=$db_qr->row();
            $query1="update viewclass set View=(View+ 1) where ID='".$result->ID."'";
            $insert=$this->db->query($query1);
            if($insert){
                $tg1=$result->View + 1;
                }

        }else{
            $query1="insert viewclass(ClassID,View)values('".$userid."','1')";
            $insert=$this->db->query($query1);
            $tg1=1;
        }
        return $tg1;
    }
    function getviewclassid($userid)
    {
        $query="select * from viewclass where ClassID='".$userid."'";
        $db_qr = $this->db->query($query);
        $tg1=0;
        if($db_qr->num_rows() > 0)
        {
            $result=$db_qr->row();
            $tg1=$result->View;
            }
            return $tg1;
    }
		function countteacherfitclass($userid)
    {
        $query="SELECT COUNT(*) as sogiaovien from users where UserType=1 and active =1 and IsSearch=1 and UserID in(select DISTINCT UserID from usersubject as u where u.SubjectID in(select SubjectID from teacherclass as t where t.UserID='".$userid."' and t.ClassID not in (select u.ClassID from uservsclass as u where u.Active>0)))";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            //foreach($db_qr->result() as $itemcat)
            //{
                $tg1=$db_qr->row();
            //}
        }
        return $tg1;
    }
    function countteachersave($userid)
    {
        $query="select COUNT(*) as sogcluu from usersaveuser where UserID='".$userid."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            //foreach($db_qr->result() as $itemcat)
            //{
                $tg1=$db_qr->row();
            //}
        }
        return $tg1;
    }
		function countteacheinvite($userid)
    {
        $query="select COUNT(*) as giasumoiday from classvsuser as cl join users as u on cl.UserId = u.UserID where cl.ClassID in (select t.ClassID from teacherclass as t where t.UserID='".$userid."') and u.IsSearch =1 and u.active =1";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            //foreach($db_qr->result() as $itemcat)
            //{
                $tg1=$db_qr->row();
            //}
        }
        return $tg1;
    }
    function countclassnotteacherbyuserid($userid)
    {
        $query="select count(*) as solophoc from teacherclass as t where t.UserID='".$userid."' and t.ClassID not in (select u.ClassID from uservsclass as u where u.Active>0)";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            $itemcat=$db_qr->row();
                $tg1=$itemcat->solophoc;

        }
        return $tg1;
    }

		function getlistteachersavebyuserid($userid)
		{
				$query="select u.*,t.*,t1.CreateDate as ngaymoi from users as u JOIN userteacher as t on u.UserID=t.UserID
								join (select * from classvsuser where ClassID in (select ClassID from teacherclass where UserID='".$userid."')) as t1 on t1.UserID=u.UserID
								where u.active =1 and u.IsSearch =1
								order by ngaymoi desc limit 0,5";
				$db_qr = $this->db->query($query);
				$tg1="";
				if($db_qr->num_rows() > 0)
				{
						foreach($db_qr->result() as $itemcat)
						{
								$tg1[]=$itemcat;
						}
				}
				return $tg1;
		}
		function getpageteachersuggestbyuserid($userid,$page)
    {
        $query="select u.*,t.*,t1.Active,t1.Note,t1.ClassID from users as u join userteacher as t on t.UserID=u.UserID
                	join uservsclass as t1 on t1.UserID=u.UserID where u.Active =1 and u.IsSearch=1 and t1.ClassID in (select ClassID from teacherclass where UserID='".$userid."') and t1.Type=0
                order by u.CreateDate desc";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function getpageteachersavebyuserid($userid,$page)
    {
        $perpage=6;
        $startrow=($page-1)*$perpage;
        $query="select u.*,t.*,t1.CreateDate as ngaymoi,t1.Note from users as u join userteacher as t on u.UserID=t.UserID join (select * from usersaveuser where UserID='".$userid."') as t1 on u.UserID=t1.SaveUserID
         order by ngaymoi desc limit $startrow,$perpage";

        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
		function getpageteacherinvitebyuserid($userid,$page)
    {
        $perpage=6;
        $startrow=($page-1)*$perpage;
        $query="select u.*,t.*,t1.CreateDate as ngaymoi,t1.Active from users as u JOIN userteacher as t on u.UserID=t.UserID
                join (select * from classvsuser where ClassID in (select ClassID from teacherclass where UserID='".$userid."')) as t1 on t1.UserID=u.UserID
								where u.active =1 and u.IsSearch =1
                order by ngaymoi desc limit $startrow,$perpage";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
		function getpageteacherfitbyuserid($userid,$page)
    {
        $perpage=6;
        $startrow=($page-1)*$perpage;
        $query="SELECT t.*,u.* from users as t join userteacher as u on t.UserID=u.UserID where t.active =1 and t.IsSearch=1 and t.UserType=1 and t.UserID in(select DISTINCT UserID from usersubject as u where u.SubjectID in(select SubjectID from teacherclass as t where t.UserID='".$userid."' and t.ClassID not in (select u.ClassID from uservsclass as u where u.Active>0)))
        order by t.CreateDate desc limit $startrow,$perpage";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function getlistteacherinvitebyuserid($userid)
    {
        $query="select u.*,t.*,t1.CreateDate as ngayluu from users as u join userteacher as t on u.UserID=t.UserID join (select * from usersaveuser where UserID='".$userid."') as t1 on u.UserID=t1.SaveUserID
         limit 0,5";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function Getlistclassnotteacherbyuserid($userid)
    {
        $query="select * from teacherclass as t where t.UserID='".$userid."' and t.ClassID not in (select u.ClassID from uservsclass as u where u.Active>0)";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function gettopclassbyuser($user){

        $query1="select t.ClassTitle,t.ClassID,t.LearnType,c.UserId as giaovien,c.CreateDate as ngaynhan from teacherclass as t LEFT JOIN classvsuser as c on t.ClassID=c.ClassID where c.UserID ='".$user."' order by c.CreateDate desc limit 5";
        $db_qr = $this->db->query($query1);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function addusersaveclass($userid,$classid){
        $result=['kq'=>false,'data'=>0];
        $CreateDate=date("Y-m-d H:i:s",time());
        $query1="select * from usersaveclass where UserID ='".$userid."' and ClassID='".$classid."'";
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() <= 0)
        {
            $query="insert into usersaveclass(UserID,ClassID,CreateDate)VALUES('".$userid."','".$classid."','".$CreateDate."')";
            $insert=$this->db->query($query);
            $insertid=$this->db->insert_id();
            if($insertid > 0){
               $result=['kq'=>true,'data'=>$insertid];
            }
        }
        return $result;
    }
    function updatecomfirmiscall($userid,$code)
    {
        $CreateDate=date("Y-m-d",time());
        $result=false;
        $query1="select * from comfirmtable where UserID='".$userid."' and Code='".$code."' and CreateDate >'".$CreateDate."'";
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() > 0)
        {
            $item2=$db_qr->row();
            $query1="UPDATE `comfirmtable` SET `IsCall` = '1' WHERE Id = '".$item2->Id."'";
                    $tg=$this->db->query($query1);
                    $result=true;
        }
         return $result;
    }
    function getusersubject($userid)
    {
        $query="select DISTINCT UserID,SubjectID,SubjectName from usersubject where UserID='".$userid."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        $tg2="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat->SubjectID;
                $tg2[]=$itemcat->SubjectName;
            }
        }
        return ['id'=>$tg1,'name'=>$tg2];
    }
    function getusertopic($userid)
    {

        $query="select DISTINCT UserID,TopicID,TopicName from usersubject where UserID='".$userid."'";
        $db_qr = $this->db->query($query);
        $tg1="";

        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat->TopicID;

            }
        }
        return $tg1;
    }
    function updateuservsclass($userid,$classid,$active,$note){
        //0 de nghi day,1 dang day,2 đã dừng,3 tạm nghỉ, 4 hoan thanh
        $result=['kq'=>false,'data'=>''];
        $query1="select * from uservsclass where UserID ='".$userid."' and ClassID='".$classid."'";
        //var_dump($query1);die();
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            if($tg->Type==0){
            $query="UPDATE uservsclass set `Active`='".intval($active)."', `Note`='".$note."' where IDReg='".$tg->IDReg."'";
            $insert=$this->db->query($query);

               $result=['kq'=>true,'data'=>''];
            }else{
                $result=['kq'=>false,'data'=>true];
            }

        }
        return $result;
    }
    function updateusersaveuser($userid,$usersave,$note){
        $result=['kq'=>false,'data'=>''];
        $query1="select * from usersaveuser where UserID ='".$userid."' and SaveUserID='".$usersave."'";
        //var_dump($query1);die();
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            $query="UPDATE usersaveuser set `Note`='".$note."' where IDuser='".$tg->IDuser."'";
            $insert=$this->db->query($query);
            $result=['kq'=>true,'data'=>''];
        }
        return $result;
    }
    function updateuserssaveclass($userid,$classid,$note){
        //0 de nghi day,1 dang day,2 đã dừng,3 tạm nghỉ, 4 hoan thanh
        $result=['kq'=>false,'data'=>''];
        $query1="select * from usersaveclass where UserID ='".$userid."' and ClassID='".$classid."'";
        //var_dump($query1);die();
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            $query="UPDATE usersaveclass set `Note`='".$note."' where IDSave='".$tg->IDSave."'";
            $insert=$this->db->query($query);
            $result=['kq'=>true,'data'=>''];
        }
        return $result;
    }
    function updateusersjobs($userid,$classid,$note){
        //0 de nghi day,1 dang day,2 đã dừng,3 tạm nghỉ, 4 hoan thanh
        $result=['kq'=>false,'data'=>''];
        $query1="select * from userjob where userid ='".$userid."' and ID='".$classid."' and `active`=0";
        //var_dump($query1);die();
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            $query="UPDATE userjob set `note`='".$note."' where ID='".$tg->ID."'";
            $insert=$this->db->query($query);
            $result=['kq'=>true,'data'=>''];
        }
        return $result;
    }
    function companyupdateusersjobs($classid,$note,$trangthai){
        //0 de nghi day,1 dang day,2 đã dừng,3 tạm nghỉ, 4 hoan thanh
        $result=['kq'=>false,'data'=>''];
        $query1="select * from userjob where ID='".$classid."'";
        //var_dump($query1);die();
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            $query="UPDATE userjob set `note`='".$note."',`active`='".$trangthai."' where ID='".$tg->ID."'";
            $insert=$this->db->query($query);
            $result=['kq'=>true,'data'=>''];
        }
        return $result;
    }
    function companyupdateuserssave($classid,$note){
        //0 de nghi day,1 dang day,2 đã dừng,3 tạm nghỉ, 4 hoan thanh
        $result=['kq'=>false,'data'=>''];
        $query1="select * from userjob where ID='".$classid."'";
        //var_dump($query1);die();
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            $query="UPDATE userjob set `note`='".$note."' where ID='".$tg->ID."'";
            $insert=$this->db->query($query);
            $result=['kq'=>true,'data'=>''];
        }
        return $result;
    }
    function deleteuserssaveclass($userid,$classid){
        //0 de nghi day,1 dang day,2 đã dừng,3 tạm nghỉ, 4 hoan thanh
        $result=['kq'=>false,'data'=>''];
        $query1="select * from usersaveclass where UserID ='".$userid."' and ClassID='".$classid."'";
        //var_dump($query1);die();
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            $query="delete from usersaveclass where IDSave='".$tg->IDSave."'";
            $insert=$this->db->query($query);
            $result=['kq'=>true,'data'=>''];
        }
        return $result;
    }
    function deleteusersaveuser($userid,$usersaveid){
        $result=['kq'=>false,'data'=>''];
        $query1="select * from usersaveuser where UserID ='".$userid."' and SaveUserID='".$usersaveid."'";
        //var_dump($query1);die();
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            $query="delete from usersaveuser where IDuser='".$tg->IDuser."'";
            $insert=$this->db->query($query);
            $result=['kq'=>true,'data'=>''];
        }
        return $result;
    }
    function deleteclass($userid,$classid,$type)
    {
        $result=['kq'=>false,'data'=>''];
        $query="select * from teacherclass where UserID='".$userid."' and ClassID='".$classid."'";
        $db_qr = $this->db->query($query);
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            if(intval($type)>0){
                $q1="UPDATE teacherclass set `Active`='1' where ClassID='".$classid."'";
            }else{
                $q1="UPDATE teacherclass set `Active`='0' where ClassID='".$classid."'";
            }

            $insert=$this->db->query($q1);
            if($insert){
               $result=['kq'=>true,'data'=>''];
            }
            }
        return $result;
    }
    function refreshclassbyuser($userid,$classid)
    {
        $result=['kq'=>false,'data'=>''];
        $query="select * from teacherclass where UserID='".$userid."' and ClassID='".$classid."'";
        $db_qr = $this->db->query($query);
        $CreateDate=date("Y-m-d H:i:s",time());
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            $q1="UPDATE teacherclass set `UpdateDate`='".$CreateDate."' where ClassID='".$classid."'";

            $insert=$this->db->query($q1);
            if($insert){
               $result=['kq'=>true,'data'=>''];
            }
            }
        return $result;
    }
    function updateclassvsusers($userid,$classid,$active,$note){
        //0 mời dạy,1 đồng ý,2 không đồng ý
        $result=['kq'=>false,'data'=>''];
        $query1="select * from classvsuser where UserID ='".$userid."' and ClassID='".$classid."'";
        //var_dump($query1);die();
        $db_qr = $this->db->query($query1);
        if($db_qr->num_rows() > 0)
        {
            $tg=$db_qr->row();
            $query1="select * from uservsclass where UserID ='".$userid."' and ClassID='".$classid."' and `Type`=1";
            //var_dump($query1);die();
            $db_qr = $this->db->query($query1);
            if($db_qr->num_rows() > 0)
            {
                $tg1=$db_qr->row();
                $query="UPDATE uservsclass set `Active`='".intval($active)."', `Note`='".$note."' where IDReg='".$tg1->IDReg."'";
                $insert=$this->db->query($query);
            }else{
                if($active==1){
                $query="insert into uservsclass(UserID,ClassID,Active,Note,Type)VALUES('".$userid."','".$classid."','".intval($active)."','".$note."',1)";
                $insert=$this->db->query($query);
                }
            }
            $query="UPDATE classvsuser set `Active`='".intval($active)."', `Note`='".$note."' where IDSave='".$tg->IDSave."'";
            $insert=$this->db->query($query);
            $result=['kq'=>true,'data'=>$insertid];
        }
        return $result;
    }
    function updatenewpass($userid,$oldpass,$newpass){
        $query="select * from users where UserID='".$userid."' and `Password`='".md5($oldpass)."'";
        $db_qr = $this->db->query($query);
        $flag=false;
        if($db_qr->num_rows() > 0)
        {
                $query1="UPDATE `users` SET `Password` = '".md5($newpass)."' WHERE UserID = '".$userid."'";
                $tg1=$this->db->query($query1);
                $flag=true;
        }
        return $flag;
    }
    function updateissearchuser($userid,$issearch)
    {
        $query="select * from users where UserID='".$userid."'";
        $db_qr = $this->db->query($query);
        $flag=false;
        if($db_qr->num_rows() > 0)
        {
                $query1="UPDATE `users` SET `IsSearch` = '".intval($issearch)."' WHERE UserID = '".$userid."'";
                $tg1=$this->db->query($query1);
                $flag=true;
        }
        return $flag;
    }
    function GetUserInfoByUserID($userid)
    {
        $query="select * from users where UserID='".$userid."'";
        $db_qr = $this->db->query($query);
        $flag="";
        if($db_qr->num_rows() > 0)
        {
            $flag=$db_qr->row();
            }
        return $flag;
    }
    function GetLogpointbyuse($userid,$keyview){
        $query="select * from logpoint where UserID='".$userid."' and Trace='".$keyview."' and CreateDate > '".date("Y-m-d",time())."'";
        $db_qr = $this->db->query($query);
        $flag="";
        if($db_qr->num_rows() > 0)
        {
            $flag=$db_qr->row();
        }
        return $flag;
    }
    function updatenofityuser($userid,$notify)
    {
        $query="select * from users where UserID='".$userid."'";
        $db_qr = $this->db->query($query);
        $flag=false;
        if($db_qr->num_rows() > 0)
        {
                $query1="UPDATE `users` SET `Notify` = '".intval($notify)."' WHERE UserID = '".$userid."'";
                $tg1=$this->db->query($query1);
                $flag=true;
        }
        return $flag;
    }
    function getfulluservsclass($userid)
    {
        $query="select t.*,u.`Name`,t1.Active as daday from teacherclass as t LEFT JOIN users as u on t.UserID=u.UserID left join (select * from uservsclass) t1 on t1.ClassID=t.ClassID
        where t1.UserID='".$userid."' ORDER BY t.CreateDate desc";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function getfullclassvsuser($userid)
    {
        $query="select t.*,u.`Name`,t1.Active as daday from teacherclass as t LEFT JOIN users as u on t.UserID=u.UserID left join (select * from classvsuser) t1 on t1.ClassID=t.ClassID
        where t1.UserID='".$userid."' ORDER BY t.CreateDate desc";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function getlistclassbyuser($userid,$page)
    {
        $perpage=6;
        $startrow=($page-1)*$perpage;
        $query="select t.*,t1.MetaDesc,t1.MetaTitle,t1.MetaKeywork,t1.Latitude,t1.Longitude
                from teacherclass as t LEFT JOIN teacherclassmeta as t1 on t1.ClassID=t.ClassID where t.UserID='".$userid."' order by t.CreateDate desc
                limit $startrow,$perpage";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function getcountclassbyuser($userid)
    {
        $query="select COUNT(*) as solophoc from teacherclass where UserID='".$userid."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            $tg1=$db_qr->row();
        }
        return $tg1;
    }
    function getfulluservsclassactive($userid)
    {
        $query="select t.*,u.`Name`,t1.Active as daday from teacherclass as t LEFT JOIN users as u on t.UserID=u.UserID left join (select * from uservsclass where Active=1 or active=2) t1 on t1.ClassID=t.ClassID
        where t1.UserID='".$userid."' ORDER BY t.CreateDate desc";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function getfullteachersaveclass($userid)
    {
        $query="select t.*,u.`Name`,t1.Note as ghichu from teacherclass as t LEFT JOIN users as u on t.UserID=u.UserID left join (select * from usersaveclass) t1 on t1.ClassID=t.ClassID
        where t1.UserID='".$userid."' ORDER BY t.CreateDate desc";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function getfilterteachersaveclass($userid,$monhoc,$findkey,$ngaythang)
    {

        $query="select t.*,u.`Name`,t1.Note as ghichu from teacherclass as t LEFT JOIN users as u on t.UserID=u.UserID left join (select * from usersaveclass) t1 on t1.ClassID=t.ClassID
        where t1.UserID='".$userid."'";
        if(intval($monhoc)>0 ){
            $query .=" and t.SubjectID ='".intval($monhoc)."'";
        }
        if($findkey !=''){
            $query .=" and t.ClassTitle like '%".str_replace(' ','%',$findkey)."%'";
        }
        if($ngaythang != ''){
            $tg=explode('-',$ngaythang);
            $strngaythang=$tg[2]."-".$tg[1]."-".$tg[0];
            $query .=" and t.CreateDate > '".$strngaythang."'";
        }
        $query .=" ORDER BY t.CreateDate desc";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function getfilteruserjob($userid,$type,$monhoc,$findkey,$ngaythang)
    {

        $query="select n.new_title,n.new_money,n.new_id,uj.companyid,uc.usc_company,uc.usc_name,uc.usc_logo,uc.usc_create_time,uj.createdate,uj.note,uj.ID from new as n LEFT JOIN userjob as uj on n.new_id=uj.jobid
				    left JOIN user_company as uc on n.new_user_id=uc.usc_id where uj.userid='".$userid."' and uj.type='".$type."'";
        if(intval($monhoc)>0 ){
            $query .=" and n.new_money ='".intval($monhoc)."'";
        }
        if($findkey !=''){
            $query .=" and n.new_title like '%".str_replace(' ','%',$findkey)."%'";
        }
        if($ngaythang != ''){
            $tg=explode('-',$ngaythang);
            $strngaythang=$tg[2]."-".$tg[1]."-".$tg[0];
            $query .=" and uj.createdate > '".$strngaythang."'";
        }
        $query .=" ORDER BY uj.createdate desc";

        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }

        return $tg1;
    }
    function companyfiltergetcandiamply($companyid,$type,$monhoc,$findky,$ngaythang)
    {
        $query="select n.new_id,n.new_title,uj.type,uj.userid,uj.companyid,u.`Name`,u.Email,u.Image,c1.cv_money_id,uj.createdate,uj.ID,uj.note from new as n left JOIN userjob as uj on n.new_id=uj.jobid
					left JOIN `users` as u on uj.userid=u.UserID
					left join cv as c1 on c1.cv_user_id=u.UserID
                        where uj.companyid='".$companyid."' and uj.type='".$type."'";

        if(intval($monhoc)>0 ){
            $query .=" and c1.cv_money_id ='".intval($monhoc)."'";
        }
        if($findkey !=''){
            $query .=" and u.`Name` like '%".str_replace(' ','%',$findkey)."%'";
        }
        if($ngaythang != ''){
            $tg=explode('-',$ngaythang);
            $strngaythang=$tg[2]."-".$tg[1]."-".$tg[0];
            $query .=" and uj.createdate > '".$strngaythang."'";
        }
        $query.="ORDER BY uj.ID desc";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
                }
        }
        return $row;
    }
    function getfiltercandicomsave($companyid,$type,$monhoc,$findky,$ngaythang)
    {
        $query="select u.UserID,u.`Name`,u.UserName,uj.active,uj.ID,uj.createdate,uj.userid,c1.cv_money_id,uj.note
from `users` as u left join userjob as uj on u.UserID=uj.userid
		left join cv as c1 on u.UserID=c1.cv_user_id
where uj.type=3 and uj.companyid='".$companyid."'";
if(intval($monhoc)>0 ){
            $query .=" and c1.cv_money_id ='".intval($monhoc)."'";
        }
        if($findkey !=''){
            $query .=" and u.`Name` like '%".str_replace(' ','%',$findkey)."%'";
        }
        if($ngaythang != ''){
            $tg=explode('-',$ngaythang);
            $strngaythang=$tg[2]."-".$tg[1]."-".$tg[0];
            $query .=" and uj.createdate > '".$strngaythang."'";
        }
$query.=" ORDER BY uj.ID desc";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
                }
        }
        return $row;
    }
    function GetInfoTeacher($userid)
    {
        $query="select * from users as u left join userteacher as ut on u.UserID=ut.UserID where u.UserID='".$userid."'";
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
             $tg1=$db_qr->row();
        }
        return $tg1;
    }
    function getprovincebykey($key){
       $query1="select t.cit_id,t.cit_name from city as t";
       if($key !=''){
        $query1.=" where t.cit_name like '%".$key."%'";
       }
        $db_qr = $this->db->query($query1);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }
    function insertuserjob($userid,$companyid,$jobid,$type,$createdate,$active){
        $arr=['kq'=>false];
        $query="select * from userjob as u where u.userid='".$userid."' and u.companyid='".$companyid."' and u.jobid='".$jobid."' and u.type='".$type."'";
        $db_qr = $this->db->query($query);

        if($db_qr->num_rows() <= 0)
            {
               $queryconfrim="INSERT INTO userjob(userid,companyid,jobid,type,createdate,active)
                                   VALUES('".$userid."','".$companyid."','".$jobid."','".$type."','".$createdate."','".$active."')";
               $insert=$this->db->query($queryconfrim);
               $arr=['kq'=>true];
            }

        return $arr;
    }
    function GetUserJobby($userid,$companyid,$jobid,$type){
        $query="select * from `userjob` as u where u.userid='".$userid."' and u.companyid='".$companyid."' and u.jobid='".$jobid."' and u.type='".$type."'";
        //var_dump($query);die();
        $db_qr = $this->db->query($query);
        $item2="";
        if($db_qr->num_rows() > 0)
            {
               $item2=$db_qr->row();
            }
        return $item2;
    }
    function GetJobSaveByUser($userid,$type){
        $query="select n.new_title,n.new_money,n.new_id,uj.companyid,uc.usc_company,uc.usc_name,uc.usc_logo,uc.usc_create_time,uj.createdate,uj.note,uj.ID,uj.`active` from new as n LEFT JOIN userjob as uj on n.new_id=uj.jobid
				    left JOIN user_company as uc on n.new_user_id=uc.usc_id where uj.userid='".$userid."' and uj.type='".$type."' ORDER BY uj.createdate desc limit 0,5";
        $db_qr = $this->db->query($query);
        $row="";
        if($db_qr->num_rows() > 0)
            {
               foreach($db_qr->result() as $item){
                $row[]=$item;
                }
            }
        return $row;
    }
    function getcandiamply($companyid)
    {
        $query="select n.new_id,n.new_title,uj.type,uj.userid,uj.companyid,u.`Name`,u.Email,u.Image,c1.cv_money_id,uj.createdate,uj.ID,uj.note,uj.`active` from new as n left JOIN userjob as uj on n.new_id=uj.jobid
					left JOIN `users` as u on uj.userid=u.UserID
					left join cv as c1 on c1.cv_user_id=u.UserID
                        where uj.companyid='".$companyid."' and uj.type=1
                        ORDER BY uj.ID desc";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
                }
        }
        return $row;
    }
    function getcandicomsave($companyid)
    {
        $query="select u.UserID,u.`Name`,u.UserName,uj.active,uj.ID,uj.createdate,uj.userid,c1.cv_money_id,uj.note
from `users` as u left join userjob as uj on u.UserID=uj.userid
		left join cv as c1 on u.UserID=c1.cv_user_id
where uj.type=3 and uj.companyid='".$companyid."' ORDER BY uj.ID desc";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
                }
        }
        return $row;

    }
    function sumpointbyuserid($userid,$subtract = "")
    {
        $query="select UserID,SUM(Price) as point from logpoint where UserID='".$userid."'";
        $sql=$this->db->query($query);
        $row= array();
        if($sql->num_rows()> 0 && $sql->row()->UserID > 0)
        {
            $row=$sql->row();
        }
        return $row;
    }
    function addtransaction($userid,$price,$amount,$trace,$curentbalance,$type)
    {
        $CreateDate=date("Y-m-d H:i:s",time());
        $transid=$this->v4_guid();
        $referenid=$this->v4_guid();
        $query="INSERT INTO transactiontable(TransId,ReferentId,UserID,Price,Type,CreateUserId,CreateDate,Amount,Status,Trace,UpdateUserId,UpdateDate,CurrentBalance)
                                   VALUES('".$transid."','".$referenid."','".$userid."','".$price."','".$type."','".$userid."','".$CreateDate."','".$amount."','1','".$trace."','".$userid."','".$CreateDate."','".$curentbalance."')";
        $insert=$this->db->query($query);
        return $insert;
    }
    function addlogbuypoint($userid,$money,$buypoint,$trace)
    {
        $CreateDate=date("Y-m-d H:i:s",time());
        $query="insert into logbuypoint(UserID,CreateDate,CreateBy,Money,BuyPoint,Trace,Status)
                            values('".$userid."','".$CreateDate."','".$userid."','".$money."','".$buypoint."','".$trace."','2')";
        $insert=$this->db->query($query);
        return $insert;
    }
    function UpdateCurentBalance($userid,$amount)
    {
        $CreateDate=date("Y-m-d H:i:s",time());
        $arr=['kq'=>false];
        $query="select * from balance where UserId='".$userid."'";
        $sql=$this->db->query($query);
        if($sql->num_rows()> 0)
        {
            $arrbalance=$sql->row();
            $query2="Update balance set Balance='".$amount."',CreateDate='".$CreateDate."' where Id='".$arrbalance->Id."'";
            $tg1=$this->db->query($query2);
            if($tg1){
                $arr=['kq'=>true];
            }
        }
        return $arr;
    }
    function CreateSendMail($toFrom,$toAddress,$ccAddress,$bccAddress,$subject,$body) {
    	$int_type = 16;
    	//16 kich hoat tai khoan ung vien CV
    	$MailContent = $body;
    	$SendFrom = $toFrom;
    	$SendTo = $toAddress;
    	$Status = 0;
    	$Subject = $subject;
    	$Type = $type;
    	$timesend = date("Y-m-d H:i:s",time());
    	//send mail to hunghabay
    	$this->SendmailHunghapay("D66","C97A94C1A7992D87B0B141170DBBAB7A",$toAddress,$subject,$body,$int_type);
	}

	function SendmailHunghapay($partner,$pass,$toAddress,$subject,$body,$int_type)
	{
	   $soapUrl = "http://quanlymails.timviec365.vn/SendMail.asmx?op=CreateMail"; // asmx URL of WSDL
	   // xml post structure
	   $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
	   <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
	     <soap:Body>
	       <CreateMail xmlns="http://tempuri.org/">
	         <partner>'.$partner.'</partner>
	         <pass>'.$pass.'</pass>
	         <toAddress>'.$toAddress.'</toAddress>
	         <subject>'.$subject.'</subject>
	         <body>'.$body.'</body>
	         <type>'.$int_type.'</type>
	       </CreateMail>
	     </soap:Body>
	   </soap:Envelope>';   // data from the form, e.g. some ID number
	   $headers = array(
	   "Content-Type: text/xml; charset=utf-8",
	   "Accept: text/xml",
	   "Cache-Control: no-cache",
	   "Pragma: no-cache",
	   "Content-length: ".strlen($xml_post_string),
	   ); //SOAPAction: your op URL
	   $url = $soapUrl;
	   // PHP cURL  for https connection with auth
	   $ch = curl_init();
	   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	   curl_setopt($ch, CURLOPT_URL, $url);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	   curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	   curl_setopt($ch, CURLOPT_POST, true);
	   curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
	   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	   // converting
	   $response = curl_exec($ch);
	   curl_close($ch);
	}
    function updatethongtinungvien($userid,$bangcap,$capbac,$congviec,$diachi,$gioitinh,$hinhthuclv,$honnhan,$hoten,$kinhnghiem,$kynang,$mucluong,$muctieu,$nganhhoc,$nganhnghe
        ,$nganhnghekhac,$ngonngu,$noilamvieckhac,$quanhuyen,$sodienthoai,$tinhthanh,$truong,$xeploai,$ngaysinh,$gioithieuchung,$motaexp)
    {
        $result="";
        $tg=explode('-',$ngaysinh);
        $ngaysinhnew=date("Y-m-d H:i:s",strtotime($tg[2]."-".$tg[1]."-".$tg[0]));
        $query1="UPDATE `users` SET `Name` = '".$hoten."',UpdateDate='".date("Y-m-d H:i:s",time())."',Sex='".$gioitinh."',Birth='".$ngaysinhnew."',CityID='".$tinhthanh."',CityName='".Getcitybyindex($tinhthanh)."',Address='".$diachi."',
            HonNhan='".$honnhan."',Description='".$gioithieuchung."',Exp='".$motaexp."',HonNhan='".$honnhan."',Email='".$email."' WHERE UserID = '".$userid."'";
                    $tg1=$this->db->query($query1);
                    if($tg1){
                        $qr="SELECT * from cv where cv_user_id='".$userid."'";
                        $sql=$this->db->query($qr);
                        if($sql->num_rows() > 0)
                        {
                            $query2="Update cv set cv_title='".$congviec."',cv_hocvan='".$bangcap."',cv_loaihinh_id='".$hinhthuclv."',cv_capbac_id='".$capbac."',cv_money_id='".$mucluong."'
                                    ,cv_exp='".$kinhnghiem."',cv_kynang='".$kynang."',cv_muctieu='".$muctieu."'
                                    ,cv_cate_id='".$nganhnghe."',cate_extra='".$nganhnghekhac."',cv_city_id='".$tinhthanh."',city_extra='".$noilamvieckhac."',district='".$quanhuyen."',
                                    school='".$truong."',schooltype='".$nganhhoc."',xeploaihoctap='".$xeploai."',language='".$ngonngu."' where cv_user_id='".$userid."'";
                            $tg1=$this->db->query($query2);
                            if($tg1){
                                $result="success";
                            }
                        }else{
                            $query="INSERT INTO cv(cv_user_id,cv_title,cv_hocvan,cv_loaihinh_id,cv_capbac_id,cv_money_id,cv_exp,cv_kynang,cv_muctieu,cv_cate_id,cate_extra,cv_city_id,city_extra,district,school,schooltype,xeploaihoctap,language)
                                VALUES(".$userid.",'".$congviec."','".intval($bangcap)."','".intval($hinhthuclv)."','".intval($capbac)."','".intval($mucluong)."','".intval($kinhnghiem)."','".$kynang."','".$muctieu."','".intval($nganhnghe)."','".$nganhnghekhac."','".intval($tinhthanh)."','".$noilamvieckhac."','".intval($quanhuyen)."','".$truong."','".$nganhhoc."','".intval($xeploai)."','".intval($ngonngu)."')";
                            $insert=$this->db->query($query);
                            if($insert){
                                $result= "success" ;
                            }
                        }
                    }
            return $result;
    }
    function updatecompany($tencongty,$diachi,$website,$quymo,$id,$email,$mota,$sodienthoai,$userid){
        if(intval($id)>0){
            $query="UPDATE `user_company` SET `usc_company` = '".$tencongty."',`usc_address` = '".$diachi."'
                                        ,`usc_website` = '".$website."',`usc_size`='".$quymo."',`usc_email`='".$email."'
                                        ,`usc_phone` = '".$sodienthoai."' WHERE usc_id = '".$id."'";
            $tg1=$this->db->query($query);
        }else{
            $qr = "INSERT INTO user_company(usc_email,usc_name,usc_name_add,usc_name_phone,usc_name_email,usc_company,usc_address,usc_phone,usc_create_time,usc_website,usc_size,usc_authentic,UserID)
                VALUES('".$email."','".$tencongty."','".$diachi."','".$sodienthoai."','".$email."','".$tencongty."','".$diachi."','".$sodienthoai."','".time()."','".$website."','".$quymo."','1','".$userid."')";
            $tg1=$this->db->query($qr);
            $id=$this->db->insert_id();
        }

        $query="select * from user_company_multi where usc_id='".$id."'";
        $db_qr = $this->db->query($query);
        $item2="";
        if($db_qr->num_rows() > 0)
        {
            $query1="UPDATE `user_company_multi` SET `usc_company_info` = '".$mota."' WHERE usc_id = '".$id."'";
            $tg1=$this->db->query($query1);
        }else{
            $queryconfrim="INSERT INTO user_company_multi(usc_id,usc_company_info)VALUES('".$id."','".$mota."')";
            $insert=$this->db->query($queryconfrim);
        }
        $item2=true;
        return $item2;
    }
    function GetJobbyCongTy($id){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.*,uc.UserID,nm.new_mota,nm.new_yeucau,nm.new_quyenloi,nm.new_ho_so
					from new as n left join new_multi as nm on n.new_id=nm.new_id
					left JOIN user_company as uc on n.new_user_id=uc.usc_id
                    where uc.UserID='".$id."' order by n.new_create_time desc";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
                }
        }
        return $row;
    }
    function GetFilterJobbyCongTy($id,$mucluong,$ngayhethan,$findkey){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow);
        $query="select n.*,uc.UserID,nm.new_mota,nm.new_yeucau,nm.new_quyenloi,nm.new_ho_so
					from new as n left join new_multi as nm on n.new_id=nm.new_id
					left JOIN user_company as uc on n.new_user_id=uc.usc_id
                    where uc.UserID='".$id."'";
        if(intval($mucluong) > 0){
            $query.=" and n.new_money='".intval($mucluong)."'";
        }
        if($findkey !=''){
            $query .=" and n.`new_title` like '%".str_replace(' ','%',$findkey)."%'";
        }
        if($ngayhethan != ''){
            $tg=explode('-',$ngayhethan);
            $strngaythang=$tg[2]."-".$tg[1]."-".$tg[0];
            $query .=" and n.new_han_nop > '".strtotime($strngaythang)."'";
        }
        $query.=" order by n.new_create_time desc";
        $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            foreach($sql->result() as $item){
                $row[]=$item;
                }
        }
        return $row;
    }
		function InsertNew($id,$tieude,$nganhnghe,$diadiem,$mota,$yeucauhoso,$yeucau,$quyenloi,$kinhnghiem,$bangcap,$hinhthuc,$luong,$capbac,$gioitinh,$ngayhethan,$userid,$parttime)
    {
        $kq="";
        $arrngayhethan=explode('-',$ngayhethan);
        //var_dump($arrngayhethan);
        if(intval($parttime)> 0){
            $newtype=intval($parttime);

        }else{
            $newtype=1;
        }
        $time=strtotime($arrngayhethan[2].'-'.$arrngayhethan[1].'-'.$arrngayhethan[0]);
        if(intval($id) > 0){
            $qr="select * from new where new_id='".$id."' and new_user_id='".$userid."'";
            $sql=$this->db->query($qr);
            if($sql->num_rows()> 0){
                if($newtype > 1){
                    $query="UPDATE new SET new_title='".$tieude."',new_cat_id='".$nganhnghe."',new_city='".$diadiem."',new_exp='".$kinhnghiem."'
                                            ,new_gioi_tinh='".GetSex1($gioitinh)."',new_cap_bac='".$capbac."',new_money='".$luong."',new_hinh_thuc='".$hinhthuc."',new_bang_cap='".$bangcap."', new_han_nop = ".$time.",new_update_time = ".time().",new_type=".$newtype.",type='1' WHERE new_id = '".$id."'";
                    $sql=$this->db->query($query);
                }else{
                $query="UPDATE new SET new_title='".$tieude."',new_cat_id='".$nganhnghe."',new_city='".$diadiem."',new_exp='".$kinhnghiem."'
                                            ,new_gioi_tinh='".GetSex1($gioitinh)."',new_cap_bac='".$capbac."',new_money='".$luong."',new_hinh_thuc='".$hinhthuc."',new_bang_cap='".$bangcap."', new_han_nop = ".$time.",new_update_time = ".time().",new_type='1',type='0' WHERE new_id = '".$id."'";
                $sql=$this->db->query($query);
                }
            if($sql){
                $query="UPDATE new_multi SET new_mota='".$mota."',new_yeucau='".$yeucau."',new_quyenloi='".$quyenloi."',new_ho_so='".$yeucauhoso."' WHERE new_id = '".$id."'";
            $sql=$this->db->query($query);
            $kq="success";
            }
            }
        }else{
            if($newtype > 1){
							$query = "INSERT INTO new(new_title,new_cat_id,new_city,new_gioi_tinh,new_money,new_cap_bac,new_han_nop,new_create_time,new_update_time,new_active,new_user_id,new_exp,new_bang_cap,new_so_luong,new_hinh_thuc,new_cra,source,new_type,type)
                      VALUES('".$tieude."','".$nganhnghe."','".$diadiem."','".GetSex1($gioitinh)."','".$luong."','".$capbac."','".$time."','".time()."','".time()."','1','".$userid."','".$kinhnghiem."','".$bangcap."','5','".$hinhthuc."','0','1','".$newtype."','1')";
                $sql=$this->db->query($query);
                $insertid=$this->db->insert_id();
            }else{
							$query = "INSERT INTO new(new_title,new_cat_id,new_city,new_gioi_tinh,new_money,new_cap_bac,new_han_nop,new_create_time,new_update_time,new_active,new_user_id,new_exp,new_bang_cap,new_so_luong,new_hinh_thuc,new_cra,source,new_type,type)
                     VALUES('".$tieude."','".$nganhnghe."','".$diadiem."','".GetSex1($gioitinh)."','".$luong."','".$capbac."','".$time."','".time()."','".time()."','1','".$userid."','".$kinhnghiem."','".$bangcap."','5','".$hinhthuc."','0','1','1','0')";
                $sql=$this->db->query($query);
                $insertid=$this->db->insert_id();
            }
            if($sql){
                $metatitle=$tieude." mới nhất ".date("Y",time());
                $metakey=$tieude.", tuyển dụng việc làm,";
                $metadesc=$tieude;
                $query="INSERT INTO new_multi(new_id,new_mota,new_yeucau,new_quyenloi,new_ho_so,meta_title,meta_desc,meta_keywork)VALUES('".$insertid."','".$mota."','".$yeucau."','".$quyenloi."','".$yeucauhoso."','".$metatitle."','".$metadesc."','".$metakey."')";
                $sql=$this->db->query($query);
                $kq="success";
            }
        }
        return $kq;
    }
    function smtpmailer($to, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->CharSet = "UTF-8";
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'mail.24hpay.net';
        $mail->Port = 587;
        $mail->Username = GUSER;
        $mail->Password = GPWD;
        $mail->SetFrom($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if(!$mail->Send())
        {
            $message = 'Gởi mail bị lỗi: '.$mail->ErrorInfo;
            return false;
        }
        else
        {
            $message = 'Thư của bạn đã được gởi đi ';
            return true;
        }
    }
     function countuserbyip($ip)
    {
        $timesend = date("Y-m-d",time());
        $query="select COUNT(*) as sobanghi from users where  !ISNULL(IP) and IP='".$ip."' and CreateDate >='".$timesend."'";
        $db_qr = $this->db->query($query);
        $tg1=0;
        if($db_qr->num_rows() > 0)
        {
             $tg1=$db_qr->row()->sobanghi;
        }
        return $tg1;
    }
    function countuserforgotpassbyip($ip)
    {
        $timesend = date("Y-m-d",time());
        $query="select COUNT(*) as sobanghi from comfirmtable where Type=2 and !ISNULL(IP) and IP='".$ip."' and CreateDate >='".$timesend."'";
        $db_qr = $this->db->query($query);
        $tg1=0;
        if($db_qr->num_rows() > 0)
        {
             $tg1=$db_qr->row()->sobanghi;
        }
        return $tg1;
    }
    function countuserforgotpassbyipanduser($userid)
    {
        $timesend = date("Y-m-d",time());
        $query="select COUNT(*) as sobanghi from comfirmtable where Type=2 and UserID='".$userid."' and CreateDate >='".$timesend."'";
        $db_qr = $this->db->query($query);
        $tg1=0;
        if($db_qr->num_rows() > 0)
        {
             $tg1=$db_qr->row()->sobanghi;
        }
        return $tg1;
    }
    function getitemSEO($id)
		{
				$query=" select * from tbl_footer where id='".$id."' ";

				$news_cat = $this->db->query($query);
				$tg="";
				if($news_cat->num_rows()> 0)
						{
								$tg=$news_cat->row();
								}
								return $tg;
		}
}
?>
