# atividadeApiLaravel
O Laravel Maps App é um sistema web desenvolvido em Laravel 12 que possibilita cadastrar e gerenciar pontos de interesse, armazenando desde endereço até latitude e longitude, e exibindo tudo em um mapa interativo.

## Funcionalidades

* CRUD de locais: Criar, visualizar, editar e remover locais.

* Mapas dinâmicos: Cada ponto cadastrado aparece no mapa, com possibilidade de atualizar a posição clicando diretamente nele.

* Detalhes completos: Cada local pode conter nome, descrição, endereço e coordenadas.

* Categorias: Classificação em diferentes tipos, como Restaurante, Hotel, Shopping, Parque, Museu, Teatro, Hospital, Escola ou Outro.

* Design responsivo: Construído com Bootstrap e CSS, adapta-se a dispositivos móveis e desktops.

## Estrutura das Páginas

* Index (index.blade.php): Lista todos os locais, permitindo acessar detalhes, editar ou excluir.

* Show (show.blade.php): Exibe informações detalhadas de um local e o marcador no mapa.

* Create (create.blade.php): Página para criar novos locais, com seleção das coordenadas direto no mapa e formulário validado.

* Edit (edit.blade.php): Permite atualizar dados de um local existente, incluindo reposicionar o marcador no mapa.

## Tecnologias Utilizadas

* Backend: Laravel 12

* Frontend: Blade Templates + Bootstrap 5

* Mapas: Leaflet.js + OpenStreetMap

* Banco de Dados: MySQL

## Instalação
## Criar projeto Laravel
composer create-project laravel/laravel .

# Copiar configuração e gerar chave
copy .env.example .env
php artisan key:generate


## Verificar instalação:

php artisan --version
dir

## Configuração do Banco de Dados
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mapslaravel
DB_USERNAME=root
DB_PASSWORD=senha


## Testar conexão:

php artisan tinker
DB::connection()->getPdo();


## Criar tabelas:

php artisan migrate

## Ajustes no .env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seudominio.com
DB_USERNAME=usuario
DB_PASSWORD=senha

## Executar o servidor
php artisan serve

