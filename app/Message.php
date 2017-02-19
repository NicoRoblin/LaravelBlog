<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'article_id', 'user_id', 'for_user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function article(){
        return $this->belongsTo('App\Article');
    }
}
