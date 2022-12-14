<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function index()
    {
        $userList = User::where('role_id', 2)->where('status', 'active')->get();
        return view('user', ['userList' => $userList]);
    }

    public function newregsiter()
    {
        $userRegisList = User::where('status', 'inactive')->get();
        return view('user-newregister', ['userRegisList' => $userRegisList]);
    }

    public function approved(Request $request, $email)
    {
         $userApproved = User::where('email', $email)->first();
         $userApproved->status = 'active';

         $userApproved->update();
         if ($userApproved) {
            Session::flash('status', 'success');
            Session::flash('message', 'User berhasil di approve');
        }

        return redirect('/users-newregister');
    }

    public function banned(Request $request, $email)
    {
        $banned = User::where('email', $email)->first();
        $banned->status = 'inactive';

        $banned->delete();
        if ($banned) {
            Session::flash('status', 'success');
            Session::flash('message', 'Genre berhasil dihapus');
        }

        return redirect('/users');
    }

    public function bannedlist()
    {
        $bannedList = User::onlyTrashed()->get();
        return view('user-bannedlist', ['bannedList' => $bannedList]);
    }

    public function restore($email)
    {
        $restoreUser = User::withTrashed()->where('email', $email)->first();

        $restoreUser->restore();
        if ($restoreUser) {
            Session::flash('status', 'success');
            Session::flash('message', 'User berhasil unbanned');
        }
        return redirect('/users-bannedlist');
    }

}
