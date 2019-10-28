# Instalacja

---

- [Wymagania]({{route}}/{{version}}/docker_instalation#section-1)
- [Instalacja]({{route}}/{{version}}/docker_instalation#section-2)

<a name="section-1"></a>
## Wymagania

Do poprawnego działania potrzebujemy mieć w systemie:
- docker
- docker-compose

<a name="section-2"></a>
## Instalacja

> {danger} Przed pracą upewnij się, że posiadasz plik `.env` i jest on odpowiednio skonfigurowany.
> Sekcja związana z bazą danych ma wyglądać tak: 
> ```php
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=theDatabaseName
DB_USERNAME=root
DB_PASSWORD=root
```

Każdą akcję z kontenerami wykonujemy będąc w katalogu `laradock`.
Po użyciu komendy:
```php
 docker-compose up -d nginx mysql
```
zostaną zainstalowane wszystkie potrzebne zasoby, a nasz kontener zostanie uruchomiony.
