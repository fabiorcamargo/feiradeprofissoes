<?php

namespace Database\Seeders;

use App\Models\PageType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PageType::insert([
            ['name' => 'Pré Militar'],
            ['name' => 'Bancário'],
            ['name' => 'ENCCEJA'],
            ['name' => 'CPA10']
        ]);
    }
}
