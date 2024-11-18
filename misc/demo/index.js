$(document).ready(function() {
    var categories = [
        "Spicy",
        "Vegan",
        "Vegetarian",
        "Mexican",
        "Fast Food",
        "Beverage",
        "Dessert",
        "Mediterranean",
        "Fruit",
        "Salad",
    ];

    $("#autocomplete").autocomplete({
        source: categories
    });
});
