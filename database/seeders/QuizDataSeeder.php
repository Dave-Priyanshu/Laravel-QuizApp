<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class QuizDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Fetch data from API
        $response = Http::get('https://opentdb.com/api.php?amount=20&type=multiple');
        $quizData = $response->json()['results'];

        foreach ($quizData as $quiz) {
            // Check if category already exists or create it
            $category = Category::firstOrCreate(['name' => $quiz['category']]);

            // Check if question already exists in the category
            $existingQuestion = Question::where('category_id', $category->id)
                ->where('question_text', $quiz['question'])
                ->first();

            if (!$existingQuestion) {
                // Add question if it doesn't exist
                $question = Question::create([
                    'category_id' => $category->id,
                    'question_text' => $quiz['question'],
                    'question_type' => $quiz['type'] === 'boolean' ? 'true_false' : 'multiple_choice',
                ]);

                // Add answers
                $answers = array_merge(
                    [['answer_text' => $quiz['correct_answer'], 'is_correct' => true]],
                    array_map(fn($answer) => ['answer_text' => $answer, 'is_correct' => false], $quiz['incorrect_answers'])
                );

                foreach ($answers as $index => $answer) {
                    Answer::create([
                        'question_id' => $question->id,
                        'answer_text' => $answer['answer_text'],
                        'is_correct' => $answer['is_correct'],
                        'order' => $index + 1,
                    ]);
                }
            }
        }
    }
}
