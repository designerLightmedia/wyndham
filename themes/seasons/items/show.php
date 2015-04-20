<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>
<div class="section section--brown">
    <div class="l-wrap">
        <div class="site-title t-left">
            <h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>
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

   

  <?php if($item->getItemType()->name == 'World War One Veterans'): ?>

        <div class="l-left">
            <div class="avatar-wrapper">
              <?php if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')): ?>
                <?php 
                    $files = $item->Files;
                    $firstFile = $files[0];
                    //echo $firstFile;
                    echo files_for_item(array('imageSize' => 'fullsize')); 
                ?>
                <?php else: ?>
                    <img src="/themes/seasons/img/solder-silhouette.jpg" alt="">
                <?php endif; ?>
            </div>

            <div class="l-sidebar">
              <div class="element-set">
                  <div class="element-set_body">

                     <?php
                            $item_list = array('Name', 'Birth Date', 'Birthplace', 'Service Number', 'Enlistment Date', 'Next of Kin', 'Address at time of Enlistment', 'Occupation', 'Marital Status','Death Date', 'Place of Burial' );
                            foreach ($item_list as $item) 
                            {
                                $item_value = metadata('items', array('Item Type Metadata', $item));
                                if($item_value)
                                {
                                    echo '<span class="element-title">'.$item.'</span>';
                                    echo '<p>'.$item_value.'</p>';
                                }

                            }
                        ?>

                  </div>
              </div>
       </div>

       
        </div>

       <div class="l-right">

        <div class="primary-content">
            <div class="element-set">
                <div class="element-set_body">

                    <div class="toggle-content">
                        
                    <?php
                        $item_list = array('Description', 'Title', 'Subject', 'Creator', 'Source', 'Publisher', 'Date', 'Contributor', 'Rights', 'Relation', 'Format', 'Language', 'Type', 'Identifier');
                        foreach ($item_list as $item) 
                        {
                            $item_value = metadata('items', array('Dublin Core', $item));
                            if($item_value)
                            {
                                echo '<span class="element-title">'.$item.'</span>';
                                echo '<p>'.$item_value.'</p>';
                            }

                        }
                    ?>
                         <div class="toggle-footer toggle-actions">
                          <a id="toggle-action-open" class="toggle-trigger" href="#">Open</a>
                          <a id="toggle-action-close" class="toggle-trigger" href="#">Close</a>
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
    

       <div class="l-content">
            <div class="element-set">
                <div class="element-set_body">
                      <span class="element-title">Biographical Text</span>
                      <p><?php echo metadata('items', array('Item Type Metadata', 'Biographical Text')); ?></p>
                </div>
            </div>
       </div>
       </div>
    <?php else: ?>
        <?php echo all_element_texts('item', array('show_element_sets' => array('Dublin Core', 'Item Type Elements'))); ?>  
    <?php endif; ?>

</div><!-- end primary -->

<aside id="sidebar">

    <!-- The following returns all of the files associated with an item. -->
    <?php if ((get_theme_option('Item FileGallery') == 1) && metadata('item', 'has files')): ?>
    <div id="itemfiles" class="element">
        <h2><?php echo __('Files'); ?></h2>
        <?php echo item_image_gallery(); ?>
    </div>
    <?php endif; ?>

    <!-- If the item belongs to a collection, the following creates a link to that collection. -->
    <?php if (metadata('item', 'Collection Name')): ?>
    <div id="collection" class="element">
        <h2><?php echo __('Collection'); ?></h2>
        <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
    </div>
    <?php endif; ?>

    <!-- The following prints a list of all tags associated with the item -->
    <?php if (metadata('item', 'has tags')): ?>
    <div id="item-tags" class="element">
        <h2><?php echo __('Tags'); ?></h2>
        <div class="element-text"><?php echo tag_string('item'); ?></div>
    </div>
    <?php endif;?>

    <?php if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')): ?>
    <?php echo files_for_item(array('imageSize' => 'fullsize')); ?>
    <?php endif; ?>
    <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h2><?php echo __('Citation'); ?></h2>
        <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
    </div>

</aside>

	<div class="form--control">
     <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>   
    </div>

<ul class="item-pagination navigation">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>

<?php echo foot(); ?>

</div>
