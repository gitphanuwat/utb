@extends('layouts.template')
@section('title','สมาชิกระบบ')
@section('subtitle','จัดการข้อมูล')
@section('body')
<div class="row">
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">สมาชิกผู้ใช้ระบบ</h3>
    </div>
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">

  <div id="tri" class="btn-group btn-group-sm">
    <a href="{!! url('admin/member') !!}" type="button" name="total" class="btn btn-default {{ classActiveOnlyPath('admin/member') }}">ทั้งหมด
      <span class="badge">{{  $counts['total'] }}</span>
    </a>
    @foreach ($roles as $role)
      <a href="{!! url('admin/member/sort/' . $role->slug) !!}" type="button" name="{!! $role->slug !!}" class="btn btn-default {{ classActiveOnlySegment(3, $role->slug) }}">{{ $role->title }}
        <span class="badge">{{ $counts[$role->slug] }}</span>
      </a>
      {{ classActiveSegment(1,'users') }}
    @endforeach
  </div>

	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>ชื่อ</th>
					<th>สถานะ</th>
					<th>สังกัด</th>
					<th>อนุมัติ</th>
          <th></th>
          <th></th>
          <th></th>
				</tr>
			</thead>
			<tbody>
        @foreach ($users as $user)
      		<tr {!! !$user->seen? 'class="warning"' : '' !!}>
      			<td class="text-primary"><strong>{{ $user->headname.$user->firstname.' '.$user->lastname }}</strong></td>
      			<td>{{ $user->role->title }}{!! $user->permit==2? '(ผู้บริหาร)' : '' !!}</td>
      			<td>
      				{!! $user->university_id? $user->university->name.'<br>' : '' !!}
      				{!! $user->center_id? 'ศูนย์ : '.$user->center->name.'<br>' : '' !!}
      				{!! $user->area_id? 'พื้นที่ : '.$user->area->name : '' !!}
      			</td>
      			<td>{!! Form::checkbox('seen', $user->id, $user->seen) !!}</td>
      			<td>
      				<a href="{{url("admin/member/".$user->id)}}" class="btn btn-success"> รายละเอียด </a>
      			</td>
      			<td>
              <a href="{{url("admin/member/".$user->id."/edit")}}" class="btn btn-warning"> แก้ไข </a>
            </td>
      			<td>
      				<form action="{{url('admin/member/'.$user->id)}}" method="post" onsubmit="return(confirm('ลบข้อมูล'))">
      					{{ method_field('DELETE') }}
      					<input type="hidden" name="_token" value="{{ csrf_token() }}">
      					<button type="submit" class="btn btn-danger">ลบข้อมูล</button>
      				</form>
      			</td>
      		</tr>
      	@endforeach
      </tbody>
		</table>
	</div>
  <a href="{{url("admin/member/create")}}" class="btn btn-primary pull-left"> เพิ่มสมาชิก </a>

	<div class="pull-right link">{!! $links !!}</div>

@stop

@section('script')

  <script>

    $(function() {
      //var role_id = $('#role_txt_id').val();
      //$('#role_id').val(role_id);

      // Seen gestion
      $(document).on('change', ':checkbox', function() {
        $(this).parents('tr').toggleClass('warning');
        $(this).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');
        var token = $('input[name="_token"]').val();
        $.ajax({
          url: '{!! url('admin/member/userseen') !!}' + '/' + this.value,
          type: 'PUT',
          data: "seen=" + this.checked + "&_token=" + token
        })
        .done(function() {
          $('.fa-spin').remove();
          $('input[type="checkbox"]:hidden').show();
        })
        .fail(function() {
          $('.fa-spin').remove();
          var chk = $('input[type="checkbox"]:hidden');
          chk.show().prop('checked', chk.is(':checked') ? null:'checked').parents('tr').toggleClass('warning');
          alert('{{ 'ล้มเหลว' }}');
        });
      });
    });

  </script>
  <?php
  session(['page' => $users->currentPage()]);
  ?>
</div>
</div>
</div>
</div>
</div>

@stop
