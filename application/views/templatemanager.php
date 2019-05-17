<?php
        ob_start("ob_gzhandler");
        //ob_start("ob_html_compress1");
      ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">

	<?php header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 600));
	//header('Cache-Control: max-age=300, public');

	?>
    <meta name="theme-color" content="#13b5ea"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no , maximum-scale=1.0"/>
    <meta name="google-site-verification" content="PuA4RXn1IGZbiglCjRvzLUPAKPYw6amIu79SJHmavlQ" />
	<meta name="language" content="vn"/>
	<meta name="keywords" content="<?php if(isset($meta_key)){echo $meta_key;} ?>"/>
	<meta name="description" content="<?php if(isset($meta_des)){echo $meta_des;} ?>"/>
	<link rel="canonical" href="<?php echo $canonical; ?>"/>
	<meta name="revisit-after" content="1 days" />
	<meta name="robots" content="noindex,nofollow" />
	<base href="<?php echo base_url(); ?>" />
	<title><?php if(isset($meta_title)){ ?><?php echo $meta_title; }?></title>
    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/theme6/plugins.css" media="all">
    <link href="css/theme6/stylemanager.css" rel="stylesheet" media="all">
	<link type="text/css" rel="stylesheet" id="jssDefault" href="css/theme6/green-style.css" media="all">
  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="ckfinder/ckfinder.js"></script> 
  <script type="text/javascript" src="js/theme6/jquery.min.js"></script>
	<script type="text/javascript" src="js/theme6/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/theme6/bootsnav.js"></script>
	<script type="text/javascript" src="js/theme6/select2.min.js"></script>
	<!--<script type="text/javascript" src="js/theme6/loader.js"></script>-->
	<script type="text/javascript" src="js/theme6/slick.min.js"></script>
</head>
<body class="<?php echo $cssbody ?>">
 <div class="wrapper">
 <div class="Loader" >
    <div class="fl spinner2" style="position: absolute; left: 771.5px; top: 286.5px;">
    
    </div>
 </div>
 <div class="wrapper">
	<?php
	if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
	   $arruser=$_SESSION['UserInfo'];
       ?>
        <?php if($arruser['Type'] == 0){ ?>
            <?php $this->load->view('headeruser'); ?>
        <?php }else if($arruser['Type'] == 1){ ?>
            <?php $this->load->view('headergiasu'); ?>
        <?php }else if($arruser['Type'] == 3){ ?>
            <?php $this->load->view('headercandi'); ?>
		<?php }else{ ?>
            <?php $this->load->view('headercompany'); ?>
        <?php } ?>
		<?php $this->load->view($content); ?>
        <?php $this->load->view('footermanager'); ?>
	<?php }else{ ?>
	   <div class="container">
            <h3 class="title">Trang quản lý dành cho giáo viên, phụ huynh. Bạn phải đăng nhập để sử dụng</h3>
       </div>
	<?php } ?>






 </div>
</div>

   <script type="text/javascript" src="javascript/custom.js"></script>
   <script>
   $(document).ready(function(){
   $('[data-toggle="tooltip"]').tooltip();
});
   </script>
   <!-- Global site tag (gtag.js) - Google Analytics -->

</body>
</html>
<?php
        //ob_end_flush();
        ob_end_flush();
      ?>
