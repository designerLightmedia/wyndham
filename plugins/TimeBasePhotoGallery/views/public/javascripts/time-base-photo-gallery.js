var maxloads = 10000; // max num images to load
var loadcount = 0;
var thumbprefix = "http://wyndham2015.lmweb.com.au/files/thumbnails/";
var bigprefix = "http://wyndham2015.lmweb.com.au/files/original/";

var $decades;
var $titles;

var displaymode = "title";

var loaded = false;


(function() {
  


  //Harvester 
  var page = 0;
  var maxpages = 0;
  var pagelen = 100; // records per page
  var objWorkmap = {};
  var prevZone = '';
  var nulldatecount = 0;
  var titleyrcount = 0;
  var apikey = '1sn9tumidclks8vs';
  var thumbprefix = "http://www.wyndhamhistory.net.au/files/original/";
  var troveUrl = "http://api.trove.nla.gov.au/result?key="+ apikey +"&q=nuc%3AVWYN+\"wyndhamhistory\"&encoding=json";


  var Gallery = {
    init: function () {
      var self = this;
      $(window).hashchange(function(){
        if (location.hash == "") return;
        if (location.hash == "#title") self.buildTitleView();
        if (location.hash == "#decade") self.buildDecadeView();
      });

      if (location.hash != ""){
        $(window).hashchange();
      }  else {
        self.buildTitleView();
      }

    },
    loadWorks: function (buildfn){ // for loading from JSON
        
        workmap = objWorkmap;
        items = Object.keys(workmap);
        loaded = true;
        buildfn();
    },
    buildDecadeView: function (){

      if (!loaded){
        this.loadWorks(this.buildDecadeView);
        return;
      }
     if (displaymode == "decade") return;

      rotateBgInterval = 3000;
      rotatedClusters = [];
      clearInterval(rotateBg);
      
      if ($titles == undefined && $('#container').children().length > 0){
      
        $titles = $('#container').children('.clusterdiv').clone(true); // clone the div and store it
        $('#container').empty();
      
      }
      
      if ($decades == undefined){
      
        buildDecadeHisto();
      
      } else {

        $('#container').empty();
        $('#container').append($decades); // add the stored DOM elements

      }
      
      rotateBg = setInterval(function () { 
        rotateBackground(decadeclusters);
        }, rotateBgInterval);

      displaymode = "decade";
      //$('#container').fadeIn();
    },
    buildTitleView: function() {
      if (!loaded){
        this.loadWorks(this.buildTitleView);
        return;
      }

      if (displaymode == "title" && $('#container').children().length > 0) return;

      rotateBgInterval = 500;
      rotatedClusters = [];
      clearInterval(rotateBg);

      if ($decades == undefined && $('#container').children().length > 0){
        $decades = $('#container').children('.clusterdiv').clone(true); // clone the div and store it
        //clustercache = clusters.slice(0); // grab a copy of the clusters
    
        $('.clusterdiv').fadeOut(1000,function(){
          console.log("emptying container");
            $('#container').empty();
            // $('#container').show();
            $('#container').addClass("loading");
            setupClusters();
          });
      }

      if ($titles != undefined){
        
        $('#container').empty(); 
        $('#container').append($titles); // add the stored DOM elements

      } else {
         setupClusters();
      }

      rotateBg = setInterval(function () { 

        rotateBackground(titleclusters);

      }, rotateBgInterval);

      displaymode = "title";
    }
  }




  var Harvester = {
    init: function() {
      this.loadXml();
    },
    zone: function(zones, index) {
      

      if (index >= zones.length) {
        Gallery.init();
        return;
      }

      var xhrs = [];

      var xhr = Harvester.loadIterate(zones, index);
      xhrs.push(xhr);

      $.when.apply($, xhrs).done(function() {

        if (page == maxpages) {
          page = 0;
          maxpages = 0;
          Harvester.zone(zones, ++index);
        }

      });

      

        

    },
    loadXml: function () {

      var url = troveUrl + "&zone=all";

      $.get(url, function(data) {

       
        var zones = data.response.zone;
        
        Harvester.zone(zones, 0);

      }, 'jsonp');

    },
    loadIterate: function (zoneStr, index){// load from Trove

      console.log(zoneStr[index].name + " loading page " + page + " of " + maxpages);
      var url = troveUrl + "&zone="+ zoneStr[index].name +"&n=100&encoding=json&s=" + page*pagelen;
      var dfd = $.Deferred();

      $.get(url, function(data) {

     
        var zone = data.response.zone[0];
                 
          if ( page == 0 ){
          
            maxpages = Math.floor(parseInt(zone.records.total) / pagelen) + 1; 
          }

          Harvester.parseWorks(zone);

          page++;

          dfd.resolve();
          dfd.promise();

          if (page < maxpages) Harvester.loadIterate(zoneStr, index);
          else if (page >= maxpages && maxpages !=0) {
            page = 0;
            maxpages = 0;
            Harvester.zone(zoneStr, ++index);
          }
          
      }, 'jsonp');

      return dfd;

   
    },
    parseWorks: function (works){ 

      if (typeof works.records.work != 'undefined') {
        $.each(works.records.work, function(i, work) {
          
          var thumburl = '';

          if (typeof work.identifier != 'undefined' && work.identifier.length) {
            var len = work.identifier.length;

            for (var i = 0; i < len; i++) {
              if (work.identifier[i].linktype == 'thumbnail') {
                thumburl = work.identifier[i].value
              } 
            }
            
          } 

          var id = work.id;
          var title = work.title;
          var issued = work.issued;

         var firstyrissued = String(issued).match(/(17|18|19|20)\d{2}/g);
          var yr;
          // TODO - change to title date taking priority? cf http://www.photosau.com/Manly/scripts/ExtSearch.asp?SearchTerm=006674
          if (firstyrissued == null) { // no year in the data, is there one in the title?
            nulldatecount ++;
            var yrintitle = title.match(/(17|18|19|20)\d{2}/g);
            if (yrintitle != null){
              yr = yrintitle[0];
              titleyrcount++;
            } else {
              yr = 0;
            }
          } else {
            yr = firstyrissued[0];
          }

          
          


          var workobj = {id:id, title:title, year:yr, thumb:thumburl.replace(thumbprefix,"")};
          objWorkmap[''+id] = workobj; // stash the work in the array
          
        });
      }

    }
  }

  Harvester.init();

})();