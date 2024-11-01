<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title'=>'4 in Barnabue',
            'description'=>'lewa 2, rapha 2, lamine 1',
            'user_id'=>1
        ]);
    }
}
