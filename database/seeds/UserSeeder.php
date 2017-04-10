<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Tô Minh Phong 1',
                'email' => 'bakhiaquelua@gmail.com',
                'password' => bcrypt('123456'),
                'avatar' => 'avatars/avatar.jpg',
                'photo_cover' => 'photo_covers/photo_cover.jpg',
            ],
            [
                'name' => 'Tô Minh Phong 2',
                'email' => 'phongtm@gmail.com',
                'password' => bcrypt('123456'),
                'avatar' => 'avatars/avatar.jpg',
                'photo_cover' => 'photo_covers/photo_cover.jpg',
            ],
            [
                'name' => 'Tô Minh Phong 3',
                'email' => 'to.minh.phongframgia@gmail.com',
                'password' => bcrypt('123456'),
                'avatar' => 'avatars/avatar.jpg',
                'photo_cover' => 'photo_covers/photo_cover.jpg',
            ],
            [
                'name' => 'Tô Minh Phong 4',
                'email' => 'to.minh.phong@gmail.com',
                'password' => bcrypt('123456'),
                'avatar' => 'avatars/avatar.jpg',
                'photo_cover' => 'photo_covers/photo_cover.jpg',
            ],
            [
                'name' => 'Tô Minh Phong 5',
                'email' => 'to.minh.phong@framgia.com',
                'password' => bcrypt('123456'),
                'avatar' => 'avatars/avatar.jpg',
                'photo_cover' => 'photo_covers/photo_cover.jpg',
            ],
            [
                'name' => 'Tô Minh Phong 6',
                'email' => 'bakhiaquelua2@gmail.com',
                'password' => bcrypt('123456'),
                'avatar' => 'avatars/avatar.jpg',
                'photo_cover' => 'photo_covers/photo_cover.jpg',
            ],
            [
                'name' => 'Tô Minh Phong 7',
                'email' => 'phongtm2@gmail.com',
                'password' => bcrypt('123456'),
                'avatar' => 'avatars/avatar.jpg',
                'photo_cover' => 'photo_covers/photo_cover.jpg',
            ],
            [
                'name' => 'Tô Minh Phong 8',
                'email' => 'to.minh.phongframgia2@gmail.com',
                'password' => bcrypt('123456'),
                'avatar' => 'avatars/avatar.jpg',
                'photo_cover' => 'photo_covers/photo_cover.jpg',
            ],
            [
                'name' => 'Tô Minh Phong 9',
                'email' => 'to.minh.phong2@gmail.com',
                'password' => bcrypt('123456'),
                'avatar' => 'avatars/avatar.jpg',
                'photo_cover' => 'photo_covers/photo_cover.jpg',
            ],
            [
                'name' => 'Tô Minh Phong 10',
                'email' => 'to.minh.phong2@framgia.com',
                'password' => bcrypt('123456'),
                'avatar' => 'avatars/avatar.jpg',
                'photo_cover' => 'photo_covers/photo_cover.jpg',
            ]
        ]);
    }
}
