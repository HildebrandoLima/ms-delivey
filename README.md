## API DE DELIVERY

### Aplicação Web criada com:<br />
- Laravel/PHP<br />
- MySQL para banco de dados.<br/>

### Funcionalidades (Atualmente desenvolvidas)
<ul>
<li>CRUD de Usuário</li>
<li>CRUD de Endereço</li>
<li>CRUD de Telefone</li>
</ul>

### Funcionalidades (A desenvolver)
<ul>
<li>CRUD de Produto</li>
<li>CRUD de Item</li>
<li>CRUD de Categoria</li>
<li>CRUD de Pedido</li>
<li>CRUD de Pagamento</li>
<li>CRUD de Login</li>
</ul>

### Requesitos necessários para executar o projeto:
<li>Instalar o PHP `versão 8.0`</li>
<li>Instalar o Laravel `versão 9.0`</li>
<li>Instalar o MySql `versão 8.0`</li>
<li>Instalar uma IDE de sua escolha (PHPStorm / VS code)</li>
<li>Instalar o composer versão `2.4.0`</li>

### Executar o projeto:
<ul>
<li>Clone o projeto: `git clone `</li>
</ul>

Abra o diretório de instalação do PHP, encontre o arquivo *php.ini-production*, renomeio-o para *php.ini*.
Encontre as seguintes linhas e descomente-as, removendo ";" que precede a linha.
- pdo_mysql
- curl
-mb_string
-openssl
Baixe ou faça o clone do repositorio:
`git clone https://github.com/SaorCampos/crud-php-oo.git`
Após isso, entre no diretorio que foi gerado
`cd crud-php-oo`
Dentro da pasta do projeto execute no terminal os seguintes comandos:
`composer install`,
certifique-se que um diretório chamado **/vendor** foi criado.

### Banco de Dados:
> Obanco de dados é do tipo relacional e contém as tabelas com até 2 níveis de normatização.
### Criando o Banco de de Dados
Entre no seu cliente de banco de dados e copiar o conteúdo de **db.sql** e executar,
certifique-se que as tabelas foram criadas, executando o comando:
```sql
    SHOW TABLES;
```
#### Configure as credencias de acesso
Encontre o arquivo **/config/database.php** e edite-o conforme as credencias do seu usuário do banco de dados.

### Crie o primeiro usuário de acesso
Dentro do diretório da aplicação, execute no terminal o comando
`php config/create-admin.php`;
Isso criará um usuário com as credencias:
|Nome|Email|Senha|
| -  |   - |  -  |
| Administrador | admin@admin.com | 123456|
### Para iniciar o servidor:
`php -S localhost:8000 -t public`;
Agora acesse o endereço http://localhost:8000 em seu navegador.
