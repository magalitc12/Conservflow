# CONSERFLOW 2021

comandos a considerar:

1.- composer update

CONFIGURAR STORAGE
2.-php artisan storage:link

mkdir storage/framework/sessions
mkdir storage/framework/views
mkdir storage/framework/cache


RECONFIGURAR CACHE
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

CONFIGURAR 1 USUARIO
php artisan tinker
$user = User::where('name_user','Ramon')->first();
$user->password = Hash::make('password123')
$user->save();
