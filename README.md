## API DE DELIVERY

Para fins de estudo e ampliação de meu conhecimento com o Framework Laravel. O projeto resulta em uma api flexível para aplicações como: (delivery, e-commerce e pdv). Nela abordo temas com foco em POO, DTOs, padrões de projetos, SOLID, arquitetura limpa e distribuída. Bem como o ecossistema do Framework em si: Migrations, Eloquent, Relationships, Factories, Seeders, Storage (Upload Múltiplo de Imagens), Autenticação padrão JWT e Solialite, Permissões, Providers, Mails, Jobs (envio de e-mails e atualização de estoque), ambiente com Docker, e TDD (Testes de integração e de unidade). A documentação abaixo da api, será separada, melhoradada.

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
    <li>Job (Atualização de Estoque)</li>
    <li>Validação de dados (CPF, CNPJ, CEP, E-mail, Telefone e Celular, EAN)</li>
    <li>Autenticação (login, logout e esqueci minha senha)</li>
    <li>Autenticação Solialite (GitHub, Google e Facebook)</li>
    <li>Permissões</li>
</ul>

### Funcionalidades (A desenvolver)
<ul>
    <li>Integração com os Correios</li>
    <li>CRUD Caixa (Fluxo, Abertura e Fechamento)</li>
    <li>CRUD Promoção</li>
    <li>CRUD Desconto</li>
    <li>CRUD NF-e</li>
    <li>CRUD Faturamento</li>
</ul>

### Segue abaixo link da documentação completa incluindo UML, diagrama de classes, modelagem de classes e detalhes da arquitetura.

[Clique Aqui!!!](https://drive.google.com/file/d/1ZXPKYphXT_yArgcid6dKTTDCi5IUpCAg/view?usp=sharing)

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
    <li>Execute o comando: php artisan storage:link | Para liberar o acesso das imagens do servidor</li>
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

Há algumas tabelas que possuem dados já padronizados, são elas: ddd, método de pagamento, permissões e uf. Então, execute os seguintes comandos para preenchê-las:

```
    php artisan db:seed --class=DiscagemDiretaDistanciaSeeder
```

```
    php artisan db:seed --class=PermissionSeeder
```

```
    php artisan db:seed --class=UnidadeFederativaSeeder
```

Certifique-se que as tabelas foram criadas. Abra seu cliente SQL que você escolheu, e então execute o comando:

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



## Faça com Docker

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
    <li>Entrar no container: docker exec -it name_container bash</li>
    <li>Sair do container: exit</li>
    <li>Acesse o link: (http://localhost:8080/api/rota)</li>
</ul>

Para saber se tudo deu certo. Seus containers estarão assim:

![Captura de tela de 2023-06-27 09-58-07](https://github.com/HildebrandoLima/ms-delivey/assets/47666194/6d90cbb0-95d0-4ec9-956a-7c3e0f73f350)

Seu servidor de email:

![Captura de tela de 2023-06-27 10-17-09](https://github.com/HildebrandoLima/ms-delivey/assets/47666194/edcb6c8e-d815-4d57-b19b-cfeff236253d)

</details>

## Testes

Para executar os testes e certificar que, tudo está ok, prepare seu banco de dados para os testes, configure em seu .env.testing. Ajuste seus casos de testes na classe <b>CreateFirstUserTest</b>, localizado em 'tests\Feature'. Feito isso, execute o comando abaixo:

```
    php artisan test
```

Se preferir executar apenas um teste, execute o comando abaixo:

```
    php artisan test --filter=classeTest
```

Se preferir executar os testes de serviços

```
    php artisan test tests/Unit/Services
```

Se preferir executar os testes de feature

```
    php artisan test tests/Feature
```



## API DOCUMENTAÇÃO

<ul>
    <li>Nos body de endereço e telefone, é preciso identificar quem deseja atribuir os mesmos. No caso de usuário, ex.: ("usuarioId": 1) ou fornecedor, ex.: ("fornecedorId": 1)</li>
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
|GET   | /api/email-verified/               |

<ul>
    <li>Atenção: A senha é validada conforme o padrão abaixo:</li>
    <li>8 caracteres no mínimo</li>
    <li>1 Letra Maiúscula no mínimo</li>
    <li>1 Número no mínimo</li>
    <li>1 Caracter especial no mínimo: $*&@#</li>
    <li>Não é permitido sequência como: aa, bb, 44, etc</li>
    <li>A url abaixo, funciona para enviar o link no email para redefinição de senha</li>
    <li>Ele deve ser a mesma url do front-end</li>
</ul>

> No seu .env adicione da seguinte forma:<br />

> URL_FRONT_FORGOT_PASSWORD=link

### Body: POST
```
{
    "email": "test@gmail.com",
    "password": "@sua_S3nh4$.",
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Login efetuado com sucesso.",
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
    "message": "Logout efetuado com sucesso.",
    "data": true,
    "status": 200,
    "details": ""
}

```

```
{
    "message": "Solicitação de redefinação de senha efetuada com sucesso.",
    "data": true,
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Mudança de senha efetuada com sucesso.",
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
    "message": "E-mail inválido.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Senha inválida.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Não foi possível modificar senha.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao logar.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao solicitar mudança de senha.",
    "data": [],
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

<ul>
<li>Atenção: Essa forma de logar, funciona com os dados da rede social de sua escolha. Teste as rotas em seu navegador.</li>
<li>Configure nas redes sociais e obtenha as credenciais para autorização e autenticação de acesso.</li>
</ul>

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
    "message": "Login efetuado com sucesso.",
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
    "message": "Logout efetuado com sucesso.",
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
    "message": "Por favor, faça login usando o Facebook, GitHub ou Google.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Credenciais Inválidas.",
    "data": [],
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

|MÉTODO|            ROTA               |
|------|-------------------------------|
| GET  | /api/user/email-verified/{id} |
|------|-------------------------------|
| GET  | /api/user/list                |
|------|-------------------------------|
| GET  | /api/user/list/find           |
|------|-------------------------------|
| PUT  | /api/user/edit                |
|------|-------------------------------|
| POST | /api/user/save                |

<ul>
    <li>Em perfil é verdadeiro para admin e false para cliente.</li>
    <li>?page=1&perPage=10&active=1</li>
    <li>?search=Hill&active=1</li>
</ul>

### Body: POST
```
{
    "nome": "Hill",
    "cpf": "572.561.700-92",
    "email": "test@gmail.com",
    "senha": "Hil@03#1.4",
    "dataNascimento": "2023-03-25 18:20:59",
    "genero": "Masculino",
    "perfil": true,
    "ativo": true
}
```

### Body: PUT
```
{
    "id": 1,
    "nome": "Hill",
    "email": "test@gmail.com",
    "genero": "Masculino",
    "perfil": true,
    "ativo": true
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso.",
    "data": id_do_ultimo_cadastro,
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Edição efetuada com sucesso.",
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
    "message": "Registro já existente.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação.",
    "data": [],
    "status": 400,
    "details": ""
}
```

</details>

<details>
<summary>401 - Unauthorized</summary>

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

### Fornecedor

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|            ROTA              |
|------|------------------------------|
| GET  | /api/provider/list           |
|------|------------------------------|
| GET  | /api/provider/list/find      |
|------|------------------------------|
| POST | /api/provider/save           |
|------|------------------------------|
| PUT  | /api/provider/edit           |

<ul>
    <li>?page=1&perPage=10&active=1</li>
    <li>?search=System=&active=1</li>
</ul>

### Body: PUT
```
{
    "razaoSocial": "Teste Test",
    "cnpj": "89.872.593/0001-90",
    "email": "hill@email.com.br",
    "dataFundacao": "2022-12-25 13:28:59",
    "ativo": true
}
```

### Body: PUT
```
{
    "id": 1,
    "razaoSocial": "Teste Test",
    "cnpj": "89.872.593/0001-90",
    "email": "hill@email.com.br",
    "ativo": true
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso.",
    "data": id_do_ultimo_cadastro,
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Edição efetuada com sucesso/",
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
    "message": "Registro já existente.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação.",
    "data": [],
    "status": 400,
    "details": ""
}
```

</details>

<details>
<summary>401 - Unauthorized</summary>

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

### Endereço

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|              ROTA           |
|------|-----------------------------|
| GET  | /api/address/list/uf        |
|------|-----------------------------|
| PUT  | /api/address/save           |

### Body: POST

```
{
    "logradouro": "Rua",
    "descricao": "KKK N°25",
    "bairro": "Centro",
    "cidade": "Fortaleza",
    "cep": 1234-567,
    "uf": "CE",
    "usuarioId": 24,
    "ativo": true
}
```

ou

```
{
    "logradouro": "Avenida",
    "descricao": "KKK N°25",
    "bairro": "Centro",
    "cidade": "Fortaleza",
    "cep": 1234-567,
    "uf": "CE",
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
    "uf": "CE",
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
    "uf": "CE",
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
    "data": true,
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Edição efetuada com sucesso.",
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
    "message": "Registro já existente.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Registro não encontrado.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação.",
    "data": [],
    "status": 400,
    "details": ""
}
```

</details>

<details>
<summary>401 - Unauthorized</summary>

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
    "message": "Permissão Negada.",
    "data": [],
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
| POST | /api/telephone/save           |
|------|-------------------------------|
| PUT  | /api/telephone/edit           |

<ul>
    <li>O campo "tipo", pode ser do tipo: ('Celular', 'Fixo')</li>
</ul>

### Body: POST

```
[
    {
        "ddd": "CE",
        "numero": "(85) 9.9506-9315",
        "tipo": "Celular",
        "usuarioId": 2,
        "ativo": true
    },
    {
        "ddd": "CE",
        "numero": "(85) 9.8045-8709",
        "tipo": "Fixo",
        "dddId": 1,
        "usuarioId": 2,
        "ativo": true
    }
]
```

ou

```
[
    {
        "ddd": "CE",
        "numero": "99506-9315",
        "tipo": "Celular",
        "fornecedorId": 3,
        "ativo": true
    },
    {
        "ddd": "CE",
        "numero": "98045-8709",
        "tipo": "Fixo",
        "fornecedorId": 3,
        "ativo": true
    }
]
```

### Body: PUT

```
{
    "ddd": "CE",
    "numero": "(85) 9.9506-9315",
    "tipo": "Celular",
    "usuarioId": 2,
    "ativo": true
}
```

ou

```
{
    "ddd": "CE",
    "numero": "99506-9315",
    "tipo": "Celular",
    "fornecedorId": 3,
    "ativo": true
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso.",
    "data": true,
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Edição efetuada com sucesso.",
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
    "message": "Registro já existente.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Registro não encontrado.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação.",
    "data": [],
    "status": 400,
    "details": ""
}
```

</details>

<details>
<summary>401 - Unauthorized</summary>

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

<ul>
    <li>?page=1&perPage=10&active=1</li>
    <li>?search=Eletrônicos&active=1</li>
</ul>

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
    "id": 1,
    "nome": "Eletrônicos",
    "ativo": true
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso.",
    "data": true,
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Edição efetuada com sucesso.",
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
    "message": "Registro já existente.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Registro não encontrado.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação.",
    "data": [],
    "status": 400,
    "details": ""
}
```

</details>
<details>

<summary>401 - Unauthorized</summary>

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
    "message": "Permissão Negada.",
    "data": [],
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
| PUT  | /api/product/edit           |

<ul>
    <li>O campo "unidadeMedida", pode ser do tipo: ('UN', 'G', 'KG', 'ML', 'L', 'M2', 'CX')
</li>
    <li>?page=1&perPage=10&active=1</li>
    <li>O produto pode ser listagem pela busca do item ou pela categoria.</li>
    <li>?search=TV%LED%'55&active=1</li>
    <li>?id=3&active=1</li>
</ul>

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
    "ativo": true
}
```

### Body: PUT
```
{
    "id", 1,
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
    "ativo": true
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso.",
    "data": id_do_ultimo_cadastro,
    "status": 200,
    "details": ""
}
```

```
{
    "message": "Edição efetuada com sucesso.",
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
    "message": "Registro já existente.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Registro não encontrado.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação.",
    "data": [],
    "status": 400,
    "details": ""
}
```
</details>

<details>
<summary>401 - Unauthorized</summary>

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

<ul>
    <li>?page=1&perPage=10&active=1</li>
    <li>?id=200&search=100005000=&active=1</li>
    <li>A listagem do pedido é realizada pelo usuário.</li>
    <li>O pedido não pode ser modificado.</li>
    <li>O campo "tipoEntrega", pode ser do tipo ('Expresso', 'Correio', 'Retirada')</li>
</ul>

### Body: POST
```
{
    "quantidadeItem": 4,
    "total": 102.99,
    "valorEntrega": 13.40,
    "tipoEntrega": "Expresso",
    "ativo": true,
    "usuarioId": 3,
    "itens": [
        {
            "quantidadeItem": 1,
            "subTotal": 14.85,
            "produtoId": 32,
            "ativo": true
        },
        {
            "quantidadeItem": 2,
            "subTotal": 13.18,
            "produtoId": 33,
            "ativo": true
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
    "message": "Cadastro efetuado com sucesso.",
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
    "message": "Registro já existente.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação.",
    "data": [],
    "status": 400,
    "details": ""
}
```
</details>

<details>
<summary>401 - Unauthorized</summary>

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

### Pagamento

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO |          ROTA            |
|-------|--------------------------|
| POST  | /api/payment/save        |

<ul>
    <li>O campo "metodoPagamento", pode ser do tipo:</li>
    <li>('Boleto Bancário', 'Crédito', 'Débito', 'Pix')</li>
</ul>

### Body: POST

Com cartão

```
{
    "numeroCartao": "3433 0684 3408 6543",
    "tipoCartao": "Crédio ou Débito",
    "dataValidade": "2023-05-16 13:44:18",
    "parcela": 3,
    "total": 399.48,
    "metodoPagamento": "Crédito",
    "pedidoId": 25
    "ativo": true,
}
```

Com dinheiro ou PIX

```
{
    "total": 20.50,
    "metodoPagamento": "Pix",
    "pedidoId": 30
    "ativo": true,
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso.",
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
    "message": "Error ao efetuar ação.",
    "data": [],
    "status": 400,
    "details": ""
}
```

```
{
    "message": "Registro não encontrado.",
    "data": [],
    "status": 400,
    "details": ""
}
```

</details>

<details>
<summary>401 - Unauthorized</summary>

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
