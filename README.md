
  

# Dev Back End Test - Ingresse

  

  

  

Este repositório contem a resolução do teste apresentado via e-mail.

  

  

  

## Sobre

  

  

  

Foi desenvolvida uma API REST em Laravel para realizar o gerenciamento de usuários. Foi utilizado um ambiente Docker rodando um servidor NGINX, banco de dados MySQL, autenticação OAuth2 (Laravel Passport) e cache via Redis.

 Também foi implementando o [Travis CI](https://travis-ci.org/) para integração contínua

  

  

O teste foi desenvolvido e testado em uma máquina rodando Ubuntu 18.04

  

  

  

## Instalando o projeto

  

  

  

**Requisitos**

  

  

- [Docker](https://www.docker.com/)

  

  

- [Docker Compose](https://docs.docker.com/compose/)

  

  

- [GIT (Opcional)](https://git-scm.com/)

  

  

- [Insomnia (Opcional - REST Client para testar as requisições)](https://insomnia.rest/)

  

  

**Instalando**

  

  

  

- Faça o download do zip ou clone este repositório

  

  

- Inicie o Docker

  

  

- Entre na pasta do repositório

  

  

- Execute o script **startUp.sh** e espere até que os containers sejam montados, dependências instaladas e ambiente montado (Demora um pouco na primeira vez, dá tempo de fazer um cafézinho)

  

  

- Depois a aplicação ficará disponivel em http://localhost:80 e o PHPMyAdmin em http://localhost:8080/.

  

  

  

## Requisições

  

  

A requisições deverão ser feitas para o endereço informado acima com o sufixo **/api/***

  

  

Caso a requisição tenha um input de dados, deverá ser enviado um JSON com os valores.

  

  

Os seguintes headers são necessários em todas as requisições:

  

  

- Content-Type: application/json

  

- X-Requested-With: XMLHttpRequest

  

  

Para as requisições após cadastro e login é necessário incluir o token de autenticação da seguinte maneira:

  

  

- Authorization: Bearer [token]

  

  

Caso deseje utilizar o REST Client Insomnia, na raiz do repositório tem um arquivo JSON com as requisições já montadas, sendo necessário apenas atualizar o token de autenticação.

  

  

### Cadastrar um usuário

  

  

Cadastra um novo usuário

  

  

#### Url

  

Método: POST

  

/register

  
  

  

#### Body

  

  

- `name` string, máximo de 191 caracteres

  

  

- `email` string, email válido, único

  

- `cpf` string, cpf válido (sem pontuação)

  

  

- `password` string, mínimo de 6 caracteres

  

  

### Login

  

  

Realiza o login e retorna o token de autenticação

  

#### Url

  

Método: POST

  

/login

  

#### Body

  

  

- `email` string

  

  

- `password` string,

  

  

### Listar usuários

  

  

Retorna todos os usuários cadastrados
  

  

#### Url

  
Método: GET
  

/users

  
  

### Listar um usuário

  
   

Retorna um usuário especifico

    

#### Url
Método: GET
  

  

/users/:id



  

#### Parâmetros

  

  

- `id` Int (Obrigatório) - O ID do usuário que se quer obter as informações

  
  

  

### Cadastrar um usuário

  

  

  

Cadastra um novo usuário

  

  

  

#### Url

  

  
Método: POST
  

/users


  

#### Body


  

- `name` string, máximo de 191 caracteres

  

  

- `email` string, email válido, único

  

- `cpf` string, cpf válido (sem pontuação)

  

  

- `password` string, mínimo de 6 caracteres

  

  

  

  

### Editar um usuário

  

  

  

Edita um usuário existente.

  

  

  

#### Url

  

  Método: PUT
  

/users/:id


#### Body

  
- `name` string, máximo de 191 caracteres

  

  

- `email` string, email válido, único 

  

- `cpf` string, cpf válido (sem pontuação)

  

  

- `password` string, mínimo de 6 caracteres

  
  

  

#### Parâmetros

  

  

  

- `id` Int (Obrigatório) - O ID do usuário que se quer editar

  

  

### Deletar um usuário

  

  

  

Deleta um usuário existente.

  

  

  

#### Url

  
  Método: DELETE
  

  

/users/:id

  

  

  

#### Método

  

  

  

`DELETE`

  

  

  

#### Parâmetros

  

  

  

- `id` Int (Obrigatório) - O ID do usuário que se quer deletar

  

  

## Testes

  

  

  

Para rodar os testes execute o comando `docker exec -it ingresse-test-application vendor/bin/phpunit`