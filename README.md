[![Installs](https://img.shields.io/packagist/dt/talliumcom/sumatra-php-soap-client.svg)](https://packagist.org/packages/talliumcom/sumatra-php-soap-client/stats)
[![Packagist](https://img.shields.io/packagist/php-v/talliumcom/sumatra-php-soap-client.svg)](https://packagist.org/packages/talliumcom/sumatra-php-soap-client)


## SOAP Client for Sumatra

### Requirements

* php >7.1
* ext-soap 
* ext-xml

### Installation
```bash
composer require talliumcom/sumatra-php-soap-client:dev-master
```

### Usage 
```php
<?php

include_once 'vendor/autoload.php';

use Sumatra\SumatraClientFactory;
use Sumatra\Type\Kunden_einwilligung_argument;

$wsdl = 'http://example.com/sumatra.wsdl';
$username = 'username';
$password = 'password';

$client = SumatraClientFactory::factory(
    $wsdl,
    $username,
    $password
);

$argument = (new Kunden_einwilligung_argument())
    ->withBegruendung('John Snow')
    ->withAnrede('Herr')
    ->withNewsletter(true)
    ->withZuname('Albrecht')
    ->withEmail('test@example.com');

try {
    $response = $client->kunden_einwilligung($argument);

    echo $response->getStatus()->getInformation();
} catch (Exception $exception) {
    echo $exception->getMessage();
}
```


### Development Setup

```bash
composer install --ignore-platform-reqs 
docker-compose up -d
docker-compose exec php bash
apt-get update
apt-get install libxml2-dev -y
docker-php-ext-install soap
php -S 0.0.0.0:80
```
