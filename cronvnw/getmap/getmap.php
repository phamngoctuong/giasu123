<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <?php
        $time = explode(" ",microtime());
        $time = $time[1];

        // include class
        include 'config.php';
        include 'SitemapGenerator.php';
        // create object
        $sitemap = new SitemapGenerator("https://timviec365.vn/", "../");

        // will create also compressed (gzipped) sitemap
        $sitemap->createGZipFile = false;

        // determine how many urls should be put into one file
        $sitemap->maxURLsPerSitemap = 50000;

        // sitemap file name
        $sitemap->sitemapFileName = "sitemap1.xml";

        // sitemap index file name
        $sitemap->sitemapIndexFileName = "sitemap1.xml";

        // robots file name
        $sitemap->robotsFileName = "robots.txt";
        $urls = array(
            array("https://timviec365.vn",                    date('c'),  'daily',    '1'),
            array("https://timviec365.vn/tim-viec-lam.html",        date('c'),  'daily',    '0.9'),
            array("https://timviec365.vn/tuyen-dung",        date('c'),  'daily',    '0.9'),
            array("https://timviec365.vn/cv365",        date('c'),  'daily',    '0.9'),
            array("https://timviec365.vn/cv365/mau-cv-xin-viec-online",        date('c'),  'daily',    '0.9'),
            array("https://timviec365.vn/cv365/mau-so-yeu-ly-lich",        date('c'),  'daily',    '0.9'),
            array("https://timviec365.vn/cv365/mau-don-xin-viec",        date('c'),  'daily',    '0.9'),
            array("https://timviec365.vn/cv365/mau-cover-letter-thu-xin-viec",        date('c'),  'daily',    '0.9'),
            array("https://timviec365.vn/nhatuyendung.html",        date('c'),  'daily',    '0.9'),
            array("https://timviec365.vn/ung-vien",        date('c'),  'daily',    '0.9')
        );
        //Sitemap categỏy
        $result = new db_query("SELECT cat_id,cat_name FROM category");
        if(mysql_num_rows($result->result) > 0) {     
            while($row = mysql_fetch_assoc($result->result)) {
                $link = 'https://timviec365.vn'.rewriteCate($row['cat_id'],$row['cat_name'],0,0);
                $urls[] = array($link , date('c'),  'daily', '0.9');
            }
        }
        unset($result);
        //Sitemap city
        $result = new db_query("SELECT cit_id, cit_name FROM city");
        if(mysql_num_rows($result->result) > 0) {     
            while($row = mysql_fetch_assoc($result->result)) {
                $link = 'https://timviec365.vn'.rewriteCate(0,0,$row['cit_id'],$row['cit_name']);
                $urls[] = array($link , date('c'),  'daily', '0.9');
            }
        }
        unset($result);
        // Create connection        
        $result = new db_query("SELECT * FROM keyword");
        if(mysql_num_rows($result->result) > 0) {     
            while($row = mysql_fetch_assoc($result->result)) {
                $day = date('Y-m-d\TH:i:sP', $row['key_time']);
                $key_id = $row['key_id'];
                $key_name = $row['key_name'];
                $key_cate_id = $row['key_cate_id'];
                $cate_name = $db_cat[$row['key_cate_id']]['cat_name'];
                $key_city_id = $row['key_city_id'];
                $city_name = $arrcity[$row['key_city_id']]['cit_name'];
                $key_qh_id = $row['key_qh_id'];

                $db_qh = new db_query("SELECT cit_name FROM city2 WHERE cit_id = '".$row['key_qh_id']."' LIMIT 1");
                $rowqh = mysql_fetch_assoc($db_qh->result);
                $qh_name = $rowqh['cit_name'];

                $key_cb_id = $row['key_cb_id'];
                $cb_name = $array_cb[$row['key_cb_id']];
                $key_type = $row['key_type'];

                $link = 'https://timviec365.vn'.rewriteKey($key_id,$key_name,$key_cate_id,$cate_name,$key_city_id,$city_name,$key_qh_id,$qh_name,$key_cb_id,$cb_name,$key_type);
                $urls[] = array($link , $day,  'daily', '0.9');
            }                    
        } 
        //Job
        /*$result = new db_query("SELECT new_id, new_title FROM new WHERE new_active=1");
        if(mysql_num_rows($result->result) > 0) {     
            while($row = mysql_fetch_assoc($result->result)) {
                $link = 'https://timviec365.vn'.rewriteNews($row['new_id'],$row['new_title']);
                $urls[] = array($link , date('c'),  'daily', '0.8');
            }
        }
        unset($result);
        //Company
        $result = new db_query("SELECT usc_id, usc_name FROM user_company WHERE usc_authentic=1");
        if(mysql_num_rows($result->result) > 0) {     
            while($row = mysql_fetch_assoc($result->result)) {
                $link = 'https://timviec365.vn'.rewrite_company($row['usc_id'],$row['usc_name']);
                $urls[] = array($link , date('c'),  'daily', '0.8');
            }
        }*/
        //user
        $result = new db_query("SELECT use_id, use_first_name,use_create_time FROM user WHERE use_authentic=1");
        if(mysql_num_rows($result->result) > 0) {     
            while($row = mysql_fetch_assoc($result->result)) {
                $day = date('Y-m-d\TH:i:sP', $row['use_create_time']);
                $link = 'https://timviec365.vn'.rewriteNewsUV($row['use_id'],$row['use_first_name']);
                $urls[] = array($link , $day,  'daily', '0.7');
            }
        }
        unset($result);
        // add many URLs at one time
        $sitemap->addUrls($urls);        

        try {
            // create sitemap
            $sitemap->createSitemap();

            // write sitemap as file
            $sitemap->writeSitemap();

            // update robots.txt file
            //$sitemap->updateRobots();

            // submit sitemaps to search engines
            //$result = $sitemap->submitSitemap("yahooAppId");
            // shows each search engine submitting status
            //echo "<pre>";
            //print_r($result);
            //echo "</pre>";
            
        }
        catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        echo "Memory peak usage: ".number_format(memory_get_peak_usage()/(1024*1024),2)."MB";
        $time2 = explode(" ",microtime());
        $time2 = $time2[1];
        echo "<br>Execution time: ".number_format($time2-$time)."s";


        ?>
    </body>
</html>
