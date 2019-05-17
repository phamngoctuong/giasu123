<?php
class site extends Controller
{
	function site()
	{
		parent::Controller();
		$this->load->model('site_model');
		$this->load->helper('locdau');
        $this->load->helper('resize');
		$this->load->helper('images');
		$this->load->helper('device');
	}
	function index()
	{

			if($_SESSION['UserInfo'] !=''){
					$tg=$_SESSION['UserInfo'];
					$userid=$tg['UserId'];
					$email=$tg['EmailAddress'];
					$usertype=$tg['Type'];
					if($usertype==0 || $usertype==1 || $usertype==3){
						$type=1;
					}elseif($usertype==4){
						$type=2;
					}
					$qrcheckactive="select Active from users where UserID=".$userid." ";
					$active=$this->db->query($qrcheckactive)->row()->Active;
					if($active!=1){
						$qr="select Status,Code from comfirmtable where UserID=".$userid." and Type IN(1,2) and Status=1";
						$check=$this->db->query($qr);
						if($check->num_rows()==0){
							$result= $this->site_model->UpdateAccuracyCode($userid,$type);
							if($result['kq']==true){
								$check2=$this->db->select('Username');
								$check2=$this->db->get_where('users',array('UserID'=>$userid))->row();
								if($type=1){
									$qr2="select Code from comfirmtable where UserID=".$userid." and Type=1 and Status=0";
								}else{
									$qr2="select Code from comfirmtable where UserID=".$userid." and Type=2 and Status=0";
								}
								$check3=$this->db->query($qr2)->row();

								redirect(site_url().'kichhoattaikhoan&c='.$check3->Code.'&u='.$check2->Username.'/confirmuser');
							}else{
								redirect(site_url().'kichhoattaikhoan&c=1&u=1/endconfirm');
							}
						}
					}
					if(empty($email)){
							if(intval($usertype)==1){
									redirect(site_url('mn-gia-su-cap-nhat-thong-tin'));
							}else if(intval($usertype)==0){
									redirect(site_url('mn-hv-thong-tin-ho-so'));
							}else if(intval($usertype)==3){
									redirect(site_url('mn-candi-updateinfo'));
							}
					}
			}
			$data['home'] = false;
			$sql=$this->site_model->gettblwidthid('tbl_meta',1);
			$data['meta_title']=$sql->title;
			$data['meta_key']=$sql->metakeywork;
			$data['meta_des']=$sql->metadesc;
			if(!empty($sql->name)){
					$data['metah1']=$sql->name;
			}else{
					$data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
			}
			//$phone='0913081237';
			//$arrphone=['phone_number'=>"'$phone'",'name'=>'test'];
			//$resultautocall=buildsendautocall($arrphone,'123456');
			$data['autocall']=$resultautocall;
			$data['tinmoinhat']=$this->site_model->GetListTeacher(8);
			//$data['toanlyhoa']=$this->site_model->GetListTeacherTLH(12);
			$data['vansudia']=$this->site_model->GetTopClassByMoney(6);
			//$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
			//$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
			$data['monhoc']=$this->site_model->ListSubject();
			$data['parttime']=$this->site_model->GetTopNewParttime(6);
			//$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
			//$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
			$data['canonical']=base_url();
			//$data['amp']=site_url('amp');
			$data['showsearch']=true;
			$data['robots']= 'index,follow';
			$data['content']='content';
			$data['classheader']='navbar navbar-default white bootsnav on no-full';
			$this->load->view('template',$data);
	}
    function generallogin()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        if(isset($_COOKIE['namephp'])&& $_COOKIE['namephp']!='' && $_SESSION['UserInfo']== ''){
            $result=$this->site_model->GetLoginTeacher($_COOKIE['namephp'],$_COOKIE['puphp']);
            if($result != ""){
                $ip = time();
                $remember=1;
                //$result=json_decode($result,true);
                //var_dump($result->UserId);die();
                $token = $this->site_model->create_token($result->UserID,$ip,$remember);

                $profileData = array(
                    "UserId" => $result->UserID,
                    "UserName" => $result->UserName,
                    "EmailAddress" => $result->Email,
                    "FullName" => $result->Name,
                    "Phone"=>$result->Phone,
                    "TokentKey" => $token,
                    "Type"=>$type
                );
                $_SESSION['UserInfo'] = $profileData;


            }
        }
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url().'dang-nhap-chung';
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='generallogin';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template1',$data);

    }
		function gioithieuchung(){
			$data['home'] = false;
			$data['showsearch']=false;
			$data['meta_title']="Giới thiệu công ty và website Vieclam123.vn";
			$data['meta_des']="Vieclam123.vn có sứ mệnh, tầm nhìn rõ ràng, giá trị và năng lực cốt lõi ưu việt hứa hẹn mang đến cho người dùng giá trị thật sự hữu ích và tiện lợi.";
			$data['canonical']=base_url()."gioi-thieu-chung";
			$data['robots']='index,follow';
			$data['content'] ='gioithieuchung';
			$data['classheader']='navbar navbar-default white bootsnav on no-full';
			$this->load->view('template',$data);
		}
		function thoathuansd(){
			$data['home'] = false;
			$data['showsearch']=false;
			$data['meta_title']="Thỏa thuận sử dụng website Vieclam123.vn cần biết!";
			$data['meta_des']="Thỏa thuận sử dụng website Vieclam123.vn giúp cho gia sư, phụ huynh, nhà tuyển dụng và ứng viên có thể sử dụng tính năng website một cách tốt nhất.";
			$data['canonical']=base_url()."thoa-thuan-su-dung";
			$data['robots']='index,follow';
			$data['content'] ='thoathuansd';
			$data['classheader']='navbar navbar-default white bootsnav on no-full';
			$this->load->view('template',$data);
		}
		function thongtincb(){
			$data['home'] = false;
			$data['showsearch']=false;
			$data['meta_title']="Thông tin cần biết sử dụng website Vieclam123.vn hiệu quả";
			$data['meta_des']="Chi tiết thông tin cần biết giúp gia sư, phụ huynh, ứng viên và nhà tuyển dụng có thể sử dụng website Vieclam123.vn một cách hiệu quả nhất.";
			$data['canonical']=base_url()."thong-tin-can-biet";
			$data['robots']='index,follow';
			$data['content'] ='thongtincb';
			$data['classheader']='navbar navbar-default white bootsnav on no-full';
			$this->load->view('template',$data);
		}
		function quytrinh_gttc(){
			$data['home'] = false;
			$data['showsearch']=false;
			$data['meta_title']="Giải quyết tranh chấp các bên | Vieclam123.vn";
			$data['meta_des']="Quy trình giải quyết tranh chấp giữa các bên khi sử dụng thông tin trên website Vieclam123.vn cho gia sư, quý phụ huynh, ứng viên và nhà tuyển dụng.";
			$data['canonical']=base_url()."quy-trinh-giai-quyet-tranh-chap";
			$data['robots']='index,follow';
			$data['content'] ='quytrinh_gttc';
			$data['classheader']='navbar navbar-default white bootsnav on no-full';
			$this->load->view('template',$data);
		}
		function quytrinhbm(){
			$data['home'] = false;
			$data['showsearch']=false;
			$data['meta_title']="Quy định bảo mật, sử dụng thông tin website Vieclam123.vn";
			$data['meta_des']="Chi tiết chính sách bảo mật và quy định sử dụng thông tin của trang Vieclam123.vn dành cho phụ huynh, gia sư, ứng viên và nhà tuyển dụng.";
			$data['canonical']=base_url()."quy-trinh-bao-mat";
			$data['robots']='index,follow';
			$data['content'] ='quytrinhbm';
			$data['classheader']='navbar navbar-default white bootsnav on no-full';
			$this->load->view('template',$data);
		}
    function generalregister()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng ký chung";
		$data['meta_key']="Đăng ký gia sư";
		$data['meta_des']="Đăng ký gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url().'dang-ky-chung';
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='generalregister';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template1',$data);

    }
    function supportteacherlogin()
    {
        $data['home'] = false;
		$sql=$this->site_model->gettblwidthid('tbl_meta',1);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }

        //$data['tinmoinhat']=$this->site_model->GetListTeacher(18);
        //$data['toanlyhoa']=$this->site_model->GetListTeacherTLH(12);
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
        $data['monhoc']=$this->site_model->ListSubject();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."huong-dan-dang-nhap-gia-su";
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='supportteacherlogin';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template',$data);
    }
    function supportteacherregister()
    {
        $data['home'] = false;
		$sql=$this->site_model->gettblwidthid('tbl_meta',1);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }

        //$data['tinmoinhat']=$this->site_model->GetListTeacher(18);
        //$data['toanlyhoa']=$this->site_model->GetListTeacherTLH(12);
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
        $data['monhoc']=$this->site_model->ListSubject();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."huong-dan-dang-ky-gia-su";
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='supportteacherregister';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template',$data);
    }
    function supportusersregister()
    {
        $data['home'] = false;
		$sql=$this->site_model->gettblwidthid('tbl_meta',1);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }

        //$data['tinmoinhat']=$this->site_model->GetListTeacher(18);
        //$data['toanlyhoa']=$this->site_model->GetListTeacherTLH(12);
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
        $data['monhoc']=$this->site_model->ListSubject();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."huong-dan-dang-ky-tk";
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='supportusersregister';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template',$data);
    }
    function supportuserslogin()
    {
        $data['home'] = false;
		$sql=$this->site_model->gettblwidthid('tbl_meta',1);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }

        //$data['tinmoinhat']=$this->site_model->GetListTeacher(18);
        //$data['toanlyhoa']=$this->site_model->GetListTeacherTLH(12);
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
        $data['monhoc']=$this->site_model->ListSubject();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."huong-dan-dang-nhap-tk";
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='supportuserslogin';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template',$data);
    }
    function ChangeNewPass($u)
    {
        $data['username']=$u;
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."lay-lai-mat-khau";
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='changenewpass';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template1',$data);
    }
    function teacherlogin()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."gia-su-dang-nhap";
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='teacherlogin';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template1',$data);

    }
    function teacherforgot()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."gia-su-lay-lai-mat-khau";
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='teacherforgot';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template1',$data);

    }
    function usersforgot()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."tk-lay-lai-mat-khau";
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='usersforgot';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template1',$data);

    }
    function forgotsuccessall()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."lay-lai-mk-thanh-cong";
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='forgotsuccessall';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template1',$data);

    }
    function userlogin()
    {
		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."phu-huynh-dang-nhap";
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='userlogin';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template1',$data);
    }
    function candidatelogin()
    {
		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."ưng-vien-dang-nhap";
		//$data['amp']=site_url('amp');
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='candidatelogin';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template1',$data);
    }
    function teacherloginmanager()
    {
		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."giao-vien-manager";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
		//$data['amp']=site_url('amp');
        $data['lopday']=$this->site_model->getcountclassvsuser($userid);
        $data['classsave']=$this->site_model->getcountclasssave($userid);
        $data['classinvite']=$this->site_model->getcountclassinvite($userid);
        $data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='teacherloginmanager';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnteachsearchuv()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-giao-vien-tim-lop-day";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['monhoc']=$this->site_model->ListSubject();
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnteachsearchuv';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnteacherchangepass()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mm-giao-vien-thay-doi-mk";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        //$data['monhoc']=$this->site_model->ListSubject();
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnteacherchangepass';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnteachervsclass()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-danh-sach-lop-de-nghi-day";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['uservsclass']=$this->site_model->getfulluservsclass($userid);
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnteachervsclass';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnclassvsteacher()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-danh-sach-lop-moi-day";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['uservsclass']=$this->site_model->getfullclassvsuser($userid);
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnclassvsteacher';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnteachervsclassactive()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-danh-sach-lop-da-day";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['uservsclass']=$this->site_model->getfulluservsclassactive($userid);
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnteachervsclassactive';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnteachersaveclass()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-danh-sach-lop-da-luu";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['monhoc']=$this->site_model->ListSubject();
        $data['uservsclass']=$this->site_model->getfullteachersaveclass($userid);
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnteachersaveclass';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnteacherupdateinfo()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['mess']='Bạn vui lòng điền đầy đủ các thông tin bắt buộc + email nhé';
		$data['canonical']=base_url()."mn-gia-su-cap-nhat-thong-tin";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['teachtype']=$this->site_model->GetTeacherType();
        $data['monhoc']=$this->site_model->ListSubject();
        $data['info']=$this->site_model->GetInfoTeacher($userid);
        $kq=$this->site_model->getusersubject($userid);
        $data['usersubject']=$kq['id'];
        $data['subjectname']=$kq['name'];
        $data['usertopic']=$this->site_model->getusertopic($userid);
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnteacherupdateinfo';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnteacherrecharge()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['canonical']=base_url()."mn-gia-su-nap-tien";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['lstbank']=$this->site_model->GetListBank();
        $data['bankused']=$this->site_model->GetBankUsed();
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnteacherrecharge';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mnteachercashout()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['canonical']=base_url()."mn-gia-su-rut-tien";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnteachercashout';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mnteacherbonus()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['canonical']=base_url()."mn-gia-su-qua-tang-km";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnteacherbonus';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mnteachsearchbyprovince()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-giao-vien-tim-lop-day-theo-tt";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['tinhthanh']=$this->site_model->getprovincebykey('');
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnteachsearchbyprovince';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnteachsearchuvbysubject()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-giao-vien-tim-lop-day-theo-mon";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['monhoc']=$this->site_model->ListSubject();
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnteachsearchuvbysubject';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function usersloginmanager()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."phu-huynh-manager";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
		//$data['amp']=site_url('amp');
        $data['giasuphuhop']=$this->site_model->countteacherfitclass($userid);
        $data['giaovienluu']=$this->site_model->countteachersave($userid);
        $data['teacherinvite']=$this->site_model->countteacheinvite($userid);
        $data['topteacherinvite']=$this->site_model->getlistteachersavebyuserid($userid);
        $data['topteachsave']=$this->site_model->getlistteacherinvitebyuserid($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='usersloginmanager';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnusersteachersave()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-hv-gia-su-da-luu";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }

        $data['giasudaluu']=$this->site_model->getpageteachersavebyuserid($userid,1);
        $data['giaovienluu']=$this->site_model->countteachersave($userid);
        //$data['teacherinvite']=$this->site_model->countteacheinvite($userid);
        //$data['topteacherinvite']=$this->site_model->getlistteachersavebyuserid($userid);
        //$data['topteachsave']=$this->site_model->getlistteacherinvitebyuserid($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnusersteachersave';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnusersinviteteacher()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-hv-gia-su-moi-day";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }

        $data['giasudaluu']=$this->site_model->getpageteacherinvitebyuserid($userid,1);
        $data['giaovienluu']=$this->site_model->countteacheinvite($userid);
        //$data['teacherinvite']=$this->site_model->countteacheinvite($userid);
        //$data['topteacherinvite']=$this->site_model->getlistteachersavebyuserid($userid);
        //$data['topteachsave']=$this->site_model->getlistteacherinvitebyuserid($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnusersinviteteacher';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mnusersfitteacher()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-hv-gia-su-phu-hop";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }

        $data['giasudaluu']=$this->site_model->getpageteacherfitbyuserid($userid,1);
        $data['giaovienluu']=$this->site_model->countteacherfitclass($userid);
        //$data['teacherinvite']=$this->site_model->countteacheinvite($userid);
        //$data['topteacherinvite']=$this->site_model->getlistteachersavebyuserid($userid);
        //$data['topteachsave']=$this->site_model->getlistteacherinvitebyuserid($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnusersfitteacher';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mnuserssuggestteacher()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-hv-gia-su-de-nghi-day";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }

        $data['giasudaluu']=$this->site_model->getpageteachersuggestbyuserid($userid,1);
        //$data['giaovienluu']=$this->site_model->countteacherfitclass($userid);
        //$data['teacherinvite']=$this->site_model->countteacheinvite($userid);
        //$data['topteacherinvite']=$this->site_model->getlistteachersavebyuserid($userid);
        //$data['topteachsave']=$this->site_model->getlistteacherinvitebyuserid($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnuserssuggestteacher';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mnuserschangepass()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-hv-thay-doi-mk";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        //$data['monhoc']=$this->site_model->ListSubject();
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnuserschangepass';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnuserssetup()
    {
		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-hv-cai-dat-ho-so";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['uinfo']=$this->site_model->GetUserInfoByUserID($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnuserssetup';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mnusersinfomation()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['mess']='Bạn vui lòng điền đầy đủ các thông tin bắt buộc + email nhé!';
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-hv-thong-tin-ho-so";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['uinfo']=$this->site_model->GetUserInfoByUserID($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnusersinfomation';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mnusersclassmanager()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-hv-quan-ly-lop-hoc";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['uclass']=$this->site_model->getlistclassbyuser($userid,1);
        $countclass=$this->site_model->getcountclassbyuser($userid);
        $data['countclass']=$countclass->solophoc;
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnusersclassmanager';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mnuserscreateorupdateclass()
    {
        $idclass=$this->uri->segment(2);
        if(empty($idclass)||intval($idclass)==0){
            $idclass=0;
        }else{
            $idclass=intval($idclass);
        }
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        $data['classid']=$idclass;
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-hv-dang-tin";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['uclass']=$this->site_model->GetFirstClassByUserClassID($idclass,$userid);
        $data['lstitem']=$this->site_model->GetTeacherType(12);
        $data['monhoc']=$this->site_model->ListSubject();
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnuserscreateorupdateclass';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mnusersrecharge()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['canonical']=base_url()."mn-gia-su-nap-tien";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['lstbank']=$this->site_model->GetListBank();
        $data['bankused']=$this->site_model->GetBankUsed();
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnusersrecharge';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mnuserscashout()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['canonical']=base_url()."mn-gia-su-rut-tien";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnuserscashout';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mnusersbonus()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['canonical']=base_url()."mn-gia-su-qua-tang-km";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mnusersbonus';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }

    //candi manager
    function candiloginmanager()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."phu-huynh-manager";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['comdetail']=$this->site_model->getcandidatebyID($userid);
		//$data['amp']=site_url('amp');
        //$data['giasuphuhop']=$this->site_model->countteacherfitclass($userid);
        //$data['giaovienluu']=$this->site_model->countteachersave($userid);
        //$data['teacherinvite']=$this->site_model->countteacheinvite($userid);
        //$data['topteacherinvite']=$this->site_model->getlistteachersavebyuserid($userid);
        //$data['topteachsave']=$this->site_model->getlistteacherinvitebyuserid($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='candiloginmanager';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mncandisugguestjobs()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."phu-huynh-manager";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['uservsclass']=$this->site_model->GetJobSaveByUser($userid,1);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='candisugguestjobs';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mncandisavejobs()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."phu-huynh-manager";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['uservsclass']=$this->site_model->GetJobSaveByUser($userid,2);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='candisavejobs';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mncandiupdateinfo()
    {
				$data['home'] = false;
				$data['meta_title']="Đăng nhập chung";
				$data['meta_key']="Đăng nhập gia sư";
				$data['meta_des']="Đăng nhập gia sư";
				$data['mess']='Bạn vui lòng điền đầy đủ các thông tin bắt buộc + email nhé ^^';
				$data['canonical']=base_url()."mn-gia-su-cap-nhat-thong-tin";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
						$data['userinfo']=$this->site_model->getcandidatebyID(intval($userid));
		        $data['teachtype']=$this->site_model->GetTeacherType();
		        $data['monhoc']=$this->site_model->ListSubject();
		        $data['info']=$this->site_model->GetInfoTeacher($userid);
		        $kq=$this->site_model->getusersubject($userid);
		        $data['usersubject']=$kq['id'];
		        $data['subjectname']=$kq['name'];
		        $data['usertopic']=$this->site_model->getusertopic($userid);
		        $data['showsearch']=true;
						$data['robots']= 'noindex,nofollow';
		        $data['content']='mncandiupdateinfo';
		        $data['classheader']='navbar navbar-default white bootsnav on no-full';
		        $this->load->view('templatemanager',$data);
        }else{
					redirect(site_url().'dang-nhap-chung');
				}
    }
    function mncandichangepass()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";

		$data['canonical']=base_url()."mn-hv-thay-doi-mk";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }

        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mncandichangepass';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }

    function mncandirecharge()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['canonical']=base_url()."mn-gia-su-nap-tien";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['lstbank']=$this->site_model->GetListBank();
        $data['bankused']=$this->site_model->GetBankUsed();
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mncandirecharge';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mncandicashout()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['canonical']=base_url()."mn-gia-su-rut-tien";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mncandicashout';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mncandibonus()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['canonical']=base_url()."mn-gia-su-qua-tang-km";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mncandibonus';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }

    // company manager
    function companyloginmanager()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."phu-huynh-manager";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
		//$data['amp']=site_url('amp');

        $data['comdetail']=$this->site_model->GetDetailCompanyByID($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='companyloginmanager';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
		function companymanagernewsjobs()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."phu-huynh-manager";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
				$companyid=$this->db->select('usc_id');
				$companyid=$this->db->get_where('user_company',array('UserID'=>$userid))->row();
        $data['tintuyendung']=$this->site_model->GetJobbyCongTy($userid);
        //$data['giaovienluu']=$this->site_model->countteachersave($userid);
        //$data['teacherinvite']=$this->site_model->countteacheinvite($userid);
        //$data['topteacherinvite']=$this->site_model->getlistteachersavebyuserid($userid);
        //$data['topteachsave']=$this->site_model->getlistteacherinvitebyuserid($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='companymanagernewsjobs';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function companyaddnewjobs()
    {
        $idclass=$this->uri->segment(2);
        if(empty($idclass)||intval($idclass)==0){
            $idclass=0;
        }else{
            $idclass=intval($idclass);
        }
		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."phu-huynh-manager";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
						$data['newid']=$idclass;
		        $comdetail=$this->site_model->GetDetailCompanyByID($userid);
		        $data['tintuyendung']=$this->site_model->detailjobbycreate($idclass,$comdetail->usc_id);
		        $data['showsearch']=true;
						$data['robots']= 'noindex,nofollow';
		        $data['content']='companyaddnewjobs';
		        $data['classheader']='navbar navbar-default white bootsnav on no-full';
		        $this->load->view('templatemanager',$data);
        }
				else{
					redirect(site_url().'dang-nhap-chung');
				}

    }
    function mncompanycomfirmcandi()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."phu-huynh-manager";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
		$data['candiamply']=$this->site_model->getcandiamply($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mncompanycomfirmcandi';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mncompanysavecandi()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."phu-huynh-manager";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
		$data['candisave']=$this->site_model->getcandicomsave($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mncompanysavecandi';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mncompanyupdateinfo()
    {
		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."mn-gia-su-cap-nhat-thong-tin";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['itemcom']=$this->site_model->GetDetailCompanyByID($userid);
        //$data['userinfo']=$this->site_model->getcandidatebyID(intval($userid));
        //$data['teachtype']=$this->site_model->GetTeacherType();
        //$data['monhoc']=$this->site_model->ListSubject();
        //$data['info']=$this->site_model->GetInfoTeacher($userid);
        $kq=$this->site_model->getusersubject($userid);
        $data['usersubject']=$kq['id'];
        $data['subjectname']=$kq['name'];
        //$data['usertopic']=$this->site_model->getusertopic($userid);
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mncompanyupdateinfo';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }
    function mncompanychangepass()
    {

		$data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";

		$data['canonical']=base_url()."mn-hv-thay-doi-mk";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }

        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mncompanychangepass';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);

    }

    function mncompanyrecharge()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['canonical']=base_url()."mn-gia-su-nap-tien";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['lstbank']=$this->site_model->GetListBank();
        $data['bankused']=$this->site_model->GetBankUsed();
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mncompanyrecharge';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mncompanycashout()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['canonical']=base_url()."mn-gia-su-rut-tien";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mncompanycashout';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }
    function mncompanybonus()
    {
        $data['home'] = false;
		$data['meta_title']="Đăng nhập chung";
		$data['meta_key']="Đăng nhập gia sư";
		$data['meta_des']="Đăng nhập gia sư";
		$data['canonical']=base_url()."mn-gia-su-qua-tang-km";
        $userid=0;
        if($_SESSION['UserInfo'] !=''){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
        }
        $data['showsearch']=true;
		$data['robots']= 'noindex,nofollow';
        $data['content']='mncompanybonus';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('templatemanager',$data);
    }


		function ForTeacher($order)
    {
        $data['home'] = false;
		$sql=$this->site_model->gettblwidthid('tbl_footer',2);
		$data['meta_title']=$sql->meta_title;
		$data['meta_key']=$sql->meta_key;
		$data['meta_des']=$sql->meta_des;
    if(!empty($sql->name)){
        $data['metah1']=$sql->name;
    }else{
        $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    }

		$monhoc=$this->db->select('ID,SubjectName');
		$monhoc=$this->db->get('subject')->result();
		// $this->site_model->pr($monhoc);
		foreach ($monhoc as &$valueSubject) {
			$idsubject=$valueSubject->ID;
			$linkSubject[]="<a rel='nofollow' href=".base_url()."tim-lop-gia-su-".vn_str_filter($valueSubject->SubjectName)."-s$idsubject"."c0r0.html>Lớp cần gia sư ".$valueSubject->SubjectName." </a>";
		}
		//lớp học.
		$lophoc=$this->db->select('id,name');
		$lophoc=$this->db->get('lophoc')->result();
		foreach ($lophoc as $valueClass) {
			$idClass=$valueClass->id;
			$linkClass[]="<a rel='nofollow' href=".base_url()."tim-lop-gia-su-".vn_str_filter($valueClass->name)."-s0c0r$idClass.html>Lớp cần gia sư ".$valueClass->name." </a>";
		}
		//tỉnh thành.
		for($i=1;$i<64;$i++){
			$tinhthanh=Getcitybyindex($i); //get tỉnh thành
			$linkCity[]="<a rel='nofollow' href=".base_url()."tim-lop-gia-su-tai-".vn_str_filter($tinhthanh)."-s0c$i"."r0.html>Lớp cần gia sư tại ".$tinhthanh." </a>";
		}
		$data['linkClass']=$linkClass;
		$data['linkSubject']=$linkSubject;
		$data['linkCity']=$linkCity;
    $data['monhoc']=$this->site_model->ListSubject();

		$data['canonical']=site_url('tim-lop-gia-su');

		$data['robots']= 'index,follow';
        $data['content']='forteacher';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['showsearch']=false;
        $data['cssbody']='customsl'	;
        $data['linkseo']=$this->site_model->getitemSEO(2);

				if(!isset($order)||empty($order)){
		        $order='last';
		    }
				if(!empty($order) && $order!='last'){
					$data['robots']= 'noindex,nofollow';
				}
				$data['order']=$order;
				$data['newitem']=$this->site_model->GetListclass($order,20);
				$link=base_url()."tim-lop-gia-su&order=".$order;
				$this->load->library('pagination');
		    $config['total_rows'] = $total;
				$config['per_page'] = $perpage;
				$config['uri_segment'] =2;
				$config['next_link'] = '<i class="fa fa-angle-right"></i>';
				$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
				$config['num_links'] = 4;
				$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
				$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
				$config['base_url']=$link;
				$this->pagination->initialize($config);
				$data['pagination']= $this->pagination->create_links();
				$data['selectbox']=base_url()."tim-lop-gia-su&order=";
				$data['lstitem']=$this->site_model->AllGetTopClassByMoney(8);
        $this->load->view('template',$data);
    }
		function ForUsers($order)
    {
        $data['home'] = false;
				$sql=$this->site_model->gettblwidthid('tbl_footer',3);
				$data['meta_title']=$sql->meta_title;
				$data['meta_key']=$sql->meta_key;
				$data['meta_des']=$sql->meta_des;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $data['monhoc']=$this->site_model->ListSubject();

				//thêm link liên quan:
				//môn học
				$monhoc=$this->db->select('ID,SubjectName');
				$monhoc=$this->db->get('subject')->result();
				// $this->site_model->pr($monhoc);
				foreach ($monhoc as &$valueSubject) {
					$idsubject=$valueSubject->ID;
					$linkSubject[]="<a rel='nofollow' href=".base_url()."gia-su-".vn_str_filter($valueSubject->SubjectName)."-s$idsubject"."c0r0.html>Gia sư ".$valueSubject->SubjectName." </a>";
				}
				//lớp học.
				$lophoc=$this->db->select('id,name');
				$lophoc=$this->db->get('lophoc')->result();
				foreach ($lophoc as $valueClass) {
					$idClass=$valueClass->id;
					$linkClass[]="<a rel='nofollow' href=".base_url()."gia-su-".vn_str_filter($valueClass->name)."-s0c0r$idClass.html>Gia sư ".$valueClass->name." </a>";
				}
				//tỉnh thành.
				for($i=1;$i<64;$i++){
					$tinhthanh=Getcitybyindex($i); //get tỉnh thành
					$linkCity[]="<a rel='nofollow' href=".base_url()."gia-su-tai-".vn_str_filter($tinhthanh)."-s0c$i"."r0.html>Gia sư tại ".$tinhthanh." </a>";
				}

				if(!isset($order)||empty($order)){
		        $order='last';
		    }

		    $page=$start_row=$this->uri->segment(2);
		    $perpage=20;
		    if(empty($page)||intval($page)==0){
		        $page=0;
		    }else{
		        $page=intval($page);
		    }
		    if($page <= 10){
		      $data['robots']= 'index,follow';
		    }else{
		       $data['robots']= 'noindex,follow';
		    }
		    $keywork='';
		    $subject=0;$topic=0;$place=0;$type=0;$sex=0;
		    $data['keywork']=$keywork;
		    $result=$this->site_model->GetListTeacherBySearch($keywork,$subject,$topic,$place,$type,$sex,$order,$page,$perpage);


				$data['linkSubject']=$linkSubject;
				$data['linkClass']=$linkClass;
				$data['linkCity']=$linkCity;
				$link=base_url()."tim-gia-su&order=".$order;
				$data['lstitem']=$result['data'];
				$this->load->library('pagination');
        $config['total_rows'] = $total;
				$config['per_page'] = $perpage;
				$config['uri_segment'] =2;
				$config['next_link'] = '<i class="fa fa-angle-right"></i>';
				$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
				$config['num_links'] = 4;
				$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
				$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
		    $config['base_url']=$link;
				$this->pagination->initialize($config);
		    $data['total']=$total;
				$data['order']=$order;
				$data['start_row']= $page;
		    $data['pagination']= $this->pagination->create_links();

				$data['selectbox']=base_url()."tim-gia-su&order=";
				$data['canonical']=base_url().'tim-gia-su';
				$data['robots']= 'index,follow';
				if(!empty($order) && $order!='last'){
					$data['robots']= 'noindex,nofollow';
				}
		    $data['content']='forusers';
		    $data['classheader']='navbar navbar-default white bootsnav on no-full';
		    $data['showsearch']=false;
		    $data['cssbody']='customsl'	;
		    $data['linkseo']=$this->site_model->getitemSEO(3);

				$content_thu=$data['linkseo']->content_thu;
				$stt1=strpos($content_thu,'src="');
				$start=$stt1+5;
				$noidung1=substr($content_thu,$start);
				$stt2=strpos($noidung1,'"');
				$linkimgog=substr($noidung1,0,$stt2);
				$data['imageog']='http://localhost/ubuntu/giasu123'.$linkimgog;

		    $this->load->view('template',$data);
    }
    function searchclass()
    {
			if(!empty($_POST)){
				$key=$_POST['key'];
        $subject=$_POST['subject'];
        $topic=$_POST['topic'];
        $place=$_POST['place'];
        $type=$_POST['type'];
        $sex=$_POST['sex'];
        $order=$_POST['order'];
        if(!empty($key)){
        $link=base_url()."giao-vien&key=".$key."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&order=".$order;
            $result=['kq'=>true,'data'=>$link];
        }else{
            $result=['kq'=>false,'data'=>''];
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}
    }
    function tutorresultteacher($keywork,$subject,$topic,$place,$type,$sex,$order)
    {

        $page=$start_row=$this->uri->segment(2);
        $data['home'] = false;
        $data['showsearch']=true;
		$sql=$this->site_model->gettblwidthid('tbl_meta',1);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $perpage=10;
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }
        if($page <= 10){
					$data['robots']= 'noindex,nofollow';
        }else{
           $data['robots']= 'noindex,nofollow';
        }
        $data['keywork']=$keywork;
        if($keywork=='all'|| empty($keywork))
        {
            $key='';
        }else{
            $key=$keywork;
        }
        $data['keyhome']=1;
        $data['keyfilter']=['keywork'=>$key,'subject'=>$subject,'topic'=>$topic,'place'=>$place,'type'=>$type,'sex'=>$sex];
        $result=$this->site_model->GetListTeacherBySearch($keywork,$subject,$topic,$place,$type,$sex,$order,$page,$perpage);

        $link=base_url()."giao-vien&key=".$keywork."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&order=".$order;
        $data['lstitem']=$result['data'];
        $this->load->library('pagination');
        $config['total_rows'] = $result['total'];
		$config['per_page'] = $perpage;
		$config['uri_segment'] =2;
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['num_links'] = 4;
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url']=$link;
		$this->pagination->initialize($config);
        $data['total']=$result['total'];
        $data['order']=$order;
		$data['start_row']= $page;
        $data['pagination']= $this->pagination->create_links();
        $data['monhoc']=$this->site_model->ListSubject();
        $data['chude']=$this->site_model->GetTeacherFeature();
        $data['districk']=$this->site_model->CountTeacherbyCity();
        $data['lstonline']=$this->site_model->GetTeacherOnline(10);
        $data['selectbox']=base_url()."giao-vien&key=".$keywork."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&order=";
		$data['canonical']=base_url()."giao-vien";

		$data['robots']= 'noindex,nofollow';
        $data['content']='tutorresultteacher';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']=''	;//customsl
        $data['showsupport']=true;
        $this->load->view('template',$data);
    }

    function searchteacher()
    {
        $key=$_POST['key'];
        $subject=$_POST['subject'];
        $topic=$_POST['topic'];
        $place=$_POST['place'];
        $type=$_POST['type'];
        $sex=$_POST['sex'];
if(!empty($_POST)){
        //var_dump($key,$subject,$topic,$place,$type);die();
        $link=base_url()."tim-lop-hoc&key=".$key."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&class=0";
        $result=['kq'=>true,'data'=>$link];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                  show_404();
            }
    }
		function searchhome()
    {

				$key=$_POST['key'];
        $subject=$_POST['subject'];
        $place=$_POST['place'];
				$lophoc=$_POST['class'];
        $tinhthanh="";
        $monhoc="";
        if(empty($key)&&empty($lophoc)&&empty($subject)&&empty($place)){
            redirect(site_url().'site/page404');
        }
        if(intval($subject)>0){
            $monhoc=$this->site_model->selectsubjectbyid(intval($subject));
        }
        if(intval($place)>0){
					$tinhthanh=$this->site_model->SelectProvinceByID1(intval($place));
				}
				if(intval($lophoc)>0){
					$class=$this->db->get_where('lophoc',array('id'=>$lophoc))->row();
				}
        $_SESSION['filterhome']=['key'=>$key,'sub'=>$subject,'place'=>$place];
        $link='';
        $result=['kq'=>false,'data'=>$link];
        if(intval($key)==1){
					if(intval($lophoc)>0){ // nếu có giá trị tham số lớp học truyền vào.
						if(intval($subject)>0 && intval($place)>0){
								$link=base_url()."gia-su-".vn_str_filter($monhoc->SubjectName)."-".vn_str_filter($class->name)."-tai-".vn_str_filter($tinhthanh->cit_name)."-s$subject"."c$place"."r$lophoc.html";
						}else if((intval($subject)==0) && (intval($place)==0)){
								$link=base_url()."gia-su-".vn_str_filter($class->name)."-s$subject"."c$place"."r$lophoc.html";
						}else if((intval($subject)> 0) && (intval($place)==0)){
								$link=base_url()."gia-su-".vn_str_filter($monhoc->SubjectName)."-".vn_str_filter($class->name)."-s$subject"."c$place"."r$lophoc.html";
						}else if((intval($subject)== 0) && (intval($place)> 0)){
								$link=base_url()."gia-su-".vn_str_filter($class->name)."-tai-".vn_str_filter($tinhthanh->cit_name)."-s$subject"."c$place"."r$lophoc.html";
						}
					}else{
						if(intval($subject)>0 && intval($place)>0){
								$link=base_url()."gia-su-".vn_str_filter($monhoc->SubjectName)."-tai-".vn_str_filter($tinhthanh->cit_name)."-s$subject"."c$place"."r$lophoc.html";
						}else if((intval($subject)==0) && (intval($place)==0)){
								$link=base_url()."tat-ca-giao-vien";
						}else if((intval($subject)> 0) && (intval($place)==0)){
								$link=base_url()."gia-su-".vn_str_filter($monhoc->SubjectName)."-s$subject"."c$place"."r$lophoc.html";
						}else if((intval($subject)== 0) && (intval($place)> 0)){
								$link=base_url()."gia-su"."-tai-".vn_str_filter($tinhthanh->cit_name)."-s$subject"."c$place"."r$lophoc.html";
						}
					}

        }elseif($key==2){
					if(intval($lophoc)>0){
						if(intval($subject)>0 && intval($place)>0){
                $link=base_url()."tim-lop-gia-su-".vn_str_filter($monhoc->SubjectName)."-".vn_str_filter($class->name)."-tai-".vn_str_filter($tinhthanh->cit_name)."-s$subject"."c$place"."r$lophoc.html";
            }else if((intval($subject)==0) && (intval($place)==0)){
								$link=base_url()."tim-lop-gia-su-".vn_str_filter($class->name)."-s$subject"."c$place"."r$lophoc.html";
            }else if((intval($subject)> 0) && (intval($place)==0)){
                $link=base_url()."tim-lop-gia-su-".vn_str_filter($monhoc->SubjectName)."-".vn_str_filter($class->name)."-s$subject"."c$place"."r$lophoc.html";
            }else if((intval($subject)== 0) && (intval($place)>0)){
                $link=base_url()."tim-lop-gia-su-".vn_str_filter($class->name)."-tai-".vn_str_filter($tinhthanh->cit_name)."-s$subject"."c$place"."r$lophoc.html";
            }
					}else{
						if(intval($subject)>0 && intval($place)>0){
                $link=base_url()."tim-lop-gia-su-".vn_str_filter($monhoc->SubjectName)."-tai-".vn_str_filter($tinhthanh->cit_name)."-s$subject"."c$place"."r$lophoc.html";
            }else if((intval($subject)==0) && (intval($place)==0)){
                // $link=base_url()."tim-lop-hoc&key=all&subject=".intval($subject)."&topic=0&place=".intval($place)."&type=0&sex=0";
								$link=base_url()."tat-ca-lop-hoc";
            }else if((intval($subject)> 0) && (intval($place)==0)){
                $link=base_url()."tim-lop-gia-su-".vn_str_filter($monhoc->SubjectName)."-s$subject"."c$place"."r$lophoc.html";
            }else if((intval($subject)== 0) && (intval($place)>0)){
                $link=base_url()."tim-lop-gia-su"."-tai-".vn_str_filter($tinhthanh->cit_name)."-s$subject"."c$place"."r$lophoc.html";
            }
					}

        }else{
					$link=base_url();
				}
        if(strlen($link)>5){
        $result=['kq'=>true,'data'=>$link];
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
		function tutorresultfind($keywork,$subject,$topic,$place,$type,$sex,$class)
    {
        $page=$start_row=$this->uri->segment(2);
        $data['home'] = false;
        $data['showsearch']=true;
		$sql=$this->site_model->gettblwidthid('tbl_meta',1);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        if($keywork=='all'|| empty($keywork))
        {
            $key='';
        }else{
            $key=$keywork;
        }
        $perpage=20;
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }
        // if($page <= 20){
				// 	 $data['robots']= 'noindex,nofollow';
        // }else{
        //    $data['robots']= 'index,follow';
        // }
				// if(!empty($keywork) && !empty($subject) &&!empty($topic) &&!empty($place) &&!empty($type) &&!empty($sex) &&!empty($class)){
				// 	$data['robots']= 'noindex,nofollow';
				// }
				$data['robots']= 'noindex,nofollow';
        $data['keyfilter']=['keywork'=>$key,'subject'=>$subject,'topic'=>$topic,'place'=>$place,'type'=>$type,'sex'=>$sex];
        $data['lstitem']=$this->site_model->GetListClassBySearch($keywork,$subject,$topic,$place,$type,$sex,$page,$perpage);

				if($class>0){
					$data['lstitem']='';
					$listclass=$this->site_model->GetListClassBySearchLopHoc($subject,$place);
					// pr($listclass);
					// die();
					foreach ($listclass as  &$valuelist) {
						$classArr=explode(',',$valuelist->classArr);
						if(in_array($class,$classArr)){
							$data['lstitem'][]=$valuelist;
						}
					}
				}
        $data['monhoc']=$this->site_model->ListSubject();
        $data['districk']=$this->site_model->GetListdistrictbycity();
        $data['lstonline']=$this->site_model->GetListClassbyUserOnline();
        $link="tim-lop-hoc&key=".$keywork."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."";
        $total=$this->site_model->GetListClassBySearchTotal($keywork,$subject,$topic,$place,$type,$sex);
        $this->load->library('pagination');
        $config['total_rows'] = $total;
		$config['per_page'] = $perpage;
		$config['uri_segment'] =2;
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['num_links'] = 4;
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url']=$link;
		$this->pagination->initialize($config);
        $data['total']=$total;
		$data['start_row']= $page;
        $data['pagination']= $this->pagination->create_links();

		$data['canonical']=base_url()."tim-lop-hoc";
		//$data['amp']=site_url('amp');


        $data['content']='tutorresultfind';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl'	;
        $this->load->view('template',$data);

    }
		function listclassbyfilter($alias1,$subject,$city,$class)
    {
				if($subject>0 & $class>0){
					$listsubject=$this->db->select('areaclass');
					$listsubject=$this->db->get_where('subject',array('id'=>$subject))->row();
					$arealophoc=explode(',',$listsubject->areaclass);
					if(!in_array($class,$arealophoc)){
						show_404();
					}
				}
        $page=$start_row=$this->uri->segment(2);
				$data['home'] = false;
        $data['showsearch']=true;

        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $keywork='';$topic=0;$type=0;$sex=0;
        if($keywork=='all'|| empty($keywork))
        {
            $key='';
        }else{
            $key=$keywork;
        }
        $perpage=20;
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }
        // if($page <= 20){
				// 	$data['robots']= 'index,follow';
        // }else{
        //    $data['robots']= 'noindex,follow';
        // }
        $data['keyfilter']=['keywork'=>$key,'subject'=>$subject,'topic'=>$topic,'place'=>$city,'type'=>$type,'sex'=>$sex];
        $data['lstitem']=$this->site_model->GetListClassBySearch($keywork,$subject,$topic,$city,$type,$sex,0,20,$class);

        $data['monhoc']=$this->site_model->ListSubject();
        $data['districk']=$this->site_model->GetListdistrictbycity();
        $data['lstonline']=$this->site_model->GetListClassbyUserOnline();

        $tinhthanh="";
        $monhoc="";
				$titleSubject='';
				$linkSubject='';
				$titleClass='';
				$linkClass='';
				$titleCity='';
				$linkCity='';
        if(intval($subject)>0){
            $monhoc=$this->site_model->selectsubjectbyid(intval($subject));
						$data['subjectname']=$monhoc->SubjectName;
        }
        if(intval($city)>0){
						$tinhthanh=$this->site_model->SelectProvinceByID1(intval($city));
						$data['cityname']=$tinhthanh->cit_name;
					}
        $day=date('m/Y',time());
        $year=date('Y',time());
		$total=$this->site_model->GetListClassBySearchTotal($keywork,$subject,$topic,$city,$type,$sex);

		if(intval($class)>0){ //tại đây
			$data['lstitem']=array();
			$lophoc=$this->db->select('id,name');
			$lophoc=$this->db->get_where('lophoc',array('id'=>$class))->row();
			$result=$this->site_model->GetListClassBySearchLopHoc($subject,$city);
				foreach ($result as  &$value) {
					$arrId=explode(',',$value->classArr);
					if(in_array($lophoc->id,$arrId)){
						$listlophoc=$value;
						$data['lstitem'][]=$value;
					}
				}

				$total=count($data['lstitem']);
				$data['classname']=$lophoc->name;
		} //kết thúc tại đây.

        $meta="";$desc="";$metakey="";
				if($class>0){
					if(intval($subject)>0 && intval($city)>0){ //tìm lớp học theo môn học+ lớp học + tỉnh thành. xong
						$alias=vn_str_filter($monhoc->SubjectName)."-".vn_str_filter($lophoc->name)."-tai-".vn_str_filter($tinhthanh->cit_name);
	                $link=base_url()."tim-lop-gia-su-".$alias."-s$subject"."c$city"."r$class.html";
	                $metakey="lớp cần gia sư ".$monhoc->SubjectName." ".$lophoc->name." tại ".$tinhthanh->cit_name;
	                // $meta="Lớp cần gia sư ".$monhoc->SubjectName." ".$lophoc->name." tại ".$tinhthanh->cit_name." – Có ".$total." lớp gia sư T".$day;
									$meta="Lớp cần gia sư ".$monhoc->SubjectName." ".$lophoc->name." tại ".$tinhthanh->cit_name." mới nhất";
	                $desc="Tìm lớp gia sư dạy kèm ".$monhoc->SubjectName." ".$lophoc->name." tại ".$tinhthanh->cit_name." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$total." lớp cần gia sư ".$monhoc->SubjectName." ".$lophoc->name." tại ".$tinhthanh->cit_name." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn lớp gia sư giỏi, nâng trình ngay!";

									$titleCity='Danh sách lớp cần gia sư '.$monhoc->SubjectName.' '.$lophoc->name.' theo tỉnh thành';
									for($i=1;$i<64;$i++){
										$thanhpho=Getcitybyindex($i);
										$linkCity[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($monhoc->SubjectName).'-'.vn_str_filter($lophoc->name).'-tai-'.vn_str_filter($thanhpho).'-s'.$subject.'c'.$i.'r'.$class.'.html" >Lớp cần gia sư '.$monhoc->SubjectName.' '.$lophoc->name.' tại '.$thanhpho.'</a>';
									}
									$titleClass='Danh sách lớp cần gia sư '.$monhoc->SubjectName.' tại '.$tinhthanh->cit_name.' theo lớp học';
									$listlophoc=$this->db->select('id,name');
									$listlophoc=$this->db->get('lophoc')->result();
									$areaclass=explode(',',$monhoc->areaclass);
									foreach ($listlophoc as $valuelistlophoc) {
										$idlistlophoc=$valuelistlophoc->id;
										if(in_array($idlistlophoc,$areaclass)){
											$linkClass[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($monhoc->SubjectName).'-'.vn_str_filter($valuelistlophoc->name).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s'.$subject.'c'.$city.'r'.$idlistlophoc.'.html" >Lớp cần gia sư '.$monhoc->SubjectName.' '.$valuelistlophoc->name.' tại '.$tinhthanh->cit_name.'</a>';
										}
									}
									$titleSubject='Danh sách lớp cần gia sư '.$lophoc->name.' tại '.$tinhthanh->cit_name.' theo môn học';
									$listmonhoc=$this->db->select('ID,SubjectName,areaclass');
									$listmonhoc=$this->db->get('subject')->result();
									foreach ($listmonhoc as $valuelistmonhoc) {
										$areaclass=explode(',',$valuelistmonhoc->areaclass);
										if(in_array($class,$areaclass)){
											$linkSubject[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-'.vn_str_filter($lophoc->name).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s'.$valuelistmonhoc->ID.'c'.$city.'r'.$class.'.html" >Lớp cần gia sư '.$valuelistmonhoc->SubjectName.' '.$lophoc->name.' tại '.$tinhthanh->cit_name.'</a>';
										}
									}
							}else if((intval($subject)==0) && (intval($city)==0)){ //tìm lớp học theo lớp học. xong.
								$alias=vn_str_filter($lophoc->name);
	                $link=base_url()."tim-lop-gia-su-".$alias."-s0c0r$class.html";
									$metakey="lớp cần gia sư ".$lophoc->name.", lớp gia sư dạy kèm ".$lophoc->name;
	                // $meta="Lớp cần gia sư ".$lophoc->name." uy tín – Có ".$total." lớp gia sư T".$day;
									$meta="Lớp cần gia sư ".$lophoc->name." mới nhất";
	                $desc="Tìm lớp gia sư dạy kèm ".$lophoc->name." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$total." lớp cần gia sư ".$lophoc->name." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn lớp gia sư giỏi, nâng trình ngay!";
									$titleClass='Danh sách lớp cần gia sư theo lớp học';
									$listlophoc=$this->db->select('id,name');
									$listlophoc=$this->db->get('lophoc')->result();
									foreach ($listlophoc as $valuelistlophoc) {
										$idlistlophoc=$valuelistlophoc->id;
										$linkClass[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($valuelistlophoc->name).'-s0c0r'.$idlistlophoc.'.html" >Lớp cần gia sư '.$valuelistlophoc->name.'</a>';
									}
									$titleSubject='Danh sách lớp cần gia sư '.$lophoc->name.' theo môn học';
									$listmonhoc=$this->db->select('ID,SubjectName,areaclass');
									$listmonhoc=$this->db->get('subject')->result();
									foreach ($listmonhoc as $valuelistmonhoc) {
										$areaclass=explode(',',$valuelistmonhoc->areaclass);
										if(in_array($class,$areaclass)){
											$linkSubject[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-'.vn_str_filter($lophoc->name).'-s'.$valuelistmonhoc->ID.'c0r'.$class.'.html" >Lớp cần gia sư '.$valuelistmonhoc->SubjectName.' '.$lophoc->name.'</a>';
										}
									}
									$titleCity='Danh sách lớp cần gia sư '.$lophoc->name.' theo tỉnh thành';
									for($i=1;$i<64;$i++){
										$thanhpho=Getcitybyindex($i);
										$linkCity[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($lophoc->name).'-tai-'.vn_str_filter($thanhpho).'-s0c'.$i.'r0.html" >Lớp cần gia sư '.$lophoc->name.' tại '.$thanhpho.'</a>';
									}
	            }else if((intval($subject)> 0) && (intval($city)==0)){// tìm lớp học theo môn học + lớp học. xong.
								$alias=vn_str_filter($monhoc->SubjectName)."-".vn_str_filter($lophoc->name);
	                $link=base_url()."tim-lop-gia-su-".$alias."-s$subject"."c0r$class.html";
	                $metakey="lớp cần gia sư ".$monhoc->SubjectName." ".$lophoc->name.", lớp gia sư dạy kèm ".$monhoc->SubjectName." ".$lophoc->name;
	                // $meta="Lớp cần gia sư ".$monhoc->SubjectName." ".$lophoc->name." - Có ".$total." lớp gia sư T".$day;
									$meta="Lớp cần gia sư ".$monhoc->SubjectName." ".$lophoc->name." mới nhất";
	                $desc="Tìm lớp gia sư dạy kèm ".$monhoc->SubjectName." ".$lophoc->name." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$total." lớp cần gia sư ".$monhoc->SubjectName." ".$lophoc->name." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn lớp gia sư giỏi, nâng trình ngay ";

									$titleClass='Danh sách lớp cần gia sư '.$monhoc->SubjectName.' theo lớp học';
									$listlophoc=$this->db->select('id,name');
									$listlophoc=$this->db->get('lophoc')->result();
									$areaclass=explode(',',$monhoc->areaclass);
									foreach ($listlophoc as $valuelistlophoc) {
										$idlistlophoc=$valuelistlophoc->id;
										if(in_array($idlistlophoc,$areaclass)){
											$linkClass[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($monhoc->SubjectName).'-'.vn_str_filter($valuelistlophoc->name).'-s'.$subject.'c0r'.$idlistlophoc.'.html" >Lớp cần gia sư '.$monhoc->SubjectName.' '.$valuelistlophoc->name.'</a>';
										}
									}
									$titleSubject='Danh sách lớp cần gia sư '.$lophoc->name.' theo môn học';
									$listmonhoc=$this->db->select('ID,SubjectName,areaclass');
									$listmonhoc=$this->db->get('subject')->result();
									foreach ($listmonhoc as $valuelistmonhoc) {
										$areaclass1=explode(',',$valuelistmonhoc->areaclass);
										if(in_array($class,$areaclass1)){
											$linkSubject[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-'.vn_str_filter($lophoc->name).'-s'.$valuelistmonhoc->ID.'c0r'.$class.'.html" >Lớp cần gia sư '.$valuelistmonhoc->SubjectName.' '.$lophoc->name.'</a>';
										}
									}
									$titleCity='Danh sách lớp cần gia sư '.$monhoc->SubjectName.' '.$lophoc->name.' theo tỉnh thành';
									for($i=1;$i<64;$i++){
										$thanhpho=Getcitybyindex($i);
										$linkCity[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($monhoc->SubjectName).'-'.vn_str_filter($lophoc->name).'-tai-'.vn_str_filter($thanhpho).'-s'.$subject.'c'.$i.'r'.$class.'.html" >Lớp cần gia sư '.$monhoc->SubjectName.' '.$lophoc->name.' tại '.$thanhpho.'</a>';
									}
							}else if((intval($subject)== 0) && (intval($city)>0)){ //tìm lớp học theo lớp học + tỉnh thành. xong.
									$alias=vn_str_filter($lophoc->name)."-tai-".vn_str_filter($tinhthanh->cit_name);
	                $link=base_url()."tim-lop-gia-su-".$alias."-s0"."c$city"."r$class.html";
	                $metakey="lớp cần gia sư ".$lophoc->name." tại ".$tinhthanh->cit_name.",lớp gia sư dạy kèm ".$lophoc->name." tại ".$tinhthanh->cit_name;
	                // $meta="Lớp cần gia sư ".$lophoc->name." tại ".$tinhthanh->cit_name." – Có ".$total." lớp gia sư T".$day;
									$meta="Lớp cần gia sư ".$lophoc->name." tại ".$tinhthanh->cit_name." mới nhất";
	                $desc="Tìm lớp gia sư dạy kèm ".$lophoc->name." tại ".$tinhthanh->cit_name." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$total." lớp cần gia sư ".$lophoc->name." tại ".$tinhthanh->cit_name." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn lớp gia sư giỏi, nâng trình ngay!";

									$titleCity='Danh sách lớp cần gia sư '.$lophoc->name.' theo tỉnh thành';
									for($i=1;$i<64;$i++){
										$thanhpho=Getcitybyindex($i);
										$linkCity[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($lophoc->name).'-tai-'.vn_str_filter($thanhpho).'-s0c'.$i.'r'.$class.'.html" >Lớp cần gia sư '.$lophoc->name.' tại '.$thanhpho.'</a>';
									}
									$titleClass='Danh sách lớp cần gia sư tại '.$tinhthanh->cit_name.' theo lớp học';
									$listlophoc=$this->db->select('id,name');
									$listlophoc=$this->db->get('lophoc')->result();
									foreach ($listlophoc as $valuelistlophoc) {
										$linkClass[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($valuelistlophoc->name).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s0c'.$city.'r'.$valuelistlophoc->id.'.html" >Lớp cần gia sư '.$valuelistlophoc->name.' tại '.$tinhthanh->cit_name.'</a>';
									}
									$titleSubject='Danh sách lớp cần gia sư '.$lophoc->name.' tại '.$tinhthanh->cit_name.' theo môn học';
									$listmonhoc=$this->db->select('ID,SubjectName,areaclass');
									$listmonhoc=$this->db->get('subject')->result();
									foreach ($listmonhoc as $valuelistmonhoc) {
										$areaclass=explode(',',$valuelistmonhoc->areaclass);
										if(in_array($class,$areaclass)){
											$linkSubject[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-'.vn_str_filter($lophoc->name).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s'.$valuelistmonhoc->ID.'c'.$city.'r'.$class.'.html" >Lớp cần gia sư '.$valuelistmonhoc->SubjectName.' '.$lophoc->name.' tại '.$tinhthanh->cit_name.'</a>';
										}
									}
							}
				}//kết thúc if($class>0).
				else{
					if(intval($subject)>0 && intval($city)>0){ //tìm lớp học theo môn học + tỉnh thành. xong
						$alias=vn_str_filter($monhoc->SubjectName)."-tai-".vn_str_filter($tinhthanh->cit_name);
									$link=base_url()."tim-lop-gia-su-".$alias."-s$subject"."c$city"."r0.html";
									$metakey="lớp cần gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name.", lớp gia sư dạy kèm ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name;
									// $meta="Lớp cần gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." – Có ".$total." lớp gia sư T".$day;
									$meta="Lớp cần gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." mới nhất";
									$desc="Tìm lớp gia sư dạy kèm ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$total." lớp cần gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn lớp gia sư giỏi, nâng trình ngay!";

									$titleCity='Danh sách lớp cần gia sư '.$monhoc->SubjectName.' theo tỉnh thành';
									for($i=1;$i<64;$i++){
										$thanhpho=Getcitybyindex($i);
										$linkCity[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($monhoc->SubjectName).'-tai-'.vn_str_filter($thanhpho).'-s'.$subject.'c'.$i.'r0.html" >Lớp cần gia sư '.$monhoc->SubjectName.' tại '.$thanhpho.'</a>';
									}
									$titleSubject='Danh sách lớp cần gia sư tại '.$tinhthanh->cit_name.' theo môn học';
									$listmonhoc=$this->db->select('ID,SubjectName');
									$listmonhoc=$this->db->get('subject')->result();
									foreach ($listmonhoc as $valuelistmonhoc) {
										$linkSubject[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s'.$valuelistmonhoc->ID.'c'.$city.'r0.html" >Lớp cần gia sư '.$valuelistmonhoc->SubjectName.' tại '.$tinhthanh->cit_name.'</a>';
									}
									$titleClass='Danh sách lớp cần gia sư '.$monhoc->SubjectName.' tại '.$tinhthanh->cit_name.' theo lớp học';
									$listlophoc=$this->db->select('id,name');
									$listlophoc=$this->db->get('lophoc')->result();
									$areaclass=explode(',',$monhoc->areaclass);
									foreach ($listlophoc as $valuelistlophoc) {
										$idlistlophoc=$valuelistlophoc->id;
										if(in_array($idlistlophoc,$areaclass)){
											$linkClass[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($monhoc->SubjectName).'-'.vn_str_filter($valuelistlophoc->name).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s'.$subject.'c'.$city.'r'.$idlistlophoc.'.html" >Lớp cần gia sư '.$monhoc->SubjectName.' '.$valuelistlophoc->name.' tại '.$tinhthanh->cit_name.'</a>';
										}
									}
							}else if((intval($subject)==0) && (intval($city)==0)){ //tìm lớp học
									$link=base_url()."tat-ca-lop-hoc";
							}else if((intval($subject)> 0) && (intval($city)==0)){ //tìm lớp học theo môn học. xong.
								$alias=vn_str_filter($monhoc->SubjectName);
									$link=base_url()."tim-lop-gia-su-".$alias."-s$subject"."c0r0.html";
									$metakey="lớp cần gia sư ".$monhoc->SubjectName.", lớp gia sư dạy kèm ".$monhoc->SubjectName;
									// $meta="Lớp cần gia sư ".$monhoc->SubjectName." uy tín – Có ".$total." lớp gia sư T".$day;
									$meta="Lớp cần gia sư ".$monhoc->SubjectName." mới nhất";
									$desc="Tìm lớp gia sư dạy kèm ".$monhoc->SubjectName." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$total." lớp cần gia sư ".$monhoc->SubjectName." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn lớp gia sư giỏi, nâng trình ngay ";

									$titleSubject='Danh sách lớp cần gia sư theo môn học';
									$listmonhoc=$this->db->select('ID,SubjectName');
									$listmonhoc=$this->db->get('subject')->result();
									foreach ($listmonhoc as $valuelistmonhoc) {
										$linkSubject[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-s'.$valuelistmonhoc->ID.'c0r0.html" >Lớp cần gia sư '.$valuelistmonhoc->SubjectName.'</a>';
									}
									$titleClass='Danh sách lớp cần gia sư '.$monhoc->SubjectName.' theo lớp học';
									$listlophoc=$this->db->select('id,name');
									$listlophoc=$this->db->get('lophoc')->result();
									$areaclass=explode(',',$monhoc->areaclass);
									foreach ($listlophoc as  $valuelistlophoc) {
										$idlistlophoc=$valuelistlophoc->id;
										if(in_array($idlistlophoc,$areaclass)){
											$linkClass[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($monhoc->SubjectName).'-'.vn_str_filter($valuelistlophoc->name).'-s'.$subject.'c0r'.$idlistlophoc.'.html" >Lớp cần gia sư '.$monhoc->SubjectName.' '.$valuelistlophoc->name.'</a>';
										}
									}
									$titleCity='Danh sách lớp cần gia sư '.$monhoc->SubjectName.' theo tỉnh thành';
									for($i=1;$i<64;$i++){
										$thanhpho=Getcitybyindex($i);
										$linkCity[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($monhoc->SubjectName).'-tai-'.vn_str_filter($thanhpho).'-s'.$subject.'c'.$i.'r0.html" >Lớp cần gia sư '.$monhoc->SubjectName.' tại '.$thanhpho.'</a>';
									}
							}else if((intval($subject)== 0) && (intval($city)>0)){ //tìm lớp học theo tỉnh thành. xong
								$alias="tai-".vn_str_filter($tinhthanh->cit_name);
									$link=base_url()."tim-lop-gia-su-".$alias."-s0"."c$city"."r0.html";
									$metakey="lớp cần gia sư tại ".$tinhthanh->cit_name.",lớp gia sư dạy kèm tại ".$tinhthanh->cit_name;
									// $meta="Lớp cần gia sư tại ".$tinhthanh->cit_name." uy tín  – Có ".$total." lớp gia sư T".$day;
									$meta="Lớp cần gia sư tại ".$tinhthanh->cit_name." mới nhất";
									$desc="Tìm lớp gia sư dạy kèm tại ".$tinhthanh->cit_name." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$total." lớp cần gia sư tại ".$tinhthanh->cit_name." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn lớp gia sư giỏi, nâng trình ngay!";

									$titleCity='Danh sách lớp cần gia sư theo tỉnh thành';
									for($i=1;$i<64;$i++){
										$thanhpho=Getcitybyindex($i);
										$linkCity[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-tai-'.vn_str_filter($thanhpho).'-s0c'.$i.'r0.html" >Lớp cần gia sư tại '.$thanhpho.'</a>';
									}
									$titleSubject='Danh sách lớp cần gia sư tại '.$tinhthanh->cit_name.' theo môn học';
									$listmonhoc=$this->db->select('ID,SubjectName');
									$listmonhoc=$this->db->get('subject')->result();
									foreach ($listmonhoc as $valuelistmonhoc) {
										$linkSubject[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s'.$valuelistmonhoc->ID.'c'.$city.'r0.html" >Lớp cần gia sư '.$valuelistmonhoc->SubjectName.' tại '.$tinhthanh->cit_name.'</a>';
									}
									$titleClass='Danh sách lớp cần gia sư tại '.$tinhthanh->cit_name.' theo lớp học';
									$listlophoc=$this->db->select('id,name');
									$listlophoc=$this->db->get('lophoc')->result();
									foreach ($listlophoc as $valuelistlophoc) {
										$linkClass[]='<a rel="nofollow" href="'.base_url().'tim-lop-gia-su-'.vn_str_filter($valuelistlophoc->name).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s0c'.$city.'r'.$valuelistlophoc->id.'.html" >Lớp cần gia sư '.$valuelistlophoc->name.' tại '.$tinhthanh->cit_name.'</a>';
									}
							}
				}
				$this->load->helper('locurl');
				$refineUrl=urlRefine();
				$data['robots']= 'index,follow';
				if(in_array($link,$refineUrl)){
					$data['robots']='noindex,nofollow';
				}
			if($alias==$alias1){
				$data['titleSubject']=$titleSubject;
				$data['linkSubject']=$linkSubject;
				$data['titleClass']=$titleClass;
				$data['linkClass']=$linkClass;
				$data['titleCity']=$titleCity;
				$data['linkCity']=$linkCity;
				$data['canonical']=$link;
        $data['linkseo']=$this->site_model->getitemlinkseobuysearch($subject,$city,$class,1);
        $data['meta_title']=$meta;//$sql->title;
				$data['meta_key']=$metakey;
				$data['meta_des']=$desc;
				$this->load->library('pagination');
				$config['total_rows'] = $total;
				$config['per_page'] = $perpage;
				$config['uri_segment'] =2;
				$config['next_link'] = '<i class="fa fa-angle-right"></i>';
				$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
				$config['num_links'] = 4;
				$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
				$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
				$config['base_url']=$link;
				$this->pagination->initialize($config);
				$data['total']=$total;
				$data['start_row']= $page;
				$data['pagination']= $this->pagination->create_links();
        $data['content']='listclassbyfilter';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl'	;
        $this->load->view('template',$data);
			}else{
				header("HTTP/1.1 301 Moved Permanently");
				header("location: ".$link); exit;
			}
	}
	function listteacherbyfilter($alias1,$subject,$city,$class){
			if($subject>0 && $class>0){
				$listsubject=$this->db->select('areaclass');
				$listsubject=$this->db->get_where('subject',array('id'=>$subject))->row();
				$arealophoc=explode(',',$listsubject->areaclass);
				if(!in_array($class,$arealophoc)){
					// redirect($urlerror);
					show_404();
					// redirect(base_url());
				}
			}
			// $currentUrl= current_url();
			$page=$start_row=$this->uri->segment(2);
			$data['home'] = false;
			$data['showsearch']=true;
			if(!empty($sql->name)){
					$data['metah1']=$sql->name;
			}else{
					$data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
			}
			$perpage=10;
			if(empty($page)||intval($page)==0){
					$page=0;
			}else{
					$page=intval($page);
			}
			// if($page <= 10){
			// 	 $data['robots']= 'index,follow';
			// }else{
			// 	 $data['robots']= 'noindex,follow';
			// }
			$keywork='';$topic=0;$type=0;$sex=0;
			$data['keywork']=$keywork;
			if($keywork=='all'|| empty($keywork))
			{
					$key='';
			}else{
					$key=$keywork;
			}
			$meta="";$desc="";$metakey="";
			$day=date('m/Y',time());
			$year=date('Y',time());
			$data['keyhome']=1;
			$data['keyfilter']=['keywork'=>$key,'subject'=>$subject,'topic'=>$topic,'place'=>$city,'type'=>$type,'sex'=>$sex];
			$result=$this->site_model->GetListTeacherBySearchClass($subject,$city,$class,$page,$perpage);//tìm kiếm list gia sư thỏa mãn cả 3 tiêu chí về subject(môn học), city(tỉnh thành), class(lớp học).
			$data['lstitem']=$result['data'];

			if(intval($class)>0){
				$lophoc=$this->db->get_where('lophoc',array('id'=>$class))->row();
				$data['class']=$lophoc->name;
			}


			$tinhthanh="";
			$monhoc="";
			$titleSubject='';
			$linkSubject='';
			$titleClass='';
			$linkClass='';
			$titleCity='';
			$linkCity='';
			// $alias='';
			if(intval($subject)>0){
					$monhoc=$this->site_model->selectsubjectbyid(intval($subject));
					$data['subjectname']=$monhoc->SubjectName;
			}
			if(intval($city)>0){
					$tinhthanh=$this->site_model->SelectProvinceByID1(intval($city));
					$data['cityname']=$tinhthanh->cit_name;
			}
			if(intval($class)>0){
				if(intval($subject)>0 && intval($city)>0){ //gia sư môn học + lớp học + tỉnh thành. xong.
					$alias= vn_str_filter($monhoc->SubjectName)."-".vn_str_filter($lophoc->name)."-tai-".vn_str_filter($tinhthanh->cit_name);
								$link=base_url()."gia-su-".$alias."-s$subject"."c$city"."r$class.html";
								$metakey="Gia sư ".$monhoc->SubjectName." ".$lophoc->name." tại ".$tinhthanh->cit_name;
								$meta="Gia sư ".$monhoc->SubjectName." ".$lophoc->name." tại ".$tinhthanh->cit_name." - Có ".$result['total']." gia sư T".$day;
								$desc="Tìm gia sư dạy kèm ".$monhoc->SubjectName." ".$lophoc->name." tại ".$tinhthanh->cit_name." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$result['total']." gia sư ".$monhoc->SubjectName." ".$lophoc->name." tại ".$tinhthanh->cit_name." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn gia sư giỏi, nâng trình ngay!";
								if(in_array($link,getlinkSEOsearchteacher(1))){
									$meta="Tìm gia sư ".$monhoc->SubjectName." ".$lophoc->name." tại ".$tinhthanh->cit_name." uy tín";
								}
								//thêm link liên quan.
								$titleCity='Gia sư '.$monhoc->SubjectName.' '.$lophoc->name.' theo tỉnh thành';
								for($i=1;$i<64;$i++){
									$thanhpho=Getcitybyindex($i);
									$linkCity[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($monhoc->SubjectName).'-'.vn_str_filter($lophoc->name).'-tai-'.vn_str_filter($thanhpho).'-s'.$subject.'c'.$i.'r'.$class.'.html" >Gia sư '.$monhoc->SubjectName.' '.$lophoc->name.' tại '.$thanhpho.'</a>';
								}
									$listlophoc=$this->db->select('id,name');
									$listlophoc=$this->db->get('lophoc')->result();
									$titleClass='Gia sư '.$monhoc->SubjectName.' tại '.$tinhthanh->cit_name.' theo lớp học';
									$areaclass1=explode(',',$monhoc->areaclass) ;
								foreach ($listlophoc as &$valuelistlophoc) {
									$idlistlophoc=$valuelistlophoc->id;
									if(in_array($idlistlophoc,$areaclass1)){
										$linkClass[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($monhoc->SubjectName).'-'.vn_str_filter($valuelistlophoc->name).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s'.$subject.'c'.$city.'r'.$idlistlophoc.'.html" >Gia sư '.$monhoc->SubjectName.' '.$valuelistlophoc->name.' tại '.$tinhthanh->cit_name.'</a>';
									}
								}
									$listmonhoc=$this->db->select('ID,SubjectName,areaclass');
									$listmonhoc=$this->db->get('subject')->result();
									$titleSubject='Gia sư '.$lophoc->name.' tại '.$tinhthanh->cit_name.' theo môn học';
									foreach ($listmonhoc as &$valuelistmonhoc) {
										$idmonhoc=$valuelistmonhoc->ID;
										$areaclass2=explode(',',$valuelistmonhoc->areaclass);

										if(in_array($class,$areaclass2)){
											$linkSubject[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-'.vn_str_filter($lophoc->name).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s'.$valuelistmonhoc->ID.'c'.$city.'r'.$class.'.html" >Gia sư '.$valuelistmonhoc->SubjectName.' '.$lophoc->name.' tại '.$tinhthanh->cit_name.'</a>';
										}
									}
						}else if((intval($subject)==0) && (intval($city)==0)){ // gia sư + lớp học . xong
							$alias=vn_str_filter($lophoc->name);
							$link=base_url()."gia-su-".$alias."-s0c0r".$class.".html";
							$metakey="tìm gia sư ".$lophoc->name.", gia sư dạy kèm ".$lophoc->name;
							$meta="Tìm gia sư ".$lophoc->name." uy tín – Có ".$result['total']." gia sư T".$day;
							$desc="Tìm gia sư dạy kèm ".$lophoc->name." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$result['total']." gia sư ".$lophoc->name." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn gia sư giỏi, nâng trình ngay!";									//thêm link liên quan.

							$listlophoc=$this->db->select('id,name');
							$listlophoc=$this->db->get('lophoc')->result();
							$titleClass='Gia sư theo lớp học';
							foreach ($listlophoc as &$valuelistlophoc) {
								$linkClass[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($valuelistlophoc->name).'-s0c0r'.$valuelistlophoc->id.'.html" >Gia sư '.$valuelistlophoc->name.'</a>';
							}
							$listmonhoc=$this->db->select('ID,SubjectName,areaclass');
							$listmonhoc=$this->db->get('subject')->result();
							$titleSubject='Gia sư theo môn học '.$lophoc->name;
							foreach ($listmonhoc as &$valuelistmonhoc) {
								$areaclass1=explode(',',$valuelistmonhoc->areaclass);
								if(!empty($areaclass1) && in_array($class,$areaclass1)){
									$linkSubject[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-'.vn_str_filter($lophoc->name).'-s'.$valuelistmonhoc->ID.'c0r'.$class.'.html" >Gia sư '.$valuelistmonhoc->SubjectName.' '.$lophoc->name.'</a>';
								}
							}
							$titleCity='Gia sư '.$lophoc->name.' theo tỉnh thành';
							for($i=1;$i<64;$i++){
								$thanhpho=Getcitybyindex($i);
								$linkCity[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($lophoc->name).'-tai-'.vn_str_filter($thanhpho).'-s0c'.$i.'r'.$class.'.html" >Gia sư '.$lophoc->name.' tại '.$thanhpho.'</a>';
							}

						}else if((intval($subject)> 0) && (intval($city)==0)){ //tìm gia sư theo môn học + lớp học. xong.
							$alias=vn_str_filter($monhoc->SubjectName)."-".vn_str_filter($lophoc->name);
								$link=base_url()."gia-su-".$alias."-s$subject"."c0r$class.html";
								$metakey="tìm gia sư ".$monhoc->SubjectName." ".$lophoc->name.", gia sư dạy kèm ".$monhoc->SubjectName." ".$lophoc->name;
								$meta="Tìm gia sư ".$monhoc->SubjectName." ".$lophoc->name." uy tín – Có ".$result['total']." gia sư T".$day;
								$desc="Tìm gia sư dạy kèm ".$monhoc->SubjectName." ".$lophoc->name." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$result['total']." gia sư ".$monhoc->SubjectName." ".$lophoc->name." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn gia sư giỏi, nâng trình ngay!";
								//thêm link liên quan.
								$listlophoc=$this->db->select('id,name');
								$listlophoc=$this->db->get('lophoc')->result();
								$titleClass='Gia sư '.$monhoc->SubjectName.' theo lớp học';
								$areaclass1=explode(',',$monhoc->areaclass);
								foreach ($listlophoc as &$valuelistlophoc) {
									$idlistlophoc=$valuelistlophoc->id;
									if(in_array($idlistlophoc,$areaclass1)){
										$linkClass[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($monhoc->SubjectName).'-'.vn_str_filter($valuelistlophoc->name).'-s'.$subject.'c0r'.$idlistlophoc.'.html" >Gia sư '.$monhoc->SubjectName.' '.$valuelistlophoc->name.'</a>';
									}
								}
								$listmonhoc=$this->db->select('ID,SubjectName,areaclass');
								$listmonhoc=$this->db->get('subject')->result();
								$titleSubject='Gia sư '.$lophoc->name.' theo môn học';
								foreach ($listmonhoc as &$valuelistmonhoc) {
									$idmonhoc=$valuelistmonhoc->ID;
									$areaclass2=explode(',',$valuelistmonhoc->areaclass);
									if(in_array($class,$areaclass2)){
										$linkSubject[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-'.vn_str_filter($lophoc->name).'-s'.$valuelistmonhoc->ID.'c0r'.$class.'.html" >Gia sư '.$valuelistmonhoc->SubjectName.' '.$lophoc->name.'</a>';
									}
								}
								$titleCity='Gia sư '.$monhoc->SubjectName.' '.$lophoc->name.' theo tỉnh thành';
								for($i=1;$i<64;$i++){
									$thanhpho=Getcitybyindex($i);
									$linkCity[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($monhoc->SubjectName).'-'.vn_str_filter($lophoc->name).'-tai-'.vn_str_filter($thanhpho).'-s'.$subject.'c'.$i.'r'.$class.'.html" >Gia sư '.$monhoc->SubjectName.' '.$lophoc->name.' tại '.$thanhpho.'</a>';
								}
						}else if((intval($subject)== 0) && (intval($city)> 0)){ //tìm gia sư theo lớp học + tỉnh thành. xong
							$alias=vn_str_filter($lophoc->name)."-tai-".vn_str_filter($tinhthanh->cit_name);
								$link=base_url()."gia-su-".$alias."-s0"."c$city"."r$class.html";
								$metakey="tìm gia sư ".$lophoc->name." tại ".$tinhthanh->cit_name.",gia sư dạy kèm ".$lophoc->name." tại ".$tinhthanh->cit_name;
								$meta="Tìm gia sư ".$lophoc->name." tại ".$tinhthanh->cit_name." uy tín – Có ".$result['total']." gia sư T".$day;
								$desc="Tìm gia sư dạy kèm ".$lophoc->name." tại ".$tinhthanh->cit_name." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$result['total']." gia sư ".$lophoc->name." tại ".$tinhthanh->cit_name." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn gia sư giỏi, nâng trình ngay !";
								if(in_array($link,getlinkSEOsearchteacher(1))){
									$meta="Tìm gia sư ".$monhoc->SubjectName." ".$lophoc->name." tại ".$tinhthanh->cit_name." uy tín";
								}
								//thêm link liên quan.
								$listlophoc=$this->db->select('id,name');
								$listlophoc=$this->db->get('lophoc')->result();
								$titleClass='Gia sư tại '.$tinhthanh->cit_name.' theo lớp học';
								foreach ($listlophoc as &$valuelistlophoc) {
									$idlistlophoc=$valuelistlophoc->id;
										$linkClass[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($valuelistlophoc->name).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s0c'.$city.'r'.$idlistlophoc.'.html" >Gia sư '.$valuelistlophoc->name.' tại '.$tinhthanh->cit_name.'</a>';
								}
								$listmonhoc=$this->db->select('ID,SubjectName,areaclass');
								$listmonhoc=$this->db->get('subject')->result();
								$titleSubject='Gia sư '.$lophoc->name.' tại '.$tinhthanh->cit_name.' theo môn học';
								foreach ($listmonhoc as &$valuelistmonhoc) {
									$idmonhoc=$valuelistmonhoc->ID;
									$areaclass2=explode(',',$valuelistmonhoc->areaclass);
									if(in_array($class,$areaclass2)){
										$linkSubject[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-'.vn_str_filter($lophoc->name).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s'.$valuelistmonhoc->ID.'c'.$city.'r'.$class.'.html" >Gia sư '.$valuelistmonhoc->SubjectName.' '.$lophoc->name.' tại '.$tinhthanh->cit_name.'</a>';
									}
								}
								$titleCity='Gia sư '.$lophoc->name.' theo tỉnh thành';
								for($i=1;$i<64;$i++){
									$thanhpho=Getcitybyindex($i);
									$linkCity[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($lophoc->name).'-tai-'.vn_str_filter($thanhpho).'-s0c'.$i.'r'.$class.'.html" >Gia sư '.$lophoc->name.' tại '.$thanhpho.'</a>';
								}
						}
						$meta= ($class==13)?str_replace(' T'.$day,'',$meta):$meta;
			} //kết thúc if($class>0)
			else{
						if(intval($subject)>0 && intval($city)>0){ //tìm gia sư theo môn học + tỉnh thành
							$loc=array(9,23,33,22,28,16,27);
							$base_url=base_url();
							$locurl=array(
										$base_url.'gia-su-tieng-nhat-tai-ba-ria-vung-tau-s11c47r0.html',
										$base_url.'gia-su-tieng-phap-tai-ba-ria-vung-tau-s14c47r0.html',
										$base_url.'gia-su-tieng-trung-tai-ba-ria-vung-tau-s15c47r0.html',
										$base_url.'gia-su-tieng-trung-tai-thua-thien-hue-s15c27r0.html',
										$base_url.'gia-su-tieng-viet-tai-ba-ria-vung-tau-s5c47r0.html',
										$base_url.'gia-su-ve-my-thuat-tai-ba-ria-vung-tau-s24c47r0.html',
										$base_url.'gia-su-ve-my-thuat-tai-thua-thien-hue-s24c27r0.html'
									);
								$alias=vn_str_filter($monhoc->SubjectName)."-tai-".vn_str_filter($tinhthanh->cit_name);
								$link=base_url()."gia-su-".$alias."-s$subject"."c$city"."r0.html";
								$metakey="tìm gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name.", gia sư dạy kèm ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name;
								$meta="Tìm gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." uy tín – Có ".$result['total']." gia sư T".$day;
								if(in_array($subject,$loc) || in_array($link,$locurl)){
									$meta="Tìm gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." – Có ".$result['total']." gia sư";
								}
								$desc="Tìm gia sư dạy kèm ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$result['total']." gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn gia sư giỏi, nâng trình ngay!";
								//thêm link liên quan
								$titleCity='Gia sư '.$monhoc->SubjectName.' theo tỉnh thành';
								for($i=1;$i<64;$i++){
									$thanhpho=Getcitybyindex($i);
									$linkCity[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($monhoc->SubjectName).'-tai-'.vn_str_filter($thanhpho).'-s'.$subject.'c'.$i.'r0.html" >Gia sư '.$monhoc->SubjectName.' tại '.$thanhpho.'</a>';
								}
								$listmonhoc=$this->db->select('ID,SubjectName');
								$listmonhoc=$this->db->get('subject')->result();
								$titleSubject='Gia sư tại '.$tinhthanh->cit_name.' theo môn học';
								foreach ($listmonhoc as &$valuelistmonhoc) {
									$linkSubject[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s'.$valuelistmonhoc->ID.'c'.$city.'r0.html" >Gia sư '.$valuelistmonhoc->SubjectName.' tại '.$tinhthanh->cit_name.'</a>';
								}

								$listlophoc=$this->db->select('id,name');
								$listlophoc=$this->db->get('lophoc')->result();
								$titleClass='Gia sư '.$monhoc->SubjectName.' tại '.$tinhthanh->cit_name.' theo lớp học';
								$areaclass1=explode(',',$monhoc->areaclass) ;
								foreach ($listlophoc as &$valuelistlophoc) {
									$idlistlophoc=$valuelistlophoc->id;
									if(in_array($idlistlophoc,$areaclass1)){
										$linkClass[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($monhoc->SubjectName).'-'.vn_str_filter($valuelistlophoc->name).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s'.$subject.'c'.$city.'r'.$idlistlophoc.'.html" >Gia sư '.$monhoc->SubjectName.' '.$valuelistlophoc->name.' tại '.$tinhthanh->cit_name.'</a>';
									}
								}
						}else if((intval($subject)==0) && (intval($city)==0)){
								$link=base_url()."giao-vien&key=all&subject=".intval($subject)."&topic=0&place=".intval($city)."&type=0&sex=0&order=last";
						}else if((intval($subject)> 0) && (intval($city)==0)){ //gia sư + môn học. xong
							$alias=vn_str_filter($monhoc->SubjectName);
								$link=base_url()."gia-su-".$alias."-s$subject"."c0r0.html";
								$metakey="tìm gia sư ".$monhoc->SubjectName.", gia sư dạy kèm ".$monhoc->SubjectName;
								$meta="Tìm gia sư ".$monhoc->SubjectName." uy tín – Có ".$result['total']." gia sư T".$day;
								$desc="Tìm gia sư dạy kèm ".$monhoc->SubjectName." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$result['total']." gia sư ".$monhoc->SubjectName." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn gia sư giỏi, nâng trình ngay!";

								$listmonhoc=$this->db->select('ID,SubjectName');
								$listmonhoc=$this->db->get('subject')->result();
								$titleSubject='Gia sư theo môn học';
								foreach ($listmonhoc as &$valuelistmonhoc) {
									$linkSubject[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-s'.$valuelistmonhoc->ID.'c0r0.html" >Gia sư '.$valuelistmonhoc->SubjectName.'</a>';
								}
								$listlophoc=$this->db->select('id,name');
								$listlophoc=$this->db->get('lophoc')->result();
								$titleClass='Gia sư '.$monhoc->SubjectName.' theo lớp học';
								$areaclass1=explode(',',$monhoc->areaclass);
								foreach ($listlophoc as &$valuelistlophoc) {
									if(in_array($valuelistlophoc->id,$areaclass1)){
										$linkClass[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($monhoc->SubjectName).'-'.vn_str_filter($valuelistlophoc->name).'-s'.$subject.'c0'.'r'.$valuelistlophoc->id.'.html" >Gia sư '.$monhoc->SubjectName.' '.$valuelistlophoc->name.'</a>';
									}
								}
								$titleCity='Gia sư '.$monhoc->SubjectName.' theo tỉnh thành';
								for($i=1;$i<64;$i++){
									$thanhpho=Getcitybyindex($i);
									$linkCity[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($monhoc->SubjectName).'-tai-'.vn_str_filter($thanhpho).'-s0c'.$i.'r0.html" >Gia sư '.$monhoc->SubjectName.' tại '.$thanhpho.'</a>';
								}
						}else if((intval($subject)== 0) && (intval($city)> 0)){ //gia sư theo tỉnh thành. xong.
							$alias="tai-".vn_str_filter($tinhthanh->cit_name);
								$link=base_url()."gia-su-".$alias."-s0"."c$city"."r0.html";
								$metakey="tìm gia sư tại ".$tinhthanh->cit_name.",gia sư dạy kèm tại ".$tinhthanh->cit_name;
								$meta="Tìm gia sư tại ".$tinhthanh->cit_name." uy tín – Có ".$result['total']." gia sư T".$day;
								$desc="Tìm gia sư dạy kèm tại ".$tinhthanh->cit_name." cho con ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$result['total']." gia sư tại ".$tinhthanh->cit_name." nhận dạy kèm phù hợp mới nhất ".$year." cho bạn lựa chọn. ✅ Chọn gia sư giỏi, nâng trình ngay !";
								$titleCity='Gia sư theo tỉnh thành';
								for($i=1;$i<64;$i++){
									$thanhpho=Getcitybyindex($i);
									$linkCity[]='<a rel="nofollow" href="'.base_url().'gia-su-tai-'.vn_str_filter($thanhpho).'-s0c'.$i.'r0.html" >Gia sư tại '.$thanhpho.'</a>';
								}
								$titleSubject='Gia sư tại '.$tinhthanh->cit_name.' theo môn học';
								$listmonhoc=$this->db->select('ID,SubjectName');
								$listmonhoc=$this->db->get('subject')->result();
								foreach ($listmonhoc as &$valuelistmonhoc) {
									$linkSubject[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($valuelistmonhoc->SubjectName).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s'.$valuelistmonhoc->ID.'c'.$class.'r0.html" >Gia sư '.$valuelistmonhoc->SubjectName.' tại '.$tinhthanh->cit_name.'</a>';
								}
								$titleClass='Gia sư tại '.$tinhthanh->cit_name.' theo lớp học';
								$listlophoc=$this->db->select('id,name');
								$listlophoc=$this->db->get('lophoc')->result();
								foreach ($listlophoc as &$valuelistlophoc) {
									$linkClass[]='<a rel="nofollow" href="'.base_url().'gia-su-'.vn_str_filter($valuelistlophoc->name).'-tai-'.vn_str_filter($tinhthanh->cit_name).'-s0c'.$city.'r'.$valuelistlophoc->id.'.html" >Gia sư '.$valuelistlophoc->name.' tại '.$tinhthanh->cit_name.'</a>';
								}
						}
			}
			$this->load->helper('locurl');
			$refineUrl=urlRefine();
			$data['robots']= 'index,follow';
			if(in_array($link,$refineUrl)){
				$data['robots']='noindex,nofollow';
			}
			if($alias==$alias1){
				$data['linkseo']=$this->site_model->getitemlinkseobuysearch($subject,$city,$class,2);
				$data['titleSubject']=$titleSubject;
				$data['linkSubject']=$linkSubject;
				$data['titleClass']=$titleClass;
				$data['linkClass']=$linkClass;
				$data['titleCity']=$titleCity;
				$data['linkCity']=$linkCity;
				$this->load->library('pagination');
				$config['total_rows'] = $result['total'];
				$config['per_page'] = $perpage;
				$config['uri_segment'] =2;
				$config['next_link'] = '<i class="fa fa-angle-right"></i>';
				$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
				$config['num_links'] = 4;
				$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
				$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
				$config['base_url']=$link;
				$this->pagination->initialize($config);
				$data['total']=$result['total'];
				$data['order']=$order;
				$data['start_row']= $page;
				$data['pagination']= $this->pagination->create_links();
				$data['monhoc']=$this->site_model->ListSubject();
				$data['chude']=$this->site_model->GetTeacherFeature();
				$data['districk']=$this->site_model->CountTeacherbyCity();
				$data['lstonline']=$this->site_model->GetTeacherOnline(10);
				$data['selectbox']=base_url()."giao-vien&key=".$keywork."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&order=";
				$data['canonical']=$link;
				$sql=$this->site_model->gettblwidthid('tbl_meta',1);
				$data['meta_title']=$meta;
				$data['meta_key']=$metakey;
				$data['meta_des']=$desc;

				$data['content']='listteacherbyfilter';
				$data['classheader']='navbar navbar-default white bootsnav on no-full';
				$data['cssbody']=''	;//customsl
				$data['showsupport']=true;
				$this->load->view('template',$data);
			}else{
				header("HTTP/1.1 301 Moved Permanently");
				header("location: ".$link); exit;
			}
	}

	function AllTeacher()
	{
			$data['home'] = false;
			$data['showsearch']=true;
			$sql=$this->site_model->gettblwidthid('tbl_meta',5);
			$data['meta_key']=$sql->metakeywork;
			$data['meta_title']=$sql->title;
			$data['meta_des']=$sql->metadesc;
			// $data['meta_title']='Tất cả lớp học | Vieclam123.vn';
			// $data['meta_des']='Danh sách lớp học dạy kèm đang cần gia sư được Vieclam123.vn cập nhật liên tục, mới nhất. Cung cấp nhiều lựa chọn an toàn và hợp lý nhất cho các gia sư.';
			if(!empty($sql->name)){
					$data['metah1']=$sql->name;
			}else{
					$data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
			}

			// $monhoc=$this->db->select('ID,SubjectName');
			// $monhoc=$this->db->get('subject')->result();
			// // $this->site_model->pr($monhoc);
			// foreach ($monhoc as &$valueSubject) {
			// 	$idsubject=$valueSubject->ID;
			// 	$linkSubject[]="<a href=".base_url()."tim-lop-gia-su-".vn_str_filter($valueSubject->SubjectName)."-s$idsubject"."c0r0.html>Lớp cần gia sư ".$valueSubject->SubjectName." </a>";
			// }
			// //lớp học.
			// $lophoc=$this->db->select('id,name');
			// $lophoc=$this->db->get('lophoc')->result();
			// foreach ($lophoc as $valueClass) {
			// 	$idClass=$valueClass->id;
			// 	$linkClass[]="<a href=".base_url()."tim-lop-gia-su-".vn_str_filter($valueClass->name)."-s0c0r$idClass.html>Lớp cần gia sư ".$valueClass->name." </a>";
			// }
			// //tỉnh thành.
			// for($i=1;$i<64;$i++){
			// 	$tinhthanh=Getcitybyindex($i); //get tỉnh thành
			// 	$linkCity[]="<a href=".base_url()."tim-lop-gia-su-tai-".vn_str_filter($tinhthanh)."-s0c$i"."r0.html>Lớp cần gia sư tại ".$tinhthanh." </a>";
			// }
			$data['linkClass']=$linkClass;
			$data['linkSubject']=$linkSubject;
			$data['linkCity']=$linkCity;
			$data['lstitem']=$this->site_model->AllGetTopClassByMoney(8);
			$data['newitem']=$this->site_model->GetTopClassByMoney(20);
			$data['monhoc']=$this->site_model->ListSubject();

			$data['lstonline']=$this->site_model->GetListClassbyUserOnline();

			$data['canonical']=base_url()."tat-ca-lop-hoc";
			//$data['amp']=site_url('amp');

			$data['robots']= 'index,follow';
			$data['content']='allteacher';
			$data['classheader']='navbar navbar-default white bootsnav on no-full';
			$data['cssbody']='customsl'	;//
			$this->load->view('template',$data);
	}
		function DetailClass($alias,$id)
		{
				$data['home'] = false;
				$data['showsearch']=true;
				$itemclass=$this->site_model->GetFirstClass($id);
				if($itemclass !=""){
					$alias1=vn_str_filter($itemclass->ClassTitle);
					if($alias!=$alias1){
						$url=site_url().'lop-hoc/'.$alias1.'-'.$id;
						header("HTTP/1.1 301 Moved Permanently");
						header("location: ".$url); exit;
						// redirect(site_url().'lop-hoc/'.$alias1.'-'.$id);
					}
				$data['meta_title']=$itemclass->ClassTitle;
				$data['meta_key']=$itemclass->MetaKeywork;
				$data['meta_des']=$itemclass->DescClass;
				$data['item']=$itemclass;
				$data['monhoc']=$this->site_model->ListSubject();
				$data['relative']=$this->site_model->GetListClassRelative($itemclass->ClassID,$itemclass->SubjectID);
				//$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
				//$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
				//$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
				//$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
				//$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
				if(isset($_SESSION['viewclass']) || !empty($_SESSION['viewclass'])){
						$tgview=$_SESSION['viewclass'];
						$tgview=explode(',',$tgview);
						$tgview[]=$id;
						if(!in_array($id,$tgview,true)){
								$countview=$this->site_model->addviewclass($id);
								$data['countview']=$countview;
						}else{
								$countview=$this->site_model->getviewclassid($id);
								$data['countview']=$countview;
						}
				}else{
						$countview=$this->site_model->addviewclass($id);
						$data['countview']=$countview;
						$tgview[]=$id;
						$_SESSION['viewclass']=join(',',$tgview);
				}
				$data['canonical']=base_url().'lop-hoc/'.$alias1.'-'.$id;
				$data['robots']= 'noindex,nofollow';
				$data['content']='detailclass';
				$data['classheader']='navbar navbar-default white bootsnav on no-full';
				$data['cssbody']='customsl'	;
				$this->load->view('template',$data);
				//$data['amp']=site_url('amp');
				}else{
						// redirect(site_url());
						show_404();
				}

		}
		function DetailTeacher($alias,$id)
    {
        $data['home'] = false;
        $data['showsearch']=true;
        $itemclass=$this->site_model->GetFirstTeacher($id);
        if($itemclass !=""){
					$alias1=vn_str_filter($itemclass->Name);
					if($alias!=$alias1){
						$url=site_url().$alias1.'-gv'.$id;
						header("HTTP/1.1 301 Moved Permanently");
						header("location: ".$url); exit;
					}
				$data['meta_title']=$itemclass->Name." | Gia sư 123 | Vieclam123.vn";
				$data['meta_key']="Gia sư ".$itemclass->WorkingName.", trung tâm gia sư,".$itemclass->TitleView;
				$data['meta_des']=$itemclass->Description;
        $data['item']=$itemclass;
				$data['imageog']=gethumbnail(geturlimageAvatar(strtotime($itemclass->CreateDate)).$itemclass->Image,$itemclass->Image,strtotime($itemclass->CreateDate),180,180,100);

        if(isset($_SESSION['viewteacher']) && !empty($_SESSION['viewteacher'])){
            $tgview=$_SESSION['viewteacher'];
            $tgview=explode(',',$tgview);
            if(in_array(strtolower($id),$tgview,true)===false){
                $tgview[]=$id;
                $countview=$this->site_model->addviewuserid($id);
                $data['countview']=$countview;
            }else{

                $countview=$this->site_model->getviewuserid($id);
                $data['countview']=$countview;
            }
            $_SESSION['viewteacher']=join(',',$tgview);
        }else{
            $countview=$this->site_model->addviewuserid($id);
            $tgview[]=$id;
            $_SESSION['viewteacher']=join(',',$tgview);
            $data['countview']=$countview;
        }
        $data['monhoc']=$this->site_model->ListSubject();
        //$data['relative']=$this->site_model->GetListClassRelative($itemclass->ClassID,$itemclass->SubjectID);
        $data['moreteach']=$this->site_model->GetTeacherMore($id);
        $data['lstonline']=$this->site_model->GetTeacherOnline(10);
				$data['canonical']=base_url().$alias1.'-gv'.$id;
        $data['robots']= 'noindex,nofollow';
        $data['content']='detailteacher';
				$data['topic']=$this->site_model->GetTopicbyUserID($id);
        }else{
            redirect(site_url());
        }
				$data['showcontact']=true;
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl'	;
        $this->load->view('template',$data);
    }
    // Lionel 11 $order thay moi $order = ''
		function TeacherAll($order = '') 
    {
        if(!isset($order)||empty($order)){
            $order='last';
        }
        $page=$start_row=$this->uri->segment(2);
        $data['home'] = false;
        $data['showsearch']=true;
				$sql=$this->site_model->gettblwidthid('tbl_meta',6);
				$data['meta_key']=$sql->metakeywork;
				$data['meta_title']=$sql->title;
				$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $perpage=10;
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }
        if($page <= 10){
					$data['robots']= 'index,follow';
        }else{
           $data['robots']= 'noindex,follow';
        }
        $keywork='';
        $subject=0;$topic=0;$place=0;$type=0;$sex=0;
        $data['keywork']=$keywork;
        $result=$this->site_model->GetListTeacherBySearch($keywork,$subject,$topic,$place,$type,$sex,$order,$page,$perpage);
        $data['linkSubject']=$linkSubject;
        $data['linkClass']=$linkClass;
        $data['linkCity']=$linkCity;
        $link=base_url()."tat-ca-giao-vien&order=".$order;
        $data['lstitem']=$result['data'];
        $this->load->library('pagination');
        $config['total_rows'] = $result['total'];
		$config['per_page'] = $perpage;
		$config['uri_segment'] =2;
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['num_links'] = 4;
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url']=$link;
		$this->pagination->initialize($config);
        $data['total']=$result['total'];
        $data['order']=$order;
		$data['start_row']= $page;
        $data['pagination']= $this->pagination->create_links();
        $data['monhoc']=$this->site_model->ListSubject();
        $data['chude']=$this->site_model->GetTeacherFeature();
        $data['lstonline']=$this->site_model->GetTeacherOnline(10);
        $data['selectbox']=base_url()."tat-ca-giao-vien&order=";

				$data['canonical']=base_url()."tat-ca-giao-vien";

				$data['robots']= 'index,follow';
        $data['content']='teacherall';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']=''	;//customsl
        $data['showsupport']=true;
        $this->load->view('template',$data);
    }
    function phuhuynhdangky()
    {
        $data['home'] = false;
        $data['showsearch']=false;
		$sql=$this->site_model->gettblwidthid('tbl_meta',1);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $data['lstitem']=$this->site_model->GetTeacherType(12);
        $data['monhoc']=$this->site_model->ListSubject();
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
		$data['canonical']=base_url()."dang-ky-nguoi-dung";
		//$data['amp']=site_url('amp');

		$data['robots']= 'noindex,nofollow';
        $data['content']='phuhuynhdangky';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl'	;//
        $this->load->view('template',$data);
    }
    function giasudangky()
    {
        $data['home'] = false;
        $data['showsearch']=false;
		$sql=$this->site_model->gettblwidthid('tbl_meta',1);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $data['lstitem']=$this->site_model->GetTeacherType(12);
        $data['monhoc']=$this->site_model->ListSubject();
		$data['canonical']=base_url()."dang-ky-gia-su";
		//$data['amp']=site_url('amp');

		$data['robots']= 'noindex,nofollow';
        $data['content']='giasudangky';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl'	;//
        $this->load->view('template',$data);
    }
    function GetListDistrict()
    {
        $province = $this->input->post('province');
        $result=$this->site_model->ListDistrictByProvince($province);
        if($result != null){
           echo json_encode(array('kq'=>$result));
        }else{
            echo json_encode(array('kq'=>''));
        }

    }
    function register()
    {

		$sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']="Đăng ký tài khoản miễn phí tại website";//$sql->meta_title;
		$data['meta_key']="Đăng ký tài khoản miễn phí tại website";//$sql->meta_key;
		$data['meta_des']="Đăng ký tài khoản miễn phí tại website";//$sql->meta_des;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
		$data['canonical']=base_url();
		$data['robots']= 'noindex,follow';

        $data['content']='register';
        $data['home'] = false;
        $data['showsearch']=false;
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl';//
        $this->load->view('template',$data);
    }
    function registernhatuyendung()
    {
		$data['home'] = false;
        $data['showsearch']=false;
		$sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']="Đăng ký tài khoản miễn phí tại website";//$sql->meta_title;
		$data['meta_key']="Đăng ký tài khoản miễn phí tại website";//$sql->meta_key;
		$data['meta_des']="Đăng ký tài khoản miễn phí tại website";//$sql->meta_des;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
		$data['canonical']=base_url();
		$data['robots']= 'noindex,follow';

        $data['content']='registernhatuyendung';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl';//
        $this->load->view('template',$data);
    }
    function hoanthienhoso()
    {
        $data['home'] = true;
		$sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']="Hoàn thiện hồ sơ ứng viên tại vieclam24h.net.vn";//$sql->meta_title;
		$data['meta_key']="Hoàn thiện hồ sơ ứng viên tại website vieclam24h.net.vn";//$sql->meta_key;
		$data['meta_des']="Hoàn thiện hồ sơ ứng viên tại website vieclam24h.net.vn";//$sql->meta_des;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
		$data['canonical']=base_url();
		$data['robots']= 'index,follow';

        $data['content']='hoanthienhoso';
        $data['classheader']='inner-pagenavbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';
        $this->load->view('template',$data);
    }
    function contactus()
    {
        $data['home'] = true;
		$sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']="Liên hệ với chúng tôi";//$sql->meta_title;
		$data['meta_key']="Liên hệ với chúng tôi";//$sql->meta_key;
		$data['meta_des']="Liên hệ với chúng tôi";//$sql->meta_des;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
		$data['canonical']=base_url();
		$data['robots']= 'index,follow';

        $data['content']='contactus';
        $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';
        $this->load->view('template',$data);
    }
    function createjobfree()
    {
        $data['home'] = true;
		$data['meta_title']="Đăng tin tuyển dụng miễn phí tại vieclam24h.net.vn";//$sql->meta_title;
		$data['meta_key']="Đăng tin tuyển dụng miễn phí tại website vieclam24h.net.vn";//$sql->meta_key;
		$data['meta_des']="Đăng tin tuyển dụng miễn phí tại website vieclam24h.net.vn";//$sql->meta_des;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
		$data['canonical']=base_url();
		$data['robots']= 'index,follow';

        $data['content']='createjobfree';
        $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';
        $this->load->view('template',$data);
    }
    function confirmuser($code,$email){

        //var_dump($code,$email,$type);
		$sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']="Xác nhận đăng ký tài khoản vieclam24h.net.vn";//$sql->meta_title;
		$data['meta_key']="Xác nhận đăng ký tài khoản vieclam24h.net.vn";//$sql->meta_key;
		$data['meta_des']="Xác nhận đăng ký tài khoản vieclam24h.net.vn";//$sql->meta_des;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $type=0;
        //$result=$this->site_model->getconfirmuser($code,$email,$type);
        $data['itemconfirm']=$result;
        $data['username']=$email;
		$data['canonical']=base_url();
		$data['robots']= 'noindex,nofollow';
        $data['content']='confirmuser';
        $data['home'] = false;
        $data['showsearch']=false;
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl';//
        $this->load->view('template',$data);
    }
		function registercandi()
    {
			if(empty($_POST)){
				show_404();
			}else{
				$hoten=$_POST['hoten'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $city=$_POST['city'];
        $ngaysinh=$_POST['ngaysinh'];
        $gioitinh=$_POST['gioitinh'];
        $honnhan=$_POST['honnhan'];
        $cvtitle=$_POST['cvtitle'];
        $bangcap=$_POST['bangcap'];
        $hinhthuclamviec=$_POST['hinhthuclamviec'];
        $capbac=$_POST['capbac'];
        $noilamvieckhac=$_POST['noilamvieckhac'];
        $nganhnghe=$_POST['nganhnghe'];
        //$extrann=['extrann'];
        $muctieu=$_POST['muctieu'];
        $kynang= $_POST['kynang'];
        $diachi=$_POST['diachi'];
        $mucluong=$_POST['mucluong'];
        $kinhnghiem=$_POST['kinhnghiem'];
        $nganhnghe2=$_POST['nganhnghe2'];
        $nganhnghe1=$_POST['nganhnghe1'];
        // mới thêm
        $district=$_POST['district'];
        $school=$_POST['school'];
        $schooltype=$_POST['schooltype'];
        $xeploaihoctap=$_POST['xeploaihoctap'];
        $languagecandi=$_POST['languagecandi'];
        $sms=$_POST['sms'];
        $result=['kq'=>false];
        if(intval($nganhnghe1) > 0){
            $extrann[]=$nganhnghe1;
        }
        if(intval($nganhnghe2)>0){
            $extrann[]=$nganhnghe2;
        }
        $extrann=join(',',$extrann);
        $kq=$this->site_model->RegisterCandi($hoten,$email,$pass,$phone,$city,$ngaysinh,$gioitinh,$honnhan,$cvtitle,$bangcap,$hinhthuclamviec,$capbac,$noilamvieckhac,$nganhnghe,$extrann,$muctieu,$kynang,$diachi,$mucluong,$kinhnghiem,$district,$school,$schooltype,$xeploaihoctap,$languagecandi);

        if($kq['userid']>0){
            $code=$kq['code'];
            $iscall=0;
						//tại đây auto tặng 5 điểm mỗi user sau khi đăng ký thành công.
						$configpoint=$this->site_model->getpointconfig();
						$Trace="users_0";
						$this->site_model->addlogpoint($kq['userid'],1,$configpoint->PointPerDay,1,$Trace);
						//kết thúc.
            if(intval($sms)==1){
               $arrp=['VTT','VMS','VNP'];
               $re=gettelcofromphonenumber($username);
                if(in_array($re, $arrp)){
                $kqua=$this->site_model->updateuserssendsms($kq['userid'],$sms);
                $arrphone=['phone_number'=>"'$phone'",'name'=>"'$hoten'"];
                $message=buildsendautocall($arrphone,$code);//formatsmsmessage(2,$code);
                $Statuscode=1;//sendsms($username,$message);
                $iscall=1;
                }else{
                    // date_default_timezone_set("Asia/Bangkok");
                    // $gio= date("H",time());
                    // if(intval($gio) >7 && $gio < 22 ){
                        $message=formatsmsmessage(2,$code);
                        $Statuscode=sendsms($username,$message);
                    // }
                }
            }elseif(intval($sms)==2){
                // date_default_timezone_set("Asia/Bangkok");
                // $gio= date("H",time());
                // if(intval($gio) >7 && $gio < 22 ){
                    $message=formatsmsmessage(2,$code);
                    $Statuscode=sendsms($username,$message);
                // }else{
                //     $arrphone=['phone_number'=>"'$phone'",'name'=>"'$hoten'"];
                //     $message=buildsendautocall($arrphone,$code);//formatsmsmessage(2,$code);
                //     $Statuscode=1;//sendsms($username,$message);
                //     $iscall=1;
                // }
            }

						$token=$this->site_model->create_token($kq['userid'],time(),0);
						$profileData = array(
												 "UserId" => $kq['userid'],
												 "UserName" => $email,
												 "EmailAddress" => '',
												 "FullName" => $hoten,
												 "Phone"=>$email,
												 "TokentKey" => $token,
												 "Type"=>3,
												 "Balance"=>0);
						$_SESSION['UserInfo']=$profileData;
            $smslog=$this->site_model->InsertLogSms($code,$Statuscode,'1',$iscall);
						// $_SESSION['UserInfo'] = $profileData;
						$result=['kq'=>true,'msg'=>'Bạn vui lòng kiểm tra email để kích hoạt tài khoản'.strtotime($ngaysinh),'code'=>"$code",'uname'=>"$phone"];
        }else{
            if($kq['check']==true){
               $result= ['kq'=>false,'check'=>true,'data'=>'Vượt quá số lần đăng ký'];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}
    }
		function registercompany()
    {
			if(empty($_POST)){
				show_404();
			}else{
				$tencongty=$_POST['tencongty']; //ten cong ty
        $phone=$_POST['phone']; //sdt dung de dang ki(username).
        $email=$_POST['email'];//email cong ty
        $city=$_POST['city'];
        $pass=$_POST['pass'];
        $website=$_POST['website'];
        $addresscom=$_POST['addresscom'];
        $sms=$_POST['sms'];
				$checkname= $this->site_model->checknamecty($tencongty);
				if(empty($checkname)){
        $kq=$this->site_model->RegisterCompany($tencongty,$phone,$email,$city,$pass,$website,$addresscom);
        if($kq['userid']>0){
            $code=$kq['code'];
            $iscall=0;
            if(intval($sms)==1){
                $arrp=['VTT','VMS','VNP'];
               $re=gettelcofromphonenumber($username);
                if(in_array($re, $arrp)){
                $kqua=$this->site_model->updateuserssendsms($kq['userid'],$sms);
                 $arrphone=['phone_number'=>"'$phone'",'name'=>"'$tencongty'"];
            //kichhoattaikhoan?c=<%code%>&u=<%email%>
        //$resultautocall=buildsendautocall($arrphone,$code);
                $message=buildsendautocall($arrphone,$code);//formatsmsmessage(2,$code);
                $Statuscode=1;//sendsms($username,$message);
                //$k1=$this->site_model->updatecomfirmiscall($kq['userid'],$code);
                $iscall=1;
                }else{
                    // date_default_timezone_set("Asia/Bangkok");
                    // $gio= date("H",time());
                    // if(intval($gio) >7 && $gio < 22 ){
                        $message=formatsmsmessage(2,$code);
                        $Statuscode=sendsms($username,$message);
                    // }
                }

            }else{
                // date_default_timezone_set("Asia/Bangkok");
                // $gio= date("H",time());
                // if(intval($gio) >7 && $gio < 22 ){
                    $message=formatsmsmessage(2,$code);
                    $Statuscode=sendsms($username,$message);
                // }else{
                //     $arrphone=['phone_number'=>"'$phone'",'name'=>"'$hoten'"];
                //     //kichhoattaikhoan?c=<%code%>&u=<%email%>
                //     //$resultautocall=buildsendautocall($arrphone,$code);
                //     $message=buildsendautocall($arrphone,$code);//formatsmsmessage(2,$code);
                //     $Statuscode=1;//sendsms($username,$message);
                //     //$k1=$this->site_model->updatecomfirmiscall($kq['userid'],$code);
                //     $iscall=1;
                // }

            }
						$configpoint=$this->site_model->getpointconfig();
						$Trace="users_0";
						$this->site_model->addlogpoint($kq['userid'],1,$configpoint->PointPerDay,1,$Trace);
						$token=$this->site_model->create_token($kq['userid'],time(),0);
						$profileData = array(
												 "UserId" => $kq['userid'],
												 "UserName" => $phone,
												 "EmailAddress" => $email,
												 "FullName" => $tencongty,
												 "Phone"=>$phone,
												 "TokentKey" => $token,
												 "Type"=>4,
												 "Balance"=>0);
						$_SESSION['UserInfo']=$profileData;

            $smslog=$this->site_model->InsertLogSms($code,$Statuscode,'1',$iscall);
            $result=['kq'=>true,'msg'=>'Bạn vui lòng kiểm tra email để kích hoạt tài khoản','code'=>"$code",'uname'=>"$phone"];
        }else{
            if($kq['check']==true){
                $result=['kq'=>false,'check'=>true,'data'=>'Vượt quá số lần đăng ký'];
            }
        }
			}
			else{
					$result=['data'=>'Tên công ty đã tồn tại'];
			}
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}

    }
    function delcookiephp()
    {
        $result=['kq'=>false];
        if(isset($_COOKIE['jobedu'])){
        unset($_COOKIE['jobedu']);
        unset($_COOKIE['jobexperion']);
        unset($_COOKIE['joblevel']);
        unset($_COOKIE['jobupdate']);

        $result=['kq'=>true];
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
    function searchjob()
    {
        $result=['kq'=>false,'data'=>''];
        $findkey=$_POST['findkey'];
        $location=$_POST['location'];
        $nganhnghe=$_POST['nganhnghe'];
        $type=$_POST['type'];
        if(intval($type)<=1){
            if(empty($findkey) && (intval($location)<1) && (intval($nganhnghe)<1)){
                $link=base_url().'tim-viec-lam.html';

            }else if(empty($findkey) && ((intval($location)>=1) || (intval($nganhnghe)>=1))){
                $urltt="";
                if(intval($location)>=1){
                    $urltt="-tai-".vn_str_filter(Getcitybyindex($location));
                }
                $urlnn="";
                if(intval($nganhnghe)>=1){
                    $urlnn="-".vn_str_filter(GetCategory($nganhnghe));
                }
                $link=base_url()."viec-lam".$urlnn.$urltt."-c".$nganhnghe."p".$location.".html";
            }else{
                $link=base_url()."tim-viec-lam&keywork=".$findkey."&dd=".$location."&nn=".$nganhnghe;
            }
        }
        $result=['kq'=>true,'data'=>$link];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
    function ResultJobFilter($keywork,$dd,$nn){
         $page=$start_row=$this->uri->segment(2);
        $cookjobedu = $_COOKIE['jobedu'];
        $cookjobexperion = $_COOKIE['jobexperion'];
        $cookjoblevel = $_COOKIE['joblevel'];
        $cookjobupdate = $_COOKIE['jobupdate'];
        $perpage=30;
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }
		$data['home'] = true;
		$sql=$this->site_model->gettblwidthid('tbl_meta',2);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        if($page <= 29){
		$data['robots']= 'noindex,nofollow';
        }else{
           $data['robots']= 'noindex,follow';
        }
        $arrparramnew=['nganhnghe'=>$nn,'keywork'=>$keywork,'diadiem'=>$dd,'type'=>$type];

        // nhà tuyển dụng nổi bật
        //if(!isset($_SESSION['companyforlistjob']) || empty($_SESSION['companyforlistjob'])){
//
//            $_SESSION['companyforlistjob']=$this->site_model->GetTopCompany(12);
//            $data['congtymoinhat']=$_SESSION['companyforlistjob'];
//        }else{
//            $data['congtymoinhat']=$_SESSION['companyforlistjob'];
//        }
        $result=$this->site_model->GetListJobforfilter($keywork,$cookjobedu,$cookjobexperion,$cookjoblevel,$cookjobupdate,$idnn,$idpro,$page,$perpage);
        $link=base_url()."tim-viec-lam&keywork=".$keywork."&dd=".$dd."&nn=".$nn;
        $data['itemjob']=$result['data'];
        $this->load->library('pagination');
        $config['total_rows'] = $result['total'];
		$config['per_page'] = $perpage;
		$config['uri_segment'] =2;
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['num_links'] = 4;
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url']=$link;
		$this->pagination->initialize($config);
        $data['total']=$result['total'];
        $data['conhan']=$result['total'];
		$data['start_row']= $page;
        $data['pagination']= $this->pagination->create_links();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(12);

        $data['canonical']=$link;
        //if(!isset($_SESSION['expcheck']) || empty($_SESSION['expcheck'])){
//            $_SESSION['expcheck']=$this->site_model->GetCountJobByEXP();
//            $data['filterexp']=$_SESSION['expcheck'];
//            }
//            else{
//              $data['filterexp']=$_SESSION['expcheck'];
//            }
        //Loc bang cap
        //if(!isset($_SESSION['educheck']) || empty($_SESSION['educheck'])){
//            $_SESSION['educheck']=$this->site_model->GetCountJobbyEdu();
//            $data['filteredu']=$_SESSION['educheck'];
//            }
//            else{
//              $data['filteredu']=$_SESSION['educheck'];
//            }
        //lọc cấp bậc
        //if(!isset($_SESSION['levelcheck']) || empty($_SESSION['levelcheck'])){
//            $_SESSION['levelcheck']=$this->site_model->GetCountJobByLevel();
//            $data['filterlevel']=$_SESSION['levelcheck'];
//            }
//            else{
//              $data['filterlevel']=$_SESSION['levelcheck'];
//            }
        // loc tinh thanh
        //unset($_SESSION['citycheck']);
        //if(!isset($_SESSION['citycheck']) || empty($_SESSION['citycheck'])){
//            $_SESSION['citycheck']=$this->site_model->GetCountJobByProvince(4,$nn,$dd,$keywork);
//            $data['city']=$_SESSION['citycheck'];
//        }else{
//            if($keywork != $arrparram['keywork']){
//                $_SESSION['citycheck']=$this->site_model->GetCountJobByProvince(4,$nn,$dd,$keywork);
//            }
//            $data['city']=$_SESSION['citycheck'];
//        }
        //unset($_SESSION['categorycheck']);
        //loc danh mục
        //if(!isset($_SESSION['categorycheck']) || empty($_SESSION['categorycheck'])){
//            $_SESSION['categorycheck']=$this->site_model->GetCounJobByCategory(4,$nn,$dd,$keywork);
//            $data['category']=$_SESSION['categorycheck'];
//        }else{
//            if($keywork != $arrparram['keywork']){
//                $_SESSION['categorycheck']=$this->site_model->GetCounJobByCategory(4,$nn,$dd,$keywork);
//                }
//            $data['category']=$_SESSION['categorycheck'];
//        }
        $arrparram=['nganhnghe'=>$nn,'keywork'=>$keywork,'diadiem'=>$dd,'type'=>$type];
        $data['params']=$arrparram;
        $data['content']='resultjobfilter';
        $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';
        $this->load->view('template',$data);
    }
    function homejobparttime()
    {
        $data['home'] = false;
        $data['showsearch']=false;
				$sql=$this->site_model->gettblwidthid('tbl_meta',2);
				$data['meta_key']=$sql->metakeywork;
				$data['meta_title']=$sql->title;
				$data['meta_des']=$sql->metadesc;
		// $data['meta_title']='Việc làm thêm | Vieclam123.vn';
		// $data['meta_des']='Danh sách việc làm thêm uy tín cho sinh viên và người đi làm. Tại Vieclam123.vn, tìm kiếm việc làm thêm chưa bao giờ nhanh chóng và đơn giản hơn. Tham khảo ngay!';
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $data['parttime']=$this->site_model->GetTopNewParttime(6);
        $data['tinmoinhat']=$this->site_model->GetFeaturedParttime(8);
        $data['tinfulltime']=$this->site_model->GetTopNewFulltime(8);
        $data['monhoc']=$this->site_model->ListSubject();
		$data['canonical']=base_url()."tong-hop-viec-lam-them";
		$data['robots']= 'index,follow';
        $data['content']='homejobparttime';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl'	;//
        $this->load->view('template',$data);
    }
    function ajaxsearchparttime()
    {
			if(!empty($_POST)){
				$key=$_POST['key'];
				$ca=$_POST['ca'];
				$nganh=$_POST['nganh'];
				$tinh=$_POST['tinh'];
				if(empty($key)){
						$keyword="all";
				}else{
						$keyword=$key;
				}

				$link=base_url()."tim-viec-lam-them&key=".$keyword."&c=".intval($ca)."&n=".intval($nganh)."&t=".intval($tinh)."";
				$result=['kq'=>true,'data'=>$link];
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function resultsearchparttime($key,$ca,$nganh,$tinh)
    {
        $page=$start_row=$this->uri->segment(2);
        $perpage=30;
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }
        $data['home'] = false;
        $data['showsearch']=false;
				$sql=$this->site_model->gettblwidthid('tbl_meta',1);
				$data['meta_title']=$sql->title;
				$data['meta_key']=$sql->metakeywork;
				$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        //tim-viec-lam-them&key=(:any)?&c=(:num)&n=(:num)&t=(:num)
        if($key=='all' || empty($key)){
            $keywork='all';
        }else{
            $keywork=$key;
        }
        $data['fillkey']=['key'=>$key,'ca'=>$ca,'nganh'=>$nganh,'tinh'=>$tinh];
        $link=base_url()."tim-viec-lam-them&key=".$keywork."&c=".intval($ca)."&n=".intval($nganh)."&t=".intval($tinh)."";
        $data['parttime']=$this->site_model->ResultNewParttime($key,$ca,$nganh,$tinh,$page,$perpage);
        //$data['tinmoinhat']=$this->site_model->GetFeaturedParttime(8);
        $data['tinfulltime']=$this->site_model->GetTopNewFulltime(8);
        $data['monhoc']=$this->site_model->ListSubject();
        //page
        $total=$this->site_model->CountResultNewParttime($key,$ca,$nganh,$tinh);
        $this->load->library('pagination');
        $config['total_rows'] = $total;
				$config['per_page'] = $perpage;
				$config['uri_segment'] =2;
				$config['next_link'] = '<i class="fa fa-angle-right"></i>';
				$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
				$config['num_links'] = 4;
				$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
				$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url']=$link;
				$this->pagination->initialize($config);
        //$data['start_row']= $page;
        $data['pagination']= $this->pagination->create_links();
        //end page
				$data['canonical']=base_url()."tim-viec-lam-them";
        if(intval($page) <=1){
					$data['robots']= 'index,follow';
        }else{
            $data['robots']= 'noindex,follow';
        }
				if(!empty($key) || !empty($ca) || !empty($nganh) || !empty($tinh) ){
					$data['robots']= 'noindex,nofollow';
				}
        $data['content']='resultsearchparttime';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl'	;//
        $this->load->view('template',$data);
    }
    function homejobfulltime()
    {
        $data['home'] = false;
        $data['showsearch']=false;
		$sql=$this->site_model->gettblwidthid('tbl_meta',3);
		$data['meta_key']=$sql->metakeywork;
		$data['meta_title']=$sql->title;
		$data['meta_des']=$sql->metadesc;

		// $data['meta_title']='Việc làm full-time | Vieclam123.vn';
		// $data['meta_des']='Vieclam123.vn cung cấp danh sách việc làm full time uy tín, mới nhất 2019 cho các ứng viên tìm kiếm việc làm và có công việc ổn định và nhanh chóng nhất';

        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $data['parttime']=$this->site_model->GetTopNewParttime(6);
        $data['tinmoinhat']=$this->site_model->GetFeaturedAllJob(8);
        $data['tinfulltime']=$this->site_model->GetTopNewFulltime(12);

        $data['topcat']=$this->site_model->gettopcountjobbycat();
        $data['topcandi']=$this->site_model->gettopcandidate(8);
        $data['jobit']=$this->site_model->GetITJob(3);
        $data['jobmanager']=$this->site_model->getjobmanager(3);
        $data['jobstudent']=$this->site_model->getjobstudent(3);
		$data['canonical']=base_url()."viec-lam-full-time";
		$data['robots']= 'index,follow';
        $data['content']='homejobfulltime';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl'	;//
        $this->load->view('template',$data);
    }
    function ajaxsearchfulltime()
    {
			if(!empty($_POST)){
				$key=$_POST['key'];
        $nganh=$_POST['nganh'];
        $tinh=$_POST['tinh'];
        if(empty($key)){
            $keyword="all";
        }else{
            $keyword=$key;
        }
        $link=base_url()."tim-viec-lam&keywork=".$keyword."&n=".intval($nganh)."&t=".intval($tinh)."";
        $result=['kq'=>true,'data'=>$link];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function resultsearchjobfulltime($key,$nganh,$tinh)
    {

        $page=$start_row=$this->uri->segment(2);
        $perpage=15;
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }

				$sql=$this->site_model->gettblwidthid('tbl_meta',1);
				$data['meta_title']=$sql->title;
				$data['meta_key']=$sql->metakeywork;
				$data['meta_des']=$sql->metadesc;
        if($key=='all' || empty($key)){
            $keywork='all';
        }else{
            $keywork=$key;
        }
        $data['fillkey']=['key'=>$key,'ca'=>$ca,'nganh'=>$nganh,'tinh'=>$tinh];
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $link=base_url()."tim-viec-lam&keywork=".$keyword."&n=".intval($nganh)."&t=".intval($tinh)."";
        $data['tinfulltime']=$this->site_model->GetResultNewFulltime($key,$nganh,$tinh,$page,$perpage);

        //page
        $total=$this->site_model->GetCountResultNewFulltime($key,$nganh,$tinh);
        $this->load->library('pagination');
        $config['total_rows'] = $total;
				$config['per_page'] = $perpage;
				$config['uri_segment'] =2;
				$config['next_link'] = '<i class="fa fa-angle-right"></i>';
				$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
				$config['num_links'] = 4;
				$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
				$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url']=$link;
				$this->pagination->initialize($config);
        //$data['start_row']= $page;
        $data['pagination']= $this->pagination->create_links();
        //$data['parttime']=$this->site_model->GetTopNewParttime(6);
        $data['tinmoinhat']=$this->site_model->GetFeaturedAllJob(4);
        //$data['tinfulltime']=$this->site_model->GetTopNewFulltime(12);

        $data['topcat']=$this->site_model->gettopcountjobbycat();
        $data['topcandi']=$this->site_model->gettopcandidate(4);
        $data['jobit']=$this->site_model->GetITJob(3);
        $data['jobmanager']=$this->site_model->getjobmanager(3);
        $data['jobstudent']=$this->site_model->getjobstudent(3);
				$data['canonical']=base_url()."tim-viec-lam";
				$data['robots']= 'noindex,follow';
				if(!empty($key) || !empty($nganh) || !empty($tinh)){
					$data['robots']='noindex,nofollow';
				}
        $data['content']='resultsearchjobfulltime';
        $data['home'] = false;
        $data['showsearch']=false;
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl'	;//
        $this->load->view('template',$data);
    }
    function ListJobByFilter($aliasnn,$aliaspro,$idnn,$idpro)
    {
        $page=$start_row=$this->uri->segment(2);
        $cookjobedu = $_COOKIE['jobedu'];
        $cookjobexperion = $_COOKIE['jobexperion'];
        $cookjoblevel = $_COOKIE['joblevel'];
        $cookjobupdate = $_COOKIE['jobupdate'];
        $perpage=30;
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }
		$data['home'] = true;

        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }

        $data['querystring']=$aliasnn."-".$aliaspro."-".$idnn."-".intval($idpro).'=='.$page."---".$cookjobedu;
        $result=$this->site_model->GetListJobbyCatAndProvince($cookjobedu,$cookjobexperion,$cookjoblevel,$cookjobupdate,$idnn,$idpro,$page,$perpage);
        $total=$result['total'];
        if((intval($idpro)<1) && (intval($idnn)<1))	{
            $link=base_url().'tim-viec-lam.html';
            $data['textcrum']="Tin tuyển dụng";
            $sql=$this->site_model->gettblwidthid('tbl_meta',2);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        }else{
            $urltt="";
            $txtcrum="";
            $txtcrum1="";
            $mttitle="";
            $mtdes="";
            $mtkey="";
                if(intval($idpro)>=1){
                    $urltt="-tai-".vn_str_filter(Getcitybyindex($idpro));
                    $txtcrum=" tại ".Getcitybyindex($idpro);
                    if(intval($idnn)<=0){
                        //"số lượng tin tuyển dụng" + việc làm mọi ngành nghề đang có nhu cầu tuyển dụng tại + "tên tỉnh thành" với mức lương hấp dẫn, môi trường làm việc chuyên nghiệp, năng động. Tìm hiểu thêm chi tiết tại timvieclam365.net
                        $mttitle=$total." việc làm có nhu cầu tuyển dụng tại ".Getcitybyindex($idpro);
                        $mtdes=$total." việc làm mọi ngành nghề đang có nhu cầu tuyển dụng tại ".Getcitybyindex($idpro)." với mức lương hấp dẫn, môi trường làm việc chuyên nghiệp, năng động. Tìm hiểu thêm chi tiết tại timvieclam365.net ";
                        $mtkey="Tuyển dụng nhanh việc làm tại ".Getcitybyindex($idpro);
                    }
                }
                $urlnn="";
                if(intval($idnn)>=1){
                    $urlnn="-".vn_str_filter(GetCategory($idnn));
                    $txtcrum1=GetCategory($idnn);
                    if(intval($idpro)<=0){
                        //Tìm việc làm + "tên ngành nghề"
                        $mttitle="Có ".$total." việc làm nhanh ".GetCategory($idnn)." mới nhất ";
                        $mtdes="Tuyển dụng việc làm ngành ".GetCategory($idnn)." mới nhất ".date('Y',time())." với mức lương hấp dẫn, môi trường làm việc chuyên nghiệp được cập nhật trên timviec365.net";
                        $mtkey="Tìm việc làm ".GetCategory($idnn);
                    }
                }
                if(intval($idnn)>=1 && intval($idpro)>=1){
                    //Có + "số lượng tin tuyển dụng" + việc làm ngành + "tên ngành nghề" + tại + "tên tỉnh thành" + đang chờ bạn. Tìm hiểu chi tiết tại timvieclam365.net
                        $mttitle="Có ".$total." việc làm ngành ".GetCategory($idnn)." uy tín tại ".Getcitybyindex($idpro);
                        $mtdes="Có ".$total." việc làm ngành ".GetCategory($idnn)." tại ".Getcitybyindex($idpro)." đang chờ bạn. Tìm hiểu chi tiết tại timviec365.net";
                        $mtkey="việc làm ngành ".GetCategory($idnn)." tại ".Getcitybyindex($idpro);
                }
		$data['meta_title']=$mttitle;
		$data['meta_key']=$mtdes;
		$data['meta_des']=$mtkey;
                $link=base_url()."viec-lam".$urlnn.$urltt."-c".$idnn."p".$idpro.".html";
                $data['textcrum']="Việc làm ".$txtcrum1.$txtcrum;
        }
		$data['canonical']=$link;

        $data['checkpro']=intval($idpro);
        $data['checkcat']=intval($idnn);

        $data['itemjob']=$result['data'];
        $this->load->library('pagination');
        $config['total_rows'] = $total->sobanghi;
		$config['per_page'] = $perpage;
		$config['uri_segment'] =2;
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['num_links'] = 4;
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url']=$link;
		$this->pagination->initialize($config);
        $data['total']=$total->sobanghi;
        $data['conhan']=$total->tinconhan;
		$data['start_row']= $page;
        $data['pagination']= $this->pagination->create_links();
		//$data['amp']=site_url('amp');
        if($page <= 29){
		$data['robots']= 'noindex,nofollow';
        }else{
           $data['robots']= 'noindex,follow';
        }

        $data['content']='ListJobByFilter';
        $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';
        $this->load->view('template',$data);
    }
    function searchcompany()
    {
        $result=['kq'=>false,'data'=>''];
        $findkey=$_POST['findkey'];

        if($findkey != ''){
            $link=base_url()."nha-tuyen-dung&keywork=".$findkey."&c=0&n=0&type=1";
            $result=['kq'=>true,'data'=>$link];
        }

        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
    function ListCompanyByFilter($keywork,$c,$n,$type)
    {
        $page=$start_row=$this->uri->segment(2);
        $perpage=21;
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }
		$data['home'] = true;
        if(!isset($c)){
            $c=0;
        }
        if(!isset($keywork)){
            $keywork='';
        }
        if(!isset($n)){
            $n=0;
        }
        if(!isset($type)){
            $type=1;
        }
        if($type > 4 || $n> 100 || $c>100){
            redirect(site_url());
        }else{
		$sql=$this->site_model->gettblwidthid('tbl_meta',3);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $arrparramnew=['cate'=>$c,'keywork'=>$keywork,'nganhnghe'=>$n,'type'=>$type];
        $arrparram=['cate'=>$c,'keywork'=>$keywork,'nganhnghe'=>$n,'type'=>$type];
        $data['fillabc']=$this->site_model->GetFilterABCByType($c,$n,1);
        $result=$this->site_model->GetLisCompanyByFillter($keywork,$n,$c,$type,$page,$perpage);
        $link=base_url()."nha-tuyen-dung&keywork=".$keywork."&c=".$c."&n=".$n."&type=".$type;
        $data['itemcom']=$result['data'];
        $this->load->library('pagination');
        $data['totalrow']=$result['total'];
        $config['total_rows'] = $result['total'];
		$config['per_page'] = $perpage;
		$config['uri_segment'] =2;
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['num_links'] = 4;
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url']=$link;
		$this->pagination->initialize($config);
        $data['total']=$total->sobanghi;
        $data['conhan']=$total->tinconhan;
		$data['start_row']= $page;
        $data['pagination']= $this->pagination->create_links();
        $data['params']=$arrparram;
		$data['canonical']=$link;
		//$data['amp']=site_url('amp');


           $data['robots']= 'noindex,follow';

        $data['content']='listcompanybyfilter';
        $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';
        $this->load->view('template',$data);
        }
    }
    function ajaxsearchcandi()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
        $findkey=$_POST['key'];
        $location=$_POST['nganh'];
        $nganhnghe=$_POST['tinh'];
        if(!empty($findkey)&& $findkey != 'all'){
            $keywork=$findkey;
        }else{
            $keywork='all';
        }
        $link=base_url()."tim-kiem-ung-vien&keywork=".$keywork."&t=".intval($nganhnghe)."&n=".intval($location);
        $result=['kq'=>true,'data'=>$link];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ResultSearchCandi($keywork,$t,$n){
        $page=$start_row=$this->uri->segment(2);
        $perpage=20;
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }


		$sql=$this->site_model->gettblwidthid('tbl_meta',4);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }

        $result=$this->site_model->FindCandiBySearch($keywork,$n,$t,$page,$perpage);
        $data['itemcandi']=$result;
        $total=$this->site_model->TotalFindCandiBySearch($keywork,$n,$t);
        if(empty($keywork) && empty($dd)&& empty($nn)){
            $link=base_url()."tim-kiem-ung-vien";
        }else{
            if(!empty($keywork)&& $keywork != 'all'){
                $findkey=$keywork;
            }else{
                $findkey='all';
            }
            $link=base_url()."tim-kiem-ung-vien&keywork=".$findkey."&t=".intval($t)."&n=".intval($n);
        }
        $data['filterkey']=['key'=>$findkey,'nganh'=>intval($n),'tinh'=>intval($t)];
        $data['textcrum']="Người tìm việc";
        $this->load->library('pagination');
        $data['totalrow']=$total;
        $config['total_rows'] = $total;
		$config['per_page'] = $perpage;
		$config['uri_segment'] =2;
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['num_links'] = 4;
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url']=$link;
		$this->pagination->initialize($config);
        $data['pagination']= $this->pagination->create_links();
		$data['canonical']=site_url('tim-kiem-ung-vien');
		//$data['amp']=site_url('amp');
        // if($page < 20){
        //   $data['robots']= 'noindex,nofollow';
        // }else{
        //     $data['robots']= 'noindex,follow';
        // }
				if(!empty($key) || !empty($t) || !empty($n)){
					$data['robots']='noindex,nofollow';
				}
		$data['tinmoinhat']=$this->site_model->GetFeaturedAllJob(4);
        $data['topcat']=$this->site_model->gettopcountjobbycat();
        $data['topcandi']=$this->site_model->gettopcandidate(4);
        $data['jobit']=$this->site_model->GetITJob(3);
        $data['jobmanager']=$this->site_model->getjobmanager(3);
        $data['jobstudent']=$this->site_model->getjobstudent(3);
        $data['content']='resultsearchcandi';
        $data['home'] = false;
        $data['showsearch']=false;
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl'	;
        $this->load->view('template',$data);
    }
    function ListCandidatebyfilter()
    {
        $page=$start_row=$this->uri->segment(2);
        $perpage=20;
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }


		$sql=$this->site_model->gettblwidthid('tbl_meta',4);
		$data['meta_title']=$sql->title;
		$data['meta_key']=$sql->metakeywork;
		$data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $result=$this->site_model->FindCandiBySearch('',0,0,$page,$perpage);
        $data['itemcandi']=$result;
        $total=$this->site_model->TotalFindCandiBySearch('',0,0);
        $link=base_url().'nguoi-tim-viec.html';
        $data['textcrum']="Người tìm việc";
        $this->load->library('pagination');
        $data['totalrow']=$total;
        $config['total_rows'] = $total;
		$config['per_page'] = $perpage;
		$config['uri_segment'] =2;
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['num_links'] = 4;
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url']=$link;
		$this->pagination->initialize($config);
        $data['pagination']= $this->pagination->create_links();
		$data['canonical']=$link;
		//$data['amp']=site_url('amp');
        if($page < 20){
          $data['robots']= 'index,follow';
        }else{
            $data['robots']= 'noindex,follow';
        }
		$data['tinmoinhat']=$this->site_model->GetFeaturedAllJob(4);
        $data['topcat']=$this->site_model->gettopcountjobbycat();
        $data['topcandi']=$this->site_model->gettopcandidate(4);
        $data['jobit']=$this->site_model->GetITJob(3);
        $data['jobmanager']=$this->site_model->getjobmanager(3);
        $data['jobstudent']=$this->site_model->getjobstudent(3);
        $data['content']='listcandidatebyfilter';
        $data['home'] = false;
        $data['showsearch']=false;
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl'	;
        $this->load->view('template',$data);
    }
    function DetailJob($alias,$id)
    {
        $jobinfo=$this->site_model->detailjobbyid($id);
        if($jobinfo != ""){
					$alias1=vn_str_filter($jobinfo->new_title);
					if($alias!=$alias1){
						$url=site_url().$alias1.'-job'.$id.'.html';
						header("HTTP/1.1 301 Moved Permanently");
						header("location: ".$url); exit;
					}
        $data['home'] = true;
		$data['meta_title']=$jobinfo->meta_title;
		$data['meta_key']=$jobinfo->meta_keywork;
		$data['meta_des']=$jobinfo->meta_desc;
        $data['itemjob']=$jobinfo;
        //$data['morejob']=$this->site_model->GetRelativeJobdetail($jobinfo->new_cat_id,$jobinfo->new_id);
        //$data['tinmoinhat']=$this->site_model->GetTopNew(7);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",7,'order by u.use_update_time desc');
		$data['canonical']=base_url().$alias1."-job".$id.".html";
		//$data['amp']=site_url('amp');
        $data['chude']=$this->site_model->GetTeacherFeature();
		$data['robots']= 'noindex,nofollow';
        $data['content']='detailjob';
        $data['showsearch']=true;
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template',$data);
        }else{
            redirect(site_url());
        }
    }
		function DetailCompany($alias,$id)
		{
				$cominfo=$this->site_model->GetDetailCompanyByID1($id);
				if($cominfo !=''){
					$alias1=vn_str_filter($cominfo->usc_company);
					if($alias!=$alias1){
						$url=site_url().$alias1.'-ntd'.$id.'.html';
						header("HTTP/1.1 301 Moved Permanently");
						header("location: ".$url); exit;
					}
				$data['home'] = true;
				$sql=$this->site_model->gettblwidthid('tbl_footer',1);
				$data['meta_title']=$cominfo->usc_company;//$sql->meta_title;
				$data['meta_key']= $cominfo->usc_company.','.$cominfo->usc_company.'tuyển dụng,việc làm tại'.$cominfo->usc_company;//$sql->meta_key;
				$data['meta_des']='Việc làm tại '.$cominfo->usc_company. ' .Nhà tuyển dụng ' .$cominfo->usc_company.' tuyển dụng việc làm lương cao hấp dẫn nhất phù hợp với người tìm việc. ID:'.$cominfo->usc_id;//$sql->meta_des;
				if(!empty($sql->name)){
						$data['metah1']=$sql->name;
				}else{
						$data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
				}
				$data['itemcom']=$cominfo;
				$data['morejob']=$this->site_model->GetMoreJobByCompany($cominfo->usc_id);
				$data['canonical']=base_url().$alias1."-ntd".$id.".html";
				$data['robots']= 'index,follow';
				$data['content']='detailcompany';
				$data['classheader']='navbar navbar-default white bootsnav on no-full';
				$this->load->view('template',$data);
				}else{
						redirect(site_url());
				}
		}

    function DetailCandidate($alias,$id)
    {
        $userinfo=$this->site_model->getcandidatebyID(intval($id));
        if($userinfo !=""){
					$alias1=vn_str_filter($userinfo->Name);
					if($alias!=$alias1){
						$url=site_url().'ung-vien/'.$alias1.'-uv'.$id.'.html';
						header("HTTP/1.1 301 Moved Permanently");
						header("location: ".$url); exit;
					}
        $data['home'] = true;
		$sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']=$userinfo->Name."vieclam24h.net.vn";//$sql->meta_title;
		$data['meta_key']=$userinfo->Name."vieclam24h.net.vn";//$sql->meta_key;
		$data['meta_des']=$userinfo->Name."vieclam24h.net.vn";//$sql->meta_des;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $data['chude']=$this->site_model->GetTeacherFeature();
        $data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
		$data['canonical']=base_url()."ung-vien/".$alias1."-uv".$id.".html";
		//$data['amp']=site_url('amp');
        $data['userinfo']=$userinfo;
		$data['robots']= 'noindex,nofollow';
        $data['content']='detailcandidate';
        $data['showsearch']=true;
        $data['home']=false;
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template',$data);
        }else{
            redirect(site_url());
        }

    }
		function show_news($alias,$id)
	    {
	        $data['id']=$id;
	        $data['showsearch']=true;
	        $data['home']=false;
	        $data['classheader']='navbar navbar-default white bootsnav on no-full';
	        if(is_numeric($id)){
	        	$query=$this->db->query('SELECT * FROM baiviet WHERE status=1 AND id='.$id);

	        }else{
	        	redirect(site_url());
	        }

	        $data['chude']=$this->site_model->GetTeacherFeature();
	        $data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
	        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",9,'order by u.use_update_time desc');
			if($query->num_rows()>0){
				$data['item']= $query->row();
				$image= $query->row()->image;
				$data['imageog']='http://localhost/ubuntu/giasu123/upload/news/thumb/'.$image;
	            $cat=$this->site_model->gettblwidthid('chuyenmuc',$data['item']->cid) ;
				if($data['item']->alias!=$alias){
					redirect(site_url($data['item']->alias.'-b'.$id.'.html'));
				}
				if($data['item']->meta_title!=''){
					$data['meta_title']=$data['item']->meta_title;
					$data['meta_key']=$data['item']->meta_key;
					$data['meta_des']=$data['item']->meta_des;
				}else{
					$data['meta_title']=$data['item']->title;
					$data['meta_key']=$data['item']->title;
					$data['meta_des']=$data['item']->title;
				}
	            $data['cat']=$cat;
				$data['canonical']=site_url($data['item']->alias.'-b'.$data['item']->id.'.html');
				$data['robots']= 'index,follow';
				$data['content']='news';
				$this->load->view('template',$data);
				}else{
					redirect(site_url());
				}
	    }

	function show_cat_sub($alias)
    {
		$start_row=$this->uri->segment(2);
		$per_page=10;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}

		//$cat=$this->memcached_library->get('key_cat_'.$id);
         $query1=$this->db->query("SELECT * FROM chuyenmuc WHERE status=1 AND alias='".$alias."'");
         if($query1->num_rows()>0){
		$cat=$query1->row();
        //var_dump($cat);die();
        $query=$this->site_model->gettbl_limited('baiviet',$cat->id,'','');

        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",9,'order by u.use_update_time desc');
		$total_rows = $query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url($cat->alias.".html");
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =2;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['cid']=$cat->id;
		$data['item']=$cat;
		if($cat->meta_title!=''){
			$data['meta_title']=$cat->meta_title;
			$data['meta_key']=$cat->meta_key;
			$data['meta_des']=$cat->meta_des;
		}else{
			$data['meta_title']=$cat->name;
			$data['meta_key']=$cat->name;
			$data['meta_des']=$cat->name;
		}
		$data['total']=$total_rows;
		$data['start_row']= $start_row;
		$data['query']=$this->site_model->gettbl_limited('baiviet',$cat->id,$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['canonical']=$config['base_url'];
        $data['chude']=$this->site_model->GetTeacherFeature();
        $data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
				$data['robots']= 'index,follow';
        $data['showsearch']=true;
        $data['home']=false;
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
				$data['content']='category_sub';
				$this->load->view('template',$data);
	        }else{
				show_404();
			}
    }

	function smtpmailer($to, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->CharSet = "UTF-8";
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
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
    function login()
    {
        $data['home'] = false;
		$sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']=$sql->meta_title;
		$data['meta_key']=$sql->meta_key;
		$data['meta_des']=$sql->meta_des;
        if(!empty($sql->name)){
            $data['metah1']=$sql->name;
        }else{
            $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
		$data['canonical']=base_url();
		//$data['amp']=site_url('amp');
        $data['showsearch']=false;
		$data['robots']= 'index,follow';

        $data['content']='login';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $this->load->view('template1',$data);
    }

    function loginuser()
    {
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        //$nhatuyendung = $this->input->post('typelogin');
        //var_dump($password,$username,$nhatuyendung);die();

            $type=4;
            $result=$this->site_model->getlogincompany($username,$password);

        //var_dump($result);die();
        //echo $result;
        if($result !=""){

            $ip = time();
            if($result->UserType ==0){
               $typedefault=1;
            }else if($result->UserType ==1){
                $typedefault=2;
            }else{
                $typedefault=$result->UserType;
            }
            $arrtype=explode(',',$result->Accounttype);
            if(!in_array($typedefault,$arrtype)){
                $arrtype[]=$typedefault;
            }
            $balance=$this->site_model->getbalace($result->UserID);
            $kqtype=$this->site_model->UpdateUserType($result->UserID,$type,join(',',$arrtype));
            //$result=json_decode($result,true);
            //var_dump($result->UserId);die();
            $token = $this->site_model->create_token($result->UserID,$ip,$type);

            $profileData = array("UserId" => $result->UserID,
                                 "UserName" => $result->UserName,
                                 "EmailAddress" => $result->Email,
                                 "FullName" => $result->Name,
                                 "TokentKey" => $token,
                                 "Type"=>$type,
                                 "Balance"=>intval($balance->Balance),
                                 "Accounttype"=>join(',',$arrtype));
                                 $_SESSION['UserInfo'] = $profileData;
            $data=array('kq'=>true,'msg'=>'dang nhap thanh cong');
            $configpoint=$this->site_model->getpointconfig();
            $Trace="users_0";
            $addpoint=$this->site_model->addlogpoint($result->UserID,1,$configpoint->PointPerDay,1,$Trace);
           // return json_encode();1 cong điệm, 2 trừ điểm
        }else{
            $data=array('kq'=>false,'msg'=>'dang nhap ko thanh cong');
            //return json_encode(array('kq'=>false,'msg'=>'dang nhap ko thanh cong'));
        }

        //return json_encode($data);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    function logincandidate()
    {
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        //var_dump($password,$username,$nhatuyendung);die();


            $type=3;
        //var_dump($username,$password);die;
        //var_dump($username,$_POST);die();
            $result=$this->site_model->getlogin($username,$password);

        //var_dump($result);die();
        //echo $result;
        if($result !=""){

            $ip = time();
            if($result->UserType ==0){
               $typedefault=1;
            }else if($result->UserType ==1){
                $typedefault=2;
            }else{
                $typedefault=$result->UserType;
            }
            $arrtype=explode(',',$result->Accounttype);
            if(!in_array($typedefault,$arrtype)){
                $arrtype[]=$typedefault;
            }
            //$result=json_decode($result,true);
            //var_dump($result->UserId);die();

            $token = $this->site_model->create_token($result->UserID,$ip,$type);
            $balance=$this->site_model->getbalace($result->UserID);
            $kqtype=$this->site_model->UpdateUserType($result->UserID,$type,join(',',$arrtype));
            $profileData = array("UserId" => $result->UserID,
                                 "UserName" => $result->UserName,
                                 "EmailAddress" => $result->Email,
                                 "FullName" => $result->Name,
                                 "Phone"=>$result->Phone,
                                 "TokentKey" => $token,
                                 "Type"=>$type,
                                 "Balance"=>intval($balance->Balance),
                                 "Accounttype"=>join(',',$arrtype));
                                 $_SESSION['UserInfo'] = $profileData;
            $data=array('kq'=>true,'msg'=>'dang nhap thanh cong');
            $configpoint=$this->site_model->getpointconfig();
            $Trace="users_0";
            $addpoint=$this->site_model->addlogpoint($result->UserID,1,$configpoint->PointPerDay,1,$Trace);
           // return json_encode();1 cong điệm, 2 trừ điểm
        }else{
            $data=array('kq'=>false,'msg'=>'dang nhap ko thanh cong');
            //return json_encode(array('kq'=>false,'msg'=>'dang nhap ko thanh cong'));
        }

        //return json_encode($data);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    function loginteacher()
    {
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        $remember = $this->input->post('typelogin');
        $result=$this->site_model->GetLoginTeacher($username,md5($password));
        if($result != ""){
            $ip = time();
            $type=1;
            if($result->UserType ==0){
               $typedefault=1;
            }else if($result->UserType ==1){
                $typedefault=2;
            }else{
                $typedefault=$result->UserType;
            }
            $arrtype=explode(',',$result->Accounttype);
            if(!in_array($typedefault,$arrtype)){
                $arrtype[]=$typedefault;
            }
            $kqtype=$this->site_model->UpdateUserType($result->UserID,$type,join(',',$arrtype));
            //$result=json_decode($result,true);
            //var_dump($result->UserId);die();
            $token = $this->site_model->create_token($result->UserID,$ip,$remember);

            $balance=$this->site_model->getbalace($result->UserID);
            $profileData = array("UserId" => $result->UserID,
                                 "UserName" => $result->UserName,
                                 "EmailAddress" => $result->Email,
                                 "FullName" => $result->Name,
                                 "Phone"=>$result->Phone,
                                 "TokentKey" => $token,
                                 "Type"=>$type,
                                 "Balance"=>intval($balance->Balance),
                                 "Accounttype"=>join(',',$arrtype)
                                 );
                                 $_SESSION['UserInfo'] = $profileData;
            $data=array('kq'=>true,'msg'=>'dang nhap thanh cong');
            $configpoint=$this->site_model->getpointconfig();
            $Trace="users_0";
            $addpoint=$this->site_model->addlogpoint($result->UserID,1,$configpoint->PointPerDay,1,$Trace);
            if($remember==1){
            setcookie("namephp", $username, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie("puphp", md5($password), time() + (86400 * 30), "/"); // 86400 = 1 day
            }
        }else{
            $data=array('kq'=>false,'msg'=>'dang nhap ko thanh cong');
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    function loginusers()
    {
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        $remember = $this->input->post('typelogin');
        //var_dump($_POST);die();
        $typedefault=0;
        $result=$this->site_model->GetLoginusers($username,md5($password));
        if($result != ""){
            $ip = time();
            $type=1;
            if($result->UserType ==0){
               $type=1;
            }else if($result->UserType ==1){
                $type=2;
            }else{
                $type=$result->UserType;
            }
            $arrtype=explode(',',$result->Accounttype);
            if(!in_array($type,$arrtype)){
                $arrtype[]=$type;
            }
            $kqtype=$this->site_model->UpdateUserType($result->UserID,$typedefault,join(',',$arrtype));
            //$result=json_decode($result,true);
            //var_dump($result->UserId);die();
            $token = $this->site_model->create_token($result->UserID,$ip,$remember);
            $balance=$this->site_model->getbalace($result->UserID);
            $profileData = array("UserId" => $result->UserID,
                                 "UserName" => $result->UserName,
                                 "EmailAddress" => $result->Email,
                                 "FullName" => $result->Name,
                                 "Phone"=>$result->Phone,
                                 "TokentKey" => $token,
                                 "Type"=>$typedefault,
                                 "Balance"=>intval($balance->Balance),
                                 "Accounttype"=>join(',',$arrtype));
                                 $_SESSION['UserInfo'] = $profileData;
            $data=array('kq'=>true,'msg'=>'dang nhap thanh cong');
            $configpoint=$this->site_model->getpointconfig();
            $Trace="users_0";
            $addpoint=$this->site_model->addlogpoint($result->UserID,1,$configpoint->PointPerDay,1,$Trace);
            if($remember==1){
            setcookie("namephp", $username, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie("puphp", md5($password), time() + (86400 * 30), "/"); // 86400 = 1 day
            }
        }else{
            $data=array('kq'=>false,'msg'=>'dang nhap ko thanh cong');
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
		function logout(){
        $arrtg=$_SESSION['UserInfo'];
        $tg=$this->site_model->deltokenbyuserid($arrtg['UserId']);
        $data=['kq'=>true];
        $_SESSION['UserInfo']="";
        setcookie("namephp", $username, time() - (86400 * 31), "/"); // 86400 = 1 day
            setcookie("puphp", md5($password), time() - (86400 * 31), "/"); // 86400 = 1 day
        unset($_SESSION['UserInfo']);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    function EmailRegisterNofity()
    {
        $findkey = $this->input->post('findkey');
        $data=$this->site_model->EmailNofity($findkey);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    function quickviewuser()
    {
        $userid=$this->input->post('objid');

        $userinfo=$this->site_model->GetFirstUserTeacher(intval($userid));

       $lichday="";
       if(intval($userinfo->MonMorning)==1){$lichday[]=" Thứ 2 sáng";}
       if(intval($userinfo->MonAfter)==1){$lichday[]=" Thứ 2 chiều";}
        if(intval($userinfo->MonNight)==1){$lichday[]=" Thứ 2 tối";}
        if(intval($userinfo->TueMorning)==1){$lichday[]=" Thứ 3 sáng";}
        if(intval($userinfo->TueAfter)==1){$lichday[]=" Thứ 3 chiều";}
        if(intval($userinfo->TueNight)==1){$lichday[]=" Thứ 3 tối";}
        if(intval($userinfo->WeMorning)==1){$lichday[]=" Thứ 4 sáng";}
        if(intval($userinfo->WeAfter)==1){$lichday[]=" Thứ 4 chiều";}
        if(intval($userinfo->WeNight)==1){$lichday[]=" Thứ 4 tối";}
        if(intval($userinfo->ThuMorning)==1){$lichday[]=" Thứ 5 sáng";}
        if(intval($userinfo->ThuAfter)==1){$lichday[]=" Thứ 5 chiều";}
        if(intval($userinfo->ThuNight)==1){$lichday[]=" Thứ 5 tối";}
        if(intval($userinfo->FriMorning)==1){$lichday[]=" Thứ 6 sáng";}
        if(intval($userinfo->FriAfter)==1){$lichday[]=" Thứ 6 chiều";}
        if(intval($userinfo->FriNight)==1){$lichday[]=" Thứ 6 tối";}
        if(intval($userinfo->SatMorning)==1){$lichday[]=" Thứ 7 sáng";}
        if(intval($userinfo->SatAfter)==1){$lichday[]=" Thứ 7 chiều";}
        if(intval($userinfo->SatNight)==1){$lichday[]=" Thứ 7 tối";}
        if(intval($userinfo->SunMorning)==1){$lichday[]=" Chủ nhật sáng";}
        if(intval($userinfo->SunAfter)==1){$lichday[]=" Chủ nhật chiều";}
        if(intval($userinfo->SunNight)==1){$lichday[]=" Chủ nhật tối";}

        if(count($lichday)<=0){
            $lichday[]=" Chưa cập nhật";
        }




        $result=['kq'=>false];

        if(empty($userinfo)){
            $data='<div id="quick-view-box"><div class="tooltiptext"><div class="view view-users view-id-users view-display-id-attachment_7 view-dom-id-991d540f6fd86935d5e91fc993b31d22"><div class="view-content"><div class="views-row views-row-1 views-row-odd views-row-first views-row-last"><div class="fullname_tooltip">
                    <h4>Không tồn tại</h4></div>
                    </div></div></div></div></div>';
        }else{
            $data='<div id="quick-view-box"><div class="tooltiptext"><div class="view view-users view-id-users view-display-id-attachment_7 view-dom-id-991d540f6fd86935d5e91fc993b31d22"><div class="view-content"><div class="views-row views-row-1 views-row-odd views-row-first views-row-last"><div class="fullname_tooltip">';
            $data.='<h4><a >'.$userinfo->Name.'</a></h4></div>';
            $data.='<div class="class_content_popup">'.$userinfo->TitleView.' | '.$userinfo->CityName.'</div>';
$data.='<div class="popoverborder"><div class="class_content_popup"><b>Lịch dạy</b>:  '.join(',',$lichday).'</div>

<div class="class_content_popup" style="border-top:0.5px solid #f5f5f5;"><b>Số lớp đã dạy:</b> '.$userinfo->solopday.'</div>

<div class="class_content_popup" style="border-top:0.5px solid #f5f5f5;">'.$userinfo->Description.'</div></div>

</div></div></div></div></div>';
        }

        $result=['kq'=>true,'data'=>$data];

        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
    function ajaxlstclass()
    {
			if(!empty($_POST)){
				$keytag=$this->input->post('keytag');
        $city=$this->input->post('city');
        $lsttopic=$this->site_model->SearchClassbyUserOnline($keytag,$city);
        $data="";
        if(count($lsttopic) > 0){
        foreach($lsttopic as $n){
            $tg=explode(',',$n->LearnType);
          $data.='<div class="item-uv-online">
                        <div class="item-uv-onlien-job"><a href=""><i class="fa fa-online"></i> '.$n->ClassTitle.'</a></div>
                        <div class="item-uv-name"><a href="">Học phí: '.number_format($n->Money).' vnđ/buổi</a><span><span>Địa điểm:</span> '.Getcitybyindex($n->City).'</span></div>
                        <div class="item-uv-online-chat">
                            <span class="uvonline-chat"><i class="fa fa-chat" ></i> Chat với phụ huynh</span>
                            <span class="uvonline-kinhnghiem"><span>Hình thức: </span>'.GetLearnType($tg[0]).'</span>
                        </div>
                    </div>';
        }
        }else{
            $data.='<div class="item-uv-online">
                        Không tìm thấy lớp phù hợp
                    </div>';
        }
        $result=['kq'=>true,'data'=>$data];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}
    }
    function ajaxlstteacher()
    {
			if(!empty($_POST)){
				$keytag=$this->input->post('keytag');
				$city=$this->input->post('city');
				$lsttopic=$this->site_model->GetTeacherOnlinebySearch($city,$keytag);
				$data="";
				if(count($lsttopic) > 0){
				foreach($lsttopic as $n){
						$tg=explode(',',$n->LearnType);
					$data.='<div class="item-uv-online">
												<div class="item-uv-onlien-job"><a href=""><i class="fa fa-online"></i> '.$n->TitleView.'</a></div>
												<div class="item-uv-name"><a>'.$n->Name.'</a><span><span>Từ:</span> '.number_format($n->Free).' vnđ/buổi</span></div>
												<div class="item-uv-online-chat">
														<span class="uvonline-chat"><i class="fa fa-chat" ></i> Chat với giáo viên</span>
														<span class="uvonline-kinhnghiem"><span>Hình thức: </span>'.GetLearnType($n->WorkID).'</span>
												</div>
										</div>';
				}
				}else{
						$data.='<div class="item-uv-online">
												Không tìm thấy giáo viên phù hợp
										</div>';
				}
				$result=['kq'=>true,'data'=>$data];
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxfindsubject()
    {
			if(!empty($_POST)){
				$idmonhoc=$this->input->post('findkey');
				$lsttopic=$this->site_model->ListSubjectByKey($idmonhoc);
				$data="";
				foreach($lsttopic as $n){
						$data.="<li class='col-md-4 padd-0'><a target='_blank' href='".base_url()."gia-su&key=all&subject=".$n->ID."&topic=0&place=0&type=0&sex=0'>".$n->SubjectName."</a></li>";
				}
				$result=['kq'=>true,'data'=>$data];
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxfindprovince()
    {
			if(!empty($_POST)){
				$idmonhoc=$this->input->post('findkey');
				$lsttopic=$this->site_model->getprovincebykey($idmonhoc);
				$data="";
				foreach($lsttopic as $n){
						$data.="<li class='col-md-4 padd-0'><a target='_blank' href='".base_url()."gia-su&key=all&subject=0&topic=0&place=".$n->cit_id."&type=0&sex=0'>".$n->cit_name."</a></li>";
				}
				$result=['kq'=>true,'data'=>$data];
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function Ajaxchude()
    {
        $idmonhoc=$this->input->post('idmon');
        if(!empty($idmonhoc)){
        $lsttopic=$this->site_model->ListTopicBySubject($idmonhoc);
        $data="<option value=''>Chọn chủ đề</option>";
        foreach($lsttopic as $n){
            $data.="<option value='".$n->ID."'>".$n->NameTopic."</option>";
        }
        $result=['kq'=>true,'data'=>$data];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
		function AjaxchudeCheckbox()
		{
			if(!empty($_POST['idmon'])){
				$idmonhoc=$this->input->post('idmon');
        $lsttopic=$this->site_model->ListTopicBySubject($idmonhoc);
        $data="";
        foreach($lsttopic as $n){
            $data.="<li>";
            $data.="<input class='radio-calendar' id='toppic-".$n->ID."' type='checkbox' name='toppicchk' value='".$n->ID."'>
                    <label for='toppic-".$n->ID."'>".$n->NameTopic."</label>";
            $data.="</li>";
        }
				$areaclass=$this->db->select('areaclass');
				$areaclass=$this->db->get_where('subject',array('ID'=>$idmonhoc))->row()->areaclass;
				if(!empty($areaclass)){
					$query='select id,name from lophoc where id IN('.$areaclass.')';
					$lophoc=$this->db->query($query)->result();
					foreach ($lophoc as $valuelophoc) {
						$data.="<li>";
						$data.="<input class='radio-class' id='subject-class-".$idmonhoc."-".$valuelophoc->id."' type='checkbox' name='subjectclass' value='".$idmonhoc."-".$valuelophoc->id."'>
										<label for='subject-class-".$idmonhoc."-".$valuelophoc->id."'>".$valuelophoc->name."</label>";
						$data.="</li>";
					}
				}
        $result=['kq'=>true,'data'=>$data];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
				}else{
					show_404();
				}
    }
    function ajaxtimgiasutheomonhoc()
    {
        $idmonhoc=$this->input->post('monhoc');
        if(!empty($idmonhoc)){
        $lsttopic=$this->site_model->TimGiaSuTheoMonHoc($idmonhoc);
        $data="";
        foreach($lsttopic as $n){
            //giao-vien&key=all&subject=1&topic=0&place=0&type=0&sex=0&order=last
            $data.="<li><a target='_blank' href='".base_url()."giao-vien&key=all&subject=".$n->ID."&topic=0&place=0&type=0&sex=0&order=last'>".$n->SubjectName."<span>(".$n->sogiasu.")</span></a></li>";
        }
        $result=['kq'=>true,'data'=>$data];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxgetforgotpassword()
    {
        $result=['kq'=>false,'data'=>''];
        $username=$this->input->post('username');
        $tranthai=$this->input->post('trangthai');
        if(!empty($_POST)){
        $lsttopic=$this->site_model->GetUserForgot($username);
        $data="";
        if($lsttopic != ""){
            $body=file_get_contents(base_url().'EmailTemplate/SendForgotPassword.htm');
            $body=str_replace('<%name%>',$lsttopic->Name,$body);
            $body=str_replace('<%email%>',$lsttopic->Email,$body);
            $body=str_replace('<%code%>',$lsttopic->UserName,$body);

            $code=rand(100000,999999);
    	    $subject='[giasu365] Kích hoạt tài khoản đăng ký';
            $Description="Đăng ký tài khoản công ty";
            $data="";
            $IP=getUserIP();
            $countforgot=$this->site_model->countuserforgotpassbyip($IP);
            $countuserforgot=$this->site_model->countuserforgotpassbyipanduser($lsttopic->UserID);
            if($countforgot<=6 && $countuserforgot < 3){
            $CreateDate=date("Y-m-d H:i:s",time());
            $queryconfrim="INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate,IP)
                                                   VALUES('".$lsttopic->UserID."','".$code."','2','0','".$body."','".$Description."','".$CreateDate."','".$CreateDate."','".$IP."')";
            $Name=$lsttopic->Name;
            $insert=$this->db->query($queryconfrim);
            if(intval($tranthai)> 0){//$lsttopic->SendNotify > 0){
            $arrphone=['phone_number'=>"'$username'",'name'=>"'$Name'"];
            $message=buildsendautocall($arrphone,$code);//formatsmsmessage(2,$code);
            //$k1=$this->site_model->updatecomfirmiscall($lsttopic->UserID,$code);
            $iscall=1;
            }else{
               $message=formatsmsmessage(2,$code);
               $Statuscode=sendsms($lsttopic->UserName,$message);
               $iscall=0;
            }
            //

            $smslog=$this->site_model->InsertLogSms($code,$Statuscode,'2',$iscall);
            $body = base64_encode($body);
            //$this->site_model->CreateSendMail($lsttopic->Email,$lsttopic->Email,"","",$subject,$body);
            $result=['kq'=>true,'data'=>'lấy lại mk thành công, bạn vui lòng kiểm tra email và số điện thoại để nhận mã','code'=>"$code",'unam'=>"$username"];
            }else{
                $result=['kq'=>false,'check'=>true,'data'=>''];
            }
        }

        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxtestsendpass()
    {

                   show_404();

        //$kq=sendsms('01633451180','test sms');
//            $result=['kq'=>true,'data'=>$kq];
//            echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
    function ajaxconfirmpass()
    {
			if(!empty($_POST)){
				$code=$this->input->post('code');
        $username=$this->input->post('usp');
        $lsttopic=$this->site_model->getconfirmuserbycode($code,$username);
        echo json_encode($lsttopic,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxconfirmusersregister()
    {
			if(!empty($_POST)){
				$code=$this->input->post('code');
				$username=$this->input->post('usp');
				$lsttopic=$this->site_model->getconfirmuserregisterbycode($code,$username);
				echo json_encode($lsttopic,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}
    }
    function ajaxteacherchangepass()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
        $oldpass=$this->input->post('oldpass');
        $newpass=$this->input->post('newpass');
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->updatenewpass($userid,$oldpass,$newpass);
            if($kq == true){
                $result=['kq'=>true,'data'=>'Bạn đã thay đổi mật khẩu thành công. Bạn có thể sử dụng mật khẩu này từ bây giờ'];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxuservsclass()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
        $classid=$this->input->post('classid');
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->adduservsclass($userid,$classid,0);
            if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Đề nghị dạy thành công, bạn vui lòng chờ phản hồi của phụ huynh'];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxusersaveclassexcel()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$tg=$this->site_model->getfullteachersaveclass($userid);
						$data="";
						if($tg != '')
						{
								$data .="<table>
												<thead>
												<tr>
														<th style='width: 8.4%;'>STT
														</th>
														<th style='width:35%'>Họ tên
														</th>
														<th style='width:15%;'>Ghi chú</th>
														<th style='width: 14%;'>Môn học</th>
														<th style=''>Ngày lưu</th>
												</tr>
												</thead>
												<tbody>";
														$i=0;
														foreach($tg as $n){
																$i+=1;
														$data .="<tr>
																<td >".$i."</td>";
																$data .="<td>".$n->Name." - Lớp:
																		".$n->ClassTitle."</a></td>";
																$data .="<td>".$n->ghichu."</td>";
																$data .="<td><span>".$n->SubjectName."</span></td>";
																$data .="<td>".date("d/m/Y",strtotime($n->CreateDate))."</td></tr>";


														 }
												 $data .="</tbody></table>";
												 $result=['kq'=>true,'data'=>$data];
						}
				}

				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxfilterusersaveclass()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$monhoc=$this->input->post('monhoc');
				$findkey=$this->input->post('findkey');
				$ngaythang=$this->input->post('ngaythang');
				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$tg=$this->site_model->getfilterteachersaveclass($userid,$monhoc,$findkey,$ngaythang);
						$data="";
						if($tg != '')
						{
								$data .="";
														$i=0;
														foreach($tg as $n){
																$i+=1;
														$data .="<tr>
																<td class='stt'>".$i."</td>
																<td><label>".$n->Name."</label>
																		<a href='".base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID."' target='_blank'>".$n->ClassTitle."</a>
																</td>
																<td>".$n->ghichu."</td>
																<td><span>".$n->SubjectName."</span></td>
																<td>".date("d/m/Y",strtotime($n->CreateDate))."</td>
																<td class='actionjob'>
																		<a data-val='".$n->ClassID."' class='btnntdedit' id='sualopdaluu'>Sửa</a>
																		<a data-val='".$n->ClassID."' id='xoalopdaluu' class='btnntddelete'>Xóa</a>
																</td>
														</tr>";


														 }

												 $result=['kq'=>true,'data'=>$data];
						}
				}

				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxfiltercompanycandiamply()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$monhoc=$this->input->post('monhoc');
				$findkey=$this->input->post('findkey');
				$ngaythang=$this->input->post('ngaythang');
				$type=1;
				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$tg=$this->site_model->companyfiltergetcandiamply($userid,$type,$monhoc,$findkey,$ngaythang);
						$data="";
						if($tg != '')
						{
								$data .="";
														$i=0;
														foreach($tg as $n){
																$i+=1;
														$data .="<tr><td class='stt'>".$i."</td><td><label>".$n->Name."</label>";
																		$data .="<a href='".base_url().vn_str_filter($n->new_title)."-job".$n->new_id.".html' target='_blank'>".$n->new_title."</a></td>";
																$data .="<td>".$n->note."</td><td><span>".GetLuong($n->cv_money_id)."</span></td>";
																$data .="<td>".date("d/m/Y",strtotime($n->createdate))."</td><td class='actionjob'>";
																$data .="<a data-val='".$n->ID."' class='btnntdedit' id='sualopdaluu'>Sửa</a><a data-val='".$n->ID."' id='xoalopdaluu' class='btnntddelete'>Xóa</a>";
																$data .="</td></tr>";
														 }

												 $result=['kq'=>true,'data'=>$data];
						}
				}

				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxfiltercompanycandisave()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$monhoc=$this->input->post('monhoc');
				$findkey=$this->input->post('findkey');
				$ngaythang=$this->input->post('ngaythang');
				$type=3;
				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$tg=$this->site_model->getfiltercandicomsave($userid,$type,$monhoc,$findkey,$ngaythang);
						$data="";
						if($tg != '')
						{
								$data .="";
														$i=0;
														foreach($tg as $n){
																$i+=1;
														$data .="<tr><td class='stt'>".$i."</td><td><label>".$n->Name."</label>";
																		$data .="<a href='".base_url().vn_str_filter($n->new_title)."-job".$n->new_id.".html' target='_blank'>".$n->new_title."</a></td>";
																$data .="<td>".$n->note."</td><td><span>".GetLuong($n->cv_money_id)."</span></td>";
																$data .="<td>".date("d/m/Y",strtotime($n->createdate))."</td><td class='actionjob'>";
																$data .="<a data-val='".$n->ID."' class='btnntdedit' id='sualopdaluu'>Sửa</a><a data-val='".$n->ID."' id='xoalopdaluu' class='btnntddelete'>Xóa</a>";
																$data .="</td></tr>";
														 }

												 $result=['kq'=>true,'data'=>$data];
						}
				}

				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxfiltercompanyjobspost()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$monhoc=$this->input->post('monhoc');
				$findkey=$this->input->post('findkey');
				$ngaythang=$this->input->post('ngaythang');
				$type=3;
				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$tg=$this->site_model->GetFilterJobbyCongTy($userid,$monhoc,$ngaythang,$findkey);
						$data="";
						if($tg != '')
						{
								$data .="";
														$i=0;
														foreach($tg as $n){
																$i+=1;
																$data .="<tr><td class='stt'>".$i."</td><td>";
																$data .="<a href='".base_url().vn_str_filter($n->new_title)."-job".$n->new_id.".html' target='_blank'>".$n->new_title."</a>";
																$data .="</td><td class='txtnote'>".date("d/m/Y",$n->new_han_nop)."</td>";
																$data .="<td><span>".GetLuong($n->new_money)."</span></td>";
																$data .="<td>".date("d/m/Y",$n->new_create_time)."</td><td class='actionjob'>";
																$data .="<a data-val='".$n->new_id."' data-id='".$n->active."' class='btnntdedit' >Sửa</a></td></tr>";
														 }

												 $result=['kq'=>true,'data'=>$data];
						}
				}

				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxfilteruserjobs()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$monhoc=$this->input->post('monhoc');
				$findkey=$this->input->post('findkey');
				$ngaythang=$this->input->post('ngaythang');
				$type=$this->input->post('loai');
				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$tg=$this->site_model->getfilteruserjob($userid,$type,$monhoc,$findkey,$ngaythang);
						$data="";
						if($tg != '')
						{
														$i=0;
														foreach($tg as $n){
																$i+=1;
														$data .="<tr><td class='stt'>".$i."</td><td><label>".$n->usc_company."</label><a href='".base_url().vn_str_filter($n->new_title)."-job".$n->new_id.".html' target='_blank'>".$n->new_title."</a>";
														$data .="</td><td>".$n->note."</td><td><span>".GetLuong($n->new_money)."</span></td><td>".date("d/m/Y",strtotime($n->createdate))."</td>";
														$data .="<td class='actionjob'><a data-val='".$n->ID."' class='btnntdedit' id='sualopdaluu'>Sửa</a><a data-val='".$n->ID."' id='xoalopdaluu' class='btnntddelete'>Xóa</a>";
														$data .="</td></tr>";
														 }

												 $result=['kq'=>true,'data'=>$data];
						}
				}

				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxusersaveclass()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$classid=$this->input->post('classid');
				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$kq=$this->site_model->addusersaveclass($userid,$classid);
						if($kq['kq'] == true){
								$result=['kq'=>true,'data'=>'Đề lưu lớp học thành công'];
						}
				}
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxusersaveuser()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$giaovien=$this->input->post('giaovien');
				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$kq=$this->site_model->adduservsusers($userid,$giaovien,1);
						if($kq['kq'] == true){
								$result=['kq'=>true,'data'=>'Lưu hồ sơ thành công'];
						}
				}
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxupdatenoteusersaveuser()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$giaovien=$this->input->post('giaovien');
				$note=$this->input->post('note');
				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$kq=$this->site_model->updateusersaveuser($userid,$giaovien,$note);
						if($kq['kq'] == true){
								$result=['kq'=>true,'data'=>'Lưu hồ sơ thành công'];
						}
				}
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else {
				show_404();
			}

    }
    function ajaxdeleteusersvaveuser()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$giaovien=$this->input->post('giaovien');
				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$kq=$this->site_model->deleteusersaveuser($userid,$giaovien);
						if($kq['kq'] == true){
								$result=['kq'=>true,'data'=>'Lưu hồ sơ thành công'];
						}
				}
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else {
				show_404();
			}

    }
    function ajaxaddclassvsusers()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$classid=$this->input->post('lophoc');
				$userid=$this->input->post('giaovien');
						$kq=$this->site_model->addclassvsuser($userid,$classid,1);
						if($kq['kq'] == true){
								$result=['kq'=>true,'data'=>'mời dạy lớp học thành công'];
						}

				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxupdateissearch()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$issearch=$this->input->post('issearch');
				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$lst=$this->site_model->updateissearchuser($userid,$issearch);
						if($lst){
							$result=['kq'=>true,'data'=>'Cập nhật thành công'];
						}
				 }
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxupdatenotify()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$notify=$this->input->post('notify');
				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$lst=$this->site_model->updatenofityuser($userid,$notify);
						if($lst){
							$result=['kq'=>true,'data'=>'Cập nhật thành công'];
						}
				 }
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxloadmoreteachersave()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
				$page=$this->input->post('page');

				if(!empty($_SESSION['UserInfo'])){
						$tg=$_SESSION['UserInfo'];
						$userid=$tg['UserId'];
						$lst=$this->site_model->getpageteachersavebyuserid($userid,$page);
						if($lst != ''){
								$data="";
								$i=0;
								foreach($lst as $n){
										$i+=1;
										$j=($page*1) +$i;
										$data.="<tr>
																<td>".$j."</td>
																<td><a href='".base_url().vn_str_filter($n->Name)."-gv".$n->UserID."'>".$n->Name."</a>
																		<span>".$n->TitleView."</span>
																</td>
																<td>".$n->Note."</td>
																<td>".date('d/m/Y',strtotime($n->ngaymoi))."</td>
																<td class='actionjob'>
																		<a data-val='".$n->UserID."' class='btnntdedit' id='sualopdaluu'>Sửa</a>
																		<a data-val='".$n->UserID."' id='xoalopdaluu' class='btnntddelete'>Xóa</a>
																</td>
														</tr>";
								}
								$result=['kq'=>true,'data'=>$data];
						}
				}
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxloadmoreclassbyuser()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
        $page=$this->input->post('page');

        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $lst=$this->site_model->getlistclassbyuser($userid,$page);
            if($lst != ''){
                $data="";
                $i=0;
                foreach($lst as $n){
                    $i+=1;
                    $j=($page*1) +$i;
                    $data.="<tr><td><a href='".base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID."'>".$n->ClassTitle."</a><span>".$n->TitleView."</span></td>";
                    $data.="<td>".GetLearnType($n->LearnType)."</td>";
                    $data.="<td>".number_format($n->Money)." vnđ/buổi"."</td>";
                    $data.="<td>".$n->SubjectName."</td>";
                    $data.="<td>".date('d-m-Y',strtotime($n->CreateDate))."";
                                if($n->Active == 1){
                                  $data.="<a style='display: block;cursor: pointer;color:#ff0000;' data-val='".$n->ClassID."' data-id='0' class='btnhatin' title='Hạ tin đăng'><i class='fa fa-trash'></i></a>";
                                     }else{
                                    $data.="<a style='display: block;cursor: pointer;color:#00baba' data-val='".$n->ClassID." data-id='1' class='btnhatin' title='Đăng tin'><i class='fa fa-check'></i></a>";
                                     }
                                $data.="</td><td class='actionjob'>";
                                $data.="<a class='btnntdupdate' data-val='".$n->ClassID."' data-id='".$n->ClassID."><i class='fa fa-refresh'></i> Cập nhật </a>";
                                $data.="<a href='".base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID." target='_blank' class='btnntdviewdetail'><i class='fa fa-view-detail'></i> Chi tiết</a>";
                                $data.="</td></tr>";
                }
                $result=['kq'=>true,'data'=>$data];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxloadmoreteacherinvite()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
        $page=$this->input->post('page');

        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $lst=$this->site_model->getpageteacherinvitebyuserid($userid,$page);
            if($lst != ''){
                $data="";
                $i=0;
                foreach($lst as $n){
                    $i+=1;
                    $j=($page*1) +$i;
                    $data.="<tr>

                                <td><a href='".base_url().vn_str_filter($n->Name)."-gv".$n->UserID."'><".$n->Name."</a>
                                    <span>".$n->TitleView."</span>
                                </td>
                                <td>".GetLearnType($n->WorkID)."</td>
                                <td>Từ: ".number_format($n->Free)." vnđ/buổi</td>
                                <td>".date('d/m/Y',strtotime($n->ngaymoi))."</td>
                                <td >";
                                   if($n->Active ==1){$data.="Chưa phản hồi";}else{ $data.="Đã phản hồi";}
                                $data.="</td></tr>";
                }
                $result=['kq'=>true,'data'=>$data];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxloadmoreteacherfit()
    {
			if(!empty($_POST)){
				$result=['kq'=>false,'data'=>''];
        $page=$this->input->post('page');

        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $lst=$this->site_model->getpageteacherfitbyuserid($userid,$page);
            if($lst != ''){
                $data="";
                $i=0;
                foreach($lst as $n){
                    $i+=1;
                    $j=($page*1) +$i;
                    $data.="<tr>
                                <td><a href='".base_url().vn_str_filter($n->Name).'-gv'.$n->UserID."'>".$n->Name."</a>
                                    <span>".$n->TitleView."</span>
                                </td>
                                <td>".GetLearnType($n->WorkID)."</td>
                                <td>Từ: ".number_format($n->Free)." vnđ/buổi</td>
                                <td>".date('d/m/Y',strtotime($n->CreateDate))."</td>
                            </tr>";
                }
                $result=['kq'=>true,'data'=>$data];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

    }
    function ajaxtimgiasutheotinhthanh()
    {
        $idmonhoc=$this->input->post('monhoc');
        if(!empty($_POST)){
        $lsttopic=$this->site_model->timgiasutheotinhthanh($idmonhoc);
        $data="";
        foreach($lsttopic as $n){
            //giao-vien&key=all&subject=1&topic=0&place=0&type=0&sex=0&order=last
            $data.="<li><a target='_blank' href='".base_url()."giao-vien&key=all&subject=0&topic=0&place=".$n->cit_id."&type=0&sex=0&order=last'>".$n->cit_name."<span>(".$n->giasutt.")</span></a></li>";
        }
        $result=['kq'=>true,'data'=>$data];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxgetclassnotteacherbyuserid()
    {
        $result=['kq'=>false,'data'=>''];
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->Getlistclassnotteacherbyuserid($userid);
            if($kq != ''){
                foreach($kq as $n){
            //giao-vien&key=all&subject=1&topic=0&place=0&type=0&sex=0&order=last
                    $data.="<option value='".$n->ClassID."'>".$n->ClassTitle."</option>";
                }
                $result=['kq'=>true,'data'=>$data];
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }

    }
    function ajaxupdatestatususervsclass()
    {
        $result=['kq'=>false,'data'=>''];
        $classid=$this->input->post('classid');
        $note=$this->input->post('note');
        $active=$this->input->post('trangthai');
        if(!empty($_POST)){
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->updateuservsclass($userid,$classid,$active,$note);
            if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật trạng thái thành công'];
            }else if($kq['kq']==false && $kq['data']==true){
                $result=['kq'=>false,'data'=>true];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxupdatestatusteachersuggest()
    {
        $result=['kq'=>false,'data'=>''];
        $classid=$this->input->post('classid');
        $note=$this->input->post('note');
        $active=$this->input->post('trangthai');
        $userid=$this->input->post('id');
        if(!empty($_POST)){
        if(!empty($_SESSION['UserInfo'])){

            $kq=$this->site_model->updateuservsclass($userid,$classid,$active,$note);
            if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật trạng thái thành công'];
            }else if($kq['kq']==false && $kq['data']==true){
                $result=['kq'=>false,'data'=>true];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxupdateuserssaveclass()
    {
        $result=['kq'=>false,'data'=>''];
        if(!empty($_POST)){
        $classid=$this->input->post('classid');
        $note=$this->input->post('note');

        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->updateuserssaveclass($userid,$classid,$note);
            if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật trạng thái thành công'];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxupdateusersjobs()
    {
        $result=['kq'=>false,'data'=>''];
        if(!empty($_POST)){
        $classid=$this->input->post('classid');
        $note=$this->input->post('note');
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->updateusersjobs($userid,$classid,$note);
            if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật trạng thái thành công'];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxcompanyupdateusersjobs()
    {
        $result=['kq'=>false,'data'=>''];
        if(!empty($_POST)){
        $classid=$this->input->post('classid');
        $trangthai=$this->input->post('trangthai');
        $note=$this->input->post('note');
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->companyupdateusersjobs($classid,$note,$trangthai);
            if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật trạng thái thành công'];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                  show_404();
            }
    }
    function ajaxcompanyupdateuserssave()
    {
        $result=['kq'=>false,'data'=>''];
        if(!empty($_POST)){
        $classid=$this->input->post('classid');
        $note=$this->input->post('note');
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->companyupdateuserssave($classid,$note);
            if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật trạng thái thành công'];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxdeleteuserssaveclass()
    {
        $result=['kq'=>false,'data'=>''];
        if(!empty($_POST)){
        $classid=$this->input->post('classid');
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->deleteuserssaveclass($userid,$classid);
            if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Xóa bản ghi thành công'];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxdeleteusersjobs()
    {
        $result=['kq'=>false,'data'=>''];
        if(!empty($_POST)){
        $classid=$this->input->post('jobjd');
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->deleteuserssaveclass($userid,$classid);
            if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Xóa bản ghi thành công'];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxsendnotifymoney()
    {
        $result=['kq'=>false,'data'=>''];
        if(!empty($_POST)){
        $ReceiveBank=$this->input->post('ReceiveBank');
        $TransferType=$this->input->post('TransferType');
        $TransferBank=$this->input->post('TransferBank');
        $CustomerName=$this->input->post('CustomerName');
        $CustomerBN=$this->input->post('CustomerBN');
        $TransferDate=$this->input->post('TransferDate');
        $Amount=$this->input->post('Amount');
        $Note=$this->input->post('Note');
        $tgngaysinh=explode('-',$TransferDate);
        $birth=date("Y-m-d H:i:s",strtotime($tgngaysinh[2].'-'.$tgngaysinh[1].'-'.$tgngaysinh[0]));
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->insertsendnotifymoney($userid,$TransferType,$TransferBank,$CustomerName,$CustomerBN,$birth,$ReceiveBank,$Amount,$Note);
            if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Gửi thông báo thành công'];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxupdatestatusclassvsusers()
    {
        $result=['kq'=>false,'data'=>''];
        if(!empty($_POST)){
        $classid=$this->input->post('classid');
        $note=$this->input->post('note');
        $active=$this->input->post('trangthai');
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->updateclassvsusers($userid,$classid,$active,$note);
            if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật trạng thái thành công'];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
		function ajaxteacherregistersuccess()
		{

        $result=['kq'=>false,'data'=>$_POST,'file'=>$_FILES];
        if(!empty($_POST)){
        // $chieu2=$_POST['chieu2'];
        // $chieu3=$_POST['chieu3'];
        // $chieu4=$_POST['chieu4'];
        // $chieu5=$_POST['chieu5'];
        // $chieu6=$_POST['chieu6'];
        // $chieu7=$_POST['chieu7'];
        // $chieu8=$_POST['chieu8'];
        // $chitietnoidung=$_POST['chitietnoidung'];
        // $chudemonhoc=$_POST['chudemonhoc'];//: "1,2,3,4,5,8,9,15,16,18,19,22"
        // $chuyennganh=$_POST['chuyennganh'];//: "lớp 1"
        // $emailuser=$_POST['emailuser'];//: "trantronglong87@gmail.com"
        // $gioithieubanthan=$_POST['gioithieubanthan'];//: "giới thiệu bản thân"
        // $gioitinh=$_POST['gioitinh'];//: "on"
        // $hientaila=$_POST['hientaila'];//: "undefined"
        // $hinhthucday=$_POST['hinhthucday'];//: "on"
        // $hocphi=$_POST['hocphi'];//: "200000"
        // $hoctruong=$_POST['hoctruong'];//: "tiểu học vĩnh hưng"
        // $hoten=$_POST['hoten'];//: "Trần Trọng Long"
        // $khuvucday=$_POST['khuvucday'];//: "1"
        // $tenkhuvucday=$_POST['tenkhuvucday'];
        // $kinhnghiem=$_POST['kinhnghiem'];//: "kinh nghiệm đi dạy"
        // $monhoc=$_POST['monhoc'];//: "1,10"
        // $namtotnghiep=$_POST['namtotnghiep'];//: "2018"
        // $ngaysinh=$_POST['ngaysinh'];//: "28-11-2018"
        // $tgngaysinh=explode('-',$ngaysinh);
        // $birth=date("Y-m-d H:i:s",strtotime($tgngaysinh[2].'-'.$tgngaysinh[1].'-'.$tgngaysinh[0]));
        // $noicongtac=$_POST['noicongtac'];//: "Quận Hoàng Mai"
        // $noiohientai=$_POST['noiohientai'];//: "Lĩnh Nam"
        // $password=$_POST['password'];//: "longtt123"
        // $sang2=$_POST['sang2'];//: "0"
        // $sang3=$_POST['sang3'];//: "0"
        // $sang4=$_POST['sang4'];//: "0"
        // $sang5=$_POST['sang5'];//: "0"
        // $sang6=$_POST['sang6'];//: "0"
        // $sang7=$_POST['sang7'];//: "0"
        // $sang8=$_POST['sang8'];//: "0"
        // $thanhtich=$_POST['thanhtich'];//: "thành tích"
        // $toi2=$_POST['toi2'];//: "1"
        // $toi3=$_POST['toi3'];//: "1"
        // $toi4=$_POST['toi4'];//: "1"
        // $toi5=$_POST['toi5'];//: "1"
        // $toi6=$_POST['toi6'];//: "1"
        // $toi7=$_POST['toi7'];//: "1"
        // $toi8=$_POST['toi8'];//: "1"
        // $sms =$_POST['sms'];
        // $username=$_POST['username'];//: "0912308"
        // $descusers=$gioithieubanthan;
        // $imguser="";

				$chieu2='';
        $chieu3='';
        $chieu4='';
        $chieu5='';
        $chieu6='';
        $chieu7='';
        $chieu8='';
        $chitietnoidung='';
        $chudemonhoc='';//: "1,2,3,4,5,8,9,15,16,18,19,22"
        $chuyennganh='';//: "lớp 1"
        $emailuser=$_POST['emailuser'];//: "trantronglong87@gmail.com"
        $gioithieubanthan='';//: "giới thiệu bản thân"
        $gioitinh='';//: "on"
        $hientaila='';//: "undefined"
        $hinhthucday='';//: "on"
        $hocphi='';//: "200000"
        $hoctruong='';//: "tiểu học vĩnh hưng"
        $hoten=$_POST['hoten'];//: "Trần Trọng Long"
        $khuvucday='';//: "1"
        $tenkhuvucday='';
        $kinhnghiem='';//: "kinh nghiệm đi dạy"
        $monhoc='';//: "1,10"
        $namtotnghiep='';//: "2018"
        $ngaysinh='';//: "28-11-2018"
        $tgngaysinh=[];
        $birth='';
        $noicongtac='';//: "Quận Hoàng Mai"
        $noiohientai='';//: "Lĩnh Nam"
        $password=$_POST['password'];//: "longtt123"
        $sang2='';//: "0"
        $sang3='';//: "0"
        $sang4='';//: "0"
        $sang5='';//: "0"
        $sang6='';//: "0"
        $sang7='';//: "0"
        $sang8='';//: "0"
        $thanhtich='';//: "thành tích"
        $toi2='';//: "1"
        $toi3='';//: "1"
        $toi4='';//: "1"
        $toi5='';//: "1"
        $toi6='';//: "1"
        $toi7='';//: "1"
        $toi8='';//: "1"
        $sms =$_POST['sms'];
        $username=$_POST['username'];//: "0912308"
        $descusers=$gioithieubanthan;
        $imguser="";

      //   if($_FILES['imageuser'] != null){
      //       if(!is_dir('upload/users'.date("Y",time())."/".date("m",time())."/".date("d",time()))){
    	// 		mkdir('upload/users/'.date("Y",time())."/".date("m",time())."/".date("d",time()), 0755, TRUE);
    	// 		mkdir('upload/users/thumb/'.date("Y",time())."/".date("m",time())."/".date("d",time()), 0755, TRUE);
    	// 	}
      //       $filename = $_FILES['imageuser']['name'];
	    //     $filedata = $_FILES['imageuser']['tmp_name'];
      //       $temp=explode('.',$filename);
			// $imageThumb = new Image($filedata);
			// $thumb_path = "avatar".date("YmdHis",time()).rand(10000,99999);
			// $imageThumb->save($thumb_path, 'upload/users/'.date("Y",time())."/".date("m",time())."/".date("d",time()), $temp[1]);
			//
			// $imageThumb->resize(300,300,'crop');
			// $imageThumb->save($thumb_path, 'upload/users/thumb/'.date("Y",time())."/".date("m",time())."/".date("d",time()), $temp[1]);
      //       $imguser=$thumb_path.".".$temp[1];
      //       }
            if(intval($sms)==1){
               $lsttopic=$this->site_model->InsertUserSMS($hoten,$username,$username,$emailuser,$khuvucday,$tenkhuvucday,$noiohientai,$descusers,1,$password,0,$imguser,'','',$gioitinh,$kinhnghiem,$thanhtich,$birth,$sms);
            }elseif(intval($sms)==2){
            $lsttopic=$this->site_model->InsertUser($hoten,$username,$username,$emailuser,$khuvucday,$tenkhuvucday,$noiohientai,$descusers,1,$password,0,$imguser,'','',$gioitinh,$kinhnghiem,$thanhtich,$birth);
            }
            if($lsttopic['data'] > 0){
							//tại đây auto tặng 5 điểm mỗi user sau khi đăng ký thành công.
							$configpoint=$this->site_model->getpointconfig();
							$Trace="users_0";
							$this->site_model->addlogpoint($lsttopic['data'],1,$configpoint->PointPerDay,1,$Trace);
							//kết thúc.
                $userid=$lsttopic['data'];
                $code=$lsttopic['code'];
                $imgcmnd="";
                if($_FILES['cmnduser']!= null){
                $filename = $_FILES['cmnduser']['name'];
    	        $filedata = $_FILES['cmnduser']['tmp_name'];
                $temp=explode('.',$filename);
    			$imageThumb = new Image($filedata);
    			$thumb_path = "cmnd".date("YmdHis",time()).rand(10000,99999);
    			$imageThumb->save($thumb_path, 'upload/users/'.date("Y",time())."/".date("m",time())."/".date("d",time()), $temp[1]);

    			$imageThumb->resize(300,300,'crop');
    			$imageThumb->save($thumb_path, 'upload/users/thumb/'.date("Y",time())."/".date("m",time())."/".date("d",time()), $temp[1]);
                $imgcmnd=$thumb_path.".".$temp[1];
                }
                $arrsubject=explode(',',$monhoc);

                $TitleView="Gia sư ";
                $arrtitle="";
                for($i=0;$i< count($arrsubject);$i++){
                    $j=$this->site_model->GetSubjectByID($arrsubject[$i]);
                    $arrtitle[]=$j->SubjectName;
                }
                $TitleView.=join(', ',$arrtitle) ;
                $lsttopic=$this->site_model->InsertTeacher($userid,$hinhthucday,GetLearn($hinhthucday),$hientaila,$hocphi,$sang2,$chieu2,$toi2,$sang3,$chieu3,$toi3,
                    $sang4,$chieu4,$toi4,$sang5,$chieu5,$toi5,$sang6,$chieu6,$toi6,$sang7,$chieu7,$toi7,$sang8,$chieu8,$toi8,'',$imgcmnd,0,$TitleView,$chitietnoidung,$hoctruong,$chuyennganh,$namtotnghiep,$noicongtac);
                   if($lsttopic['data'] > 0){

                        for($i=0;$i< count($arrsubject);$i++){
                                $tgtopic=$this->site_model->Listtopicbysubjectandidtopic($arrsubject[$i],$chudemonhoc);
                                foreach($tgtopic as $item){
                                    $result1=$this->site_model->InsertTeacherTopic($arrsubject[$i],$arrtitle[$i],$item->ID,$item->NameTopic,$userid);
                                }
                            }
                        $ip = time();
            //$result=json_decode($result,true);
            //var_dump($result->UserId);die();
                    $remember=0;
                    $type=1;
                    $token = $this->site_model->create_token($userid,$ip,$remember);
                    $profileData = array("UserId" => $userid,
                                 "UserName" => $username,
                                 "EmailAddress" => $emailuser,
                                 "FullName" => $hoten,
                                 "Phone"=>$username,
                                 "TokentKey" => $token,
                                 "Type"=>$type,
                                 "Balance"=>0);
                                 $_SESSION['UserInfo'] = $profileData;
                        $result=['kq'=>true,'data'=>"$username",'file'=>'','msg'=>'Them moi thanh cong','code'=>"$code"];
                    }
            }

        }else{
                   show_404();
            }
						echo json_encode($result,JSON_UNESCAPED_UNICODE);

    }
    function ajaxteacherupdateinfo()
		{
        $result=['kq'=>false,'data'=>'','file'=>''];
        if(!empty($_POST)){
        $chieu2=$_POST['chieu2'];
        $chieu3=$_POST['chieu3'];
        $chieu4=$_POST['chieu4'];
        $chieu5=$_POST['chieu5'];
        $chieu6=$_POST['chieu6'];
        $chieu7=$_POST['chieu7'];
        $chieu8=$_POST['chieu8'];
        $chitietnoidung=$_POST['chitietnoidung'];
        $chudemonhoc=$_POST['chudemonhoc'];//: "1,2,3,4,5,8,9,15,16,18,19,22"
        $chuyennganh=$_POST['chuyennganh'];//: "lớp 1"
        $emailuser=$_POST['emailuser'];//: "trantronglong87@gmail.com"
        $gioithieubanthan=$_POST['gioithieubanthan'];//: "giới thiệu bản thân"
        $gioitinh=$_POST['gioitinh'];//: "on"
        $hientaila=$_POST['hientaila'];//: "undefined"
        $hinhthucday=$_POST['hinhthucday'];//: "on"
        $hocphi=$_POST['hocphi'];//: "200000"
        $hoctruong=$_POST['hoctruong'];//: "tiểu học vĩnh hưng"
        $hoten=$_POST['hoten'];//: "Trần Trọng Long"
        $khuvucday=$_POST['khuvucday'];//: "1"
        $tenkhuvucday=$_POST['tenkhuvucday'];
        $kinhnghiem=$_POST['kinhnghiem'];//: "kinh nghiệm đi dạy"
        $monhoc=$_POST['monhoc'];//: "1,10"
        $namtotnghiep=$_POST['namtotnghiep'];//: "2018"
        $ngaysinh=$_POST['ngaysinh'];//: "28-11-2018"
        $tgngaysinh=explode('-',$ngaysinh);
        $birth=date("Y-m-d H:i:s",strtotime($tgngaysinh[2].'-'.$tgngaysinh[1].'-'.$tgngaysinh[0]));
        $noicongtac=$_POST['noicongtac'];//: "Quận Hoàng Mai"
        $noiohientai=$_POST['noiohientai'];//: "Lĩnh Nam"
        $sang2=$_POST['sang2'];//: "0"
        $sang3=$_POST['sang3'];//: "0"
        $sang4=$_POST['sang4'];//: "0"
        $sang5=$_POST['sang5'];//: "0"
        $sang6=$_POST['sang6'];//: "0"
        $sang7=$_POST['sang7'];//: "0"
        $sang8=$_POST['sang8'];//: "0"
        $thanhtich=$_POST['thanhtich'];//: "thành tích"
        $toi2=$_POST['toi2'];//: "1"
        $toi3=$_POST['toi3'];//: "1"
        $toi4=$_POST['toi4'];//: "1"
        $toi5=$_POST['toi5'];//: "1"
        $toi6=$_POST['toi6'];//: "1"
        $toi7=$_POST['toi7'];//: "1"
        $toi8=$_POST['toi8'];//: "1"
				$email=$_POST['email'];
        $descusers=$gioithieubanthan;
        $imguser="";
        $userid=0;
				$idClassArr=$_POST['idclass'];
        if(!empty($_SESSION['UserInfo'])){
						if(empty($_SESSION['UserInfo']['EmailAddress'])){
							session_start();
							$_SESSION['UserInfo']['EmailAddress']=$email;
						}
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $infologin=$this->site_model->GetUserByUserID($userid);
            $tgtime=strtotime($infologin->CreateDate);
        //var_dump($_FILES['imageuser']);die();
        if($_FILES['imageuser'] != null){
            if(!is_dir('upload/users/'.date("Y",$tgtime)."/".date("m",$tgtime)."/".date("d",$tgtime))){
    			mkdir('upload/users/'.date("Y",$tgtime)."/".date("m",$tgtime)."/".date("d",$tgtime), 0755, TRUE);
    			mkdir('upload/users/thumb/'.date("Y",$tgtime)."/".date("m",$tgtime)."/".date("d",$tgtime), 0755, TRUE);
    		}
            $filename = $_FILES['imageuser']['name'];
	        	$filedata = $_FILES['imageuser']['tmp_name'];
            $temp=explode('.',$filename);
						$imageThumb = new Image($filedata);
						$thumb_path = "avatar".date("YmdHis",time()).rand(10000,99999);
						$imageThumb->save($thumb_path, 'upload/users/'.date("Y",$tgtime)."/".date("m",$tgtime)."/".date("d",$tgtime), $temp[1]);

						$imageThumb->resize(300,300,'crop');
						$imageThumb->save($thumb_path, 'upload/users/thumb/'.date("Y",$tgtime)."/".date("m",$tgtime)."/".date("d",$tgtime), $temp[1]);
            $imguser=$thumb_path.".".$temp[1];
        }
        $lsttopic=$this->site_model->UpdateUsers2($userid,$hoten,$khuvucday,$tenkhuvucday,$noiohientai,$descusers,$imguser,$gioitinh,$kinhnghiem,$thanhtich,$birth,$email);
            //var_dump($lsttopic);die();
            if($lsttopic['kq'] ==true){

                $imgcmnd="";
                if($_FILES['cmnduser'] != null){
                    $filename = $_FILES['cmnduser']['name'];
        	        $filedata = $_FILES['cmnduser']['tmp_name'];
                    $temp=explode('.',$filename);
        			$imageThumb = new Image($filedata);
        			$thumb_path = "cmnd".date("YmdHis",time()).rand(10000,99999);
        			$imageThumb->save($thumb_path, 'upload/users/'.date("Y",$tgtime)."/".date("m",$tgtime)."/".date("d",$tgtime), $temp[1]);

        			$imageThumb->resize(300,300,'crop');
        			$imageThumb->save($thumb_path, 'upload/users/thumb/'.date("Y",$tgtime)."/".date("m",$tgtime)."/".date("d",$tgtime), $temp[1]);
                    $imgcmnd=$thumb_path.".".$temp[1];
                }
                $arrsubject=explode(',',$monhoc);
                $TitleView="Gia sư ";
                $arrtitle="";
                for($i=0;$i< count($arrsubject);$i++){
                    $j=$this->site_model->GetSubjectByID($arrsubject[$i]);
                    if($j !=''){
                    $arrtitle[]=$j->SubjectName." ";
                    }
                }
                $TitleView.=join(', ',$arrtitle) ;
                $lsttopic=$this->site_model->UpdateTeacher($userid,$hinhthucday,GetLearn($hinhthucday),$hientaila,$hocphi,$sang2,$chieu2,$toi2,$sang3,$chieu3,$toi3,
                    $sang4,$chieu4,$toi4,$sang5,$chieu5,$toi5,$sang6,$chieu6,$toi6,$sang7,$chieu7,$toi7,$sang8,$chieu8,$toi8,$imgcmnd,$TitleView,$chitietnoidung,$hoctruong,$chuyennganh,$namtotnghiep,$noicongtac,$idClassArr);
                   //var_dump($lsttopic);die();
                   if($lsttopic['kq'] ==true){
                    $xoatopic=$this->site_model->DeleteTeacherTopic($userid);
										for($i=0;$i< count($arrsubject);$i++){
														$tgtopic=$this->site_model->Listtopicbysubjectandidtopic($arrsubject[$i],$chudemonhoc);
														if(!empty($tgtopic)){
															foreach($tgtopic as $item){
																	$result1=$this->site_model->InsertTeacherTopic($arrsubject[$i],$arrtitle[$i],$item->ID,$item->NameTopic,$userid);
															}
														}else{
															$this->site_model->InsertTeacherTopic($arrsubject[$i],$arrtitle[$i],0,'',$userid);
														}

												}
                        $ip = time();
            //$result=json_decode($result,true);
            //var_dump($result->UserId);die();

                        $result=['kq'=>true,'data'=>$_FILES['imageuser'],'file'=>$_FILES['cmnduser'],'msg'=>'Cập nhật thành công'];
                    }
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxupdateusersinfomation1()
    {
        $result=['kq'=>false,'data'=>""];
        if(!empty($_POST)){
        //var_dump($result);die();
        $hoten=$this->input->post('hoten');
        $ngaysinh=$this->input->post('ngaysinh');
        $mota=$this->input->post('mota');
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->GetUserInfoByUserID($userid);
            $imguser="";
            if($_FILES['imguser'] != null){
            if(!is_dir('upload/users'.date("Y",strtotime($kq->CreateDate))."/".date("m",strtotime($kq->CreateDate))."/".date("d",strtotime($kq->CreateDate)))){
    			mkdir('upload/users/'.date("Y",strtotime($kq->CreateDate))."/".date("m",strtotime($kq->CreateDate))."/".date("d",strtotime($kq->CreateDate)), 0755, TRUE);
    			mkdir('upload/users/thumb/'.date("Y",strtotime($kq->CreateDate))."/".date("m",strtotime($kq->CreateDate))."/".date("d",strtotime($kq->CreateDate)), 0755, TRUE);
    		}
            $filename = $_FILES['imguser']['name'];
	        $filedata = $_FILES['imguser']['tmp_name'];
            $temp=explode('.',$filename);
			$imageThumb = new Image($filedata);
			$thumb_path = "avatar".date("YmdHis",time()).rand(10000,99999);
			$imageThumb->save($thumb_path, 'upload/users/'.date("Y",strtotime($kq->CreateDate))."/".date("m",strtotime($kq->CreateDate))."/".date("d",strtotime($kq->CreateDate)), $temp[1]);

			$imageThumb->resize(200,200,'crop');
			$imageThumb->save($thumb_path, 'upload/users/thumb/'.date("Y",strtotime($kq->CreateDate))."/".date("m",strtotime($kq->CreateDate))."/".date("d",strtotime($kq->CreateDate)), $temp[1]);
            $imguser=$thumb_path.".".$temp[1];
            }
            //var_dump($imguser);die();
            $tgbirth=explode('-',$ngaysinh);
            $Birth=date("Y-m-d H:i:s",strtotime($tgbirth[2]."-".$tgbirth[1]."-".$tgbirth[0]));
            $kg=$this->site_model->UpdateUsers($userid,$hoten,$kq->CityID,$kq->CityName,$kq->Address,$mota,$imguser,$kq->Sex,$kq->Exp,$kq->Bonus,$Birth);
            if($kg['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật tài khoản thành công'];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxupdateusersinfomation2()
    {
        $result=['kq'=>false,'data'=>""];
        if(!empty($_POST)){
        //var_dump($result);die();
        $email=$this->input->post('email');
        $gioitinh=$this->input->post('gioitinh');
        $diachi=$this->input->post('diachi');
        if(!empty($_SESSION['UserInfo'])){
						if(empty($_SESSION['UserInfo']['EmailAddress'])){
							session_start();
							$_SESSION['UserInfo']['EmailAddress']=$email;
						}
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kq=$this->site_model->GetUserInfoByUserID($userid);
            $imguser=$kq->Image;
            //var_dump($imguser);die();
            //$tgbirth=explode('-',$ngaysinh);
            //$Birth=date("Y-m-d H:i:s",strtotime($tgbirth[2]."-".$tgbirth[1]."-".$tgbirth[0]));
            $kg=$this->site_model->UpdateUsers2($userid,$kq->Name,$kq->CityID,$kq->CityName,$diachi,$kq->Description,$imguser,$gioitinh,$kq->Exp,$kq->Bonus,$kq->Birth,$email);
            if($kg['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật tài khoản thành công'];
            }else if($kg['kq']==false){
                $result=['kq'=>false,'data'=>$kg['data']];
            }
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }
    }
    function ajaxviewcontactinfo()
    {
				$result=['kq'=>false,'check'=>false,'data'=>"Điểm của bạn đã dùng hết. Để tiếp tục xem hồ sơ xin vui lòng nạp thêm điểm"];
				if(!empty($_POST)){
          $keyview=$this->input->post('keyview');
          $lionel=$this->input->post('lionel');
          if(!empty($_SESSION['UserInfo'])){
                          $tgkey=explode('_',$keyview);
              if(strtolower($tgkey[0]==='users')|| strtolower($tgkey[0]==='class')){
                      $tg = $_SESSION['UserInfo'];
                      $userid = $tg['UserId'];
                      $userview = $tgkey[1];
                      if($tgkey[0]==='class'){
                          $infoclass=$itemclass=$this->site_model->GetFirstClass($tgkey[1]);
                          $userview=$infoclass->UserID;
                      }
                      $kq=$this->site_model->GetUserInfoByUserID($userview);
                      $configpoint=$this->site_model->getpointconfig();
                      $getpoint=$this->site_model->GetLogpointbyuse($userid,$keyview);
                        if($getpoint != ""){
                                $data=['email'=>$kq->Email,'phone'=>$infoclass->Phone,'phone1'=>$kq->Phone,'userids'=>$kq->UserName,'fb'=>$infoclass->Facebook,'lionel'=>$lionel];
                                $result=['kq'=>true,'data'=>'Xem thông tin thành công','obj'=>$data];
                                if($data['lionel']=='lionel') {
                                  $this->site_model->addlogpoint($userid,2,(0 - $configpoint->PointSub),1,$keyview);
                                }
                                // lionel 20
                        }else{
                            $kg = $this->site_model->addlogpoint($userid,2,(0 - $configpoint->PointSub),1,$keyview);
                            if($kg['kq'] == true){
                                    $data=['email'=>$kq->Email,'phone'=>$infoclass->Phone,'phone1'=>$kq->Phone,'userids'=>$kq->UserName,'fb'=>$infoclass->Facebook];
                                    $result=['kq'=>true,'check'=>false,'data'=>'Xem thông tin thành cônggg','obj'=>$data];
                            }
                        }
                      }else{
                          $result=['kq'=>false,'check'=>false,'data'=>'truyền dữ liệu bị lỗi'];
                        }
                }else{
                    $result=['kq'=>false,'check'=>true,'data'=>'Bạn cần đăng nhâp để xem thông tin này'];
          }
				  echo json_encode($result,JSON_UNESCAPED_UNICODE);
				}
				else{
					show_404();
				}
		}
		function ajaxchangetypeuser()
    {
        $data=array('kq'=>false,'msg'=>'chức năng thất bại');
				$typeu=$this->input->post('typeu');
        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            if($typeu==$tg['Type']){
                $data=array('kq'=>false,'msg'=>'Đổi trạng thái thất bại, bạn vẫn đang ở trạng thái cũ');
            }else{
               $ip = time();
            $type=1;
            if($typeu ==0){
               $type=1;
            }else if($typeu ==1){
                $type=2;
            }else{
                $type=$typeu;
            }
            $arrtype=explode(',',$tg['Accounttype']);
            if(!in_array($type,$arrtype)){
                $arrtype[]=$type;
            }
            $kqtype=$this->site_model->UpdateUserType($userid,$typeu,join(',',$arrtype));
            //$result=json_decode($result,true);
            //var_dump($result->UserId);die();

            $balance=$this->site_model->getbalace($userid);
            $profileData = array("UserId" => $tg['UserId'],
                                 "UserName" => $tg['UserName'],
                                 "EmailAddress" => $tg['EmailAddress'],
                                 "FullName" => $tg['FullName'],
                                 "Phone"=>$tg['Phone'],
                                 "TokentKey" => $tg['TokentKey'],
                                 "Type"=>$typeu,
                                 "Balance"=>intval($balance->Balance),
                                 "Accounttype"=>join(',',$arrtype));
                                 $_SESSION['UserInfo'] = $profileData;
            $data=array('kq'=>true,'msg'=>'Đổi trạng thái thành công');
            }
echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }else{
                   show_404();
            }

    }
    function ajaxrefreshusers()
    {
        $result=['kq'=>false,'data'=>""];

        if(!empty($_SESSION['UserInfo'])){
            $tg=$_SESSION['UserInfo'];
            $userid=$tg['UserId'];
            $kg=$this->site_model->refreshclass($userid);
            if($kg['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật tài khoản thành công'];
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }

    }
		function ajaxuserregistersuccess()
		{
			if(empty($_POST)){
								 show_404();
					}else{
						$result=['kq'=>false,'data'=>''];
		        $hoten=$_POST['hoten'];
		        $password=$_POST['password'];
		        $username=$_POST['username'];
		        $topicarr=$_POST['topicarr'];
		        $classname=$_POST['classname'];
		        $teachertype=$_POST['teachertype'];
		        $teachersex=$_POST['teachersex'];
		        $monhoc=$_POST['monhoc'];
		        $tenmonhoc=$_POST['tenmonhoc'];
		        $studens=$_POST['studens'];
		        $hours=$_POST['hours'];
		        $workid=$_POST['workid'];
		        $money=$_POST['money'];
		        $email=$_POST['email'];
		        $phone=$_POST['phone'];
		        $cityid=$_POST['cityid'];
		        $address=$_POST['address'];
		        $descclass=$_POST['descclass'];
		        $sang2=$_POST['sang2'];
		        $chieu2=$_POST['chieu2'];
		        $toi2=$_POST['toi2'];
		        $sang3=$_POST['sang3'];
		        $chieu3=$_POST['chieu3'];
		        $toi3=$_POST['toi3'];
		        $sang4=$_POST['sang4'];
		        $chieu4=$_POST['chieu4'];
		        $toi4=$_POST['toi4'];
		        $sang5=$_POST['sang5'];
		        $chieu5=$_POST['chieu5'];
		        $toi5=$_POST['toi5'];
		        $sang6=$_POST['sang6'];
		        $chieu6=$_POST['chieu6'];
		        $toi6=$_POST['toi6'];
		        $sang7=$_POST['sang7'];
		        $chieu7=$_POST['chieu7'];
		        $toi7=$_POST['toi7'];
		        $sang8=$_POST['sang8'];
		        $chieu8=$_POST['chieu8'];
		        $toi8=$_POST['toi8'];
		        $cityname=$_POST['cityname'];
		        $call=$_POST['call'];
		        $metatitle=$classname." ,".$cityname;
		        $metadesc=$descclass;
		        $descusers='';
		        $birth=date("Y-m-d H:i:s",1514798979);
		        $ExpectedDate=date("Y-m-d H:i:s",time());
		        $metakey=$classname.", gia sư 365, gia sư ".$tenmonhoc.", gia sư tại ".$cityname;

		        if(intval($call)==1){
		            $lsttopic=$this->site_model->InsertUserSMS($hoten,$username,$username,$email,$cityid,$cityname,$address,$descusers,0,$password,0,'','','',0,'','',$birth,$sms);
		        }elseif(intval($call)==2){
		            $lsttopic=$this->site_model->InsertUser($hoten,$username,$username,$email,$cityid,$cityname,$address,$descusers,0,$password,0,'','','',0,'','',$birth);
		        }
		        if($lsttopic['data'] > 0){
		            $code=$lsttopic['code'];
		            $userid=$lsttopic['data'];
		            $resultclass=$this->site_model->InsertClass($classname,$monhoc,$tenmonhoc,$topicarr,$money,$hours,$workid,$phone,$cityid,$address,$sang2,$chieu2,$toi2,$sang3,$chieu3,$toi3,$sang4,$chieu4,$toi4,$sang5,$chieu5,$toi5,$sang6,$chieu6,$toi6,$sang7,$chieu7,$toi7,$sang8,$chieu8,$toi8,$userid,$descclass,1,$studens,$teachersex,$ExpectedDate,$userid,$teachertype);
		            $classid=$resultclass['data'];
								//tại đây auto tặng 5 điểm mỗi user sau khi đăng ký thành công.
								$configpoint=$this->site_model->getpointconfig();
								$Trace="users_0";
								$this->site_model->addlogpoint($userid,1,$configpoint->PointPerDay,1,$Trace);
								//kết thúc.
		            if($classid > 0){
		                $resultmeta=$this->site_model->InsertClassMeta($classid,$metadesc,$metatitle,$metakey,'','');
		                if($resultmeta['data']>0){
		                    $result=['kq'=>true,'data'=>"$userid",'classid'=>$classid,'code'=>"$code",'uname'=>"$username"];
		                    $ip = time();
		                    $remember=0;
		                    $type=0;
		                    $token = $this->site_model->create_token($userid,$ip,$remember);
		                    $profileData = array("UserId" => $userid,
		                                 "UserName" => $username,
		                                 "EmailAddress" => $email,
		                                 "FullName" => $hoten,
		                                 "Phone"=>$phone,
		                                 "TokentKey" => $token,
		                                 "Type"=>$type,
		                                 "Balance"=>0,
		                                 "AccountType"=>$type);
		                                 $_SESSION['UserInfo'] = $profileData;
		                }
		            }
		        }
		        echo json_encode($result,JSON_UNESCAPED_UNICODE);
					}
    }
    function ajaxuseramplyjob()
    {
        $usercom=$_POST['com'];
        $jobid=$_POST['job'];
        $type=1;
        $active=0;
        $data=['kq'=>false,'msg'=>''];
        if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
            $arrtg=$_SESSION['UserInfo'];
            $userid=$arrtg['UserId'];
            $CreateDate=date("Y-m-d H:i:s",time());
            $result=$this->site_model->insertuserjob($userid,$usercom,$jobid,$type,$CreateDate,$active);
            if($result['kq']=true){
            $data=['kq'=>true,'msg'=>'Nộp đơn thành công'];
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }

    }
    function ajaxusersavejob()
    {

        $usercom=$_POST['com'];
        $jobid=$_POST['job'];
        $type=2;
        $active=0;
        $data=['kq'=>false,'msg'=>''];
        if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
            $arrtg=$_SESSION['UserInfo'];
            $userid=$arrtg['UserId'];
            $CreateDate=date("Y-m-d H:i:s",time());
            $result=$this->site_model->insertuserjob($userid,$usercom,$jobid,$type,$CreateDate,$active);
            $data=['kq'=>true,'msg'=>'lưu việc thành công'];
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }

    }
    function ajaxcompanysaveuser()
    {
        $useruv=$_POST['use'];
        $jobid=0;
        $type=3;
        $active=0;
        $data=['kq'=>false,'msg'=>''];
        if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
            $arrtg=$_SESSION['UserInfo'];
            $userid=$arrtg['UserId'];
            $CreateDate=date("Y-m-d H:i:s",time());
            $result=$this->site_model->insertuserjob($useruv,$userid,$jobid,$type,$CreateDate,$active);
            if($result['kq']==true){
            $data=['kq'=>true,'msg'=>'lưu việc thành công'];
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }

    }
		function ajaxluuthongtincongty()
		{
				$idcongty=$_POST['comid'];
				$diachi=$_POST['diachi'];
				$email=$_POST['email'];
				$mota=$_POST['mota'];
				$quymo=$_POST['quymo'];
				$sodienthoai=$_POST['sodienthoai'];
				$tenconty=$_POST['tencongty'];
				$website=$_POST['website'];
				$data=['kq'=>false,'data'=>''];
				$checkname= $this->site_model->checknamecty($tenconty);
				if(empty($checkname)){
							if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
									$arrtg=$_SESSION['UserInfo'];
									$userid=$arrtg['UserId'];
							if(intval($idcongty) >= 0 && !empty($tenconty) && !empty($mota) && !empty($sodienthoai) && !empty($email )){
									$result=$this->site_model->updatecompany($tenconty,$diachi,$website,$quymo,$idcongty,$email,$mota,$sodienthoai,$userid);

									$data=['kq'=>true,'data'=>'cập nhật thành công'];
							}

							}else{
												 show_404();
									}
				}else{
						$data=['kq'=>false,'data'=>'Tên công ty đã tồn tại'];
				}
				echo json_encode($data,JSON_UNESCAPED_UNICODE);
		}
    function ajaxhatindang()
    {
        $classid=$_POST['cid'];
        $ctype=$_POST['ctype'];
        $data=['kq'=>false,'data'=>''];
        if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
            $arrtg=$_SESSION['UserInfo'];
            $userid=$arrtg['UserId'];

            $result=$this->site_model->deleteclass($userid,intval($classid),$ctype);
            if($result['kq']==true){
                $data=['kq'=>true,'data'=>'cập nhật thành công'];
            }

echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }

    }
    function ajaxrefreshclass()
    {
        $classid=$_POST['cid'];
        $data=['kq'=>false,'data'=>''];
        if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
            $arrtg=$_SESSION['UserInfo'];
            $userid=$arrtg['UserId'];

            $result=$this->site_model->refreshclassbyuser($userid,intval($classid));
            if($result['kq']==true){
                $data=['kq'=>true,'data'=>'Làm mới thành công'];
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }else{
                   show_404();
            }

    }
    function jaxuserbuypoint()
    {
        $idcongty=$_POST['amount'];
        $data=['kq'=>false,'msg'=>''];
        if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
            $arrtg=$_SESSION['UserInfo'];
            $userid=$arrtg['UserId'];
            if(intval($idcongty)>0){
            $balance=$this->site_model->getbalace($userid);

            $configpoint=$this->site_model->getpointconfig();
            if($configpoint->MoneyPerPoint > 0){
                $price=int - ($idcongty * $configpoint->MoneyPerPoint);
                $amount=$idcongty * $configpoint->MoneyPerPoint;
            }else{
                $price=int - ($idcongty * 1000);
                $amount=$idcongty * 1000;
            }
            $trace="buypoint".date('Ymd')."_".$userid;
            if($balance->Balance > $amount){
                $curentbalance=$balance->Balance - $amount;
                $resultbalance=$this->site_model->UpdateCurentBalance($userid,$curentbalance);
                if($resultbalance['kq']==true){
                    $kq=$this->site_model->addtransaction($userid,$price,$amount,$trace,$curentbalance,1);
                    if($kq){
                        $kq1=$this->site_model->addlogbuypoint($userid,$amount,$idcongty,$trace);
                        if($kq1){
                           $data=['kq'=>true,'msg'=>'Mua điểm thành công, chờ xác nhận của quản trị viên'];
                        }
                    }
                }
            }else{
                $data=['kq'=>false,'msg'=>'Số dư không đủ giao dịch'];
            }

        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }

    }
    function ajaxluutindadang()
    {
        $id=$_POST['id'];
        $tieude=$_POST['tieude'];
        $nganhnghe=$_POST['nganhnghe'];
        $nganhnghe=join(',',$nganhnghe);
        $diadiem=$_POST['diadiem'];
        $diadiem=join(',',$diadiem);
        $mota=$_POST['mota'];
        $yeucauhoso=$_POST['yeucauhoso'];
        $yeucau=$_POST['yeucau'];
        $quyenloi=$_POST['quyenloi'];
        $kinhnghiem=$_POST['kinhnghiem'];
        $bangcap=$_POST['bangcap'];
        $hinhthuc=$_POST['hinhthuc'];
        $luong=$_POST['luong'];
        $capbac=$_POST['capbac'];
        $gioitinh=$_POST['gioitinh'];
        $ngayhethan=$_POST['ngayhethan'];
        $parttime=$_POST['parttime'];
        $data=['kq'=>false,'data'=>'Cập nhật thất bại'];
        if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){

        $arrtg=$_SESSION['UserInfo'];
        $userid=$arrtg['UserId'];
        $comdetail=$this->site_model->GetDetailCompanyByID($userid);
        $result=$this->site_model->InsertNew($id,$tieude,$nganhnghe,$diadiem,$mota,$yeucauhoso,$yeucau,$quyenloi,$kinhnghiem,$bangcap,$hinhthuc,$luong,$capbac,$gioitinh,$ngayhethan,$comdetail->usc_id,$parttime);

        if($result != ''){
            $data=['kq'=>true,'data'=>'Cập nhật thành công'];
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }

    }
    function ajaxluuthongtinungvien()
    {
        $bangcap=$_POST['bangcap'];
        $capbac=$_POST['capbac'];
        $congviec=$_POST['congviec'];
        $diachi=$_POST['diachi'];
        $gioitinh=$_POST['gioitinh'];
        $hinhthuclv=$_POST['hinhthuclv'];
        $honnhan=$_POST['honnhan'];
        $hoten=$_POST['hoten'];
        $kinhnghiem=$_POST['kinhnghiem'];
        $kynang=$_POST['kynang'];
        $mucluong=$_POST['mucluong'];
        $muctieu=$_POST['muctieu'];
        $nganhhoc=$_POST['nganhhoc'];
        $nganhnghe=$_POST['nganhnghe'];
        $nganhnghekhac=$_POST['nganhnghekhac'];
        $ngonngu=$_POST['ngonngu'];
        $noilamvieckhac=$_POST['noilamvieckhac'];
        $quanhuyen=$_POST['quanhuyen'];
        $sodienthoai=$_POST['sodienthoai'];
        $tinhthanh=$_POST['tinhthanh'];
        $truong=$_POST['truong'];
        $xeploai=$_POST['xeploai'];
        $ngaysinh=$_POST['ngaysinh'];
        $data=['kq'=>false,'data'=>"cập nhật thất bại"];
				$email=$_POST['email'];
        if(!empty($_SESSION['UserInfo'])){
						if(empty($_SESSION['UserInfo']['EmailAddress'])){
							session_start();
							$_SESSION['UserInfo']['EmailAddress']=$email;
						}
            $arrtg=$_SESSION['UserInfo'];
            $userid=$arrtg['UserId'];
            $gioithieuchung=$_POST['gioithieuchung'];
            $motaexp=$_POST['motaexp'];
            $result=$this->site_model->updatethongtinungvien($userid,$bangcap,$capbac,$congviec,$diachi,$gioitinh,$hinhthuclv,$honnhan,$hoten,$kinhnghiem,$kynang,$mucluong,$muctieu,$nganhhoc,$nganhnghe
            ,$nganhnghekhac,$ngonngu,$noilamvieckhac,$quanhuyen,$sodienthoai,$tinhthanh,$truong,$xeploai,$ngaysinh,$gioithieuchung,$motaexp,$email);
            $data=['kq'=>false,'data'=>''];
            if($result != ""){
               $data=['kq'=>true,'data'=>"cập nhật thành công"];
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                   show_404();
            }

    }
		function ajaxuserupdateclass()
		{
			$result=['kq'=>false,'data'=>''];
			$classid  =  $_POST['uc'];
			$topicarr=$_POST['topicarr'];
			$classname=$_POST['classname'];
			$teachertype=$_POST['teachertype'];
			$teachersex=$_POST['teachersex'];
			$monhoc=$_POST['monhoc'];
			$tenmonhoc=$_POST['tenmonhoc'];
			$studens=$_POST['studens'];
			$hours=$_POST['hours'];
			$workid=$_POST['workid'];
			$money=$_POST['money'];
			$phone=$_POST['phone'];
			$cityid=$_POST['cityid'];
			$address=$_POST['address'];
			$descclass=$_POST['descclass'];
			$sang2=$_POST['sang2'];
			$chieu2=$_POST['chieu2'];
			$toi2=$_POST['toi2'];
			$sang3=$_POST['sang3'];
			$chieu3=$_POST['chieu3'];
			$toi3=$_POST['toi3'];
			$sang4=$_POST['sang4'];
			$chieu4=$_POST['chieu4'];
			$toi4=$_POST['toi4'];
			$sang5=$_POST['sang5'];
			$chieu5=$_POST['chieu5'];
			$toi5=$_POST['toi5'];
			$sang6=$_POST['sang6'];
			$chieu6=$_POST['chieu6'];
			$toi6=$_POST['toi6'];
			$sang7=$_POST['sang7'];
			$chieu7=$_POST['chieu7'];
			$toi7=$_POST['toi7'];
			$sang8=$_POST['sang8'];
			$chieu8=$_POST['chieu8'];
			$toi8=$_POST['toi8'];
			$consult=$_POST['consult'];
			$cityname=$_POST['cityname'];
			$classarr=$_POST['idclass'];
			$facebook=$_POST['Facebook'];

			if(!empty($_SESSION['UserInfo'])){
					$tg=$_SESSION['UserInfo'];
					$userid=$tg['UserId'];
					$resultclass=['kq'=>false,'data'=>0];
					if(intval($classid)>0){
					$resultclass=$this->site_model->UpdateClass($classid,$classname,$monhoc,$tenmonhoc,$topicarr,$money,$hours,$workid,$phone,$cityid,$address,$sang2,$chieu2,$toi2,$sang3,$chieu3,$toi3,$sang4,$chieu4,$toi4,$sang5,$chieu5,$toi5,$sang6,$chieu6,$toi6,$sang7,$chieu7,$toi7,$sang8,$chieu8,$toi8,$descclass,1,$studens,$teachersex,$ExpectedDate,$teachertype,$consult,$classarr,$facebook);
					if($resultclass['kq']==true){
						 $result =['kq'=>true,'data'=>'Cập nhật thành công'];
					}
					}else{
							$resultclass=$this->site_model->InsertClass($classname,$monhoc,$tenmonhoc,$topicarr,$money,$hours,$workid,$phone,$cityid,$address,$sang2,$chieu2,$toi2,$sang3,$chieu3,$toi3,$sang4,$chieu4,$toi4,$sang5,$chieu5,$toi5,$sang6,$chieu6,$toi6,$sang7,$chieu7,$toi7,$sang8,$chieu8,$toi8,$userid,$descclass,1,$studens,$teachersex,$ExpectedDate,$userid,$teachertype,$consult,$classarr,$facebook);
							$classid=$resultclass['data'];
							if($classid > 0){
									$resultmeta=$this->site_model->InsertClassMeta($classid,$metadesc,$metatitle,$metakey,'','');
									 if($resultmeta['data']>0){
											$result=['kq'=>true,'data'=>'Thêm mới thành công'];
											}
									}
					}
					echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}

        else{
                   show_404();
            }

    }
		function getarrayclass(){
			if(!empty($_POST)){
				$datasend1="<option value='0'>Chọn lớp học</option>";
				$result=['kq'=>false,'data'=>$datasend1];
				if($_POST['idmonhoc']>0){
					$datasend="<option value='0'>Chọn lớp học</option>";
					$monhoc=$this->db->get_where('subject',array('ID'=>$_POST['idmonhoc']))->row();
						if(!empty($monhoc->areaclass)){
							$query= " select * FROM lophoc WHERE id IN (".$monhoc->areaclass.") ";
							$data=$this->db->query($query)->result();
							foreach ($data as &$value2) {
								$datasend.="<option value='".$value2->id."'>".$value2->name."</option>";
							}
						}
					if(!empty($datasend)){
						$result=['kq'=>true,'data'=>$datasend];
					}

				}else{
					$monhoc=$this->db->select('id,name');
					$monhoc=$this->db->get('lophoc')->result();
					foreach ($monhoc as  $valuemonhoc) {
						$datasend1.="<option value='".$valuemonhoc->id."'>".$valuemonhoc->name."</option>";
					}
					$result=['kq'=>true,'data'=>$datasend1];
				}

				echo json_encode($result,JSON_UNESCAPED_UNICODE);
			}else{
				show_404();
			}

		}

		function page404(){
			$data['meta_title']= '404 PAGE NOT FOUND';
			$data['meta_des']='PAGE ERROR 404';
			$data['heading']='Oops, lỗi mất rồi';
			$data['message']='Trang bạn tìm kiếm không tồn tại';
			$data['content']='404';
			$data['classheader']='navbar navbar-default white bootsnav on no-full';
			$this->load->view('template',$data);
		}
		function AjaxchudeCheckbox2()
{
	if(!empty($_POST['idmon'])){
		$idmonhoc=$this->input->post('idmon');
		$lsttopic=$this->site_model->ListTopicBySubject($idmonhoc);
		$data="";
		foreach($lsttopic as $n){
				$data.="<li>";
				$data.="<input class='radio-calendar' id='toppic-".$n->ID."' type='checkbox' name='toppicchk' value='".$n->ID."'>
								<label for='toppic-".$n->ID."'>".$n->NameTopic."</label>";
				$data.="</li>";
		}
		$query= 'select l.id,l.name from lophoc as l join subject as s where s.ID='.$idmonhoc.' and FIND_IN_SET(l.id,s.areaclass) ';
		$listlophoc=$this->db->query($query)->result();
		if(!empty($listlophoc)){
			foreach ($listlophoc as $value) {
				$data2.="<li>";
				$data2.="<input class='radio-class' id='toppic-class-".$value->id."' type='checkbox' name='toppicclass' value='".$value->id."'>
								<label for='toppic-class-".$value->id."'>".$value->name."</label>";
				$data2.="</li>";
			}
		}
		$result=['kq'=>true,'data'=>$data,'data2'=>$data2];
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		}else{
			show_404();
		}
}
function ajaxupdateissearch1()
{
	if(!empty($_POST)){
		$result=['kq'=>false,'data'=>''];
		$issearch=$this->input->post('issearch');
		if(!empty($_SESSION['UserInfo'])){
				$tg=$_SESSION['UserInfo'];
				$userid=$tg['UserId'];
				$lst=$this->site_model->updateissearchuser1($userid,$issearch);
				if($lst){
					$result=['kq'=>true,'data'=>'Cập nhật thành công'];
				}
		 }
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}else{
		show_404();
	}

}
function ajaxgetcodeconfirm(){
		if(!empty($_POST['code'])){
			if($_POST['type']==0 || $_POST['type']==1 || $_POST['type']==3){
				$type=1;
			}else{
				$type=2;
			}
				$result=$this->site_model->UpdateAccuracyCode($_POST['code'],$type);
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
		}else{
			show_404();
		}
	}
	function testEverything(){
		$linkseo=$this->site_model->getitemSEO(3);
		pr($linkseo);
		// $stt1=strpos($linkseo->content_thu,'src="');
		// $start=$stt1+5;
		//
		// pr($stt1);
		$content=explode($linkseo->content_thu,'src="');
		pr($content);
		// die();
	}
	function nhatuyendung(){
		$page=$start_row=$this->uri->segment(2);
		$data['home'] = false;
		$data['showsearch']=false;
		$data['meta_title']="Các nhà tuyển dụng hàng đầu | Vieclam123.vn";
		$data['meta_des']="Danh sách công ty, nhà tuyển dụng việc làm mới nhất cho các ứng viên tìm kiếm việc làm phù hợp, nhanh chóng và uy tín nhất.";
		$data['meta_key']="công ty,nhà tuyển dụng";

		$perpage=30;
		if(empty($page)||intval($page)==0){
				$page=0;
		}else{
				$page=intval($page);
		}
		for($i=1;$i<64;$i++){
			$tinhthanh=Getcitybyindex($i); //get tỉnh thành
			$linkCity[]="<a rel='nofollow' href=".base_url()."nha-tuyen-dung-tai-".vn_str_filter($tinhthanh)."-c$i".".html>Nhà tuyển dụng tại ".$tinhthanh." </a>";
		}
		$query=$this->site_model->Getallcompanybypage($page,$perpage);
		$data['query']=$query['data'];
		$link=base_url()."cong-ty.html";
		$this->load->library('pagination');
		$config['total_rows'] = $query['total'];
		$config['per_page'] = $perpage;
		$config['uri_segment'] =2;
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['num_links'] = 4;
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['base_url']=$link;
		$this->pagination->initialize($config);
		$data['total']=$query['total'];
		$data['start_row']= $page;
		$data['pagination']= $this->pagination->create_links();
		$data['linkCity']=$linkCity;
		$data['canonical']=$link;
		$data['content']='nhatuyendung';
		$data['cssbody']=''	;
		$data['classheader']='navbar navbar-default white bootsnav on no-full';
		$this->load->view('template',$data);
		}
		function listcompanybyCity($alias,$city){

				// $currentUrl= current_url();
				$page=$start_row=$this->uri->segment(2);
				$data['home'] = false;
				$data['showsearch']=false;

				$perpage=10;
				if(empty($page)||intval($page)==0){
						$page=0;
				}else{
						$page=intval($page);
				}
				$data['keyfilter']=['place'=>$city];
				$result=$this->site_model->GetallcompanybyCity($city,$page,$perpage);//tìm kiếm list gia sư thỏa mãn cả 3 tiêu chí về subject(môn học), city(tỉnh thành), class(lớp học).
				$data['lstitem']=$result['data'];

				if(intval($city)>0){
						$tinhthanh=$this->site_model->SelectProvinceByID1(intval($city));
						$data['cityname']=$tinhthanh->cit_name;
				}
				if((intval($city)> 0)){ //gia sư theo tỉnh thành. xong.
					$alias="tai-".vn_str_filter($tinhthanh->cit_name);
						$link=base_url()."nha-tuyen-dung-".$alias."-c$city"."html";
						$metakey="Tìm nhà tuyển dụng tại ".$tinhthanh->cit_name.",nhà tuyển dụng tại ".$tinhthanh->cit_name;
						$meta="Tìm nhà tuyển dụng tại ".$tinhthanh->cit_name." uy tín";
						$desc="Tìm nhà tuyển dụng tại ".$tinhthanh->cit_name."  ✅ miễn phí, trực tiếp, không qua trung gian. Có ✅".$result['total']." nhà tuyển dụng tại ".$tinhthanh->cit_name."  ✅ Chọn công ty tốt và phù hợp với tính cách!";
						$titleCity='nhà tuyển dụng tại '.$tinhthanh->cit_name;
						for($i=1;$i<64;$i++){
							$thanhpho=Getcitybyindex($i);
							$linkCity[]='<a rel="nofollow" href="'.base_url().'nha-tuyen-dung-tai-'.vn_str_filter($thanhpho).'-c'.$i.'.html" >Gia sư tại '.$thanhpho.'</a>';
						}
				}

				$this->load->helper('locurl');
				$refineUrl=urlRefine();

					$data['tentinh'] =$tinhthanh->cit_name;
					$data['titleCity']=$titleCity;
					$data['linkCity']=$linkCity;
					$this->load->library('pagination');
					$config['total_rows'] = $result['total'];
					$config['per_page'] = $perpage;
					$config['uri_segment'] =2;
					$config['next_link'] = '<i class="fa fa-angle-right"></i>';
					$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
					$config['num_links'] = 4;
					$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
					$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
					$config['base_url']=$link;
					$this->pagination->initialize($config);
					$data['total']=$result['total'];
					$data['order']=$order;
					$data['start_row']= $page;
					$data['pagination']= $this->pagination->create_links();
					$data['canonical']=$link;
					$sql=$this->site_model->gettblwidthid('tbl_meta',1);
					$data['meta_title']=$meta;
					$data['meta_key']=$metakey;
					$data['meta_des']=$desc;

					$data['content']='Listcompanybycity';
					$data['classheader']='navbar navbar-default white bootsnav on no-full';
					$data['cssbody']=''	;//customsl
					$data['showsupport']=true;
					$this->load->view('template',$data);

		}
}
?>
