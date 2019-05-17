<?php
$server='localhost';
$user='timviec365_tvlt';
$pass='Longtt@132';
//
$dbname='timviec365_devvl'; //dành cho dev
// $dbname='timviec365_giasum'; //dành cho live

// $base_url='https://vieclam123.vn/';
$base_url='http://localhost/ubuntu/giasu123/';
$conn = new mysqli($server, $user, $pass, $dbname);
mysqli_set_charset($conn,"utf8");
// include("config.php");
// Thiết lập cấu trúc fiel là xml
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
      header('Content-Type: text/xml; charset=utf-8');

      echo('<?xml version="1.0" encoding="utf-8"?>');
      echo('<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">');
      echo("<channel>");
      echo("<title>Đăng tin gia sư miễn phí, không qua trung tâm</title>");
      echo("<link rel='stylesheet'>".$base_url."</link>");
      echo("<description>Kênh kết nối dạy và học gia sư tại nhà (online) uy tín, chất lượng cao và hoàn toàn MIỄN PHÍ, không qua trung gian cho các bậc phụ huynh và giáo viên, sinh viên học sinh.</description>");

?>
<?php
      $ar = array('Xem bài nguyên mẫu tại', 'Coi bài nguyên văn tại', 'Tham khảo bài gốc ở', 'Tham khảo bài nguyên mẫu tại đây', 'Coi thêm tại', 'Coi thêm ở', 'Đọc nguyên bài viết tại', 'Coi nguyên bài viết ở', 'Xem nguyên bài viết tại');
      $day = strtotime(date('Y-m-d'));
      $sql="SELECT * FROM baiviet WHERE id IN (93,95,98,99,100) ";

      $db_qr=$conn->query($sql);

      if($db_qr->num_rows >0){
        while($row = $db_qr->fetch_assoc()){
          $i = rand(0,8);

          ?>

          	<item>
          	<title><![CDATA[ <?php echo $row['meta_title']; ?>]]></title>
          	<link><![CDATA[ <?php echo $base_url.$row['alias'].'-b'.$row['id'].'.html'; ?>]]></link>
          	<description >
              <![CDATA[
          		<? if($row['image']!=''){ ?>
          		<a href="<?=$base_url;?>upload/news/thumb/<?=$row['alias']?>-b<?=$row['id']?>.html" title="<?= $row['meta_title'] ?>">
                   <center><img src="<?=$base_url;?>upload/news/thumb/<?=$row['image']?>" width="300" class="w100p" alt="<?= $row['title'] ?>" title="logo"/></center>
                	</a>
          		<? } ?>
              <div id="content">
                <?php
                 $content= $row['content'];
                 $content=str_replace('<img','<img style="display:none"',$content);
                 echo $content;
                 ?>
              </div>

          		<p><?php echo $ar[$i].': '; ?><a href="<?php echo $base_url.$row['alias']?>-b<?=$row['id']?>.html"; ?>"><?php echo $row['meta_title']; ?></a></p>
          		]]>
            </description>

          	<guid isPermaLink="false"><![CDATA[ <?php echo $base_url.$row['alias'].'-b'.$row['id'].'.html'; ?>]]></guid>
          	</item>
          <?php
        }
      }

      unset($db_qr,$row);



      echo("</channel>");
      echo('</rss>');
?>
