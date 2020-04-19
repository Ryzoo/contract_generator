<?php


namespace App\Core\Traits;


use ReflectionClass;

trait EnumIterator {

    public static function getList(): array
    {
        $refl = new ReflectionClass(__CLASS__);
        return $refl->getConstants();
    }

    public static function getName(int $type):?string {
        $allConst = self::getList();

        foreach ($allConst as $key => $value) {
            if($type === $value) {
              return $key;
            }
        }

        return null;
    }
}
