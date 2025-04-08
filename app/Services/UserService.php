<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function createUser($data)
    {
        $email = $this->userRepository->getUserByEmail($data['email']);
        if($email != null) {
            return false;
        }
        return $this->userRepository->createUser($data);
    }

    public function updateUser($id, $data)
    {

        $user = $this->userRepository->getUserById($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if($user->getAttributes()['email'] != $data['email']) {

            $email = $this->userRepository->getUserByEmail($data['email']);
            if($email != null) {
                return false;
            }
        }

        return $this->userRepository->updateUser($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
