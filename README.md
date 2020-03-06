## Api DevJobs

Api com autenticação JWT para candidatura de desenvolvedores. Para rodar este projeto executar os seguintes comandos:

- docker run --name "todoApi" -e POSTGRES_USER=todo -e POSTGRES_PASSWORD=123456 -p 5432:5432 -d -t --restart=always kartoza/postgis:latest
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan jwt:secret
- php artisan storage:link
- php artisan migrate
- php artisan db:seed



Executar em um container Docker ou um servidor PHP, sugestão é o [Laragon](https://laragon.org/download/)
O usuário de acesso para a API é -> username:devJobs password: 123456

Na pasta docs existe o arquivo Insomnia_Api_DevJobs.json onde é possivel importar no Insominia e testar o endpoints da api


