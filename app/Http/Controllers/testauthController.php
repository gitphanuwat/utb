<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\University;
use App\Center;
use App\Area;

use App\Http\Requests\AreaRequest;

class testauthController extends Controller
{
    public function index()
    {
      $idu = Auth::user()->university_id;
      return view('test.testauth',compact('idu'));
    }
}
