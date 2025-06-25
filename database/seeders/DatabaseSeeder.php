<?php

namespace Database\Seeders;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //   $this->call(UserSeeder::class);
    //     $this->call(EmployeeSeeder::class);
    //       $this->call(SellerSeeder::class);
    //       $this->call(OrderSeeder::class);
    $this->call(LaratrustSeeder::class);
    }
}
