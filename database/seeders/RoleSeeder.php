<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // proses mengosongkan database
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        // membuat seeder
        $data = ['admin', 'client'];

        // memasukkan $data ke database Role
        foreach ($data as $value) {
            Role::insert([
                'name' => $value
            ]);
        }
    }
}
