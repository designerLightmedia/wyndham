<?php
$title = __('Browse Exhibits');
echo head(array('title' => $title, 'bodyclass' => 'exhibits browse'));
?>
<div class="section section--brown">
    <div class="l-wrap">
        <div class="site-title t-left">
            <h1><?php echo $title; ?> </h1>
            <span class="title-desc"><?php echo __('Total Exhibit(s) : %s', $total_results); ?></span>
        </div>
        <div class="t-right">
            <div class="search search--spread">
               <?php echo search_form(array('show_advanced' => true)); ?>               
            </div>
        </div>
    </div>
</div>

<div class="l-wrap">
<?php if (count($exhibits) > 0): ?>

    <nav class="items-nav navigation secondary-nav" id="secondary-nav">
        <?php echo nav(array(
            array(
                'label' => __('Browse All'),
                'uri' => url('exhibits')
            ),
            array(
                'label' => __('Browse by Tag'),
                'uri' => url('exhibits/tags')
            )
        )); ?>
    </nav>
    
    <?php echo pagination_links(); ?>
    
    <?php $exhibitCount = 0; ?>
    <div class="item-list">
		<?php foreach (loop('exhibit') as $exhibit): ?>
            <?php $exhibitCount++; ?>
            <div class="item item--spread hentry exhibit <?php if ($exhibitCount%2==1) echo ' even'; else echo ' odd'; ?>">
                <h2><?php echo link_to_exhibit(); ?></h2>
                <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
                <div class="description"><?php echo $exhibitDescription; ?></div>
                <?php endif; ?>
                <?php if ($exhibitTags = tag_string('exhibit', 'exhibits')): ?>
                <p class="tags"><?php echo $exhibitTags; ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
	</div>
    
    <?php echo pagination_links(); ?>
    
    <?php else: ?>
    <p><?php echo __('There are no exhibits available yet.'); ?></p>
    <?php endif; ?>
    
    <?php echo foot(); ?>
</div>
