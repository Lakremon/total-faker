# total-faker

## Quick start

To use Total Faker to fill your database you should install it via composer.

```sh
$ composer require lakremon/total-faker
```

or

```sh
$ php composer.pher require lakremon/total-faker
```

Depending on what framework you use, you can use different adapters for different frameworks to implement Total Faker.

##### Yii2

##### Laravel

##### Symfony 4

##### Zend Framework 3

##### Without framework usage

Create `index.php` in the root of your application with content.

```php
<?php
require("vendor/autoload.php");
$totalFaker = \TotalFaker\TotalFaker::getWorld();
```

### Usage
Then you can use Total Faker to model your data. First of all you should generate new world.


## Plan:

- City
- Street
- Building
- Person
- Company
- University
- School
- Phone
- Computer
- Car