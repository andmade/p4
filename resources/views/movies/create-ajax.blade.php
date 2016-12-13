@foreach($found_movies as $found_movie)
    <div class='api-movie-search-result'>
        <p>{{$found_movie->title}}</p>
        <p>{{$found_movie->year}}</p>
        <p>{{$found_movie->plot}}</p>
    </div>
@endforeach