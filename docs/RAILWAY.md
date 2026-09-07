# Resumen: deploy en Railway (Blaster v2 → producción)

Este repo es **Laravel 9**, PHP `^8.0.2`, **SQLite**. CLI local **8.4.12** (`pdo_sqlite` roto; `pdo_mysql` sí). No tocar PHP del SO.

Repo: [MiguelErnesto/Blaster_eng](https://github.com/MiguelErnesto/Blaster_eng). `main` ya trae PR #1 (`fix/sqlite-pdo-driver`): Carbon 2.73, seeder con `Schema::disable/enableForeignKeyConstraints()`, wrapper `scripts/sqlite-pdo.sh` (solo SQLite local), `/admin` = `/admin/home`.

Sitio previsto: `https://<servicio>-production.up.railway.app/`

El original (Eatery) es el mismo stack. Abajo: qué reutilizar, qué cambia, qué ya no hace falta.

---

## Ya hecho (no repetir)

| Ítem | Estado |
|---|---|
| Seeder `PRAGMA` → `Schema::…ForeignKeyConstraints()` | Hecho en `database/seeders/DatabaseSeeder.php` |
| Carbon `setLastErrors` / PHP 8.4 | Carbon **2.73.0** (`nesbot/carbon: ^2.72.6`) |
| `/admin` = dashboard | `HomeController@index` |
| `scripts/sqlite-pdo.sh` | Solo local SQLite. Railway usará MySQL |

---

## 1. Base de datos: SQLite → MySQL

**Por qué:** Railpack y el PHP local no sirven SQLite; MySQL exige tipos/unsigned/longitud que SQLite ignora.

**Código:**

- `.env` / `.env.example`: `DB_CONNECTION=mysql` (hoy sqlite; `.env` **está en git**)
- FK (MariaDB errno 150): `unsineg()` → `unsignedBigInteger` en:
  - `database/migrations/2022_07_09_131605_create_section3_category_images_table.php`
  - `database/migrations/2022_07_20_064318_create_section5_tablas_table.php`
- Textos largos (`string()` = VARCHAR 255) → `text()` en descriptions de secciones y textareas admin:
  - `section2s`, `section2_imgs`, `section3s`, `section4s`, `section5s`, `section6s`
  - `section5_tablas.descripcion`

No hay tabla `section3_imgs_social_networks` (eso era Eatery).

**Local:** `docker-compose.yml` con `mariadb:10.2`, puerto **3308** (3306 y 3307 ocupados en esta máquina), DB **`blaster`**.

```bash
docker compose up -d
php artisan migrate --seed
```

`.env` local:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=blaster
DB_USERNAME=root
DB_PASSWORD=secret
```

---

## 2. PHP y Composer (Railpack ≥ 8.2)

Railpack lee `composer.json`: `^8.0.2` → *No version available for php 8.0.2*.

| Paquete | Original | Objetivo | Motivo |
|---|---|---|---|
| `php` | `^8.0.2` | `^8.2` | Railpack ≥ 8.2 |
| `nette/schema` | 1.2.2 (`<8.2`) | 1.3.6 | lockfile 8.2 |
| `nette/utils` | 3.2.7 (`<8.2`) | 4.1.5 | lockfile 8.2 |
| `phpunit/phpunit` | 9.5.21 | 9.6.x | `prophecy` 1.15 pide PHP `<8.2` |
| `doctrine/instantiator` | 1.4.1 | pin `^1.5.0 <2.0` | PHP 8.4 local no debe subir a 2.x |
| `ext-pdo_mysql` | no | `*` | runtime Railway |

CLI local = 8.4 → `--ignore-platform-reqs` o `composer config platform.php 8.2.33`.

Sin `composer update` global. `vendor/` va en git.

---

## 3. Ajustes Laravel para Railway

- `TrustProxies.php`: `$proxies = '*'` (HTTPS detrás del proxy)
- Preview admin: `front_previews.url` / `mains.front_url` usan `APP_URL` (no `http://localhost:8000/`)
- `InitialValues.php` (y Auth): no asumir fila `[0]` si la tabla está vacía

Railpack **sí** corre `migrate`; **no** seeders.

```bash
php artisan db:seed --force
```

Admin: `/login` — `admin@website.com` / `12345678`. Dashboard: `/admin` o `/admin/home`.

---

## 4. Railway (UI y variables)

**Servicios:** app Laravel (builder **Railpack**) + **MySQL** en el mismo proyecto.

**GitHub:** `MiguelErnesto/Blaster_eng`. Rama de producción = `main`.

```
APP_ENV=production
APP_KEY=base64:...
APP_URL=https://<servicio>-production.up.railway.app
APP_DEBUG=false

DATABASE_URL=${{MySQL.MYSQL_URL}}
```

O `DB_HOST` / `DB_PORT` / `DB_DATABASE` / `DB_USERNAME` / `DB_PASSWORD` desde el servicio MySQL.

El nombre `MySQL` debe coincidir con el servicio. **No** `127.0.0.1` ni puerto `3308`.

Tras el primer deploy: `php artisan db:seed --force`.

---

## 5. Rama (este corte)

Una sola rama desde `main` con todo lo anterior (no 7 PRs): `fix/railway-deploy`.

---

## 6. Lo que no se hace (a propósito)

- No reinstalar/arreglar `pdo_sqlite` ni paquetes PHP del SO
- No usar `scripts/sqlite-pdo.sh` en Railway
- No Docker de la app; solo MariaDB local
- No clonar volúmenes de otros proyectos
- No migrar `nginx_example.conf`
- No S3 en el primer corte
