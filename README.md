# 🧩 User SaaS - Gerenciamento de Usuários com CodeIgniter 4

Sistema para **gerenciamento de usuários**, com autenticação via **JWT**, desenvolvido em **CodeIgniter 4** e pronto para rodar em ambiente **Docker**.

---

## 🚀 Como rodar o projeto

## O ENV foi exposto propositalmente para que não aja nenhum transtorno ao tentar rodar o projeto localmente
Certifique-se de ter o **Docker** instalado. Depois, execute os seguintes comandos abaixo no terminal, na raiz do projeto:

```bash
#!/bin/bash

./start.sh

```

O sistema será iniciado e estará disponível em:

```
http://localhost:3002
```

---

## 🔐 Usuário Padrão

O sistema já possui um usuário administrador cadastrado no banco de dados:

```json
{
  "EMAIL": "admin@gmail.com",
  "PASSWORD": "@Admin1234"
}
```

Use essas credenciais para realizar login e acessar os endpoints protegidos.

---

## 📡 Endpoints da API

Todas as rotas estão sob o prefixo `/api`.

> ⚠️ Todas as rotas (exceto `/login`) requerem autenticação via JWT:  
> Envie o token no header:  
> `Authorization: Bearer {seu_token}`

---

### 🔑 Autenticação

**POST** `/api/login`  
Realiza o login e retorna um token JWT.

**Request Body**:
```json
{
  "EMAIL": "admin@gmail.com",
  "PASSWORD": "@Admin1234"
}
```

**Response**:
```json
{
  "result": true,
  "token": "JWT_TOKEN",
  "message": "Login efetuado com sucesso"
}
```

---

### 👤 Usuário Logado

**GET** `/api/users/me`  
Retorna os dados do usuário autenticado.

---

### 👥 Gerenciamento de Usuários

| Método  | Endpoint                | Descrição                         |
|---------|-------------------------|-----------------------------------|
| `GET`   | `/api/users`            | Lista todos os usuários           |
| `GET`   | `/api/users/:uuid`      | Retorna um usuário específico     |
| `POST`  | `/api/users`            | Cria um novo usuário              |
| `PATCH` | `/api/users/:uuid`      | Atualiza os dados de um usuário   |
| `DELETE`| `/api/users/:uuid`      | Remove um usuário                 |
| `GET`   | `/api/users/types`      | Lista os tipos de usuários        |

---

## 🧪 Exemplo de criação de usuário

**POST** `/api/users`

**Request Body**:
```json
{
  "NAME": "Lucas",
  "EMAIL": "lucas@example.com",
  "PHONE": "31999998888",
  "PASSWORD": "@Senha123",
  "USER_TYPE": "'hash'"
}
```

---

## 📁 Estrutura do Projeto

```
.
├── app/                 # Código-fonte do sistema (MVC)
├── public/              # Pasta pública (index.php)
├── writable/            # Logs, uploads e cache
├── start.sh             # Script para iniciar com Docker
├── docker-compose.yml   # Configuração do ambiente
└── README.md            # Este arquivo
```

---

## ⚙️ Tecnologias Utilizadas

- PHP 8.x
- CodeIgniter 4
- JWT (JSON Web Token)
- MySQL
- Docker
- Bootstrap 5

---

## 👨‍💻 Autor

Desenvolvido por **Lucas Martins**