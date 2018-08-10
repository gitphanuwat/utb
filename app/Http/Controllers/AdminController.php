<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }
    /*$this->middleware('log', ['only' => [
        'fooAction',
        'barAction',
    ]]);
    $this->middleware('subscribed', ['except' => [
    'fooAction',
    'barAction',
    ]]);*/
    public function index()
    {
          return 'Admin Area';
    }

}
