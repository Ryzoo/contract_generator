# Contract Generator

---

- [Wstępna konfiguracja]({{route}}/{{version}}/overview#section-2)

<a name="section-1"></a>
## Wstępna konfiguracja

Rozpoczynając pracę musimy pamiętać o skonfigurowaniu aplikacji pod swoje środowisko. W tym celu należy kolejno:
- sklonować submoduły 
> {info} Aby to zrobić w katalogu głównym wykonujemy kolejno:
> ```php
> git submodule init
> git submodule update
> ```
- utworzyć plik konfiguracyjny dla dockera - w tym celu w katalogu laradock należy skopiować `env-example` i nazwać go `.env` - można dostować plik do swoich potrzeb
- utworzyć plik konfiguracyjny .env dla aplikacji - w tym celu w katalogu głównym należy skopiować `env-example` i nazwać go `.env` - można dostować plik do swoich potrzeb, należy pamiętać, aby połaczenie z bazą zgadzała się z tym co ustaliliśmy w pliku .env dockera

Ta konfiguracja pozowli nam na uruchomienie projektu w środowisku dockerowym.
Kolejnym krokiem o którym należy pamietać jest wejście do kontenera dockerowego i wywołanie komend uruchamiajacych migracje i seed:
```php
docker-compose exec --user=laradock workspace bash
composer install
npm install
php artisan migrate:fresh --seed
php artisan storage:link
npm run hot
```


