@extends('layouts.template')
@section('title','กลุ่มงานวิจัย/ปัญหาชุมชน')
@section('subtitle','จัดการข้อมูล')
@section('styles')
<link rel="stylesheet" href="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}">
@endsection
@section('body')

test Auth

{{ Auth::user()->firstname }}

@endsection
@section('script')

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>

<script type="text/javascript">
	$('#detail').wysihtml5();
</script>

@endsection
