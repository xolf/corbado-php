# Corbado PHP client


## Requirements
PHP 8.0 or later

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```
composer require xolf/corbado-php
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading):
```php
require_once 'vendor/autoload.php';
```

## Dependencies
The bindings require the following extensions in order to work properly:
- [`curl`](https://secure.php.net/manual/en/book.curl.php), although you can use your own non-cURL client if you prefer
- [`json`](https://secure.php.net/manual/en/book.json.php)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.

## Getting started
Simple usage looks like:
```php
$corbado = new \Corbado\CorbadoClient('secret_key', 'webhook_user', 'webhook_password');
```
