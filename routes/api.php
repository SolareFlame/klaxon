<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/icecast/auth', function (Request $request) {
    $token = $request->query('token');

    $user = User::where('icetoken', $token)->first();

    if (!$user || $user->is_listening) {
        return response('Unauthorized', 403);
    }

    $user->is_listening = true;
    $user->save();

    return response('OK', 200);
});

Route::get('/icecast/disconnect', function (Request $request) {
    $token = $request->query('token');

    $user = User::where('icetoken', $token)->first();
    if ($user) {
        $user->is_listening = false;
        $user->save();
    }

    return response('Disconnected', 200);
});
