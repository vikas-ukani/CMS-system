<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'parent_id',
    ];

    /**
     * Get all child pages 
     *
     * @return void
     */
    public function childrens()
    {
        $this->hasMany(Page::class, 'id', 'parent_id');
    }
}
