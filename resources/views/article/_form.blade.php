<input type="hidden"  id="_token" name="_token" value="<?php echo csrf_token(); ?>">
<div class="form-group">
  <label>Title :</label>
  <input id="title" type="text" class="form-control" name="title" value="{{ @$article->title }}">
</div>
<div class="form-group">
  <label>Body :</label>
  <input id="body" type="text" class="form-control" name="body" value="{{ @$article->body }}">
</div>
<div class="form-group">
  <label>Published On:</label>
  <input id="published_at" type="date" class="form-control" name="published_at" value="{{ \Carbon\carbon::now()->format('Y-m-d') }}">
</div>
<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="button" class="btn btn-primary" id="btn-add">
            <i class="fa fa-btn fa-user"></i> {{ $submitButtonText }}
        </button>
    </div>
</div>
