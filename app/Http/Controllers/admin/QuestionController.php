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
        $questions = Question::with('category')->get(); // Get questions with their related category
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

        // Create the question
        $question = Question::create([
            'category_id' => $request->category_id,
            'question_text' => $request->question_text,
        ]);

        // Store the answers
        foreach ($request->answers as $answer) {
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => $answer['answer_text'],
                'is_correct' => $answer['is_correct'],
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
