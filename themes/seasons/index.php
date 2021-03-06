<?php echo head(array('bodyid'=>'home', 'bodyclass'=>'home')); ?>

<div class="section section--brown">

    <div class="l-wrap">

        <section class="slider">
            <center><h1 class="title-ribbon">Featured Item/Collection</h1></center>
            <?php if (get_theme_option('Display Featured Item') !== '0'): ?>
                <?php echo  custom_random_featured(); ?>
            <?php endif; ?>

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

<div class="section">
    <div class="l-wrap">
        <section class="image-library">
            <div id="wrapper">
                <div class="image-library-heading" id="header">
                    <h2 class="image-library-title">Exploring the Wyndham Local Studies Image Library</h2>
                    <div class="image-library-nav" id="nav">
                        View by: <a class="" href="#title">Title</a> <span>|</span> <a href="#decade" >Decade</a>
                    </div>
                </div>
                <div class="image-library-body loading" id="container"></div>
                <div class="image-library-footer" id="footer"> <a href="index.html">About this project</a> | Images are copyright Wyndham Library, used with permission. </div>
            </div>

        </section>
    </div>
</div>

<?php fire_plugin_hook('public_home', array('view' => $this)); ?>

<?php echo foot(); ?>