<?php


namespace App\Guards;


use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class TokenGuard implements Guard {

  use GuardHelpers;

  private string $inputKey;
  private string $storageKey;
  private Request $request;

  public function __construct(UserProvider $provider, $request) {
    $this->provider = $provider;
    $this->request = $request;
    $this->inputKey = 'loginToken';
    $this->storageKey = 'loginToken';
  }

  public function user(): ?Authenticatable {
    if (isset($this->user)) {
      return $this->user;
    }

    $user = NULL;
    $token = $this->getTokenForRequest();


    if (!empty($token)) {
      $user = $this->provider->retrieveByToken($this->storageKey, $token);
    }

    return $this->user = $user;
  }

  public function getTokenForRequest(): string {
    $token = $this->request->query($this->inputKey);

    if (empty($token)) {
      $token = $this->request->input($this->inputKey);
    }

    if (empty($token)) {
      $token = $this->request->bearerToken();
    }

    return $token;
  }

  public function validate(array $credentials = []): bool {
    if (empty($credentials[$this->inputKey])) {
      return FALSE;
    }

    $credentials = [$this->storageKey => $credentials[$this->inputKey]];

    if ($this->provider->retrieveByCredentials($credentials)) {
      return TRUE;
    }

    return FALSE;
  }
}
