<?php echo head(array('bodyid'=>'home', 'bodyclass'=>'home')); ?>

<div class="section section--brown">

    <div class="l-wrap">

        <section class="slider">
            <center><h1 class="title-ribbon">Featured Item/Collection</h1></center>
            <?php if (get_theme_option('Display Featured Item') !== '0'): ?>
                <?php echo  custom_random_featured(); ?>
            <?php endif; ?>

        </section>
        <section class="featured-collection">
             <div id="wrapper">
             <?php // timeBasePhotoGallery(); ?>
            <div id="header">
              <h1>Exploring the Wyndham Local Studies Image Library <div id="nav">View by: <a href="#title">Title</a> | <a href="#decade" >Decade</a></div></h1>
            </div>
            <div id="container" class="loading"></div>
            <div id="footer"> <a href="index.html">About this project</a> | Images are copyright Wyndham Library, used with permission. </div>
          </div>

        </section>
        
        <?php if (get_theme_option('Display Featured Collection') !== '0'): ?>
        <!-- Featured Collection -->
        <div id="featured-collection">
            <h2><?php echo __('Featured Collection'); ?></h2>
            <?php echo random_featured_collection(); ?>
        </div><!-- end featured collection -->
        <?php endif; ?>

        <?php if ((get_theme_option('Display Featured Exhibit') !== '0')
                && plugin_is_active('ExhibitBuilder')
                && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
        <!-- Featured Exhibit -->
        <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
       

        <div id="recent-items">
            <h2><?php echo __('Recently Added Items'); ?></h2>

            <?php
            $homepageRecentItems = (int)get_theme_option('Homepage Recent Items') ? get_theme_option('Homepage Recent Items') : '3';
            set_loop_records('items', get_recent_items($homepageRecentItems));
            if (has_loop_records('items')):
            ?>

            <div class="items-list">
                <?php foreach (loop('items') as $item): ?>
                <div class="item">

                    <h3><?php echo link_to_item(); ?></h3>

                    <?php if (metadata('item', 'has thumbnail')): ?>
                    <div class="item-img">
                        <?php echo link_to_item(item_image('square_thumbnail')); ?>
                    </div>
                    <?php endif; ?>

                    <?php if($desc = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>150))): ?>

                    <div class="item-description"><?php echo $desc; ?><?php echo link_to_item('see more',(array('class'=>'show'))) ?></div>

                    <?php endif; ?>

                </div>
                <?php endforeach; ?>
            </div>

            <?php else: ?>

            <p><?php echo __('No recent items available.'); ?></p>

            <?php endif; ?>

            <p class="view-items-link"><a href="<?php echo html_escape(url('items')); ?>"><?php echo __('View All Items'); ?></a></p>

        </div><!--end recent-items -->

         <?php endif; ?>
    </div>
</div>

<div class="section l-flow-normal">
    <div class="l-wrap">
    <div class="t-content">
        <ul class="" id="f-links">

            <li class="c-links c-links--1">
                <a href="contribution">tell your stories</a>
            </li>
            <li class="c-links c-links--2 c-last">
                <a href="classroom">classroom</a>
            </li>
            <li class="c-links c-links--3">
                <a href="exhibits">Exhibits</a>
            </li>
            <li class="c-links c-links--4 c-last">
                <a href="discover">discover</a>
            </li>
        </ul>

        <ul class="" id="f-links-responsive">

            <li>
                <a href="contribution">tell your stories</a>
            </li>
            <li class="c-last">
                <a href="classroom">classroom</a>
            </li>
            <li>
                <a href="exhibits">Exhibits</a>
            </li>
            <li class="c-last">
                <a href="discover">discover</a>
            </li>
        </ul>
        <div style="clear:both"></div>
    </div>
    <div class="clear-responsive"></div>
    <aside class="t-sidebar">
        <div class="section section--about">  
            <?php if (get_theme_option('Homepage Text')): ?>
            <p><?php echo get_theme_option('Homepage Text'); ?></p>
            <a href="/neatline/show/truganina-state-school" class="button button--blue">Find out more</a>
            <?php endif; ?>
        </div>     
    </aside>
    </div>
</div>

<?php fire_plugin_hook('public_home', array('view' => $this)); ?>

<?php echo foot(); ?>