<div id="mn-pc">
	<ul class="lelf">
		<li<?php if(isset($home)){echo ' class="active"';} ?>><a href="<?php echo site_url(); ?>">Về CV365</a></li>
		<li<?php if($content=='danhmuc_cv'){echo ' class="active"';} ?>><a href="<?php echo site_url('mau-cv-xin-viec-online'); ?>">Mẫu CV</a></li>
		<li<?php if($content=='mau_thu'){echo ' class="active"';} ?>><a href="<?php echo site_url('mau-cover-letter-thu-xin-viec'); ?>">Mẫu thư</a></li>
	</ul>
	<a id="back_link" href="http://timviec365.vn"><i class="img load"></i>Quay lại Timviec365.vn</a>
	<ul class="right">
		<?php $dmcv = $this->db->query('SELECT id,alias,name FROM tbl_danhmuc_cv WHERE menu=1 ORDER BY sort DESC'); 
		foreach ($dmcv->result() as $dm) { ?>
			<li <?php if(isset($ccv_id) and $ccv_id==$dm->id){echo 'class="active"'; } ?>><a href="<?php echo site_url('mau-cv-'.$dm->alias.'.html'); ?>"><?php echo 'CV '.$dm->name; ?></a></li>
		<?php } ?>	
		<li id="show_more_dm"><i class="fa fa-plus-square"></i>
		<div class="dm_more">
			<ul>
			<?php $dmcv = $this->db->query('SELECT id,alias,name FROM tbl_danhmuc_cv WHERE menu=0 ORDER BY sort DESC'); 
		foreach ($dmcv->result() as $dm) { ?>
			<li <?php if(isset($ccv_id) and $ccv_id==$dm->id){echo 'class="active"'; } ?>><a href="<?php echo site_url('mau-cv-'.$dm->alias.'.html'); ?>"><?php echo 'CV '.$dm->name; ?></a></li>
		<?php } ?>	
			</ul>
		</div>
		</li>
		<li><a href="<?php echo site_url('tat-ca-mau-cv'); ?>"><i class="img ico1"></i></a></li>
	</ul>
</div>
<div id="mn-mb">
	<a href="http://timviec365.vn"><i class="img load"></i>Quay lại Timviec365.vn</a>
	<button type="button" class="navbar-toggle collapsed" id="btn-mb">
	<span class="sr-only">Toggle navigation</span>
	<span class="icon-bar"></span>
	 <span class="icon-bar"></span>
	<span class="icon-bar"></span>
	</button>
	<ul>
		<li<?php if(isset($home)){echo ' class="active"';} ?>><a href="<?php echo site_url(); ?>">Về CV365</a></li>
		<li<?php if($content=='mau_cv'){echo ' class="active"';} ?>><a href="<?php echo site_url('tat-ca-mau-cv'); ?>">Mẫu CV</a></li>
		<li<?php if($content=='mau_thu'){echo ' class="active"';} ?>><a href="<?php echo site_url('mau-cover-letter-thu-xin-viec'); ?>">Mẫu thư</a></li>
		<?php $dmcv = $this->db->query('SELECT id,alias,name FROM tbl_danhmuc_cv WHERE menu=1 ORDER BY sort DESC'); 
		foreach ($dmcv->result() as $dm) { ?>
			<li <?php if(isset($ccv_id) and $ccv_id==$dm->id){echo 'class="active"'; } ?>><a href="<?php echo site_url('mau-cv-'.$dm->alias.'.html'); ?>"><?php echo $dm->name; ?></a></li>
		<?php } ?>	
		<li><a href="<?php echo site_url('mau-cv-xin-viec-online'); ?>">Danh mục CV</a></li>
		<li><a href="cam-nang-nghe-nghiep">Cẩm nang</a></li>		
	</ul>
</div>