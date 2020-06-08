<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * 挿入可能なカラム達
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'content', 'month', 
    ];
    
    /**
     * Userとの関係性
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
