# Kiirtee Autokool

**Tarkvaranõuete spetsifikatsioon (SRS) ja projekti dokumentatsioon (ISO/IEC/IEEE 29148)**

| Metaandmed | Väärtus |
| :--- | :--- |
| **Projekti nimi** | Kiirtee Autokool |
| **Standard** | ISO/IEC/IEEE 29148 (Requirements engineering) |
| **Versioon** | 1.0 |
| **Staatus** | Valmis (Approved) |
| **Arhitektuur** | PHP MVC (NewsPortal mall), MySQL (PDO) |

---

## 1. Sissejuhatus (Introduction)

### 1.1 Eesmärk (Purpose)
Käesolev `README.md` dokument koondab **Kiirtee Autokool** veebirakenduse tarkvaranõuete spetsifikatsiooni (SRS) vastavalt **ISO/IEC/IEEE 29148** standardile ning sisaldab juhiseid süsteemi paigaldamiseks, seadistamiseks ja haldamiseks.

### 1.2 Süsteemi ulatus (Scope)
**Kiirtee Autokool** on autokooli kursuste pakkumise ja broneerimise veebisait (PHP + MySQL), mis on ehitatud NewsPortal'i MVC malli järgi. Süsteem jaguneb kaheks osaks:
1. **Avalik liides:** võimaldab huvilistel sirvida ja filtreerida autokooli kursusi, tutvuda sõiduõpetajatega ning registreeruda kursustele.
2. **Halduspaneel (`/autokool_admin/`):** võimaldab autentitud administraatoril hallata kursusi (CRUD) ja vaadata/kustutada õpilaste broneeringuid.

### 1.3 Mõisted ja lühendid (Definitions and Acronyms)
- **MVC:** *Model-View-Controller* arhitektuurimuster.
- **CRUD:** *Create, Read, Update, Delete* (andmete loomine, lugemine, muutmine, kustutamine).
- **PDO:** *PHP Data Objects* (andmebaasi ligipääsukiht).
- **CSRF / XSS / SQLi:** veebirakenduste ründetüübid (*Cross-Site Request Forgery*, *Cross-Site Scripting*, *SQL Injection*).

---

## 2. Üldkirjeldus ja arhitektuur (Overall Description)

### 2.1 Toote perspektiiv ja MVC töövoog (Product Perspective)
Rakendus töötab Apache veebiserveris, kus `.htaccess` suunab päringud juurfaili (`index.php?p=$1`).
- **Ruutimine:** `index.php` + `route/routing.php` (`$response = Controller::...`) suunab päringud URL-i viimase segmendi järgi.
- **Kontrollerid:** staatilised meetodid (`Controller.php` avalikus vaates; `controllerAdmin`, `controllerAdminBooking`, `controllerAdminCourse` halduses).
- **Mudelid:** `Course`, `Instructor`, `Booking` ja halduse mudelid teevad SQL-päringuid läbi `Database` wrapper-klassi (`inc/database.php`).
- **Vaated:** kasutavad väljundi puhverdamist (`ob_start()`) ja ühtset baasmalli (`view/layout/layout.php` ning `viewAdmin/templates/layout.php`).

### 2.2 Kasutajaklassid (User Classes)
1. **Külaline (Õpilaskandidaat):** ligipääs avalikele lehtedele ja broneerimisvormile.
2. **Administraator:** ligipääs halduspaneelile (`/autokool_admin/`) pärast e-posti ja parooliga sisselogimist.

### 2.3 Kaustade ja failide struktuur (System Structure)

```text
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

---

## 3. Spetsiifilised nõuded (Specific Requirements)

### 3.1 Funktsionaalsed nõuded — Avalik vaade (Public Requirements)

| Nõude ID | Nõude kirjeldus (ISO 29148) | Marsruut / URL |
| :--- | :--- | :--- |
| **FR-PUB-01** | Süsteem peab kuvama autokooli avalehe koos üldinfoga. | `/` |
| **FR-PUB-02** | Süsteem peab kuvama kursuste nimekirja ja võimaldama filtreerimist kategooria järgi. | `/courses` (nt `?category=B`) |
| **FR-PUB-03** | Süsteem peab kuvama valitud kursuse detailvaate unikaalse ID alusel. | `/course?id=` |
| **FR-PUB-04** | Süsteem peab kuvama autokooli sõiduõpetajate nimekirja. | `/instructors` |
| **FR-PUB-05** | Süsteem peab kuvama autokooli kontaktandmete lehe. | `/contact` |
| **FR-PUB-06** | Süsteem peab kuvama kursusele registreerimise vormi. | `/bookingForm` |
| **FR-PUB-07** | Süsteem peab valideerima ja salvestama vormist saadetud broneeringu andmebaasi. | `/bookingAnswer` |

### 3.2 Funktsionaalsed nõuded — Halduspaneel (Admin Requirements)

Ilma sisselogimata näeb kasutaja aadressil `/autokool_admin/` ainult sisselogimisvormi (`formLogin`).

| Nõude ID | Nõude kirjeldus (ISO 29148) | Halduse marsruut |
| :--- | :--- | :--- |
| **FR-ADM-01** | Süsteem peab võimaldama administraatori sisse- ja väljalogimist. | `login` / `logout` |
| **FR-ADM-02** | Süsteem peab kuvama kõigi registreeritud broneeringute nimekirja. | `bookingsAdmin` |
| **FR-ADM-03** | Süsteem peab võimaldama broneeringu kustutamist koos kinnitusega. | `bookingDel?id=` |
| **FR-ADM-04** | Süsteem peab kuvama halduses kõigi kursuste nimekirja. | `courseAdmin` |
| **FR-ADM-05** | Süsteem peab võimaldama uue kursuse lisamist andmebaasi. | `courseAdd` |
| **FR-ADM-06** | Süsteem peab võimaldama olemasoleva kursuse andmete muutmist. | `courseEdit?id=` |
| **FR-ADM-07** | Süsteem peab võimaldama kursuse kustutamist koos kinnitusega. | `courseDel?id=` |

---

## 4. Liideste ja andmebaasi nõuded (Interface & Data Requirements)

### 4.1 Andmemudel (Database Schema)
Esimesel päringul (`inc/db.php`) luuakse automaatselt andmebaas, järgmised tabelid ja näidisandmed:
- **`courses`** — kursuste andmed (ID, nimetus, kategooria, hind, kirjeldus, algusaeg).
- **`instructors`** — sõiduõpetajate andmed (ID, nimi, kategooriad, kogemus, lisainfo).
- **`bookings`** — kursuste broneeringud (ID, kursuse viide `course_id`, õpilase nimi, e-post, telefon, aeg).
- **`users`** — halduspaneeli administraatorid (ID, e-post, parooliräsi `password_hash`).

---

## 5. Mittefunktsionaalsed nõuded (Non-Functional Requirements)

### 5.1 Turvanõuded (Security)
- **NFR-SEC-01 (SQL Injection):** Kõik SQL-päringud kasutavad PDO *prepared statement*'e (`Database::getAll`, `Database::getOne`, `Database::executeRun` parameetritega).
- **NFR-SEC-02 (XSS):** Kogu kasutajale kuvatav dünaamiline väljund on kaitstud `htmlspecialchars` funktsiooniga.
- **NFR-SEC-03 (CSRF):** Kõigil andmeid muutvatel POST-vormidel on unikaalne sessioonipõhine CSRF-võti.
- **NFR-SEC-04 (Paroolid):** Administraatorite paroolid räsitakse funktsiooniga `password_hash()`.

### 5.2 Töökeskkond (Environment)
- **NFR-ENV-01:** Apache veebiserver (`mod_rewrite` ja `AllowOverride All`), PHP 7.4+ / 8.x (`pdo_mysql`), MySQL 5.7+ või MariaDB 10.3+.

---

## 6. Paigaldus ja seadistamine (Installation & Deployment)

1. **Failide kopeerimine:** Kopeeri projekti kaust Apache juurkausta (näiteks `/var/www/html` või `htdocs`). Vaja on `mod_rewrite` moodulit ja `AllowOverride All` seadistust.
2. **Andmebaasi seadistamine:** Seadista andmebaasi ühendus failis `config.php` või keskkonnamuutujatega:
   - `DB_HOST`
   - `DB_PORT`
   - `DB_USER`
   - `DB_PASS`
   - `DB_NAME`
3. **Käivitamine:** Ava sait veebibrauseris. Andmebaas, tabelid (`courses`, `instructors`, `bookings`, `users`) ja näidisandmed luuakse automaatselt esimesel päringul.

---

## 7. Vaikimisi haldusandmed (Default Credentials)

Halduspaneeli aadress: `/autokool_admin/`

Kui tabel `users` on tühi, luuakse esimesel käivitusel automaatselt administraatori kasutaja:
- **E-post:** `admin@autokool.ee`
- **Parool:** `admin123`

> **Turvahoiatus:** Muuda need väärtused enne saidi avalikustamist keskkonnamuutujatega (`ADMIN_EMAIL`, `ADMIN_PASS`) või failis `config.php` (kehtib ainult tühja `users`-tabeli korral).
