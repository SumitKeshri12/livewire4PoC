<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            'Wireless Noise-Canceling Headphones',
            'Mechanical Gaming Keyboard',
            '4K Ultra HD Monitor',
            'Smart Fitness Products',
            'Portable Bluetooth Speaker',
            'Ergonomic Office Chair',
            'USB-C Docking Station',
            'Smartphone Gimbal Stabilizer',
            'Fast Charging Power Bank',
            'Noise-Isolating Earbuds',
            'Smart Home Security Camera',
            'RGB Gaming Configuration',
            'Laptop Cooling Pad',
            'External SSD 1TB',
            'Wireless Charging Pad',
            'Graphics Tablet for Artists',
            'Compact Mirrorless Camera',
            'Smart Thermostat',
            'Mesh Wi-Fi System',
            'Gaming Headset with Mic',
        ];

        return [
            'name' => fake()->randomElement($products),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 29, 999),
            'stock' => fake()->numberBetween(0, 100),
            'is_featured' => fake()->boolean(20), // 20% chance of being featured
        ];
    }
}
