# Maile w systemie

---

## Zarządzanie mailami

Maile są obsługiwane w systemie przez z automatu używając konfiguracji w pliku .env z laravela. 
Należy wpisać tam zawartość która pozwoli użyć kontenera MailDev: 
```php
MAIL_DRIVER=smtp
MAIL_HOST=maildev
MAIL_PORT=25
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```
Po tym zabiegu należy jedynie odpalić kontener odpowiedzialny za to
```php
docker-compose up -d maildev
```

Strona z listą maili jest na adresie: `http://localhost:1080/`
