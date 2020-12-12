$(document).ready(function(){
    $("#search_text").keyup(function(){
        var search = $(this).val();
        $.ajax({
            url: "search.php",
            method: "POST",
            data: {query: search},
            success: function(response) {
                $("#table-data").html(response);
            }
        });
    });
});
