<div class="row">
    <div class="col-sm-6">
        @if (Auth::user()->picture)
        <img src="{{ asset('images/avatar/large/' . Auth::user()->picture) }}" class="col-xs-12" />
        <a href="#" title="delete" data-href="{{ url('/profile/delpicture') }}/{{ Auth::user()->id}}" data-toggle="modal" data-target="#delete" class="btn btn-xs btn-danger delete-avatar">
            <i class="glyphicon glyphicon-remove"></i>
        </a>
         @else
        <img src="{{ asset('images/no_image.png') }}" class="col-xs-12" />
        @endif
    </div>
    <form action="{{ url('/profile/savepicture') }}" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="col-sm-6">
            <div class="form-group">
                <input type="file" name="avatar" />
            </div>

            <div class="form-group">
                <input type="submit" value="save" class="btn btn-primary" />
            </div>
        </div>
    </form>
</div>
<br />
<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">close</span></button>
                <h4 class="modal-title" id="myModalLabel">delete</h4>
            </div>
            <div class="modal-body">
                delete_avatar_message
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                <a href="#" class="btn btn-danger danger">delete</a>
            </div>
        </div>
    </div>
</div>
