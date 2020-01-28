<?php


namespace App\Providers;


use App\Core\Models\Database\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Str;

class TokenToUserProvider implements UserProvider {

    private $user;

    public function __construct(User $user) {
        $this->user = $user;

    }

    public function retrieveById($identifier) {
        return $this->user->find($identifier);
    }

    public function retrieveByToken($identifier, $token) {
        $user = $this->user
            ->where($identifier,"=", $token)
            ->first();

        return $user ? $user : NULL;
    }

    public function updateRememberToken(Authenticatable $user, $token) {
        // update via remember token not necessary
    }

    public function retrieveByCredentials(array $credentials) {
        $user = $this->user;

        foreach ($credentials as $credentialKey => $credentialValue)
            if (!Str::contains($credentialKey, 'password'))
                $user->where($credentialKey, $credentialValue);

        return $user->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials) {
        $plain = $credentials['password'];
        return app('hash')->check($plain, $user->getAuthPassword());
    }
}
