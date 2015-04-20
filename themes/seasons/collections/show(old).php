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
    <h2><?php echo link_to_items_browse(__('Items in the %s Collection', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></h2>
    <?php if (metadata('collection', 'total_items') > 0): ?>
    	<div class="item-list">
        <?php foreach (loop('items') as $item): ?>
        
        <?php $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?>
        <div class="item hentry item--spread">
            <?php if (metadata('item', 'has thumbnail')): ?>
            <div class="item_img">
                <div class="item-file image-default">
                    <?php echo link_to_item(item_image('square_thumbnail', array('alt' => $itemTitle))); ?>
                </div>
            </div>
            <?php endif; ?>

            <h2 class="item_title t3"><?php echo link_to_item($itemTitle, array('class'=>'permalink')); ?></h2>

            <div class="item-meta">
            <?php if ($text = metadata('item', array('Item Type Metadata', 'Text'), array('snippet'=>250))): ?>
                <div class="item-description">
                    <p><?php echo $text; ?></p>
                </div>
                <?php elseif ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
                <div class="item-description">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>
            </div>    
        </div>
        <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p><?php echo __("There are currently no items within this collection."); ?></p>
    <?php endif; ?>
</div><!-- end collection-items -->
</aside>

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

<?php echo foot(); ?>
