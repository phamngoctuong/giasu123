<?php
class admin_model extends Model
{
	function admin_model()
	{
		parent::Model();
	}

	function gettbl($tbl,$id)
	{
		if($id!=''){
			$this->db->where('id',$id);
		}
		$query = $this->db->get($tbl);
		return $query;
	}
	function gettbl_listbv($tbl)
	{
		$this->db->where('status',1);
		$query = $this->db->get($tbl);
		return $query;
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
				return 1;
    }
	function UpdateorAddtbl($tbl,$data,$keyID,$id)
    {
        if($id=='')
        {
            $this->db->insert($tbl,$data);
        }
        else
        {
            $this->db->where($keyID,$id);
            $this->db->update($tbl,$data);
        }
    }
    function ListSubject()
    {
        $query="select * from subject";
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
	function show_category($cid,$parent_id="0",$insert_text="-")
    {
        $this->db->where('parent',$parent_id);
        $this->db->order_by('id','asc');
        $sql=$this->db->get('chuyenmuc');
        foreach($sql->result() as $itemcat)
        {
			if($itemcat->id==$cid){
				echo "<option selected=\"selected\" value='".$itemcat->id."'>".$insert_text.$itemcat->name."</option>";
			}
			else{
				echo "<option value='".$itemcat->id."'>".$insert_text.$itemcat->name."</option>";
			}
            $this->show_category($cid,$itemcat->id,$insert_text."---");
        }
        return true;
    }
	function Getlistcontent($findkey)
    {
        if($findkey != '')
        {
            $query="SELECT id,alias,title,image FROM baiviet WHERE status=1 and title like '%".str_replace(' ','%',$findkey)."%' ORDER BY id DESC LIMIT 5";
        }else{
            $query='SELECT id,alias,title,image FROM baiviet WHERE status=1 ORDER BY id DESC LIMIT 5';
        }
        //var_dump($query);die();
        $news_cat = $this->db->query($query);
        $tg="";
        foreach($news_cat->result() as $items)
            {
                $tg[]=$items;
                }
                return $tg;

    }
    function getlistcity()
    {
        $query="select * from city";
        $news_cat = $this->db->query($query);
        $tg="";
        foreach($news_cat->result() as $items)
            {
                $tg[]=$items;
                }
                return $tg;
    }
    function getlistsubject()
    {
        $query="select * from subject";
        $news_cat = $this->db->query($query);
        $tg="";
        foreach($news_cat->result() as $items)
            {
                $tg[]=$items;
                }
                return $tg;
    }
    function getlinkseobuysubcitytype($subid,$cityid,$lophoc,$type)
    {
        $query="select * from linkseo where cityid='".intval($cityid)."' and subjectid='".intval($subid)."' and `type`='".intval($type)."' and lophoc='".intval($lophoc)."'";

        $news_cat = $this->db->query($query);
        $tg="";
        if($news_cat->num_rows()> 0)
            {
                $tg=$news_cat->row();
                }
                return $tg;
    }
    function getcitybyid($id)
    {
         $query="select * from city where cit_id='".intval($id)."'";

        $news_cat = $this->db->query($query);
        $tg="";
        if($news_cat->num_rows()> 0)
            {
                $tg=$news_cat->row();
                }
        return $tg;
    }
    function selectCtrl($cid,$name,$class)
    {
        echo "<select name='".$name."' class='".$class."'>\n";
		echo "<option value='0'>-- Chọn chuyên mục --</option>";
        $this->show_category($cid);
        echo "</select>";
    }
	// Đệ quy link thân thiện
	function getcatlink($uid)
    {
		$catlink=0;
        $this->db->where('id',$uid);
        $sql1=$this->db->get('tblchuyenmuc');
        if($sql1->num_rows() >0)
        {
            foreach($sql1->result() as $items)
            {
                $catlink = $this->getcatlink($items->uid);
				$catlink .= '/'.$items->alias;
            }
		return $catlink;
        }
    }


	function gettbl_limited($tbl,$start_row,$limit)
	{
	    $sql="select * from $tbl order by id desc limit $start_row,$limit";
		$query=$this->db->query($sql);
		return $query;
	}

	function gettbl_search_limited($tbl,$start_row,$limit)
	{
		if(isset($_SESSION['txt_search']) and $_SESSION['txt_search']!='Nhập từ khóa tìm kiếm')
        {
			$this->db->like('title',$_SESSION['txt_search']);
		}
		if(isset($_SESSION['search_cid'])and $_SESSION['search_cid']!=0)
        {
			$this->db->where('cid',$_SESSION['search_cid']);
		}
		if(isset($_SESSION['search_user'])and $_SESSION['search_user']!=0)
        {
			$this->db->where('uid',$_SESSION['search_user']);
		}
		if(isset($_SESSION['search_status'])and $_SESSION['search_status']!=-1)
        {
			$this->db->where('status',$_SESSION['search_status']);
		}
		$this->db->order_by('id','DESC');
		if($limit!=''){
			$this->db->limit($limit,$start_row);
		}
		$query=$this->db->get($tbl);
		return $query;
	}

	function gettblsmslog($Code,$Type,$StatusCode,$CreateDate,$denngay,$iscall,$limit,$start_row)
	{
	   $query="select u.*
                from `smslog` as u
                where 1=1";
        if(!empty($Code))
				{
			$query.=" And (u.Code like '%".$Code ."%')";

		}
		if(!empty($Type))
				{
				    $query.=" And u.Type='".intval($Type)."'";

		}
        if($iscall != ''){
            $query.=" And u.IsCall='".intval($iscall)."'";

        }
		if(!empty($StatusCode))
				{$query.=" And u.StatusCode='".intval($StatusCode)."'";
			//$this->db->where('',);
		}
		if(!empty($CreateDate))
				{
				    $query.=" and u.CreateDate >'".$CreateDate."' and u.CreateDate <'".$denngay."'";

		}
        $query.= " ORDER BY u.ID DESC";
        //var_dump($query);die();
		$total=$this->db->query($query)->num_rows();
		if($limit!=''){
			$query.=" limit ".$limit.",".$start_row;
		}

        $sql1=	$this->db->query($query);

        if($sql1->num_rows() >0)
        {
            $tg1="";
            foreach($sql1->result() as $itemcat)
            {
                $tg1[]=$itemcat;
                }
            }


        return array('data'=>$tg1,'total'=>$total) ;

	}

	function doanhnghiep_limited($tbl,$start_row,$limit)
	{
		if(isset($_SESSION['cp']))
        {
			$this->db->like('name',$_SESSION['cp']);
		}
		$this->db->order_by('id','DESC');
		if($limit!=''){
			$this->db->limit($limit,$start_row);
		}
		$query=$this->db->get($tbl);
		return $query;
	}

	function del_tbl($tbl,$id){
		$sql="DELETE FROM $tbl WHERE id=".$id;
		$result=$this->db->query($sql);
		return $result;
	}
    function delrowtbl($tbl,$field,$id){
		$sql="DELETE FROM $tbl WHERE ".$field."=".$id;
		$result=$this->db->query($sql);
		return $result;
	}
	function checkstatus($tbl,$action,$id)
	{
		$sql="UPDATE $tbl SET status='$action' WHERE id='$id'";
		$this->db->query($sql);
	}
    function checkstatusjob($tbl,$field,$action,$fieldid,$id)
	{
		$sql="UPDATE $tbl SET ".$field."='$action' WHERE ".$fieldid."='$id'";
        //var_dump($sql);die();
		$this->db->query($sql);
	}
    function gettblbyfield($tbl,$field,$id)
	{
		if($id!=''){
			$this->db->where($field,$id);
		}
		$query = $this->db->get($tbl);
		return $query;
	}
	//Check admin
	function getlogin($name,$pass)
    {
        $this->db->where('name',$name);
        $this->db->where('pass',md5($pass));
        $sql=$this->db->get('tbl_admin');
        if($sql->num_rows()==1)
        {
            return TRUE;
        }
    }
    function checkfileds($name)
    {
        $this->db->where('name',$name);
        $sql=$this->db->get('tbl_admin');
        if($sql->num_rows()==1)
        {
            return TRUE;
        }
    }
    function Getalljobbypage($findkey,$category,$city,$hot,$do,$gap,$cao,$parttime,$page,$perpage){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 7 day');
        $query="select n.*,
		m.new_mota,
		m.new_yeucau,
		m.new_quyenloi,
		m.new_ho_so
        from new as n join new_multi as m on n.new_id=m.new_id
        where 1=1";
        if($findkey!=''){
         $query.=" and n.new_title like '%".$findkey."%'";
        }else{
            $query.=" and n.new_create_time >'".$timenow1."'";
        }
        if(intval($category) >0){
            $query .=" and FIND_IN_SET('".intval($category)."',n.new_cat_id)";
        }
        if(intval($city)>0){
            $query.=" and FIND_IN_SET('".intval($city)."',n.new_city)";
        }
        if(intval($hot)>0){
            $query.=" and n.new_hot =1";
        }
        if(intval($do)>0){
            $query.=" and n.new_do =1";
        }
        if(intval($gap)>0){
            $query.=" and n.new_gap =1";
        }
        if(intval($cao)>0){
            $query.=" and n.new_cao =1";
        }
        if(intval($parttime)>0){
            if(intval($parttime)> 1){
                if(intval($parttime)==4){
                    $query.=" and (n.new_type ='2' or n.new_type ='3') and n.type=1";
                }else{
                $query.=" and n.new_type ='".intval($parttime)."' and n.type=1";
                }
            }else{
                $query.=" and n.type=0";
            }
        }
        $query.=" ORDER BY n.new_id desc";
        $total=$this->db->query($query)->num_rows();
        $query.=" limit ".$page.",".$perpage;
        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {
            foreach($sql1->result() as $items)
            {
                $catlink[] =		$items;
            }

        }
        return array('data'=>$catlink,'total'=>$total) ;
    }
	//Gan Flag
	function flags($id,$nguoidang,$flag){
		$sql="UPDATE tblbaiviet SET nguoidang=$nguoidang,flag=$flag WHERE id='$id'";
		$this->db->query($sql);
	}
	function Getallnewbypage($findkey,$category,$city,$hot,$CreateDate,$denngay,$page,$perpage){
			$timenow=date("Y-m-d",time());
			$timenow1 = strtotime($timenow.' - 365 day');
			$query="select u.*,t.* from users as u join userteacher as t on u.UserID=t.UserID where 1=1";
			if($findkey!=''){
			 $query.=" and u.`Name` like '%".$findkey."%'";
			}else{
					$query.=" and u.CreateDate >'".date("Y-m-d",$timenow1)."'";
			}
			if(intval($category) >0){
					$query .=" and u.CityID = '".intval($category)."'";
			}

			if(intval($hot)>0){
					$query.=" and t.Vip=1";
			}
			if(intval($city)>0){
					$query.="  and u.UserID in(select UserID FROM usersubject where SubjectID='".intval($city)."')";
			}
			if(!empty($CreateDate)){
				$query.= "and t.UpdateDate >'".$CreateDate."' and t.UpdateDate <'".$denngay."'";
			}

			$query.=" ORDER BY u.UserID desc";

			$total=$this->db->query($query)->num_rows();
			$query.=" limit ".$page.",".$perpage;
			$sql1=	$this->db->query($query);
			$catlink="";
			if($sql1->num_rows() >0)
			{
					foreach($sql1->result() as $items)
					{
							$catlink[] =		$items;
					}

			}
			return array('data'=>$catlink,'total'=>$total) ;
	}
		function Getallnewcandidate($findkey,$city,$CreateDate,$denngay,$page,$perpage){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 365 day');
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
				from `users` as u join cv as c on u.UserID = c.cv_user_id where 1 = 1";
        if($findkey!=''){
         		$query.="and (u.Email like '%".$findkey."%' or u.UserName like '%".$findkey."%' or u.`Name` like '%".$findkey."%') ";
        }else{
            $query.=" and u.CreateDate >'".date("Y-m-d",$timenow1)."'";
        }
				if(intval($city)>0){
					 $query.=" and c.cv_city_id =".intval($city)."";
				}
				if(!empty($CreateDate))
				{
						$query.=" and u.CreateDate >'".$CreateDate."' and u.CreateDate <'".$denngay."'";
				}
        $query.=" ORDER BY u.UserID desc";

        $total=$this->db->query($query)->num_rows();
        $query.=" limit ".$page.",".$perpage;
        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {
            foreach($sql1->result() as $items)
            {
                $catlink[] =		$items;
            }

        }
        return array('data'=>$catlink,'total'=>$total) ;
    }

    function Getallsubject($findkey,$page,$perpage){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 360 day');
        $query="select u.* from subject as u where 1=1";
        if($findkey!=''){
         $query.=" and u.`SubjectName` like '%".$findkey."%'";
        }else{
            $query.=" and u.CreateDate >'".date("Y-m-d",$timenow1)."'";
        }

        $query.=" ORDER BY u.ID desc";
        $total=$this->db->query($query)->num_rows();
        $query.=" limit ".$page.",".$perpage;
        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {
            foreach($sql1->result() as $items)
            {
                $catlink[] =		$items;
            }

        }
        return array('data'=>$catlink,'total'=>$total) ;
    }
    function Getalltopic($findkey,$page,$perpage){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 360 day');
        $query="select u.*,s.SubjectName from topic as u left join subject as s on s.ID=u.SubjectID where 1=1";
        if($findkey!=''){
         $query.=" and u.`NameTopic` like '%".$findkey."%'";
        }

        $query.=" ORDER BY u.ID desc";
        $total=$this->db->query($query)->num_rows();
        $query.=" limit ".$page.",".$perpage;
        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {
            foreach($sql1->result() as $items)
            {
                $catlink[] =		$items;
            }

        }
        return array('data'=>$catlink,'total'=>$total) ;
    }
    function Getallsendnotifymoney($findkey,$page,$perpage){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 360 day');
        $query="select u.*,s.`Name`,s.UserName from sendnotifymonney as u left join users as s on s.UserID=u.UserID where 1=1";
        if($findkey!=''){
         $query.=" and u.`TransferBank` like '%".$findkey."%' or u.`ReceiveBank` like '%".$findkey."%'";
        }
        $query.=" ORDER BY u.ID desc";
        $total=$this->db->query($query)->num_rows();
        $query.=" limit ".$page.",".$perpage;
        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {
            foreach($sql1->result() as $items)
            {
                $catlink[] =		$items;
            }

        }
        return array('data'=>$catlink,'total'=>$total) ;
    }
		function GetallLogBuyPoint($findkey,$page,$perpage){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 360 day');
        $query="select u.*,s.`Name`,s.UserName from logbuypoint as u left join users as s on s.UserID=u.UserID where 1=1";
        if($findkey!=''){
         $query.=" and s.UserName like '%".$findkey."%'";
        }
        $query.=" ORDER BY u.ID desc";
        $total=$this->db->query($query)->num_rows();
        $query.=" limit ".$page.",".$perpage;
        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {
            foreach($sql1->result() as $items)
            {
                $catlink[] =		$items;
            }

        }
        return array('data'=>$catlink,'total'=>$total) ;
    }
    function Getallsubjecttype(){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 30 day');
        $query="select * from subjecttype as u where 1=1";

        $query.=" ORDER BY ID asc";

        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {
            foreach($sql1->result() as $items)
            {
                $catlink[] =		$items;
            }

        }
        return $catlink ;
    }
		function Getallcompanybypage($findkey,$city,$CreateDate,$denngay,$page,$perpage){
				$time1 =strtotime($CreateDate);
				$time2 = strtotime($denngay);
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 60 day');
        $query="select * FROM user_company as t where 1=1";
        if($findkey!=''){
         $query.=" and t.usc_company like '%".str_replace(' ','%',$findkey)."%' or t.usc_name_phone like '%".$findkey."%'";
        }

        if(intval($city)>0){
            $query.=" and t.usc_city='".intval($city)."'";
        }
				if(!empty($CreateDate))
				{
						$query.=" and t.usc_create_time >'".$time1."' and t.usc_create_time <'".$time2."'";
				}

        $query.=" order by t.usc_id desc";
        $total=$this->db->query($query)->num_rows();
        $query.=" limit ".$page.",".$perpage;
        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {
            foreach($sql1->result() as $items)
            {
                $catlink[] =		$items;
            }

        }
        return array('data'=>$catlink,'total'=>$total) ;
    }

		function GetAllCandibypage($findkey,$category,$city,$CreateDate,$denngay,$page,$perpage)
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 90 day');
        $query="select u.*
                from `users` as u
                where ";
        if($findkey!='')
        {
            $query.=" (u.Email like '%".$findkey."%' or u.UserName like '%".$findkey."%' or u.`Name` like '%".$findkey."%')";
        }else{

             $query.=" u.CreateDate >'".date("Y-m-d",$timenow1)."'";
        }
        if(intval($category) > 0){
            if(intval($category)==1){
                $query.=" and u.UserType='0'";
            }else{
            $query.=" and u.UserType='".intval($category)."'";
            }
        }
        if(intval($city)>0){
            $query.=" and (u.CityID='".intval($city)."')";
        }
				if(!empty($CreateDate))
				{
				    $query.=" and u.CreateDate >'".$CreateDate."' and u.CreateDate <'".$denngay."'";
		  	}
            $query.= " group by u.UserID ORDER BY u.UserID DESC";
            $total=$this->db->query($query)->num_rows();
            $query.=" limit ".$page.",".$perpage;
            //var_dump($category);
            //var_dump($query);die();
        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {
            foreach($sql1->result() as $items)
            {
                $catlink[] =		$items;
            }

        }
        return array('data'=>$catlink,'total'=>$total) ;
    }

    function GetAllClass($findkey,$category,$city,$page,$perpage)
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 90 day');
        $query="select u.*
                from `teacherclass` as u
                where 1=1";
        if($findkey!='')
        {
            $query.=" And (u.ClassTitle like '%".str_replace(' ','%',$findkey) ."%')";
        }else{

             $query.=" and u.CreateDate >'".date("Y-m-d",$timenow1)."'";
        }
        if(intval($category) > 0){

            $query.=" and u.SubjectID='".intval($category)."'";

        }
        if(intval($city)>0){
            $query.=" and (u.City='".intval($city)."')";
        }
        $query.= " ORDER BY u.ClassID DESC";
        $total=$this->db->query($query)->num_rows();
        $query.=" limit ".$page.",".$perpage;
            //var_dump($category);
            //var_dump($query);die();
        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {
            foreach($sql1->result() as $items)
            {
                $catlink[] =		$items;
            }

        }
        return array('data'=>$catlink,'total'=>$total) ;
    }
    function GetAllLinkSeo($findkey,$city,$subject,$lophoc,$page,$perpage)
    {

        $query="select u.*
                from `linkseo` as u
                where 1=1";
        if($findkey!='')
        {
            $query.=" And (u.title like '%".str_replace(' ','%',$findkey) ."%')";
        }
        if(intval($subject) > 0){

            $query.=" and u.subjectid='".intval($subject)."'";

        }
        if(intval($city)>0){
            $query.=" and (u.cityid='".intval($city)."')";
        }
        if(intval($lophoc)>0){
            $query.=" and (u.lophoc='".intval($lophoc)."')";
        }
        $query.= " ORDER BY u.id DESC";
        $total=$this->db->query($query)->num_rows();
        $query.=" limit ".$page.",".$perpage;

        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {
            foreach($sql1->result() as $items)
            {
                $catlink[] =		$items;
            }

        }
        return array('data'=>$catlink,'total'=>$total) ;
    }
		function gettieudungdiem()
		{
		 $query="select sum(c.Price) as tongdiem,
							SUM(CASE WHEN c.Type=1 THEN c.Price END) AS diemfree,
SUM(CASE WHEN c.Type=2 THEN c.Price END) AS diemdung,
SUM(CASE WHEN c.Type=5 THEN c.Price END) AS diemmua
							from `logpoint` as c" ;
							$sql1=	$this->db->query($query);
			$catlink="";
			if($sql1->num_rows() >0)
			{
					$catlink=$sql1->row();
					// cap nhat so du

			}
			return $catlink ;
		}
		function gettieudungtien()
		{
			 $query="select SUM(Balance) as tongtien from balance" ;
							$sql1=	$this->db->query($query);
			$catlink="";
			if($sql1->num_rows() >0)
			{
					$catlink=$sql1->row();
					// cap nhat so du

			}
			return $catlink ;
		}

		function getthongkediem($fromdate,$todate)
		{
		 $query="select sum(c.Price) as tongdiem,
							SUM(CASE WHEN c.Type=1 THEN c.Price END) AS diemfree,
SUM(CASE WHEN c.Type=2 THEN c.Price END) AS diemdung,
SUM(CASE WHEN c.Type=5 THEN c.Price END) AS diemmua
							from `logpoint` as c
where CreateDate>='".$fromdate."' and CreateDate<'".$todate."'" ;
							$sql1=	$this->db->query($query);
			$catlink="";
			if($sql1->num_rows() >0)
			{
					$catlink=$sql1->row();
					// cap nhat so du

			}
			return $catlink ;
		}
		function getthongketientien()
		{
			 $query="select SUM(Balance) as tongtien from balance" ;
							$sql1=	$this->db->query($query);
			$catlink="";
			if($sql1->num_rows() >0)
			{
					$catlink=$sql1->row();
					// cap nhat so du

			}
			return $catlink ;
		}
}
?>
