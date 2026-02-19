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
