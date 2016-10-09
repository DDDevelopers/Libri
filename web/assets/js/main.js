$(document).ready(function () {
    
    //this is for the searchField in the navigation
    var searchField = $('.main_search');
    $.get(searchField.data('source-url') + '?q=' + searchField.val(), function (data) {
        $(".main_search").typeahead({
            source: function (query, process) {
                var books = [];
                $.each(data, function (i, book) {
                    // map[state.stateName] = state;
                    books.push(book.title);
                });

                process(books);
            }, autoSelect: true
        });
    }, 'json');

});