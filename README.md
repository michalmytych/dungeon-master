# Dungeon Master

### Basic setup
php8.2 & Composer 2.5+ required.
```bash
composer install
cp .env.example .env
# Fill database credentials in .env
php artisan key:generate
php artisan migrate 
php artisan serve
```
Current api routes:
```bash
  GET|HEAD   api/characters/{id} ................... api.character.show › App\Character\Http\Api\Controllers\CharacterController@show
  POST       api/games ........................................ api.game.create › App\Game\Http\Api\Controllers\GameController@create
  POST       api/games/{code}/join ................................ api.game.join › App\Game\Http\Api\Controllers\GameController@join
  POST       api/users/login .................................... api.user.login › App\User\Http\Api\Controllers\UserController@login
  POST       api/users/logout ................................. api.user.logout › App\User\Http\Api\Controllers\UserController@logout
  POST       api/users/register ........................... api.user.register › App\User\Http\Api\Controllers\UserController@register
  GET|HEAD   api/users/user ....................................... api.user.user › App\User\Http\Api\Controllers\UserController@user
```
