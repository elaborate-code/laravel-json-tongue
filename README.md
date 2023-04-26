# Laravel JSON tongue

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elaborate-code/laravel-json-tongue.svg?style=flat-square)](https://packagist.org/packages/elaborate-code/laravel-json-tongue)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/elaborate-code/laravel-json-tongue/run-tests.yml?branch=main)](https://github.com/elaborate-code/laravel-json-tongue/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/elaborate-code/laravel-json-tongue/fix-php-code-style-issues.yml?branch=main)](https://github.com/elaborate-code/laravel-json-tongue/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/elaborate-code/laravel-json-tongue.svg?style=flat-square)](https://packagist.org/packages/elaborate-code/laravel-json-tongue)
![maintained](https://img.shields.io/maintenance/yes/2023)
![Production ready](https://img.shields.io/badge/Production%20ready-no-red)

This package is built on top of [PHP JSON tongue](https://github.com/elaborate-code/php-json-tongue) to enable the usage of multiple JSON files per locale on Laravel.

## Introduction

Starting with Laravel docs:

> Translation strings may be defined within JSON files that are placed within the lang directory. When taking this approach, **each language supported by your application would have a corresponding JSON file** within this directory. This approach is recommended for applications that have a large number of translatable strings.

[Read more...](https://laravel.com/docs/9.x/localization#using-translation-strings-as-keys)

Intuitively, many developers wonder why isn't it possible to have **each language supported by their application have multiple corresponding JSON files**. Multiple JSON files allows grouping strings by topic, and keeping the files small and clear.

## Installation

Install the package via composer:

```bash
composer require elaborate-code/laravel-json-tongue
```

### Requirements

-   PHP 8.0 or higher.

## Usage

File structure example:

![example](https://raw.githubusercontent.com/elaborate-code/php-json-tongue/main/illustration.png)

> The JSON files can co-exist with the PHP files without any conflicts!

### The merge command

This command loads all the JSON files from `/<locale>` folders within the `/lang` folder and merge them per **locale** in new JSON files.

```bash
php artisan json-tongue:merge
```

Options:

| Option        | Description                                                                           |
| ------------- | ------------------------------------------------------------------------------------- |
| `-F\|--force` | Removes JSON files that already exist in the root of the `lang` folder without asking |

> JSON files that already exist in the root of the `lang` folder, can be old JSON files previously generated by the command, or files that you have created manually and populated manually.
>
> ⚠️ In the second case be careful before instructing the command to remove existing JSON files!

#### Example

Before merging :

```txt
 lang
 ┣ 📂es
 ┃ ┣ 📜animals.json
 ┃ ┣ 📜greetings.json
 ┃ ┗ 📜jobs.json
 ┗ 📂fr
   ┣ 📜animals.json
   ┣ 📜greetings.json
   ┗ 📜jobs.json
```

After merging:

```txt
 lang
 ┣ 📂es
 ┃ ┣ 📜animals.json
 ┃ ┣ 📜greetings.json
 ┃ ┗ 📜jobs.json
 ┣ 📂fr
 ┃ ┣ 📜animals.json
 ┃ ┣ 📜greetings.json
 ┃ ┗ 📜jobs.json
 ┣ 📜es.json  ⭐ Usable by Laravel
 ┗ 📜fr.json  ⭐ Usable by Laravel
```

## Testing

```bash
./vendor/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

Help needed to add a watch command that refreshes the output JSON files with new translations added on the locale folders.

## Credits

-   [medilies](https://github.com/medilies)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
