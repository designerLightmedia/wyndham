<?php
$collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
if ($collectionTitle == '') {
    $collectionTitle = __('[Untitled]');
}
?>

<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>

<div class="section section--brown">
    <div class="l-wrap">
        <div class="site-title t-left">
            <h1><?php echo $collectionTitle; ?></h1>
        </div>
        <div class="t-right">
            <div class="search search--spread">
               <?php echo search_form(array('show_advanced' => true)); ?>               
            </div>
        </div>
    </div>
</div>

<div class="l-wrap">
<div id="primary">
	<?php echo all_element_texts('collection'); ?>
</div><!-- end primary -->    

<aside id="sidebar">
<div id="collection-items">
    <h2><?php echo link_to_items_browse(__('Click here to view items in the %s Collection', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></h2>
</div><!-- end collection-items -->
</aside>

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

<?php echo foot(); ?>
