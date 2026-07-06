<?php
// Auto-prepend stub for PCOV E2E
declare(strict_types=1);

$bootstrap = __DIR__ . '/pcov-e2e-bootstrap.php';
if (is_file($bootstrap)) {
    require_once $bootstrap;
}

$common = __DIR__ . '/pcov-e2e-common.php';
if (is_file($common)) {
    require_once $common;
}

if (function_exists('pcov_e2e_should_instrument') && pcov_e2e_should_instrument()) {
    if (function_exists('pcov_start')) {
        pcov_start();
    }
}
