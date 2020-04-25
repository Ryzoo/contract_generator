<?php


namespace App\Core\Traits;


use ReflectionClass;

trait EnumIterator {

    public static function getList(): array
    {
        $ref = new ReflectionClass(__CLASS__);
        return $ref->getConstants();
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
