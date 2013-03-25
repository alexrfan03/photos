<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ $theme_data['title'] }}</title>
        {{ $theme_data['metadata'] }}
    </head>
    <body class="front-body {{ (rtrim(URL::current(), '/ ') === rtrim(URL::base(), '/ ')) ? 'front' : 'not-front' }}">
        <div class="content-wrapper container">

            <div class="row">
                <div class="content span12">
                    {{ $theme_content }}
                </div>
            </div><!-- /.row -->

        </div><!-- /.content-wrapper -->

    </body>
</html>