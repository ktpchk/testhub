<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tags',
        'description',
        'time',
        'tried',
        'passed',
    ];

    public function scopeFilter($query, $search, $tag)
    {
        if ($search) {
            $query
                ->where('name', 'REGEXP', '\\b' . $search . '\\b')
                ->orWhere('tags', 'REGEXP', '\\b' . $search . '\\b');
        } elseif ($tag) {
            $query
                ->where('tags', 'REGEXP', '\\b' . $tag . '\\b');
        }
    }

    public function questions()
    {
        return $this->hasMany(TestQuestion::class, 'test_id');
    }

    public function option()
    {
        return $this->hasOne(TestOption::class, 'test_id');
    }
}
