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

## Serialization

This library provide a new handler for `jms\serializer` to handle serialization/deserialization from and to `Currency`.

```php
<?php

$serializer->configureHandlers(function(JMS\Serializer\Handler\HandlerRegistry $registry) {
    $registry->registerSubscribingHandler(new Luxifer\Handler\CurrencyHandler($manager));
});
```

You can now use `Currency` as a `Type` inside your objects.

```php
<?php
use JMS\Serializer\Annotation\Type;

class MyObject
{
    /**
     * @Type("Currency")
     *
     * will serialize to the currency ISO code
     */
    protected $currency;

    /**
     * @Type("Currency<'symbol'>")
     *
     * will serialize to the currency symbol
     */
    protected $symbol;
}
```

## Thanks

I would like to tkank @Fluidbyte for the initial currency list published on [gist](https://gist.github.com/Fluidbyte/2973986).
