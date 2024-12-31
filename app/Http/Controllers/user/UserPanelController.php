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
    public function index(){
        $categories = Category::all();
        return view('users.home',compact('categories'));
    }

    public function showQuestions($categoryId){
        // Eager load answers with questions to avoid N+1 query problems
        $questions = Question::with('answers')->where('category_id', $categoryId)->get();
        // dd($questions);
        $category = Category::where('id',$categoryId)->first();
        return view('users.questions',compact('questions','category'));
    }

    public function storeAnswers(Request $request, $categoryId)
    {
        // dd($request->all());
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

        // Calculate the score and display it to the user
        $totalQuestions = count($request->input('question'));
        $score = ($totalCorrect / $totalQuestions) * 100;

        // save analytics
        UserQuizAnalytics::create([
            'user_id'=> $user->id,
            'category_id'=> $categoryId,
            'total_questions'=> $totalQuestions,
            'correct_answers'=> $totalCorrect,
            'score'=> $score
        ]);

        return redirect()->route('users.panel.quiz')->with('score', $score);
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
    // public function removeProfilePicture()
    // {
    //     $user = auth()->user();

    //     // Check if the user has a profile picture
    //     if ($user->profile_picture) {
    //         // Delete the image from storage
    //         Storage::delete('public/' . $user->profile_picture);

    //         // Remove the profile picture from the user record
    //         $user->profile_picture = null;
    //         $user->save();

    //         // Return a success message
    //         return redirect()->route('users.panel.profile.edit')->with('success', 'Profile picture removed successfully!');
    //     }

    //     return redirect()->route('users.panel.profile.edit')->with('error', 'No profile picture found.');
    // }


}
