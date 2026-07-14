<?php

/**
 * این فایل فقط جنبه‌ی مرجع داره و در پروژه‌ی واقعی داخل routes/web.php
 * (با namespace و middleware مناسب admin) قرار می‌گیره.
 *
 * نکته‌ی کلیدی Route Model Binding:
 * چون پارامتر روت {sale} با نوع Sale $sale در امضای متد یکی هست،
 * لاراول به‌صورت خودکار رکورد رو از دیتابیس پیدا می‌کنه
 * و اگه پیدا نشه، خودش یک 404 برمی‌گردونه - دیگه لازم نیست
 * دستی findOrFail یا if(!$sale) بنویسیم.
 */

use App\Http\Controllers\Admin\PackingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin/packing')->group(function () {
    Route::get('/', [PackingController::class, 'index'])->name('admin.packing.index');
    Route::get('/{sale}', [PackingController::class, 'showForPacking'])->name('admin.packing.show');
    Route::get('/lookup/{psc}', [PackingController::class, 'lookup'])->name('admin.packing.lookup');
});