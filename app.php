<?php
// Minimal app entry stub for coverage import test
declare(strict_types=1);

require_once dirname(__DIR__) . '/scripts/pcov-e2e-common.php';

function app_bootstrap(): string
{
    if (pcov_e2e_should_instrument()) {
        return 'instrumented';
    }
    return 'idle';
}

if (PHP_SAPI !== 'cli') {
    header('Content-Type: text/plain; charset=utf-8');
    echo app_bootstrap();
}
