
$(document).on("click", "#btnAdicionarUsuario", function () {
  $("#userModalLabel").text("Criar Usuário");
  $("#updateUserHash").val("");
  $("#name").val("");
  $("#email").val("");      
  $("#phone").val("");
  $("#password").val("");
  $("#password-2").val("");
  $("#userType").val("");
  $("#userModal").modal("show");
});

$(document).on("click", ".btn-editar", function () {

  const userData = $(this).data("user");
  const userHash = $(this).data("id");
  $("#updateUserHash").val(userHash);

  $("#name").val(userData.NAME);  
  $("#email").val(userData.EMAIL);
  $("#phone").val(userData.PHONE).trigger("keypress");
  $("#password").val("");
  $("#password-2").val("");
  $("#userType").val(userData.TYPE_HASH);
  $("#userModalLabel").text("Editar Usuário");
  $("#userModal").modal("show");
}); 


function registerUser(){ 
  const name = $("#name").val().trim();
  const email = $("#email").val().trim();
  const phone = $("#phone").val().trim();
  const password = $("#password").val();
  const confirmPassword = $("#password-2").val();

  let errors = [];

  if (name.length < 2) errors.push("Nome deve ter pelo menos 2 caracteres.");
  if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/))
    errors.push("E-mail inválido.");
  if (!phone) errors.push("Telefone é obrigatório.");
  if (!isValidPassword(password)) {
    errors.push(
      "Senha deve ter ao menos 8 caracteres, incluindo letra maiúscula, minúscula, número e símbolo."
    );
  }
  if (password !== confirmPassword) errors.push("As senhas não coincidem.");

  if (errors.length > 0) {
    showAlert("erro", "Atenção", errors.join("\n"));
    return;
  }

  $.ajax({
    url: "api/users", 
    method: "POST",
    contentType: "application/json",
    dataType: "json",
    data: JSON.stringify({
      NAME: name,
      EMAIL: email,
      PHONE: removeMask(phone),
      PASSWORD: password,
      USER_TYPE: $("#userType").val()
    }),

    headers: {
      Authorization: "Bearer " + localStorage.getItem("token")
    }
  })
  .done(function (data) {

    if (data.result === true) {
      showAlert('sucesso', 'Sucesso',"Usuário adicionado com sucesso!");
      $("#userModal").modal("hide");
      getAllUsers();
    } else {
      showAlert("erro", "Atenção", "Falha ao cadastrar usuário.");
    }
  })
  .fail(function (xhr, status, error) {
    showAlert("erro", "Atenção", "Falha ao cadastrar usuário.");
  })
  .always(function () {
    $("#spinner").modal("hide");
  });
}


function updateUser() {
  const name = $("#name").val().trim();
  const email = $("#email").val().trim();
  const phone = $("#phone").val().trim();
  const password = $("#password").val();
  const confirmPassword = $("#password-2").val();
  const userHash = $("#updateUserHash").val();
  const userType = $("#userType").val();

  let errors = [];

  if (name.length < 2) errors.push("Nome deve ter pelo menos 2 caracteres.");
  if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/))
    errors.push("E-mail inválido.");
  if (!phone) errors.push("Telefone é obrigatório.");

  const isPasswordBeingUpdated = password.length > 0 || confirmPassword.length > 0;

  if (isPasswordBeingUpdated) {
    if (!isValidPassword(password)) {
      errors.push("Senha deve ter ao menos 8 caracteres, incluindo letra maiúscula, minúscula, número e símbolo.");
    }
    if (password !== confirmPassword) {
      errors.push("As senhas não coincidem.");
    }
  }

  if (errors.length > 0) {
    showAlert("erro", "Atenção", errors.join("\n"));
    return;
  }

  const requestData = {
    NAME: name,
    EMAIL: email,
    PHONE: removeMask(phone),
    USER_TYPE: userType
  };

  if (isPasswordBeingUpdated) {
    requestData.PASSWORD = password;
  }

  $("#spinner").modal("show");

  $.ajax({
    url: `api/users/${userHash}`,
    method: "PATCH",
    contentType: "application/json",
    dataType: "json",
    data: JSON.stringify(requestData),
    headers: {
      Authorization: "Bearer " + localStorage.getItem("token")
    }
  })
  .done(function (response) {
    if (response.result === true) {
      showAlert("sucesso", "Sucesso", "Usuário atualizado com sucesso!");
      $("#userModal").modal("hide");
      getAllUsers();
    } else {
      showAlert("erro", "Atenção", response.message || "Falha ao atualizar usuário.");
    }
  })
  .fail(function (xhr, status, error) {
    showAlert("erro", "Atenção", "Falha ao atualizar usuário.");
  })
  .always(function () {
    $("#spinner").modal("hide");
  });
}

$("#saveUserBtn").on("click", function () {

  if($("#updateUserHash").val() != "") {
    updateUser();
  }else{
    registerUser(); 
  }
});




