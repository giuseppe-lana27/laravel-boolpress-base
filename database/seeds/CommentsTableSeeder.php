<?php

use Illuminate\Database\Seeder;
use App\Comment;
use App\Post;
use Faker\Generator as Faker;


class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // seleziono solo i post che sono pubblicati
        $posts = Post::where('published', 1)->get();
        // ciclo i post
        foreach($posts as $post){
            // eseguo un ciclo per creare i commenti ai post
            for( $i = 0; $i < rand(0, 3); $i++){
                $newComment = new Comment();
                $newComment->post_id = $post->id;
                $newComment->name = $faker->name();
                $newComment->content = $faker->text();
                $newComment->save();
            }
        }

    }
}
