<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;


    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship: a feedback item can have many votes
    public function upvotes()
    {
        return $this->hasMany(Vote::class)->where('type','up');
    }
    public function downvotes()
    {
        return $this->hasMany(Vote::class)->where('type','down');
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    // Define the relationship: a feedback item can have many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }



}
