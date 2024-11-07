# Después de Bajar el Repositorio

Compañero realiza estos comandos:

```bash
npm install
laravel artisan key:generate
```

## Aclaracion

la base de datos sqlite no necesita configuración asi que no e necesario manipularla, pero usted tendrá que crearla manualmente en `database/' y debe crear el archivo 'database.sqlite`, y luego tiene que ejecutar este comando para que laravel realice las migraciones

```bash
php artisan migrate
```

y si desea visualizarla en Vs code
use esta extension y luego ábrelo.
    <https://open-vsx.org/extension/qwtel/sqlite-viewer>

ahora recien puede levantar el servidor con

```bash
composer dev run
```
