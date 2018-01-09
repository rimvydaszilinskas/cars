$(document).on("click", ".reserve-link", function () {
  var date = $("#date-hidden").html();
  var day = $(this).html();

  $("#date-reserve").val($(this).html() + "-" + date);
  $('#postModal').modal('show');
});
