<!-- <?php 
$slider = $this->db->query('SELECT id,name,image,link,content FROM tbl_slider WHERE status=1 ORDER BY id DESC');
if($slider->num_rows()>0){
?>
<div class="slider">
	<ul class="owl-carousel">
		<?php foreach ($slider->result() as $s){ ?>
			<li>
			<div class="bg-image" style="background:url('<?php echo 'upload/slider/'.$s->image; ?>') center center;height: 416px"></div>
			<div class="ctr">
				<div class="r5">
					<?php echo $s->content; ?>
				</div>
				<a class="join bg-blue" href="<?php echo $s->link; ?>"><i class="img ico2"></i>Tạo một CV ngay bây giờ</a>
			</div>
		</li>
		<?php } ?>
	</ul>
</div>
<?php } ?> -->
