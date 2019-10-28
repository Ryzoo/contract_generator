# Użycie

---

- [Odpalanie]({{route}}/{{version}}/docker_use#section-1)
- [Wykonywanie komend]({{route}}/{{version}}/docker_use#section-2)

<a name="section-1"></a>
## Odpalanie

Każdą akcję z kontenerami wykonujemy będąc w katalogu `laradock`.
Po użyciu komendy odpalamy kontenery:
```php
 docker-compose up -d nginx mysql
```

<a name="section-2"></a>
## Wykonywanie komend

Aby przejść do kontenera w celu wykonywania na nim komend należy użyć polecenia:
```php
docker-compose exec --user=laradock workspace bash
```
