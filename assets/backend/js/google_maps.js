/* Webarch Admin Dashboard
/* This JS is only for DEMO Purposes - Extract the code that you need
-----------------------------------------------------------------*/

$(document).ready(function() {

 $('#map').height($('.page-container').height());
 $( window ).resize(function() {
   $('#map').height($('.page-container').height());
 });

 $map = 0;
 function n(){
      //Initialize Map
      map = new GMaps({
        el: '#map',
        zoom: Gzoom,
        center: latlng,
        zoomControl : false,
        scrollwheel: false,
        zoomControlOpt: {
          style : 'SMALL',
          position: 'TOP_LEFT'
        },
        panControl : false,
        streetViewControl : false,
        mapTypeControl: false,
        overviewMapControl: false,

      });
    // Add a random mark
    var marker = map.addMarker({
      position: latlng,
      animation: google.maps.Animation.DROP,
      draggable:true,
    //title: 'Ubicación',
  });

    marker.addListener('drag',function(event) {
      $(".lat").val(event.latLng.lat());
      $(".lng").val(event.latLng.lng());
    });

    map.addListener('zoom_changed',function(){
      if(map.getZoom() ) {
       $(".zoom").val(map.getZoom());
     }
   });
  }
  $("#map-zoom-out").click(function() {
   map.zoomOut(1);
 });

  $("#map-zoom-in").click(function() {
    map.zoomIn(1);
  });

  $('#seminarios').click(function() {
    if($map == 0){
     n();
   }
   $map++;
 });

  if($("#map:visible").length > 0){
    n();
  }

});