<?php

namespace SimplePhp;

/**
 * A simple dotenv loader for PHP applications.
 *
 * This class provides functionality to load environment variables from .env files
 * and make them available through PHP's getenv() function.
 */
class Dotenv
{
    /**
     * Load environment variables from a .env file.
     *
     * Reads the specified .env file, parses key=value pairs, and sets them as
     * environment variables. Comments (lines starting with #) and empty lines
     * are ignored. Values can be wrapped in single or double quotes.
     *
     * @param string|null $dotenv_path Path to the .env file. Defaults to '.env' in the current directory.
     *
     * @return void
     *
     * @throws \Exception When the specified .env file does not exist or cannot be read.
     *
     * @example
     * ```php
     * // Load from default .env file
     * SimplePhp\Dotenv::load();
     *
     * // Load from custom path
     * SimplePhp\Dotenv::load('/path/to/custom.env');
     *
     * // Access loaded variables
     * $value = getenv('MY_VARIABLE');
     * ```
     */
    public static function load(?string $dotenv_path = '.env'): void
    {
        $dotenv_content = file_get_contents($dotenv_path);

        if ($dotenv_content !== false) {
            $dotenv_lines = array_filter(
                explode("\n", $dotenv_content),
                fn ($line) => !empty(trim($line) && !str_starts_with(trim($line), '#'))
            );

            if (\count($dotenv_lines) > 0) {
                foreach ($dotenv_lines as $dotenv_line) {
                    list($key, $value) = explode('=', $dotenv_line);

                    $value = trim($value, " \t\n\r\0\x0B'\"");

                    putenv(join('=', array_map('strval', [$key, $value])));
                }
            }
        } else {
            throw new \ErrorException('no such a dotenv file in this project');
        }
    }
}
