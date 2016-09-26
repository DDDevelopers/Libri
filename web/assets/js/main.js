$(document).ready(function(){

    $('.main_search').on('input change', function () {
        $.get($(this).data('source-url')+'?q='+$(this).val(), function(data){
            $(".main_search").typeahead({ source: function (query, process) {
                var books = [];
                $.each(data, function (i, book) {
                    // map[state.stateName] = state;
                    books.push(book.title);
                });

                process(books);
            }, autoSelect: true});
        },'json');
    })

});