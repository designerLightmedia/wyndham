<?php head(array('title' => item('Dublin Core', 'Title'),'bodyid'=>'items','bodyclass' => 'show item')); ?>

<div class="secondary-nav top">
	<span id="previous-item" class="previous"><?php echo link_to_previous_item('Previous Item'); ?></span>
	<span id="next-item" class="next"><?php echo link_to_next_item('Next Item'); ?></span>
</div>	

<div id="primary">

	<h1><?php echo item('Dublin Core', 'Title'); ?></h1>
	
	<div id="item-title">

    	<h3>All Titles</h3>
		<ul class="title-list">
    	    <?php foreach (item('Dublin Core', 'Title', 'all') as $title): ?>
        	   <li class="item-title">
	           <?php echo $title; ?>
    	       </li>
        	<?php endforeach ?>
		</ul>
	
	</div>

	<!--  The following function prints all the the metadata associated with an item: Dublin Core, extra element sets, etc. See http://omeka.org/codex or the examples on items/browse for information on how to print only select metadata fields. -->
	<?php echo show_item_metadata(); ?>
	
	<!-- If the item belongs to a collection, the following creates a link to that collection. -->
	<?php if ( item_belongs_to_collection() ): ?>
        <div id="collection" class="element">
            <h2>Collection</h2>
            <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
        </div>
    <?php endif; ?>

    <!-- The following prints a list of all tags associated with the item -->
	<?php if (item_has_tags()): ?>
	<div id="item-tags" class="element">
		<h2>Tags</h2>
		<p class="element-text"><?php echo item_tags_as_string(); ?></p> 
	</div>
	<?php endif;?>
	
	<!-- The following prints a citation for this item. -->
	<div id="item-citation" class="element">
    	<h2>Citation</h2>
    	<div class="element-text"><p><?php echo item_citation(); ?></p></div>
	</div>
	
	<!-- The following returns all of the files associated with an item. -->
	<div id="right">
	<div id="itemfiles" class="element">
	    <h2>Files</h2>
		<div class="element-text"><?php echo display_files_for_item(); ?></div>
	</div>
	
	<div id="extras"><?php echo plugin_append_to_items_show(); ?></div>
	</div>
	
</div><!-- end primary -->

<div class="secondary-nav bottom">
	<span id="previous-item" class="previous"><?php echo link_to_previous_item('Previous Item'); ?></span>
	<span id="next-item" class="next"><?php echo link_to_next_item('Next Item'); ?></span>
</div>	

<?php foot(); ?>