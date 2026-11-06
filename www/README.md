# Kiirtee Autokool

Autokooli kursuste pakkumise veebisait (PHP + MySQL), ehitatud NewsPortal'i malli järgi: MVC-kaustad, `index.php` + `route/routing.php` (`$response = Controller::...`, ruutimine aadressi viimase segmendi järgi), staatilised kontrollerid, vaated `ob_start()` + `layout.php` ja `.htaccess` (`index.php?p=$1`).

## Struktuur

```
index.php, .htaccess, config.php
controller/    Controller.php (üks klass, staatilised meetodid)
model/         Course, Instructor, Booking (päringud läbi klassi Database)
view/          lehtede mallid, view/layout/ (header, footer)
route/         routing.php
inc/           database.php (klass Database), db.php (ühendus + tabelid), helpers.php
images/ js/ public/ (public/css/style.css)
autokool_admin/
    index.php, .htaccess
    controllerAdmin/   controllerAdmin, controllerAdminBooking, controllerAdminCourse
    modelAdmin/        modelAdmin, modelAdminBooking, modelAdminCourse
    routeAdmin/        routingAdmin.php
    viewAdmin/         formLogin, startAdmin, error404, bookingList, bookingDeleteForm,
                       courseList, courseAddForm, courseEditForm, courseDeleteForm,
                       templates/layout.php
```

## Paigaldus

1. Kopeeri kaust Apache juurkausta (näiteks `/var/www/html`). Vaja on `mod_rewrite` ja `AllowOverride All`.
2. Seadista andmebaas failis `config.php` või keskkonnamuutujatega `DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASS`, `DB_NAME`.
3. Ava sait brauseris. Andmebaas, tabelid (`courses`, `instructors`, `bookings`, `users`) ja näidisandmed luuakse esimesel päringul.

## Haldus

Aadress: `/autokool_admin/`. Esimene kasutaja luuakse tabelisse `users` (parool hoitakse `password_hash`-ina):

- e-post: `admin@autokool.ee`
- parool: `admin123`

**Muuda need enne avalikustamist** (`ADMIN_EMAIL`, `ADMIN_PASS` või `config.php`; kehtib ainult tühja `users`-tabeli korral).

Halduse aadressid: `login`, `logout`, `bookingsAdmin`, `bookingDel?id=`, `courseAdmin`, `courseAdd`, `courseEdit?id=`, `courseDel?id=`. Ilma sisselogimata näeb ainult login-vormi.

## Avalikud lehed

`/` avaleht · `courses` (filter `?category=B`) · `course?id=` · `instructors` · `contact` · `bookingForm` (vorm) → `bookingAnswer` (salvestamine)

## Turvalisus

Kõik SQL-päringud kasutavad prepared statement'e (`Database::getAll/getOne/executeRun` parameetritega), väljund on `htmlspecialchars`'iga kaitstud, POST-vormidel on CSRF-võti.
