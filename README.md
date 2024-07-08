
# Sistema de Gerenciamento de Eventos

Este projeto é um sistema de gerenciamento de eventos desenvolvido com Laravel, que permite aos usuários criar, listar, editar e deletar eventos após autenticação.

## Requisitos

- PHP >= 7.4
- Composer
- Node.js e NPM
- MySQL ou MariaDB

## Instalação

### Usando Docker

1. **Clone o Repositório**

    ```bash
    git clone https://github.com/glaiton-silva/event-manager.git
    cd event-manager
    ```

2. **Copie o arquivo `.env.example` para `.env`**

    ```bash
    cp .env.example .env
    ```

3. **Configurar Docker Compose**

    Certifique-se de que o Docker e o Docker Compose estejam instalados em seu sistema. Então, execute:

    ```bash
    docker-compose up --build
    ```

4. **Execute as Migrações**

    Abra um novo terminal e execute o comando:

    ```bash
    docker-compose exec app php artisan migrate
    ```

5. **Acesse o Projeto**

    Agora, você pode acessar o projeto em `http://localhost:8000`.

### Instalação Manual

1. **Clone o Repositório**

    ```bash
    git clone https://github.com/glaiton-silva/event-manager.git
    cd event-manager
    ```

2. **Instale as Dependências do PHP**

    ```bash
    composer install
    ```

3. **Configurações do Ambiente**

    Copie o arquivo `.env.example` para `.env` e ajuste as configurações do banco de dados.

    ```bash
    cp .env.example .env
    ```

    Edite o arquivo `.env` e configure as variáveis de ambiente para o banco de dados.

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=seu_banco_de_dados
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
    ```

4. **Gere a Chave da Aplicação**

    ```bash
    php artisan key:generate
    ```

5. **Execute as Migrações**

    ```bash
    php artisan migrate
    ```

6. **Instale as Dependências do Front-End**

    ```bash
    npm install
    npm run dev
    ```

7. **Execute o Servidor Local**

    ```bash
    php artisan serve
    ```

    Agora, acesse o projeto em `http://localhost:8000`.

## Autenticação

Este projeto usa Laravel Breeze para autenticação. As páginas de registro e login já estão configuradas e podem ser acessadas após iniciar o servidor.

## Uso

- **Dash**: Home com uma listagem dos eventos, para acessar não é preciso estar autenticado.
- **Criar Eventos**: Após logar, acesse `/events/create` para adicionar novos eventos.
- **Listar Eventos**: Todos os eventos podem ser listados em `/events`.
- **Editar/Deletar Eventos**: As opções de editar e deletar estão disponíveis na página de detalhes de cada evento.

## Testes

Execute os testes com PHPUnit:

```bash
php artisan test
```

## API

Este projeto utiliza o Swagger para documentar e testar a API. A documentação interativa gerada pelo Swagger permite visualizar e interagir com as rotas da API de forma fácil e intuitiva.

O pacote l5-swagger já está incluído nas dependências do projeto e será instalado com o comando `composer install`.

Gere a documentação do Swagger com o comando:

```bash
php artisan l5-swagger:generate
```

As rotas da API documentadas incluem endpoints para:

- **Listar Eventos**: `GET /api/events`
- **Criar Evento**: `POST /api/events`
- **Visualizar Evento**: `GET /api/events/{event}`
- **Atualizar Evento**: `PUT /api/events/{event}`
- **Deletar Evento**: `DELETE /api/events/{event}`

## Acesso à Documentação da API

Após gerar a documentação do Swagger, ela pode ser acessada via:

```
http://localhost:8000/api/documentation
```

## Considerações Finais

Certifique-se de configurar corretamente o ambiente e seguir todos os passos para garantir que o sistema funcione conforme esperado. Para qualquer dúvida ou problema, consulte a documentação oficial do Laravel e do l5-swagger.
