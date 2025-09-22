<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUser();
        return response()->json([
            'status' => 200,
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
    }

    public function restore($id)
    {
        $this->userService->restoreUser($id);
        return response()->json([
            'status' => 200,
            'message' => 'User restored successfully.'
        ]);
    }

    public function forceDelete($id)
    {
        $this->userService->forceDeleteUser($id);
        return response()->json([
            'status' => 200,
            'message' => 'User permanently deleted successfully.'
        ]);
    }

    public function getAllTrashed()
    {
        $users = $this->userService->getAllUserWithTrashed();
        return response()->json([
            'status' => 200,
            'users' => $users,
        ]);
    }
}
