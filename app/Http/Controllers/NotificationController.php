<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller {

  public function getUserUnreadNotifications(Request $request) {
    $user = Auth::user();
    return $user->unreadNotifications;
  }

  public function getUserNotifications(Request $request) {
    $user = Auth::user();
    return $user->notifications;
  }

  public function setAsRead() {
    $user = Auth::user();
    return $user->unreadNotifications->markAsRead();
  }
}
