<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">User SaaS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link pointer" href="#" id="enter">Entrar</a></li>
                <!-- <li class="nav-item"><a class="nav-link pointer" href="#" id="create-acount">Criar Conta</a></li> -->
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <article>
                <header class="mb-4">
                    <h1 class="fw-bolder mb-1">Bem-vindo ao User SaaS</h1>
                    <p class="text-muted">Uma solução simples, segura e eficiente para gerenciamento de usuários.</p>
                </header>
                <figure class="mb-4 text-center">
                    <img class="img-fluid rounded" src="<?= base_url('assets/img/users.png')?>" alt="User Login">
                </figure>
                <section class="mb-5">
                    <p class="fs-5 mb-4">Nosso sistema SaaS permite que empresas ou desenvolvedores gerenciem usuários.</p>

                    <p class="fs-5 mb-4">Com um painel intuitivo e responsivo, você pode visualizar, criar, editar e deletar usuários com poucos cliques. Toda a comunicação com a API é segura, utilizando tokens JWT para autenticação.</p>


                    <h2 class="fw-bolder mb-4 mt-5">Principais Recursos</h2>
                    <ul class="fs-5 mb-4">
                        <li>✅ Cadastro e login de usuários com validações</li>
                        <li>✅ Integração com API RESTful protegida com JWT</li>
                        <li>✅ Design limpo e responsivo com Bootstrap 5</li>
                        <li>✅ Painel administrativo com listagem de usuários</li>
                        <li>✅ Pronto para deploy em Docker</li>
                    </ul>
                </section>
            </article>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">Sobre o Projeto</div>
                <div class="card-body">
                    Este projeto foi desenvolvido em <strong>CodeIgniter 4</strong>, com um backend robusto e preparado para crescimento. O objetivo é oferecer uma base sólida para qualquer tipo de sistema que precise de autenticação e controle de usuários.
                </div>
            </div>
        </div>
    </div>
</div>