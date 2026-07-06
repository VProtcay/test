<?php
// PCOV E2E helpers — simplified stub matching Devprom layout
declare(strict_types=1);

function pcov_e2e_mode(): string
{
    return getenv('PCOV_E2E_MODE') ?: 'cookie';
}

function pcov_e2e_should_instrument(): bool
{
    if (!extension_loaded('pcov')) {
        return false;
    }

    if (pcov_e2e_mode() === 'all') {
        return true;
    }

    $cookie = $_COOKIE['devprom_pcov_e2e'] ?? '';
    $header = $_SERVER['HTTP_X_DEVPROM_PCOV_E2E'] ?? '';
    return $cookie === '1' || $header === '1';
}

function pcov_e2e_shard_dir(): string
{
    return dirname(__DIR__) . '/build/pcov-e2e-shards';
}

function pcov_e2e_write_shard(): void
{
    if (!pcov_e2e_should_instrument()) {
        return;
    }

    $dir = pcov_e2e_shard_dir();
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $data = pcov_collect(false);
    $file = $dir . '/shard-' . getmypid() . '-' . microtime(true) . '.cov';
    file_put_contents($file, serialize($data));
}

function pcov_e2e_excluded_path(string $path): bool
{
    $patterns = ['/login', '/install', '/cache/', '.js', '.css', '.png'];
    foreach ($patterns as $pattern) {
        if (str_contains($path, $pattern)) {
            return true;
        }
    }
    return false;
}

function pcov_e2e_register_shutdown(): void
{
    register_shutdown_function(static function (): void {
        pcov_e2e_write_shard();
    });
}

if (pcov_e2e_should_instrument()) {
    pcov_e2e_register_shutdown();
}
