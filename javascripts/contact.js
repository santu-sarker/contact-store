$(document).ready(function () {
  $(".delete_modal").on("click", function () {
    $("#delete_modal").modal("show");

    $tr = $(this).closest("tr");
    var data = $tr
      .children("td")
      .map(function () {
        return $(this).text();
      })
      .get();
    //var data = $("#contact_id").val();
    console.log(data);
    $("#delete_id").val(data[0]);
    console.log($("#contact_id").val(data[1]));
  });

  $(".edit_modal").on("click", function () {
    $("#contact_modal").modal("show");

    $tr = $(this).closest("tr");
    var data = $tr
      .children("td")
      .map(function () {
        return $(this).text();
      })
      .get();
    //var data = $("#contact_id").val();
    //console.log(data);

    $("#contact_id").val(data[0]);
    $("#contact_name").val(data[1]);
    $("#contact_number").val(data[2]);
    $("#contact_email").val(data[3]);
    $("#update_contact").val("true");
    $("#submit").text("Edit Contact");
    $("#exampleModalLabel").text("Edit This Contact");
  });
  $("#add_contact").on("click", function () {
    $("#contact_id").val();
    $("#contact_name").val("");
    $("#contact_number").val("");
    $("#contact_email").val("");
    $("#update_contact").val("false");
    $("#submit").text("Add Contact");
    $("#exampleModalLabel").text("Add A New Contact");

    $("#contact_modal").modal("show");
  });
});
