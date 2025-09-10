<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;

class UserRoleController extends Controller
{
    /**
     * Display a listing of user roles.
     */
    public function index(Request $request): InertiaResponse
    {
        $query = UserRole::withCount('users');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $roles = $query->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('Admin/UserRoles/Index', [
            'roles' => $roles,
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new user role.
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/UserRoles/Create');
    }

    /**
     * Store a newly created user role in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:user_roles,code',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        UserRole::create($validated);

        return Redirect::route('admin.user-roles.index')
            ->with('success', 'User role created successfully.');
    }

    /**
     * Display the specified user role.
     */
    public function show(UserRole $userRole): InertiaResponse
    {
        $userRole->load(['users' => function ($query) {
            $query->select('id', 'name', 'email', 'created_at')
                  ->orderBy('name');
        }]);

        return Inertia::render('Admin/UserRoles/Show', [
            'role' => $userRole,
        ]);
    }

    /**
     * Show the form for editing the specified user role.
     */
    public function edit(UserRole $userRole): InertiaResponse
    {
        return Inertia::render('Admin/UserRoles/Edit', [
            'role' => $userRole,
        ]);
    }

    /**
     * Update the specified user role in storage.
     */
    public function update(Request $request, UserRole $userRole): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:user_roles,code,' . $userRole->id,
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        $userRole->update($validated);

        return Redirect::route('admin.user-roles.index')
            ->with('success', 'User role updated successfully.');
    }

    /**
     * Remove the specified user role from storage.
     */
    public function destroy(UserRole $userRole): RedirectResponse
    {
        // Check if role has users assigned
        if ($userRole->users()->count() > 0) {
            return Redirect::back()
                ->with('error', 'Cannot delete role that has users assigned. Please reassign users first.');
        }

        $userRole->delete();

        return Redirect::back()
            ->with('success', 'User role deleted successfully.');
    }
}