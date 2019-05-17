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
        include 'SitemapGenerator.php';
        // create object
        $sitemap = new SitemapGenerator("localhost/", "../");

        // will create also compressed (gzipped) sitemap
        $sitemap->createGZipFile = false;

        // determine how many urls should be put into one file
        $sitemap->maxURLsPerSitemap = 50000;

        // sitemap file name
        $sitemap->sitemapFileName = "sitemap.xml";

        // sitemap index file name
        $sitemap->sitemapIndexFileName = "sitemap.xml";

        // robots file name
        $sitemap->robotsFileName = "robots.txt";

        // Create connection
        $conn = new mysqli('localhost', 'root', '123456', 'cv365');
        $conn->set_charset('utf8');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $urls = array(
            array("localhost",   date('c'),  'daily',    '1'),            
        );
        
        $result = $conn->query('SELECT id,alias FROM tbl_category WHERE status=1');
        if($result->num_rows > 0) {     
            $r = array();
            while($row = mysqli_fetch_object($result)) {
                $urls[] = array('localhost/'.$row->id.'/'.$row->alias.'.html', date('c'),  'daily',    '0.7');
            }                    
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

        echo "Memory peak usage: ".number_format(memory_get_peak_usage()/(1024*1024),2)."MB";
        $time2 = explode(" ",microtime());
        $time2 = $time2[1];
        echo "<br>Execution time: ".number_format($time2-$time)."s";


        ?>
    </body>
</html>
