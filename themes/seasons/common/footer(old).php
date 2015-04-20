</div><!-- end content -->
<div style="clear:both"></div>

<footer class="t-footer section section--type-brown">
    <div class="l-wrap">
        <div class="l-columns-3">
            
            <div class="branding branding--footer">
                <img class="" src="http://111.67.16.174/~wyndh1/themes/seasons/img/site-illustration_small.png">
            </div>

            <a href="#" class="branding--featured">
                <img src="http://111.67.16.174/~wyndh1/themes/seasons/img/branding-footer.png">
            </a>

            <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
                <p class="copyright"><?php echo $copyright; ?></p>
            <?php endif; ?>

        </div>

        <div class="l-columns-9 omega t-footer-right">
            <div class="widget widget--links l-columns-4">
                <h3 class="widget__title t6">CONNECT WITH US</h3>
                <div class="widget__core">
                    <?php echo nav(array(
                            array('label' => 'About', 'uri' => url('about'), 'class' => '' ),
                            array('label' => 'FAQs', 'uri' => url('faqs')),
                            array('label' => 'Using this site', 'uri' => url('using-this-site')),
                            array('label' => 'Contact Us', 'uri' => url('contact'))
                        ));
                    ?>
                </div>
            </div>
            <div class="widget widget--links l-columns-4">
                <h3 class="widget__title t6">USING THE SITE</h3>
                <ul class="widget__core">
                    <?php echo nav(array(
                            array('label' => 'About', 'uri' => url('about'), 'class' => '' ),
                            array('label' => 'FAQs', 'uri' => url('faqs')),
                            array('label' => 'Contact', 'uri' => url('contact'))
                        ));
                    ?>
                </ul>
            </div>
            <div class="widget widget--links l-columns-4 omega">
                <h3 class="widget__title t6">LINKS</h3>
                <ul class="widget__core">
                    <?php echo nav(array(
                            array('label' => 'Wyndham Library Service', 'uri' => ('http://www.wyndham.vic.gov.au/libraries'), 'class' => '' ),
                            array('label' => 'Werribee Historical Society', 'uri' => ('http://www.werribeehistory.org.au/')),
                            array('label' => 'Trove', 'uri' => ('http://trove.nla.gov.au/'))
                        ));
                    ?>
                </ul>
            </div>
        </div>
        
        <?php fire_plugin_hook('public_footer'); ?>
    </div>
</footer>
<script>
jQuery('#responsive-menu-show').click(function (){
	if( jQuery('.responsive-menu ul').hasClass('open') ) {
		jQuery('.responsive-menu ul').slideUp('fast');
		jQuery('.responsive-menu ul').removeClass('open');
	}
	else {
		jQuery('.responsive-menu ul').slideDown('fast');
		jQuery('.responsive-menu ul').addClass('open');
	}
	return false;
});
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Seasons.showAdvancedForm();
        Seasons.mobileSelectNav();
        wyndhman.Global.init(); 
    });
</script>

</body>

</html>
