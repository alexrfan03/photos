@layout('admin::layouts.main')

@section('content')
<h1>Edit Photo Gallery <small>{{ $gallery->name }}</small></h1>

{{ Form::open(URL::current(), 'POST', array('class' => 'form-horizontal')) }}

<div class="control-group {{ $errors->has('name') ? 'error' : '' }}">
    {{ Form::label('name', 'Name', array('class' => 'control-label')) }}
    <div class="controls">
        <input type="text" name="name" value="{{ $gallery->name }}" required>
    </div>
</div>

<div class="control-group">
    {{ Form::label('slug', 'Slug', array('class' => 'control-label')) }}
    <div class="controls">
        <code>{{ $gallery->slug }}</code>
    </div>
</div>

<div class="control-group {{ $errors->has('description') ? 'error' : '' }}">
    {{ Form::label('description', 'Description', array('class' => 'control-label')) }}
    <div class="controls">
        <textarea name="description" class="input-xxlarge ckeditor">{{ $gallery->description }}</textarea>
    </div>
</div>

<div class="control-group {{ $errors->has('published') ? 'error' : '' }}">
    {{ Form::label('published', 'Published', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::checkbox('published', $gallery->published, $gallery->published == 1 ? true : false) }}
    </div>
</div>

<div class="form-actions">
    <a href="{{ action('admin::photos') }}" class="btn">&larr; Cancel</a>
    <input type="submit" value="Save Changes" class="btn btn-primary">
</div>

{{ Form::hidden('id', $gallery->id) }}
{{ Form::token() }}
{{ Form::close() }}
@endsection