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
> DB_DATABASE=msd_delivery<br />
> DB_USERNAME=nome_do_usuario<br />
> DB_PASSWORD=sua_senha<br />

> Execute o comando: php artisan migrate

certifique-se que as tabelas foram criadas. Abra o cliente SQL que você escolheu, execute o comando:
```sql
    SHOW TABLES;
```

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
