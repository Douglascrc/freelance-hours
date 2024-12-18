<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller {
  public function __invoke(Request $request)
  {
    $user = User::query()->create([
      'name' => 'Douglas',
      'email' => 'douglas@email.com',
      'password' => 'password',
    ]);

    dd($user);

    return view('welcome');
  }
}