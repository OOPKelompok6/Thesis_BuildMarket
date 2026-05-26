<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement("SET sql_mode='NO_AUTO_VALUE_ON_ZERO'");

        Brand::factory(15)->create();
        Category::factory(5)->create();
        User::factory(100)->create();
        User::factory()->create([
            'firstName' => 'admin',
            'lastName' => 'admin',
            'email' => 'akun_admin@gmail.com',
            'role' => 'Admin',
            'password' => env('ADMIN_PASSWORD') 
        ]);
        Item::factory(200)->create(['brand_id' => 1, 'user_id' => 1, 'category_id' => 1]);
        Payment::factory(150)->create(['user_id' => 1]);

        Payment::factory()->create([
            'id' => 0,
            'user_id' => 0,
            'vendor' => 'Midtrans',
            'expiration_Date' => fake()->creditCardExpirationDate(),
            'cardNumber' => fake()->numberBetween(1000000000000000, 9999999999999999),
            'billingAddress' => fake()->address()
        ]);

        $sellers_id = User::where('role', 'Seller')->pluck('id');
        $brand_id = Brand::pluck('id');
        $category_id = Category::pluck('id');
        $items = Item::all(); 

        foreach($items as $item) {
            $item->user_id = fake()->randomElement($sellers_id);
            $item->brand_id = fake()->randomElement($brand_id);
            $item->category_id = fake()->randomElement($category_id);
            $item->save();
        }

        $user_id = User::where('role', 'Seller')->orWhere('role', 'User')->pluck('id');
        $payments = Payment::all();
        foreach($payments as $payment) {
            $payment->user_id = fake()->randomElement($user_id);
            $payment->save();
        }
    }
}
