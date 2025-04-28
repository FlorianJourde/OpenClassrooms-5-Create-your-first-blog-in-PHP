<?php

namespace Application\Lib;

class DotEnv
{
    protected string $path;
    protected ?string $localPath;

    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
        }
        $this->path = $path;

        $localPath = dirname($path) . '/.env.local';
        $this->localPath = file_exists($localPath) ? $localPath : null;
    }

    public function load(): void
    {
        $this->loadFile($this->path);

        if ($this->localPath !== null) {
            $this->loadFile($this->localPath);
        }
    }

    private function loadFile(string $filePath): void
    {
        if (!is_readable($filePath)) {
            throw new \RuntimeException(sprintf('%s file is not readable', $filePath));
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            if (strpos($line, '=') !== false) {
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);

                if (preg_match('/^("|\')(.*)\1$/', $value, $matches)) {
                    $value = $matches[2];
                }

                $_ENV[$name] = $value;
                putenv(sprintf('%s=%s', $name, $value));
            }
        }
    }
}