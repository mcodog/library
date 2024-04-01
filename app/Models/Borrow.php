<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['book_id', 'user_id', 'due_date'];
    
   public function book()
{
    return $this->belongsTo(Book::class);
}  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}