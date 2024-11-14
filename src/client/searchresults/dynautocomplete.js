$(function () {
    $("#search").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "./search.php",  
                dataType: "json",
                data: {
                    query: request.term,  // Send the current user input to the server
                    autocomplete: 'true'  // Indicate it's an autocomplete request
                },
                success: function (data) {
                    response(data);  // Pass the server response to jQuery UI autocomplete
                },
                error: function() {
                    console.error("Failed to load autocomplete data");
                }
            });
        },
        minLength: 1,  // Minimum number of characters before triggering the autocomplete (can adjust)
        delay: 300,  // Optional: Delay before the request is triggered after the user stops typing
        autoFocus: true  // Optional: Automatically select the first suggestion
    });
});
