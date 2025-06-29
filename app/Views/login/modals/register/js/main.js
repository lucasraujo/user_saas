
$(document).on("click", "#create-acount", function () {
  $("#userModal").modal("show");
});

function isValidPassword(password) {
  const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,72}$/;
  return regex.test(password);
}

// $("#saveUserBtn").on("click", function () {
//   const name = $("#name").val().trim();
//   const email = $("#email").val().trim();
//   const phone = $("#phone").val().trim();
//   const password = $("#password").val();
//   const confirmPassword = $("#password-2").val();

//   let errors = [];

//   if (name.length < 2) errors.push("Nome deve ter pelo menos 2 caracteres.");
//   if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/))
//     errors.push("E-mail inválido.");
//   if (!phone) errors.push("Telefone é obrigatório.");
//   if (!isValidPassword(password)) {
//     errors.push(
//       "Senha deve ter ao menos 8 caracteres, incluindo letra maiúscula, minúscula, número e símbolo."
//     );
//   }
//   if (password !== confirmPassword) errors.push("As senhas não coincidem.");

//   if (errors.length > 0) {
//     alert(errors.join("\n"));
//     return;
//   }

//   $.ajax({
//     url: '<?= base_url("/users") ?>',
//     method: "POST",
//     data: JSON.stringify({
//       NAME: name,
//       EMAIL: email,
//       PHONE: phone,
//       PASSWORD: password,
//     }),
//     success: function (response) {
//       alert("Usuário salvo com sucesso!");
//       $("#userModal").modal("hide");
//       $("#userForm")[0].reset();
//     },
//     error: function (xhr) {
//       alert("Erro ao salvar usuário: " + xhr.responseJSON.message);
//     },
//   });
// });
