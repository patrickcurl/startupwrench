@extends('layouts.master')
@section('head')
  <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
  <script type="text/javascript">
    tinymce.init({
      selector : "textarea",
      plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
      toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    }); 
  </script>
  <style> 
    .container {
      max-width: 1170px;
    }
  </style>
@endsection
@section('content')
<div class="row make-post">

      <div class="col-md-8 col-sm-8">
        <div class="well">
          <h5>Make Post</h5>
          <hr>
          <input type="text" class="col-md-12" placeholder="Enter Title">
          <br>
		  <br>
          <button class="btn btn-default"><i class="fa fa-paperclip"></i>&nbsp; Add Media</button>
          <br>
          <br>
         
          <div class="form-group">
            <textarea name='body' class="form-control">
              {{-- @if(!old('body')) --}}
              {{-- {!! $post->body !!} --}}
              {{-- @endif --}}
              {{-- {!! old('body') !!} --}}
            </textarea>
          </div>

          
			<br>
		  <div class="clearfix"></div>
        </div>
      </div>

      <div class="col-md-4 col-sm-4">

        <div class="well">
                    <form class="form-horizontal">

                      <h6>Category</h6>
                      <hr>
                      <div class="uni">
                        <label class="checkbox"><input type="checkbox" value="check1"> General</label>
                        <label class="checkbox"><input type="checkbox" value="check2"> Latest News</label>
                        <label class="checkbox"><input type="checkbox" value="check3"> Health</label>
                      </div>

                      <hr>
                      <h6>Tags</h6>
                      <hr>
					  <div class="form-group">
					  <div class="col-md-12">
						<input class="form-control" type="text" placeholder="Tags">
					  </div>
					  </div>
                      <hr>
						
						<div class="form-group">
						<div class="col-md-12">
						  <button class="btn btn-primary btn-sm">Publish</button>
						  <button class="btn btn-default btn-sm">Save Draft</button>
						  <button class="btn btn-danger btn-sm">Trash</button>
						 </div>
						</div>
                    </form>
        </div>

      </div>

    </div>
@endsection
