Doar Calculator - IPC postage cacculator
=======================

```php
$calculator = new Doar\DoarCalculator();

$res = $calculator->setServiceOption($calculator::STANDARD_DELIVERY)
	->setWeight(40)
	->setQuantity(3)
	->setLanguage('HE')
	->Calculate();
  
foreach ($res->getPrices() as $priceOption) {
	echo $priceOption->getPrice();
}
```

## Installing Doar Calculator

The recommended way to install Doar Calculator is through
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version of Doar Calculator:

```bash
php composer.phar require idofri/doar-calculator
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

You can then later update Doar Calculator using composer:

 ```bash
composer.phar update
 ```
