Sendsay API
=============

Lightweight [Sendsay API](https://sendsay.ru/api/api.html) wrapper

Installation
------------

```
composer require ba1mor/sendsay-api
```

Examples
--------

```php
use \Esdteam\Sendsay\Sendsay;

$sendsay = new Sendsay('account', 'apikey');
// list of subscribers with any locks
$result = $sendsay->request('member.list', [
    'member.haslock' => '-1'
]);
```