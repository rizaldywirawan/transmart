<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AuctionAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'file_name' => 'Photo barang',
            'file_path' => 'Photo barang',
            'extension' => 'png',
        ];
    }
}
