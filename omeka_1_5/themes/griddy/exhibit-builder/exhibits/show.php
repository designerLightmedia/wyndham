<?php head(array('title' => html_escape(exhibit('title') . ' : '. exhibit_page('title')), 'bodyid'=>'exhibit','bodyclass'=>'show')); ?>

<div class="secondary-nav exhibit">
	<?php echo exhibit_builder_page_nav();?>
</div>

<h1><?php echo link_to_exhibit(); ?></h1>

<div id="section-nav"><?php echo exhibit_builder_section_nav();?></div>

<div id="primary" class="exhibit matted">

	<h2><?php echo exhibit_page('title'); ?></h2>
	
	<?php exhibit_builder_render_exhibit_page(); ?>
	
</div>	

	<div id="exhibit-page-navigation" class="secondary-nav bottom">
	   	<span><?php echo exhibit_builder_link_to_previous_exhibit_page(); ?></span>
    	<span><?php echo exhibit_builder_link_to_next_exhibit_page(); ?></span>
	</div>
	
<?php foot(); ?>