<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * 挿入可能なカラム達
     *
     * @var array
     */
    protected $fillable = [
        'name', 
    ];
    
    /**
     * 部署に所属するユーザを取得するメソッド
     */
    public function users(){
        return $this->hasMany(User::class);
    }
}
