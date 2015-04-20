<?php head(array('title'=>'Browse Items')); ?>

	<div id="primary-items">
	

			<h1>Browse Items</h1>
	
			<ul class="navigation" id="secondary-nav">
				<?php
					$itemsCount = ' (' . count(get_items(array('featured' => true))) . ')';
					$tagCount = ' (' . count(get_tags()) . ')'; 
					echo nav(array('Browse All' . $itemsCount => uri('items'), 'Browse by Tag' . $tagCount => uri('items/tags')));
				?>
			</ul>
			
			<div class="pagination">
				<?php echo pagination_links(); ?>
			</div>
			
			<?php while (loop_items()): ?>
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
			
			
			<div class="pagination">
				<?php echo pagination_links(); ?>
			</div>
			
			<?php echo plugin_append_to_items_browse(); ?>
	</div><!-- end primary-items -->
	
<?php foot(); ?>