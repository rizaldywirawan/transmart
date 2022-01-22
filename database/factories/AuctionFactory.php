<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

use function PHPSTORM_META\map;

class AuctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id'  => $this->faker->uuid(),
            'name' => 'Lelang Barang Dengan Judul yang Panjang',
            'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni optio ab odit vitae earum suscipit veritatis voluptatibus, officia exercitationem dignissimos labore mollitia molestiae aut iusto corrupti, illum possimus dolor incidunt.",
            'started_at' => now()->addHours(3),
            'ended_at' => now()->addhours(4),
            'start_price' => '1000000',
            'bid_increment' => '50000',
            'live_time' => 900
        ];
    }
}
