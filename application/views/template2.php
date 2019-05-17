<?php
        ob_start("ob_gzhandler");
        //ob_start("ob_html_compress1");
      ?>
<!DOCTYPE HTML>
<html lang="vi">
<head>	
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta name="google-site-verification" content="sHB_kIyLvpmytXDQtZiGe9daQFRc-ZRMsYPi6_oPQVc" />
    <meta charset="UTF-8"/>    
	<?php header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 600)); 
	//header('Cache-Control: max-age=300, public');
	
	?>
    <meta name="theme-color" content="#13b5ea"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no , maximum-scale=1"/>
	<meta name="language" content="vn"/>
	<meta name="keywords" content="<?php if(isset($meta_key)){echo $meta_key;} ?>"/>
	<meta name="description" content="<?php if(isset($meta_des)){echo $meta_des;} ?>"/>	
	<link rel="canonical" href="<?php echo $canonical; ?>"/>
	<meta name="revisit-after" content="1 days" />	
	<meta name="robots" content="noindex,nofollow" />
    <?php// if(isset($start_row) and $start_row>0){echo 'noindex,follow';}else{echo $robots;}?>
	<base href="<?php echo base_url(); ?>" />	
	<title><?php if(isset($meta_title)){ ?><?php echo $meta_title; }?></title>	
    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />	
    <link rel="stylesheet" onload="onload=null;title='';rel='stylesheet'" type="text/css" href="<?php echo base_url() ?>combine.php?type=css&files=plugins.css,style1.css,green-style.css" />   		
    <script src="<?php echo base_url() ?>combine.php?type=javascript&files=jquery.min.js,bootstrap.min.js,bootsnav.js,select2.min.js"  type="text/javascript"></script>			
</head>
<body class="<?php echo $cssbody ?>">
 <div class="wrapper">
 <!--<div class="Loader" >
 <div class="fl spinner2" style="position: absolute; left: 771.5px; top: 286.5px;">
    <div class="spinner-container container1">
        <div class="circle1">
        </div>
        <div class="circle2">
        </div>
        <div class="circle3">
        </div>
        <div class="circle4">
        </div>
    </div>
    <div class="spinner-container container2">
        <div class="circle1">
        </div>
        <div class="circle2">
        </div>
        <div class="circle3">
        </div>
        <div class="circle4">
        </div>
    </div>
    <div class="spinner-container container3">
        <div class="circle1">
        </div>
        <div class="circle2">
        </div>
        <div class="circle3">
        </div>
        <div class="circle4">
        </div>
    </div>
    </div>
 </div>-->
 <div class="wrapper">
    <?php $this->load->view('header'); ?>
    <?php $this->load->view($content); ?>
    <?php $this->load->view('footer'); ?>
 </div>
</div>
   <!--<script type="text/javascript" src="js/theme6/custom.js"></script>-->
   <?php// if(intval(initLayoutType())==1){ ?>
   <script type="text/javascript" src="javascript/lazysizes.min.js"></script>
   <script>
		(function(){
			var docElem = document.documentElement;
			window.lazySizesConfig = window.lazySizesConfig || {};
			window.lazySizesConfig.loadMode = 1;
			
			window.lazySizesConfig.expand = Math.max(Math.min(docElem.clientWidth, docElem.clientHeight, 1222) - 1, 359);
			window.lazySizesConfig.expFactor = lazySizesConfig.expand < 380 ? 3 : 2;
		})();
	</script>
   <?php// } ?>
   <script src="<?php echo base_url() ?>combine.php?type=javascript&files=custom.js"  type="text/javascript"></script>	
   <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-133696163-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-133696163-1');
</script>
</body>
</html>
<?php
        //ob_end_flush();
        ob_end_flush();
      ?>