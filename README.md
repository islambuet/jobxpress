# jobxpress
//from github to update
1.composer install
2.discard changes from gitdesktop
3.database
4.env file
5.run env key command
///////////////

1. laravel new jobxpress
2.update migration userstable
3.setup .env file SESSION_DRIVER=database
4. php artisan session:table
5. php artisan migrate

#livewire
6.composer require livewire/livewire
7.php artisan make:livewire HomeComponent (rename view file and folder locaiton)
8.1. php artisan make:model JobCategory -m
8.2. php artisan make:model JobType -m
8.3. php artisan make:model Configuration -m
8.4. php artisan make:model Job -m 
8.5. php artisan migrate