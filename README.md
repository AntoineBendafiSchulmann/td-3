# IIM TD3

[![Last version](https://img.shields.io/packagist/v/antoinebendafi/iim-td3?maxAge=3600)](https://packagist.org/packages/antoinebendafi/iim-td3)

## Installation

```bash
composer require AntoineBendafiSchulmann/td3
```

## Local development

```bash
composer install
```

```bash
 php vendor/bin/phpstan analyse src --level=max
```


```bash
php vendor/bin/php-cs-fixer fix src --rules=@PSR12
```

```bash
php vendor/bin/phpunit tests
```