
---

## توضیح خط به خط کد (نسخه بهبود یافته)

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductSizeColor;
use App\Models\Sale;
use Inertia\Inertia;

class PackingController extends Controller
{
    /**
     * نمایش صفحه اصلی بسته‌بندی (Inertia Page)
     */
    public function index()
    {
        return Inertia::render('Admin/Packing/Index');
    }

    /**
     * دریافت اطلاعات کامل یک سفارش برای عملیات بسته‌بندی
     * 
     * @param Sale $sale  → Route Model Binding (Laravel خودش Sale رو از id پیدا می‌کنه)
     */
    public function showForPacking(Sale $sale)
    {
        // Eager Loading: یک query برای لود کردن status و همه محصولات + اطلاعات محصول
        $sale->load(['status', 'products.product']);

        $stage = $this->determinePackingStage($sale->status_id);

        $products = $sale->products->map(function ($item) {
            return [
                'id'           => $item->id,
                'product_id'   => $item->product_id,
                'size'         => $item->size,
                'color'        => $item->color,
                'product_name' => $item->product->name ?? '—',
                'sell_price'   => $item->product->sell_price ?? 0,
                'image'        => $item->product->getFirstMediaUrl('images'),
            ];
        });

        return response()->json([
            'id'            => $sale->id,
            'name'          => $sale->name,
            'mobile'        => $sale->mobile,
            'address'       => $sale->address,
            'status_id'     => $sale->status_id,
            'status_name'   => $sale->status->name ?? '',
            'packing_stage' => $stage,
            'products'      => $products,
        ]);
    }

    /**
     * جستجوی سریع یک محصول با شناسه ProductSizeColor
     */
    public function lookup(ProductSizeColor $psc)
    {
        $psc->load('product');

        if (!$psc) {
            return response()->json(['error' => 'محصول یافت نشد'], 404);
        }

        return response()->json([
            'id'           => $psc->id,
            'product_id'   => $psc->product_id,
            'size'         => $psc->size,
            'color'        => $psc->color,
            'product_name' => $psc->product->name ?? '—',
        ]);
    }

    /**
     * متد خصوصی برای تعیین مرحله بسته‌بندی
     * این کار باعث تمیزتر شدن متدهای عمومی می‌شود
     */
    private function determinePackingStage(int|string $statusId): string
    {
        $statusId = (int) $statusId;

        return match ($statusId) {
            3       => 'ready',     // آماده بسته‌بندی
            8       => 'packaged',  // بسته‌بندی شده
            4       => 'sent',      // ارسال شده
            default => 'other',
        };
    }
}