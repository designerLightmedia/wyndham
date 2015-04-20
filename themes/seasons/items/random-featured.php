<?php if (($items) || ($collection)) : ?>
<div class="flexslider carousel">
    <ul class="slides">
    <?php if ($items): ?>
		<?php foreach ($items as $item): ?>
            <?php
                $title = metadata($item, array('Dublin Core', 'Title'));
                $description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 360)); ?>
                
                <li class="post post--carousel">
                
                    <?php echo files_for_item(array(), array('class'=>'post_img'), $item); ?>
                    
                    <div class="post_content">
                        <h1 class="post_title"><?php echo link_to($item, 'show', strip_formatting($title)); ?></h1>
                        <?php if ($description): ?>
                            <div class="formatted"><?php echo $description; ?></p>
                        <?php endif; ?>
                        <?php echo link_to($item, 'show', strip_formatting('View Item'), array('class'=>'button button--blue')); ?>
                    </div>
                </li>
        <?php endforeach; ?>
    <?php endif; ?>
  <?php echo custom_random_featured_collection(); ?>
    </ul>
</div>
<?php else: ?>
    <p><?php echo __('No featured items are available.'); ?></p>
<?php endif; ?>


