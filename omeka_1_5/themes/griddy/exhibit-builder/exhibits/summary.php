<?php head(array('title' => html_escape('Summary of ' . exhibit('title')),'bodyid'=>'exhibit','bodyclass'=>'summary')); ?>

<h1><?php echo link_to_exhibit(); ?></h1>

<div id="section-nav">
<?php echo exhibit_builder_section_nav(); ?>
</div>

<div id="primary" class="exhibit matted">

<h2>Description</h2>
<?php echo exhibit('description'); ?>

<?php if (exhibit('credits')) { ?>
<h2>Credits</h2>
<p><?php echo html_escape(exhibit('credits')); ?></p>
<?php } ?>

<div id="exhibit-sections">	
	<?php set_exhibit_sections_for_loop_by_exhibit(get_current_exhibit()); ?>
	<h2>Sections</h2>
	<?php while(loop_exhibit_sections()): ?>
	<?php if (exhibit_builder_section_has_pages()): ?>
    <h3><a href="<?php echo exhibit_builder_exhibit_uri(get_current_exhibit(), get_current_exhibit_section()); ?>"><?php echo html_escape(exhibit_section('title')); ?></a></h3>
	<?php echo exhibit_section('description'); ?>
	<?php endif; ?>
	<?php endwhile; ?>
</div>
</div>
<?php foot(); ?>