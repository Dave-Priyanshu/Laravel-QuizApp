<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // Display a list of questions
    public function index()
    {
        $questions = Question::with('category')->paginate(12); // Get questions with their related category
        return view('admin.questions.index', compact('questions'));
    }

    // Show the form to create a new question
    public function create()
    {
        $categories = Category::all(); // Fetch all categories to display in the dropdown
        return view('admin.questions.create', compact('categories'));
    }

    // Store a new question and its answers
    public function store(Request $request)
    {
        // dd($request->all());
        $validated  = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question_text' => 'required|string',
            'question_type' => 'required|string|in:multiple_choice,true_false',
            'correct_answer' => 'required_if:question_type,true_false|in:true,false',
            'answers.*.answer_text' => 'required_if:question_type,multiple_choice|string',
            'answers.*.is_correct' => 'nullable|in:on',
            ]);
            
        
        // Normalize 'is_correct' field
        $answers = array_map(function ($answer) {
            $answer['is_correct'] = isset($answer['is_correct']) && $answer['is_correct'] === 'on' ? 1 : 0;
            return $answer;
        }, $request->input('answers', []));

        // Create the question
        $question = Question::create([
            'category_id' => $validated['category_id'],
            'question_text' => $validated['question_text'],
            'question_type' => $validated['question_type'],
        ]);
            
        
            // Save the answers based on the question type
        if ($validated['question_type'] === 'multiple_choice') {
            foreach ($answers as $answer) {
                $question->answers()->create([
                    'answer_text' => $answer['answer_text'],
                    'is_correct' => $answer['is_correct'],
                ]);
            }
        } elseif ($validated['question_type'] === 'true_false') {
            $question->answers()->create([
                'answer_text' => $validated['correct_answer'] === 'true' ? 'True' : 'False',
                'is_correct' => true,
            ]);
            $question->answers()->create([
                'answer_text' => $validated['correct_answer'] === 'false' ? 'True' : 'False',
                'is_correct' => false,
            ]);
        }

        return redirect()->route('admin.questions.index')->with('success', 'Question Created Successfully');
    }


    // Show the form to edit an existing question
    public function edit($id)
    {
        $question = Question::with('answers')->findOrFail($id);
        $categories = Category::all();
        return view('admin.questions.edit', compact('question', 'categories'));
    }

    // Update an existing question
    public function update(Request $request, $id)
    {
        // Normalize checkbox values
        $answers = array_map(function ($answer) {
            $answer['is_correct'] = isset($answer['is_correct']) ? 1 : 0;
            return $answer;
        }, $request->answers);

        $request->merge(['answers' => $answers]);

        // Validate the request
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question_text' => 'required|string',
            'answers.*.answer_text' => 'required|string',
            'answers.*.is_correct' => 'nullable|in:0,1', // Accept 0 or 1 for is_correct
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'category_id' => $request->category_id,
            'question_text' => $request->question_text,
        ]);

        // Delete existing answers and add the new ones
        $question->answers()->delete();
        foreach ($request->answers as $answer) {
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => $answer['answer_text'],
                'is_correct' => $answer['is_correct'],
            ]);
        }

        return redirect()->route('admin.questions.index')->with('success', 'Question Updated Successfully');
    }

    // Delete a question and its answers
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->answers()->delete(); // Delete related answers
        $question->delete(); // Delete the question

        return redirect()->route('admin.questions.index')->with('success', 'Question Deleted Successfully');
    }
}
