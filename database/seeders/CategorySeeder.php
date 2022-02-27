<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    

    protected  $categories = [
        [
          'category' => 'Travel',
          'slug'     => 'travel',
        ],
        [
            'category' => 'Style',
            'slug'     => 'style',
        ],
        [
            'category' => 'City',
            'slug'     => 'city',
        ],
        [
            'category' => 'Education',
            'slug'     => 'education',
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
                Category::create($category);
         }
    }
}
