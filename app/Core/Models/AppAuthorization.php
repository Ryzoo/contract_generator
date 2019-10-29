<?php


namespace App\Core\Models;

class AppAuthorization {

    /**
     * @var \App\Core\Models\User
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
