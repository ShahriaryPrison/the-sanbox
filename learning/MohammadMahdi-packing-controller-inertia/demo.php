<?php

/**
 * demo.php
 *
 * برای اجرای مستقیم و دیدن خروجی، بدون نیاز به یک پروژه‌ی کامل لاراول:
 *   php demo.php
 */

require __DIR__ . '/app/Models/FakeSale.php';
require __DIR__ . '/app/Http/Controllers/DemoPackingController.php';

use App\Http\Controllers\DemoPackingController;

$controller = new DemoPackingController();

echo "--- index() ---\n";
print_r($controller->index());

echo "\n--- showForPacking(1) ---\n";
print_r($controller->showForPacking(1));

echo "\n--- showForPacking(2) ---\n";
print_r($controller->showForPacking(2));

echo "\n--- تست حالت not found ---\n";
try {
    $controller->showForPacking(999);
} catch (\RuntimeException $e) {
    echo "Exception گرفته شد (دقیقا شبیه رفتار 404 در Route Model Binding واقعی): "
        . $e->getMessage() . "\n";
}