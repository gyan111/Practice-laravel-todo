{{ Form::open(array('url' => Request::root().'/update-image', 'files' => true, 'id' => 'update_image')) }}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="DefaultModalLabel">Image</h4>
	</div>
	<img src="{{ Request::root() }}/uploads/images/thumbs/{{ $user -> username }}.jpg" class="user-image img-responsive"/>
	<div class="modal-body">
		<div class="form-group">
			<!-- <label>Upload New Image</label> -->
			{{-- Form::file('image', array('class' => 'form-control', 'value' => 'Input::file("image")')) --}}			
		</div>
	</div>

	<div class="modal-footer">
		<!-- <button type="submit" class="btn btn-info btn-block">Upload</button> -->
		<input type="hidden" name="form_posted" />
  	</div><!-- /.modal-footer -->
<!-- </form> -->
{{ Form::close() }}
