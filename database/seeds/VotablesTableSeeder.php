<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;

class VotablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('votables')->where('votable_type', 'App\Question')->delete();

        $users = User::all();

        $numberUser = $users->count();

        $votes = [-1, 1];

        $questions = Question::all();

        foreach ($questions as $key => $value) {
            for ($i=0; $i < rand(1, $numberUser) ; $i++) { 
                $user = $users[$i];
                $user->voteQuestion($value, $votes[rand(0, 1)]);
            }
        }
    }
}
