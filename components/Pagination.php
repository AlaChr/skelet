<?php
/**
 * Description of Pagination
 *
 * @author OOASU
 */
class Pagination {
  //Входные параметры
  function __construct($count=10, $active=1, $count_show_pages = 4, $url_page) {
  
  $count_pages = ceil($count/10);
  $uri = 'http://'.$_SERVER['HTTP_HOST'].'/';
  $url_page = $uri.$url_page;
        if ($count_pages < $count_show_pages) {
            $count_show_pages = $count_pages;
        }
        if ($count_pages > 1) {
            $left = $active - 1;
            $right = $count_pages - $active;
                if ($left < floor($count_show_pages / 2)) $start = 1;
                else $start = $active - floor($count_show_pages / 2);
                $end = $start + $count_show_pages - 1;
                    if ($end > $count_pages) {
                        $start -= ($end - $count_pages);
                        $end = $count_pages;
                            if ($start < 1) $start = 1;
                    }
    
        }
        else {$start = 1; $end = $count_show_pages;}
include ROOT.'/widget/wPagination.php';
    }
}
