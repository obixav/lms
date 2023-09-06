<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }
    public function projects()
    {
        return $this->morphedByMany(Project::class, 'taggable');
    }
}
