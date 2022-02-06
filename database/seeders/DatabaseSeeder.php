<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('movies');
        Storage::makeDirectory('movies');
        // \App\Models\User::factory(20)->create();
        // $this->call(MovieSeeder::class);

        for ($i = 0; $i < 50; $i++) {
            $user = \App\Models\User::factory()->create();
            $movie = \App\Models\Movie::factory()->create();
           
            DB::table('movie_user')->insert([
                'userId' => $user->id,
                'movieId' => $movie->id
            ]);
        }
    
    }
}
