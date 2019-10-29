# Instalacja

---

- [Wymagania]({{route}}/{{version}}/docker_instalation#section-1)
- [Instalacja]({{route}}/{{version}}/docker_instalation#section-2)

<a name="section-1"></a>
## Wymagania

Do poprawnego działania musimy miec mozliwośc uruchomienia komend:
- docker
- docker-compose

<a name="section-2"></a>
## Instalacja

Każdą akcję z kontenerami wykonujemy będąc w katalogu `laradock`.
Po użyciu komendy:
```php
 docker-compose up -d nginx mysql
```
zostaną zainstalowane wszystkie potrzebne zasoby, a nasz kontener zostanie uruchomiony.
Należy pamiętać by wcześniej skonfigurować aplikację jak podano na stronie głównej.
