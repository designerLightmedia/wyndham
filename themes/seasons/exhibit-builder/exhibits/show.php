<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits show'));
?>

<nav id="exhibit-pages2">
<div class="section section--brown">
    <div class="l-wrap">
        <div class="site-title t-left">
		    <?php echo exhibit_builder_page_nav(); ?>
        </div>
    </div>
</div>
</nav>

<div class="section section--brown">
    <div class="l-wrap">
        <div class="site-title t-left">
			<h1><?php echo metadata('exhibit_page', 'title'); ?></h1>
        </div>
        <div class="t-right">
            <div class="search search--spread">
               <?php echo search_form(array('show_advanced' => true)); ?>               
            </div>
        </div>
    </div>
</div>

<nav id="exhibit-child-pages">
    <?php //echo exhibit_builder_child_page_nav(); ?>
</nav>

<div class="l-wrap">
    <div id="primary">
        <?php exhibit_builder_render_exhibit_page(); ?>
    </div>
    <div id="exhibit-page-navigation">
        <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
        <div id="exhibit-nav-prev">
        <?php echo $prevLink; ?>
        </div>
        <?php endif; ?>
        <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
        <div id="exhibit-nav-next">
        <?php echo $nextLink; ?>
        </div>
        <?php endif; ?>
        <div id="exhibit-nav-up">
        <?php echo exhibit_builder_page_trail(); ?>
        </div>
    </div>

<?php echo foot(); ?>
