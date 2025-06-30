<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#!">User SaaS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="#" id="logout">SAIR</a></li>
      </ul>
    </div>
  </div>
</nav>

<input name="" class="d-none" id="hashLoggedUser"></input>

<div class="container mt-5" style="min-height: 80vh;">
  <div class="row">
    <div class="col-lg-4">
      <div class="card mb-4">
        <div class="card-header">Seus Dados</div>
        <div class="card-body">
          <p><strong>Nome:</strong> <span id="userNome">Carregando...</span></p>
          <p><strong>Email:</strong> <span id="userEmail">Carregando...</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Usuários</h5>
          <button class="btn btn-primary btn-sm" id="btnAdicionarUsuario"><i class="bi bi-plus-lg"></i> Adicionar Usuário</button>
        </div>
        <div class="card-body">
          <table id="tabelaUsuarios" class="table table-striped" style="width: 100%;">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Tipo</th>
                <th class="text-center">Ações</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>