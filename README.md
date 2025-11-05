# Projeto Laravel com Sail

API Laravel com ambiente Dockerizado usando Sail e testes com PHPUnit.

### 🚀 Tecnologias

- PHP 8.3
- Laravel 11
- Laravel Sail
- PHPUnit
- MySQL
- Docker

### ⚡ Instalação Rápida

```bash
# Clone o projeto
git clone https://github.com/beantz/products-app.git
cd products-app

# Configure o ambiente
cp .env.example .env
```

### Configure as variáveis de ambiente no arquivo .env:
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

### Instale as dependências do Composer:
```bash
composer install

./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
```

### Definir alias para usar apenas "sail" ao invés de "./vendor/bin/sail"
### Adicione o alinha abaixo no arquivo de configuração do shell em seu diretório inicial, que como ~/.zshrc ou ~/.bashrc, e depois reinicie seu shell.
```bash
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```
### Para descobrir qual shell voce está usando:
```bash
echo $SHELL
```

## Configuração para os testes

### se caso o phpUnit nao estiver instalado:
```bash
composer require --dev phpunit/phpunit
```

### Crie o banco de dados para testes, no seu cliente MySQL (phpMyAdmin, MySQL Workbench, ou linha de comando)
```bash
CREATE DATABASE laravel_test;
```
### Crie o arquivo .env.testing
```bash
cp .env.example .env.testing
```
<!-- ## Executar as migrations no banco de teste
```bash
php artisan migrate --env=testing
``` -->

### Configurar variavel de ambiente em .env.testing
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_test
DB_USERNAME=root
DB_PASSWORD=your_password
```
### Em .env.testing
```bash
APP_KEY=preencher aqui com sua app_key gerada en .env
```

### Link para estudos
[Contéudo auxiliar](https://www.notion.so/API-Laravel-com-PHPUnit-e-Laravel-Sail-28ce9046c6cb8084b84af2a9cc23012a?source=copy_link)