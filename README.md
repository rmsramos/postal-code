# Filament CEP integration with ViaCep

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rmsramos/postal-code.svg?style=flat-square)](https://packagist.org/packages/rmsramos/postal-code)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/rmsramos/postal-code/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/rmsramos/postal-code/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rmsramos/postal-code.svg?style=flat-square)](https://packagist.org/packages/rmsramos/postal-code)

This package provides custom form field for Filament integration with ViaCep.

## Installation

You can install the package via composer:

```bash
composer require rmsramos/postal-code
```

## Usage

```php

use Filament\Forms\Components\TextInput;
use Rmsramos\PostalCode\Components\PostalCode;

public static function form(Form $form): Form
{
    return $form
        ->schema([
            PostalCode::make('postal_code')
                ->viaCep(
                    errorMessage: 'CEP inválido.', // Custom message to display if the CEP is invalid.
                    setFields: [
                        'street'        => 'logradouro',
                        'number'        => 'numero',
                        'complement'    => 'complemento',
                        'district'      => 'bairro',
                        'city'          => 'localidade',
                        'state'         => 'uf'
                    ]
                ),

            TextInput::make('street'),
            TextInput::make('number')
                 ->extraAlpineAttributes([
                     'x-on:cep.window' => "\$el.focus()",
                 ]),,
            TextInput::make('complement'),
            TextInput::make('district'),
            TextInput::make('city'),
            TextInput::make('state'),
        ])
}

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Rômulo Ramos](https://github.com/rmsramos)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
