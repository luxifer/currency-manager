# Currency Manager

This library aims to be a simple lightweight currency manager. It includes a JSON file containing almost every currency definitions. With this libray you can find currency by some field and use the definition in your project. This libray requires `jms/serializer` to work.

## Installation

```
composer require luxifer/currency-manager
```

## Usage

```php
<?php

require 'vendor/autoload.php';

$serializer = JMS\Serializer\SerializerBuilder::create()->build();
$manager = new Luxifer\Manager\CurrencyManager($serializer);

$euro = $manager->getCurrencyBy('code', 'EUR'); // Luxifer\Model\Currency
```
