@extends('layouts.template')
@section('title','สมาชิกระบบ')
@section('subtitle','จัดการข้อมูล')
@section('body')

    <h1 class="page-header">โพรไฟล์</h1>
    <div role="tabpanel" class="col-sm-6 col-sm-offset-3">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#preview" aria-controls="preview" role="tab" data-toggle="tab">
                  แสดงตัวอย่าง
                </a>
            </li>
                <li role="presentation">
                    <a href="#avatar" aria-controls="avatar" role="tab" data-toggle="tab">
                        รูปประจำตัว
                    </a>
                </li>
            <li role="presentation">
                <a href="#password" aria-controls="password" role="tab" data-toggle="tab">
                    เปลี่ยนรหัสผ่าน
                </a>
            </li>
            <li role="presentation">
                <a href="#email" aria-controls="email" role="tab" data-toggle="tab">
                    อีเมล์
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="preview">
                <h2 class="page-header">โพรไฟล์</h2>
                @include('member.preview')
            </div>

                <div role="tabpanel" class="tab-pane" id="avatar">
                    <h2 class="page-header">รูปโพรไฟล์</h2>
                    @include('member.avatar')
                </div>

            <div role="tabpanel" class="tab-pane" id="password">
                <h2 class="page-header">เปลี่ยนรหัสผ่าน</h2>
                @include('member.password')
            </div>
            <div role="tabpanel" class="tab-pane" id="email">
                <h2 class="page-header">อีเมล์</h2>
                @include('member.email')
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function () {
            var profile_tab = "{{ Session::pull('profile_tab') }}";
            if (profile_tab) {
                $('div.tab-pane').removeClass('active');
                $('li[role="presentation"]').removeClass('active');
                $('div#' + profile_tab).addClass('active');
                $('a[aria-controls="' + profile_tab + '"]').parent('li').addClass('active');
            }

            // Delete confirmation dialog
            $('#delete').on('show.bs.modal', function (e) {
                $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
            });

        });
    </script>
@stop
