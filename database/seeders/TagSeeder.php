<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
class TagSeeder extends Seeder
{

    protected  $tags = [
        [
          'tag'      => 'tag1',
          'slug'     => 'tag1',
        ],
        [
            'tag'      => 'tag2',
            'slug'     => 'tag2',
        ],
        [
            'tag'      => 'tag3',
            'slug'     => 'tag3',
        ],
        [
            'tag'      => 'tag4',
            'slug'     => 'tag4',
        ],
        [
            'tag'      => 'tag5',
            'slug'     => 'tag5',
        ],
        [
            'tag'      => 'tag6',
            'slug'     => 'tag6',
        ],
        [
            'tag'      => 'tag7',
            'slug'     => 'tag7',
        ],
        [
            'tag'      => 'tag8',
            'slug'     => 'tag8',
        ],
        [
            'tag'      => 'tag9',
            'slug'     => 'tag9',
        ],
        [
            'tag'      => 'tag10',
            'slug'     => 'tag10',
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->tags as $tag) {
            Tag::create($tag);
     }
    }
}
