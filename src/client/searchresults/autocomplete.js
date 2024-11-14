$(function () {
    $("#search").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "search.php",
                dataType: "json",
                data: {
                    query: request.term,  
                    autocomplete: 'true' 
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 1
    });
});
