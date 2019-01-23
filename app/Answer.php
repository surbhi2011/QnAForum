<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $fillable = [
        'description'
    ];

    public function add(array $attributes)
    {
        $user = User::create([
            'name' => $attributes[0],
            'email' => $attributes[1],
            'password' => Hash::make($attributes[2]),
        ]);
        return $user;
    }
}
