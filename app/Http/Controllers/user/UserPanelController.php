<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use App\Models\UserAnswer;
use App\Models\UserQuizAnalytics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function Ramsey\Uuid\v1;

class UserPanelController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('question_type')) {
            $type = $request->input('question_type');
            if ($type === 'multiple_choice') {
                $query->whereHas('questions', function ($q) {
                    $q->where('question_type', 'multiple_choice');
                });
            } elseif ($type === 'true_false') {
                $query->whereHas('questions', function ($q) {
                    $q->where('question_type', 'true_false');
                });
            }
        }

        $categories = $query->paginate(9);

        return view('users.home', compact('categories'));
    }


    public function showQuestions($categoryId){
        // Eager load answers with questions to avoid N+1 query problems
        $questions = Question::with('answers')->where('category_id', $categoryId)->paginate(5);
        // dd($questions);
        $category = Category::where('id',$categoryId)->first();
        return view('users.questions',compact('questions','category'));
    }

    public function storeAnswers(Request $request, $categoryId)
    {
        $user = auth()->user();
        $totalCorrect = 0;

        // Loop through all the questions and store the user's answers
        foreach ($request->input('question') as $questionId => $answerId) {
            // Fetch the answer and ensure it belongs to the correct question
            $answer = Answer::where('id', $answerId)
                            ->where('question_id', $questionId)
                            ->first();

            if ($answer) {
                // Store the user's answer in the database
                UserAnswer::create([
                    'user_id' => $user->id,
                    'question_id' => $questionId,
                    'answer_id' => $answerId,
                ]);

                // Check if the user's answer is correct
                if ($answer->is_correct) {
                    $totalCorrect++;
                }
            }
        }

        // Calculate the score
        $totalQuestions = count($request->input('question'));
        $score = ($totalCorrect / $totalQuestions) * 100;

        // Save analytics
        UserQuizAnalytics::create([
            'user_id'=> $user->id,
            'category_id'=> $categoryId,
            'total_questions'=> $totalQuestions,
            'correct_answers'=> $totalCorrect,
            'score'=> $score
        ]);

        // Flash the score and the additional details to the session
        session()->flash('score', $score);
        session()->flash('message', 'Your quiz has been submitted!');
        session()->flash('totalQuestions', $totalQuestions);
        session()->flash('correctAnswers', $totalCorrect);

        return redirect()->route('users.panel.quiz');
    }


    public function analytics()
    {
        $user = auth()->user();
        $analytics = UserQuizAnalytics::with('category')
                        ->where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('users.analytics', compact('analytics'));
    }

    public function editProfile(){
        $user = auth()->user();
        return view('users.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'nullable|string|max:500',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicture;
        }

        // Update user information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;

        // Update password if provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.panel.profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function timedQuiz()
    {
        $questions = Question::inRandomOrder()->limit(10)->get();
        return view('users.timed_quiz', compact('questions'));
    }

    // quiz submission
    public function storeTimedAnswers(Request $request){
        $user = auth()->user();
        $totalCorrect = 0;

        // loop through the questions and store user answersss
        foreach($request->input('questions') as $questionId => $answerId){
            $answer = Answer::where('id',$answerId)->where('question_id', $questionId)->first();

            if($answer){
                // store ans in db
                UserAnswer::create([
                    'user_id'=>$user->id,
                    'question_id'=>$questionId,
                    'answer_id'=>$answerId,
                ]);

                // check if the answer is right
                if($answer->is_correct){
                    $totalCorrect++;
                }
            }

        }
        $totalQuestions = count($request->input('questions'));
        $score = ($totalCorrect/$totalQuestions)*100;

        // Save analytics for the timed quiz
        UserQuizAnalytics::create([
            'user_id' => $user->id,
            'category_id' => null, // You can adjust if you have categories for timed questions
            'total_questions' => $totalQuestions,
            'correct_answers' => $totalCorrect,
            'score' => $score,
       ]);
       
       session()->flash('score', $score);
       session()->flash('message', 'Your timed quiz has been submitted!');
       session()->flash('totalQuestions', $totalQuestions);
       session()->flash('correctAnswers', $totalCorrect);
   
       return redirect()->route('users.panel.quiz');
    }

    
}
