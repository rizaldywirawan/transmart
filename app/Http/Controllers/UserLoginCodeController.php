<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserLoginCodeController extends Controller
{
    public function index($user)
    {
        $user->load('profile');
        $url = config('app.url') . "/users/{$user->id}/login?code={$user->login_code}";
        return view('pages.users.code.index', compact('url', 'user'));
    }
}
