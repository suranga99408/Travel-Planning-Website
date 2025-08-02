<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === Auth::id()) {
            return back()->with('error', "You can't delete yourself!");
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}