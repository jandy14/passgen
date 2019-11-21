$(document).on('show.bs.modal','#exampleModalCenter', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data('whatever'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find('.modal-body iframe').attr('src', "https://mit-games.kr/passgen/getnumber.php?date="+recipient);
});
$(document).ready(function () {
    $("#contact_form").on("submit", function(e) {
        var data = $(this).serializeArray();
        var formURL = $(this).attr("action");
        console.log(data);
        console.log(formURL);
        $.ajax({
            url: formURL,
            type: "GET",
            data: data,
            success: function(data, textStatus, jqXHR) {
                $('#exampleModal .modal-title').html("Result");
                $('#exampleModal .modal-body').html(data);
                $("#submitForm").remove();
                console.log(data);
            },
            error: function(jqXHR, status, error) {
                console.log(status + ": " + error);
            }
        });
        e.preventDefault();
    });
    $("#submitForm").on('click', function() {
        $("#contact_form").submit();
    });
});
