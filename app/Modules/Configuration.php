<?php


namespace App\Modules;


use App\Modules\Contract\Auth;

class Configuration {
    public $availableModules;

    public function __construct() {
        $this->availableModules = [
            new Auth(),
        ];
    }
}
