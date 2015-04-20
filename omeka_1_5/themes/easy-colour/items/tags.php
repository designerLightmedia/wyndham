<?php head(array('title'=>'Browse by Tag')); ?>

<div id="primary-items">
    
    <h1>Browse by Tag</h1>
    
    <ul class="navigation item-tags" id="secondary-nav">
    <?php
        $itemsCount = ' (' . count(get_items(array('featured' => true))) . ')';
	$tagCount = ' (' . count(get_tags()) . ')'; 
            echo nav(array('Browse All' . $itemsCount => uri('items/browse'), 'Browse by Tag' .$tagCount => uri('items/tags'))); ?>
    </ul>

        <?php echo tag_cloud($tags,uri('items/browse')); ?>
        
</div><!-- end primary-items -->

<?php foot(); ?>