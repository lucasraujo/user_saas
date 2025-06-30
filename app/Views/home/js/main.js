
const Tusers = $('#tabelaUsuarios').DataTable({
  language: {
    zeroRecords: "Nenhum registro encontrado",
    paginate: {
      next: "<i class='fa fa-chevron-right'></i>",
      previous: "<i class='fa fa-chevron-left'></i>"
    }
  },
  searching: false,     
  lengthChange: false,  
  info: false,          
  pageLength: 10        
});


async function getMyData() { 
  let token = localStorage.getItem("token");

  if (!token) { 
    window.location.href = "/";
    return;
  }

  $("#spinner").modal("show");

  await $.ajax({
    url: "api/users/me",
    method: "GET",
    contentType: "application/json",
    dataType: "json",
    async: true,
    headers: {
      "Authorization": "Bearer " + token
    }
  })
  .done(function (data) {
    if (data.result === true) {
      $("#userEmail").text(data.response[0].EMAIL);
      $("#userNome").text(data.response[0].NAME);
      $("#hashLoggedUser").val(data.response[0].HASH);

    } else {
      alert("Erro: Falha na autenticação.");
      window.location.href = "/";
    }
  })
  .fail(function (xhr, status, error) {
    console.error("Erro ao buscar dados:", error);
    alert("Erro ao buscar informações do usuário.");
    window.location.href = "/";
  })
  .always(function () {
    $("#spinner").modal("hide");
  });
}


async function getAllUsers() {

  const token = localStorage.getItem("token");

  if (!token) {
    window.location.href = "/";
    return;
  }

  $("#spinner").modal("show");

  await $.ajax({
    url: "api/users",
    method: "GET",
    contentType: "application/json",
    dataType: "json",
    headers: {
      Authorization: "Bearer " + token
    }
  })
  .done(function (data) {
      $("#spinner").modal("hide");
    if (data.result === true && Array.isArray(data.response)) {
      Tusers.clear();
      data.response.forEach(function (user) {
        Tusers.row.add([
          user.NAME,
          user.EMAIL,
          user.PHONE,
          user.DESCRIPTION,
          `
          <div class="d-flex justify-content-center">
          ${$("#hashLoggedUser").val() === user.HASH ? "" :
            `<span class="btn btn-sm btn-warning btn-editar me-2" data-user='${JSON.stringify(user)}' data-id="${user.HASH}"><i class="bi bi-pencil-fill"></i></span>
            <span class="btn btn-sm btn-danger btn-excluir" data-id="${user.HASH}"><i class="bi bi-trash3-fill"></i></span>`
          }
          </div>
          `
        ]);
      });

      Tusers.draw();
    } else {
      alert("Erro ao carregar usuários.");
    }
  })
  .fail(function (xhr, status, error) {

    if(status === 401) {
      alert("Sessão expirada. Por favor, faça login novamente.");
      localStorage.removeItem("token");
      window.location.href = "/";
    }

    console.error("Erro na requisição:", error);
    alert("Falha ao buscar usuários.");
    $("#spinner").modal("hide");

  })
  .always(function () {
    $("#spinner").modal("hide");
  });
}

$(document).on("click", ".btn-excluir", function () {
  const userHash = $(this).data("id");
  if (!confirm("Você tem certeza que deseja excluir este usuário?")) {
    return;
  }
  $("#spinner").modal("show");
  $.ajax({
    url: `api/users/${userHash}`,
    method: "DELETE",
    contentType: "application/json",
    dataType: "json",
    headers: {
      Authorization: "Bearer " + localStorage.getItem("token")
    }
  })
  .done(function (data) {
    if (data.result === true) {
      getAllUsers();
      alert("Usuário excluído com sucesso.");
    } else {
      alert("Erro ao excluir usuário.");
    }
  })
  .fail(function (xhr, status, error) {
    console.error("Erro na requisição:", error);
    alert("Falha ao excluir usuário.");
    if(status === 401) {
      alert("Sessão expirada. Por favor, faça login novamente.");
      localStorage.removeItem("token");
      window.location.href = "/";
    }
  })
  .always(function () {
    $("#spinner").modal("hide");
  });
})

function getTypesOfUsers() {
  const token = localStorage.getItem("token");

  $("#spinner").modal("show");
  if (!token) {
    window.location.href = "/";
    return;
  }
  $.ajax({
    url: "api/users/types",
    method: "GET",
    contentType: "application/json",
    dataType: "json",
    headers: {
      Authorization: "Bearer " + token
    }
  })
  .done(function (data) {
    $("#spinner").modal("hide");
    if (data.result === true) {
      const select = $("#userType");
      select.empty();
      select.append('<option value="" disabled selected>Selecione o tipo de usuário</option>');
      data.response.forEach(type => {
        select.append(`<option value="${type.HASH}">${type.DESCRIPTION}</option>`);
      });
    } else {
      alert("Erro ao carregar tipos de usuário.");
    }
  })
  .fail(function (xhr, status, error) {
    $("#spinner").modal("hide");
    console.error("Erro ao buscar tipos de usuário:", error);
    alert("Erro ao buscar tipos de usuário.");
  }).always(function () {
    $("#spinner").modal("hide");
  });
}

$(document).ready( async function() {
  await getMyData();
  getAllUsers();
  getTypesOfUsers();
})