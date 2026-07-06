<?php
// Minimal PCOV E2E bootstrap stub for I-73797 coverage import test
declare(strict_types=1);

function pcov_e2e_bootstrap(): bool
{
    if (!extension_loaded('pcov')) {
        return false;
    }

    $mode = getenv('PCOV_E2E_MODE') ?: 'cookie';
    if ($mode === 'all') {
        pcov_start();
        return true;
    }

    $cookie = $_COOKIE['devprom_pcov_e2e'] ?? '';
    $header = $_SERVER['HTTP_X_DEVPROM_PCOV_E2E'] ?? '';
    if ($cookie === '1' || $header === '1') {
        pcov_start();
        return true;
    }

    return false;
}

pcov_e2e_bootstrap();
