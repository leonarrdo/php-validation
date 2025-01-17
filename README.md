## Sobre o Projeto

### Tecnologias 

- PHP
- Vite
- Tailwindcss
- Mysql
- Npm
- Docker
- Nginx
- Google Recaptcha

## Requisitos para rodar o projeto:

- Git
- Docker
- Sistema linux ou WSL
- Google cloud para chaves do reCAPTCH

## Passos para execução

### 1 - Clonar o repositório
```
git clone https://github.com/leonarrdo/php-validation.git
```

### 2 - Abrir a pasta do projeto
```
cd php-validation
```

### 3 - Clone o arquivo .env.example e crie o .env
```
cp .env.example .env
```

### 4 - Adicionar as chaves referentes ao recaptcha no .env
```
RECAPTCHA_SITE_KEY
RECAPTCHA_SECRET_KEY
```

### 5 - Rodar o docker compose
```
docker compose up --build -d
```

### 6 - Rodar o npm
```
npm install
```

### 7 - Realizar o build dos arquivos do frontend
```
npm run build
```

### 8 - Criar e popular banco de dados
```
docker exec -it php-validation-app php artisan migrate --seed
```

### 9 - Abrir a url do projeto no navagedor
```
localhost
```

## Imagens do Projeto

### Login

<img src="https://i.postimg.cc/v8VjrCYz/Screenshot-1.png" alt="Interface de login">

### Cadastro de usuários

<img src="https://i.postimg.cc/jdY1ZvCr/Screenshot-2.png" alt="Interface de cadastro de usuários">

### Listagem de clientes

<img src="https://i.postimg.cc/BnqVG6xY/Screenshot-5.png" alt="Interface de listagem de clientes">

### Cadastro de clientes

<img src="https://i.postimg.cc/6pY16Xc9/Screenshot-6.png" alt="Interface de cadastro de clientes">

### Edição de clientes

<img src="https://i.postimg.cc/3Jjc6pD0/Screenshot-3.png" alt="Interface de edição de clientes">

