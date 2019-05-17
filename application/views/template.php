<?php
        ob_start("ob_gzhandler");
        //ob_start("ob_html_compress1");
        header("Content-Type: text/html; charset=utf-8");
        $version=1;

      ?>
<!DOCTYPE HTML>
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <!-- Hotjar Tracking Code for https://vieclam123.vn/ -->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- <meta charset="utf-8"/> -->
    <meta name="language" content="vietnamese"/>
    <meta property="og:locale" content="vi_VN"/>
	<?php header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 600));
	//header('Cache-Control: max-age=300, public');

	?>
    <meta name="google-site-verification" content="PuA4RXn1IGZbiglCjRvzLUPAKPYw6amIu79SJHmavlQ" />
    <meta name="theme-color" content="#13b5ea"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no , maximum-scale=1"/>
	<meta name="language" content="vn"/>
	<meta name="keywords" content="<?php if(isset($meta_key)){echo $meta_key;} ?>"/>
	<meta name="description" content="<?php if(isset($meta_des)){echo $meta_des;} ?>"/>
  <meta property="og:url" content="<?php echo $canonical; ?>">
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?php if(isset($meta)){echo $meta;} ?>" />
  <meta property="og:description" content="<?php if(isset($meta_des)){echo $meta_des;} ?>" />
  <meta property="og:image:secure_url" content="<?php $image=!empty($imageog)?$imageog:'https://vieclam123.vn/images/no-image2.png';echo $image;?> " />
  <meta property="og:image" content="<?php $image=!empty($imageog)?$imageog:'https://vieclam123.vn/images/no-image2.png';echo $image;?> " />
  <!-- <meta property="og:image:width" content="600" />
  <meta property="og:image:height" content="400" /> -->
  <?php if($content=='detailteacher'){
    ?>
    <meta property="og:image:width" content="180" />
    <meta property="og:image:height" content="180" />
    <?php
  }
    ?>	<link rel="canonical" href="<?php echo $canonical; ?>"/>
	<meta name="revisit-after" content="1 days" />
	<meta name="robots" content="<?php if(isset($start_row) and $start_row>0){echo 'noindex,follow';}else{echo $robots;}?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php// if(isset($start_row) and $start_row>0){echo 'noindex,follow';}else{echo $robots;}?>
	<base href="<?php echo base_url(); ?>" />
	<title><?php if(isset($meta_title)){ ?><?php echo $meta_title; }?></title>
    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet"  type="text/css" href="<?php echo base_url() ?>combine.php?type=css&files=plugins.css,style1.css,green-style.css,responsive.css&v=<?=$version;?>" />
    <!-- <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:1296315,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script> -->
    <!-- <script type="text/javascript" src="socket.io.js"></script> -->
    <script src="<?php echo base_url() ?>combine.php?type=javascript&files=jquery.min.js,bootstrap.min.js,bootsnav.js,select2.min.js&v=<?=$version;?>"  type="text/javascript"></script>
    <?php if($content=='forusers'){?>
      <!-- <script type="application/ld+json">{
	"@context": "http://schema.org",
  	"@type": "TutoringService",
"@id":"https://vieclam123.vn/tim-gia-su",
	"url": "https://vieclam123.vn/tim-gia-su",
	"logo": "https://vieclam123.vn/images/no-image2.png",
    "image":"https://vieclam123.vn/images/no-image2.png",
    "priceRange":"0VND",
	"hasMap": "https://www.google.com/maps/place/Vieclam123.vn/@20.9894944,105.8292627,17z/data=!3m1!4b1!4m5!3m4!1s0x0:0x53935453bd291270!8m2!3d20.9894944!4d105.8314514",
	"email": "mailto:jobthanhxuan@gmail.com			",
    "founder": "Lê Hồng Hạnh",
  	"address": {
    	"@type": "PostalAddress",
    	"addressLocality": "Hoàng Mai",
        "addressCountry": "VIỆT NAM",
    	"addressRegion": "Hà Nội",
    	"postalCode":"100000",
    	"streetAddress": "Tầng 5, B50, Khu đô thị Định Công, Hoàng Mai, Hà Nội"
  	},
  	"description": "Vieclam123 - Trang kết nối hiệu quả gia sư với phụ huynh cả nước, giúp tìm kiếm gia sư và lớp mới cần dạy kèm không qua trung gian, miễn phí",
	"name": "Việc làm 123",
  	"telephone": "0869154226",
  	"openingHoursSpecification": [
  {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday"
    ],
    "opens": "08:00",
    "closes": "17:00"
  }
],
  	"geo": {
    	"@type": "GeoCoordinates",
		"latitude": "20.9894944",
    	"longitude": "105.8292627"
 		},
         "potentialAction": {
    "@type": "ReserveAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "https://vieclam123.vn/dang-ky-chung",
      "inLanguage": "vn",
      "actionPlatform": [
        "http://schema.org/DesktopWebPlatform",
        "http://schema.org/IOSPlatform",
        "http://schema.org/AndroidPlatform"
      ]
    },
    "result": {
      "@type": "Reservation",
      "name": "Đăng kí"
    }
  },

  	"sameAs" : [ "https://www.facebook.com/ViecLam123Vietnam/",
    	"https://twitter.com/vieclam123",
		"https://www.instagram.com/vieclam123vn/",
		"https://www.linkedin.com/in/vieclam123/",
		"https://www.pinterest.com/ViecLam123/",
        "https://vieclam123.tumblr.com/"]
	}</script>
	<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "Person",
  "name": "Lê Hồng Hạnh",
  "jobTitle": "Founder",
  "image" : "https://vieclam123.vn/images/image_gril.jpg",
   "worksFor" : "Việc làm 123",
  "url": "https://vieclam123.vn/tim-gia-su",
"sameAs":["https://www.linkedin.com/in/lehonghanh91/",
"https://www.facebook.com/lehonghanh1991",
"https://www.instagram.com/lehonghanh1991/",
"https://vi.gravatar.com/lehonghanh91",
"https://www.pinterest.com/lehonghanh1991/",
"https://twitter.com/lehonghanh1991" ],
"AlumniOf" : [ "Trường Đại học Khoa học Xã Hội Và Nhân Văn (Đại Học Quốc Gia HN)" ],
"address": {
  "@type": "PostalAddress",
    "addressLocality": "Hanoi",
    "addressRegion": "Vietnam"
	 }}</script> -->
<?php  } ?>
</head>
<body class="<?php echo $cssbody ?>">
 <div class="wrapper">
 <?php
 $data['content']=$content;
  ?>
 <div class="wrapper">
    <?php $this->load->view('header'); ?>
    <?php $this->load->view($content); ?>
    <?php $this->load->view('footer',$data); ?>
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

</body>
</html>
<?php
        //ob_end_flush();
        ob_end_flush();
      ?>
