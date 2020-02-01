# Debugowanie

---

## Telescope

Jest zainstalowany i skonfigurowany pod środowisko developerskie lokalnie.
Jeśli chcemy z niego skorzystać wystarczy mieć ustawione w pliku `.env`
```php
APP_ENV=local
```
Oraz wejść na stronę `adres_do_strony/telescope`

## XDEBUG
ABy umoiżliwić działanie debugowania w php należy w konfiguracji laradoca zmienić dane flagi na tru:
```php
WORKSPACE_INSTALL_XDEBUG
PHP_FPM_INSTALL_XDEBUG
```
Następnie należy skofigurować PHPSTORMA 
