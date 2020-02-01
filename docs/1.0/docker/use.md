# Użycie

---

## Odpalanie

Każdą akcję z kontenerami wykonujemy będąc w katalogu `laradock`.
Po użyciu komendy odpalamy kontenery:
```php
 docker-compose up -d nginx mysql
```

## Wykonywanie komend

Aby przejść do kontenera w celu wykonywania na nim komend należy użyć polecenia:
```php
docker-compose exec --user=laradock workspace bash
```
