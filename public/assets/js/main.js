$.ajaxSetup({
  headers: {
    Authorization: "Bearer " + localStorage.getItem("token")
  },
  error: function (xhr) {
    if (xhr.status === 401) {
      showAlert("erro", "Atenção", "Sessão expirada. Por favor, faça login novamente.");
      localStorage.removeItem("token");
      window.location.href = "/";
    }
  }
});



$(document).on('keypress', '.phone',function () {
  $(this).mask('(00)00000-0000');
});

function maskPhone(value) {
  value = value.replace(/\D/g, '');
  if (value.length === 11) {
    return value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
  } else if (value.length === 10) {
    return value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
  } else {
    return value;
  }
}

function removeMask(str) {
  return str.replace(/[.,%\-\/R$\(\)\s]/g, '');
}

function isValidPassword(password) {
  const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,72}$/;
  return regex.test(password);
}

function showAlert(type, title, message, isModal = false) {
  $("#header-alerta").empty();

  $("#header-alerta").append(`
    <div>
      <i class="bi bi-check-circle text-light" id="icone-alerta"></i>
      <strong class="mr-auto text-light" id="titulo-alerta"></strong>
    </div>
  `);

  $("#header-alerta").append(`
    <i class="bi bi-x-circle text-light pointer" data-bs-dismiss="toast" aria-label="Close" id="icone-alerta"></i>
  `);

  const $titleElement = $(`#titulo-alerta${isModal ? '-modal' : ''}`);
  const $messageElement = $(`#mensagem-alerta${isModal ? '-modal' : ''}`);
  const $headerElement = $(`#header-alerta${isModal ? '-modal' : ''}`);
  const $iconElement = $(`#icone-alerta${isModal ? '-modal' : ''}`);

  const headerClasses = ['bg-success', 'bg-danger', 'bg-warning', 'bg-info'];
  const titleClasses = ['text-light', 'text-dark'];
  const iconClasses = [
    'text-light',
    'text-dark',
    'bi-check-circle',
    'bi-exclamation-circle',
    'bi-info-circle',
    'bi-x-circle',
  ];

  headerClasses.forEach(cls => $headerElement.removeClass(cls));
  titleClasses.forEach(cls => $titleElement.removeClass(cls));
  iconClasses.forEach(cls => $iconElement.removeClass(cls));

  $titleElement.html(title);
  $messageElement.html(message);

  switch (type) {
    case 'sucesso':
      $headerElement.attr("class", "toast-header d-flex justify-content-between bg-success");
      $titleElement.attr("class", "mr-auto text-light");
      $iconElement.attr("class", "bi-check-circle text-light");
      break;
    case 'erro':
      $headerElement.attr("class", "toast-header d-flex justify-content-between bg-danger");
      $titleElement.attr("class", "mr-auto text-light");
      $iconElement.attr("class", "bi-x-circle text-light");
      break;
    case 'info':
      $headerElement.attr("class", "toast-header d-flex justify-content-between bg-info");
      $titleElement.attr("class", "mr-auto text-dark");
      $iconElement.attr("class", "bi-info-circle text-dark");
      break;
    case 'alerta':
      $headerElement.attr("class", "toast-header d-flex justify-content-between bg-warning");
      $titleElement.attr("class", "mr-auto text-dark");
      $iconElement.attr("class", "bi-exclamation-circle text-dark");
      break;
  }

  isModal ? $('.toast-modal').toast('show') : $('.toast').toast('show');
}