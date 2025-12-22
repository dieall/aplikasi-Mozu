<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin MOZU',
            'email' => 'admin@mozu.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        // Create Sample Customer
        User::create([
            'name' => 'Customer Demo',
            'email' => 'customer@mozu.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '081234567891',
        ]);

        // Create Products
        Product::create([
            'name' => 'Jasuke Mozarella Original',
            'description' => 'Jagung manis kukus dengan susu kental manis dan keju mozzarella yang lumer. Perpaduan sempurna antara manis dan gurih!',
            'price' => 12000,
            'stock' => 50,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Jasuke Mozarella Spesial',
            'description' => 'Jasuke dengan extra keju mozzarella dan topping sosis. Lebih lengkap dan mengenyangkan!',
            'price' => 15000,
            'stock' => 40,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Jasuke Mozarella Coklat',
            'description' => 'Inovasi rasa manis! Jagung manis dengan meses coklat dan keju mozzarella. Cocok untuk yang suka manis.',
            'price' => 13000,
            'stock' => 30,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Jasuke Mozarella Pedas',
            'description' => 'Untuk pecinta pedas! Jasuke dengan keju mozzarella dan saus pedas level 1-5. Dijamin nagih!',
            'price' => 14000,
            'stock' => 35,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Jasuke Mozarella Jumbo',
            'description' => 'Porsi jumbo untuk yang lapar! Double jagung, double keju, double kenikmatan!',
            'price' => 20000,
            'stock' => 20,
            'is_available' => true,
        ]);
    }
}
