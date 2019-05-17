<?php
$CI=&get_instance();
$CI->load->model('admin/admin_model');
$this->db->select('id');
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin')->row();
?>

<h3 class="header">Thêm bài viết</h3>
<div class="content-inner1">
	<form name="frmtintuc" action="<?php echo site_url('admin/add_baiviet'); ?>" method="post" enctype="multipart/form-data">
		<?php
			if(isset($id))
			{
				$this->db->where('id',$id);
				$item=$this->db->get('baiviet')->row();
				$id=$item->id;
			}
			?>
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />
		<input type="hidden" name="uid" value="<?php if(isset($id)) { echo $item->uid; }
		else{
			echo $admin->id;
		}
		?>" />
		<div class="gray">
		<table width="100%"><tr><td>
		<table class="tab1">
		<tr>
			<td width="150"><strong>Tiêu đề</strong></td>
			<td><input type="text" name="title" value="<?php if(isset($id)) {echo htmlspecialchars($item->title);} ?>" /></td>
		</tr>

		<tr class="second">
			<td><strong>Đường dẫn thân thiện</strong></td>
			<td><input type="text" name="alias" value="<?php if(isset($id)){ echo $item->alias;} ?>" /></td>
		</tr>
		<tr>
			<td><strong>Chuyên mục</strong></td>
			<td><?php
				if(isset($id)){ $CI->admin_model->selectCtrl($item->cid,'cid', 'forFormDim');}
				else{
					$CI->admin_model->selectCtrl('','cid', 'forFormDim');
				}
			?></td>
		</tr>
		<tr class="second">
			<td><strong>Ảnh đại diện</strong></td>
			<td><?php if(isset($id)){?>
			<input type="hidden" name="image" style="width:200px;" value="<?php echo $item->image; ?>">
			<?php if($item->image !=''){?>
			<img src="<?php echo 'upload/news/thumb/'.$item->image; ?>" width="200"><br />
			<?php }}
			?>
			<input type="file" name="image" value="" />
			</td>
		</tr>
		<tr>
			<td colspan="2"><strong>Mô tả</strong><br />
			​	<textarea rows="5" cols="90" name="sapo" /><?php if(isset($id)) {echo $item->sapo;} ?></textarea>
			</td>
		</tr>
			<tr class="second">
			<td><strong>File đính kèm</strong></td>
			<td><?php if(isset($id)){?>
			<input type="text" name="file" value="<?php if($item->file!=''){ echo 'http://vieclam123.vn/download/'.$item->file;} ?>">
			<?php } ?>
			<input type="file" name="file" value=""/>
			</td>
		</tr>
		</table>
		</td>
		<td valign="top" style="width: 250px">
			<ul style="padding:4px; margin:0">
				<li>
					<p class="message_head">
						<strong>Bài viết thuộc các nhóm tin:</strong>
					</p>
				</li>
				<li>
				<p class="message_head">
					<?php if(isset($id)){ ?>
					<input class="news_checkbox" type="checkbox" name="status" value="1" <?php if($item->status==1){ echo "checked"; } ?> />Xuất bản
					<?php }else{ ?>
						<input class="news_checkbox" checked="checked" type="checkbox" name="status" value="1" />Xuất bản
					<?php } ?>
				</p>
				</li>
				<li>
				<p class="message_head">
					<?php if(isset($id)){ ?>
						<input class="news_checkbox" type="checkbox" name="vip" value="1" <?php if($item->vip==1){echo 'checked';} ?> />Tin nổi bật
					<?php }else{ ?>
						<input class="news_checkbox" type="checkbox" name="vip" value="1" />Tin nổi bật
					<?php } ?>
				</p>
				</li>
				<!--<li>
				<p class="message_head">
					<strong>Từ khóa tìm kiếm</strong>
					<p class="message_head">
						<cite>Từ khóa cách nhau bởi dấu phẩy ','</cite>
					</p>
					<textarea rows="3" cols="26" name="tags" /><?php if(isset($id)) {echo $item->tags;} ?></textarea>
				</p>
				</li>-->
				<li>
				<p class="message_head">
					<?php
					if(isset($id)){
						$ngays=explode(' ',$item->created_day);
						$ngay=explode('-',$ngays[0]);
						$created_day=$ngay[2].'-'.$ngay[1].'-'.$ngay[0];
						$time=$ngays[1];
					}
					else{
						date_default_timezone_set('Asia/Ho_Chi_Minh');
						$created_day = date('d-m-Y');
						$time = date('H:i:s');;
					}
					?>
					<p><strong>Ngày tạo</strong><span class="timestamp">(Ngày-tháng-năm giờ:phút:giây)</span></p><br />
					<input id="created_day" type="text" name="created_day" value="<?php echo $created_day; ?>" />
					<input id="time" type="text" name="time" value="<?php echo $time; ?>" />
				</p></li>
			</ul>
             <div style="line-height:25px;border:1px solid #ccc;">
            <label><b>Danh sách bài mới nhất</b></label>
                <input type="text" id="findkey" name="findkey" />
                <ul id="listnewest">
                    	<?php foreach ($listdefault as $nc) { ?>
                            <ol><a href="<?php echo site_url($nc->alias.'-b'.$nc->id.'.html'); ?>"><?php echo $nc->title; ?></a></ol>
                        <?php  } ?>
                </ul>
            </div>
		</td>
		</tr>
		<tr>
			<td width="300px">
				<strong>ID các bài viết liên quan - các id cách nhau bởi dấu phẩy- nhập vào 5 id</strong>
				<input type="text" name="linkRelationship" value="<?php if(!empty($item->linkRelationship))	echo $item->linkRelationship ?>" placeholder="VD: 1,2,3,4,5" pattern="[0-9]{1,},[0-9]{1,},[0-9]{1,},[0-9]{1,},[0-9]{1,}" title="hãy nhập đúng định dạng cho phép( gồm số , dấu phẩy) và nhập đúng 5 id"/>

			</td>
		</tr>
		<tr><td colspan="2">
			<strong>Nội dung</strong>
			​<textarea rows="5" cols="70" name="content" id="editor" /><?php if(isset($id)) {echo $item->content;} ?></textarea>
		</td></tr>
		</table>
		</div>
		<div class="gray">
		<table width="100%">
			<tr>
				<td width="150"><strong>SEO Title</strong></td>
				<td><input type="text" name="meta_title" value="<?php if(isset($id)) {echo htmlspecialchars($item->meta_title);} ?>" /></td>
			</tr>
			<tr>
				<td width="150"><strong>SEO Key</strong></td>
				<td><input type="text" name="meta_key" value="<?php if(isset($id)) {echo htmlspecialchars($item->meta_key);} ?>" /></td>
			</tr>
			<tr>
				<td width="150"><strong>SEO Description</strong></td>
				<td>​<textarea rows="4" cols="70" style="width:95%" name="meta_des" /><?php if(isset($id)) {echo $item->meta_des;} ?></textarea></td>
			</tr>
		</table>
		</div>
		<div class="gray">
		<center>
		<?php
			if(isset($id))
			{
			?>
				<input class="button" type="submit" name="submit" value="Lưu thay đổi" />
			<?php
			}
			else
			{
			?>
				<input class="button" type="submit" name="submit" value="Nhập tin" />
			<?php
			}
		?>
		</center>
		</div>
	</form>
	<div class="clr"></div>
</div>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript">
jQuery(function($){

	$.datepicker.regional['vi'] = {

		closeText: 'Đóng',

		prevText: '&#x3c;Trước',

		nextText: 'Tiếp&#x3e;',

		currentText: 'Hôm nay',

		monthNames: ['Tháng Một', 'Tháng Hai', 'Tháng Ba', 'Tháng Tư', 'Tháng Năm', 'Tháng Sáu',

		'Tháng Bảy', 'Tháng Tám', 'Tháng Chín', 'Tháng Mười', 'Tháng Mười Một', 'Tháng Mười Hai'],

		monthNamesShort: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',

		'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],

		dayNames: ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],

		dayNamesShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],

		dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],

		weekHeader: 'Tu',

		dateFormat: 'dd-mm-yy',

		firstDay: 0,

		isRTL: false,

		showMonthAfterYear: false,

		yearSuffix: ''};

	$.datepicker.setDefaults($.datepicker.regional['vi']);
});
$(function() {
	$( "#created_day" ).datepicker();
	$.datepicker.setDefaults($.datepicker.regional['vi']);
    $('#findkey').keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $.ajax(
              {

                  url: "/admin/ajaxgetlistarticle",
                  type: "POST",
                  data: { findkey: $('#findkey').val()},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (obj) {
                    var result=obj;
                     if(result.length > 0){
                     var strhtml='';
                      for (var i = 0; i < result.length; i++) {
                        strhtml+="<li><a href='"+result[i].alias+"-b"+result[i].id+".html'>"+result[i].title+"</a></li>";


                        }
                        document.getElementById('listnewest').innerHTML=strhtml;
                      }

                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
        }
    });
});
</script>
<!-- Tích hợp jck soạn thảo-->
<script type="text/javascript" src="javascript/formCKEDITOR.js">

</script>
