<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class UserPanelController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('users.home',compact('categories'));
    }
    // public function sendName(){
    //     $categories = Category::where('cate')
    //     return v
    // }

    public function showQuestions($categoryId){
        $questions = Question::where('category_id',$categoryId)->get();
        // dd($questions);
        $category = Category::where('id',$categoryId)->first();
        return view('users.questions',compact('questions','category'));
    }
}
