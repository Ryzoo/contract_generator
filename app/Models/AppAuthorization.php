<?php


namespace App\Models;

class AppAuthorization {

    /**
     * @var \App\Models\User
     */
    private $loggedUser;

    public function setLoggedUserFromRequest(\Illuminate\Http\Request $request) {
        $loginToken = $request->bearerToken();
        $this->loggedUser = User::where("loginToken", $loginToken)->first();
    }

    public function getCurrentUser() :?User{
        return $this->loggedUser;
    }
}
