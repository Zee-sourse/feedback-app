<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship: a comment belongs to a feedback item
    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }
}
