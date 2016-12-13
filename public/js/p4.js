$(document).ready(function() {
    $('#apiMovieSearchButton').click(function(event) {
        event.preventDefault();
        console.log($('#createFormMovieTitle').val());
        $.ajax({
            url: '/admin/movies/create', // Route that will handle the request; its job is to return us books.
            method: 'POST',
            dataType: 'html', // Kind of data we're expecting to get back
            data: { // Two pieces of data we'll send with the request
                '_token': $('input[name=_token]').val(),
                'createFormMovieTitle': $('#createFormMovieTitle').val()
            },
            // What to do before each ajax
            beforeSend: function() {
                // $('#loading').show();
                // $('#results').removeClass('error');
                $('#movieFormSearchResults').html('trying');
            },
            // What to do upon completion of a successful ajax call
            success: function(data) {
                // $('#loading').hide();
                $('#movieFormSearchResults').html(data);
            },
            // What to do upon completion of an unsuccessful ajax call
            error: function() {
                $('#movieFormSearchResults').html('Sorry, there was an error; your request could not be completed.');
                // $('#results').addClass('error');
            }
        });
    });
});