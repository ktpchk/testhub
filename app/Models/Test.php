<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tried',
        'passed',
        'tags',
    ];

    public function scopeFilter($query, $search)
    {
        if ($search ?? false) {
            $query->where('name', 'REGEXP', '[\\b\\s]' . $search . '[\\s\\b]')
                ->orWhere('tags', 'REGEXP', '[\\b\\s]' . $search . '[,\\b]');
        }
    }
}
