<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public $numberOfRecords = 50 ;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ( $i = 0 ; $i < $this->numberOfRecords ; $i++)
            DB::table('questions' )->insert([
                'question' =>  $this->createQuestion() ,
                'option1' => $this->createOption() ,
                'option2' => $this->createOption(),
                'option3' => $this->createOption(),
                'option4' => $this->createOption(),
                'imagePath' => '' ,
                'answer' => rand(1,4) ,
                'dif' => rand(1,3) ,
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



