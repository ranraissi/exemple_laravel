<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignRoleRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('role')) {
            $query->role($request->role);
        }

        $users = $query->paginate($request->get('per_page', 10));

        return response()->json($users);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->only(['name', 'email', 'password']));

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $user = User::with('roles')->findOrFail($id);

        return response()->json($user);
    }

    public function update(UpdateUserRequest $request, string $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'password']));

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        User::findOrFail($id)->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }

    public function assignRole(AssignRoleRequest $request, string $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->syncRoles([$request->role]);

        return response()->json([
            'message' => "Role '{$request->role}' assigned to user '{$user->name}'",
            'user' => $user->load('roles'),
        ]);
    }
}
