<?php


namespace App\Core\Helpers;


class Url
{
  public static function RemoveStorage(string $url): string{
    return str_replace('/storage','', $url);
  }
}
