<?php
/**
 * Created by PhpStorm.
 * User: hungha
 * Date: 5/10/19
 * Time: 09:54
 */

class site_model_app extends Model
{
    function site_model_app(){
        parent::Model();
    }

    function config_json_model(){
        $ar_all = array();
        //city
        $this->db->select("cit_id,cit_name");
        $this->db->order_by("cit_count DESC");
        $qr_city = $this->db->get("city");
        $ar_all["city"] = $qr_city->result_array();
        //category
        $this->db->select("cat_id,cat_name");
        $qr_cat = $this->db->get("category");
        $ar_all["cate"] = $qr_cat->result_array();
        //subject
        $this->db->select("ID,SubjectName,SubjectType");
        $qr_subject = $this->db->get("subject");
        $ar_all["subject"] = $qr_subject->result_array();
        //class
        $this->db->select("id,name");
        $qr_class = $this->db->get("lophoc");
        $ar_all["class"] = $qr_class->result_array();
        //teacher type
        $this->db->select("ID,NameType");
        $qr_class = $this->db->get("teachtype");
        $ar_all["teachtype"] = $qr_class->result_array();
        echo str_replace('\r\n','',json_encode($ar_all));
    }

    function get_list_teacher_outstanding_model($page,$perpage){
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
                ORDER BY u.CreateDate desc LIMIT ".$page.",".$perpage;
        $db_qr = $this->db->query($query);
        echo json_encode($db_qr->result());
    }

    function GetTopClassByMoney($page,$perpage)
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
        $query.=" where t.ClassTitle <>'' and t.`Active`=1 and u.Active=1 order by t.UpdateDate desc LIMIT ".$page.",".$perpage;

        $db_qr = $this->db->query($query);
        echo json_encode($db_qr->result());
    }

    function GetListClassBySearchTotal($keyword,$subject,$topic,$place,$type,$sex,$class,$page,$perpage)
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
        if(!empty($keyword) && strtolower($keyword)!='all'){
            $query.=" and t.ClassTitle like '%".str_replace(' ','%',$keyword)."%'";
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
        $query.=" limit ".$page.",".$perpage;

//        echo $query;
//        die();

        $db_qr = $this->db->query($query);
        $tg1=array();
//        if($db_qr->num_rows() > 0)
//        {
//
//            $tg1=$db_qr->num_rows();
//
//        }
        echo json_encode($db_qr->result());
    }

    function GetListTeacherBySearch($keyword,$subject,$topic,$place,$type,$sex,$order,$page,$perpage)
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
        if(!empty($keyword) && strtolower($keyword)!='all'){
            $query.=" and (ut.TitleView like '%".str_replace(' ','%',$keyword)."%' or u.`Name` like '%".str_replace(' ','%',$keyword)."%')";
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
//        var_dump($query);die();
        $total=$this->db->query($query)->num_rows();
        $query.=" LIMIT ".$page.",".$perpage;
        $db_qr = $this->db->query($query);
        $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        echo json_encode($db_qr->result());
//        return array('total'=>$total,'data'=>$tg1);
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
}