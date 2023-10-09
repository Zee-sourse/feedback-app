<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function feedbacks()
    {
        $feedbacks = Feedback::query()->when(FacadesRequest::input('search'), function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('category_id', $search);
        })
            ->withCount('votes')
            ->orderByDesc('votes_count')
            ->with('user', 'upvotes', 'downvotes', 'votes', 'comments', 'category')
            ->paginate(10)
            ->withQueryString();


        $categories = Category::all();

        return Inertia::render('Admin/Index', [
            'feedbacks' => $feedbacks,
            'categories' => $categories
        ]);
    }

    public function show($id)
    {

        $feedback = Feedback::with('user', 'upvotes', 'downvotes', 'comments.user', 'category')->find($id);
        return Inertia::render('Admin/Show', [
            'feedback' => $feedback,
        ]);
    }
    public function edit($id)
    {


        $feedback = Feedback::with('user', 'upvotes', 'downvotes', 'comments.user', 'category')->find($id);
        $categories = Category::all();
        return Inertia::render('Admin/Edit', [
            'feedback' => $feedback,
            'categories' => $categories
        ]);
    }

    public function update(Request $request)
    {


        $feedback = Feedback::with('user')->find($request->feedback_id);


        if (!$request->file === 'some-file.png') {
            if ($request->has('file')) {
                $path =  $request->file('file')->store('public/files');
            }
        }

        $feedback->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => $feedback->user->id,
            'file' => $path ?? $feedback->file,

        ]);

        return redirect()->route('feedbacks.admin')->with('success', 'Date updated.');
    }
    public function delete(Request $request)
    {
        Feedback::find($request->feedback_id)->delete();
        Vote::where('feedback_id', $request->feedback_id)->delete();
        Comment::where('feedback_id', $request->feedback_id)->delete();

        return redirect()->route('feedbacks.admin')->with('success', 'Data Deleted.');
    }
}
