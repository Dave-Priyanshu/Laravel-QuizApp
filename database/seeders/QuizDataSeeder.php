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
        $response = Http::get('https://opentdb.com/api.php?amount=50&type=multiple');
        $quizData = $response->json()['results'];

        foreach ($quizData as $quiz) {
            // Decode the question and category names to handle HTML entities
            $decodedCategoryName = html_entity_decode($quiz['category']);
            $decodedQuestionText = html_entity_decode($quiz['question']);
            $decodedCorrectAnswer = html_entity_decode($quiz['correct_answer']);
            $decodedIncorrectAnswers = array_map('html_entity_decode', $quiz['incorrect_answers']);

            // Check if category already exists or create it
            $category = Category::firstOrCreate(['name' => $decodedCategoryName]);

            // Check if question already exists in the category
            $existingQuestion = Question::where('category_id', $category->id)
                ->where('question_text', $decodedQuestionText)
                ->first();

            if (!$existingQuestion) {
                // Add question if it doesn't exist
                $question = Question::create([
                    'category_id' => $category->id,
                    'question_text' => $decodedQuestionText,
                    'question_type' => $quiz['type'] === 'boolean' ? 'true_false' : 'multiple_choice',
                ]);

                // Prepare answers
                $answers = array_merge(
                    [['answer_text' => $decodedCorrectAnswer, 'is_correct' => true]],
                    array_map(fn($answer) => ['answer_text' => $answer, 'is_correct' => false], $decodedIncorrectAnswers)
                );

                // Shuffle answers
                shuffle($answers);

                // Save answers to the database
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
// php artisan db:seed --class=QuizDataSeeder