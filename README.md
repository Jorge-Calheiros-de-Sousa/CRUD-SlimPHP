
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

- E agora é só usar a aplicação

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

- Crie o banco de dados acessando o phpmyadmin por [http://localhost:8000](http://localhost:8000) e insira as informações `Ultilizador: root` e `Senha: 123`
- Em dbusuarios crie uma tabela chamada `tbusuarios` com 3 colunas e depois insira as informações abaixo:


    |Nome  |Tipo  |Tamanho/Valores  |A_I(Auto_increment)  |
    |---------|---------|---------|---------|
    |id   |int         |         |check         |
    |name    |varchar         |75         |         |
    |year_old     |varchar         |3         |         |

- Clique em guardar e a tabela será criada
- Pronto agora a aplicação já esta executando

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



- A variável "APP_ENV" representa o ambiente onde a aplicação está executando, alterar essa variável pode alterar alguns comportamentos, como por exemplo, exibir ou ocultar mensagens para desenvolvedores.

    As possibilidades desse variavel são: 
    
    "DEV": Ambiente de desenvolvimento
    
    "PROD": Ambiente de produção

- Em APP_URL e APP_BASE_ROUTE é preciso colocar a rota e a url da aplicação porque certas funcionalidades dependem dessas informações na aplicação. Isso acontece porque o sistema támbem funciona no docker então quando ele é executado em docker a URL e a rota mudam então é preciso que o desenvolvedor insira a URL e a rota atual dependêndo de onde a aplicação está sendo executada. (Xampp ou Docker)

## Comandos do docker

|Comando |Descrição |
|---------|---------|
|docker-compose up -d    |Baixa o container ps: apenas executar uma vez         |
|docker-compose start     | executa o container        |
|docker-compose stop     | para o container        |
|docker ps    |mostra todos os containers executados no momento         |


## Em desenvolvimento

