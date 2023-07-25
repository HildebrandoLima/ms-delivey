## API DE DELIVERY

Para fins de estudo e ampliação de meu conhecimento com o Framework Laravel. O projeto resulta em uma api flexível para aplicações como: (delivery, e-commerce e pdv). Nela abordo temas com foco em POO, DTOs, padrões de projetos, SOLID, arquitetura limpa e distribuída. Bem como o ecossistema do Framework em si: Migrations, Eloquent, Relationships, Factories, Seeders, Storage (Upload Múltiplo de Imagens), Autenticação padrão JWT e Solialite, Permissões, Providers, Mails, Jobs (envio de e-mails e atualização de estoque), ambiente com Docker, e TDD (Testes de integração e de unidade). A documentação abaixo da api, será separada, melhoradada, na próxima release após a versão dos testes.

### [Crie sua massa de testes para CPF, CNPJ, CEP/Endereço e afins, clicando aqui!](https://www.4devs.com.br/)

### Aplicação Web desenvolvida com:<br />
- Laravel/PHP<br />
- MySQL para banco de dados.<br/>

### Funcionalidades (Atualmente desenvolvidas)
<ul>
    <li>CRUD de Usuário</li>
    <li>CRUD de Endereço</li>
    <li>CRUD de Telefone</li>
    <li>CRUD de Fornecedor</li>
    <li>CRUD de Categoria</li>
    <li>CRUD de Produto</li>
    <li>CRUD de Imagem</li>
    <li>CRUD de Pedido</li>
    <li>CRUD de Item</li>
    <li>CRUD de Pagamento</li>
    <li>Job (Disparo de e-mail ao cadastrar cliente/fornecedor)</li>
    <li>Job (Disparo de e-mail ao criar pedido)</li>
    <li>Validação de dados (CPF, CNPJ, CEP, E-mail, Telefone e Celular, EAN)</li>
    <li>Autenticação (login, logout e esqueci minha senha)</li>
    <li>Autenticação Solialite (GitHub, Google e Facebook)</li>
    <li>Permissões</li>
</ul>

### Funcionalidades (A desenvolver)
<ul>
    <li>Integração com os Correios</li>
    <li>Job (Atualização de Estoque)</li>
    <li>CRUD Caixa (Fluxo, Abertura e Fechamento)</li>
    <li>CRUD Promoção</li>
    <li>CRUD Desconto</li>
    <li>CRUD NF-e</li>
    <li>CRUD Faturamento</li>
</ul>

## UML
### Visão Cliente<br/>

![Captura de tela de 2023-02-28 14-02-40](https://user-images.githubusercontent.com/47666194/221933419-f1fb4bc2-b8b1-46a7-8db1-0da1f82936d4.png)

### Visão Admin<br />

![Captura de tela de 2023-02-28 14-02-56](https://user-images.githubusercontent.com/47666194/221933281-3549c4e1-ec86-4491-9f14-413ecf334c27.png)

### Modelagem de Dados

![Modelagem de Dados ms-delivery](https://github.com/HildebrandoLima/ms-delivey/assets/47666194/c5d2288e-9b57-4b4e-9071-cde63cf7e48a)



## Faça Você Mesmo

<details>
<summary>Detalhes</summary>

### Requesitos necessários para executar o projeto:
<ul>
    <li>Instalar o PHP versão 8.0</li>
    <li>Instalar o Laravel versão 9.0</li>
    <li>Instalar o MySQL versão 8.0</li>
    <li>Instalar o composer versão 2.4.0</li>
    <li>Instalar o Postman ou Insomnia</li>
    <li>Instalar uma IDE de sua escolha (PHPStorm / VSCode)</li>
    <li>Instalar um cliente SQL de sua escolha (DBeaver / PHPMyAdmin / MySQL WorkBench)</li>
</ul>

### Executar o projeto:
<ul>
    <li>Clone o projeto: git clone https://github.com/HildebrandoLima/ms-delivey.git</li>
    <li>Adicione o arquivo .env</li>
    <li>Execute os comandos: composer install | php artisan key:generate | php artisan jwt:secret</li>
    <li>Certifique-se que um diretório chamado `**/vendor**` foi criado.</li>
    <li>Execute o comando: php artisan serve</li>
</ul>

### Banco de Dados:
> Obanco de dados é do tipo relacional.

### Criando o Banco de de Dados:
> No seu .env adicione da seguinte forma:<br />

> DB_CONNECTION=mysql<br />
> DB_HOST=localhost<br />
> DB_PORT=3306<br />
> DB_DATABASE=ms_delivery<br />
> DB_USERNAME=nome_do_usuario<br />
> DB_PASSWORD=sua_senha<br />

Execute o comando para criar as tabelas:

```
    php artisan migrate
```

Há algumas tabelas que possuem dados já padronizados, são elas: ddd, método de pagamento, perfil e uf. Então, execute os seguintes comandos para preenchê-las:

```
    php artisan db:seed --class=DiscagemDiretaDistanciaSeeder
```

```
    php artisan db:seed --class=MetodoPagamentoSeeder
```

```
    php artisan db:seed --class=PermissionSeeder
```

```
    php artisan db:seed --class=UnidadeFederativaSeeder
```

Certifique-se que as tabelas foram criadas. Abrindo o cliente SQL que você escolheu, e então execute o comando:

```
    SHOW TABLES;
```

### [Caso ocorra erro ao executar as migrations, clique aqui!](https://blog.renatolucena.net/post/como-fazer-rollback-de-migration-de-bd-no-laravel)

### E-mail:

### [Crie uma conta na plataforma mailtrap clicando aqui!](https://mailtrap.io/)

> No seu .env adicione da seguinte forma:<br />

> MAIL_MAILER=smtp<br />
> MAIL_HOST=seu_host<br />
> MAIL_PORT=2525<br />
> MAIL_USERNAME=seu_usuario<br />
> MAIL_PASSWORD=sua_senha<br />
> MAIL_ENCRYPTION=tls<br />
> MAIL_FROM_ADDRESS="hello@example.com"<br />
> MAIL_FROM_NAME="${APP_NAME}"<br />

### Para iniciar o servidor:
`php artisan serve`
Agora acesse o endereço http://localhost:8000/api/rota em seu Postman ou Insomnia
</details>



## Usando Docker

<details>
<summary>Detalhes</summary>

Clone o projeto

```
git clone https://github.com/HildebrandoLima/ms-delivey.git
```

Crie o Arquivo .env

> No seu .env adicione da seguinte forma:<br />

> DB_CONNECTION=mysql<br />
> DB_HOST=db<br />
> DB_PORT=3306<br />
> DB_DATABASE=laravel<br />
> DB_USERNAME=root<br />
> DB_PASSWORD=root<br />

> MAIL_MAILER=smtp<br />
> MAIL_HOST=localhost<br />
> MAIL_PORT=1025<br />
> MAIL_USERNAME=null<br />
> MAIL_PASSWORD=null<br />
> MAIL_ENCRYPTION=null<br />
> MAIL_FROM_ADDRESS="hello@example.com"<br />
> MAIL_FROM_NAME="${APP_NAME}"<br />

<ul>
<li>Execute o comando: docker-compose up -d</li>
<li>Entre no container app: docker-compose exec app bash</li>
<li>Instale as dependências do projeto: composer install</li>
<li>Gere a chave do projeto: php artisan key:generate</li>
<li>Depois execute o comando: php artisan optimize:clear</li>
<li>Acesse o link: (http://localhost:8080)</li>
</ul>

Dentro de seu container app, execute o comando para criar as tabelas:

```
    php artisan migrate
```

Há algumas tabelas que possuem dados já padronizados, são elas: ddd, método de pagamento, perfil e uf. Então, ainda dentro se seu container app, execute os seguintes comandos para preenchê-las:

```
    php artisan db:seed --class=DiscagemDiretaDistanciaSeeder
```

```
    php artisan db:seed --class=MetodoPagamentoSeeder
```

```
    php artisan db:seed --class=PermissionSeeder
```

```
    php artisan db:seed --class=UnidadeFederativaSeeder
```

Para saber se tudo deu certo. Seus containers estarão assim:

![Captura de tela de 2023-06-27 09-58-07](https://github.com/HildebrandoLima/ms-delivey/assets/47666194/6d90cbb0-95d0-4ec9-956a-7c3e0f73f350)

Seu servidor de email:

![Captura de tela de 2023-06-27 10-17-09](https://github.com/HildebrandoLima/ms-delivey/assets/47666194/edcb6c8e-d815-4d57-b19b-cfeff236253d)

</details>



### API DOCUMENTAÇÃO

<ul>
    <li>Todos os parâmetros 'id' são enviados em base64. O back-end se responsabiliza em decodificar.</li>
    <li>Nos body de endereço e telefone, é preciso identificar quem se referência os mesmos. No caso de usuário ("usuarioId": 2) ou fornecedor ("fornecedorId": 2)</li>
    <li>Os registros não são deletados, e sim ativados e desativados, sempre que necessário.</li>
    <li>Perfil 1 (Admin) e 2 (Cliente)</li>
</ul>

### Login

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|             ROTA                   |
|------|------------------------------------|
| POST | /api/auth/login                    |
|------|------------------------------------|
| POST | /api/auth/forgot-password          |
|------|------------------------------------|
| POST | /api/auth/refresh-password/{token} |
|------|------------------------------------|
| POST | /api/auth/logout                   |
|------|------------------------------------|
|GET   | /api/email-verified/save/{entity}  |

Atenção: A senha é validada como padrão de forte.

<li>8 caracteres no mínimo</li>
<li>1 Letra Maiúscula no mínimo</li>
<li>1 Número no mínimo</li>
<li>1 Caracter especial no mínimo: $*&@#</li>
<li>Não é permitido sequência como: aa, bb, 44, etc</li>

> No seu .env adicione da seguinte forma:<br />

> URL_FRONT_FORGOT_PASSWORD=http://localhost:8000/api/auth/forgot-password

<li>O link acima funciona para enviar o link no email para redefinição de senha</li>
<li>Ele deve ser a mesma url do front-end</li>

### Body: POST
```
{
    "email": "test@gmail.com",
    "password": "Hild3br@nd0",
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Login efetuado com sucesso!",
    "data": {
        "acessToken": token,
        "userId": id,
        "userName": name,
        "userEmail": email,
        "isAdmin": true or false
        "permissions": []
    },
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Logout efetuado com sucesso!",
    "data": "true",
    "status": 200,
    "details": ""
}

```

```
{
    "message": "Solicitação de redefinação de senha efetuada com sucesso!",
    "data": "true",
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Mudança de senha efetuada com sucesso!",
    "data": "true",
    "status": 200,
    "details": ""
}
```

</details>

<details>
<summary>400 - Bad Request</summary>

```
{
    "message": "E-mail inválido!",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Senha inválida!",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Não foi possível modificar senha!",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao logar!",
    "data": "false",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao solicitar mudança de senha!",
    "data": "false",
    "status": 400,
    "details": ""
}
```

</details>
</details>

### Login Social

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|                 ROTA                      |
|------|-------------------------------------------|
| GET  | /api/auth/login/social{provider}          |
|------|-------------------------------------------|
| GET  | /api/auth/login/social{provider}/callback |

Atenção: Essa forma de logar, funciona com os dados da rede social de sua escolha. Teste as rotas em seu navegador.

Configure nas redes sociais e obtenha as credenciais para autorização e autenticação de acesso.

[GOOGLE](https://console.developers.google.com/?hl=pt-br)

[GITHUB](https://github.com/login)

[FACEBOOK!](https://developers.facebook.com/?locale=pt_BR)

> No seu .env adicione da seguinte forma:<br />

> GOOGLE_CLIENT_ID=codigo_gerado<br />
> GOOGLE_CLIENT_SECRET=chave_gerada<br />
> GOOGLE_CALLBACK_URL=http://localhost:8000/api/auth/login/social/google/callback<br />

> GITHUB_CLIENT_ID=codigo_gerado<br />
> GITHUB_CLIENT_SECRET=chave_gerada<br />
> GITHUB_CALLBACK_URL=http://localhost:8000/api/auth/login/social/github/callback<br />

> FACEBOOK_CLIENT_ID=codigo_gerado<br />
> FACEBOOK_CLIENT_SECRET=chave_gerada<br />
> FACEBOOK_CALLBACK_URL=http://localhost:8000/api/auth/login/social/facebook/callback<br />

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Login efetuado com sucesso!",
    "data": {
        "acessToken": token,
        "userId": id,
        "userName": name,
        "userEmail": email,
        "isAdmin": true or false,
        "permissions" []
    },
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Logout efetuado com sucesso!",
    "data": "true",
    "status": 200,
    "details": ""
}

```

</details>

<details>
<summary>400 - Bad Request</summary>

```
{
    "message": "Por favor, faça login usando o Facebook, GitHub ou Google!",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Credenciais Inválidas!",
    "data": "",
    "status": 400,
    "details": ""
}
```

</details>
</details>

### Usuário

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|          ROTA            |
|------|--------------------------|
| GET  | /api/user/list           |
|------|--------------------------|
| GET  | /api/user/list/find      |
|------|--------------------------|
| PUT  | /api/user/edit/{id}      |
|------|--------------------------|
| POST | /api/user/save           |
|------|--------------------------|
|DELETE| /api/user/enable/disable |

Em perfil é verdadeiro para admin e false para cliente.

### Body: POST
```
{
    "perfil": true or false
    "nome": "Hill",
    "cpf": "572.561.700-92",
    "email": "test@gmail.com",
    "senha": "Hil@03#1.4",
    "dataNascimento": "2023-03-25 18:20:59",
    "genero": "Feminino",
    "ativo": 1
}
```

### Body: PUT
```
{
    "perfil": true or false
    "nome": "Hill",
    "email": "test@gmail.com",
    "genero": "Feminino",
    "ativo": 1
}
```

Lembre-se de passar os parâmetros nas rotas de listagem.

<li>?page=1&perPage=10&active=1</li>
<li>/find?id=Mjg=&active=1</li>
<li>/find?search=Hill=&active=1</li>

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso!",
    "data": id_do_ultimo_cadastro,
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Edição efetuada com sucesso!",
    "data": "true",
    "status": 200,
    "details": ""
}
```

</details>

<details>
<summary>400 - Bad Request</summary>

```
{
    "message": "O usuário já existe!",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação!",
    "data": "false",
    "status": 400,
    "details": ""
}
```

</details>

<details>
<summary>403 - Forbidden</summary>

```
{
    "message": "Você não possue permissão!",
    "data": "false",
    "status": 403,
    "details": ""
}
```

</details>
</details>

### Fornecedor

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|            ROTA              |
|------|------------------------------|
| GET  | /api/provider/list           |
|------|------------------------------|
| GET  | /api/provider/list/{id}      |
|------|------------------------------|
| POST | /api/provider/save           |
|------|------------------------------|
| PUT  | /api/provider/edit/{id}      |
|------|------------------------------|
|DELETE| /api/provider/enable/disable |

Lembre-se de passar os parâmetros nas rotas de listagem.

<li>?page=1&perPage=10&active=1</li>
<li>/find?id=Mjg=&active=1</li>
<li>/find?search=System=&active=1</li>

### Body: POST/PUT
```
{
    "razaoSocial": "Teste Test",
    "cnpj": "89.872.593/0001-90",
    "email": "hill@email.com.br",
    "dataFundacao": "2022-12-25 13:28:59",
    "ativo": 1
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso!",
    "data": id_do_ultimo_cadastro,
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Edição efetuada com sucesso!",
    "data": "true",
    "status": 200,
    "details": ""
}
```

</details>

<details>
<summary>400 - Bad Request</summary>

```
{
    "message": "O fornecedor já existe!",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação!",
    "data": "false",
    "status": 400,
    "details": ""
}
```

</details>

<details>
<summary>403 - Forbidden</summary>

```
{
    "message": "Você não possue permissão!",
    "data": "false",
    "status": 403,
    "details": ""
}
```

</details>
</details>

### Endereço

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|              ROTA           |
|------|-----------------------------|
| GET  | /api/address/list/uf        |
|------|-----------------------------|
| POST | /api/address/edit           |
|------|-----------------------------|
| PUT  | /api/address/save           |
|------|-----------------------------|
|DELETE| /api/address/enable/disable |

### Body: POST
```
{
    "logradouro": "Rua",
    "descricao": "KKK N°25",
    "bairro": "Centro",
    "cidade": "Fortaleza",
    "cep": 1234-567,
    "ufId": 1,
    "usuarioId": 24,
    "ativo": true
}
```

ou

```
{
    "logradouro": "Rua",
    "descricao": "KKK N°25",
    "bairro": "Centro",
    "cidade": "Fortaleza",
    "cep": 1234-567,
    "ufId": 1,
    "fornecedorId": 33,
    "ativo": true
}
```

### Body: PUT
```
{
    "id": 1,
    "logradouro": "Rua",
    "descricao": "KKK N°25",
    "bairro": "Centro",
    "cidade": "Fortaleza",
    "cep": 1234-567,
    "ufId": 1,
    "usuarioId": 24,
    "ativo": true
}
```

ou

```
{
    "id": 1,
    "logradouro": "Rua",
    "descricao": "KKK N°25",
    "bairro": "Centro",
    "cidade": "Fortaleza",
    "cep": 1234-567,
    "ufId": 1,
    "fornecedorId": 33,
    "ativo": true
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso.",
    "data": "true",
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Edição efetuada com sucesso.",
    "data": "true",
    "status": 200,
    "details": ""
}
```

</details>

<details>
<summary>400 - Bad Request</summary>

```
{
    "message": "Registro já existente.",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Registro não encontrado",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação.",
    "data": "false",
    "status": 400,
    "details": ""
}
```

</details>

<details>
<summary>403 - Forbidden</summary>

```
{
    "message": "Permissão Negada.",
    "data": "false",
    "status": 403,
    "details": ""
}
```

</details>
</details>

### Telefone

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|            ROTA               |
|------|-------------------------------|
| GET  | /api/telephone/list/ddd       |
|------|-------------------------------|
| POST | /api/telephone/save           |
|------|-------------------------------|
| PUT  | /api/telephone/edit/{id}      |
|------|-------------------------------|
|DELETE| /api/telephone/enable/disable |

### Body: POST/PUT
```
{
    "telefones": [
        {
            "numero": "99506-9315",
            "tipo": "Celular",
            "dddId": 1,
            "usuarioId": 2,
            "ativo": 1
        },
        {
            "numero": "98045-8709",
            "tipo": "Fixo",
            "dddId": 1,
            "usuarioId": 2,
            "ativo": 1
        }
    ]
}
```

ou

```
{
    "telefones": [
        {
            "numero": "99506-9315",
            "tipo": "Celular",
            "dddId": 1,
            "fornecedorId": 3,
            "ativo": 1
        },
        {
            "numero": "98045-8709",
            "tipo": "Fixo",
            "dddId": 1,
            "fornecedorId": 3,
            "ativo": 1
        }
    ]
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso!",
    "data": "true",
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Edição efetuada com sucesso!",
    "data": "true",
    "status": 200,
    "details": ""
}
```

</details>

<details>
<summary>400 - Bad Request</summary>
    
```
{
    "message": "O telefone já existe!",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação!",
    "data": "false",
    "status": 400,
    "details": ""
}
```

</details>

<details>
<summary>401 - Unauthorized </summary>

```
{
    "message": "Acesso não autorizado.",
    "data": [],
    "status": 401,
    "details": ""
}
```

</details>

<details>
<summary>403 - Forbidden</summary>

```
{
    "message": "Permissão negada.",
    "data": [],
    "status": 403,
    "details": ""
}
```

</details>
</details>

### Categoria

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|              ROTA            |
|------|------------------------------|
| GET  | /api/category/list           |
|------|------------------------------|
| GET  | /api/category/list/find      |
|------|------------------------------|
| POST | /api/category/save           |
|------|------------------------------|
| PUT  | /api/category/edit           |
|------|------------------------------|
|DELETE| /api/category/enable/disable |

### Body: POST
```
{
    "nome": "Eletrônicos",
    "ativo": true
}
```

### Body: PUT
```
{
    "id": 1
    "nome": "Eletrônicos",
    "ativo": true
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso!",
    "data": "true",
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Edição efetuada com sucesso!",
    "data": "true",
    "status": 200,
    "details": ""
}
```

</details>

<details>
<summary>400 - Bad Request</summary>

```
{
    "message": "A categoria já existe!",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "A categoria não existe!",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação!",
    "data": "false",
    "status": 400,
    "details": ""
}
```
</details>
<details>

<summary>401 - Unauthorized</summary>

```
{
    "message": "Acesso não autorizado!",
    "data": "false",
    "status": 403,
    "details": ""
}
```

</details>
<details>

<summary>403 - Forbidden</summary>

```
{
    "message": "Permissão Negada!",
    "data": "false",
    "status": 403,
    "details": ""
}
```

</details>
</details>

### Produto

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|            ROTA             |
|------|-----------------------------|
| GET  | /api/product/list           |
|------|-----------------------------|
| GET  | /api/product/list/find      |
|------|-----------------------------|
| POST | /api/product/save           |
|------|-----------------------------|
| PUT  | /api/product/edit/{id}      |
|------|-----------------------------|
|DELETE| /api/product/enable/disable |
    
Lembre-se de passar os parâmetros nas rotas de listagem.

<li>?page=1&perPage=10&active=1</li>
<li>/find?id=Mjg=&active=1</li>
<li>/find?search=TV LED=&active=1</li>

### Body: POST
```
{
    "nome": "TV LED 55' FULLHD",
    "precoCusto": 2,000.99,
    "precoVenda": 2,399.95,
    "codigoBarra": "1234567890123",
    "descricao": "TV LED 55' FULLHD",
    "quantidade": 13,
    "unidadeMedida": "UN",
    "dataValidade": "2024-12-25 13:28:59",
    "categoriaId": 10,
    "fornecedorId": 2,
    "imagens": [files],
    "ativo": 1
}
```

### Body: PUT
```
{
    "nome": "Batata Frita Sabor Original Pringles - 114g",
    "precoCusto": 15.99,
    "precoVenda": 13.99,
    "codigoBarra": "1234567890123",
    "descricao": "Batata Frita Sabor Original Pringles - 114g",
    "quantidade": 13,
    "unidadeMedida": "UN",
    "dataValidade": "2024-12-25 13:28:59",
    "categoriaId": 10,
    "fornecedorId": 2,
    "ativo": 1
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso!",
    "data": id_do_ultimo_cadastro,
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Edição efetuada com sucesso!",
    "data": "true",
    "status": 200,
    "details": ""
}
```

</details>

<details>
<summary>400 - Bad Request</summary>

```
{
    "message": "O produto já existe!",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação!",
    "data": "false",
    "status": 400,
    "details": ""
}
```
</details>

<details>
<summary>403 - Forbidden</summary>

```
{
    "message": "Você não possue permissão!",
    "data": "false",
    "status": 403,
    "details": ""
}
```

</details>
</details>

### Pedido

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|          ROTA             |
|------|---------------------------|
| GET  | /api/order/list           |
|------|---------------------------|
| GET  | /api/order/list/find      |
|------|---------------------------|
| GET  | /api/order/save           |
|------|---------------------------|
|DELETE| /api/order/enable/disable |

Lembre-se de passar os parâmetros nas rotas de listagem.

<li>?page=1&perPage=10&active=1</li>
<li>/find?id=Mjg=&active=1</li>
<li>/find?search=Hill=&active=1</li>

O pedido não pode ser modificado.

### Body: POST
```
{
    "quantidadeItem": 4,
    "total": 102.99,
    "entrega": 13.40,
    "ativo": 1,
    "usuarioId": 3,
    "items": [
        {
            "nome": "Batata Pringles Original 114g",
            "preco": 14.85,
            "codigoBarra": "1324618322141",
            "quantidadeItem": 1,
            "subTotal": 14.85,
            "unidadeMedida": "UN",
            "produtoId": 32
        },
        {
            "nome": "Batata Palha Yoki 105G",
            "preco": 6.59,
            "codigoBarra": "1324618321141",
            "quantidadeItem": 2,
            "subTotal": 13.18,
            "unidadeMedida": "UN",
            "produtoId": 33
        }
    ]
}
```

Não é permitido alterar os dados do pedido.

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso!",
    "data": id_do_ultimo_cadastro,
    "status": 200,
    "details": ""
}
```

</details>

<details>
<summary>400 - Bad Request</summary>

```
{
    "message": "O produto já existe!",
    "data": "",
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação!",
    "data": "false",
    "status": 400,
    "details": ""
}
```
</details>

<details>
<summary>403 - Forbidden</summary>

```
{
    "message": "Você não possue permissão!",
    "data": "false",
    "status": 403,
    "details": ""
}
```

</details>
</details>

### Pagamento

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO |          ROTA            |
|-------|--------------------------|
| POST  | /api/payment/save        |

Até o momento, só faz o registro do pagamento. A listagem vem junto com o pedido.

### Body: POST

Com cartão

```
{
    "numeroCartao": 3433 0684 3408 6543,
    "dataValidade": "2023-05-16 13:44:18",
    "parcela": 3,
    "total": 399.48,
    "ativo": 1,
    "metodoPagamentoId": 1,
    "pedidoId": 25
}
```

Com dinheiro ou PIX

```
{
    "total": 20.50,
    "ativo": 1,
    "metodoPagamentoId": 4,
    "pedidoId": 30
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso!",
    "data": true,
    "status": 200,
    "details": ""
}
```

</details>

<details>
<summary>400 - Bad Request</summary>

```
{
    "message": "Error ao efetuar ação!",
    "data": "false",
    "status": 400,
    "details": ""
}
```
</details>

<details>
<summary>403 - Forbidden</summary>

```
{
    "message": "Você não possue permissão!",
    "data": "false",
    "status": 403,
    "details": ""
}
```

</details>
</details>
