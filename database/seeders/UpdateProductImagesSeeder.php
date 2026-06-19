<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class UpdateProductImagesSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            'beef-empanada' => '/images/seed/beef-empanada.jpg',
            'chicken-empanada' => '/images/seed/chicken-empanada.jpg',
            'custard-ube-buko-pie' => '/images/seed/ube-buko-pie.jpg',
            'classic-buko-pie' => '/images/seed/buko-pie.jpg',
            'mango-buko-pie' => '/images/seed/mango-buko-pie.jpg',
            'custom-celebration-cake' => '/images/seed/custom-cake.jpg',
            'ube-chiffon-cake' => '/images/seed/ube-chiffon.jpg',
            'bibingka' => '/images/seed/bibingka.jpg',
            'ensaymada' => '/images/seed/ensaymada.jpg',
            'leche-flan-cup' => '/images/seed/leche-flan.jpg',
        ];

        foreach ($images as $slug => $url) {
            Product::where('slug', $slug)->update(['image_url' => $url]);
        }
    }
}
