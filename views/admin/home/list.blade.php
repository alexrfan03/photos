@layout('admin::layouts.main')

@section('content')

<h1>Photo Galleries
    <small>
        <a href="{{ action('admin::photos.gallery.create') }}"
           class="btn btn-primary pull-right">
            <i class="icon icon-plus icon-white"></i> Create New Gallery</a>
    </small>
</h1>

@if (count($galleries->results) === 0)
<p class="muted">No galleries have been created.</p>
@else

<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Photos</th>
            <th>Published</th>
            <th>Updated</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $galleries->results as $gallery)
        <tr>
            <td>
                <a href="{{ action('admin::photos.manage_gallery') }}?id={{ $gallery->id }}" title="Manage Photos">
                    {{ $gallery->name }}
                </a>
            </td>
            <td>{{ $gallery->photos()->count() }}</td>
            <td>
                @if ($gallery->published == 1)
                <span class="label label-info"><i class="icon-ok-sign icon-white"></i></span>
                @else
                <span class="label"><i class="icon-remove-sign icon-white"></i></span>
                @endif
            </td>
            <td>{{ date('d/m/y, h:i a', strtotime($gallery->updated_at)) }}</td>
            <td>
                <a class="btn btn-primary btn-mini"
                   href="{{ action('admin::photos.manage_gallery') }}?id={{ $gallery->id }}">Manage Photos</a>
                <a class="btn btn-info btn-mini"
                   href="{{ action('admin::photos.gallery.edit') }}?id={{ $gallery->id }}">Edit Gallery</a>
            </td>
        </tr>
        @endforeach
        <tbody>
</table>

@endif

@endsection