<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public $numberOfQuestions = 50 ;
    public $numberOfResults = 20 ;
    public $numberOfSelectedQuestions = 10 ;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         for the questions database
//        for ( $i = 0 ; $i < $this->numberOfQuestions ; $i++)
//            DB::table('questions' )->insert([
//                'question' =>  "This is a test question number " . ($i+1) ,
//                'option1' => $this->createOption() ,
//                'option2' => $this->createOption(),
//                'option3' => $this->createOption(),
//                'option4' => $this->createOption(),
//                'imagePath' => '' ,
//                'answer' => rand(1,4) ,
//                'dif' => rand(1,3) ,
//            ]);

//         for the results database
//        for ( $i = 0 ; $i < $this->numberOfResults ; $i++)
//            DB::table('results' )->insert([
//                'first_student_name' => str_random(rand(3,8)) ,
//                'first_student_id' => rand(430000000 , 438000000) ,
//                'first_student_points' => rand(20,200),
//                'second_student_name' => str_random(rand(3,8)) ,
//                'second_student_id' => rand(430000000 , 438000000) ,
//                'second_student_points' => rand(20,200),
//                'winner' => rand(1,2),
//            ]);

        DB::table('running_games')->insert([
            'user_1_ready' => '0' ,
            'user_2_ready' => '0' ,
            'user_1_name' => 'null' ,
            'user_2_name'=> 'null' ,
            'user_1_points' => '0' ,
            'user_2_points' => '0' ,
            'user_1_answer' => '0' ,
            'user_2_answer' => '0' ,
            'user_1_id' => ' ' ,
            'user_2_id' => ' ' ,
            'question_id' => '1' ,
        ]);

        for ( $i = 0 ; $i < $this->numberOfSelectedQuestions ; $i++)
            DB::table('selected_questions' )->insert([
                'question_id' => 0 ,
            ]);
    }

    private function createQuestion() {
        $question = "" ;

        for ( $i = 0 ; $i < 10 ; $i++)
            $question = $question . str_random(rand(2,10)) . " " ;

        return $question ;
    }

    private function createOption () {
        $question = "" ;

        for ( $i = 0 ; $i < 3 ; $i++)
            $question = $question . str_random(rand(2,10)) . " " ;

        return $question ;
    }
}



