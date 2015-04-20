<?php head(array('title'=>h($collection->name),'bodyid'=>'collections','bodyclass' => 'show')); ?>

<div id="primary-items">

    <h1 class="collection-title"><?php echo collection('Name'); ?></h1>
	
    <div id="collection-description" class="element">
	<div class="indent">
	    <h3>Entries</h3>
	    <div class="element-text">
		<?php echo ('This collection contains ') . total_items_in_collection() . ' items'; ?>
	    </div>
	    
	    <div class="element">
		<h3>Collector(s)</h3> 
		    <?php if(collection_has_collectors()): ?>
			    <div class="element-text">
				    <p><?php echo collection('Collectors', array('delimiter'=>', ')); ?></p>
			    </div>
		    <?php endif; ?>
	    </div>
	    
	    <h3>Description</h3>
	    <div class="element-text">
		<?php echo nls2p(collection('Description')); ?>
	    </div>
	</div>	
    </div><!-- end collection-description -->

    <?php while (loop_items_in_collection()): ?>
	<div class="item-entry">
		    
		<h3><?php echo link_to_item(item('Dublin Core', 'Title', array('snippet'=>20)), array('class'=>'permalink')); ?></h3>

		<?php if (item_has_thumbnail()): ?>
			<div class="item-img">
				<?php echo link_to_item(item_square_thumbnail()); ?>						
			</div>
		<?php else: ?>
			<div class="item-img">
				<?php echo link_to_item("<img src='themes/easy-colour/images/no-img.jpg' alt='no image available'/>") ?>
			</div>
		<?php endif; ?>

		<?php if ($text = item('Item Type Metadata', 'Text', array('snippet'=>100))): ?>
			<div class="item-description">
				<p><?php echo $text; ?></p>
			</div>		
		<?php elseif ($description = item('Dublin Core', 'Description', array('snippet'=>100))): ?>
			<div class="item-description">
				<?php echo $description; ?>
			</div>
		<?php endif; ?>

		<?php if (item_has_tags()): ?>
			<div class="tags"><p><strong>Tags:</strong>
				<?php echo item_tags_as_string(); ?></p>
			</div>
		<?php endif; ?>
		
	<?php echo plugin_append_to_items_browse_each(); ?>

	</div><!-- end class="item-entry" -->			
    <?php endwhile; ?>

    <div style="clear:both"></div>
    
    <?php echo plugin_append_to_collections_show(); ?>
    
</div><!-- end primary-items -->

<?php foot(); ?>