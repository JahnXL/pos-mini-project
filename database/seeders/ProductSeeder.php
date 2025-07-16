<?php

namespace Database\Seeders;


use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends \Illuminate\Database\Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Truncate child and parent tables
        \App\Models\SaleItem::truncate();
        \App\Models\Product::truncate();
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = \Faker\Factory::create();

        $productNames = [
            'Apple iPhone 14', 'Samsung Galaxy S23', 'Sony WH-1000XM4 Headphones', 'Dell XPS 13 Laptop',
            'Logitech MX Master 3 Mouse', 'HP Envy Printer', 'Canon EOS M50 Camera', 'Nintendo Switch Console',
            'Apple MacBook Pro', 'Google Pixel 7', 'Bose QuietComfort Earbuds', 'Asus ROG Gaming Laptop',
            'Microsoft Surface Pro', 'JBL Flip 6 Speaker', 'Fitbit Versa 3', 'Amazon Echo Dot', 'Lenovo ThinkPad X1',
            'Razer BlackWidow Keyboard', 'Samsung SSD 1TB', 'WD My Passport 2TB',
        ];
        $total = 2000;
        $nameCount = count($productNames);
        if ($nameCount === 0) {
            throw new \Exception('Product names array is empty. Please provide at least one product name.');
        }
        for ($i = 1; $i <= $total; $i++) {
            $name = $productNames[($i - 1) % $nameCount] . " #" . $i;
            \App\Models\Product::create([
                'name' => $name,
                'description' => $faker->sentence(8),
                'price' => $faker->randomFloat(2, 10, 2000),
                'stock_quantity' => $faker->numberBetween(0, 200),
                'sku' => 'SKU' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'category' => $faker->randomElement(['Electronics', 'Accessories', 'Storage', 'Office', 'Home', 'Gaming'])
            ]);
        }
    }
}