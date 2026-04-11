# Changelog

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
