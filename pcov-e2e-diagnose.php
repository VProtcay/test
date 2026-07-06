<?php
// PCOV E2E diagnose endpoint stub
declare(strict_types=1);

header('Content-Type: text/plain; charset=utf-8');

require_once __DIR__ . '/pcov-e2e-common.php';

echo 'PCOV_E2E_MODE env=' . pcov_e2e_mode() . "\n";
echo 'should_instrument=' . (pcov_e2e_should_instrument() ? 'yes' : 'no') . "\n";
echo 'pcov_loaded=' . (extension_loaded('pcov') ? 'yes' : 'no') . "\n";

$dir = pcov_e2e_shard_dir();
$count = is_dir($dir) ? count(glob($dir . '/*.cov') ?: []) : 0;
echo 'shard_files=' . $count . "\n";
