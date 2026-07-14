<?php

namespace App\Models;

/**
 * FakeSale
 *
 * این کلاس فقط برای مینی‌پروژه‌ی آموزشی ساخته شده.
 * به‌جای وصل شدن به دیتابیس واقعی، داده‌های نمونه (in-memory) برمی‌گردونه
 * تا بشه رفتار Route Model Binding و Eager Loading رو
 * بدون نیاز به Migration و Seeder واقعی تست کرد.
 */
class FakeSale
{
    public int $id;
    public string $name;
    public string $mobile;
    public string $address;
    public int $status_id;

    private static array $store = [];

    public function __construct(int $id, string $name, string $mobile, string $address, int $status_id)
    {
        $this->id        = $id;
        $this->name      = $name;
        $this->mobile    = $mobile;
        $this->address   = $address;
        $this->status_id = $status_id;
    }

    /**
     * شبیه‌سازی findOrFail برای Route Model Binding
     */
    public static function findOrFail(int $id): self
    {
        $data = self::seed()[$id] ?? null;

        if (!$data) {
            // در لاراول واقعی این خط باعث میشه فریمورک خودش 404 بده
            throw new \RuntimeException("Sale #{$id} not found");
        }

        return new self($id, $data['name'], $data['mobile'], $data['address'], $data['status_id']);
    }

    /**
     * شبیه‌سازی رابطه‌ی status() به‌همراه eager loading
     */
    public function statusName(): string
    {
        $statuses = [
            3 => 'آماده بسته‌بندی',
            8 => 'بسته‌بندی شده',
            4 => 'ارسال شده',
        ];

        return $statuses[$this->status_id] ?? 'نامشخص';
    }

    /**
     * شبیه‌سازی رابطه‌ی products.product (nested eager loading)
     */
    public function products(): array
    {
        $productsBySale = [
            1 => [
                ['id' => 101, 'product_id' => 1, 'size' => 'M', 'color' => 'آبی', 'product_name' => 'تیشرت کلاسیک', 'sell_price' => 250000],
                ['id' => 102, 'product_id' => 2, 'size' => 'L', 'color' => 'مشکی', 'product_name' => 'شلوار جین', 'sell_price' => 450000],
            ],
            2 => [
                ['id' => 201, 'product_id' => 3, 'size' => 'S', 'color' => 'سفید', 'product_name' => 'کلاه', 'sell_price' => 120000],
            ],
        ];

        return $productsBySale[$this->id] ?? [];
    }

    private static function seed(): array
    {
        return [
            1 => ['name' => 'علی رضایی',  'mobile' => '09120000001', 'address' => 'تهران', 'status_id' => 3],
            2 => ['name' => 'سارا احمدی', 'mobile' => '09120000002', 'address' => 'مشهد',  'status_id' => 8],
        ];
    }
}