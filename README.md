
composer require fgutierrezphp/addreses_rd:dev-main

php artisan vendor:publish --provider="FgutierrezPHP\AddresesRd\AddressRdServiceProvider"

php artisan migrate

php artisan install:addreses