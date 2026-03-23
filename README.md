php artisan migrate  :pour crée les tables de la base de données
php artisan optimize:optimise et accélère l’application
composer run dev :lance les outils de développement (Vite, compilation CSS/JS)
npm install:installe les packages JavaScript nécessaires au projet.
npm run build:compile les fichiers CSS et JavaScript pour le projet.
php artisan serve :démarre le serveur Laravel local pour ouvrir le site


php artisan install:api

php artisan make:controller UserController -r


php artisan route:list



composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

php artisan make:controller AuthController
php artisan route:list
composer dump-autoload
php artisan route:clear
 php artisan serve
 composer require spatie/laravel-permission
  php artisan migrate
  php artisan make:seeder RolePermissionSeeder
  php artisan db:seed --class=RolePermissionSeeder
  php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
  php artisan migrate
  php artisan migrate:fresh