<?php
class admin extends Controller
{
	function admin()
	{
		parent::Controller();
		$this->load->helper('locdau');
		$this->load->helper('images');
		$this->load->library('pagination');
		$this->load->model('admin/admin_model');
	}
	function index()
    {
		$this->checklogin();
        $data['content']='includes/content';
        $this->load->view('template',$data);
    }
	function banner()
    {
		$this->checklogin();
		$this->checkrole();
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
            $per_page=20;
    		if(is_numeric($start_row))
    		{
    			$start_row=$start_row;
    		}
    		else
    		{
    			$start_row=0;
    		}
            $query=$this->admin_model->gettbl('tbl_banner','');
    		$total_rows = $query->num_rows();
    		$this->load->library('pagination');
    		$config['base_url'] = site_url().'/admin/banner';
    		$config['total_rows'] = $total_rows;
    		$config['per_page'] = $per_page;
    		$config['uri_segment'] =3;
    		$config['next_link'] = '<';
    		$config['prev_link'] = '>';
    		$config['num_links'] = 4;
    		$config['first_link'] = '<<';
    		$config['last_link'] = '>>';
    		$this->pagination->initialize($config);
    		$data['query']=$this->admin_model->gettbl_limited('tbl_banner',$start_row,$per_page);
    		$data['pagination']= $this->pagination->create_links();
    		$data['content']='banner';
    		$this->load->view('template',$data);
    }
	function frmbanner()
    {
		$this->checklogin();
		$this->checkrole();
        $data['content']='frmbanner';
        $this->load->view('template',$data);
    }
	function add_banner()
    {
		$this->checklogin();
		$this->checkrole();
		$id = $this->input->post('id');
		if(!is_dir('upload/banner')){
			mkdir('upload/banner', 0755, TRUE);
		}
		if ($_FILES['file']['name']==null)
		{
			if($id==''){
				$file='';
			}
			else{
				$file=$_POST['file'];
			}
		}
		else
		{
			$filename = $_FILES['file']['name'];
	        $filedata = $_FILES['file']['tmp_name'];
			$temp=explode('.',$filename);
			$file=$filename;
			$imageThumb = new Image($filedata);
			$thumb_path = $temp[0];
			/*
			$imageThumb->resize(200,200,'crop');
			*/
			$imageThumb->save($thumb_path, 'upload/banner', $temp[1]);
		}
		/*-----------------------------*/
		$data=array(
				'name'  	=>  $this->input->post('name'),
				'link'  	=>  $this->input->post('link'),
				'file'  	=>  $file,
				'vip'  		=>  $this->input->post('vip'),
				'vitri'  	=>  $this->input->post('vitri'),
				'sort'  	=>  $this->input->post('sort'),
				'cid'		=>	$this->input->post('cid'),
				'status'    =>  $this->input->post('status')
			);
		$this->admin_model->add_tbl('tbl_banner',$data,$id);
		redirect('admin/banner');
    }

	function edit_banner($id)
    {
		$this->checklogin();
		$this->checkrole();
        $data['id']=$id;
        $data['content']='frmbanner';
        $this->load->view('template',$data);
    }
		function del_doanhnghiep()
			{
				$this->checklogin();
						$checkbox=$_POST['checkbox'];
						$countcheck=count($checkbox);
						if($countcheck!=0)
						{
								for($i=0;$i<$countcheck;$i++)
								{
										$del_id = $checkbox[$i];
										$result = $this->admin_model->delrowtbl('user_company','usc_id',$del_id);
										$result = $this->admin_model->delrowtbl('new','new_user_id',$del_id);
										$result = $this->admin_model->delrowtbl('user_company_multi','usc_id',$del_id);

					}
					redirect('admin/doanhnghiep/'.$_SESSION['start_row']);
						}
						else
						{
								echo 'Bạn phải chọn';
					redirect('admin/ungvien');
						}
		}
	function del_banner()
	{
		$this->checklogin();
		$this->checkrole();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);
        if($countcheck!=0)
        {
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$sql="SELECT file FROM tbl_banner WHERE id=".$del_id;
				$query=$this->db->query($sql)->row();
				//unlink($query->file);//xoa file
				$result = $this->admin_model->del_tbl('tbl_banner',$del_id);
			}
            if($result)
            {
                redirect('admin/banner');
            }
        }
        else
        {
            echo 'Bạn phải chọn';
            redirect('admin/banner');
        }
	}
	function checkbanner()
	{
		$this->checklogin();
		$this->checkrole();
		$action=$_POST['active'];
        $id=$_POST['id'];
        $this->admin_model->checkstatus('tbl_banner',$action,$id);
	}

	function slider()
    {
		$this->checklogin();
		$this->checkrole();
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$query=$this->admin_model->gettbl('tbl_slider','');
		$total_rows = $query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/slider';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '<';
		$config['prev_link'] = '>';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$this->admin_model->gettbl_limited('tbl_slider',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='slider';
		$this->load->view('template',$data);
    }
	function frmslider()
    {
		$this->checklogin();
		$this->checkrole();
        $data['content']='frmslider';
        $this->load->view('template',$data);
    }
	function add_slider()
    {
		$this->checklogin();
		$this->checkrole();
		$id = $this->input->post('id');
		if(!is_dir('upload/slider')){
				mkdir('upload/slider', 0755, TRUE);
			}
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
				$imageThumb->save($thumb_path, 'upload/slider', $temp[1]);
			}
		/*-----------------------------*/
		$data=array(
				'name'  		=>  $this->input->post('name'),
				'image'  		=>  $image,
				'link'  		=>  $this->input->post('link'),
				'content'		=>	$this->input->post('content'),
				'status'    	=>  $this->input->post('status')
			);
		$this->admin_model->add_tbl('tbl_slider',$data,$id);
		redirect('admin/slider');
    }

	function edit_slider($id)
    {
		$this->checklogin();
		$this->checkrole();
        $data['id']=$id;
        $data['content']='frmslider';
        $this->load->view('template',$data);
    }
	function del_slider()
	{
		$this->checklogin();
		$this->checkrole();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);
        if($countcheck!=0)
        {
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->del_tbl('tbl_slider',$del_id);
			}
            if($result)
            {
                redirect('admin/slider');
            }
        }
        else
        {
            echo 'Bạn phải chọn';
            redirect('admin/slider');
        }
	}
	function checkslider()
	{
		$this->checklogin();
		$this->checkrole();
		$action=$_POST['active'];
        $id=$_POST['id'];
        $this->admin_model->checkstatus('tbl_slider',$action,$id);
	}
	////////////End slider////////////
	function custom()
    {
		$this->checklogin();
		$this->checkrole();
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$query=$this->admin_model->gettbl('customhtml','');
		$total_rows = $query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/custom';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '<';
		$config['prev_link'] = '>';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$this->admin_model->gettbl_limited('customhtml',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='custom';
		$this->load->view('template',$data);
    }
	function frmcustom()
    {
		$this->checklogin();
		$this->checkrole();
        $data['content']='frmcustom';
        $this->load->view('template',$data);
    }
	function add_custom()
    {
		$this->checklogin();
		$this->checkrole();
		$id = $this->input->post('id');
		$data=array(
				'name'  		=>  $this->input->post('name'),
				'html'			=>	$this->input->post('html'),
				'sort'  		=>  $this->input->post('sort'),
				'status'    	=>  $this->input->post('status')
			);
		$this->admin_model->add_tbl('customhtml',$data,$id);
		redirect('admin/custom');
    }

	function edit_custom($id)
    {
		$this->checklogin();
		$this->checkrole();
        $data['id']=$id;
        $data['content']='frmcustom';
        $this->load->view('template',$data);
    }

    // meta page
    function pagemeta()
    {
		$this->checklogin();
		$this->checkrole();
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$query=$this->admin_model->gettbl('tbl_meta','');
		$total_rows = $query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/pagemeta';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '<';
		$config['prev_link'] = '>';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$this->admin_model->gettbl_limited('tbl_meta',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='pagemeta';
		$this->load->view('template',$data);
    }
	function frmmeta()
    {
		$this->checklogin();
		$this->checkrole();
        $data['content']='frmmeta';
        $this->load->view('template',$data);
    }
	function add_meta()
    {
		$this->checklogin();
		$this->checkrole();
		$id = $this->input->post('id');
		$data=array(
				'title'  		=>  $this->input->post('title'),
				'metadesc'			=>	$this->input->post('metadesc'),
				'metakeywork'  		=>  $this->input->post('metakeywork')
			);
		$this->admin_model->add_tbl('tbl_meta',$data,$id);
		redirect('admin/pagemeta');
    }

	function edit_meta($id)
    {
		$this->checklogin();
		$this->checkrole();
        $data['id']=$id;
        $data['content']='frmmeta';
        $this->load->view('template',$data);
    }
	function del_meta()
	{
		$this->checklogin();
		$this->checkrole();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);
        if($countcheck!=0)
        {
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->del_tbl('tbl_meta',$del_id);
			}
            if($result)
            {
                redirect('admin/pagemeta');
            }
        }
        else
        {
            echo 'Bạn phải chọn';
            redirect('admin/custom');
        }
	}

	function edit_footer($id)
    {
		$this->checklogin();
		$this->checkrole();
        $data['id']=$id;
        $data['content']='frmfooter';
        $this->load->view('template',$data);
    }
    // quản lý doanh nghiệp
		function ungvien()
    {
         $this->checkrole();
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category']) or isset($_POST['city'])){
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);
			unset($_SESSION['city']);
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];
		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= '';
			$_SESSION['city'] = '';
		}
		if(!empty($_POST['date'])){
			$CreateDate=$_POST['date'];
									$tungay=explode('-',$CreateDate);
									$CreateDate=date("Y-m-d H:i:s",strtotime($tungay[2]."-".$tungay[1]."-".$tungay[0]));
		}
							if(!empty($_POST['todate'])){
			$denngay=$_POST['todate'];
									$denngay1=explode('-',$denngay);
									$denngay=date("Y-m-d H:i:s",strtotime($denngay1[2]."-".$denngay1[1]."-".$denngay1[0]." 23:59:59" ));
		}
    $query=$this->admin_model->GetAllCandibypage($_SESSION['findkey'],$_SESSION['category'],$_SESSION['city'],$CreateDate,$denngay,$start_row,$per_page);
		$total_rows =$query['total'] ;//$query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/ungvien';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='ungvien';
		$this->load->view('template',$data);
    }
    function edit_ungvien($id)
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontent('');
        $data['id']=$id;
        $data['content']='frmungvien';
        $this->load->view('template',$data);
    }
    function add_ungvien()
    {
		$this->checklogin();
        $id=$this->input->post('id');
        $use_first_name=trim($this->input->post('use_first_name'));
        $use_address=$this->input->post('use_address');
        $cv_kynang=$this->input->post('cv_kynang');
        $cv_muctieu=$this->input->post('cv_muctieu');
        $category=$this->input->post('category');
        $city=$this->input->post('city');
        $capbac=$this->input->post('capbac');
        $kinhnghiem=$this->input->post('kinhnghiem');
        $hinhthuc=$this->input->post('hinhthuc');
        $hocvan=$this->input->post('hocvan');
		$data=array(
				'cv_hocvan' 	=>	$hocvan	,
                'cv_exp'=>$kinhnghiem	,
                'cv_muctieu'=>$cv_muctieu	,
                'cv_cate_id'=>$category	,
                'cv_city_id'=>$city	,
                'cv_capbac_id'=>$capbac,
                'cv_loaihinh_id'=>	$hinhthuc,
                'cv_kynang'=>$cv_kynang
			);
        $data1=array(
				'use_first_name' 	=>	$use_first_name	,
                'use_address'=>$use_address
			);
		$this->admin_model->UpdateorAddtbl('`user`',$data1,'use_id',$id);
        $this->admin_model->UpdateorAddtbl('cv',$data,'cv_user_id',$id);
		//$this->sitemap();
		if($_SESSION['start_row']==0){redirect('admin/ungvien');}
		else{
			redirect('admin/ungvien/'.$_SESSION['start_row']);
		}
    }
    function del_ungvien()
	{
		$this->checklogin();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);
        if($countcheck!=0)
        {
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->delrowtbl('`user`','use_id',$del_id);
                $result = $this->admin_model->delrowtbl('cv','cv_user_id',$del_id);
			}
			redirect('admin/ungvien/'.$_SESSION['start_row']);
        }
        else
        {
            echo 'Bạn phải chọn';
			redirect('admin/ungvien');
        }
	}
    // quản lý doanh nghiệp
		function doanhnghiep()
    {
         $this->checkrole();
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category'])){
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);
			unset($_SESSION['city']);
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];
		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= 0;
			$_SESSION['city'] = 0;
		}
		if(!empty($_POST['date'])){
			$CreateDate=$_POST['date'];
									$tungay=explode('-',$CreateDate);
									$CreateDate=date("Y-m-d H:i:s",strtotime($tungay[2]."-".$tungay[1]."-".$tungay[0]));
		}
							if(!empty($_POST['todate'])){
			$denngay=$_POST['todate'];
									$denngay1=explode('-',$denngay);
									$denngay=date("Y-m-d H:i:s",strtotime($denngay1[2]."-".$denngay1[1]."-".$denngay1[0]." 23:59:59" ));
		}
        $query=$this->admin_model->Getallcompanybypage($_SESSION['findkey'],$_SESSION['city'],$CreateDate,$denngay,$start_row,$per_page);
		$total_rows =$query['total'] ;//$query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/doanhnghiep';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='doanhnghiep';
		$this->load->view('template',$data);
    }
    function edit_doanhnghiep($id)
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontent('');
        $data['id']=$id;
        $data['content']='frmdoanhnghiep';
        $this->load->view('template',$data);
    }
    function add_doanhnghiep()
    {
		$this->checklogin();
        $id=$this->input->post('id');
        $title=trim($this->input->post('usc_company'));
        $usc_company_info=$this->input->post('usc_company_info');
        $usc_address=$this->input->post('usc_address');
        $usc_phone=$this->input->post('usc_phone');
        $usc_website=$this->input->post('usc_website');
        $usc_mst=$this->input->post('usc_mst');
		$data=array(
				'usc_company' 	=>	$title	,
                'usc_address'=>$usc_address	,
                'usc_phone'=>$usc_phone	,
                'usc_website'=>$usc_website	,
                'usc_mst'=>$usc_mst	,
                'usc_name_add'=>$usc_address,
                'usc_name_phone'=>	$usc_phone
			);
        $data1=array(
				'usc_company_info' 	=>	$usc_company_info
			);
		$this->admin_model->UpdateorAddtbl('user_company',$data,'usc_id',$id);
        $this->admin_model->UpdateorAddtbl('user_company_multi',$data1,'usc_id',$id);
		//$this->sitemap();
		if($_SESSION['start_row']==0){redirect('admin/doanhnghiep');}
		else{
			redirect('admin/doanhnghiep/'.$_SESSION['start_row']);
		}
    }
		//ứng viên
		function trangungvien()
		{
				$this->checkrole();
		$this->load->helper('status');
				$start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
				if(isset($_POST['findkey']) OR isset($_POST['city'])){
			unset($_SESSION['findkey']);
			unset($_SESSION['city']);

			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['city'] = $_POST['city'];


		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['city'] = 0;

		}
		if(!empty($_POST['date'])){
			$CreateDate=$_POST['date'];
									$tungay=explode('-',$CreateDate);
									$CreateDate=date("Y-m-d H:i:s",strtotime($tungay[2]."-".$tungay[1]."-".$tungay[0]));
		}
							if(!empty($_POST['todate'])){
			$denngay=$_POST['todate'];
									$denngay1=explode('-',$denngay);
									$denngay=date("Y-m-d H:i:s",strtotime($denngay1[2]."-".$denngay1[1]."-".$denngay1[0]." 23:59:59" ));
		}
				$query=$this->admin_model->Getallnewcandidate($_SESSION['findkey'],$_SESSION['city'],$CreateDate,$denngay,$start_row,$per_page);
		$total_rows =$query['total'] ;//$query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/trangungvien';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='trangungvien';
		$this->load->view('template',$data);
		}
		function del_trangungvien()
	{
		$this->checklogin();
				$checkbox=$_POST['checkbox'];
				$countcheck=count($checkbox);
				if($countcheck!=0)
				{
						for($i=0;$i<$countcheck;$i++)
						{
								$del_id = $checkbox[$i];
				$result = $this->admin_model->checkstatusjob('users','`Delete`',1,'UserID',$del_id);
								$result = $this->admin_model->checkstatusjob('users','`Active`',0,'UserID',$del_id);
			}
			redirect('admin/trangungvien/'.$_SESSION['start_row']);
				}
				else
				{
						echo 'Bạn phải chọn';
			redirect('admin/trangungvien');
				}
	}
    //việc làm
		function vieclam()
    {
        $this->checkrole();
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category']) OR isset($_POST['city']) OR isset($_POST['hot'])){
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);
			unset($_SESSION['city']);
			unset($_SESSION['tinhot']);

			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];
			$_SESSION['tinhot'] = $_POST['hot'];

		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= 0;
			$_SESSION['city'] = 0;
			$_SESSION['tinhot'] = 0;

		}
		if(!empty($_POST['date'])){
			$CreateDate=$_POST['date'];
									$tungay=explode('-',$CreateDate);
									$CreateDate=date("Y-m-d H:i:s",strtotime($tungay[2]."-".$tungay[1]."-".$tungay[0]));
		}
							if(!empty($_POST['todate'])){
			$denngay=$_POST['todate'];
									$denngay1=explode('-',$denngay);
									$denngay=date("Y-m-d H:i:s",strtotime($denngay1[2]."-".$denngay1[1]."-".$denngay1[0]." 23:59:59" ));
		}

        $query=$this->admin_model->Getallnewbypage($_SESSION['findkey'],$_SESSION['category'],$_SESSION['city'],$_SESSION['tinhot'],$CreateDate,$denngay,$start_row,$per_page);
		$total_rows =$query['total'] ;//$query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/vieclam';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
        $data['monhoc']=$this->admin_model->ListSubject();
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='vieclam';
		$this->load->view('template',$data);
    }
    function add_vieclam()
    {
		$this->checklogin();
        $id=$this->input->post('id');
        $title=trim($this->input->post('new_title'));
        $mota=$this->input->post('new_mota');
        $quyenloi=$this->input->post('new_quyenloi');
        $yccongviec=$this->input->post('new_yeucau');
        $ychoso=$this->input->post('new_ho_so');
		$data=array(
				'new_title' 	=>	$title
			);
        $data1=array(
				'new_mota' 	=>	$mota,
                'new_yeucau' 	=>	$yccongviec,
                'new_quyenloi' 	=>	$quyenloi,
                'new_ho_so' 	=>	$ychoso
			);
		$this->admin_model->UpdateorAddtbl('new',$data,'new_id',$id);
        $this->admin_model->UpdateorAddtbl('new_multi',$data1,'new_id',$id);
		//$this->sitemap();
		if($_SESSION['start_row']==0){redirect('admin/vieclam');}
		else{
			redirect('admin/vieclam/'.$_SESSION['start_row']);
		}
    }
    function del_vieclam()
	{
		$this->checklogin();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);
        if($countcheck!=0)
        {
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->checkstatusjob('users','`Delete`',1,'UserID',$del_id);
                $result = $this->admin_model->checkstatusjob('users','`Active`',0,'UserID',$del_id);
			}
			redirect('admin/vieclam/'.$_SESSION['start_row']);
        }
        else
        {
            echo 'Bạn phải chọn';
			redirect('admin/vieclam');
        }
	}
	//Bài viết
	function baiviet()
    {
		$this->checklogin();
		$this->load->helper('status');
		if(isset($_POST['txt_search']) OR isset($_POST['cid']) OR isset($_POST['search_status']) OR isset($_POST['search_user'])){
			unset($_SESSION['txt_search']);
			unset($_SESSION['search_cid']);
			unset($_SESSION['search_user']);
			unset($_SESSION['search_status']);
			$_SESSION['txt_search'] = $_POST['txt_search'];
			$_SESSION['search_cid'] = $_POST['cid'];
			$_SESSION['search_user'] = $_POST['search_user'];
			$_SESSION['search_status'] = $_POST['search_status'];
		}
		else{
			if(isset($_SESSION['txt_search']) AND isset($_SESSION['search_cid']) AND isset($_SESSION['search_status']) AND isset($_SESSION['search_user']) AND $_SESSION['txt_search'] == '' AND $_SESSION['search_cid'] == 0 AND $_SESSION['search_user'] == 0 AND $_SESSION['search_status'] == -1){
				$_SESSION['txt_search'] = '';
				$_SESSION['search_cid'] = 0;
				$_SESSION['search_user'] = 0;
				$_SESSION['search_status'] = -1;
			}
		}

        $start_row=$this->uri->segment(3);
        $per_page=20;
		if(is_numeric($start_row)){
			$_SESSION['start_row']=$start_row;
		}
		else
		{
			$_SESSION['start_row']=0;
		}
		$query=$this->admin_model->gettbl_search_limited('baiviet','','');
		$total_rows = $query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/baiviet';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$this->admin_model->gettbl_search_limited('baiviet',$_SESSION['start_row'],$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='baiviet';
		$this->load->view('template',$data);
    }


	function frmbaiviet()
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontent('');
        $data['content']='frmbaiviet';
        $this->load->view('template',$data);
    }

	function add_baiviet()
    {
		$this->checklogin();
        $id=$this->input->post('id');
        $title=trim($this->input->post('title'));
        $alias=$this->input->post('alias');
        if($alias=='')
        {
            $alias=vn_str_filter($title);
        }
		$uid=$this->input->post('uid');
		$ngay=explode('-',$this->input->post('created_day'));
		if($this->input->post('time')==''){
			$time='00:00:00';
		}
		else{
			$time=$this->input->post('time');
		}
		$created_day=$ngay[2].'-'.$ngay[1].'-'.$ngay[0].' '.$time;
        $status =$this->input->post('status');
		if(!is_dir('upload/news')){
			mkdir('upload/news', 0755, TRUE);
			mkdir('upload/news/thumb', 0755, TRUE);
            mkdir('upload/news/thumb/240', 0755, TRUE);
		}
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
			$imageThumb = new Image($filedata);
			$thumb_path = vn_str_filter($title);
			$imageThumb->save($thumb_path, 'upload/news', $temp[1]);

			$imageThumb->resize(330,240,'crop');
			$imageThumb->save($thumb_path, 'upload/news/thumb', $temp[1]);
            $imageThumb->resize(240,180,'crop');
			$imageThumb->save($thumb_path, 'upload/news/thumb/240', $temp[1]);
			$image=vn_str_filter($title).'.'.$temp[1];
		}
		if($_POST['meta_title']==''){
			$meta_title = $meta_key = $meta_des = $title;
		}else{
			$meta_title = $this->input->post('meta_title');
			$meta_key 	= $this->input->post('meta_key');
			$meta_des 	= $this->input->post('meta_des');
		}
		if($_FILES["file"]["name"]){
			# Tạo thư mục
			$album_dir  =  'download/';
			if(!is_dir($album_dir)){
				mkdir($album_dir);
			}
			#upload.
			$config['upload_path']	 =  $album_dir;
			$config['allowed_types'] =  'doc|docx|pdf|xls|xlsx';
			$config['max_size'] =  10000;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$image =  $this->upload->do_upload("file");
			$image_data  = 	$this->upload->data();
			if($image) {
				$file =	$config['upload_path'].$image_data['file_name'];
			} else {
				$file = '';
			}
		}else{
			if($id==''){
				$file='';
			}
			else{
				$file=$_POST['file'];
			}
		}
		$data=array(
				'title' 	=>	$title,
				'alias'		=>	$alias,
				'cid'		=>	$this->input->post('cid'),
				'image'  	=>  $image,
				'file'  	=>  $file,
				'sapo' 		=>	$this->input->post('sapo'),
				'content'  =>  $this->input->post('content'),
				'created_day'	=>	$created_day,
				'vip' 		=>	$this->input->post('vip'),
				'status'    =>  $this->input->post('status'),
				'uid' 		=>	$uid,
				'meta_title' 	=>	$meta_title,
				'meta_key' 		=>	$meta_key,
				'meta_des' 		=>	$meta_des,
				'linkRelationship'=> $_POST['linkRelationship']
			);
		$this->admin_model->add_tbl('baiviet',$data,$id);
		// $this->sitemap();
		if($_SESSION['start_row']==0){redirect('admin/baiviet');}
		else{
			redirect('admin/baiviet/'.$_SESSION['start_row']);
		}
    }
	function edit_baiviet($id)
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontent('');
        $data['id']=$id;
        $data['content']='frmbaiviet';
        $this->load->view('template',$data);
    }
    function ajaxgetlistarticle()
    {
        $findkey = $this->input->post('findkey');
        $data=$this->admin_model->Getlistcontent($findkey);
        echo json_encode($data);
    }
	function del_baiviet()
	{
		$this->checklogin();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);
        if($countcheck!=0)
        {
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$sql="SELECT image FROM baiviet WHERE id=".$del_id;
				$query=$this->db->query($sql)->row();
				if(file_exists('upload/news/'.$query->image)){
					unlink('upload/news/'.$query->image);
					unlink('upload/news/thumb/'.$query->image);
				}
				$result = $this->admin_model->del_tbl('baiviet',$del_id);
			}
			redirect('admin/baiviet/'.$_SESSION['start_row']);
        }
        else
        {
            echo 'Bạn phải chọn';
			redirect('admin/baiviet');
        }
	}
    //link seo
	function linkseo()
    {
		$this->checklogin();
		$this->load->helper('status');
		if(isset($_POST['txt_search']) OR isset($_POST['citylinkseo']) OR isset($_POST['subjectseo'])OR isset($_POST['lophoc'])){
			unset($_SESSION['txt_search']);
			unset($_SESSION['citylinkseo']);
			unset($_SESSION['subjectseo']);
            unset($_SESSION['lophoc']);
			$_SESSION['txt_search'] = $_POST['txt_search'];
			$_SESSION['citylinkseo'] = $_POST['citylinkseo'];
			$_SESSION['subjectseo'] = $_POST['subjectseo'];
            $_SESSION['lophoc'] = $_POST['lophoc'];
		}
		else{
			if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']='' and isset($_SESSION['txt_search']) AND isset($_SESSION['citylinkseo']) AND isset($_SESSION['subjectseo'])  AND $_SESSION['txt_search'] == '' AND $_SESSION['citylinkseo'] == '' AND $_SESSION['subjectseo'] == ''){
				$_SESSION['txt_search'] = '';
				$_SESSION['citylinkseo'] = '';
				$_SESSION['subjectseo'] = '';
                $_SESSION['lophoc']='';
			}
		}

        $start_row=$this->uri->segment(3);
        $per_page=20;
		if(is_numeric($start_row)){
			$_SESSION['start_row']=$start_row;
		}
		else
		{
			$_SESSION['start_row']=0;
		}
		$query=$this->admin_model->GetAllLinkSeo($_SESSION['txt_search'],$_SESSION['citylinkseo'],$_SESSION['subjectseo'],$_SESSION['lophoc'],$_SESSION['start_row'],$per_page);//gettbl_search_limited('linkseo','','');
		$total_rows = $query['total'];//$query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/linkseo';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$query['data'];$this->admin_model->gettbl_search_limited('linkseo',$_SESSION['start_row'],$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='linkseo';
		$this->load->view('template',$data);
    }


	function frmlinkseo()
    {
		$this->checklogin();
        $data['content']='frmlinkseo';
        $this->load->view('template',$data);
    }

	function add_linkseo()
    {
		$this->checklogin();
        $id=$this->input->post('id');
        $title=trim($this->input->post('title'));
		$CreateDate=date("Y-m-d H:i:s",time());
		$itemlinkseo=$this->admin_model->getlinkseobuysubcitytype($this->input->post('subjectid'),$this->input->post('cityid'),$this->input->post('lophoc'),$this->input->post('type'));
		//var_dump($itemlinkseo);
        if($itemlinkseo != "" && $id==""){
		  $id=$itemlinkseo->id;
		}
		//var_dump($id);die();
		$data=array(
				'title' 	=>	$title,
				'htmltext'  =>  $this->input->post('htmltext'),
				'createdate'	=>	$CreateDate,
				'type' 		=>	$this->input->post('type'),
				'cityid'    =>  $this->input->post('cityid'),
				'subjectid' 		=>	$this->input->post('subjectid'),
                'lophoc' 		=>	$this->input->post('lophoc')
			);
		$this->admin_model->add_tbl('linkseo',$data,$id);
		// $this->sitemap();
		if($_SESSION['start_row']==0){redirect('admin/linkseo');}
		else{
			redirect('admin/linkseo/'.$_SESSION['start_row']);
		}
    }
	function edit_linkseo($id)
    {
		$this->checklogin();
        $data['id']=$id;
        $data['content']='frmlinkseo';
        $this->load->view('template',$data);
    }

	function del_linkseo()
	{
		//$this->checklogin();
//        $checkbox=$_POST['checkbox'];
//        $countcheck=count($checkbox);
//        if($countcheck!=0)
//        {
//            for($i=0;$i<$countcheck;$i++)
//            {
//                $del_id = $checkbox[$i];
//				$sql="SELECT image FROM baiviet WHERE id=".$del_id;
//				$query=$this->db->query($sql)->row();
//				if(file_exists('upload/news/'.$query->image)){
//					unlink('upload/news/'.$query->image);
//					unlink('upload/news/thumb/'.$query->image);
//				}
//				$result = $this->admin_model->del_tbl('baiviet',$del_id);
//			}
//			redirect('admin/baiviet/'.$_SESSION['start_row']);
//        }
//        else
//        {
//            echo 'Bạn phải chọn';
//			redirect('admin/baiviet');
//        }
	}

	//chuyen muc
	function chuyenmuc()
    {
		$this->load->helper('status');
		$this->checklogin();
		$this->checkrole();
        $start_row=$this->uri->segment(3);
            $per_page=15;
    		if(is_numeric($start_row))
    		{
    			$start_row=$start_row;
    		}
    		else
    		{
    			$start_row=0;
    		}
            $query=$this->admin_model->gettbl('chuyenmuc','');
    		$total_rows = $query->num_rows();
    		$this->load->library('pagination');
    		$config['base_url'] = site_url().'/admin/chuyenmuc/';
    		$config['total_rows'] = $total_rows;
    		$config['per_page'] = $per_page;
    		$config['uri_segment']=3;
    		$config['next_link'] = '>';
    		$config['prev_link'] = '<';
    		$config['num_links'] = 4;
    		$config['first_link'] = '<<';
    		$config['last_link'] = '>>';
    		$this->pagination->initialize($config);
    		$data['query']=$this->admin_model->gettbl_limited('chuyenmuc',$start_row,$per_page);
    		$data['pagination']= $this->pagination->create_links();
    		$data['content']='chuyenmuc';
    		$this->load->view('template',$data);
    }

	function frmchuyenmuc()
    {
		$this->checklogin();
		$this->checkrole();
        $data['content']='frmchuyenmuc';
        $this->load->view('template',$data);
    }

	function add_chuyenmuc()
    {
		$this->checklogin();
		$this->checkrole();
		$id = $this->input->post('id');
		$alias=$this->input->post('alias');
		if($alias=='')
		{
			$alias=vn_str_filter($this->input->post('name'));
		}
		//Xử lý ảnh
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
			//Xu ly crop anh
			$temp=explode('.',$filename);
			$image=$filename;
			$imageThumb = new Image($filedata);
			$thumb_path = $temp[0];
			$imageThumb->resize(270,270,'crop');
			$imageThumb->save($thumb_path, 'upload', $temp[1]);
		}

		$data=array(
				'name' 		=>	$this->input->post('name'),
				'alias'		=>	$alias,
				'image'		=>	$image,
				'parent'	=>  $this->input->post('parent'),
				'content'   =>  $this->input->post('content'),
				'menu' 		  	=>  $this->input->post('menu'),
				'sort'	  		=>  $this->input->post('sort'),
				'meta_title'  	=>  $this->input->post('meta_title'),
				'meta_key'   	=>  $this->input->post('meta_key'),
				'meta_des'   	=>  $this->input->post('meta_des'),
				'status'    =>  $this->input->post('status')
			);
		$this->admin_model->add_tbl('chuyenmuc',$data,$id);
		redirect('admin/chuyenmuc');
    }

	function edit_chuyenmuc($id)
    {
		$this->checklogin();
		$this->checkrole();
        $data['id']=$id;
        $data['content']='frmchuyenmuc';
        $this->load->view('template',$data);
    }

	function del_chuyenmuc()
	{
		$this->checklogin();
		$this->checkrole();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);
        if($countcheck!=0)
        {
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->del_tbl('chuyenmuc',$del_id);
			}
            if($result)
            {
                redirect('admin/chuyenmuc');
            }
        }
        else
        {
            echo 'Bạn phải chọn';
            redirect('admin/chuyenmuc');
        }
	}

	function tbladmin()
    {
		$this->checklogin();
		$this->checkrole();
		$this->load->helper('status');
		$start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$query=$this->admin_model->gettbl('tbl_admin','');
		$total_rows = $query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/tbladmin';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$this->admin_model->gettbl_limited('tbl_admin',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='tbladmin';
		$this->load->view('template',$data);
    }
	function frmadmin()
    {
		$this->checklogin();
		$this->checkrole();
        $data['content']='frmadmin';
        $this->load->view('template',$data);
    }
	function add_admin()
    {
		$this->checklogin();
		$this->checkrole();
		$id=$this->input->post('id');
		if($id=='' or md5($this->input->post('pass') != $this->admin_model->gettbl('tbl_admin',$id)->row()->pass)){
			$pass = md5($this->input->post('pass'));
		}
		else{
			$pass = $this->input->post('pass');
		}
		$data=array(
			'fullname'	=>	$this->input->post('fullname'),
			'name'		=>	$this->input->post('name'),
			'pass' 		=>	$pass,
			'role' 		=>	$this->input->post('role'),
			'status'    =>  $this->input->post('status')
		);
        $this->admin_model->add_tbl('tbl_admin',$data,$id);
        redirect('admin/tbladmin');
    }
	function edit_admin($id)
    {
		$this->checklogin();
		$this->checkrole();
        $data['id']=$id;
        $data['content']='frmadmin';
        $this->load->view('template',$data);
    }
    function del_admin()
	{
		$this->checklogin();
		$this->checkrole();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);
        if($countcheck!=0)
        {
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->del_tbl('tbl_admin',$del_id);
			}
            if($result)
            {
                redirect('admin/tbladmin');
            }
        }
        else
        {
            echo 'Bạn phải chọn';
            redirect('admin/tbladmin');
        }
	}
	function status()
	{
	   $this->checklogin();
	   $id=$_POST["id"];
	   $tblname=$_POST["tblname"];
	   $test = $this->admin_model->gettbl($tblname,$id)->row();
	   if($test->status==0){
			$this->admin_model->checkstatus($tblname,1,$id);
	   }
	   else{
			$this->admin_model->checkstatus($tblname,0,$id);
	   }
	}
    function statusck()
	{
	   $this->checklogin();
	   $id=$_POST["id"];
       $field=$_POST["field"];
       $fieldvl=$_POST["fieldvl"];
       $fieldid=$_POST["fieldid"];
	   $tblname=$_POST["tblname"];
	   //$test = $this->admin_model->gettblbyfield($tblname,$fieldid,$id)->row();

			$this->admin_model->checkstatusjob($tblname,$field,$fieldvl,$fieldid,$id);

	}
    function confirmnotifymoney()
	{
	   $this->checklogin();
	   $id=$_POST["id"];
       $field=$_POST["field"];
       $fieldvl=$_POST["fieldvl"];
       $fieldid=$_POST["fieldid"];
	   $tblname=$_POST["tblname"];
	   //$test = $this->admin_model->gettblbyfield($tblname,$fieldid,$id)->row();

			$this->admin_model->checkstatusjob($tblname,$field,$fieldvl,$fieldid,$id);

	}
	function add_footer()
    {
		$this->checklogin();
		$this->checkrole();
		$id = $this->input->post('id');

		$data=array(
				'name'  	=>  $this->input->post('name'),
				'diachi'  	=>  $this->input->post('diachi'),
				'email'  	=>  $this->input->post('email'),
				'content'  	=>  $this->input->post('content'),
				'content_thu'  	=>  $this->input->post('content_thu'),
				'face'  	=>  $this->input->post('face'),
				'google'  	=>  $this->input->post('google'),
				'yoube'  	=>  $this->input->post('yoube'),
				'meta_title'  	=>  $this->input->post('meta_title'),
			    'meta_key'  	=>  $this->input->post('meta_key'),
                'meta_des'  	=>  $this->input->post('meta_des'),
				'meta_footer'  	=>  $this->input->post('meta_footer'),
				'anatic'  	=>  $this->input->post('anatic'),
				'map'  		=>  $this->input->post('map'),
                'meta_estimate'  		=>  $this->input->post('meta_estimate'),
                'meta_descestimate'  		=>  $this->input->post('meta_descestimate'),
                'meta_titleestimate'  		=>  $this->input->post('meta_titleestimate'),
                'estimateh1'=>$this->input->post('estimateh1'),
				'status'    =>  $this->input->post('status')
			);
		$this->admin_model->add_tbl('tbl_footer',$data,$id);
		redirect('admin');
    }

	function login()
    {
        $this->load->view('login_view');
    }
    function dologin()
    {
        if($this->admin_model->getlogin($this->input->post('name'),$this->input->post('pass'))==TRUE)
        {
           $_SESSION['name_admin']=$this->input->post('name');
           redirect('admin');
        }
        else
        {
            redirect('admin/login');
        }
    }
    function thoat()
    {
        if(isset($_SESSION['name_admin']))
        {
            unset($_SESSION['name_admin']);
        }
        redirect('admin/login');
    }
    function checklogin()
    {

        if(isset($_SESSION['name_admin']))
        {

        }
        else
        {
            redirect('admin/login');
        }
    }
	function checkrole()
    {
        if(isset($_SESSION['name_admin']))
        {
			$this->db->where('status',1);
			$this->db->where('name',$_SESSION['name_admin']);
			$admin=$this->db->get('tbl_admin')->row();
			if($admin->role==2){
				redirect('admin');
			}
        }
    }

	/////////////////////
	// function sitemap()
	// {
	// 	$doc = new DOMDocument("1.0","utf-8");
	// 	$doc->formatOutput = true;
	// 	$r = $doc->createElement("urlset");
	// 	$r->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");
	// 	$doc->appendChild( $r );
	// 	$url = $doc->createElement("url" );
	// 	$name = $doc->createElement("loc" );
	// 	$name->appendChild(
	// 	$doc->createTextNode('https://timviec365.vn/cv365/')
	// 	);
	// 	$url->appendChild($name);
	// 	$changefreq = $doc->createElement( "changefreq" );
	// 	$changefreq->appendChild(
	// 		$doc->createTextNode('daily')
	// 	);
	// 	   $url->appendChild($changefreq);
	// 	$priority = $doc->createElement( "priority" );
	// 	$priority->appendChild(
	// 	$doc->createTextNode('1.00')
	// 	);
	// 	$url->appendChild($priority);
	// 	$r->appendChild($url);

	// 	$this->db->where('status',1);
	// 	$this->db->order_by("id", "desc");
	// 	$this->db->limit(200);
	// 	$cate=$this->db->get('baiviet');
	// 	if($cate->num_rows()>0)
	// 	{
	// 		foreach($cate->result() as $row)
	// 	{
	// 	$url = $doc->createElement( "url" );

	// 	$name = $doc->createElement( "loc" );
	// 	$name->appendChild(
	// 	 $doc->createTextNode(site_url($row->alias.'-b'.$row->id).'.html')
	// 	);
	// 	$url->appendChild($name);

	// 	$changefreq = $doc->createElement( "changefreq" );
	// 	$changefreq->appendChild(
	// 	 $doc->createTextNode('daily')
	// 	);
	// 	$url->appendChild($changefreq);

	// 	$priority = $doc->createElement( "priority" );
	// 	$priority->appendChild(
	// 	 $doc->createTextNode('1.00')
	// 	);
	// 		$url->appendChild($priority);

	// 		$r->appendChild($url);
	// 	}
	// 	}
	// 	$doc->save("sitemap.xml");
	// }

    // danh sách lớp
    function lophoc()
    {
         $this->checkrole();
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category']) or isset($_POST['city'])){
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);
			unset($_SESSION['city']);
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];
		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= '';
			$_SESSION['city'] = '';
		}
        $data['monhoc']=$this->admin_model->ListSubject();
        $query=$this->admin_model->GetAllClass($_SESSION['findkey'],$_SESSION['category'],$_SESSION['city'],$start_row,$per_page);
		$total_rows =$query['total'] ;//$query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/lophoc';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='lophoc';
		$this->load->view('template',$data);
    }
    function edit_lophoc($id)
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontent('');
        $data['id']=$id;
        $data['content']='frmlophoc';
        $this->load->view('template',$data);
    }
    function add_lophoc()
    {
		$this->checklogin();
        $id=$this->input->post('id');
        $MetaDesc=trim($this->input->post('MetaDesc'));
        $MetaTitle=$this->input->post('MetaTitle');
        $MetaKeywork=$this->input->post('MetaKeywork');
        //var_dump($_POST);die();
		$data=array(
				'MetaDesc' 	=>	$MetaDesc	,
                'MetaTitle'=>$MetaTitle	,
                'MetaKeywork'=>$MetaKeywork
			);

		//$this->admin_model->UpdateorAddtbl('`user`',$data1,'use_id',$id);
        $this->admin_model->UpdateorAddtbl('teacherclassmeta',$data,'ClassID',$id);
		//$this->sitemap();
		if($_SESSION['start_row']==0){redirect('admin/lophoc');}
		else{
			redirect('admin/lophoc/'.$_SESSION['start_row']);
		}
    }
    function del_lophoc()
	{
		$this->checklogin();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);
        if($countcheck!=0)
        {
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->delrowtbl('`user`','use_id',$del_id);
                $result = $this->admin_model->delrowtbl('cv','cv_user_id',$del_id);
			}
			redirect('admin/ungvien/'.$_SESSION['start_row']);
        }
        else
        {
            echo 'Bạn phải chọn';
			redirect('admin/ungvien');
        }
	}
	function jobmanager()
    {
         $this->checkrole();
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category']) OR isset($_POST['city']) OR isset($_POST['hot'])OR isset($_POST['do'])OR isset($_POST['gap'])OR isset($_POST['cao']) or isset($_POST['parttime'])){
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);
			unset($_SESSION['city']);
			unset($_SESSION['tinhot']);
            unset($_SESSION['tindo']);
            unset($_SESSION['tingap']);
            unset($_SESSION['tincao']);
            unset($_SESSION['parttime']);
            $_SESSION['parttime']=$_POST['parttime'];
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];
			$_SESSION['tinhot'] = $_POST['hot'];
            $_SESSION['tindo']=$_POST['do'];
            $_SESSION['tingap']=$_POST['gap'];
            $_SESSION['tincao']=$_POST['cao'];
		}
		else{
		  $_SESSION['parttime']='';
			$_SESSION['findkey'] = '';
			$_SESSION['category']= 0;
			$_SESSION['city'] = 0;
			$_SESSION['tinhot'] = 0;
            $_SESSION['tindo']=0;
            $_SESSION['tingap']=0;
            $_SESSION['tincao']=0;
		}
        $query=$this->admin_model->Getalljobbypage($_SESSION['findkey'],$_SESSION['category'],$_SESSION['city'],$_SESSION['tinhot'],$_SESSION['tindo'],$_SESSION['tingap'],$_SESSION['tincao'],$_SESSION['parttime'],$start_row,$per_page);
		$total_rows =$query['total'] ;//$query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/jobmanager';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='jobmanager';
		$this->load->view('template',$data);
    }
    //function frmjobmanager()
//    {
//		$this->checklogin();
//        $data['listdefault']=$this->admin_model->Getlistcontent('');
//        $data['content']='frmjobmanager';
//        $this->load->view('template',$data);
//    }
    function edit_jobmanager($id)
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontent('');
        $data['id']=$id;
        $data['content']='frmjobmanager';
        $this->load->view('template',$data);
    }
    function add_jobmanager()
    {
		$this->checklogin();
        $id=$this->input->post('id');
        $title=trim($this->input->post('new_title'));
        $mota=$this->input->post('new_mota');
        $quyenloi=$this->input->post('new_quyenloi');
        $yccongviec=$this->input->post('new_yeucau');
        $ychoso=$this->input->post('new_ho_so');
		$data=array(
				'new_title' 	=>	$title
			);
        $data1=array(
				'new_mota' 	=>	$mota,
                'new_yeucau' 	=>	$yccongviec,
                'new_quyenloi' 	=>	$quyenloi,
                'new_ho_so' 	=>	$ychoso
			);
		$this->admin_model->UpdateorAddtbl('new',$data,'new_id',$id);
        $this->admin_model->UpdateorAddtbl('new_multi',$data1,'new_id',$id);
		//$this->sitemap();
		if($_SESSION['start_row']==0){redirect('admin/jobmanager');}
		else{
			redirect('admin/jobmanager/'.$_SESSION['start_row']);
		}
    }
    function del_jobmanager()
	{
		$this->checklogin();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);
        if($countcheck!=0)
        {
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->delrowtbl('new','new_id',$del_id);
                $result = $this->admin_model->delrowtbl('new_multi','new_id',$del_id);
			}
			redirect('admin/jobmanager/'.$_SESSION['start_row']);
        }
        else
        {
            echo 'Bạn phải chọn';
			redirect('admin/jobmanager');
        }
	}
    // môn học
    function monhoc()
    {
         $this->checkrole();
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey'])){
			unset($_SESSION['findkey']);
			$_SESSION['findkey'] = $_POST['findkey'];
		}
		else{
			$_SESSION['findkey'] = '';
		}
        $query=$this->admin_model->Getallsubject($_SESSION['findkey'],$start_row,$per_page);
		$total_rows =$query['total'] ;//$query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/monhoc';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='monhoc';
		$this->load->view('template',$data);
    }
    function frmmonhoc()
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getallsubjecttype();
        $data['content']='frmmonhoc';
        $this->load->view('template',$data);
    }
		function edit_monhoc($id)
    {
		$this->checklogin();
		$lophoc=$this->db->get('lophoc')->result();
				$data['lophoc']=$lophoc;
        $data['listdefault']=$this->admin_model->Getallsubjecttype();
        $data['id']=$id;
        $data['content']='frmmonhoc';
        $this->load->view('template',$data);
    }
		function add_monhoc()
    {
		$this->checklogin();
				$lophoc=implode(',',$_POST['lophoc']);
				// print_r($lophoc);
        $id=$this->input->post('id');
        $CreateDate=date("Y-m-d H:i:s",time());
        $title=trim($this->input->post('SubjectName'));
        $mota=$this->input->post('SubjectType');

		$data=array(
				'SubjectName' 	=>	$title,
                'SubjectType' 	=>	$mota,
                'CreateDate'=>	$CreateDate,
								'areaclass'=>$lophoc
			);

		$this->admin_model->UpdateorAddtbl('subject',$data,'ID',$id);
		//$this->sitemap();
		if($_SESSION['start_row']==0){redirect('admin/monhoc');}
		else{
			redirect('admin/monhoc/'.$_SESSION['start_row']);
		}
    }
    function del_monhoc()
	{
		$this->checklogin();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);
        if($countcheck!=0)
        {
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->delrowtbl('subject','ID',$del_id);
			}
			redirect('admin/monhoc/'.$_SESSION['start_row']);
        }
        else
        {
            echo 'Bạn phải chọn';
			redirect('admin/monhoc');
        }
	}
    // chủ đề môn hoc
    function chudemonhoc()
    {
         $this->checkrole();
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey'])){
			unset($_SESSION['findkey']);
			$_SESSION['findkey'] = $_POST['findkey'];
		}
		else{
			$_SESSION['findkey'] = '';
		}
        $query=$this->admin_model->Getalltopic($_SESSION['findkey'],$start_row,$per_page);
		$total_rows =$query['total'] ;//$query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/chudemonhoc';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='chudemonhoc';
		$this->load->view('template',$data);
    }
    function frmchudemonhoc()
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->ListSubject();
        $data['content']='frmchudemonhoc';
        $this->load->view('template',$data);
    }
		function edit_chudemonhoc($id)
    {
		$this->checklogin();
		$lophoc=$this->db->get('lophoc')->result();
				$data['lophoc']=$lophoc;
        $data['listdefault']=$this->admin_model->ListSubject();
        $data['id']=$id;
        $data['content']='frmchudemonhoc';
        $this->load->view('template',$data);
    }
		function add_chudemonhoc()
    {
			$this->checklogin();
				$lophoc=implode(',',$_POST['lophoc']);
        $id=$this->input->post('id');
        $CreateDate=date("Y-m-d H:i:s",time());
        $title=trim($this->input->post('NameTopic'));
        $mota=$this->input->post('SubjectID');

			$data=array(
					'NameTopic' 	=>	$title,
	                'SubjectID' 	=>	$mota,
	                'CreateDate'=>	$CreateDate,
	                'CreateBy'=>1,
	                'ParentTopic'=>0,
									'idlophoc'=>$lophoc
				);

			$this->admin_model->UpdateorAddtbl('topic',$data,'ID',$id);
			if($_SESSION['start_row']==0){redirect('admin/chudemonhoc');}
			else{
				redirect('admin/chudemonhoc/'.$_SESSION['start_row']);
			}
  	}
    function del_chudemonhoc()
	{
		$this->checklogin();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);
        if($countcheck!=0)
        {
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->delrowtbl('topic','ID',$del_id);
			}
			redirect('admin/chudemonhoc/'.$_SESSION['start_row']);
        }
        else
        {
            echo 'Bạn phải chọn';
			redirect('admin/chudemonhoc');
        }
	}
    // duyệt cộng tiền
    function duyettien()
    {
         $this->checkrole();
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey'])){
			unset($_SESSION['findkey']);
			$_SESSION['findkey'] = $_POST['findkey'];
		}
		else{
			$_SESSION['findkey'] = '';
		}
        $query=$this->admin_model->Getallsendnotifymoney($_SESSION['findkey'],$start_row,$per_page);
		$total_rows =$query['total'] ;//$query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/duyettien';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='duyettien';
		$this->load->view('template',$data);
    }

		function edit_SEO($id,$mess=''){
			$this->checklogin();
			$this->checkrole();
				$data['id']=$id;
				$data['content']='frmSEO';
				$data['mess']=$mess;
				$this->load->view('template',$data);
		}
		function add_SEO(){
			$this->checklogin();
			$this->checkrole();
			$id = $this->input->post('id');
			// var_dump($id);
			// die();
			$data=array(
					'meta_title'  		=>  $this->input->post('title'),
					'meta_des'			=>	$this->input->post('metadesc'),
					'meta_key'  		=>  $this->input->post('metakeywork'),
					'content_thu' => $this->input->post('content')
				);
			$mess='';
			$save=$this->admin_model->add_tbl('tbl_footer',$data,$id);
			if($save==1){
				$mess='Lưu thành công';
			}else{
				$mess='Lưu thất bại';
			}
			$url=site_url().'/admin/edit_SEO/'.$id.'/'.$mess;
			redirect($url);
		}
		//duyet mua diem
		function duyetdiem()
		    {
		         $this->checkrole();
				$this->load->helper('status');
		        $start_row=$this->uri->segment(3);
				$per_page=15;
				if(is_numeric($start_row))
				{
					$start_row=$start_row;
				}
				else
				{
					$start_row=0;
				}
		        if(isset($_POST['findkey'])){
					unset($_SESSION['findkey']);
					$_SESSION['findkey'] = $_POST['findkey'];
				}
				else{
					$_SESSION['findkey'] = '';
				}
		        $query=$this->admin_model->GetallLogBuyPoint($_SESSION['findkey'],$start_row,$per_page);
				$total_rows =$query['total'] ;//$query->num_rows();
				$this->load->library('pagination');
				$config['base_url'] = site_url().'/admin/duyetdiem';
				$config['total_rows'] = $total_rows;
				$config['per_page'] = $per_page;
				$config['uri_segment'] =3;
				$config['next_link'] = '>';
				$config['prev_link'] = '<';
				$config['num_links'] = 4;
				$config['first_link'] = '<<';
				$config['last_link'] = '>>';
				$this->pagination->initialize($config);
				$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);
				$data['pagination']= $this->pagination->create_links();
				$data['content']='duyetdiem';
				$this->load->view('template',$data);
		    }
		    function tieudung()
		    {
		         $this->checkrole();
				$this->load->helper('status');
		        $data['tieudungdiem']=$this->admin_model->gettieudungdiem();
		        $data['tieudungtien']=$this->admin_model->gettieudungtien();
				$data['content']='tieudung';
				$this->load->view('template',$data);
		    }
				function thongkediem(){

			$this->checklogin();
			$this->load->helper('status');

			$CreateDate=date("Y-m-d",time());
            $denngay=date("Y-m-d",time());
$denngay=$denngay." 23:59:59";

					if(!empty($_POST['date'])){
						$CreateDate=$_POST['date'];
                        $tungay=explode('-',$CreateDate);
                        $CreateDate=date("Y-m-d H:i:s",strtotime($tungay[2]."-".$tungay[1]."-".$tungay[0]));
					}
                    if(!empty($_POST['todate'])){
						$denngay=$_POST['todate'];
                        $denngay1=explode('-',$denngay);
                        $denngay=date("Y-m-d H:i:s",strtotime($denngay1[2]."-".$denngay1[1]."-".$denngay1[0]." 23:59:59" ));
					}


			//bắt đầu phân trang.
	    $start_row=$this->uri->segment(3);
	    $per_page=20;
			if(is_numeric($start_row)){
				$_SESSION['start_row']=$start_row;
			}
			else
			{
				$_SESSION['start_row']=0;
			}
			$query=$this->admin_model->getthongkediem($CreateDate,$denngay);

			//kết thúc phân trang.
			$data['query']=$query;//$this->admin_model->gettblsmslog($Code,$Type,$StatusCode,$CreateDate,$iscall,$_SESSION['start_row'],$per_page);
			$data['content']='thongkediem';
			// $data['data']= $this->db->get('smslog');
			$this->load->view('template',$data);
		}
		function editlogpoint($id)
		    {
				$this->checklogin();
				$this->checkrole();
		        $data['id']=$id;
		        $data['content']='frmlogpoint';
		        $this->load->view('template',$data);
		    }
		    function addlogpoint()
		    {
		        $this->checklogin();
				$this->checkrole();
				$id = $this->input->post('ID');
				$data=array(
						'PointPerDay'  		=>  $this->input->post('PointPerDay'),
						'PointSub'			=>	$this->input->post('PointSub'),
						'PointPlus'  		=>  $this->input->post('PointPlus'),
		                'MoneyPerPoint'=>$this->input->post('MoneyPerPoint')
					);
				$this->admin_model->add_tbl('configpoint',$data,$id);
				redirect('admin/');
		    }
		function managecodeSMS(){

			$this->checklogin();
			$this->load->helper('status');
			$Code='';
			$Type='';
			$StatusCode='';
            $iscall='';
			$CreateDate=date("Y-m-d",time());
            $denngay=date("Y-m-d",time());
$denngay=$denngay." 23:59:59";
					if(!empty($_POST['txt_search'])){
						$Code=$_POST['txt_search'];
					}
					if(!empty($_POST['typecode'])){
						$Type=$_POST['typecode'];
					}
					if(!empty($_POST['status'])){
						$StatusCode=$_POST['status'];
					}
					if(!empty($_POST['date'])){
						$CreateDate=$_POST['date'];
                        $tungay=explode('-',$CreateDate);
                        $CreateDate=date("Y-m-d H:i:s",strtotime($tungay[2]."-".$tungay[1]."-".$tungay[0]));
					}
                    if(!empty($_POST['todate'])){
						$denngay=$_POST['todate'];
                        $denngay1=explode('-',$denngay);
                        $denngay=date("Y-m-d H:i:s",strtotime($denngay1[2]."-".$denngay1[1]."-".$denngay1[0]." 23:59:59" ));
					}
                    if($_POST['iscall']!=''){
						$iscall=$_POST['iscall'];
					}

			//bắt đầu phân trang.
	    $start_row=$this->uri->segment(3);
	    $per_page=20;
			if(is_numeric($start_row)){
				$_SESSION['start_row']=$start_row;
			}
			else
			{
				$_SESSION['start_row']=0;
			}
			$query=$this->admin_model->gettblsmslog($Code,$Type,$StatusCode,$CreateDate,$denngay,$iscall,$_SESSION['start_row'],$per_page);
			$total_rows = $query['total'];
			$this->load->library('pagination');
			$config['base_url'] = site_url().'/admin/managecodeSMS';
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $per_page;
			$config['uri_segment'] =3;
			$config['next_link'] = '>';
			$config['prev_link'] = '<';
			$config['num_links'] = 4;
			$config['first_link'] = '<<';
			$config['last_link'] = '>>';

			$this->pagination->initialize($config);
			$data['pagination']= $this->pagination->create_links();
			//kết thúc phân trang.
			$data['query']=$query['data'];//$this->admin_model->gettblsmslog($Code,$Type,$StatusCode,$CreateDate,$iscall,$_SESSION['start_row'],$per_page);
			$data['content']='managecodeSMS';
			// $data['data']= $this->db->get('smslog');
			$this->load->view('template',$data);
		}

}
?>
