<?php

namespace Framework;

class ConfigManager
{
    /** @var array<string> */
    public array $config;

    /**
     * @param array<string> $config
     */
    public function __construct(array $config)
    {
        // setting the default config
        $this->config = [
            'APP_ENV' => 'production',
            'VIEWS_PATH' => 'C:\Users\User\OneDrive\Desktop\uni\FP1\taskey\app\views'
        ];

        // overriding config where needed
        foreach ($config as $key => $value) {
            $this->config[$key] = $value;
        }
    }

    public function get(string $key): string
    {
        return $this->config[$key];
    }

    public function isProduction(): bool
    {
        if ($this->config['APP_ENV'] == 'production') {
            return true;
        } else {
            return false;
        }
    }
}
