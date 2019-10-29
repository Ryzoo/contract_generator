# Użycie

---
- [Deploy z deva]({{route}}/{{version}}/deploy_use#section-1)

<a name="section-1"></a>
## Deploy z deva

Deployment z aktualnego deva jest możliwy w każdej chwili, aby tego dokonać należy:
- przejść do [kontenera dockerowego]({{route}}/{{version}}/docker_use#section-2)
- użyć komendy 
```powershell
php artisan deploy production
```

Musimy przy tym pamiętać, iż potrzebujemy mieć możliwość połączenia sie z serwerem za pomocą ssh inaczej zostaniemy poproszeni o wprowadzenie danych do logowania.
