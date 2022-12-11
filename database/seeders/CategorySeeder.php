<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /// proses mengosongkan database
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        // membuat seeder
        $genre = [
            'action',
            'adventure',
            'psychological',
            'drama',
            'fantasy',
            'magic',
            'comedy',
            'slice of life',
            'horror',
            'romance',
        ];

        // memasukkan $data ke database Categories
        foreach ($genre as $value) {
            Category::insert([
                'name' => $value
            ]);
        }
    }
}
