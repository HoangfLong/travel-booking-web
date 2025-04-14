<?php

namespace App\Services;

use App\Repositories\UserRepository;


class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUser()
    {
        return $this->userRepository->getAll();
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function restoreUser($id)
    {
        return $this->userRepository->restore($id);
    }

    public function forceDeleteUser($id)
    {
        return $this->userRepository->forceDelete($id);
    }

    public function getAllUserWithTrashed()
    {
        return $this->userRepository->getAllWithTrashed();
    }
}