<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Info windows</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

    <script type="text/javascript">

      // This example displays a marker at the center of Australia.
      // When the user clicks the marker, an info window opens.
      var locations = <?php print_r(json_encode($locations)) ?>;
      //var locations = [{lat: 17, lng: 100},{lat: 17.1, lng: 100.1}];

      function initMap() {
        var infowindowTmp; // กำหนดตัวแปรสำหรับเก็บลำดับของ infowindow ที่เปิดล่าสุด

        var image ;
        var uluru = {lat: 17, lng: 100};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: uluru
        });
    $.each( locations, function( index, value ){
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h2 id="firstHeading" class="firstHeading">Uluru</h2>'+
            '<div id="bodyContent">'+
            '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
            'Heritage Site.</p>'+
            '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
            'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
            '(last visited June 22, 2009).</p>'+
            '</div>'+
            '</div>';
        //var image = "icon/"+obj_marker[i].icon
        image = "icon/icon1.png"
        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        var marker = new google.maps.Marker({
          position: {lat: value.lat, lng: value.lng},
          map: map,
          icon: image,
          title: 'Uluru (Ayers Rock)'
        });
        marker.addListener('click', function() {
          if(infowindowTmp){ // ให้ตรวจสอบว่ามี infowindow ตัวไหนเปิดอยู่หรือไม่
              infowindow.close();  // ถ้ามีให้ปิด infowindow ที่เปิดอยู่
          }
          infowindow.open(map, marker);
          infowindowTmp=1; // เก็บ infowindow ที่เปิดไว้อ้างอิงใช้งาน

        });
    });


      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkw9kj6fQxsFQJ89BbuRqPRZ5c_SdoDqg&callback=initMap">
    </script>
  </body>
</html>
