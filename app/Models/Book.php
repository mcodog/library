<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['author_id', 'title', 'date_released'];
    
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public static function boot()
    {
        parent::boot();

        static::restored(function ($book) {
            $book->borrows()->withTrashed()->update(['due_date' => null]);
        });
    }
    public function author()
{
    return $this->belongsTo(Author::class);
}  
public function genre()
{
    return $this->belongsTo(Genre::class);
}  
public function stock()
{
    return $this->hasOne(Stock::class);
}
    public function users()
    {
        return $this->belongsToMany(User::class, 'borrows');
    }
}