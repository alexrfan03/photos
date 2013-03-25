<h1 id="page-title">{{ Config::get('photos.list_page_title', 'Galleries') }}</h1>

@if (count($galleries) === 0)
<p class="muted">No galleries have been published yet.</p>
@else
<ul class="thumbnails">

    @foreach ($galleries as $gallery)
    <?php $photo1 = (count($gallery->photos) > 0) ? $gallery->photos[0] : null; ?>
    <li class="span3">
        <a href="{{ action('photos::' . $gallery->slug) }}" class="thumbnail">
            @if (is_null($photo1))
            <img src="http://placehold.it/200&text=Photo">
            @else
            <img src="{{ asset('uploads/photos/' . $gallery->slug . '/thumbs/' . $photo1->filename )}}">
            @endif
            <div class="caption">
                <h3 class="text-center">{{ $gallery->name }}</h3>
            </div>
        </a>
    </li>
    @endforeach
</ul>

@endif

