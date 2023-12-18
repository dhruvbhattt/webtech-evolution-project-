<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subCategories = [
            'Townhouse',
            'Condo',
            'Flat',
            'Rowhouse',
            'Villa'
        ];

        foreach ($subCategories as $subCategory) {
            SubCategory::create([
                'name' => $subCategory,
                'category_id' => Category::all()->random()->id
            ]);
        }
    }
}
