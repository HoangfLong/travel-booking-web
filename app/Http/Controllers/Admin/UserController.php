<?php

namespace App\Http\Controllers\Admin;

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

    public function index(): View
    {
        $users = $this->userService->getAllUser();
        return view('admin.users.index', compact('users'));
    }

    public function show($id): View
    {
        $user = $this->userService->getUserById($id);
        return view('admin.users.show', compact('user'));
    }

    public function restore($id): RedirectResponse
    {
        $this->userService->restoreUser($id);
        return redirect()->route('admin.users.trash')->with('success', 'User restored successfully');
    }

    public function forceDelete($id): RedirectResponse
    {
        $this->userService->forceDeleteUser($id);
        return redirect()->route('admin.users.trash')->with('success', 'User permanently successfully');
    }

    public function getAllTrashed(): View
    {
        $users = $this->userService->getAllUserWithTrashed();
        return view('admin.users.trash', compact('users'));
    }
}
