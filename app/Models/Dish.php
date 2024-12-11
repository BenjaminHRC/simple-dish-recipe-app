<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Dish extends Model
{
    use HasFactory, Encryptable;

    protected $fillable = ["name", "recette", "user_id", "image", "users"];

    protected $with = ['users'];

    //@TODO: encryptable passer par mutators / accessors
    protected $encryptable = ['recette'];

    //@TODO: pas la relation du owner du dish ?

    // @TODO: relation pas claire
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
