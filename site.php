<?php 
class site extends Controller
{	
	function site()
	{
		parent::Controller(); 		
		$this->load->model('site_model');	
		$this->load->helper('locdau');		
		$this->load->helper('images');	
		$this->load->helper('device');
		//$this->output->enable_profiler(TRUE);	
		$this->load->library('memcached_library');		
	}   	
	function index()
    {
		$data['home'] = true;		
		$sql=$this->memcached_library->get('key_footer');
		$data['meta_title']=$sql->meta_title;
		$data['meta_key']=$sql->meta_key;
		$data['meta_des']=$sql->meta_des;		
		$data['canonical']=base_url();	
        $data['content']='content';		
        $this->load->view('template',$data);
    }    
    function dangky(){	    	
		if(isset($_POST['name'])){
			if(isset($_POST['id'])){
				$id=$_POST['id'];				
				if ($_FILES['image']['name']==null)
				{
					if($id==''){
						$image='';					
					}
					else{
						$image=$_POST['image'];									
					}					
				}
				else
				{							
					$filename = $_FILES['image']['name'];
			        $filedata = $_FILES['image']['tmp_name'];					
										
					$temp=explode('.',$filename);				
					$image=$filename;
					$imageThumb = new Image($filedata);			
					$thumb_path = $temp[0];			
					$imageThumb->resize(250,250,'crop');
					$imageThumb->save($thumb_path, 'upload/ungvien', $temp[1]);							
				}	
				if($_POST['passnew']!=''){
					$data= array(					
						'image' 	=> $image,
						'name' 		=> $_POST['name'],
						'password'	=> md5($_POST['passnew']),
						'mobile' 	=> $_POST['mobile'],
						'address' 	=> $_POST['address'],
						'sex' 		=> $_POST['sex']
					);	
					$this->site_model->add_tbl('tbl_ungvien',$data,$id);
					//unset($_SESSION['name']);
					//unset($_SESSION['username']);					
					redirect(site_url('ho-so-cua-toi'));
				}else{
					$data= array(											
						'name' 		=> $_POST['name'],
						'image' 	=> $image,						
						'mobile' 	=> $_POST['mobile'],
						'address' 	=> $_POST['address'],
						'sex' 		=> $_POST['sex']
					);	
					$this->site_model->add_tbl('tbl_ungvien',$data,$_POST['id']);
					redirect(site_url('ho-so-cua-toi'));
				}						
			}else{				
				$pass = md5($_POST['pass']);
				date_default_timezone_set('Asia/Ho_Chi_Minh');
			   	$day = date('Y-m-d H:i:s');
			   	//$secu = $this->rand_string(15);

				$data = array(										
					'use_name' 		=> $_POST['name'],
					'use_email' 	=> $_POST['email'],
					'use_pass' 		=> $pass,
					'use_phone'		=> $_POST['mobile'],
					'status'	=> 1
				);				
				
				$url1 = 'https://timviec365.vn/service/cv_dk.php';
				$ch1 = curl_init($url1);			
				curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);			
				curl_setopt($ch1, CURLOPT_POST, count($data));			
				curl_setopt($ch1, CURLOPT_POSTFIELDS, $data);
				$newid = curl_exec($ch1);				
				curl_close($ch1);

				$datas = array(		
					'id'		=> $newid,
					'name' 		=> $_POST['name'],
					'email' 	=> $_POST['email'],
					'mobile'	=> $_POST['mobile'],
					'password' 	=> $pass,					
					'created_day'	=> $day,
					'status'	=> 1
				);
				$this->site_model->add_tbl('tbl_ungvien',$datas,'');
				$_SESSION['name']=$newid;
			   	$_SESSION['username']=$_POST['name'];

				/*			
				$email=$_POST['email'];
				$subject='[CV365] Kích hoạt tài khoản đăng ký';
				$header='Từ: Tuyển dụng TIMVIEC365';
				$noidung='Nhấn vào <a href="'.site_url('security/'.$secu).'" style=\"color:#009245\">đây</a> để kích hoạt tài khoản<br />';
				require_once('class.phpmailer.php');
				require_once('class.pop3.php');
				define('GUSER','rasuadsen1@gmail.com');
				define('GPWD','rasuadsen');
				global $message;
				$this->smtpmailer($email,'rasuadsen1@gmail.com',$header,$subject,$noidung);
				*/
			
				if(!is_dir('upload/ungvien/uv_'.$newid)){
					mkdir('upload/ungvien/uv_'.$newid, 0755, TRUE);
				}
				redirect(site_url('ho-so-cua-toi'));
			}								
		}else{redirect(site_url());}
	}
	function security($string){
		$check = $this->db->query('SELECT id,name FROM tbl_ungvien WHERE status=0 AND security="'.$string.'"');
		if($check->num_rows()>0){
			$ur = $check->row();
			$this->db->query('UPDATE tbl_ungvien SET security="", status=1 WHERE id='.$ur->id);
			$_SESSION['name'] = $ur->id;
			$_SESSION['username']=$ur->name;
			redirect(site_url());
		}
	}

	function delfile(){
		if(isset($_POST['id'])){
			if($_POST['type']=='cv'){
				$check = $this->db->query("SELECT id FROM tbl_cv_ungvien WHERE cvid=".$_POST['id']." AND uid=".$_SESSION['name']);
				if($check->num_rows()>0){
					$this->db->query("DELETE FROM tbl_cv_ungvien WHERE id=".$check->row()->id);
				}
			}else{
				$check = $this->db->query("SELECT id FROM tbl_thu_ungvien WHERE tid=".$_POST['id']." AND uid=".$_SESSION['name']);
				if($check->num_rows()>0){
					$this->db->query("DELETE FROM tbl_thu_ungvien WHERE id=".$check->row()->id);
				}
			}						
			echo 'true';
		}else{
			echo 'false';
		}
	}
	function view_letter(){
		if(isset($_POST['id'])){
			$view = $this->memcached_library->get('thu_view_'.$_POST['id']);
			if($view){
				$view = $view + 1;
			}else{
				$view = $sql->view + 1;
			}
			$this->memcached_library->set('thu_view_'.$_POST['id'],$view,3600);
		}
	}
	function like(){
		if(isset($_POST['tbl']) and $_SESSION['name']){
			if($_POST['tbl']=='tbl_cv'){
				$type=1;
			}else{
				$type=0;
			}
			$check = $this->db->query('SELECT status FROM tbl_like WHERE type='.$type.' AND id='.$_POST['id'].' AND uid='.$_SESSION['name']);
			if($check->num_rows()>0){
				$status=$check->row()->status;
				if($status==0){
					$new=1;
					echo 'true';
				}else{
					$new=0;
					echo 'false';
				}
				$this->db->query('UPDATE tbl_like SET status='.$new.' WHERE type='.$type.' AND id='.$_POST['id'].' AND uid='.$_SESSION['name']);
			}else{
				$data = array(
					'id' 		=> $_POST['id'],
					'uid' 		=> $_SESSION['name'],
					'status' 	=> 1,
					'type'		=> $type
				);

				$this->site_model->add_tbl('tbl_like',$data,'');	
				echo 'true';
			}
		}
	}
	function download(){
		if(isset($_POST['id'])){
			$sql = $this->db->query('SELECT download FROM tbl_cv WHERE id='.$_POST['id']);			
			if($sql->num_rows()>0){
				$dowd = $sql->row()->download + 1;
			}else{
				$dowd = 1;
			}
			$this->db->query('UPDATE tbl_cv SET download='.$dowd.' WHERE id='.$_POST['id']);
		}
	}
	function deluser(){
		if(isset($_SESSION['name'])){			
			$this->db->query('UPDATE tbl_ungvien SET status=0 WHERE id='.$_SESSION['name']);
			unset($_SESSION['name']);
			unset($_SESSION['username']);
			echo 'true';
		}
	}
	function upload_avatar(){
		if(isset($_POST['img64'])){
			$img = $_POST['img64'];			
			$type = substr($img, 5, strpos($img, ';')-5);
			$str = $this->rand_string(15);
			if($type=='image/png'){
				$img = str_replace('data:image/png;base64,', '', $img);				
				$fileName = $str.'.png';
			}else{
				$img = str_replace('data:image/jpeg;base64,', '', $img);
				$fileName = $str.'.jpg';
			}			
			$img = str_replace(' ', '+', $img);
			$fileData = base64_decode($img);
			//saving			
			file_put_contents('tmp/'.$fileName, $fileData);
			echo 'tmp/'.$fileName;
		}		
	}
	function dangnhap()
    {       
        if(isset($_POST['email']))
        {		    
           $check = $this->db->query('SELECT id,name FROM tbl_ungvien WHERE status=1 AND email="'.$_POST['email'].'" AND password="'.md5($_POST['pass']).'"');
           if($check->num_rows()>0){
			   $sql=$check->row();
			   $_SESSION['name']=$sql->id;
			   $_SESSION['username']=$sql->name;		   
			   date_default_timezone_set('Asia/Ho_Chi_Minh');
			   $day = date('Y-m-d H:i:s');	
			   $this->db->query('INSERT INTO tbl_logs (uid,last_login) VALUES('.$sql->id.',"'.$day.'")');
			   redirect($_POST['boxlink']);
           }
        }        
    }
    function check_tk()
    {       
        if(isset($_POST['email'])){		    
           	$check = $this->db->query('SELECT id,name FROM tbl_ungvien WHERE status=1 AND email="'.$_POST['email'].'" AND password="'.md5($_POST['pass']).'"');           
           	if($check->num_rows()>0){			   
			   echo 'true';
           	}else{
	           	$param = array(
				    'use_email' => $_POST['email'],
				    'use_pass'	=> md5($_POST['pass'])
				);
				 			
				$url = 'https://timviec365.vn/service/cv_dn.php';			
				$ch = curl_init($url);			
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			
				curl_setopt($ch, CURLOPT_POST, count($param));			
				curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
				$d = curl_exec($ch);
				curl_close($ch);
				
				if($d=='false'){
					echo 'false';
				}else{				
					$d = json_decode($d);
					date_default_timezone_set('Asia/Ho_Chi_Minh');
				   	$day = date('Y-m-d H:i:s');				   	
					$data = array(		
						'id'		=> $d->use_id,
						'name' 		=> $d->use_name,
						'email' 	=> $d->use_email,
						'password' 	=> md5($_POST['pass']),
						'sex'		=> $d->use_sex,
						'marry'		=> $d->use_hon_nhan,
						'address'	=> $d->use_address,
						'mobile'	=> $d->use_phone,
						'birthday'	=> date('Y-m-d',$d->use_birth_day),
						'created_day'	=> $day,
						'status'	=> 1
					);
					$this->site_model->add_tbl('tbl_ungvien',$data,'');
					$_SESSION['name']=$d->use_id;
				   	$_SESSION['username']=$d->use_first_name;
				   	if(!is_dir('upload/ungvien/uv_'.$d->use_id)){
						mkdir('upload/ungvien/uv_'.$d->use_id, 0755, TRUE);
					}
				   	$this->db->query('INSERT INTO tbl_logs (uid,last_login) VALUES('.$d->use_id.',"'.$day.'")');				   	
				   	echo 'true';
				}
	        }   	        
	    }else{          
			echo 'false';
        } 
    }
    function rand_string($length)
	{
	   $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 
	   $str='';
	   $size=strlen($chars);
	   for($i=0;$i<$length;$i++)
	   {
		$str.=$chars[rand(0,$size-1)];
	   }
	   return $str;
	}
    function resetpass()
	{	   
	   $ur = $this->db->query('SELECT id FROM tbl_ungvien WHERE status=1 AND email="'.$_POST['email'].'"');	  	 
	   if($ur->num_rows()==0){	  
			echo 'false';
	   	}
	  	else{	  		
	  		$user = $ur->row();			
			$pass=$this->rand_string(10);
			$email=$_POST['email'];
			$mknew = md5($pass);

			$this->db->query('UPDATE tbl_ungvien SET password="'.$mknew.'" WHERE email="'.$email.'"');
			$subject='[CV365] Reset mật khẩu tài khoản ứng viên';
			$header='Từ: CV365';
			$noidung="Mật khẩu mới: <span style=\"color:#02b5e1\">$pass</span><br />";
			$noidung.="Vui lòng thay đổi mật khẩu sau khi đăng nhập thành công\r\n";			
			require_once('class.phpmailer.php');             
			require_once('class.pop3.php');    
			define('GUSER','rasuadsen1@gmail.com');
			define('GPWD','rasuadsen');
			global $message;
			$this->smtpmailer($email,'rasuadsen1@gmail.com',$header,$subject,$noidung);
			redirect(site_url());	  		
	  	}	
	}
    function checkmail()
	{	   
	   $ur = $this->db->query('SELECT id FROM tbl_ungvien WHERE email="'.$_POST['email'].'"')->num_rows();	  	 
	   if($ur > 0){	  
			echo 'false';
	   }
	  	else{
	  		$param = array(
			    'use_email' => $_POST['email']
			    //'use_pass'	=> md5($_POST['pass'])
			);
			 			
			$url = 'https://timviec365.vn/service/cv_dn.php';			
			$ch = curl_init($url);			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			
			curl_setopt($ch, CURLOPT_POST, count($param));			
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
			$result = curl_exec($ch);
			curl_close($ch);
			
			if($result=='false'){
				echo 'true';
			}else{
				echo 'false';
			}
	  	}	
	}
	function mailed()
	{	   
	   	$ur = $this->db->query('SELECT id FROM tbl_ungvien WHERE email="'.$_POST['email'].'"')->num_rows();
	   	if($ur > 0){
			echo 'true';
	   	}else{	  		
		  	$param = array(
			    'use_email' => $_POST['email']
			    //'use_pass'	=> md5($_POST['pass'])
			);
			 
			// URL có chứa hai thông tin name và diachi
			$url = 'https://timviec365.vn/service/cv_dn.php';
			// Khởi tạo CURL
			$ch = curl_init($url);
			// Thiết lập có return
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// Thiết lập sử dụng POST
			curl_setopt($ch, CURLOPT_POST, count($param));
			// Thiết lập các dữ liệu gửi đi
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
			$result = curl_exec($ch);
			curl_close($ch);
			
			if($result=='false'){
				echo 'false';
			}else{
				echo 'true';
			}
		}
	}
	function passed()
	{	   
	   	$ur = $this->db->query('SELECT id FROM tbl_ungvien WHERE password="'.md5($_POST['oldpass']).'" AND id='.$_SESSION['name'])->num_rows();
	   	if($ur > 0){
			echo 'true';
	   	}else{
	  		echo 'false';
	  	}
	}
	function changepass()
	{	   
		if(isset($_POST['newpass']) and isset($_SESSION['name'])){
			$ur = $this->db->query('SELECT id FROM tbl_ungvien WHERE password="'.md5($_POST['oldpass']).'" AND id='.$_SESSION['name']);
		   	if($ur->num_rows() > 0){
		   		date_default_timezone_set('Asia/Ho_Chi_Minh');
			   	$day = date('d/m/Y');
				$this->db->query('UPDATE tbl_ungvien SET password = md5('.$_POST['newpass'].'), edit_day = "'.$day.'" WHERE id='.$_SESSION['name']);

				$param = array(					
					'use_id'		=> $_SESSION['name'],					
				    'use_pass_old'  => md5($_POST['oldpass']),
				    'use_pass_new'  => md5($_POST['newpass'])					
				);
				$url = 'https://timviec365.vn/service/cv_pass.php';			
				$ch = curl_init($url);			
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			
				curl_setopt($ch, CURLOPT_POST, count($param));			
				curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
				curl_exec($ch);					
				curl_close($ch);
				redirect(site_url('ho-so-cua-toi'));
		   	}	
		}	   	
	}
    function logout()
    {
        if(isset($_SESSION['name'])){
            unset($_SESSION['name']);
            unset($_SESSION['username']);
        }
        redirect();
    }
   	function hoso($type){
        if(isset($_SESSION['name'])){
        	$query=$this->db->query('SELECT * FROM tbl_ungvien WHERE status=1 AND id='.$_SESSION['name']);
			if($query->num_rows()>0){
				$data['item']= $query->row();
				$data['hide_menu']=true;
				$data['canonical']=site_url('ho-so-cua-toi');
				$data['meta_title']='Hồ sơ ứng viên '.$data['item']->name;
				$data['meta_key']='Hồ sơ ứng viên '.$data['item']->name;
				$data['meta_des']='Hồ sơ ứng viên '.$data['item']->name;
				if($type=='thu'){
					$data['thu']=true;
				}else if($type=='edit'){
					$data['edit']=true;
				}
				$data['content']='hoso';
				$this->load->view('template',$data); 
			}
        }else{
			redirect(site_url());
		}
    }
    function edit_user(){    	
    	if(isset($_POST['birthday'])){    		
    		$check = $this->db->query('SELECT id FROM tbl_ungvien WHERE status=1 AND id='.$_SESSION['name'].' AND email="'.$_POST['email'].'"');
    		if($check->num_rows()>0){
    			if(!is_dir('upload/ungvien/uv_'.$_SESSION['name'].'/avatar')){
					mkdir('upload/ungvien/uv_'.$_SESSION['name'].'/avatar', 0755, TRUE);
				}
    			if ($_FILES['image']['name']==null){
					$image=$_POST['imaged'];
				}
				else
				{							
					$filename = $_FILES['image']['name'];
			        $filedata = $_FILES['image']['tmp_name'];					
										
					$temp=explode('.',$filename);				
					$image=$filename;
					$imageThumb = new Image($filedata);			
					$thumb_path = $temp[0];			
					$imageThumb->resize(245,245,'crop');
					$imageThumb->save($thumb_path, 'upload/ungvien/uv_'.$_SESSION['name'].'/avatar', $temp[1]);							
				}
				if($_POST['birthday']!='0000-00-00'){
					$bday = explode('/', $_POST['birthday']);
					$day = $bday[2].'/'.$bday[1].'/'.$bday[0];
				}
				date_default_timezone_set('Asia/Ho_Chi_Minh');
		   		$dayedit = date('d/m/Y');
    			$data = array(
    				'name'		=> $this->input->post('name'),
					'sex'		=> $this->input->post('sex'),
					'birthday' 	=> $day,
					'marry'		=> $this->input->post('marry'),
					'address'	=> $this->input->post('address'),
					'mobile'	=> $this->input->post('mobile'),
					'image'		=> $image,
					'edit_day'	=> $dayedit
				);
				$this->site_model->add_tbl('tbl_ungvien', $data, $_SESSION['name']);

				$param = array(					
					'use_id'		=> $_SESSION['name'],					
				    'use_name'		=> $this->input->post('name'),
					'use_gioi_tinh'		=> $this->input->post('sex'),
					'use_birth_day' 	=> strtotime($day),
					'use_hon_nhan'		=> $this->input->post('marry'),
					'use_address'	=> $this->input->post('address'),
					'use_phone'		=> $this->input->post('mobile')
				);
				$url = 'https://timviec365.vn/service/cv_update.php';			
				$ch = curl_init($url);			
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			
				curl_setopt($ch, CURLOPT_POST, count($param));			
				curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
				curl_exec($ch);					
				curl_close($ch);

				redirect('ho-so-cua-toi');
    		}
    	}
    }
	function show_news($id)
    {		
        $data['id']=$id;                		
		$query=$this->db->query('SELECT * FROM tbl_baiviet WHERE status=1 AND id='.$id);
		if($query->num_rows()>0){
			$data['item']= $query->row();		
			if($data['item']->meta_title!=''){
				$data['meta_title']=$data['item']->meta_title;
				$data['meta_key']=$data['item']->meta_key;
				$data['meta_des']=$data['item']->meta_des;
			}else{
				$data['meta_title']=$data['item']->title;
				$data['meta_key']=$data['item']->title;
				$data['meta_des']=$data['item']->title;
			}
			$data['canonical']=site_url($data['item']->alias.'.html');
			$data['content']='news';		
			$this->load->view('template',$data); 
		}else{
			redirect(site_url());
		}
    }	   
	
	function checkcapcha()
	{			   
	   	if($_SESSION['img']!=$_POST['capcha']){
			echo 'false';
	   	}else{
	   		echo 'true';
	   	}	   
	}
	
	function show_cat_sub($id)
    {						
		$start_row=$this->uri->segment(2);		
		$per_page=5;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$query=$this->site_model->gettbl_limited('tbl_baiviet',$id,'','');
		$cat=$this->memcached_library->get('key_cat_'.$id);
		$total_rows = $query->num_rows();
		$this->load->library('pagination');
		if($cat->parent==0){
			$config['base_url'] = site_url($cat->alias.'-chi-tiet');
		}else{
			$config['base_url'] = site_url($cat->alias);
		}
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =2;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);		
		$data['cid']=$id;
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
		$data['query']=$this->site_model->gettbl_limited('tbl_baiviet',$id,$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['canonical']=$config['base_url'];
		$data['content']='category_sub';
		$this->load->view('template',$data);
    }
    function danhmuc_thu($id)
    {
		$cat=$this->memcached_library->get('key_dm_thu_'.$id);				
		$data['tid']=$id;
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
		$data['query']=$this->db->query('SELECT * FROM tbl_thu WHERE status=1 AND tid='.$id.' ORDER BY id DESC LIMIT 0,12');		
		$data['canonical']=site_url('mau-thu-'.$cat->alias);
		$data['content']='danhmuc_thu';
		$this->load->view('template',$data);
    }
    function danhmuc_cv()
    {
		$cat=$this->memcached_library->get('key_danhmuc_cv');		
		$data['query']=$cat;
		$data['meta_title']='Trang danh mục CV';
		$data['meta_key']='Trang danh mục CV';
		$data['meta_des']='Trang danh mục CV';
		$data['canonical']=site_url('danh-muc-cv.html');
		$data['content']='danhmuc_cv';
		$this->load->view('template',$data);
    }
    function danhmuc_chitiet($id)
    {    	
		$cat=$this->memcached_library->get('key_danhmuc_cv_'.$id);				
		$data['ccv_id']=$id;
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
		$data['query']=$this->db->query('SELECT * FROM tbl_cv WHERE status=1 AND cid='.$id.' ORDER BY id DESC LIMIT 0,12');		
		$data['canonical']=site_url('mau-cv-'.$cat->alias.'.html');
		$data['content']='danhmuc_chitiet';
		$this->load->view('template',$data);
    }
    function maucv()
    {						
		$start_row=$this->uri->segment(2);		
		$per_page=20;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$query=$this->site_model->gettbl_limited('tbl_cv','','','');
		
		$total_rows = $query->num_rows();
		$this->load->library('pagination');		
		$config['base_url'] = site_url('mau-cv');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =2;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);		
		$data['meta_title']='Danh sách mẫu CV';
		$data['meta_key']='Danh sách mẫu CV';
		$data['meta_des']='Danh sách mẫu CV';
		$data['total']=$total_rows;
		$data['start_row']= $start_row;
		$data['query']=$this->site_model->gettbl_limited('tbl_cv','',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['canonical']=site_url('tat-ca-mau-cv');
		$data['content']='mau_cv';
		$this->load->view('template',$data);
    }
    function mauthu()
    {						
		$start_row=$this->uri->segment(2);		
		$per_page=20;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$query=$this->site_model->gettbl_limited('tbl_thu','','','');
		
		$total_rows = $query->num_rows();
		$this->load->library('pagination');		
		$config['base_url'] = site_url('mau-cover-letter');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 2;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);		
		$data['cid']=$id;
		$data['item']=$cat;
		$data['meta_title']='Danh sách mẫu thư';
		$data['meta_key']='Danh sách mẫu thư';
		$data['meta_des']='Danh sách mẫu thư';
		$data['total']=$total_rows;
		$data['start_row']= $start_row;
		$data['query']=$this->site_model->gettbl_limited('tbl_thu','',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['canonical']=site_url('mau-thu');
		$data['content']='mau_thu';
		$this->load->view('template',$data);
    }
    function chitiet_cv($id)
    {
		$sql=$this->memcached_library->get('key_cv_'.$id);
		$view = $this->memcached_library->get('cv_view_'.$id);
		if($view){
			$view = $view + 1;
		}else{
			$view = $sql->view + 1;			
		}
		$this->memcached_library->set('cv_view_'.$id,$view,3600);
		
		$data['id']=$id;
		$data['item']=$sql;
		if($sql->meta_title!=''){
			$data['meta_title']=$sql->meta_title;
			$data['meta_key']=$cat->meta_key;
			$data['meta_des']=$cat->meta_des;
		}else{
			$data['meta_title']=$sql->name;
			$data['meta_key']=$cat->name;
			$data['meta_des']=$cat->name;				
		}
		$data['canonical']=site_url($sql->alias.'.html');
		$data['content']='cv_chitiet';
		$this->load->view('template',$data);
    }
    function tao_cv($id)
    {	    	
    	header('Content-Type: text/html; charset=utf-8');
    	if(isset($_SESSION['name'])){
    		$check = $this->db->query('SELECT * FROM tbl_cv_ungvien WHERE uid='.$_SESSION['name'].' AND cvid='.$id);
    		if($check->num_rows()>0){
    			$item_ur = $check->row();    			
    		}
    		$item=$this->memcached_library->get('key_cv_'.$id);     		
    		$color = explode(',',$item->colors);
    		$fonts = array('Roboto','Tahoma','Arial');
    		$sizes = array('small','normal','large');
    		$font_spacing = array('small','normal','large');    		
			if(!isset($item_ur)){				
				$cv = json_decode($item->html);
				$user = $this->db->query('SELECT email FROM tbl_ungvien WHERE id='.$_SESSION["name"])->row();
				$data['fullname'] = $_SESSION['username'];				
				$data['email'] = $user->email;
				$load_imged = $this->db->query('SELECT html FROM tbl_cv_ungvien WHERE uid='.$_SESSION['name'].' LIMIT 1');
				if($load_imged->num_rows()>0){
					$data['avatar'] = json_decode($load_imged->row()->html)->avatar; 
				}else{
					//$data['avatar'] = 'images/no_avatar.jpg';
					$data['avatar'] = $cv->avatar; 
				}				
			}else{
				$cv = json_decode($item_ur->html);				
				$data['fullname'] = $cv->name;
				$data['avatar'] = $cv->avatar;
				$data['email'] = $cv->email;
			}			
			$data['cv_title'] = $cv->cv_title;
			$data['position'] = $cv->position;
			$data['introduction'] = $cv->introduction;			
			$data['color_active'] = $cv->css->color;
			$data['font_active'] = $cv->css->font;
			$data['font_size_active'] = $cv->css->font_size;
			$data['font_spacing_active'] = $cv->css->font_spacing;
			$menu_html = array();			
			if(isset($cv->menu)){				
				foreach ($cv->menu as $menu) {					
					$menu_html[$menu->order]['title']=$menu->content->title;
					$menu_html[$menu->order]['id']=$menu->id;
					$menu_html[$menu->order]['class']='block cvo-block';															
					if($menu->content->content->type=='profile'){						
						$menu_html[$menu->order]['class'].=' box-contact';
						$menu_html[$menu->order]['type']='profile';
						$menu_html[$menu->order]['content']=$menu->content->content->content;						
					}else if($menu->content->content->type=='skill'){
						$menu_html[$menu->order]['class'].=' box-skills';
						$menu_html[$menu->order]['type']='skill';
						$menu_html[$menu->order]['content']=$menu->content->content->skills;
					}else{						
						$menu_html[$menu->order]['content']=$menu->content->content;
					}
					$menu_html[$menu->order]['status'] = $menu->status;					
				}
			}			
			if(isset($cv->experiences)){						
				foreach ($cv->experiences as $block) {						
					$block_html[$block->order]['id'] = $block->id;
					$block_html[$block->order]['title'] = $block->content->title;
					$block_html[$block->order]['status'] = $block->status;
					$block_html[$block->order]['content'] = $block->content->content;
				}				
			}			
			$data['controls'] = '<div class="blockControls">
                            <div title="Di chuyển khối" class="show-layout-editor"><i class="fa fa-bars"></i></div>
                            <div title="Chuyển mục này lên trên" class="up">▲</div>
                            <div title="Chuyển mục này xuống dưới" class="down">▼</div>
                            <div title="Ẩn mục này" class="hide"><i class="fa fa-minus"></i> Ẩn mục</div>
                        </div>';                        
			$data['menu_html'] = $menu_html;
			$data['block_html'] = $block_html;			
    		$data['cvid']=$id;
			$data['item']=$item;			
			$data['color']=$color;			
			$data['fonts']=$fonts;
			$data['sizes']=$sizes;
			$data['font_spacing']=$font_spacing;
			$data['hide_menu']=true;
			$data['meta_title']=$item->name;
			$data['meta_key']=$item->name;
			$data['meta_des']=$item->name;
			if($id==13){
				$data['dataTile']=1.5;
			}else{
				$data['dataTile']=1;
			}
			$data['canonical']=site_url('tao-cv-'.$item->alias);
			$data['content']='tao_cv';
			$this->load->view('template',$data);
		}else{
    		redirect(site_url());
    	}
    } 
    function save_cv(){
		if(isset($_POST['ar_data']) and isset($_SESSION['name'])){
			//Change link img
			$link_img = json_decode($_POST['ar_data'])->avatar;
			if($link_img!='images/no_avatar.jpg'){
				$new = 'upload/ungvien/uv_'.$_SESSION['name'].'/'.end(explode('/', $link_img));
				copy($link_img, $new);

				$files = glob('tmp/*');
				foreach($files as $file){
				  if(is_file($file))
				    unlink($file);
				}

				$_POST['ar_data'] = str_replace($link_img, $new, $_POST['ar_data']);
			}
			$data = array(
				'uid'		=> $_SESSION['name'],
				'cvid' 		=> $_POST['cvid'],
				'html'		=> $_POST['ar_data']
			);
			$check = $this->db->query('SELECT uid FROM tbl_cv_ungvien WHERE uid='.$_SESSION['name'].' AND cvid='.$_POST['cvid']);
			if($check->num_rows()==0){
				$this->site_model->add_tbl('tbl_cv_ungvien',$data,'');
			}else{
				$this->db->where('uid',$_SESSION['name']);
				$this->db->where('cvid',$_POST['cvid']);
            	$this->db->update('tbl_cv_ungvien',$data);  
			}
			//$item=$this->memcached_library->get('key_cv_'.$_POST['cvid']);
			//redirect(site_url('tao-cv-'.$item->alias));
			echo 'true';
		}else{
			echo 'false';
		}
	}
	function find_doanhnghiep(){
		if(isset($_POST['keyword'])){			
			redirect(site_url('doanh-nghiep&keyword='.$_POST['keyword']));
		}else{
			redirect('doanh-nghiep');
		}
	}
	function search_cv(){
		if(isset($_POST['job']) and isset($_POST['exp']) and isset($_POST['note'])){			
			$link = site_url('mau-cv&category='.$_POST['job'].'&exp='.$_POST['exp'].'&note='.$_POST['note']);
			redirect($link);
		}else{
			redirect('mau-cv');
		}
	}
	function search_thu(){
		if(isset($_POST['job']) and isset($_POST['exp']) and isset($_POST['note'])){			
			$link = site_url('mau-thu&category='.$_POST['job'].'&exp='.$_POST['exp'].'&note='.$_POST['note']);			
			redirect($link);
		}else{
			redirect('mau-thu');
		}
	}
	function list_cv($cate,$exp,$note){		
		$start_row=$this->uri->segment(2);		
		$per_page=20;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$query=$this->site_model->base_limited('tbl_cv',$cate,$exp,$note,'','');
		
		$total_rows = $query->num_rows();
		$this->load->library('pagination');		
		$config['base_url'] = site_url('mau-cv&category='.$cate.'&exp='.$exp.'&note='.$note);
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =2;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);		
		$data['meta_title']='Danh sách mẫu CV';
		$data['meta_key']='Danh sách mẫu CV';
		$data['meta_des']='Danh sách mẫu CV';
		$data['total']=$total_rows;
		$data['start_row']= $start_row;
		$data['query']=$this->site_model->base_limited('tbl_cv',$cate,$exp,$note,$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['cate_id'] = $cate;
		$data['exp'] = $exp;
		$data['note'] = $note;
		$data['jobs'] = json_decode(file_get_contents('https://timviec365.vn/service/category.php?catid='.$cate));
		$data['canonical']=site_url('tat-ca-mau-cv');
		$data['content']='mau_cv';
		$this->load->view('template',$data);
	}
	function list_thu($cate,$exp,$note){
		$start_row=$this->uri->segment(2);		
		$per_page=20;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		//$query=$this->site_model->base_limited('tbl_thu',$cate,$exp,$note,'','');
		$query=$this->site_model->base_limited('tbl_thu','','','','','');

		$total_rows = $query->num_rows();
		$this->load->library('pagination');		
		$config['base_url'] = site_url('mau-thu&category='.$cate.'&exp='.$exp.'&note='.$note);
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =2;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);		
		$data['meta_title']='Danh sách mẫu thư';
		$data['meta_key']='Danh sách mẫu thư';
		$data['meta_des']='Danh sách mẫu thư';
		$data['total']=$total_rows;
		$data['start_row']= $start_row;
		//$data['query']=$this->site_model->base_limited('tbl_thu',$cate,$exp,$note,$start_row,$per_page);
		$data['query']=$this->site_model->base_limited('tbl_thu','','','',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['cate_id'] = $cate;
		$data['exp'] = $exp;
		$data['note'] = $note;
		$data['jobs'] = json_decode(file_get_contents('https://timviec365.vn/service/category.php?catid='.$cate));		
		$data['canonical']=site_url('mau-thu');
		$data['content']='mau_thu';
		$this->load->view('template',$data);
	}
    function doanhnghiep($keyword)
    {		
		$data['meta_title']='Thông tin doanh nghiệp';
		$data['meta_key']='Thông tin doanh nghiệp';
		$data['meta_des']='Thông tin doanh nghiệp';
		$sql = 'SELECT * FROM tbl_doanhnghiep WHERE status=1';		
		if($keyword!=''){
			$sql .= ' AND name like "%'.$keyword.'%"';
			$data['keyword'] = $keyword;
		}
		$sql .= ' ORDER BY id DESC LIMIT 0,6';
		$data['query']=$this->db->query($sql);
		$data['canonical']=site_url('doanh-nghiep');
		$data['content']='doanhnghiep';
		$this->load->view('template',$data);
    }
    function doanhnghiep_chitiet($id)
    {
		$cat=$this->memcached_library->get('key_doanhnghiep_'.$id);				
		$data['tid']=$id;
		$data['item']=$cat;
		$data['meta_title']=$cat->name;
		$data['meta_key']=$cat->name;
		$data['meta_des']=$cat->name;		
		$data['canonical']=site_url('doanh-nghiep/'.$cat->alias.'.html');
		$data['content']='doanhnghiep_chitiet';
		$this->load->view('template',$data);
    }
    function loadmore(){
    	$html='';
    	if(isset($_POST['table']) and $_POST['table']=='tbl_thu'){
    		$query=$this->db->query('SELECT * FROM '.$_POST['table'].' WHERE status=1 AND tid='.$_POST['id'].' ORDER BY id DESC LIMIT '.$_POST['start'].',12');
    		if($query->num_rows()>0){
				foreach ($query->result() as $qr) {		
				$html.='<div class="item"><div class="wa"><img src="upload/letter/'.$qr->image.'" alt="'.$qr->name.'">';
						if($qr->price==0){
							$html.='<span class="free">Miễn phí</span>';
						}else{
							$html.='<span>'.number_format($qr->price,0,",",".").'đ</span>';
						}
						$html.='<div class="info"><p><a href="">Xem trước</a></p><p><a href="">Tạo CV</a></p></div></div><div class="wb">
						<span><i class="img view"></i>'.$qr->view.'</span><span><i class="img like"></i>'.$qr->love.'</span><span><i class="img down"></i>'.$qr->download.'</span><div class="clr"></div></div></div>';
				} 
			}
    	}
    	if(isset($_POST['table']) and $_POST['table']=='tbl_doanhnghiep'){
    		$sql = 'SELECT id,logo,name,alias,content,banner,address FROM '.$_POST['table'].' WHERE status=1';
    		if(isset($_POST['keyword'])){
    			$sql .= ' like "%'.$_POST['keyword'].'%"';
    		}
    		
    		$sql .= ' ORDER BY id DESC LIMIT '.$_POST['start'].',6';
    		$query=$this->db->query($sql);
    		if($query->num_rows()>0){
				foreach ($query->result() as $qr) {		
					if($qr->logo!=''){
						$logo = 'upload/doanhnghiep/thumb/'.$qr->logo;
					}else{
						$logo = 'images/logo-dn.png';
					}
					$sapo='';
					$str = substr($qr->content, 0,150);
					$ar = explode(' ', $str);
					for($i=0;$i<count($ar)-1;$i++){
						$sapo.=$ar[$i].' ';
					}
					
					$sapo = strip_tags($sapo).'...';
					$html.='<li><div class="ir"><center><img src="'.$logo.'" alt="'.$qr->name.'"></center>
						<strong class="cp_name" title="'.$qr->name.'">'.$qr->name.'</strong>
						<p class="dc">'.$qr->address.'</p>
						<p class="sapo">'.$sapo.'</p>
						<a href="'.site_url('doanh-nghiep/'.$qr->alias.'.html').'">Chi tiết</a></p>
					</div></li>';
				} 
			}
    	}
    	echo $html;
    }
    function form_thu($id)
    {	    	
    	if(isset($_SESSION['name'])){
    		$check = $this->db->query('SELECT * FROM tbl_thu_ungvien WHERE uid='.$_SESSION['name'].' AND tid='.$id);
    		if($check->num_rows()>0){
    			$item_ur = $check->row();
    			$data['item_ur']=$item_ur;
    		}
    		$item=$this->memcached_library->get('key_thu_'.$id);
    		$data['tid']=$id;
			$data['item']=$item;			
			$data['hide_menu']=true;
			$data['meta_title']='Tạo mẫu thư xin việc Online';
			$data['meta_key']='Tạo mẫu thư xin việc Online';
			$data['meta_des']='Tạo mẫu thư xin việc Online';
			$data['canonical']=site_url('tao-mau-thu-'.$item->alias);
			$data['content']='form_thu';
			$this->load->view('template',$data);
		}else{
    		redirect(site_url());
    	}
    }
    function huong_dan_thu()
    {	    	
    	if(isset($_SESSION['name'])){    		
			$data['hide_menu']=true;
			$data['meta_title']='Hướng dẫn tạo thư xin việc';
			$data['meta_key']='Hướng dẫn tạo thư xin việc';
			$data['meta_des']='Hướng dẫn tạo thư xin việc';
			$data['canonical']=site_url('huong-dan-tao-thu-xin-viec');
			$data['content']='huong_dan_thu';
			$this->load->view('template',$data);
		}else{
    		redirect(site_url());
    	}
    }
    function form_top_thu(){	    	
		if(isset($_POST['name']) and isset($_SESSION['name'])){
			$ar['name'] = $_POST['name'];
			$ar['job']	= $_POST['job'];
			$ar['about']= $_POST['about'];			
			$data = array(														
				'uid'		=> $_SESSION['name'],
				'tid' 		=> $_POST['tid'],
				'name'		=> $_POST['name_letter'],
				'top_arr'	=> json_encode($ar)
			);				
			$check = $this->db->query('SELECT uid FROM tbl_thu_ungvien WHERE uid='.$_SESSION['name'].' AND tid='.$_POST['tid']);
			if($check->num_rows()==0){
				$this->site_model->add_tbl('tbl_thu_ungvien',$data,'');
			}else{
				$this->db->where('uid',$_SESSION['name']);
				$this->db->where('tid',$_POST['tid']);
            	$this->db->update('tbl_thu_ungvien',$data);  
			}
			$item=$this->memcached_library->get('key_thu_'.$_POST['tid']);
			redirect(site_url('tao-mau-thu-'.$item->alias));
		}
	}
	function form_content_thu(){	    	
		if(isset($_POST['content']) and isset($_SESSION['name'])){			
			$ar['content']	= $_POST['content'];			
			$data = array(
				'uid'		=> $_SESSION['name'],
				'tid' 		=> $_POST['tid'],				
				'content_arr'	=> json_encode($ar)
			);				
			$check = $this->db->query('SELECT uid FROM tbl_thu_ungvien WHERE uid='.$_SESSION['name'].' AND tid='.$_POST['tid']);
			if($check->num_rows()==0){
				$this->site_model->add_tbl('tbl_thu_ungvien',$data,'');
			}else{
				$this->db->where('uid',$_SESSION['name']);
				$this->db->where('tid',$_POST['tid']);
            	$this->db->update('tbl_thu_ungvien',$data);  
			}
			$item=$this->memcached_library->get('key_thu_'.$_POST['tid']);
			redirect(site_url('tao-mau-thu-'.$item->alias));
		}
	}
	function form_right_thu(){	    	
		if(isset($_POST['email']) and isset($_SESSION['name'])){
			if ($_FILES['image']['name']==null){
				$image=$_POST['imaged'];
			}
			else
			{							
				$filename = $_FILES['image']['name'];
		        $filedata = $_FILES['image']['tmp_name'];					
									
				$temp=explode('.',$filename);				
				$image='upload/ungvien/uv_'.$_SESSION['name'].'/'.$filename;
				$imageThumb = new Image($filedata);			
				$thumb_path = $temp[0];			
				$imageThumb->resize(250,250,'crop');
				$imageThumb->save($thumb_path, 'upload/ungvien/uv_'.$_SESSION['name'], $temp[1]);							
			}			
			$ar['image'] = $image;
			$ar['hide_img']	= $_POST['hide_img'];
			$ar['phone']= $_POST['phone'];
			$ar['email']= $_POST['email'];
			$ar['website']=$_POST['website'];
			$ar['address']=$_POST['address'];
			$ar['created_day']=$_POST['created_day'];
			$ar['to']=$_POST['to'];
			$data = array(														
				'uid'		=> $_SESSION['name'],
				'tid' 		=> $_POST['tid'],				
				'profile_arr'	=> json_encode($ar)
			);				
			$check = $this->db->query('SELECT uid FROM tbl_thu_ungvien WHERE uid='.$_SESSION['name'].' AND tid='.$_POST['tid']);
			if($check->num_rows()==0){
				$this->site_model->add_tbl('tbl_thu_ungvien',$data,'');
			}else{
				$this->db->where('uid',$_SESSION['name']);
				$this->db->where('tid',$_POST['tid']);
            	$this->db->update('tbl_thu_ungvien',$data);  
			}
			$item=$this->memcached_library->get('key_thu_'.$_POST['tid']);
			redirect(site_url('tao-mau-thu-'.$item->alias));
		}
	}
    function show_cat($id)
    {										
		$data['cid']=$id;
		$cat=$this->memcached_library->get('key_cat_'.$id);
		$data['item']=$cat;
		$data['meta_title']=$cat->meta_title;
		$data['meta_key']=$cat->meta_key;
		$data['meta_des']=$cat->meta_des;
		$data['canonical']=site_url($cat->alias);
		$data['content']='category';
		$this->load->view('template',$data); 				
    }		
    function show_dm_thu($id)
    {						
		$start_row=$this->uri->segment(2);		
		$per_page=5;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$cat = $this->db->query('SELECT * FROM tbl_danhmuc_thu WHERE status=1 AND id='.$id)->row();
		$query=$this->site_model->gettbl_limited('tbl_thu',$id,'','');		
		$total_rows = $query->num_rows();
		$this->load->library('pagination');		
		$config['base_url'] = site_url('mau-thu-'.$cat->alias);		
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =2;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);		
		$data['tid']=$id;
		$data['item']=$cat;
		$data['meta_title']=$cat->meta_title;
		$data['meta_key']=$cat->meta_key;
		$data['meta_des']=$cat->meta_des;
		$data['total']=$total_rows;
		$data['start_row']= $start_row;
		$data['query']=$this->site_model->gettbl_limited('tbl_thu',$id,$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['canonical']=site_url('mau-thu-'.$cat->alias);
		$data['content']='danhmuc_thu';
		$this->load->view('template',$data);
    }	
    function amp()
    {
		$data['home'] = true;
		$sql=$this->memcached_library->get('key_footer');
		$data['meta_title']=$sql->meta_title;
		$data['meta_key']=$sql->meta_key;
		$data['meta_des']=$sql->meta_des;		
		$data['canonical']=base_url();	
        $data['content']='content_amp';		
        $this->load->view('template_amp',$data);
    }
	function smtpmailer($to, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->CharSet = "UTF-8";
        $mail->SMTPSecure = 'tls';                
        $mail->Host = 'smtp.gmail.com';         
        $mail->Port = 25;                         
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
}
?>