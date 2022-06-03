# Projeto MVC em Laravel

- **Tirar cache** -> php artisan route:clear

**Autenticação JWT API**

- composer require tymon/jwt-auth:dev-develop --prefer-source

- php artisan vendor:publish

- Ver caminho autenticação JWT (normalmente 11) 

-  php artisan jwt:secret

- Criar uma controller para API =>  php artisan make:controller APIController e fazer códigos 

- para rodar testes => vendor/bin/phpunit

- para testes automatizado: 
- composer require --dev laravel/dusk
- php artisan dusk:install
- php artisan dusk:chrome-drive --all
- php artisan dusk:make "NomeArquivo"
- php artisan dusk
