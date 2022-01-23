<?php

namespace Database\Seeders;

use App\Models\Auction;
use Database\Factories\AuctionFactory;
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
        $this->call([
            UserSeeder::class,
            AuctionSeeder::class,
        ]);
    }
}
