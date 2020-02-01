<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
  public function emptyFunction(): void
  {

  }

  public function defaultView(){
    return view('default');
  }

}
