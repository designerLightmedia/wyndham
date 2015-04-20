<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>

<div class="section section--brown">
    <div class="l-wrap">
        <div class="site-title t-left">
            <h1><?php echo metadata('exhibit', 'title'); ?></h1>
        </div>
        <div class="t-right">
            <div class="search search--spread">
               <?php echo search_form(array('show_advanced' => true)); ?>               
            </div>
        </div>
    </div>
</div>

<?php echo exhibit_builder_page_nav(); ?>

<div class="l-wrap">
    <div id="primary">
        <div class="element-set">
        <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
        <h2 class="element-set_title">Exhibit Type Metadata</h2>
        <div class="exhibit-description">
        	<p class="align-left">Text:</p>
            <div class="exhibit-descr">
	            <?php echo $exhibitDescription; ?>
            </div>
            <div class="clear"></div>
        </div>
        <?php endif; ?>
        
        <?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
        <div class="exhibit-credits">
            <p class="align-left"><?php echo __('Credits:'); ?></p>
            <div class="exhibit-cred">
	            <p><?php echo $exhibitCredits; ?></p>
            </div>
            <div class="clear"></div>
        </div>
        <?php endif; ?>
        </div>
        
        <nav id="exhibit-pages">
            <ul>
                <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
                <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
                <?php echo exhibit_builder_page_summary($exhibitPage); ?>
                <?php endforeach; ?>
            </ul>
        </nav>
        
    </div>
    
</div>

<?php echo foot(); ?>
