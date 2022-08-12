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
   
    /** BUG: Throwing error while using in dropdown value using id */
    // protected $hidden = [
    //     "id",
    // ];

    /**
     * Binding Route model with slug instead of id default field
     *
     * @return void
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Casting dates to readable form
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:d-m-Y H:i',
    ];

    /**
     * Get all N level of child for pages 
     *
     * @return void
     */
    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id', 'id')->with('children');
    }

    /**
     * Get Parent Relation with page.
     *
     * @return void
     */
    public function parent()
    {
        return $this->hasOne(__CLASS__, 'id', 'parent_id');
    }
}
