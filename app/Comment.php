<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Comment extends Model
{
    //
    protected $fillable = [
'post_id',
'author',
'email',
'body',
'is_active',
    ];


    public function post()
    {
      return $this->belongsTo('App\Post');
    }

}
