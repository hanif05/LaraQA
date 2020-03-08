<?php

use App\Answer;
use Illuminate\Database\Seeder;
use App\User;
use App\Question;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersQuestionsAnswers::class,
            FavoritesTableSeeder::class,
            VotablesTableSeeder::class,
        ]);
    }
}
