<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse')); ?>
        
<div class="section section--brown">
    <div class="l-wrap">
        <div class="site-title t-left">
            <h1><?php echo $pageTitle;?></h1>
            <span class="title-desc"><?php echo __('Total item(s) : %s', $total_results); ?></span>
        </div>
        <div class="t-right">
            <div class="search search--spread">
               <?php echo search_form(array('show_advanced' => true)); ?>               
            </div>
        </div>
    </div>
</div>

<div class="l-wrap">

    <nav class="items-nav navigation secondary-nav">
        <?php echo public_nav_items(); ?>
            
        <?php echo pagination_links(); ?>

        <?php if ($total_results > 0): ?>

        <?php
        $sortLinks[__('Title')] = 'Dublin Core,Title';
        $sortLinks[__('Creator')] = 'Dublin Core,Creator';
        $sortLinks[__('Date Added')] = 'added';
        ?>
        <div id="sort-links">
            <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
        </div>

        <?php endif; ?>
    </nav>
    
    <div class="item-list">
        <?php foreach (loop('items') as $item): ?>
		<?php $type = metadata('item', array('Dublin Core', 'Type'));?>
        <?php $url = "http://" . $_SERVER['HTTP_HOST']; ?>
        <div class="item item--spread hentry">

            <div class="item_img">
                <?php 
                $files = files_for_item(array('imageSize' => 'square_thumbnail'));
                if ($files) {
                    echo $files;
                }
                // elseif($type == 'World War One Veterans') {
                //     echo '<div class="item-file image-default"><img class="thumb" title="WW1 Veterans" alt="WW1 Veterans" src="'.$url.'/themes/seasons/img/war.jpg"></div>';
                // }
                elseif($type == 'Text') {
                    if($item->getItemType()->name == 'World War One Veterans')
                        echo '<div class="item-file image-default"><img class="thumb" title="" alt="" src="'.$url.'/themes/seasons/img/solder-silhouette.jpg"></div>';
                    else
                        echo '<div class="item-file image-default"><img class="thumb" title="Article" alt="Article" src="'.$url.'/themes/seasons/img/article.jpg"></div>';
                }
                elseif($type == 'Still Image') {
                    if($item->getItemType()->name == 'World War One Veterans')
                        echo '<div class="item-file image-default"><img class="thumb" title="" alt="" src="'.$url.'/themes/seasons/img/solder-silhouette.jpg"></div>';
                    else
                    echo '<div class="item-file image-default"><img class="thumb" title="Still Image" alt="Still Image" src="'.$url.'/themes/seasons/img/article.jpg"></div>';
                }
                elseif($type == 'Sound') {
                    if($item->getItemType()->name == 'World War One Veterans')
                        echo '<div class="item-file image-default"><img class="thumb" title="" alt="" src="'.$url.'/themes/seasons/img/solder-silhouette.jpg"></div>';
                    else
                    echo '<div class="item-file image-default"><img class="thumb" title="Sound" alt="Sound" src="'.$url.'/themes/seasons/img/sounds.jpg"></div>';
                }
                elseif($type == 'Document') {
                    if($item->getItemType()->name == 'World War One Veterans')
                        echo '<div class="item-file image-default"><img class="thumb" title="" alt="" src="'.$url.'/themes/seasons/img/solder-silhouette.jpg"></div>';
                    else
                    echo '<div class="item-file image-default"><img class="thumb" title="Document" alt="Document" src="'.$url.'/themes/seasons/img/document.jpg"></div>';
                }
                elseif($type == 'Oral History') {
                    if($item->getItemType()->name == 'World War One Veterans')
                        echo '<div class="item-file image-default"><img class="thumb" title="" alt="" src="'.$url.'/themes/seasons/img/solder-silhouette.jpg"></div>';
                    else
                    echo '<div class="item-file image-default"><img class="thumb" title="Oral History" alt="Oral History" src="'.$url.'/themes/seasons/img/oral-history.jpg"></div>';
                }
                elseif($type == 'Website') {
                    if($item->getItemType()->name == 'World War One Veterans')
                        echo '<div class="item-file image-default"><img class="thumb" title="" alt="" src="'.$url.'/themes/seasons/img/solder-silhouette.jpg"></div>';
                    else
                    echo '<div class="item-file image-default"><img class="thumb" title="Website" alt="Website" src="'.$url.'/themes/seasons/img/website.jpg"></div>';
                }
                elseif($type == 'Lesson Plan') {
                    if($item->getItemType()->name == 'World War One Veterans')
                        echo '<div class="item-file image-default"><img class="thumb" title="" alt="" src="'.$url.'/themes/seasons/img/solder-silhouette.jpg"></div>';
                    else
                    echo '<div class="item-file image-default"><img class="thumb" title="Lesson" alt="Lesson" src="'.$url.'/themes/seasons/img/lesson.jpg"></div>';
                }
                elseif($type == 'Event') {
                    if($item->getItemType()->name == 'World War One Veterans')
                        echo '<div class="item-file image-default"><img class="thumb" title="" alt="" src="'.$url.'/themes/seasons/img/solder-silhouette.jpg"></div>';
                    else
                    echo '<div class="item-file image-default"><img class="thumb" title="Event" alt="Event" src="'.$url.'/themes/seasons/img/event.jpg"></div>';
                }
                else {
                    if($item->getItemType()->name == 'World War One Veterans')
                        echo '<div class="item-file image-default"><img class="thumb" title="" alt="" src="'.$url.'/themes/seasons/img/solder-silhouette.jpg"></div>';
                    else
                    echo '<div class="item-file image-default"><img class="thumb" title="" alt="" src="'.$url.'/themes/seasons/img/article.jpg"></div>';
                }
                ?>

                <?php if (metadata('item', 'has thumbnail')): ?>
                       
                    <?php //echo link_to_item(item_image('square_thumbnail')); ?>
                
                <?php endif; ?>
            </div>
            
            <h2 class="item_title t3"><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title'), array('snippet'=>50)), array('class'=>'permalink')); ?></h2>
            <div class="item-meta">                

            <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
            <div class="item-description">
                <?php echo $description; ?>
            </div>
            <?php endif; ?>

            <?php if (metadata('item', 'has tags')): ?>
            <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
                <?php echo tag_string('items'); ?></p>
            </div>
            <?php endif; ?>

            <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

            </div>
            
        </div>
        
        <?php endforeach; ?>

    </div>



    <?php echo pagination_links(); ?>

    <?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

    <?php echo foot(); ?>

</div>