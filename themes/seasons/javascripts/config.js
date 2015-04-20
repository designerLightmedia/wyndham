var wyndhman = {
    Global: {
        init: function () {
          var e = this;

            this.polyfillPlaceholders();
            this.menuLinksIcons();            
            this.sliderSettings();   
            this.faqDropdown();   
            this.fLinks();   
            this.toggleSlide();   
        },
        fLinks: function () {
            jQuery("#f-links li:first-child").addClass('active');

            jQuery("#f-links li").hover(
              function () {
                jQuery("#f-links li").removeClass('active');  
                jQuery(this).addClass('active');
              }              
            ); 

            jQuery("#f-links li:first-child").hover(
              function () {
                jQuery("#f-links").removeAttr("class");
                jQuery("#f-links").addClass("one-hover");
              }
            ); 

            jQuery("#f-links li:nth-child(2)").hover(
               function () {
                jQuery("#f-links").removeAttr("class");
                jQuery("#f-links").addClass("two-hover");
                 }
            ); 

            jQuery("#f-links li:nth-child(3)").hover(
               function () {
                jQuery("#f-links").removeAttr("class");
                jQuery("#f-links").addClass("three-hover");
                 }
            ); 

            jQuery("#f-links li:last-child").hover(
               function () {
                jQuery("#f-links").removeAttr("class");
                jQuery("#f-links").addClass("four-hover");
                 }
            );

            jQuery("body").addClass('page');  

            jQuery("#sort-links-list li.sorting a").click(function(e) {
              e.preventDefault();
              
                jQuery("#sort-links-list").toggleClass("clicked");              
            });
        },
        polyfillPlaceholders: function () {

        },
        menuLinksIcons: function() {
            jQuery(".menu-left .navigation li:first-child a").prepend("<i class='icon-stories'></i>");
            jQuery(".menu-left .navigation li:last-child a").prepend("<i class='icon-room'></i>");

            jQuery(".menu-right .navigation li:first a").prepend("<i class='icon-history'></i>");
            jQuery(".menu-right .navigation li:last-child a").prepend("<i class='icon-exhibits'></i>");
        },
        sliderSettings: function() {
          jQuery('.flexslider').flexslider({
            controlNav: false,
            animation: "slide",
            slideshowSpeed: 13000,
            start: function(slider){
              jQuery('body').removeClass('loading');
            }
          });
        },
        faqDropdown: function() {
          jQuery(document).ready(function(){
            dynamicFaq();
          });

          function dynamicFaq(){
            jQuery('dd').hide();
            jQuery('dt').bind('click', function(){
              jQuery(this).toggleClass('open').next().slideToggle();;
            });
          }
        },

          toggleSlide: function() {
           jQuery( ".toggle-trigger" ).click(function(e) {
              jQuery( ".toggle-content" ).toggleClass( "open" );
              jQuery( ".toggle-actions" ).toggleClass( "open" );
              e.preventDefault();
            });
        }
    },
    Front: {
      init: function () {

      }
    }
}