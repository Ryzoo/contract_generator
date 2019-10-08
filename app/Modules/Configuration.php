<?php


namespace App\Modules;


use App\Modules\Contract\Auth;
use App\Modules\Contract\Provider;

class Configuration {
    public $availableModules;

    public function __construct() {
        $this->availableModules = [
            new Auth(),
            new Provider(),
        ];
    }
}
