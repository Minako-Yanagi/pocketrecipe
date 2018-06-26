<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function recipes()
    {
        return $this->belongsToMany(recipe::class)->withPivot('type')->withTimestamps();
    }

    public function made_recipes()
    {
        return $this->recipes()->where('type', 'made');
    }

    public function made($recipeId)
    {
        // Is the user already "made"?
        $exist = $this->is_madeing($recipeId);

        if ($exist) {
            // do nothing
            return false;
        } else {
            // do "made"
            $this->recipes()->attach($recipeId, ['type' => 'made']);
            return true;
        }
    }

    public function dont_made($recipeId)
    {
        // Is the user already "made"?
        $exist = $this->is_madeing($recipeId);

        if ($exist) {
            // remove "made"
            \DB::delete("DELETE FROM recipe_user WHERE user_id = ? AND recipe_id = ? AND type = 'made'", [\Auth::id(), $recipeId]);
        } else {
            // do nothing
            return false;
        }
    }

    public function is_madeing($recipeIdOrCode)
    {
        if (is_numeric($recipeIdOrCode)) {
            $recipe_id_exists = $this->made_recipes()->where('recipe_id', $recipeIdOrCode)->exists();
            return $recipe_id_exists;
        } else {
            $recipe_code_exists = $this->made_recipes()->where('code', $recipeIdOrCode)->exists();
            return $recipe_code_exists;
        }
    }
    
}
