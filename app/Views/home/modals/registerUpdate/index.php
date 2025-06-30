
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <input type="text" class="d-none" id="updateUserHash">
      <div class="modal-header">
        <h5 class="modal-title" id="userModalLabel">Cadastro de Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      
      <div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="name" class="form-label">Nome completo*</label>
              <input type="text" class="form-control" id="name" name="NAME" required>
            </div>

            <div class="col-md-6 mb-3">
              <label for="email" class="form-label">E-mail*</label>
              <input type="email" class="form-control" id="email" name="EMAIL" required>
            </div>

            <div class="col-md-6 mb-3">
              <label for="phone" class="form-label">Telefone*</label>
              <input type="tel" class="form-control" id="phone" name="PHONE" required>
            </div>

            <div class="col-md-6 mb-3">
              <label for="password" class="form-label">Senha*</label>
              <input type="password" class="form-control" id="password" name="PASSWORD" required>
            </div>

            <div class="col-md-6 mb-3">
              <label for="userType" class="form-label">Tipo de usuário*</label>
              <select class="form-select" id="userType" name="USER_TYPE" required>
                <option value="" disabled selected>Selecione o tipo de usuário</option>
          
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label for="password-2" class="form-label">Confirme a senha*</label>
              <input type="password" class="form-control" id="password-2" name="PASSWORD2" required>
            </div>

          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="saveUserBtn">Salvar</button>
        </div>
      </div>
    </div>
  </div>
</div>