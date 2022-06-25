<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\PostSaved;


class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'slug',
        'photo'
    ];

    protected $dispatchesEvents = [
        'saved' => PostSaved::class,
        // 'deleted' => PostDeleted::class,
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
