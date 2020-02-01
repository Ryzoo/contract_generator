# Witaj w Generatorze Umów

---

## Wstępna konfiguracja

Rozpoczynając pracę musimy pamiętać o skonfigurowaniu aplikacji pod swoje środowisko. W tym celu należy kolejno:
- sklonować **submoduły** 
  
  Aby to zrobić w katalogu głównym wykonujemy kolejno:
```bash
git submodule init
git submodule update
```
- utworzyć plik konfiguracyjny dla **dockera** - w tym celu w katalogu **laradock** należy skopiować `env-example` i nazwać go `.env` - można dostoswać plik do swoich potrzeb
- utworzyć plik konfiguracyjny .env dla aplikacji - w tym celu w katalogu głównym należy skopiować `env-example` i nazwać go `.env` - można dostoswać plik do swoich potrzeb, należy pamiętać, aby połączenie z bazą zgadzała się z tym co ustaliliśmy w pliku **.env dockera**

Ta konfiguracja pozwoli nam na uruchomienie projektu w środowisku dockerowym.
Kolejnym krokiem o którym należy pamiętać jest wejście do kontenera dockerowego i wywołanie komend uruchamiających migracje i seed:

```bash
docker-compose exec --user=laradock workspace bash
composer install
npm install
php artisan migrate:fresh --seed
php artisan storage:link
npm run hot
```

## Problemy

### Storage link

Nie działa to na windowsie. Aby naprawić link należy w katalogu głównym projektu wywołać komendę:

```bash
mklink /J .\public\storage .\storage\app\public
```





