<?php

use Illuminate\Database\Seeder;
use App\User;
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
