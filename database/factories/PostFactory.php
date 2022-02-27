<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\Models\Category;


class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $title = $this->faker->sentence(6);
        $slug  = Str::slug($title,'-');
        $image = $this->faker->imageUrl(900,300,$title,true);

        if($image) {
            $filename =   time() . '-' .Str::slug($title, '-').'.jpg';
            $path = '/images/blogs/'.$filename;
            Image::make($image)->resize(500,500)->save(public_path().$path);
        }
        $category = Category::inRandomOrder()->first();
        return [
            'title'   =>  $title,
            'slug'    =>  $slug,
            'excerpt' =>  $this->faker->paragraph(),
            'photo'   =>  $path,
            'content' =>  $this->faker->paragraph(2),
            'meta_title' => $this->faker->sentence(6),
            'meta_description' =>  $this->faker->paragraph(),
            'meta_keyword'    => 'aaaa,zzzzzz,wwwwww',
            'statue'  => 'publiched',
            'category_id' => $category->id

        ];
    }
}
