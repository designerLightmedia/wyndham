//jQuery.noConflict();
	
var wyndhman = {
   	Global: {
        init: function () {
        	var e = this;
            this.polyfillPlaceholders();
            this.menuLinksIcons();
            this.homepageslider();
        },
        polyfillPlaceholders: function () {}
        ,
        menuLinksIcons: function() {
          jQuery("li.nav-tell-your-stories a").prepend("<i class='icon-stories'></i>");
          jQuery("li.nav-class-room a").prepend("<i class='icon-room'></i>");
          jQuery("li.nav-discover-history a").prepend("<i class='icon-history'></i>");
          jQuery("li.nav-exhibits a").prepend("<i class='icon-exhibits'></i>");
        },
        homepageslider: function() {
          $(window).load(function() {
            $('.flexslider').flexslider({
              slideshowSpeed: 20000;
            });
          });
        }
    },
    Front: {
    	init: function () {

    	}
    }
}