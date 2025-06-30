
$('.cpf').on('keypress', function () {
  $(this).mask('000.000.000-00');
});

$('.phone').on('keypress', function () {
  $(this).mask('(00)00000-0000');
});

function removeMask(str) {
  return str.replace(/[.,%\-\/R$\(\)\s]/g, '');
}

function isValidPassword(password) {
  const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,72}$/;
  return regex.test(password);
}
