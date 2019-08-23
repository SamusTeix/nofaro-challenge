# Nofaro - Backend Challenge

Para a utilização deste projeto, é necessário pussuir o Docker instalado.
Caso ainda não possua, aqui seguem os links para <a href="https://www.mundodocker.com.br/tag/docker-mac/" target="_blank">Mac</a>, <a href="https://www.mundodocker.com.br/tag/docker-windows/" target="_blank">Windows</a>, <a href="https://www.edivaldobrito.com.br/docker-no-ubuntu/" target="_blank">Ubuntu e derivados</a>.

Além do Docker, precisamos também do Git para recuperar a listagem de arquivos.

Com ambos programas instalados e funcionais, iniciamos a instalação:


#### Clonando o repositório:

`$ git clone https://github.com/SamusTeix/nofaro-challenge.git`

`$ cd nofaro-challenge`


#### Subindo os containers:

`$ docker-compose up -d`


#### Instalando o Yarn:

`$ yarn install`


#### Atualizando os componentes:

Mac e Linux:

`$ docker-compose exec php bash`

`$ cd var/www/html`

`$ composer update`


Windows:

`$ winpty docker-compose exec php bash`

`$ cd var/www/html`

`$ composer update`


#### Criando arquivo .env:

`$ cp .env.example .env`

Altere as configurações do `.env` relacionadas ao banco de dados:

`DB_CONNECTION=mysql` 
`DB_HOST=db` 
`DB_PORT=3306` 
`DB_DATABASE=nofaro` 
`DB_USERNAME=nofaro` 
`DB_PASSWORD=secret` 


#### Rodando a Migration:

`$ php artisan migrate`


Para rodar a `migration`, caso esteja no Windows, não poderá utilizar o artisan fora do container. Utilize os comandos abaixo:

`$ winpty docker-compose exec php bash`

`$ cd var/www/html`

`$ php artisan migrate`

`$ exit`

`$ exit`


#### Depois de rodar a migration, iniciamos o `Yarn` para geração dos Javascripts e Css:

`$ yarn run watch`


Com isso, acessando <a href="http://localhost:8000" target="_blank">localhost:8000</a> temos acesso ao projeto.
