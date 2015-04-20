function loopThroughDiv(item_1,item_2) {
	
	// this should print e.g. 1-data.jpg 2-data.jpg
	//alert(item_1+item_2);
								  
								  
								  var folderThumb = 'square_thumbnails';
								  var folderLarge = 'files';
								  //var isThenNowTest = document.getElementById("dublin-core-relation").getElementsByTagName("div")[0].innerHTML;
								  //var relationTxt = /thennow/gi;
								  //var d = isThenNowTest.search(relationTxt);
								  
								  // if we have found the string 'thennow' or 'ThenNow' it will be at position 0 or greater, if not found at all it will be at -1
								  //if(d >= 0) { 
								 
																  imageFilesContainer = document.getElementById("itemfiles"); // global var by default with no var declaration
																  var imageFiles = imageFilesContainer.getElementsByTagName("img");
																  var len = imageFiles.length;
																
																  if(len > 0) {
																
																				  for(var i=0; i<len; i++) {
																				  
																											 if(i == 0) {
																														 
																														 var imageOneThumb = imageFiles[0].src
																														 var imageOneLarge = imageOneThumb.replace("square_thumbnails", folderLarge);
																														 if(document.images) {
																														 img1 = new Image();
																														 img1.src = imageOneLarge;
																														 //alert(img1.width);
																														 }
																														 //window.setTimeout(function() { var img1width = img1.width;  }, 10000);  
																														 
																											 }
																											 
																											 if(i == 1) {
																														 var imageTwoThumb = imageFiles[1].src
																														 var imageTwoLarge = imageTwoThumb.replace("square_thumbnails", folderLarge);
																														 if(document.images) {
																														 img2 = new Image();
																														 img2.src = imageTwoLarge;
																														 																														 window.setTimeout(function() { readyToShow();  }, 10000);
																														 window.setTimeout(function() { readyToShow();  }, 1000);

																														 }
																				                             }
																				  }
																				  
																  
																  }
																  
																  //imageFilesContainer.innerHTML = '';
																  
																  //imageFilesContainer.innerHTML = '<div id="containerThenNow"><div><img src="' + img1.src + '" width="'+img1width+'" /></div><div><img src="' + img2.src + '" width="'+img2width+'" /></div></div>';
																  
																   
																   

                                 // }
								  
								
								  
								  

} 


function readyToShow() {

                imageFilesContainer.innerHTML = '<div id="containerThenNow"><div><img src="' + img1.src + '" /></div><div><img src="' + img2.src + '" /></div></div>';

                // call the jQuery last so as to make sure the new HTML has loaded, otherwise it fails to render images first

                jQuery(function() {
	
					jQuery('#containerThenNow').beforeAfter({imagePath:'http://www.wigpip.com.au/omekawyn/plugins/ThenNowImage/'});
				
				});


}

