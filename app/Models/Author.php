<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    //$timestamps = false;
    protected $fillable = ['name', 'gender', 'age'];

    public function books()
{
    return $this->hasMany(Book::class);
}

}


