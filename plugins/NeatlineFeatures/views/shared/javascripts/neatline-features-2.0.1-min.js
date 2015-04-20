!function(t,e){t.widget("nlfeatures.nlfeatures",{options:{markup:{toolbar_class:"olControlEditingToolbar",id_prefix:"nlf-"},animation:{fade_duration:500},styles:{default_opacity:.4,default_color:"#ffb80e",select_point_radius:10,select_stroke_color:"#ea3a3a",point_graphic:{normal:e,selected:e}},map:{boundingBox:"90,0,-90,360",center:e,zoom:e,epsg:e,wmsAddress:e,raw_update:e},mode:null,json:null,zoom:null,center:null},_create:function(){this._instantiateOpenLayers(),this._currentVectorLayers=[],this._currentEditItem=null,this._currentEditLayer=null,this.clickedFeature=null,this.idToLayer={},this.requestData=null,"undefined"!=typeof this.options.json&&null!==this.options.json?(this.loadLocalData([this.options.json]),this.setViewport(),"edit"===this.options.mode&&this.editJson(this.options.json,!0)):this.loadData()},_instantiateOpenLayers:function(){OpenLayers.IMAGE_RELOAD_ATTEMTPS=3,OpenLayers.Util.onImageLoadErrorColor="transparent",OpenLayers.ImgPath="http://js.mapbox.com/theme/dark/";var t,n,i=!0;OpenLayers.IMAGE_RELOAD_ATTEMPTS=5,OpenLayers.DOTS_PER_INCH=25.4/.28,format=i?"image/png8":"image/png",this.options.map.boundingBox===e?t=new OpenLayers.Bounds:(n=this.options.map.boundingBox.split(","),t=new OpenLayers.Bounds(parseFloat(n[0]),parseFloat(n[1]),parseFloat(n[2]),parseFloat(n[3])));var o=this.options.map.epsg!==e?this.options.map.epsg[0]:"EPSG:4326",s=[new OpenLayers.Control.Attribution,new OpenLayers.Control.Navigation,new OpenLayers.Control.PanZoomBar];"edit"===this.options.mode&&(s=s.concat([new OpenLayers.Control.MousePosition,new OpenLayers.Control.LayerSwitcher]));var r={controls:s,maxExtent:t,maxResolution:"auto",projection:o,units:"m"};if(this.map=new OpenLayers.Map(this.element.attr("id"),r),this.options.map.wmsAddress!==e?this.baseLayer=new OpenLayers.Layer.WMS(this.options.name,this.options.map.wmsAddress,{LAYERS:this.options.map.layers,STYLES:"",format:"image/jpeg",tiled:!i,tilesOrigin:this.map.maxExtent.left+","+this.map.maxExtent.bottom},{buffer:0,displayOutsideMaxExtent:!0,isBaseLayer:!0}):(this.baseLayers=this._getBaseLayers(),this.baseLayer=this.baseLayers[this.options.base_layer]!==e?this.baseLayers[this.options.base_layer]:this.baseLayers.osm),this.map.addLayers([this.baseLayers.osm,this.baseLayers.gphy,this.baseLayers.gmap,this.baseLayers.ghyb,this.baseLayers.gsat]),this.baseLayers.swc!==e&&this.map.addLayers([this.baseLayers.stn,this.baseLayers.str,this.baseLayers.swc]),this.map.setBaseLayer(this.baseLayer),this.exists(this.options.default_map_bounds)&&(n=this.options.default_map_bounds.split(","),t=new OpenLayers.Bounds(parseFloat(n[0]),parseFloat(n[1]),parseFloat(n[2]),parseFloat(n[3]))),this.options.map.center!==e){var a=this.options.map.zoom===e?3:this.options.map.zoom,l=new OpenLayers.LonLat(this.options.map.center[0],this.options.map.center[1]);this.map.setCenter(l,a)}else this.map.zoomToExtent(t)},_getBaseLayers:function(){var t={};if(t.gphy=new OpenLayers.Layer.Google("Google Physical",{type:google.maps.MapTypeId.TERRAIN}),t.gmap=new OpenLayers.Layer.Google("Google Streets",{numZoomLevels:20}),t.ghyb=new OpenLayers.Layer.Google("Google Hybrid",{type:google.maps.MapTypeId.HYBRID,numZoomLevels:20}),t.gsat=new OpenLayers.Layer.Google("Google Satellite",{type:google.maps.MapTypeId.SATELLITE,numZoomLevels:22}),t.osm=new OpenLayers.Layer.OSM,OpenLayers.Layer.Stamen!==e){var n='Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://creativecommons.org/licenses/by-sa/3.0">CC BY SA</a>.';t.swc=new OpenLayers.Layer.Stamen("Stamen Watercolor",{provider:"watercolor",attribution:n,tileOptions:{crossOriginKeyword:null}}),t.stn=new OpenLayers.Layer.Stamen("Stamen Toner",{provider:"toner",attribution:n,tileOptions:{crossOriginKeyword:null}}),t.str=new OpenLayers.Layer.Stamen("Stamen Terrain",{provider:"terrain",attribution:n,tileOptions:{crossOriginKeyword:null}})}return t},loadData:function(){var n=this;this._resetData(),this.exists(this.requestData)&&this.requestData.abort(),this.options.dataSources!==e&&this.options.dataSources.maps!==e&&(this.requestData=t.ajax({url:this.options.dataSources.map,dataType:"json",success:function(t){n._buildVectorLayers(t),n._addClickControls(),n.exists(n._currentEditItem)&&n.editJson(n._currentEditItem,!0)}}))},loadLocalData:function(t){this._resetData(),this._buildVectorLayers(t),"edit"===this.options.mode&&this._addClickControls()},_resetData:function(){var e=this;this._removeControls(),t.each(this._currentVectorLayers,function(t,n){e.map.removeLayer(n),n.destroy()}),this._currentVectorLayers=[],this.idToLayer={}},_buildVectorLayers:function(n){var i=this,o=!1;this.idToLayer={},this.layerToId={},t.each(n,function(n,s){var r=s.id,a=""!==s.color?s.color:i.options.styles.default_color,l=i._getStyleMap(a),u=new OpenLayers.Layer.Vector(s.title,{styleMap:l});if(null!==s.geo&&s.geo!==e){var d=new OpenLayers.Format.KML,p=d.read(s.geo);if(0===p.length){var h=new OpenLayers.Format.WKT;t.each(s.geo.split("|"),function(t,n){if(h.read(n)!==e){var i=new OpenLayers.Geometry.fromWKT(n),o=new OpenLayers.Feature.Vector(i);p.push(o)}}),o=p.length>0}p.length>0&&u.addFeatures(p)}u.setMap(i.map),i.idToLayer[r]=u,i.layerToId[u.id]=r,i._currentVectorLayers.push(u),i.map.addLayer(u)}),o&&setTimeout(function(){i.element.trigger("refresh.nlfeatures")},250)},selectFeature:function(t){this.isFocusLocked()||(this.modifyFeatures.selectFeature(t),this.clickControl.highlight(t),this.listenToFeature(t),this.clickedFeature=t,this.element.trigger("select.nlfeatures",t))},getFeatureElement:function(e){var n;return n=("#"+e.geometry.id).replace(/\./g,"\\."),t(n)},listenToFeature:function(t){var e,n,i;e=t.id,n=this,i=this.getFeatureElement(t),i.on({mousedown:function(){n.lockFocus(t)},mouseup:function(){n.unlockFocus(t)}})},unlistenToFeature:function(t,n){var i;i=this,(null===n||n===e)&&(n=this.getFeatureElement(t)),n.off("mouseup").off("mousedown")},deselectFeature:function(t,n){(null===t||t===e)&&(t=this.clickedFeature),(!this.isFocusLocked(t)||n)&&(this.clickControl.unhighlight(t),this.modifyFeatures.unselectFeature(t),this.unlistenToFeature(t),this.resetModifyFeatures(),t.nlfeatures&&(t.nlfeatures.focusLocked=!1),t===this.clickedFeature&&(this.clickedFeature=null),this.element.trigger("deselect.nlfeatures",t))},lockFocus:function(t){(null===t||t===e)&&(t=this.clickedFeature),null!==t&&t!==e&&(null===t.nlfeatures||t.nlfeatures===e?t.nlfeatures={focusLocked:!0}:t.nlfeatures.focusLocked=!0)},unlockFocus:function(t){(null===t||t===e)&&(t=this.clickedFeature),null!==t&&t!==e&&null!==t.nlfeatures&&t.nlfeatures!==e&&(t.nlfeatures.focusLocked=!1)},isFocusLocked:function(t){return(null===t||t===e)&&(t=this.clickedFeature),null!==t&&t!==e&&null!==t.nlfeatures&&t.nlfeatures!==e&&t.nlfeatures.focusLocked},_addClickControls:function(){var t=this;this._removeControls(),this.clickControl=new OpenLayers.Control.SelectFeature(this._currentVectorLayers,{hover:!0,highlightOnly:!0,overFeature:function(n){(null===n.geometry.parent||n.geometry.parent===e)&&(t.modifyFeatures!==e&&null!==t.clickedFeature&&t.clickedFeature!==e&&n.id!==t.clickedFeature.id&&t.deselectFeature(),t.modifyFeatures===e||null!==t.clickedFeature&&t.clickedFeature!==e&&n.id===t.clickedFeature.id||t.selectFeature(n))},outFeature:function(){return!1}}),this.map.addControl(this.clickControl),this.clickControl.activate(),this.map.events.register("click",this.map,function(){null!==t.clickedFeature&&t.clickedFeature!==e&&t.deselectFeature(t.clickedFeature,!0)})},_removeControls:function(){this.modifyFeatures!==e&&(this.map.removeControl(this.modifyFeatures),this.modifyFeatures.destroy(),delete this.modifyFeatures),this.editToolbar!==e&&(this.map.removeControl(this.editToolbar),this.editToolbar.destroy(),delete this.editToolbar),this.clickControl!==e&&(this.map.removeControl(this.clickControl),this.clickControl.destroy(),delete this.clickControl),this.highlightControl!==e&&(this.map.removeControl(this.highlightControl),this.highlightControl.destroy(),delete this.highlightControl)},edit:function(t,e){var n={id:t.attr("recordid"),name:t.find("span.item-title-text").text()};this.editJson(n,e)},editJson:function(n,i){var o=this;this.highlightControl!==e&&this.highlightControl.deactivate();var s=n.id;if(this._currentEditLayer=this.idToLayer[s],this._currentEditId=s,this._currentEditItem=n,!this._currentEditLayer){var r=n.name;this._currentEditLayer=new OpenLayers.Layer.Vector(r),this.map.addLayer(this._currentEditLayer),this._currentEditLayer.setMap(this.map),this._currentVectorLayers.push(this._currentEditLayer),this.idToLayer[s]=this._currentEditLayer,this.layerToId[this._currentEditLayer.id]=s}var a=[new OpenLayers.Control.Navigation,new OpenLayers.Control.DrawFeature(this._currentEditLayer,OpenLayers.Handler.Path,{displayClass:"olControlDrawFeaturePath",featureAdded:function(){o.element.trigger("featureadded.nlfeatures")}}),new OpenLayers.Control.DrawFeature(this._currentEditLayer,OpenLayers.Handler.Point,{displayClass:"olControlDrawFeaturePoint",featureAdded:function(){o.element.trigger("featureadded.nlfeatures")}}),new OpenLayers.Control.DrawFeature(this._currentEditLayer,OpenLayers.Handler.Polygon,{displayClass:"olControlDrawFeaturePolygon",featureAdded:function(){o.element.trigger("featureadded.nlfeatures")}})];this.modifyFeatures=new OpenLayers.Control.ModifyFeature(this._currentEditLayer,{onModification:function(){o.element.trigger("featureadded.nlfeatures")},standalone:!0}),this.editToolbar=new OpenLayers.Control.Panel({defaultControl:a[0],displayClass:this.options.markup.toolbar_class}),this.editToolbar.addControls(a),this.map.addControl(this.editToolbar),this.map.addControl(this.modifyFeatures),this.modifyFeatures.activate(),this.element.editfeatures({markup:{id_prefix:this.options.markup.id_prefix}}),this.element.bind({"update.nlfeatures":function(t,e){o.modifyFeatures.mode=OpenLayers.Control.ModifyFeature.RESHAPE,e.rotate&&(o.modifyFeatures.mode|=OpenLayers.Control.ModifyFeature.ROTATE),e.scale&&(o.modifyFeatures.mode|=OpenLayers.Control.ModifyFeature.RESIZE),e.drag&&(o.modifyFeatures.mode|=OpenLayers.Control.ModifyFeature.DRAG),(e.drag||e.rotate)&&(o.modifyFeatures.mode&=-OpenLayers.Control.ModifyFeature.RESHAPE);var n=o.modifyFeatures.feature;o.exists(n)&&(o.modifyFeatures.unselectFeature(n),o.modifyFeatures.selectFeature(n))},"lockfocus.nlfeatures":function(){o.lockFocus()},"unlockfocus.nlfeatures":function(){o.unlockFocus()},"delete.nlfeatures":function(){if(o.modifyFeatures.feature){var t=o.modifyFeatures.feature;o.clickedFeature=null,o.modifyFeatures.unselectFeature(t),o._currentEditLayer.destroyFeatures([t])}}}),i?t("."+this.options.markup.toolbar_class).css("opacity",1):(this.element.editfeatures("showButtons",i),t("."+this.options.markup.toolbar_class).animate({opacity:1},this.options.animation.fade_duration)),this.options.map.raw_update!==e&&(this.options.map.raw_update,this.element.bind({"featureadded.nlfeatures":function(){o.updateRaw()},"update.nlfeatures":function(){o.updateRaw()},"delete.nlfeatures":function(){o.updateRaw()}}));var l=!1;t.each(this._currentEditLayer.features,function(t,e){e==o.clickedFeature&&(l=!0)}),l&&this.modifyFeatures.selectFeature(this.clickedFeature)},resetModifyFeatures:function(){this.modifyFeatures.mode=OpenLayers.Control.ModifyFeature.RESHAPE},editJsonItem:function(t){this.loadLocalData([t]),this.setViewport(),this.editJson(t,!0)},setViewport:function(){this.viewportOptionsValid()?this._setViewportFromOptions():this._setViewportFromData()},viewportOptionsValid:function(){var t=!0;return t=t&&null!==this.options.zoom&&this.options.zoom,t=t&&this.options.zoom>0,t=t&&null!==this.options.center&&this.options.center!==e,t=t&&null!==this.options.center.lon&&this.options.center.lon!==e,t=t&&null!==this.options.center.lat&&this.options.center.lat!==e,t=t&&!isNaN(parseFloat(this.options.center.lon)),t=t&&!isNaN(parseFloat(this.options.center.lat))},_setViewportFromOptions:function(){var t,n,i=this.options.zoom,o=this.options.center,s=new OpenLayers.LonLat(o.lon,o.lat);null!==o.srs&&o.srs!==e&&(n=new OpenLayers.Projection(o.srs),t=this.map.getProjectionObject(),s=s.transform(n,t)),this.map.setCenter(s,i,!1,!1)},_setViewportFromData:function(){var t,e,n,i,o,s,r,a,l,u;for(t=this,l=new OpenLayers.Bounds,e=0,i=this._currentVectorLayers.length,n=0;i>n;n++)for(o=this._currentVectorLayers[n],r=o.features.length,s=0;r>s;s++)e++,a=o.features[s].geometry,l.extend(a.getBounds());0===e?(u=new OpenLayers.Control.Geolocate({bind:!0,watch:!1}),u.events.on({locationfailed:function(){t.map.setCenter(new OpenLayers.LonLat(-8738850.21367,4584105.47978),3,!1,!1)}}),this.map.addControl(u),this.map.zoomTo(3),u.activate()):this.map.zoomToExtent(l,!1)},updateRaw:function(){var t=this.options.map.raw_update;if(this.exists(t)){var e=this.getWktForSave();e=e.replace(/\|/g,"|\n"),t.val(e)}},endEditWithoutSave:function(e,n){var i=t("."+this.options.markup.toolbar_class).clone();this.modifyFeatures.unselectFeature(this.clickedFeature),this.map.removeControl(this.modifyFeatures),this.map.removeControl(this.editToolbar),n||(this.element.editfeatures("hideButtons"),this.element.append(i),i.animate({opacity:0},this.options.animation.fade_duration,function(){i.remove()})),this._addClickControls(),0===this._currentEditLayer.features.length&&(this.map.removeLayer(this._currentEditLayer),this._currentVectorLayers.remove(this._currentEditLayer),delete this.idToLayer[e],delete this.layerToId[this._currentEditLayer.id],this._currentEditLayer=null),this._currentEditItem=null},getBaseLayerCode:function(){var t,e,n,i,o,s;for(s=this.map.baseLayer.name,n=null,i=["osm","gphy","gmap","ghyb","gsat","swc","stn","str"],o=0,e=i.length;e>o;o++)if(t=i[o],s===this.baseLayers[t].name){n=t;break}return n},getWktForSave:function(){var t=[];return this._getFeatures(function(e,n){t.push(n.geometry.toString())}),t.join("|")},getKml:function(){var t=new OpenLayers.Format.KML,e=[];return this._getFeatures(function(t,n){e.push(n)}),t.write(e)},_getFeatures:function(e){var n=this.exists(this.clickedFeature);n&&this.modifyFeatures.unselectFeature(this.clickedFeature),t.each(this._currentEditLayer.features,e),n&&this.modifyFeatures.selectFeature(this.clickedFeature)},getExtentForSave:function(){return this.map.getExtent().toString()},getZoomForSave:function(){return this.map.getZoom()},zoomToItemVectors:function(t){var e=this.idToLayer[t];this.exists(e)&&e.features.length>0&&this.map.zoomToExtent(e.getDataExtent())},_getStyleMap:function(t){return new OpenLayers.StyleMap({"default":new OpenLayers.Style({fillColor:t,fillOpacity:this.options.styles.default_opacity,strokeColor:t,strokeWidth:1,pointRadius:10}),select:new OpenLayers.Style({fillColor:t,fillOpacity:this.options.styles.default_opacity,strokeColor:this.options.styles.select_stroke_color,strokeWidth:2,pointRadius:10})})},setItemColor:function(t){this._currentEditLayer.styleMap=this._getStyleMap(t),this._currentEditLayer.redraw()},getCenterLonLat:function(){var t=new OpenLayers.Projection("EPSG:4326"),e=this.map.getProjectionObject();return this.map.getCenter().transform(e,t)},setCenterLonLat:function(t,e){var n=new OpenLayers.LonLat(t,e),i=new OpenLayers.Projection("EPSG:4326"),o=this.map.getProjectionObject();return this.map.panTo(n.transform(i,o))},setZoom:function(t){return this.map.zoomTo(t)},hasPoint:function(){return this.hasFeature("OpenLayers.Geometry.Point")},hasLine:function(){return this.hasFeature("OpenLayers.Geometry.LineString")},hasPolygon:function(){return this.hasFeature("OpenLayers.Geometry.Polygon")},hasFeature:function(e){return result=!1,t.each(this._currentVectorLayers,function(n,i){t.each(i.features,function(t,n){result=result||n.geometry.CLASS_NAME==e})}),result},exists:function(t){return"undefined"!=typeof t&&null!==t},getSavedZoom:function(){return this.options.zoom},getSavedCenter:function(){return this.options.center},saveViewport:function(){var t=this.map.getCenter(),e=this.map.getZoom();this.options.zoom=e,this.options.center={lon:t.lon,lat:t.lat}}})}(jQuery),function(t){t.widget("nlfeatures.editfeatures",{options:{markup:{geo_edit_class:"geo-edit",id_prefix:"nlf-"},animation:{fade_duration:500}},_createEditButton:function(e,n,i){var o=n.split(" ",1)[0];return t('<button id="'+e+o+'" '+'type="button" class="btn edit-geometry-small geo-edit '+n+'">'+i+"</button>")},_create:function(){var t=this,e=this.options.markup.id_prefix;"#"==e.charAt(0)&&(e=e.substr(1)),this.scaleButton=this._createEditButton(e,"scale-button radio-button sel-button","Scale"),this.rotateButton=this._createEditButton(e,"rotate-button radio-button sel-button","Rotate"),this.dragButton=this._createEditButton(e,"drag-button radio-button sel-button","Drag"),this.deleteButton=this._createEditButton(e,"delete-button sel-button","Delete"),this.viewportButton=this._createEditButton(e,"viewport-button","Save View"),this.element.append(this.dragButton),this.element.append(this.rotateButton),this.element.append(this.scaleButton),this.element.append(this.deleteButton),this.element.append(this.viewportButton),this.radioButtons=this.element.children("button.radio-button"),this.selectionButtons=this.element.children("button.sel-button"),this.radioButtons.data("activated",!1),this.disableAll(),this.element.bind({"select.nlfeatures":function(){t.enableAll()},"deselect.nlfeatures":function(){t.disableAll()}}),this.dragButton.bind({mousedown:function(){t.toggleButton(t.dragButton),t.triggerUpdateEvent()},click:function(t){t.preventDefault()}}),this.scaleButton.bind({mousedown:function(){t.toggleButton(t.scaleButton),t.triggerUpdateEvent()},click:function(t){t.preventDefault()}}),this.rotateButton.bind({mousedown:function(){t.toggleButton(t.rotateButton),t.triggerUpdateEvent()},click:function(t){t.preventDefault()}}),this.deleteButton.bind({mousedown:function(){t.element.trigger("delete.nlfeatures")},click:function(t){t.preventDefault()}}),this.viewportButton.bind({mousedown:function(){t.element.trigger("saveview.nlfeatures")},click:function(t){t.preventDefault()}})},showButtons:function(){this.element.children("button").css({display:"block !important",opacity:0}).stop().animate({opacity:1},this.options.animation.fade_duration),this.deactivateAllButtons()},hideButtons:function(){var t=this.element.children("button");t.stop().animate({opacity:0},this.options.markup.fade_duration,function(){t.css("display","none !important")})},deactivateAllButtons:function(){this.radioButtons.removeClass("primary").data("activated",!1)},disableAll:function(){this.selectionButtons.removeClass("primary").addClass("disabled"),this.selectionButtons.each(function(){this.disabled=!0})},enableAll:function(){this.selectionButtons.removeClass("disabled"),this.selectionButtons.each(function(){this.disabled=!1})},activateButton:function(t){this.deactivateAllButtons(),t.addClass("primary").data("activated",!0),this.element.trigger("lockfocus.nlfeatures")},deactivateButton:function(t){t.removeClass("primary").data("activated",!1),this.element.trigger("unlockfocus.nlfeatures")},toggleButton:function(t){t.data("activated")?this.deactivateButton(t):this.activateButton(t)},triggerUpdateEvent:function(){this.element.trigger("update.nlfeatures",[{drag:this.dragButton.data("activated"),rotate:this.rotateButton.data("activated"),scale:this.scaleButton.data("activated")}])}})}(jQuery),function(){var t={}.hasOwnProperty,e=function(e,n){function i(){this.constructor=e}for(var o in n)t.call(n,o)&&(e[o]=n[o]);return i.prototype=n.prototype,e.prototype=new i,e.__super__=n.prototype,e};!function(t){var n,i,o,s,r,a,l,u,d;return s=function(t){return"#"===t[0]?t.slice(1,t.length):t},l=function(t){return null!=t?t.toString():""},r=function(t,e,n,i){var o,s,r;return null==n&&(n=null),null==i&&(i=100),o=0,s=null!=n&&0!==n?function(){return t()||o>=n}:t,r=function(){return s()?e():(o++,setTimeout(r,i))},setTimeout(r,i)},a=function(t){return null!=t?t.substr(t.indexOf("\n")+1):""},n=function(){function e(t){this.widget=t}return e.prototype.$=function(e){return t(e,this.parent)},e.prototype.value=function(){return this.widget.options.values},e.prototype.initMap=function(){var e,n,i,o,s,r,a,l,u;return s=this.fields.map,n=this.value(),i={title:"Coverage",name:"Coverage",id:this.widget.element.attr("id"),geo:null!=(r=null!=n?n.geo:void 0)?r:""},o={mode:this.widget.options.mode,json:i,markup:{id_prefix:this.widget.options.id_prefix}},o.zoom=null!=(a=null!=n?n.zoom:void 0)?a:null,o.center=null!=(l=null!=n?n.center:void 0)?l:null,o.base_layer=null!=(u=null!=n?n.base_layer:void 0)?u:null,e=t.extend(!0,{},this.widget.options.map_options,this.widget.options.values,o),this.nlfeatures=s.nlfeatures(e).data("nlfeatures"),this.nlfeatures},e}(),o=function(n){function i(){return u=i.__super__.constructor.apply(this,arguments)}return e(i,n),i.prototype.init=function(){return this.build(),this.initMap(),this.populate()},i.prototype.build=function(){var e,n,i,o;return e=t(this.widget.element),i=s(this.widget.options.id_prefix),o=t("<div id='"+i+"map' class='map map-container'></div>"),n=t("<div id='"+i+"free' class='freetext'></div>"),e.addClass("nlfeatures").append(o).append(n),this.fields={map:t("#"+i+"map"),free:t("#"+i+"free")},e},i.prototype.populate=function(){var t,e;return t=this.widget.options.values.text,e=a(t),""===e?(this.fields.free.detach(),delete this.fields.free):this.fields.free.html(e)},i}(n),i=function(n){function i(){return d=i.__super__.constructor.apply(this,arguments)}return e(i,n),i.prototype.init=function(){return this.build(),this.initMap(),this.captureEditor(),this.populate(),this.wire()},i.prototype._buildMap=function(e,n){return t(e).addClass("nlfeatures").addClass("nlfeatures-edit").before('<div class="nlfeatures map-container">\n  <div id="'+n+"map\"></div>\n  <div class='nlfeatures-map-tools'>\n    <div class='nlflash'></div>\n  </div>\n</div>")},i.prototype._buildInputs=function(e,n,i){return t(e).after("<textarea name="+i+'[free]" id="'+n+'free" rows="3" cols="50"></textarea>\n<input type="hidden" id="'+n+'geo" name="'+i+'[geo]" value="" />\n<input type="hidden" id="'+n+'zoom" name="'+i+'[zoom]" value="" />\n<input type="hidden" id="'+n+'center_lon" name="'+i+'[center_lon]" value="" />\n<input type="hidden" id="'+n+'center_lat" name="'+i+'[center_lat]" value="" />\n<input type="hidden" id="'+n+'base_layer" name="'+i+'[base_layer]" value="" />\n<input type="hidden" id="'+n+'text" name="'+i+'[text]" value="" />')},i.prototype._buildUseMap=function(e,n,i,o){return t(".use-html",e.parent().parent()).after('<label class="use-mapon">'+o+'<input type="hidden" name="'+i+'[mapon]" value="0" />\n  <input type="checkbox" name="'+i+'[mapon]" id="'+n+'mapon" value="1" />\n</label>')},i.prototype._populateFields=function(e,n){var i;return i=e.parent(),this.fields={map_container:i.find(".map-container"),map:t("#"+n+"map"),map_tools:i.find(".nlfeatures-map-tools"),mapon:t("#"+n+"mapon"),text:t("#"+n+"text"),free:t("#"+n+"free"),html:t("#"+n+"html"),geo:t("#"+n+"geo"),zoom:t("#"+n+"zoom"),center_lon:t("#"+n+"center_lon"),center_lat:t("#"+n+"center_lat"),base_layer:t("#"+n+"base_layer"),flash:i.find(".nlflash")}},i.prototype.build=function(){var e,n,i,o,r;return e=t(this.widget.element),n=s(this.widget.options.id_prefix),i=this.widget.options.name_prefix,o=this.widget.options.labels.html,r=this.widget.options.labels.map,this._buildMap(e,n),this._buildInputs(e,n,i),this._buildUseMap(e,n,i,r),this._populateFields(e,n),this},i.prototype.captureEditor=function(){var t=this;return this.fields.mapon.change(function(){return t._onUseMap()}),this.fields.html.change(function(){return t._updateTinyEvents()})},i.prototype.populate=function(t){return null==t&&(t=this.widget.options.values),null!=t?(this.fields.html.prop("checked",+t.is_html),this.fields.mapon.prop("checked",+t.is_map),this.fields.geo.val(l(t.geo)),this.fields.zoom.val(l(t.zoom)),null!=t.center&&(this.fields.center_lon.val(l(t.center.lon)),this.fields.center_lat.val(l(t.center.lat))),this.fields.base_layer.val(l(t.base_layer)),this.fields.text.val(l(t.text)),this.fields.free.val(a(t.text))):void 0},i.prototype.wire=function(){var t,e=this;return t=function(){return e.updateFields(e.fields.free.val())},this.fields.free.change(t),this.nlfeatures.element.bind("featureadded.nlfeatures",t).bind("update.nlfeatures",t).bind("delete.nlfeatures",t).bind("refresh.nlfeatures",t).bind("saveview.nlfeatures",function(){return e.nlfeatures.saveViewport(),e.updateFields(),e.flash("View Saved...")}),this.nlfeatures.map.events.on({changebaselayer:t})},i.prototype.usesHtml=function(){return this.fields.html.prop("checked")},i.prototype.usesMap=function(){return this.fields.mapon.prop("checked")},i.prototype.showMap=function(){var t,e=this;return t=this.fields.map.children("button"),t.hide("normal",function(){return e.fields.map_container.slideDown("normal",function(){return t.fadeIn()})})},i.prototype.hideMap=function(){var t,e=this;return t=this.fields.map.children("button"),t.fadeOut("normal",function(){return e.fields.map_container.slideUp()})},i.prototype._onUseMap=function(){return this.usesMap()?this.showMap():this.hideMap(),this.updateFields()},i.prototype._updateTinyEvents=function(){var t,e=this;return this.usesHtml()?(t=this.fields.free.attr("id"),r(function(){return null!=tinymce.get(t)},function(){return e.fields.free.unbind("change"),tinymce.get(t).onChange.add(function(){return e.updateFields()})})):this.fields.free.change(function(){return e.updateFields()})},i.prototype.updateFields=function(){var t,e,n,i,o;return n=this.nlfeatures.getKml(),this.fields.geo.val(n),o=this.nlfeatures.getSavedZoom(),null!=o&&this.fields.zoom.val(o),e=this.nlfeatures.getSavedCenter(),null!=e&&(this.fields.center_lon.val(e.lon),this.fields.center_lat.val(e.lat)),t=this.nlfeatures.getBaseLayerCode(),null!=t&&this.fields.base_layer.val(t),i=this.usesHtml()?tinymce.get(this.fields.free.attr("id")).getContent():this.fields.free.val(),this.fields.text.val(""+n+"|"+o+"|"+(null!=e?e.lon:void 0)+"|"+(null!=e?e.lat:void 0)+"|"+t+"\n"+i)},i.prototype.flash=function(t,e){var n=this;return null==e&&(e=5e3),this.fields.flash.html(t).fadeIn("slow",function(){return setTimeout(function(){return n.fields.flash.fadeOut("slow")},e)})},i}(n),t.widget("nlfeatures.featurewidget",{options:{mode:"view",id_prefix:null,name_prefix:null,labels:{html:"Use HTML",map:"Use Map"},map_options:{},values:{geo:null,zoom:null,center:null,text:null,is_html:null,is_map:null}},_create:function(){var t,e,n;return t=this.element.attr("id"),null==(e=this.options).id_prefix&&(e.id_prefix="#"+t.substring(0,t.length-"widget".length)),null==(n=this.options).name_prefix&&(n.name_prefix=this._idPrefixToNamePrefix()),this.mode="edit"===this.options.mode?new i(this):new o(this),this.mode.init(),this.options.values.is_map?void 0:this.mode.hideMap()},_idPrefixToNamePrefix:function(t){var e,n,i,o;return null==t&&(t=this.options.id_prefix),t=deref(t),o=function(){var e,n,o,s;for(o=t.split("-"),s=[],e=0,n=o.length;n>e;e++)i=o[e],i.length>0&&s.push(i);return s}(),e=o.shift(),n=function(){var t,e,n;for(n=[],t=0,e=o.length;e>t;t++)i=o[t],n.push("["+i+"]");return n}(),""+e+n.join("")},destroy:function(){return t.Widget.prototype.destroy.call(this)},_setOptions:function(){return t.Widget.prototype._setOption.apply(this,arguments)}})}(jQuery)}.call(this);