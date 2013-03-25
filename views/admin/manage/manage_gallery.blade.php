@layout('admin::layouts.main')

@section('content')
<h1>Manage Gallery <small>{{ $gallery->name }}</small></h1>

<div class="row">

    <div class="span6">
        <h2>Upload Photos</h2>
        <div id="plupload-container" class="well well-small">
            <div id="filelist">No runtime found.</div>
            <a id="select-files" class="btn btn-info" href="#">Select files</a>
            <a id="upload-files" class="btn btn-primary" href="#">Upload files</a>
        </div>
    </div>

    <div class="span6 well well-small">
        <h2>Gallery Info</h2>
        <p><strong>Name:</strong> {{ $gallery->name }}</p>
        <p><strong>Slug:</strong> <code>{{ $gallery->slug }}</code></p>
        <p><strong>Description:</strong> {{ Str::words(strip_tags($gallery->description), 10) }}</p>
        <p><a class="btn btn-info btn-mini"
              href="{{ action('admin::photos.gallery.edit') }}?id={{ $gallery->id }}">Edit Gallery Info</a>
        </p>
    </div>

</div>

<hr>

<h2>Photos</h2>

@if (count($gallery->photos) === 0)
<p class="muted">No photos have been uploaded to this gallery yet.</p>

<a href="{{ action('admin::photos.update.delete_gallery' . '?id=' . $gallery->id) }}" class="gallery-delete btn btn-danger">Delete Gallery</a>
@else

@foreach ($gallery->photos as $photo)
<div class="row photo-{{ $photo->id }}-row">
    <div class="span3">
        <a href="{{ url('uploads/photos/' . $gallery->slug . '/' . $photo->filename) }}" target="_blank">
            <img src="{{ url('uploads/photos/' . $gallery->slug . '/thumbs/' . $photo->filename) }}"
                 class="img-polaroid">
        </a>
    </div>

    <div class="span9">
        {{ Form::open(action('admin::photos.update.update_photo'), 'POST', array('class' => 'form-horizontal')) }}
        <div class="control-group {{ $errors->has('caption') ? 'error' : '' }}">
            {{ Form::label('caption', 'Caption', array('class' => 'control-label')) }}
            <div class="controls">
                <input type="text" name="caption" value="{{ $photo->caption }}">
            </div>
        </div>
        <div class="control-group {{ $errors->has('description') ? 'error' : '' }}">
            {{ Form::label('description', 'Description', array('class' => 'control-label')) }}
            <div class="controls">
                <input type="text" name="description" value="{{ $photo->description }}">
            </div>
        </div>

        <div class="form-actions">
            <input type="submit" value="Save Changes" class="btn btn-primary photo-form-submit">
            <a href="{{ action('admin::photos.update.delete_photo' . '?id=' . $photo->id) }}" class="photo-delete btn btn-danger pull-right">Delete Photo</a>
        </div>
        {{ Form::hidden('id', $photo->id) }}
        {{ Form::token() }}
        {{ Form::close() }}
    </div>

</div>
<hr>
@endforeach

@endif

@endsection

@section('scripts')
<script type="text/javascript">
var upload_post_url = "{{ action('admin::photos.upload.do_upload') }}";
var gallery_id = "{{ $gallery->id }}";
var bundle_url = "{{ url('bundles/photos') . '/' }}";
var session_token = "{{ Session::token() }}";
</script>
<script type="text/javascript" src="{{ asset('bundles/photos/addons/plupload/plupload.full.js') }}"></script>
<script type="text/javascript" src="{{ asset('bundles/photos/js/photos-uploader.js') }}"></script>
@endsection