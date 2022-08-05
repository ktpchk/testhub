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

    public function scopeFilter($query, $search)
    {
        if ($search ?? false) {
            $query->where('name', 'REGEXP', '[\\b\\s]' . $search . '[\\s\\b]')
                ->orWhere('tags', 'REGEXP', '[\\b\\s]' . $search . '[,\\b]');
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
