@extends('layouts.template')
@section('title','การใช้ประโยชน์')
@section('subtitle','จัดการข้อมูล')
@section('styles')

<link rel="stylesheet" href="{{ asset("assets/test/bootstrap-tagsinput.css") }}">
<link rel="stylesheet" href="{{ asset("assets/test/app.css") }}">


@endsection
@section('body')
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">การใช้ประโยชน์</h3>
            </div>
            <!-- /.box-header -->

              <!-- /.box-header -->
              <div class="box-body">

                <div >
                  <h3>Objects as tags</h3>
                  <div>
                    <input type="text" class="input1">
                  </div>

                  </div>
                </div>

              </div>


      </div>
@endsection
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="{{ asset("assets/test/bootstrap-tagsinput.min.js") }}"></script>


<script type="text/javascript">
                var cities = new Bloodhound({
                //datumTokenizer: BloodHound.clearPrefetchCache();
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                //prefetch: 'datajson.json'
                  prefetch: {
                      url: "datajson.json",
                      cache:false
                  }
                });

                cities.initialize();

                var elt = $('.input1');
                elt.tagsinput({
                itemValue: 'value',
                itemText: 'text',
                typeaheadjs: {
                  name: 'text',
                  displayKey: 'text',
                  source: cities.ttAdapter()
                }
                });
                //cities.clear();
              //  elt.tagsinput('add', { "value": 1 , "text": "Amsterdam"   , "continent": "Europe"    });
                //elt.tagsinput('add', { "value": 4 , "text": "Washington00"  , "continent": "America"   });
              //  elt.tagsinput('add', { "value": 7 , "text": "Sydney"      , "continent": "Australia" });
                //elt.tagsinput('add', { "value": 10, "text": "Beijing"     , "continent": "Asia"      });
              //  elt.tagsinput('add', { "value": 13, "text": "Cairo"       , "continent": "Africa"    });
</script>

@endsection
