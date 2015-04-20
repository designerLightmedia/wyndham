<!DOCTYPE html>
<html lang="en-us">
<head>
<title><?php echo settings('site_title'); echo $title ? ' | ' . strip_formatting($title) : ''; ?></title>

<!-- Meta -->
<meta charset="utf-8" />
<meta name="description" content="<?php echo settings('description'); ?>" />

<?php echo auto_discovery_link_tag(); ?>

<!-- Plugin Stuff -->
<?php plugin_header(); ?>

<!-- Stylesheets -->
<?php
queue_css(array('screen', 'formalize'), 'screen');
queue_css('print', 'print');
display_css();
?>
<?php griddy_custom_background(); ?>

<!-- JavaScripts -->
<?php 
queue_js('jquery.formalize'); 
display_js();
?>

</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>

<?php plugin_body(); ?>

<div id="wrap">

	<div id="header">
		<?php plugin_page_header(); ?>	
		<div id="search-wrap">
			<?php echo link_to_advanced_search(); ?>
			<?php echo simple_search(); ?>
		</div><!-- end search -->
	    
		<div id="site-title"><?php echo link_to_home_page(); ?></div>
		
	</div><!-- end header -->
	
	<div id="primary-nav">
		<ul class="navigation">
		<?php echo public_nav_main(array('Home' => uri(''), 'Browse Items' => uri('items'), 'Browse Collections'=>uri('collections'))); ?>
		</ul>
	</div><!-- end primary-nav -->

<div id="content">
<?php plugin_page_content(); ?>