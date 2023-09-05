<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserImage;

class UserImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserImage::truncate();

        $user_images = [
            [
                'name' => 'avatar1.png',
            ],
            [
                'name' => 'avatar2.png',
            ],
            [
                'name' => 'avatar3.png',
            ],
            [
                'name' => 'avatar4.png',
            ],
        ];

        foreach ($user_images as $key => $user_image) {
            UserImage::create([
                'name' => $user_image['name']
            ]);
        }
    }
}
