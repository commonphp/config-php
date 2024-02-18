# PHP Configuration Driver for CommonPHP

This library introduces the PHP configuration driver, `PhpConfigurationDriver`, as part of the CommonPHP Configuration Management ecosystem. It extends the functionality of CommonPHP by allowing applications to seamlessly load and save configurations using PHP files.

## Features

- **Load PHP Configurations**: Simplifies the process of reading PHP files and converting them into associative arrays for easy access within PHP applications.
- **Save Configurations as PHP**: Offers the ability to serialize PHP associative arrays back into PHP format, preserving the structure and hierarchies.
- **Structured Error Handling**: Incorporates detailed exception handling to manage potential parsing and file operation errors effectively.
- **Support for Nested Structures**: Through a custom implementation, it supports the representation of nested structures within PHP files, providing greater flexibility in configuration management.

## Installation

Use Composer to integrate both the Configuration Manager and the PHP driver into your project:

```
composer require comphp/config
composer require comphp/config-php
```

## Usage

To utilize the PHP driver with the Configuration Manager, first ensure the `DriverManager` is configured to recognize the PHP driver:

```php
use CommonPHP\Drivers\DriverManager;
use CommonPHP\Configuration\Drivers\PhpConfigurationDriver\PhpConfigurationDriver;

$driverManager = new DriverManager();
$driverManager->enable(PhpConfigurationDriver::class);
```

Upon configuration, the `PhpConfigurationDriver` will be automatically used for `.php` file extensions, thanks to the `#[ConfigurationDriverAttribute('php')]` annotation.

### Loading a Configuration File

```php
$configManager->loadDriver(PhpConfigurationDriver::class);
$config = $configManager->get('path/to/configuration.php');
```

### Saving a Configuration File

After loading the driver as described above, modifications can be saved back to the PHP file:

```php
$config->data['newSection'] = ['newKey' => 'newValue'];
$config->save(); // Persists the changes to 'path/to/configuration.php'
```

## Exception Handling

The driver includes specific exception handling for common issues such as:

- **ConfigurationException**: Thrown for errors related to PHP file parsing or when the file format does not meet the expected structure.
- **General Exceptions**: For file read/write operations or parsing failures.
