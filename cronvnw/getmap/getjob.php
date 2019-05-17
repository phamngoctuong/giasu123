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
        include 'function_rewrite.php';
        include 'SitemapGenerator.php';
        // create object
        $sitemap = new SitemapGenerator("https://timviec365.vn/", "../");

        // will create also compressed (gzipped) sitemap
        $sitemap->createGZipFile = false;

        // determine how many urls should be put into one file
        $sitemap->maxURLsPerSitemap = 50000;

        

        // robots file name
        $sitemap->robotsFileName = "robots.txt";

        // Create connection
        $conn = new mysqli('localhost', 'timviec365_user', 'i?e7Ly7KcRTyE3!QYKgFN', 'timviec365_tbtimviec');
        //$conn = new mysqli('localhost', 'root', 'root', 'timviec365');
        $conn->set_charset('utf8');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
 
        for($i=$_GET['num'];$i<15;$i++){
            $urls = array();
            // sitemap file name
            $sitemap->sitemapFileName = "sitemap-job".$i.".xml";
            // sitemap index file name
            $sitemap->sitemapIndexFileName = "sitemap-job".$i.".xml";
            $num = $i*50000;
            $result = $conn->query('SELECT * FROM new WHERE new_active=1 LIMIT '.$num.',50000');
            if($result->num_rows > 0 AND $result->num_rows<50001) {     
                while($row = mysqli_fetch_object($result)) {
                    $day = date('Y-m-d\TH:i:sP', $row->new_create_time);
                    $urls[] = array('https://timviec365.vn/'.replaceTitle($row->new_title).'-p'.$row->new_id.'.html', $day,  'daily',    '0.7');
                }      

                // add many URLs at one time
                $sitemap->addUrls($urls);        

                try {
                    // create sitemap
                    $sitemap->createSitemap();

                    // write sitemap as file
                    $sitemap->writeSitemap();

                    // update robots.txt file
                    $sitemap->updateRobots();

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

            }else{
                break;
            }
        }
        echo "Memory peak usage: ".number_format(memory_get_peak_usage()/(1024*1024),2)."MB";
        $time2 = explode(" ",microtime());
        $time2 = $time2[1];
        echo "<br>Execution time: ".number_format($time2-$time)."s";


        ?>
    </body>
</html>
