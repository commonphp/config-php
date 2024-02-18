<?php /** @noinspection PhpUnused */

declare(strict_types=1);

/**
 * Class PhpConfigurationDriver
 *
 * This class implements the ConfigurationDriverContract and provides functionality to load and save data from/to a PHP file.
 *
 * @package CommonPHP\Configuration\Drivers\PhpConfigurationDriver
 */

namespace CommonPHP\Configuration\Drivers\PhpConfigurationDriver;

use CommonPHP\Configuration\Attributes\ConfigurationDriverAttribute;
use CommonPHP\Configuration\Contracts\ConfigurationDriverContract;
use CommonPHP\Configuration\Exceptions\ConfigurationException;
use Override;

/**
 * Class PhpConfigurationDriver
 *
 * This class implements the ConfigurationDriverContract and provides functionality to load and save data from/to a PHP file.
 *
 * @package CommonPHP\Configuration\Drivers\PhpConfigurationDriver
 */
#[ConfigurationDriverAttribute('php')]
class PhpConfigurationDriver implements ConfigurationDriverContract
{

    /**
     * Checks if the current driver supports saving
     *
     * @return bool Returns true if the file can be saved, otherwise false.
     */
    #[Override] function canSave(): bool
    {
        return true;
    }

    /**
     * Loads data from a file.
     *
     * @param string $filename The name of the file to load.
     *
     * @return array<string|int, mixed> The data loaded from the file.
     * @throws ConfigurationException If the included file does not return an array.
     *
     */
    #[Override] function load(string $filename): array
    {
        $data = include($filename);

        if(!is_array($data)){
            throw new ConfigurationException("Included file did not return an array: $filename");
        }

        return $data;
    }

    /**
     * Saves data into a file.
     *
     * @param string $filename The name of the file to save data into.
     * @param array<string|int, mixed> $data The data to be saved into the file.
     * @return void
     * @throws ConfigurationException
     */
    #[Override] function save(string $filename, array $data): void
    {
        $exportedData = var_export($data, true);
        $content = "<?php return $exportedData;";

        if (false === file_put_contents($filename, $content)) {
            throw new ConfigurationException("Unable to write data to file: $filename");
        }
    }
}