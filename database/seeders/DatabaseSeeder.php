<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Nathalie Admin',
            'email' => 'admin@nathaliesbakeshop.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $categories = [
            [
                'name' => 'Empanadas',
                'slug' => 'empanadas',
                'description' => 'Golden, flaky hand pies filled with savory Filipino favorites.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Ube & Buko Pies',
                'slug' => 'ube-buko-pies',
                'description' => 'Creamy custard pies with classic Filipino flavors.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Cakes',
                'slug' => 'cakes',
                'description' => 'Celebration cakes and custom creations for every occasion.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Kakanin & Pastries',
                'slug' => 'kakanin-pastries',
                'description' => 'Traditional Filipino rice cakes and buttery pastries.',
                'sort_order' => 4,
            ],
        ];

        $categoryIds = [];
        foreach ($categories as $category) {
            $categoryIds[$category['slug']] = Category::create($category)->id;
        }

        $products = [
            [
                'category_id' => $categoryIds['empanadas'],
                'name' => 'Beef Empanada',
                'slug' => 'beef-empanada',
                'description' => 'Buttery pastry pockets filled with seasoned ground beef, potatoes, and raisins — a Filipino party staple baked until golden.',
                'price' => 4.50,
                'variants' => null,
                'image_url' => '/images/seed/beef-empanada.jpg',
                'image_alt' => 'Golden baked beef empanada on a wooden board',
                'is_featured' => true,
            ],
            [
                'category_id' => $categoryIds['empanadas'],
                'name' => 'Chicken Empanada',
                'slug' => 'chicken-empanada',
                'description' => 'Flaky empanada filled with tender shredded chicken, vegetables, and a hint of sweetness in every bite.',
                'price' => 4.25,
                'variants' => null,
                'image_url' => '/images/seed/chicken-empanada.jpg',
                'image_alt' => 'Freshly baked chicken empanadas',
                'is_featured' => true,
            ],
            [
                'category_id' => $categoryIds['ube-buko-pies'],
                'name' => 'Custard Ube Buko Pie',
                'slug' => 'custard-ube-buko-pie',
                'description' => 'Our signature pie — silky ube custard layered with young coconut strips in a buttery shortcrust shell.',
                'price' => 28.00,
                'variants' => ['Whole 9"', 'Slice'],
                'image_url' => '/images/seed/ube-buko-pie.jpg',
                'image_alt' => 'Purple ube dessert pie with whipped topping',
                'is_featured' => true,
            ],
            [
                'category_id' => $categoryIds['ube-buko-pies'],
                'name' => 'Classic Buko Pie',
                'slug' => 'classic-buko-pie',
                'description' => 'Laguna-style coconut pie with creamy custard and tender buko meat — a taste of home.',
                'price' => 26.00,
                'variants' => ['Whole 9"', 'Slice'],
                'image_url' => '/images/seed/buko-pie.jpg',
                'image_alt' => 'Coconut cream pie with toasted coconut',
                'is_featured' => false,
            ],
            [
                'category_id' => $categoryIds['ube-buko-pies'],
                'name' => 'Mango Buko Pie',
                'slug' => 'mango-buko-pie',
                'description' => 'Tropical twist on a classic — ripe mango and young coconut in a luscious custard filling.',
                'price' => 29.00,
                'variants' => ['Whole 9"', 'Slice'],
                'image_url' => '/images/seed/mango-buko-pie.jpg',
                'image_alt' => 'Fruit tart with mango slices',
                'is_featured' => false,
            ],
            [
                'category_id' => $categoryIds['cakes'],
                'name' => 'Custom Celebration Cake',
                'slug' => 'custom-celebration-cake',
                'description' => 'Fully customized cakes for birthdays, weddings, debuts, and corporate events. Share your vision and we will bring it to life.',
                'price' => 0,
                'variants' => null,
                'image_url' => '/images/seed/custom-cake.jpg',
                'image_alt' => 'Elegant tiered celebration cake with floral decorations',
                'is_featured' => true,
                'is_inquiry_only' => true,
            ],
            [
                'category_id' => $categoryIds['cakes'],
                'name' => 'Ube Chiffon Cake',
                'slug' => 'ube-chiffon-cake',
                'description' => 'Light, airy chiffon infused with ube halaya and finished with whipped cream and cheese.',
                'price' => 45.00,
                'variants' => ['6 inch', '8 inch', '10 inch'],
                'image_url' => '/images/seed/ube-chiffon.jpg',
                'image_alt' => 'Purple layered chiffon cake',
                'is_featured' => true,
            ],
            [
                'category_id' => $categoryIds['kakanin-pastries'],
                'name' => 'Bibingka',
                'slug' => 'bibingka',
                'description' => 'Traditional rice cake baked in banana leaves, topped with salted egg and cheese.',
                'price' => 5.50,
                'variants' => null,
                'image_url' => '/images/seed/bibingka.jpg',
                'image_alt' => 'Filipino rice cake on banana leaf',
                'is_featured' => false,
            ],
            [
                'category_id' => $categoryIds['kakanin-pastries'],
                'name' => 'Ensaymada',
                'slug' => 'ensaymada',
                'description' => 'Soft, buttery brioche-style bread topped with buttercream, sugar, and grated cheese.',
                'price' => 3.75,
                'variants' => null,
                'image_url' => '/images/seed/ensaymada.jpg',
                'image_alt' => 'Fresh baked sweet bread rolls',
                'is_featured' => false,
            ],
            [
                'category_id' => $categoryIds['kakanin-pastries'],
                'name' => 'Leche Flan Cup',
                'slug' => 'leche-flan-cup',
                'description' => 'Silky caramel custard made with egg yolks and condensed milk — individually portioned.',
                'price' => 4.00,
                'variants' => null,
                'image_url' => '/images/seed/leche-flan.jpg',
                'image_alt' => 'Caramel custard dessert in a cup',
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
