<meta http-equiv="content-type" content="text/html; charset=UTF-8">	
<title>Form đăng nhập hệ thống v1.0</title>
<base href="<?php echo base_url(); ?>" />
<link href="#" rel="shortcut icon">
<link rel="stylesheet" href="css/admin.css" type="text/css">
<body class="metro">	
	<div class="page-login">	
		<img src="images/logo-r.jpg">
		<form name="frmlogin" action="<?php echo site_url('admin/dologin'); ?>" method="post">
		<table>
			<tr>
			   <td><label>Tài đăng nhập</label><input type="text" name="name" value="" /></td> 
			</tr>
			<tr>
				<td><label>Mật khẩu</label>
					<input type="password" name="pass" value="" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="submit" value="Đăng nhập" />
				</td>
			</tr>
		</table>
		</form>
	</div>
</body>