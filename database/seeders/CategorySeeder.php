<?php

namespace Database\Seeders;

use App\Core\Models\Database\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(10)->create();
    }
}
