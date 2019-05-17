<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">	
	<title>Administrator</title>
	<base href="<?php echo base_url(); ?>" />
	<link href="#" rel="shortcut icon">
	<link rel="stylesheet" href="css/admin.css" type="text/css">
	<link href="css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>	
    <script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
	<script type="text/javascript" src="js/admin.js"></script>
</head>
<body>
	<div id="header">
		<?php $this->load->view('includes/header'); ?>
	</div>
	<div id="mainmenu">
		<?php $this->load->view('includes/mainmenu'); ?>
	</div>
	<div id="main" class="container">		
		<table width="100%">
			<tr>
			<?php if(!isset($hide)){ ?>
				<td valign="top" id="left" width="230">
					<?php $this->load->view('includes/left'); ?>
					<div class="clr"></div>
				</td>
				<?php } ?>
				<td valign="top" id="content">	
					<div class="content-inner">				
						<?php $this->load->view($content); ?>			
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="clr"></div>
	<div id="footer">
		<?php $this->load->view('includes/footer'); ?>
	</div>
</body>