<?php
$CI=&get_instance();
//$CI->load->helper('locdau');
$CI->load->model('admin/admin_model');
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin')->row();

?>
<h3>Thống kê tiêu dùng trên website</h3>
<br />
<h4>Số tiền còn nợ khách: <b style="color:#ff0000"><?php echo number_format($tieudungtien->tongtien)." VNĐ" ?></b></h4>
<br />
<hr />
<br />
<h4>Tổng điểm trên hệ thống: <b style="color:#ff0000"><?php echo number_format($tieudungdiem->tongdiem)." điểm" ?></b></h4>
<br />
<h4>Trong đó:</h4>
<br />
<h4>Điểm cộng hàng ngày: <b style="color:#ff0000"><?php echo number_format($tieudungdiem->diemfree)." điểm" ?></b></h4>
<br />
<h4>Điểm tiêu dùng(xem thông tin): <b style="color:#ff0000"><?php echo number_format($tieudungdiem->diemdung)." điểm" ?></b></h4>
<br />
<h4>Điểm đã mua(từ tiền): <b style="color:#ff0000"><?php echo number_format($tieudungdiem->diemmua)." điểm" ?></b></h4>