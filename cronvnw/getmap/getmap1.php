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
        $sitemap->sitemapFileName = "sitemap-blog.xml";

        // sitemap index file name
        $sitemap->sitemapIndexFileName = "sitemap-blog.xml";

        // robots file name
        $sitemap->robotsFileName = "robots.txt";
       
        //Job
        /*
        for($i=0;$i<50;$i++){
            $num = $i*500 + 1;
        $result = new db_query("SELECT new_id, new_title, new_create_time FROM new_map WHERE new_active=1 LIMIT ".$num.",500");
        if(mysql_num_rows($result->result) > 0) {    
            while($row = mysql_fetch_assoc($result->result)) {
                $day = date('Y-m-d\TH:i:sP', $row['new_create_time']);
                $link = 'https://timviec365.vn'.rewriteNews($row['new_id'],$row['new_title']);
                $urls[] = array($link , $day,  'daily', '0.8');
            }
            var_dump($i);
        }
        unset($result);
        }*/
        //Company
        $urls = array();
        $result = new db_query("SELECT new_id, new_title,new_date,new_category_id FROM news WHERE new_new=0 AND new_active=1");
        if(mysql_num_rows($result->result) > 0) {     
            while($row = mysql_fetch_assoc($result->result)) {
                $day = date('Y-m-d\TH:i:sP', $row['new_date']);

                //$result1 = new db_query("SELECT cat_name FROM categories_multi WHERE cat_id=".$row['new_category_id']);
                //$cat = mysql_fetch_assoc($result1->result);
                $link = 'https://timviec365.vn/blog/'.replaceTitle($row['new_title'])  . "-new" . $row["new_id"] . ".html";
                $urls[] = array($link , $day,  'daily', '0.7');
            }
        }
        $result = new db_query("SELECT bmn_id,bmn_name,bmn_time,bmn_url FROM bieu_mau_news");
        if(mysql_num_rows($result->result) > 0) {     
            while($row = mysql_fetch_assoc($result->result)) {
                $day = date('Y-m-d\TH:i:sP', $row['bmn_time']);
                if($row['bmn_url']!=''){
                    $link = 'https://timviec365.vn/bieu-mau/'.replaceTitle($row['bmn_url'])  . "-tl" . $row["bmn_id"] . ".html";
                }else{
                    $link = 'https://timviec365.vn/bieu-mau/'.replaceTitle($row['bmn_name'])  . "-tl" . $row["bmn_id"] . ".html";
                }
                $urls[] = array($link , $day,  'daily', '0.7');
            }
        }
        unset($result);

        $result = new db_query("SELECT bdn_id,bdn_name,bdn_time,bdn_url FROM bo_de_news");
        if(mysql_num_rows($result->result) > 0) {     
            while($row = mysql_fetch_assoc($result->result)) {
                $day = date('Y-m-d\TH:i:sP', $row['bdn_time']);
                if($row['bmn_url']!=''){
                    $link = 'https://timviec365.vn/cau-hoi-tuyen-dung/'.replaceTitle($row['bdn_url'])  . "-tl" . $row["bdn_id"] . ".html";
                }else{
                    $link = 'https://timviec365.vn/cau-hoi-tuyen-dung/'.replaceTitle($row['bdn_name'])  . "-tl" . $row["bdn_id"] . ".html";
                }
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
