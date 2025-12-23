<?php

use SimplePhp\Dotenv;

const DOTENV_PATH = '.env.production';

describe('Dotenv::load', function () {
    it('loads environment variables from a default .env file', function () {
        file_put_contents('.env', "TEST_KEY_1=test_value_1\nTEST_KEY_2='test_value_2'\n#comment\n\nTEST_KEY_3=\"test_value_3\"");

        Dotenv::load();

        expect(getenv('TEST_KEY_1'))->toBe('test_value_1');
        expect(getenv('TEST_KEY_2'))->toBe('test_value_2');
        expect(getenv('TEST_KEY_3'))->toBe('test_value_3');

        unlink('.env');
    });

    it('loads environment variables from a specific .env file', function () {

        file_put_contents(DOTENV_PATH, "TEST_KEY_1=test_value_1\nTEST_KEY_2='test_value_2'\n#comment\n\nTEST_KEY_3=\"test_value_3\"");

        Dotenv::load(DOTENV_PATH);

        expect(getenv('TEST_KEY_1'))->toBe('test_value_1');
        expect(getenv('TEST_KEY_2'))->toBe('test_value_2');
        expect(getenv('TEST_KEY_3'))->toBe('test_value_3');

        unlink(DOTENV_PATH);
    });
});
