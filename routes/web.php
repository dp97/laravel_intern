<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Validator;

Route::get('/', function () {
    return view('welcome');
});

Route::post('check', function(Illuminate\Http\Request $request) {
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:4|max:20|alpha_dash'
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withErrors($validator)
            ->withInput();
    }

    // Check credentials
    if ($request->input('email') != "test@test.com"
        || $request->input('password') != "test_1") {
        return redirect('/')
            ->withErrors(['message' => 'email or password is incorrect.'])
            ->withInput();
    }

    return view('success');
});
