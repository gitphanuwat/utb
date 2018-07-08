@extends('layouts.template')
@section('title','มหาวิทยาลัย')
@section('subtitle','จัดการข้อมูล')
@section('body')
<div class="row">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลมหาวิทยาลัย</h3>
            </div>

            <div class='showdetail'>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th width='60'>ลำดับ</th>
                      <th width='250'>มหาวิทยาลัย</th>
                      <th width='20%'>จำนวนศูนย์จัดการเครือข่าย</th>
                      <th>จำนวนชุมชน</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=0;?>
                    @foreach ($objuni as $key)
                      <tr>
                        <td>{{ ++$i }}</td>
                        <td>
                          <a data-id="{{$key->id}}" href='#cen' class='btncenter'>{{ $key->name }}</a>
                        </td>
                        <td>{{ count($key->center) }}</td>
                        <td>{{ count($key->area) }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            </div>

            <div class='detailcenter' id='cen'>
            <div class="box-body">
              <div class="showcenter">
              </div>
            </div>
            </div>

            <div class='detailarea' id='are'>
            <div class="box-body">
              <div class="showarea">
              </div>
            </div>
            </div>

          </div>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(function(){
      //displaydata();

      $('.showcenter').hide();
      $('.showarea').hide();

      $('.btncenter').click(function(){
          $('.showcenter').show();
          $('.showarea').hide();
          var iduni = $(this).data('id');
          loadcenter(iduni);
      });

      //$('.btnarea').click(function(){
      $('body').delegate('.btnarea','click',function(){
          $('.showarea').show();
          var idcen = $(this).data('id');
          loadarea(idcen);
          //alert(idcen);
      });

    });

    function loadcenter(iduni){
      //alert(iduni);
        $.ajax({
          url : '{!! url('analyze/getcenter') !!}',
          type : "get",
          data : {
            'iduni' : iduni,
          },
          success : function(s)
          {
            $('.showcenter').html(s);
          }
        });
    }
    function loadarea(idcen){
      //alert(idcen);
        $.ajax({
          url : '{!! url('analyze/getarea') !!}',
          type : "get",
          data : {
            'idcen' : idcen,
          },
          success : function(s)
          {
            $('.showarea').html(s);
          }
        });
  }


</script>
@endsection
