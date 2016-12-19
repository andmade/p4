$(document).ready(function() {

    $('#newMixRadio').change(function() {
        if ($(this).is(':checked')) {
            $('#newMixInputField').show();
            $('#newMixPublicField').show()
            $('#newMixPublicLabel').show();
        }
    });
    $('#apiMovieSearchButton').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: '/admin/movies/create',
            method: 'POST',
            dataType: 'json',
            data: {
                '_token': $('input[name=_token]').val(),
                'movie_title': $('#detailFormMovieTitle').val(),
                'movie_year': $('#detailFormMovieReleased').val(),
            },
            // Show Searching message
            beforeSend: function() {
                $('#detailFormSearchMessage').text("Searching...");
                $('#detailFormSearchMessage').show();
            },
            // Fill the form with the retrieved data
            success: function(data) {
                $('#detailFormMovieTitle').val(data["title"]);
                $('#detailFormMovieReleased').val(data["year"]);
                $('#detailFormMovieSynopsis').val(data["plot"]);
                $('#detailFormMovieDirector').val(data["director"]);
                $('#detailFormMovieActors').val(data["actors"]);
                $('#detailFormMoviePoster').val(data["poster"]);
                var genres = data["genre"];
                $('[type="checkbox"]').map(function() {
                    if (genres.includes($('label[for=' + this.id + ']').text())) {
                        $(this).prop("checked", true);
                    } else {
                        $(this).prop("checked", false)
                    }
                });
                $('#detailFormSearchMessage').text("Success! Movie found and information pre-filled!");
                $('#detailFormSearchMessage').show();
            },
            // Show error message indicating movie data could not be found
            error: function() {
                $('#detailFormSearchMessage').text("Error! Movie data could not be located.");
                $('#detailFormSearchMessage').show();
            }
        });
    });
});