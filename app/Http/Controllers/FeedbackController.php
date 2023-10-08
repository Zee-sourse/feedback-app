<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::query()->when(Request::input('search'), function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('category_id', $search);
        })
        ->withCount('votes')
        ->orderByDesc('votes_count')
        ->with('user', 'upvotes', 'downvotes', 'votes','comments', 'category')
        ->paginate(10)
        ->withQueryString();


        $categories = Category::all();

        return Inertia::render('Feedback/Index', [
            'feedbacks' => $feedbacks,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return Inertia::render('Feedback/Create', [
            'categories' =>   Category::all(),
        ]);
    }

    public function store (HttpRequest $request){


        $validated = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
            'file' => ['required'],
        ]);

        if($request->has('file')){
           $path =  $request->file('file')->store('public/files');
        }

        Feedback::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
            'file' => $path,
        ]);

        return redirect()->route('feedbacks')->with('success', 'Organization created.');
    }

    public function show($id){

        $users = User::select('name')->get();

        $mentionItems = $users->map(function ($user) {
            return [
                'value' => $user->name,
                'label' => $user->name,
            ];
        });

        $feedback = Feedback::with('user', 'upvotes', 'downvotes', 'comments.user', 'category')->find($id);
        return Inertia::render('Feedback/Show',[
            'feedback' => $feedback,
            'users' => $mentionItems
        ]);
    }

    public function upvote(HttpRequest $request){
        $check = Vote::where('user_id', auth()->user()->id)->where('feedback_id', $request->feedback_id)->where('type','up')->first();

        if($check) return redirect()->route('feedbacks.show',$request->feedback_id)->with('errpr','You cannot vote this feedback again');

        Vote::create([
            'user_id' => auth()->user()->id,
            'feedback_id' => $request->feedback_id,
            'type' => 'up'
        ]);

        return redirect()->route('feedbacks.show',$request->feedback_id);
    }
    public function downvote(HttpRequest $request){
        $check = Vote::where('user_id', auth()->user()->id)->where('feedback_id', $request->feedback_id)->where('type', 'down')->first();

        if($check) return redirect()->route('feedbacks.show',$request->feedback_id)->with('error','You cannot vote this feedback again');

        Vote::create([
            'user_id' => auth()->user()->id,
            'feedback_id' => $request->feedback_id,
            'type' => 'down'
        ]);

        return redirect()->route('feedbacks.show',$request->feedback_id);
    }

    public function storeComment(HttpRequest $request){

        $validated = $request->validate([
            'input' => ['required'],
            'textarea' => ['required'],
            'feedback_id' => ['required'],
        ]);
        Comment::create([
            'user_id' => auth()->user()->id,
            'feedback_id' => $request->feedback_id,
            'text' => $request->input,
            'content' => json_encode($request->textarea)
        ]);

        return redirect()->route('feedbacks.show',$request->feedback_id);
    }




}
