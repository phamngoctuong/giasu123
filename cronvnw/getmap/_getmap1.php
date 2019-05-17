
        <?php
        header('Content-type: application/xml');       

        // include class
        include 'config.php';
        //include 'SitemapGenerator.php';
        $output = '<?xml version="1.0" encoding="UTF-8"?>';
          $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
          echo $output;
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
        //$urls = array();
        $result = new db_query("SELECT usc_id, usc_name,usc_create_time FROM user_company WHERE usc_authentic=1 LIMIT 1");
        var_dump(mysql_num_rows($result->result));
        if(mysql_num_rows($result->result) > 0) {     
            while($row = mysql_fetch_assoc($result->result)) {
                $day = date('Y-m-d\TH:i:sP', $row['usc_create_time']);
                $link = 'https://timviec365.vn'.rewrite_company($row['usc_id'],$row['usc_name']);
            ?>
            <url>
              <loc><?php echo $link; ?></loc>
              <lastmod><?php echo $day; ?></lastmod>
              <changefreq>daily</changefreq>
              <priority>0.8</priority>
            </url>
            <?php     //$urls[] = array($link , $day,  'daily', '0.8');
                //echo $link.'<br>';
            }
        }
        unset($result);

        ?>
</urlset>