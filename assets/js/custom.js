/*$(function () {
    $("input").on("click", function () {
        $(this).toggleClass("animate");
    });
});
*/
$(function () {
  $("#ongoingRadio, #dropRadio").change(function () {
    $("#dropoutTextArea").val("").attr("disabled", true);
    if ($("#ongoingRadio").is(":checked")) {
      $("#dropoutTextArea").focus();
    } else if ($("#dropRadio").is(":checked")) {
      $("#dropoutTextArea").removeAttr("disabled");
      $("#dropoutTextArea").focus();
    }
  });
});
