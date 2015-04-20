</div><!-- end content -->
<div style="clear:both"></div>

<footer class="t-footer section section--type-brown">
    <div class="l-wrap">
        <div class="l-columns-3">
            
            <div class="branding branding--footer">
                <img class="" src="http://wyndhamhistory.net.au/themes/seasons/img/site-illustration_small.png">
            </div>

            <a href="#" class="branding--featured">
                <img src="http://wyndhamhistory.net.au/themes/seasons/img/branding-footer.png">
            </a>

            

        </div>

        <div class="l-columns-9 omega t-footer-right">
            <div class="widget widget--links l-columns-4">
                <h3 class="widget__title t6">CONNECT WITH US</h3>
                <div class="widget__core">
                    <?php echo nav(array(
                            array('label' => 'About', 'uri' => url('about'), 'class' => '' ),
                            array('label' => 'Contact Us', 'uri' => url('contact'))
                        ));
                    ?>
                </div>
            </div>
            <div class="widget widget--links l-columns-4">
                <h3 class="widget__title t6">USING THE SITE</h3>
                <ul class="widget__core">
                    <?php echo nav(array(
                            array('label' => 'FAQs', 'uri' => url('faq'), 'class' => '' ),
                            array('label' => 'Tutorials', 'uri' => url('tutorials')),
							array('label' => 'Licensing', 'uri' => url('licensing-your-material')),
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
        
    </div>

    <p class="copyright"><?php echo '&copy; 2013 Wyndhamcity Council | Website Design by <a href="http://lightmedia.com.au/" target="_BLANK">Light Media</a>' //$copyright; ?></p>

    <?php fire_plugin_hook('public_footer'); ?>
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46142070-1', 'wyndhamhistory.net.au');
  ga('send', 'pageview');

</script>
</body>

</html>
