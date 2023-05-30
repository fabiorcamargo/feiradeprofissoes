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
            ['name' => 'Pré Militar',
            'slug' => 'premilitar'
            ],
            ['name' => 'Bancário',
            'slug' => 'aprendizbancario'
            ],
            ['name' => 'ENCCEJA',
            'slug' => 'encceja'
            ],
            ['name' => 'CPA10',
            'slug' => 'cpa10'
            ]
        ]);
    }
}
