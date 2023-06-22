<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "executor_id",
        "user_id",
        "deadline",
    ];

    function executor(){
        return $this->belongsTo(User::class,"executor_id","id");
    }

    function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
