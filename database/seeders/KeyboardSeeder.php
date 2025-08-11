<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Keyboard;

class KeyboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keyboards = [
            [
                'name' => 'Corsair K95 RGB Platinum XT',
                'description' => 'Premium mechanical gaming keyboard with Cherry MX switches and RGB lighting.',
                'price' => 199.99,
                'brand' => 'Corsair',
                'switch_type' => 'Cherry MX Blue',
                'layout' => 'Full Size',
                'connectivity' => 'Wired',
                'rgb_lighting' => true,
                'color' => 'Black',
                'stock_quantity' => 15,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Logitech G Pro X',
                'description' => 'Professional esports keyboard with hot-swappable switches.',
                'price' => 149.99,
                'brand' => 'Logitech',
                'switch_type' => 'GX Blue Clicky',
                'layout' => 'TKL',
                'connectivity' => 'Wired',
                'rgb_lighting' => true,
                'color' => 'Black',
                'stock_quantity' => 20,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Razer BlackWidow V3',
                'description' => 'Mechanical gaming keyboard with Razer Green switches and Chroma RGB.',
                'price' => 139.99,
                'brand' => 'Razer',
                'switch_type' => 'Razer Green',
                'layout' => 'Full Size',
                'connectivity' => 'Wired',
                'rgb_lighting' => true,
                'color' => 'Black',
                'stock_quantity' => 18,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'SteelSeries Apex Pro',
                'description' => 'Adjustable mechanical switches with OLED smart display.',
                'price' => 199.99,
                'brand' => 'SteelSeries',
                'switch_type' => 'OmniPoint Adjustable',
                'layout' => 'Full Size',
                'connectivity' => 'Wired',
                'rgb_lighting' => true,
                'color' => 'Black',
                'stock_quantity' => 12,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Keychron K2 V2',
                'description' => 'Compact wireless mechanical keyboard for Mac and PC.',
                'price' => 89.99,
                'brand' => 'Keychron',
                'switch_type' => 'Gateron Blue',
                'layout' => '75%',
                'connectivity' => 'Wireless',
                'rgb_lighting' => true,
                'color' => 'Space Gray',
                'stock_quantity' => 25,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'HyperX Alloy FPS Pro',
                'description' => 'Compact mechanical gaming keyboard with Cherry MX switches.',
                'price' => 79.99,
                'brand' => 'HyperX',
                'switch_type' => 'Cherry MX Red',
                'layout' => 'TKL',
                'connectivity' => 'Wired',
                'rgb_lighting' => false,
                'color' => 'Black',
                'stock_quantity' => 30,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'ASUS ROG Strix Scope',
                'description' => 'Gaming keyboard with Cherry MX switches and Aura Sync RGB.',
                'price' => 119.99,
                'brand' => 'ASUS',
                'switch_type' => 'Cherry MX Red',
                'layout' => 'Full Size',
                'connectivity' => 'Wired',
                'rgb_lighting' => true,
                'color' => 'Black',
                'stock_quantity' => 22,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Ducky One 3 Mini',
                'description' => 'Compact 60% mechanical keyboard with premium build quality.',
                'price' => 109.99,
                'brand' => 'Ducky',
                'switch_type' => 'Cherry MX Brown',
                'layout' => '60%',
                'connectivity' => 'Wired',
                'rgb_lighting' => true,
                'color' => 'White',
                'stock_quantity' => 16,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($keyboards as $keyboard) {
            Keyboard::create($keyboard);
        }
    }
}