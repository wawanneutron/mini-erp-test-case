<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Laptop Asus ROG', 'price' => 25000000],
            ['name' => 'Macbook Pro M3', 'price' => 32000000],
            ['name' => 'Keyboard Mechanical', 'price' => 1500000],
            ['name' => 'Mouse Logitech', 'price' => 750000],
            ['name' => 'Monitor LG 27 Inch', 'price' => 4500000],
            ['name' => 'Headset Gaming Razer', 'price' => 2200000],
            ['name' => 'SSD Samsung 1TB', 'price' => 1800000],
            ['name' => 'Harddisk External 2TB', 'price' => 1200000],
            ['name' => 'RAM DDR5 16GB', 'price' => 1400000],
            ['name' => 'VGA RTX 4070', 'price' => 9500000],
            ['name' => 'Webcam Logitech C920', 'price' => 1100000],
            ['name' => 'Printer Epson L3250', 'price' => 2700000],
            ['name' => 'Router TP-Link AX55', 'price' => 1600000],
            ['name' => 'Tablet iPad Air', 'price' => 12000000],
            ['name' => 'Smartphone Samsung S24', 'price' => 14000000],
        ];

        foreach (Tenant::all() as $tenant) {

            foreach ($products as $product) {
                Product::create([
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'tenant_id' => $tenant->id
                ]);
            }

        }
    }
}
