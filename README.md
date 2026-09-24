# Mindesten

Mindesten er en offentlig digital mindeplatform, hvor brugere kan oprette mindesider for afdøde personer og dele livshistorier, minder, kommentarer og billeder. Mindesider er offentligt tilgængelige, så andre kan finde og læse dem uden login — for eksempel gennem søgning eller en QR-kode knyttet til siden.

Ejeren af en mindeside kan give andre brugere adgang som co-administratorer, hvis flere skal kunne hjælpe med at administrere den samme side.

Live: https://www.mindesten.eu

## Tech

Backend

- Laravel 13 (PHP 8.4)
- Livewire 3 
- Filament v4 
- Scribe 
- PostgreSQL

Frontend

- Blade + Tailwind CSS
- Alpine.js

## Installation

1. Har du PHP 8.4 eller nyere, Composer, Node.js, Git og PostgreSQL installeret på maskinen.

2. Klon projektet:

   ```bash
   git clone <repository-url>
   cd H6-svendeprøve
   ```

3. Installer afhængigheder:

   ```bash
   composer install
   npm install
   ```

4. Tilføj en `.env`-fil i projektets rod — en eksempelfil er inkluderet i projektet som `.env.example`.

   ```bash
   cp .env.example .env
   ```

   Udfyld databaseoplysningerne — se variabeltabellen nedenfor.

5. Generér en applikationsnøgle, opret databasen og kør migrationerne:

   ```bash
   php artisan key:generate
   php artisan migrate
   ```

6. Opret storage-link, så uploadede billeder kan tilgås offentligt:

   ```bash
   php artisan storage:link
   ```

7. Byg frontend-assets og start projektet:

   ```bash
   npm run build
   php artisan serve
   ```

   Projektet er herefter tilgængeligt på: http://localhost:8000

Testdata (valgfrit):

```bash
php artisan db:seed
```

API dokumentationen kan (gen)genereres lokalt med:

```bash
php artisan scribe:generate
```

Administrationspanelet findes på `/admin` og kræver en bruger med administratorrollen.

## Environment-variabler

| Variabel | Beskrivelse |
|---|---|
| `APP_URL` | Den URL applikationen kører på, f.eks. `http://localhost:8000`. |
| `DB_CONNECTION` | Databasedriver. Skal være `pgsql`. |
| `DB_HOST` | Adressen på PostgreSQL-serveren. |
| `DB_PORT` | Porten PostgreSQL kører på, som standard `5432`. |
| `DB_DATABASE` | Navnet på databasen. |
| `DB_USERNAME` | Brugernavn til databasen. |
| `DB_PASSWORD` | Adgangskode til databasen. |

## Test

```bash
php artisan test
```

## REST API

Et offentligt, read-only REST API giver adgang til mindesider og minder:

- Interaktiv dokumentation: `/docs`
- OpenAPI-specifikation: `/docs.openapi`
- Postman collection: `/docs.postman`

## CI/CD

Tests køres automatisk via GitHub Actions ved push til `master`. Deployment til produktionsserveren sker kun, hvis testsuiten består.
