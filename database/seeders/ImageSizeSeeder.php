<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ImageSize;


class ImageSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      ImageSize::create([
        'id' => 1,
        'name' => 'preview',
      ]);

      ImageSize::create([
        'id' => 2,
        'name' => 'full',
      ]);
    }
}
