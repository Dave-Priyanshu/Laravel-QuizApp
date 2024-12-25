<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Allow mass assignment for the 'name' field
    protected $fillable = ['name'];

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
