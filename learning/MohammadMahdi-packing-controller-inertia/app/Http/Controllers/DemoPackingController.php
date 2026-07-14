<?php

namespace App\Http\Controllers;

use App\Models\FakeSale;

/**
 * DemoPackingController
 *
 * نسخه‌ی جمع‌وجور و مستقل از PackingController اصلی پروژه.
 * هدف: نشون دادن سه مفهوم کلیدی بدون نیاز به دیتابیس واقعی یا Inertia نصب‌شده:
 *
 *  1) Route Model Binding  -> اینجا با findOrFail شبیه‌سازی شده
 *  2) Eager Loading         -> اینجا با statusName() و products() که
 *                              همه‌ی داده‌ی لازم رو یکجا برمی‌گردونن، به‌جای
 *                              کوئری جداگانه به ازای هر آیتم (مشکل N+1)
 *  3) Response شکل‌دهی‌شده  -> همون آرایه‌ای که در پروژه‌ی واقعی
 *                              Inertia::render یا response()->json می‌گیرتش
 */
class DemoPackingController
{
    public function index(): array
    {
        // در پروژه‌ی واقعی: return Inertia::render('Admin/Packing/Index');
        return ['page' => 'Admin/Packing/Index'];
    }

    public function showForPacking(int $saleId): array
    {
        // Route Model Binding: لاراول خودش Sale رو پیدا می‌کنه،
        // اینجا دستی findOrFail صدا زده می‌شه
        $sale = FakeSale::findOrFail($saleId);

        $stage = $this->determinePackingStage($sale->status_id);

        $products = array_map(function ($item) {
            return [
                'id'           => $item['id'],
                'product_id'   => $item['product_id'],
                'size'         => $item['size'],
                'color'        => $item['color'],
                'product_name' => $item['product_name'] ?? '—',
                'sell_price'   => $item['sell_price'] ?? 0,
            ];
        }, $sale->products());

        return [
            'id'            => $sale->id,
            'name'          => $sale->name,
            'mobile'        => $sale->mobile,
            'address'       => $sale->address,
            'status_id'     => $sale->status_id,
            'status_name'   => $sale->statusName(),
            'packing_stage' => $stage,
            'products'      => $products,
        ];
    }

    private function determinePackingStage(int|string $statusId): string
    {
        $statusId = (int) $statusId;

        return match ($statusId) {
            3       => 'ready',
            8       => 'packaged',
            4       => 'sent',
            default => 'other',
        };
    }
}