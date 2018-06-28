<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Recipe extends Model
{
    protected $fillable = ['id','categoryType','categoryId', 'categoryName', 'categoryUrl', 'parentCategoryId'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('type')->withTimestamps();
    }

    public function recipe_users()
    {
        return $this->users()->where('categoryType', 'made');
    }
}