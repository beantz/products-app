# Projeto Laravel com Sail

API Laravel com ambiente Dockerizado usando Sail e testes com PHPUnit.

## 🚀 Tecnologias

- Laravel 11
- Laravel Sail
- PHPUnit
- MySQL
- Redis

## ⚡ Instalação Rápida

```bash
# Clone o projeto
git clone https://github.com/beantz/products-app.git
cd products-app

# Configure o ambiente
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate