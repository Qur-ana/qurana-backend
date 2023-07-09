<?php
namespace App\Repository\UserRepository;

use App\Models\User;

class EloquentUserRepository implements UserRepository{

    /**
     * Register new user
     *
     * @param array<string, string> $data
     * @return \App\Models\User
     */
    public function RegisterNewUser($data){
        $user = User::create($data);
        return $user;
    }
}