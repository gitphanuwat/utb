@extends('layouts.template')

@section('title','ศูนย์จัดการข้อมูลงานวิจัยเพื่อท้องถิ่น')
@section('subtitle','Local Research Development')
@section('styles')
<style type="text/css">
  #mymap {
      border:1px solid red;
      width: 800px;
      height: 500px;
  }
</style>
@endsection

@section('body')
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <div id="mymap"></div>
  </div>
</div>

@endsection
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCkw9kj6fQxsFQJ89BbuRqPRZ5c_SdoDqg&callback=initialize"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

<script type="text/javascript">

  var locations = <?php print_r(json_encode($locations)) ?>;

  var mymap = new GMaps({
    el: '#mymap',
    lat: 17,
    lng: 100,
    zoom:6
  });

  $.each( locations, function( index, value ){
    mymap.addMarker({
      lat: value.lat,
      lng: value.lng,
      title: value.city,
      infoWindow: {
        content: '<p>'+value.city+'</p>'
      }

    });
 });

</script>
@endsection
