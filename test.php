<?php

$collections_url = 'http://wyndham2015.lmweb.com.au/api/collections'; //'http://wyndham2015.lmweb.com.au/api/items?collection=2';//


$content = file_get_contents($collections_url);
$json = json_decode($content, true);

echo '<pre>';
print_r($json);
echo '</pre>';
