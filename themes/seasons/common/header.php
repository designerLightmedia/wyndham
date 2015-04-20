<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>

    <title><?php echo option('site_title'); echo isset($title) ? ' | ' . strip_formatting($title) : ''; ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php
    queue_css_url('http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic');
    queue_css_url('http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic');
    queue_css_file('normalize');
    queue_css_file('style');

    echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php queue_js_file('vendor/modernizr'); ?>
    <?php queue_js_file('vendor/selectivizr'); ?>
    <?php queue_js_file('jquery-extra-selectors'); ?>
    <?php queue_js_file('vendor/respond'); ?>
    <?php queue_js_file('libs/jquery.flexslider-min'); ?>
    <?php queue_js_file('globals'); ?>
    <?php queue_js_file('config'); ?>
    <?php echo head_js(); ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    

        <header class="t-header">

            <div class="l-wrap">
                <div id="site-title" class="branding">
                    <?php echo link_to_home_page(theme_logo()); ?>
                </div>
                    <div class="menu menu-left t-left">
                        <?php                
                            echo nav(array(
                                array('label' => 'Tell Your Stories', 'uri' => url('contribution'), 'class' => 'tell-your-stories' ),
                                array('label' => 'Classroom', 'uri' => url('classroom'), 'class' => 'classroom')
                            ));
                        ?>
                    </div>
                    <div class="menu menu-right t-right">
                        <?php 
                        echo nav(array(
                                /*array('label' => 'Exhibits', 'uri' => url('items/browse/?type=exhibits'), 'class' => 'exhibits'),*/
                                array('label' => 'Exhibits', 'uri' => url('exhibits'), 'class' => 'exhibits'),
                                array('label' => 'Discover History', 'uri' => url('discover'), 'class' => 'discover-history')
                            ));
                        ?>
                    </div>
                <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
	            <div class="clear"></div>
                <a id="responsive-menu-show" href="#">Menu</a>
                <div class="responsive-menu">
					<?php 
                    echo nav(array(
                            array('label' => 'Tell Your Stories', 'uri' => url('contribution')),
                            array('label' => 'Classroom', 'uri' => url('classroom')),
							array('label' => 'Exhibits', 'uri' => url('exhibits')),
                            array('label' => 'Discover History', 'uri' => url('discover'), 'class' => 'last')
                        ));
                    ?>
				</div>
            </div>
        </header>
        
        <div class="l-wrap">
        
        </div>

        <div class="banner">
        	<?php if (isset($bodyclass)): ?>
				<?php if ($bodyclass == 'home'):?>
                    <div class="l-wrap">
                        <div class="search search--main">
                           <?php echo search_form(array('show_advanced' => true)); ?>
                           <div class="clear"></div>
                        </div>
                    </div>
                <?php endif ?> 
			<?php endif; ?>

            <!--<div class="site-illustration"></div>-->
            
        </div>

        <div id="content">