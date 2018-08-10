@extends('layouts.template')

@section('title','ศูนย์จัดการข้อมูลงานวิจัยเพื่อท้องถิ่น')
@section('subtitle','Local Research Development')
@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{ asset("assets/plugins/datatables/dataTables.bootstrap.css") }}">
<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="{{ asset("assets/plugins/fullcalendar/fullcalendar.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/plugins/fullcalendar/fullcalendar.print.css") }}" media="print">

@endsection


@section('body')


        <div class="row">
          <div class="col-md-3">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h4 class="box-title">กิจกรรมที่กำลังจะมาถึง</h4>
              </div>
              <div class="box-body">
                <!-- the events -->
                <div id="external-events">
                  <div class="external-event bg-green">แห่เทียนเข้าพรรษา</div>
                  <div class="external-event bg-yellow">สับปะรดห้วยมุ่น</div>
                  <div class="external-event bg-aqua">ตลาดทุเรียน</div>
                  <div class="external-event bg-light-blue">พิชิตภูสอยดาว</div>
                  <div class="external-event bg-red">งานส่งเสริมท่องเที่ยว</div>
                  <div class="checkbox">
                    <label for="drop-remove">
                      <input type="checkbox" id="drop-remove">
                      ยกเลิกกิจกรรม
                    </label>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">สร้างกิจกรรม</h3>
              </div>
              <div class="box-body">
                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                  <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                  <ul class="fc-color-picker" id="color-chooser">
                    <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                  </ul>
                </div>
                <!-- /btn-group -->
                <div class="input-group">
                  <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                  <div class="input-group-btn">
                    <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
                  </div>
                  <!-- /btn-group -->
                </div>
                <!-- /input-group -->
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- /.nav-tabs-custom -->
                      <!-- /.box (chat box) -->
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">ปฏิทินกิจกรรมภายในจังหวัด</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <!-- select -->
                <div class="row">
                  <!-- Left col -->
                  <div class="col-lg-3">
                    <div class="form-group" style="width:250px">
                      <select class="form-control">
                        <option>--เลือกอำเภอ--</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group" style="width:250px">
                      <select class="form-control">
                        <option>--เลือกตำบล--</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group" style="width:250px">
                      <select class="form-control">
                        <option>--เลือกหมวดหมู่--</option>
                      </select>
                    </div>
                  </div>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>กิจกรรม</th>
                    <th>สถานที่จัด</th>
                    <th>ผู้รับผิดชอบ</th>
                    <th>ข้อมูลติดต่อ</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>1</td>
                    <td>โครงการข้าวอินทรีย์</td>
                    <td>บ้านหาดสองแคว หมู่ 2 ตำบลหาดสองแคว อำเภอตรอน จังหวัดอุตรดิตถ์ 53140</td>
                    <td>อบต.หาดสองแคว</td>
                    <td>055-496098</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>ถนนต้นราชพฤกษ์ที่สวยที่สุดภาคเหนือ</td>
                    <td>หมู่ 10 ต.วังแดง อ.ตรอน จ.อุตรดิตถ์ 53140</td>
                    <td>อบต.วังแดง</td>
                    <td>055491506</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>ศูนย์การเรียนรู้แบบพึ่งตนเอง</td>
                    <td>หมู่ 10 ต.วังแดง อ.ตรอน จ.อุตรดิตถ์ 53140</td>
                    <td>อบต.วังแดง</td>
                    <td>055491506</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>บ้านพักโฮมสเตย์บ้านหาดสองแคว</td>
                    <td>บ้านหาดสองแคว ต.หาดสองแคว อ.ตรอน จ.อุตรดิตถ์ 53140</td>
                    <td>อบต.หาดสองแคว</td>
                    <td>055496098</td>
                  </tr>

                  <tr>
                    <td>5</td>
                    <td>โครงการจักรยานสานฝัน</td>
                    <td>บ้านหาดสองแคว ต.หาดสองแคว อ.ตรอน จ.อุตรดิตถ์ 53140</td>
                    <td>อบต.หาดสองแคว</td>
                    <td>055496098</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>ไทยอาสาป้องกันชาติ</td>
                    <td>ตำบลบ่อทอง อำเภอทองแสนขัน จังหวัด อุตรดิตถ์ 53230</td>
                    <td>อบต.บ่อทอง</td>
                    <td>0558240268</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>ศาลปู่เจ้าทิศน้อย</td>
                    <td>ต.บ่อทอง อ.ทองแสนขัน จ.อุตรดิตถ์</td>
                    <td>เทศบาลตำบลทองแสนขัน</td>
                    <td>055418254</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>ฝึกอบรมอาชีพ"รำกลองยาวผู้สูงอายุ"</td>
                    <td>หมู่ที่ 10 ตำบลบ่อทอง อำเภอทองแสนขัน จังหวัดอุตรดิตถ์</td>
                    <td>อบต.บ่อทอง</td>
                    <td>0558240268</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td>ผลิตภัณฑ์จากเหล็กน้ำพี้</td>
                    <td>บ้านน้ำพี้ หมู่ 9 ตำบลน้ำพี้ อำเภอทองแสนขัน จังหวัดอุตรดิตถ์ 53230</td>
                    <td>อบต.น้ำพี้</td>
                    <td>095681970</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>กลุ่มผลิตก๊าซชีวภาพ</td>
                    <td>หมู่ 10 ต.วังแดง อ.ตรอน จ.อุตรดิตถ์ 53140</td>
                    <td>อบต.วังแดง</td>
                    <td>055491506</td>
                  </tr>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ลำดับ</th>
                    <th>กิจกรรม</th>
                    <th>สถานที่จัด</th>
                    <th>ผู้รับผิดชอบ</th>
                    <th>ข้อมูลติดต่อ</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <!-- right col -->
        </div>
        <!-- /.row -->

  <!-- /.row (main row) -->
@endsection

@section('script')
<!-- DataTables -->
<script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("assets/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset("assets/plugins/fullcalendar/fullcalendar.min.js") }}"></script>

<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>

<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    ini_events($('#external-events div.external-event'));

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      //Random default events
      events: [
        {
          title: 'ส่งเสริมการท่องเที่ยว',
          start: new Date(y, m, 1+1),
          backgroundColor: "#f56954", //red
          borderColor: "#f56954" //red
        },
        {
          title: 'สับปะรดห้วยมุ่น',
          start: new Date(y, m, 4),
          end: new Date(y, m, 5),
          backgroundColor: "#f39c12", //yellow
          borderColor: "#f39c12" //yellow
        },
        {
          title: 'Meeting',
          start: new Date(y, m, d, 10, 30),
          allDay: false,
          backgroundColor: "#0073b7", //Blue
          borderColor: "#0073b7" //Blue
        },
        {
          title: 'ตลาดทุเรียน',
          start: new Date(y, m, d, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false,
          backgroundColor: "#00c0ef", //Info (aqua)
          borderColor: "#00c0ef" //Info (aqua)
        },
        {
          title: 'แห่เทียนเข้าพรรษา',
          start: new Date(y, m, 9),
          end: new Date(y, m, 9),
          allDay: false,
          backgroundColor: "#00a65a", //Success (green)
          borderColor: "#00a65a" //Success (green)
        },
        {
          title: 'แห่เทียนเข้าพรรษา',
          start: new Date(y, m, 9),
          end: new Date(y, m, 9),
          allDay: false,
          backgroundColor: "#00a65a", //Success (green)
          borderColor: "#00a65a" //Success (green)
        },
        {
          title: 'แห่เทียนเข้าพรรษา',
          start: new Date(y, m, 9),
          end: new Date(y, m, 9),
          allDay: false,
          backgroundColor: "#00a65a", //Success (green)
          borderColor: "#00a65a" //Success (green)
        },
        {
          title: 'แห่เทียนเข้าพรรษา',
          start: new Date(y, m, 9),
          end: new Date(y, m, 9),
          allDay: false,
          backgroundColor: "#00a65a", //Success (green)
          borderColor: "#00a65a" //Success (green)
        },
        {
          title: 'แห่เทียนเข้าพรรษา',
          start: new Date(y, m, 9),
          end: new Date(y, m, 9),
          allDay: false,
          backgroundColor: "#00a65a", //Success (green)
          borderColor: "#00a65a" //Success (green)
        },
        {
          title: 'แห่เทียนเข้าพรรษา',
          start: new Date(y, m, 9),
          end: new Date(y, m, 9),
          allDay: false,
          backgroundColor: "#00a65a", //Success (green)
          borderColor: "#00a65a" //Success (green)
        },-
        {
          title: 'พิชิตภูสอยดาว',
          start: new Date(y, m, 24),
          end: new Date(y, m, 26),
          url: 'http://google.com/',
          backgroundColor: "#3c8dbc", //Primary (light-blue)
          borderColor: "#3c8dbc" //Primary (light-blue)
        }
      ],
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      }
    });

    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });
</script>
@endsection
