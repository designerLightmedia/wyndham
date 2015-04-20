<?php if ($collection): ?>
	<?php
	$title = metadata($collection, array('Dublin Core', 'Title'));
	$description = metadata($collection, array('Dublin Core', 'Description'), array('snippet' => 150));
	?>
	<li class="post post--carousel">
        <div class="post_img image-jpeg">
        <a class="download-file" href="http://www.wyndhamhistory.net.au/files/original/ad4eb3918ba70727a53e4cf457e3d103.jpg*">
        <img class="thumb" title="1w.jpg" alt="1w.jpg" src="http://www.wyndhamhistory.net.au/files/square_thumbnails/ad4eb3918ba70727a53e4cf457e3d103.jpg">
        </a>
        </div>
        <div class="post_content">
            <h1 class="post_title"><?php echo link_to($this->collection, 'show', strip_formatting($title)); ?></h1>
            <?php if ($description): ?>
                <div class="formatted"><?php echo $description; ?></div>
            <?php endif; ?>
            <?php echo link_to($this->collection, 'show', strip_formatting('View Collection'), array('class'=>'button button--blue')); ?>
		</div>
	</li>
<?php endif; ?>