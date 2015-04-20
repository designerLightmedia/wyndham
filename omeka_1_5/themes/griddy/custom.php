<?php 
// Use this file to define customized helper functions, filters or 'hacks' defined
// specifically for use in your Omeka theme. Note that helper functions that are
// designed for portability across themes should be grouped into a plugin whenever
// possible.

 function griddy_display_random_featured_item($withImage=null)
 {
    $featuredItem = random_featured_item($withImage);
 	$html = '<h2>Featured Item</h2>';
 	if ($featuredItem) {
 	   if (item_has_thumbnail($featuredItem)) {
 	       $html .= '<p class="crop">';
 	       $html .= link_to_item(item_fullsize(array(), 0, $featuredItem), array('class'=>'image'), 'show', $featuredItem);
 	   	   $html .= '</p>';
 	   }
 	    $itemTitle = item('Dublin Core', 'Title', array(), $featuredItem);        
 	   $html .= '<h3>' . link_to_item($itemTitle, array(), 'show', $featuredItem) . '</h3>';
 	   // Grab the 1st Dublin Core description field (first 150 characters)
 	   if ($itemDescription = item('Dublin Core', 'Description', array('snippet'=>150), $featuredItem)) {
 	       $html .= '<p class="item-description">' . $itemDescription . '</p>';
       }
 	} else {
 	   $html .= '<p>No featured items are available.</p>';
 	}

     return $html;
 }
 
 function griddy_display_random_featured_collection()
{
    $featuredCollection = random_featured_collection();
    $html = '<h2>Featured Collection</h2>';
    if ($featuredCollection) {
        $html .= '<h3>' . link_to_collection($collectionTitle, array(), 'show', $featuredCollection) . '</h3>';
        if ($collectionDescription = collection('Description', array('snippet'=>150), $featuredCollection)) {
            $html .= '<p class="collection-description">' . $collectionDescription . '</p>';
        }
    } else {
        $html .= '<p>No featured collections are available.</p>';
    }
    return $html;
}

function griddy_custom_background()
{
	if(function_exists('get_theme_option') && $bgimage = get_theme_option('Background Image')) {
		$storage = Zend_Registry::get('storage');
        $bgimage_url = $storage->getUri($storage->getPathByType($bgimage, 'theme_uploads'));
        $html = <<<CSS
<style type="text/css" media="screen">
body {
	background: url($bgimage_url) no-repeat center center fixed;
	}
</style>
CSS;
        echo $html;
		}

}