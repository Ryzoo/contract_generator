<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CommonController extends Controller
{
  public function emptyFunction(): void
  {

  }

  public function defaultView(){
    return view('default');
  }

  public function changeLanguage(string $lang){
      App::setLocale($lang);
      Session::put('locale', $lang);
      return redirect(url(URL::previous()));
  }
}
