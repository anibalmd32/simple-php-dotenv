# SimplePhpDotenv

A lightweight library for set environment variables from a .env local file

## Usage

To load environment variables from a `.env` file in your PHP project, use the `Dotenv` class:

```php
<?php
require 'vendor/autoload.php';

use SimplePhp\Dotenv;

// Load environment variables from the default .env file
Dotenv::load();

// Access environment variables using getenv()
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
```

You can also specify a custom path to the `.env` file:

```php
Dotenv::load('/path/to/custom.env');
```

Make sure your `.env` file contains key-value pairs in the format:

```text
KEY=value
ANOTHER_KEY='value with quotes'
# Comments are ignored
```

This library will ignore empty lines and lines starting with `#`.
