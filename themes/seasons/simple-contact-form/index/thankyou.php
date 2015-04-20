<?php echo head(); ?>
<div class="section section--default">

    <div class="section section--brown">
            <div class="l-wrap">
                <div class="site-title t-left">
				    <h1><?php echo html_escape(get_option('simple_contact_form_contact_page_title')); ?></h1>
                    <span class="title-desc"><p id="simple-pages-breadcrumbs"><?php echo simple_pages_display_breadcrumbs(); ?></p></span>
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
        <h1><?php echo html_escape(get_option('simple_contact_form_thankyou_page_title')); // Not HTML ?></h1>
        <?php echo get_option('simple_contact_form_thankyou_page_message'); // HTML ?>
        </div>
	</div>
</div>      

<?php echo foot(); ?>