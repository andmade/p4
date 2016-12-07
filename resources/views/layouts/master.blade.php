<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>
            andscene
        </title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        <link href="http://fastly.ink.sapo.pt/3.1.10/css/ink.css" rel="stylesheet" type="text/css" />
        <script src="http://fastly.ink.sapo.pt/3.1.10/js/ink-all.js" type="text/javascript">
        </script>
        <style>
            body {font-family: 'Lato', sans-serif;}
        </style>
        @yield("head")
    </head>
</html>
<body>
    <h2>
        Movies
    </h2>
    <div class="ink-grid">
        <div class="column-group">
            <div class="all-100 large-25">
                @foreach($movies as $movie)
                <section class="movie">
                    <h3>
                        {{$movie->title}}
                    </h3>
                    <p>
                        {{$movie->synopsis}}
                    </p>
                    <img src="{{$movie->poster}}" style="width:150px"/>
                </section>
                @endforeach
            </div>
        </div>
    </div>
</body>
