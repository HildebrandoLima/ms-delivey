## API DE DELIVERY

Para fins de estudo e ampliar meu conhecimento com o framework laravel. Esse é um projeto que resulta em uma api de delivery/ecommerce. Nela atualmente abordo o uso do frammekork, com foco em POO e padrão de projetos, arquitetura limpa e distribuída, eloquent, e muito mais.

### Aplicação Web criada com:<br />
- Laravel/PHP<br />
- MySQL para banco de dados.<br/>

### Funcionalidades (Atualmente desenvolvidas)
<ul>
<li>CRUD de Usuário</li>
<li>CRUD de Endereço</li>
<li>CRUD de Telefone</li>
<li>CRUD de Fornecedor</li>
</ul>

### Funcionalidades (A desenvolver)
<ul>
<li>CRUD de Produto</li>
<li>CRUD de Item</li>
<li>CRUD de Categoria</li>
<li>CRUD de Pedido</li>
<li>CRUD de Pagamento</li>
<li>Login</li>
</ul>

### Requesitos necessários para executar o projeto:
<li>Instalar o PHP versão 8.0</li>
<li>Instalar o Laravel versão 9.0</li>
<li>Instalar o MySQL versão 8.0</li>
<li>Instalar o composer versão 2.4.0</li>
<li>Instalar o Postman</li>
<li>Instalar uma IDE de sua escolha (PHPStorm / VSCode)</li>
<li>Instalar um cliente SQL de sua escolha (DBeaver / PHPMyAdmin / MySQL WorkBench)</li>

### Executar o projeto:
<ul>
<li>Clone o projeto: git clone https://github.com/HildebrandoLima/ms-delivey.git</li>
<li><Adicionar arquivo .env</li>
<li>Executar comandos: composer install | php artisan key:generate | php artisan jwt:secret</li>
<li>Certifique-se que um diretório chamado `**/vendor**` foi criado.</li>
<li>Executar: php artisan serve</li>
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

Execute os comandos:

Para criar as tabelas:

```
    php artisan migrate
```

Para criar os registros de ddd e uf:

```
    php artisan db:seed --class=DiscagemDiretaDistanciaSeeder
```

```
    php artisan db:seed --class=UnidadeFederativaSeeder
```

Certifique-se que as tabelas foram criadas. Abra o cliente SQL que você escolheu, execute o comando:

```
    SHOW TABLES;
```

### [Caso ocorra erro ao executar as migrations, clique aqui!](https://blog.renatolucena.net/post/como-fazer-rollback-de-migration-de-bd-no-laravel)

### Para iniciar o servidor:
`php artisan serve`
Agora acesse o endereço http://localhost:8000 em seu navegador.

### UML
Cliente<br/>
![Captura de tela de 2023-02-28 14-02-40](https://user-images.githubusercontent.com/47666194/221933419-f1fb4bc2-b8b1-46a7-8db1-0da1f82936d4.png)

Admin<br />
![Captura de tela de 2023-02-28 14-02-56](https://user-images.githubusercontent.com/47666194/221933281-3549c4e1-ec86-4491-9f14-413ecf334c27.png)

### Modelagem de Dados
![Captura de tela de 2023-02-28 14-03-30](https://user-images.githubusercontent.com/47666194/221933188-30fea7d3-3628-47b2-926e-1126ce4f9773.png)

### API DOCUMENTAÇÃO

<ul>
<li>Todos os parâmetros 'id' são enviados em base64, e o back-end se responsabiliza em decodificar.</li>
<li>Nos body, é preciso identificar quem se referencia o endereço ou telefone. No caso de usuário ("usuarioId": 2) ou fornecedor ("fornecedorId": 2)</li>
<li>Como as chaves estrangeiras são obrigatórias, por padrão, vem um usuário e um fornecedor já cadastrados, como inativos. E seus valores são enviados automaticamente pelo back-end, caso o mesmo não for referenciado.</li>
</ul>

### Usuário

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|          ROTA         |
|------|-----------------------|
| GET  | /api/user/list        |
|------|-----------------------|
| GET  | /api/user/list/{id}   |
|------|-----------------------|
| POST | /api/user/save        |
|------|-----------------------|
| PUT  | /api/user/edit/{id}   |
|------|-----------------------|
|DELETE| /api/user/remove/{id} |

### Exemplo: POST/PUT
```
{
    "nome": "Hill",
    "cpf": "22350458201",
    "email": "test@gmail.com",
    "senha": "Hill@123",
    "dataNascimento": "2023-03-25 18:20:59",
    "genero": "Feminino",
    "ativo": 1
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso!",
    "data": codigo_do_ultimo_cadastro,
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
<summary>404 - Not Found</summary>

```
{
    "message": "O usuário já existe!",
    "data": "false",
    "status": 404,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação!",
    "data": "false",
    "status": 404,
    "details": ""
}
```

</details>
</details>

### Endereço

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|          ROTA            |
|------|--------------------------|
| GET  | /api/address/list        |
|------|--------------------------|
| GET  | /api/address/list/{id}   |
|------|--------------------------|
| POST | /api/address/save        |
|------|--------------------------|
| PUT  | /api/address/edit/{id}   |
|------|--------------------------|
|DELETE| /api/address/remove/{id} |

### Exemplo: POST/PUT
```
{
    "logradouro": "Rua",
    "descricao": "1",
    "bairro": "Messejana",
    "cidade": "Fortaleza",
    "cep": 1234567,
    "ufId": 1,
    "usuarioId": 2
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
<summary>404 - Not Found</summary>

```
{
    "message": "Error ao efetuar ação!",
    "data": "false",
    "status": 404,
    "details": ""
}
```

</details>
</details>

### Telefone

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|          ROTA              |
|------|----------------------------|
| GET  | /api/telephone/list        |
|------|----------------------------|
| GET  | /api/telephone/list/{id}   |
|------|----------------------------|
| POST | /api/telephone/save        |
|------|----------------------------|
| PUT  | /api/telephone/edit/{id}   |
|------|----------------------------|
|DELETE| /api/telephone/remove/{id} |

### Exemplo: POST/PUT
```
{
    "telefones": [
        {
            "numero": "995069315",
            "tipo": "Celular",
            "dddId": 1,
            "usuarioId": 2
        },
        {
            "numero": "980458709",
            "tipo": "Fixo",
            "dddId": 1,
            "usuarioId": 2
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
<summary>404 - Not Found</summary>

```
{
    "message": "Error ao efetuar ação!",
    "data": "false",
    "status": 404,
    "details": ""
}
```

</details>
</details>

### Fornecedor

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|          ROTA             |
|------|---------------------------|
| GET  | /api/provider/list        |
|------|---------------------------|
| GET  | /api/provider/list/{id}   |
|------|---------------------------|
| POST | /api/provider/save        |
|------|---------------------------|
| PUT  | /api/provider/edit/{id}   |
|------|---------------------------|
|DELETE| /api/provider/remove/{id} |

### Exemplo: POST/PUT
```
{
    "nome": "Teste Test",
    "cnpj": "12394678811",
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
    "data": codigo_do_ultimo_cadastro,
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
<summary>404 - Not Found</summary>

```
{
    "message": "O fornecedor já existe!",
    "data": "false",
    "status": 404,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação!",
    "data": "false",
    "status": 404,
    "details": ""
}
```

</details>
</details>

### Categoria

<details>
<summary>Detalhes</summary>

### Rotas

|MÉTODO|            ROTA           |
|------|---------------------------|
| GET  | /api/category/list        |
|------|---------------------------|
| GET  | /api/category/list/{id}   |
|------|---------------------------|
| POST | /api/category/save        |
|------|---------------------------|
| PUT  | /api/category/edit/{id}   |
|------|---------------------------|
|DELETE| /api/category/remove/{id} |

### Exemplo: POST/PUT
```
{
    "descricao": "Eletrônicos"
}
```

### Resposta:

<details>
<summary>200 - OK</summary>

```
{
    "message": "Cadastro efetuado com sucesso!",
    "data": 1,
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
<summary>404 - Not Found</summary>

```
{
    "message": "A categoria já existe!",
    "data": "false",
    "status": 404,
    "details": ""
}
```

```
{
    "message": "Error ao efetuar ação!",
    "data": "false",
    "status": 404,
    "details": ""
}
```
</details>
