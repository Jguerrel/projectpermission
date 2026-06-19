# Changelog

## [2026-06-19] - Login SSO con Google, pantalla de Configuración y recuperación de contraseña

### Agregado
- **Login SSO con Google** (`laravel/socialite`):
  - `Auth\GoogleController` con flujo de redirección/callback, restringido a dominios de Workspace autorizados (find-or-create de usuarios).
  - Modo **prueba de conexión OAuth** (no inicia sesión, solo valida credenciales y dominio).
  - Botón "Iniciar sesión con Google" en el login.
  - Rutas `auth/google/redirect` y `auth/google/callback`.
  - Columnas `google_id`, `avatar` y `password` nullable en `users`.
- **Pantalla de Configuración** (`admin/settings/setup`, permiso `ver-configuracion`, solo Super Admin):
  - Configura Google SSO (Client ID/Secret, redirect, dominios) y Correo SMTP sin editar `.env`.
  - Valores en tabla `settings` (secretos cifrados); `AppServiceProvider` los aplica sobre `config()` en runtime.
  - Botones para **probar OAuth** y **enviar correo de prueba**.
- Permiso `ver-configuracion` en `PermissionSeeder`.

### Corregido
- **AdminLTE actualizado 3.9.2 → 3.16.0**: resuelve `Target class [PreloaderHelper] does not exist` que rompía todas las vistas del panel (las vistas publicadas eran de la 3.15).

### Archivos modificados
- `app/Http/Controllers/Auth/GoogleController.php` (nuevo)
- `app/Http/Controllers/SettingController.php` (nuevo)
- `app/Models/Setting.php` (nuevo)
- `database/migrations/2026_06_19_000000_add_google_sso_to_users_table.php` (nuevo)
- `database/migrations/2026_06_19_000001_create_settings_table.php` (nuevo)
- `resources/views/settings/setup.blade.php` (nuevo)
- `app/Models/User.php`, `app/Providers/AppServiceProvider.php`
- `config/adminlte.php`, `config/services.php`, `routes/web.php`
- `resources/views/auth/login.blade.php`
- `database/seeders/PermissionSeeder.php`
- `composer.json`, `composer.lock` (adminlte ^3.15)

## [2026-04-11] - APIs de Sucursales y Marcas + Select2 AJAX en Dispositivos

### Agregado
- **API Sucursales** (`BranchOfficeApiController`):
  - `GET /api/branchoffices` — consulta con filtros (search, status, per_page)
  - `POST /api/branchoffices` — crear sucursal
  - `PUT /api/branchoffices/{id}` — actualizar sucursal
- **API Marcas** (`BrandApiController`):
  - `GET /api/brands` — consulta con filtros (search, status, per_page)
  - `POST /api/brands` — crear marca
  - `PUT /api/brands/{id}` — actualizar marca
- **Rutas web JSON** para Select2 AJAX en formularios:
  - `GET /admin/brands/json` — `BrandController@listJson`
  - `GET /admin/branchoffices/json` — `BranchOfficeController@listJson`
  - `GET /admin/typedevices/json` — `TypedeviceController@listJson`
- **Select2 AJAX** en formulario de dispositivos para Sucursal y Tipo de dispositivo (carga dinamica con busqueda)
- Campo `password` agregado al response de `GET /api/accounts`

### Corregido
- **devices/edit.blade.php**: label "Marca" corregido a "Modelo" en el campo de modelo
- **page.blade.php**: error `isPreloaderEnabled()` reemplazado por `config('adminlte.preloader.enabled', false)` para compatibilidad con versiones de AdminLTE
- **composer.json**: revertida version de adminlte a `^3.9` (compatible con lock file v3.15.3)

### Archivos modificados
- `app/Http/Controllers/Api/BranchOfficeApiController.php` (nuevo)
- `app/Http/Controllers/Api/BrandApiController.php` (nuevo)
- `app/Http/Controllers/Api/AccountApiController.php`
- `app/Http/Controllers/BrandController.php` — agregado `listJson()`
- `app/Http/Controllers/BranchOfficeController.php` — agregado `listJson()`
- `app/Http/Controllers/TypedeviceController.php` — agregado `listJson()`
- `routes/api.php` — rutas de sucursales y marcas
- `routes/web.php` — rutas JSON para Select2
- `resources/views/devices/create.blade.php` — Select2 AJAX
- `resources/views/devices/edit.blade.php` — Select2 AJAX + fix label
- `resources/views/vendor/adminlte/page.blade.php` — fix preloader
- `composer.json` — revertido constraint adminlte
