<?php

namespace App\Http\Controllers;


use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function getAllUsers()
    {
        return $this->user->getAll();
    }

    public function getuser($id)
    {
        return $this->user->getById($id);
    }

    public function getCount()
    {
        $cnt = $this->user->getAll();
        $response= [
            "Total Users"=> $cnt
        ];
        return response()->json($response);
    }
    public function updateuser($id)
    {
        return $this->user->update($id, request(['name','email']));
    }

    public function delete($id)
    {
        return $this->user->remove($id);
    }
}
