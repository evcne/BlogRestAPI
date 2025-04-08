<?php 

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserRepository
{
    public function getAllUsers()
    {
        return User::get();
    }

    public function getUserById($id)
    {
        return User::with('posts')->findOrFail($id);
        //User::where('id', $id)->first();

    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function createUser($validated)
    {
        $users = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        return User::where('id', $users->id)->get();
    }

    public function updateUser($id, $data)
    {
        $user = User::findOrFail($id);
        if(isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);


        return $user;
    }

    public function deleteUser($id)
    {        
        $user = User::findOrFail($id);

        return $user->delete();
    }
}
