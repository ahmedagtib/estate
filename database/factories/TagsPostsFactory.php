<?php

namespace Database\Factories;

use App\Models\TagsPosts;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\Tag;
class TagsPostsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TagsPosts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $post = Post::inRandomOrder()->first();
        $tag  = Tag::inRandomOrder()->first();
        return [
            'tag_id'  => $tag->id,
            'post_id' => $post->id
        ];
    }
}
