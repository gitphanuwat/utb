@extends('layouts.template')
@section('title','ศูนย์ข้อมูลท้องถิ่น')
@section('subtitle','สรุปข้อมูล')
@section('styles')



@endsection
@section('body')
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">สรุปข้อมูล</h3>
            </div>
            <!-- /.box-header -->

              <!-- /.box-header -->
              <div class="box-body">

<table id='example1' class='table table-bordered table-striped'>
  <thead>
  <tr>
    <th>ลำดับ</th>
    <th>ชื่อหน่วยงาน</th>
    <th>ประเภทหน่วยงาน</th>
    <th>เขตอำเภอ</th>
    <th>บุคลากร</th>
    <th>ชุมชน</th>
  </tr>
  </thead>
  <tbody>
    <?php
      $type = array('','องค์การบริหารส่วนจังหวัด','เทศบาลเมือง','เทศบาลตำบล','องค์การบริหารส่วนตำบล','การปกครองพิเศษ','อื่นๆ')
     ?>
    @foreach($organize as $key => $value)
    <tr>
      <td>{{ $value->id }}</td>
      <td>{{ $value->name }}</td>
      <td>{{ $type[$value->type] }}</td>
      <td>{{ $value->amphur->name }}</td>
      <td>{{ count($value->person) }}</td>
      <td>{{ count($value->village) }}</td>
    </tr>
    @endforeach
  </tbody>

  </table>

              </div>

        </div>
@endsection
@section('script')

@endsection
