<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    public $timestamps =  true;

    protected $fillable = [
      'user_id','content','status'
    ];
    public function post() {
        return $this->belongsTo(Post::class);
    }
}
