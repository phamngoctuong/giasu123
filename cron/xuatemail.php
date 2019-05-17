<?
include("config.php");
$full_path = 'danhsachcongty.xlsx';//duong dan file
$db_full = new db_query('SELECT usc_id,usc_email,usc_company,usc_phone,usc_address FROM user_company WHERE usc_email <> "" OR usc_phone <> ""');
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Tên công ty')
->setCellValue('B1', 'Email')
->setCellValue('C1', 'Số điện thoại')
->setCellValue('D1', 'Địa chỉ');
while($rowx = mysql_fetch_assoc($db_full->result))
{
   $listsss = 
   array(
   'name' => $rowx['usc_company'],
   'email' => $rowx['usc_email'],
   'phone' => $rowx['usc_phone'],
   'city' => $rowx['usc_address'],
   'link'  => "https://timviec365.vn".rewrite_company($rowx['usc_id'],$rowx['usc_company']),
   );
   $lists[]	=	$listsss;
}
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(65);
// Config
$styleArray = array(
 'font'  => array(
     'color' => ['rgb' => '0000FF'],
     'underline' => 'single'
 ));
//set gia tri cho cac cot du lieu
$i = 2;
foreach ($lists as $row2)
{
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row2['name'])
->setCellValue('B'.$i, $row2['email'])
->setCellValue('C'.$i, $row2['phone'])
->setCellValue('D'.$i, $row2['city'])
->setCellValue('E'.$i, $row2['link']);
$objPHPExcel->getActiveSheet()->getCell('E'.$i)->getHyperlink()->setUrl($row2['link'])->setTooltip('Click để xem chi tiết công ty');
$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleArray);
$i++;
}
//ghi du lieu vao file,định dạng file excel 2007
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($full_path);
?>