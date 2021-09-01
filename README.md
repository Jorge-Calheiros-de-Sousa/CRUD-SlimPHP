
<img src="https://www.luiztools.com.br/wp-content/uploads/2017/07/CRUD.png" alt="">

# Sistema de CRUD com Slim PHP

Tecnologias usadas: 

- Xampp
- Docker
------------------

## Como usar com o Xampp

### Requisitos
- Composer
- versão  do php >=7


### Passos necessários

- Dentro do xampp procure a pasta htdocs
- No htdocs clone o repositorio
- Execute o comando `composer update` e aguarde o fim da instalação
- Copiar o arquivo `env.example` e mudar o nome para `.env`
- Copiar o arquivo  `routes.example.js` e mudar o nome para `routes.js`
- Dentro do arquivo `routes.js` insira na variavel url a URL da aplicação
- Crie o banco de dados MySQL de acordo com o arquivo `dbusuarios.sql`
- Preencha as variaveis do arquivo `.env` de acordo com as intruções abaixo:
   
    
    |Variável |Valor  |
    |---------|---------|
    |DB_HOST    |localhost           |
    |DB_DATABASE    |dbusuarios         |
    |DB_USERNAME     |root          |
    |DB_PASSWORD      |''         |

- PS: para a aplicação rodar veja as **observações** abaixo.

------

## Como usar com o Docker

### Requisitos
- Composer
- versão  do php >=7
- Docker

### Passos necessários

- Clone o repositório
- Execute o comando `composer update`
- Mude o nome do arquivo `env.example` para `.env`
- Mude o nome do arquivo `routes.example.js` para `routes.js`
- Dentro do arquivo `routes.js` insira na variavel url a URL da aplicação
- Execute o comando `docker-compose up -d`
- Preencha as variaveis do arquivo `.env` de acordo com as intruções abaixo:
    
    |Variável  |Valor |
    |---------|---------|
    |DB_HOST     |app_db_slim         |
    |DB_DATABASE     |dbusuarios         |
    |DB_USERNAME     |root         |
    |DB_PASSWORD     |123         |

- Agora crie as tabelas do banco de dados da aplicação acessando o phpmyadmin http://localhost:8000 ou pelo MySQL, quando for acessar pelo o phpmyadmin insira as seguintes informações `Ultilizador: root` e `Senha: 123`, caso for entrar pelo MySQL apenas insira a Senha: `123`
- Agora de acordo com o arquivo `dbusuarios.sql` crie as tabelas.

- PS: para a aplicação rodar veja as **observações** abaixo.

## Portas da aplicação


|Porta  |Descrição  |
|---------|---------|
|8001    |aplicação(http)      |
|8000     |phpmyadmin         |

## Acessando a aplicação

Apos inicializar o docker basta acessar a url [http://localhost:8001/](http://localhost:8001/) para acessar a aplicação CRUD.

## Observações

Quando copiar o arquivo .env.example e renomear para .env deve se preencher algumas das seguintes variaveis do ambiente



|Variável   |Valor |
|---------|---------|
|APP_ENV     |DEV ou PROD            |
|APP_URL     |(coloque a URL da aplicação)         |
|APP_BASE_ROUTE     |(coloque a rota da aplicação)         |
|JWT_SECRET    |(qualquer texto)            |


  A variável "APP_ENV" representa o ambiente onde a aplicação está executando, alterar essa variável pode alterar alguns comportamentos, como por exemplo, exibir ou ocultar mensagens para desenvolvedores.   
        As possibilidades desse variavel são: 
        
        "DEV": Ambiente de desenvolvimento
        
        "PROD": Ambiente de produção


Em APP_URL e APP_BASE_ROUTE é preciso colocar a rota e a url da aplicação porque certas funcionalidades dependem dessas informações na aplicação. Isso acontece porque o sistema támbem funciona no docker então quando ele é executado em docker a URL e a rota mudam então é preciso que o desenvolvedor insira a URL e a rota atual dependêndo de onde a aplicação está sendo executada. (Xampp ou Docker)

Em JWT_SECRET é necessário colocar alguma string porque ele é usado para criptografar as informações em hash

-----

## Parte de Admin da aplicação

     Na parte de Admin da aplicação é possivel visualizar todos os usuários cadastrados na tabela.
### Passo a passo de como ser um admin

- No banco de dados na tabela tbusuarios criei um usuário com o nome, email e senha de sua escolha e na coluna tipo insira o numero 2
- Acesse a aplicação e acrescente na URL `/adm` e você ira ser redirecionado para uma tela de login de Admin e agora é só inserir o usuário que já tinha sido cadastrado.
-----
## Comandos do docker

|Comando |Descrição |
|---------|---------|
|docker-compose up -d    |Baixa o container ps: apenas executar uma vez         |
|docker-compose start     | executa o container        |
|docker-compose stop     | para o container        |
|docker ps    |mostra todos os containers executados no momento         |


## Em desenvolvimento

