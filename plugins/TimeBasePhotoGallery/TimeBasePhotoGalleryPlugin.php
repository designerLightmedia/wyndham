<?php

if (!defined('TIMEBASEPHOTOGALLERY_PLUGIN_DIR')) {
    define('TIMEBASEPHOTOGALLERY_PLUGIN_DIR', dirname(__FILE__));
}





class TimeBasePhotoGalleryPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array('public_head');
    
    public function hookPublicHead($args)
    {

        queue_css_file('rows');

        queue_js_file('lib/jquery-1.7.min');
        queue_js_file('lib/jquery.tinysort.min');
        queue_js_file('lib/jquery.ba-hashchange.min');


        queue_js_file('clusters');
        queue_js_file('decades');
        queue_js_file('titles');
        queue_js_file('itembox');
        #queue_js_file('apikey');
        queue_js_file('time-base-photo-gallery');
    }
}



function timeBasePhotoGallery() {
    // $homepageRecentItems = (int)get_theme_option('Homepage Recent Items') ? get_theme_option('Homepage Recent Items') : '3';
           // set_loop_records('items', $homepageRecentItems);
           // if (has_loop_records('items')):
           
              while(loop_items()):
             
        echo '<pre style="display:none">';
           echo 'test';
        //echo link_to_item(item_square_thumbnail());
        //echo item('Dublin Core', 'Title');
        echo '</pre>';
   endwhile; 
   // endif;
}

function timeBasePhotoGallery1() {
    $url = 'http://wyndham2015.lmweb.com.au/api/items';
    $headerArray = get_headers($url, 1);
    //$headerArray['Omeka-Total-Results']


    for ($i = 1; $i <= 1; $i++) {
        $json_string = "http://wyndham2015.lmweb.com.au/api/items?page=" . $i;


        $json_array = json_decode(curl_file_get_contents($json_string), true);



        $results = array();

        if ($json_array) {
            $title = '';
            $title = '';
            $year = 0;
            $thumb = 0;
            $img_array = [];
            foreach ($json_array as $arr) {

                foreach ($arr['element_texts'] as $items) {

                    $element = $items['element'];


                    if (!isset($element['name']) && ($element['name'] != 'Title' && $element['name'] != 'Date')) continue;


                    if (isset($element['name']) && $element['name'] == 'Title') {
                        $title = $items['text'];
                    }

                    if (isset($element['name']) && $element['name'] == 'Date') {
                        $year = $items['text'];
                    }

                }


                $img_array = json_decode(curl_file_get_contents("http://wyndham2015.lmweb.com.au/api/files/". $arr['id']), true);





                if (isset($img_array['mime_type'])) {
                    if ($img_array['mime_type'] == 'image/jpeg' || $img_array['mime_type'] == 'image/gif' || $img_array['mime_type'] == 'image/png') ;
                    {
                        $thumb = $img_array['filename'];
                    }
                }

                $results[] = array(
                    'id' => $arr['id'],
                    'title' => $title,
                    'year' => $year,
                    'thumb' => $thumb
                );

            }
        }
    }

    echo '<pre style="display:none;">';
    echo json_encode($results);
    echo '</pre>';
}


function curl_file_get_contents($url)
{
    $ch = curl_init();


    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $contents = curl_exec($ch);

    curl_close($ch);

    return $contents;
}