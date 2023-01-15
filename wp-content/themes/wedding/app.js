jQuery(document).ready(function($) {
    $("#guest-submit-button").click(function(event) {
        event.preventDefault();
        var guest_name = $("#guest").val();
        if(guest_name){
            $.ajax({
                method: "GET",
                url: "/wp-json/search-api/v1/search_guest_cpt_by_title/"+guest_name,
                success: function(data) {
                    console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });
});