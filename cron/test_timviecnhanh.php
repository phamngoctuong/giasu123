<?php
//include("config.php");
    function save_link($url)
    {        
        include("simple_html_dom_helper.php");
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $day = date('d-m-Y');        
        $html = file_get_html($url);
        $pattern = '.box-content .block-content .table-content tbody tr .block-item a[class=item]';        
                
        foreach($html->find($pattern) as $el){        
            $cp_link = $el->href;
            echo $cp_link.'<br />';
        }                
        $html->clear();
        unset($html);               
    }
    save_link('https://www.timviecnhanh.com/viec-lam-tai-chinh-ke-toan-kiem-toan-c47.html?page=1');
    
?>
