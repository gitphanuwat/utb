@extends('layouts.template')

@section('title','ศูนย์จัดการข้อมูลงานวิจัยเพื่อท้องถิ่น')
@section('subtitle','Local Research Development')
@section('styles')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script   src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyCkw9kj6fQxsFQJ89BbuRqPRZ5c_SdoDqg"></script>
  <script  type="text/javascript" src="gmaps.js"></script>
  <style type="text/css">
    #map {
      width: 800px;
      height: 500px;
      float: left;
    }
  </style>
@endsection

<body>
  <div id="map"></div>
  <div id="student_info"></div>
  <div id="instructions"></div>
  <div id="panorama"></div>
  <script>

    //พิกัดโรงเรียน
    var lat_school =  15.3628514;
    var lng_school =  104.8199403;

    //ข้อมูลนักเรียน
    var  student_data = '{  "students" : [ '+
       ' { "fullname" : "name 1" , "address": "address12" ,  "lat" : "15.36324" , "lng" : "104.82381" , "img_url" : "chaichon.png" , "profile" : "https://www.facebook.com/bchaichon"  } , '+
       ' { "fullname" : "name 2" , "address": "address34" ,  "lat" : "15.36456" , "lng" : "104.82382" , "img_url" : "appxar.png" , "profile" : "https://www.mthai.com/" } ,  '+
       ' { "fullname" : "name 3" , "address": "address56" ,  "lat" : "15.36896" , "lng" : "104.82383" , "img_url" : "logo.jpg" , "profile" : "https://drive.google.com/file/d/0B09DTnuQ8mwjaHNnR3VXWGRORGs/view?usp=sharing" }   '+
      ' ] }' ;


    //แสดงแผนที่เริ่มต้นที่พิกัดและใช้ div id=map แสดงผล
    var map = new GMaps({
      el: '#map',
      lat: 15.363208318293692,
      lng: 104.8238295030715,
    });

    //แปลง   student_data จาก text เป็น json object
    var obj_stu = JSON.parse(student_data);

    console.log(obj_stu.students.length);

    //วน loop add marker
   for (var i = 0; i < obj_stu.students.length; ++i) {
        //อ่านค่าจาก json array students
        var name = obj_stu.students[i].fullname ;
        var img_url = obj_stu.students[i].img_url;
        var address = obj_stu.students[i].address;
        var lat = obj_stu.students[i].lat ;
        var lng = obj_stu.students[i].lng ;
        var profile = obj_stu.students[i].profile

        var stu = obj_stu.students[i] ;
        var index = i ;

        //เพิ่มจุดลงบนแผนที่
        map.addMarker({
            id: index ,
            lat: lat ,
            lng: lng ,
            title: name ,
            click: function(e) {
               //showStudentInfo(stu,index);
               //alert("index="+e);
               //console.log("e="+e);
            },
            infoWindow: {
               // showStudentInfo1-3  แสดงข้อมูลแบบต่างๆ 	ตรง onclick ครับ
               content: '<p>'+name+'<br><img src="images/'+img_url+'" width="100"><br>'+
                 '<a href="#" onclick="showStudentInfo2(\''+name+'\',\''+address+'\',\''+img_url+'\',\''+lat+'\',\''+lng+'\',\''+profile+'\')" >detail</a></p>'
            }
        });

        /*map.drawOverlay({
          lat: obj_stu.students[i].lat ,
          lng: obj_stu.students[i].lng ,
          content: '<div class="overlay">'+name+'<br><img src="images/'+img_url+'" width="20"></div>'
        });*/

        //console.log(obj_stu.students[i]);
    }

    //แสดงแบบ panorama ไม่สำเร็จ


  </script>
</body>
</html>
