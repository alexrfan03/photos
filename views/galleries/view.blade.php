<h1 id="page-title">{{ $gallery->name }}
    <small>{{ Config::get('photos.list_page_title', 'Galleries') }}</small>
</h1>

<div class="margin-top margin-bottom-xxlarge">
    <p>
        <a class="btn btn-small" href="{{ action('photos::/') }}">
            <i class="icon-chevron-left"></i> Back to {{ Config::get('photos.list_page_title', 'Galleries') }}
        </a>
    </p>
</div>

@if (count($gallery->photos) === 0)
<p class="muted">No photos have been published in {{ $gallery->name }} yet.</p>
@else

<ul class="thumbnails">
    @foreach ($gallery->photos as $photo)
    <li class="span3">
        <a href="{{ asset('uploads/photos/' . $gallery->slug . '/' . $photo->filename) }}" class="thumbnail modalbox group-photos colorbox" rel="lightbox" title="{{ $photo->caption }}">
            <img src="{{ asset('uploads/photos/' . $gallery->slug . '/thumbs/' . $photo->filename) }}"
                 alt="{{ $photo->description }}">
        </a>
    </li>
    @endforeach
</ul>

@endif