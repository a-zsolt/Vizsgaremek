# Vizsgaremek Dokumentáció - Szoftverfejlesztő és -tesztelő
### Andorkó Zsolt, Varga Olivér
---

## 1. Bevezetés és a szoftver célja
A projekt egy modern, webalapú autókonfigurátor alkalmazás, amely lehetővé teszi a felhasználók számára, hogy különböző autómodelleket válogassanak össze, testre szabják azok színét, kerekeit, belső kialakítását és extra tartozékait. A rendszer célja egy életszerű értékesítési folyamat digitális támogatása, az ügyfél igényeinek rögzítésétől kezdve a rendelés leadásáig.

### Főbb funkciók:
- **Autómodellek böngészése:** Elérhető típusok és alapvető műszaki adatok megtekintése.
- **Interaktív konfiguráció:** Színek, felnik, belső extrák kiválasztása valós idejű árszámítással.
- **Felhasználói fiók kezelése:** Regisztráció és bejelentkezés a konfigurációk mentéséhez.
- **Rendeléskezelés:** Összeállított konfigurációk mentése és megrendelése.
- **Adminisztrációs felület:** Rendelések és konfigurációk kezelése az adminisztrátorok számára.

---

## 2. Technikai leírás

### Kliens oldal (Frontend)
- **Keretrendszer:** Vue.js 3 (Options API)
- **Stílus:** Bootstrap 5, Bootstrap Icons
- **HTTP Kliens:** Axios
- **Útvonalválasztó:** Vue Router
- **3D Megjelenítés:** Three.js (továbbfejlesztési ötlet)

### Szerver oldal (Backend)
- **Keretrendszer:** Laravel 12
- **Nyelv:** PHP 8.2+
- **Architektúra:** RESTful API
- **Autentikáció:** Laravel Sanctum (token-alapú)
- **Adatbázis-kezelő:** MySQL

---

## 3. Adatbázis felépítése
Az alkalmazás egy relációs adatbázis-modellt használ az adatok tárolására.

### Főbb táblák:
- `users`: Felhasználók adatai és jogosultságai.
- `car_models`: Az alap autómodellek és alapáraik.
- `car_specs`: Részletes műszaki adatok a modellekhez.
- `color_options`, `wheel_options`, `interior_options`: Választható konfigurációs elemek.
- `accessories`: Extra tartozékok.
- `configs`: A felhasználók által mentett egyedi konfigurációk.
- `orders`: A leadott rendelések állapota és adatai.
- `config_pivot_tables`: Kapcsolótáblák a több-a-többhöz kapcsolatokhoz (pl. belső extrák, tartozékok).

---

## 4. Telepítési és futtatási útmutató

### Előfeltételek
- PHP 8.2+
- Composer
- Node.js (20+ verzió)
- MySQL/MariaDB szerver

### Backend beállítása
1. Lépjen be a `Backend` könyvtárba.
2. Másolja le a környezeti fájlt: `cp .env.example .env`
3. Telepítse a függőségeket: `composer install`
4. Generáljon alkalmazáskulcsot: `php artisan key:generate`
5. Állítsa be az adatbázis kapcsolatot a `.env` fájlban.
6. Futtassa a migrációkat és a seedereket: `php artisan migrate --seed`
7. Indítsa el a szervert: `php artisan serve`

### Frontend beállítása
1. Lépjen be a `Frontend` könyvtárba.
2. Telepítse a függőségeket: `npm install`
3. Indítsa el a fejlesztői szervert: `npm run dev`

---

## 5. Használati útmutató

### Felhasználóként:

1. **Böngészés:** A navbar menuben válassza ki a szimpatikus autómodellt.
2. **Mentés/Rendelés:** Jelentkezzen be a konfiguráció mentéséhez vagy a rendelés leadásához.
3. **Konfigurálás:** Kattintson a "Konfigurálás" gombra. Válassza ki a színt, a kerekeket és az egyéb extrákat. Az ár folyamatosan frissül.
4. **Saját profil:** A profil menüpont alatt megtekintheti korábbi konfigurációit és rendeléseit.

#### Teszt felhasznaló profil:
- Email: user@gmail.com
- Jelszó: User1234

### Adminisztrátorként:
1. **Bejelentkezés:** Jelentkezzen be admin jogosultsággal rendelkező fiókkal.
2. **Kezelés:** Az adminisztrációs felületen láthatja az összes beérkezett rendelést és regisztrált felhasználót, módosíthatja azok állapotát (pl. jóváhagyva, gyártás alatt / email, jogsultságok, jelszó).

#### Teszt admin profil:
- Email: amdin@gmail.com
- Jelszó: Admin1234
