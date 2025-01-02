<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\UserQuizAnalytics;

class QuizController extends Controller
{
    public function showQuestions($type)
    {
        if ($type === 'multiple_choice') {
            $questions = Question::with('answers')
                ->where('question_type', 'multiple_choice')
                ->inRandomOrder()
                ->limit(15)
                ->get();

            if ($questions->isEmpty()) {
                $message = 'No multiple-choice questions available at the moment.';
                return view('users.quiz', compact('questions', 'message'));
            }

            return view('users.quiz', compact('questions'));
        }

        abort(404); // Invalid question type
    }
    public function storeQuizAnswers(Request $request)
    {
        $user = auth()->user();
        $answeredQuestions = $request->input('answers', []); // Default to an empty array if no answers are provided
        $totalCorrect = 0;

        if (empty($answeredQuestions)) {
            // Flash message if no answers were provided
            session()->flash('message', 'No answers were submitted. Please try again.');
            return redirect()->route('users.panel.quiz');
        }

        // Process each answer
        foreach ($answeredQuestions as $questionId => $answerId) {
            $answer = Answer::where('id', $answerId)->where('question_id', $questionId)->first();

            if ($answer) {
                // Store the user's answer in the database
                UserAnswer::create([
                    'user_id' => $user->id,
                    'question_id' => $questionId,
                    'answer_id' => $answerId,
                ]);

                // Check if the answer is correct
                if ($answer->is_correct) {
                    $totalCorrect++;
                }
            }
        }

        // Calculate the total number of questions and score
        $totalQuestions = Question::whereIn('id', array_keys($answeredQuestions))->count(); // Ensure only relevant questions are counted
        $score = ($totalQuestions > 0) ? ($totalCorrect / $totalQuestions) * 100 : 0;

        // Save analytics for the quiz
        UserQuizAnalytics::create([
            'user_id' => $user->id,
            'category_id' => null, // Add category_id if applicable
            'total_questions' => $totalQuestions,
            'correct_answers' => $totalCorrect,
            'score' => $score,
        ]);

        // Flash session data for the UI
        session()->flash('score', $score);
        session()->flash('message', 'Your quiz has been submitted!');
        session()->flash('totalQuestions', $totalQuestions);
        session()->flash('correctAnswers', $totalCorrect);

        return redirect()->route('users.panel.quiz');
    }



}
