$(document).on("click", "#enter", function () {
  $("#loginModal").modal("show");
});

$(document).on("click", "#enter-login", function () {
  let password = $("#loginPassword").val().trim();
  let email = $("#loginEmail").val().trim();

  $("#spinner").modal("show")

  $.ajax({
    url: "api/login",
    method: "POST",
    contentType: "application/json",
    dataType: "json",
    async:true,
    data: JSON.stringify({
      EMAIL: email,
      PASSWORD: password,
    }),
  }).done(function (data) {
      if (data.result == true) {
        localStorage.setItem("token", data.token);
        window.location.href="home"
      } else {
      showAlert("erro", "Atenção", "Falha na autenticação.");
      }
    }).fail(function (xhr, status, error) {
        $("#spinner").modal("hide");
        showAlert("erro", "Atenção", "Falha na autenticação.");
    }).always(function () {
      $("#spinner").modal("hide");
    });
});
