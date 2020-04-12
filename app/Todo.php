<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['body', 'user_id', 'done'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
