<?php class MY_Exceptions extends CI_Exceptions{
	function MY_Exceptions(){
		parent::CI_Exceptions();
	}
	function show_404($page=''){
		$this->config =& get_config();
		// $url1 = $this->config['base_url']; // could redirect to known controller - or redirect to home page
		// $urlerror=$url1.'site/page404';
		$urlerror = "http://localhost/ubuntu/giasu123/site/page404";
		header("HTTP/1.1 301 Moved Permanently");
		header("location: ".$urlerror); exit;
	}
}
?>
