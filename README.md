## Sportinių veiklų API 

Užduotis:
Sistemoje laikome informaciją apie įvairiausias sportines veiklas. Kiekviena veikla turi
savo pavadinimą bei yra mokama. Tikslas yra atvaizduoti šias veiklas žemėlapyje. Reikia
sukurti 1 endpoint‘ą, kurį frontender‘is galėtų iškviesti ir su gauta informacija tas veiklas
atvaizduotų. Į endpoint‘ą galima paduoti filtro kriterijus, pagal kuriuos informacija turėtų
būti prafiltruota.

Savo nuožiūra sukurkite duomenų struktūrą apie saugomas veiklas bei kokią
informaciją grąžinsite.
---

## Duomenų struktūra:
Naudojau MySQL duomenų bazę.
1. Identifikacija:
   - `id` - automatiškai didėjantis pirminis raktas
2. Veiklos informacija:
   - `activity_type` (string) - tipas
   - `session_type` (string) - rūšis
   - `name` (string) - pavadinimas
3. Lokacijos info:
   - `address` (string) - adresas
   - `city` (string) - miestas
   - `latitude` (decimal(10, 8)) - platumos koordinatės žemėlapiui
   - `longitude` (decimal(10, 8)) - ilgumos koordinatės žemėlapiui
4. Kaina ir reitingas:
   - `price` (decimal(8, 2)) - kaina su centais
   - `rating` (decimal(2, 1)) - reitingas su vienu skaičium po kablelio
5. Laiko žymos:
   - `start_date` (dateTime) - veiklos pradžia (data ir laikas)
   - `timestamps` automatiškai sukuriami `created_at` ir `updated_at` laukeliai

---

## Projekto paleidimas

Projektui naudojau Docker konteinerius.
Sekite šiuos žingsnius:
1. Klonuokite github repozitoriją:
   ```bash
    git clone git@github.com:zvilkauskas/sport-activities-api.git
    ```
2. Eikite į naujai sukurtą direktoriją:
   ```bash
    cd sport-activities-api
   ```
3. Sukurkite naują ``.env`` failą projekto direktorijoje:
   ```bash
    cp .env.example .env
    ```
4. Sukurkite Docker konteinerius:
    ```bash
    docker compose build
    ```
5. Paleiskite konteinerius:
    ```bash
    docker compose up -d
    ```
6. Įrašykite composer:
    ```bash
    docker compose run --rm composer install
    ```
7. Įrašykite npm:
    ```bash
    docker compose run --rm npm install
    ```
8. Paleiskite npm:
    ```bash
    docker compose run --rm npm run build
    ```
9. Sugeneruokite application key:
    ```bash
    docker compose run --rm artisan key:generate
    ```
10. Paleiskite migracijas ir seeder'į:
    ```bash
    docker compose run --rm artisan migrate --seed
    ```
---

## Naršyklėje rasite duomenis frontender'iui:
1. Atsidarykite naršyklę ir suveskite: http://localhost/api/activities
2. Vieno įrašo peržiūrai: http://localhost/api/activities/5
3. Taip pat galite apsilankyti http://localhost/docs

---

## API Filtrai

API palaiko kelis filtravimo parametrus, kuriuos galima naudoti atskirai arba kartu:

1. **activity_type** - veiklos tipo filtras
    - Galimos reikšmės: "Pilates", "Acrobatics" ir kt.
    - Pavyzdys: `/api/activities?activity_type=Pilates`

2. **session_type** - užsiėmimo tipo filtras
    - Galimos reikšmės:
        - "Remote" (nuotolinis)
        - "Individual" (individualus)
        - "Group" (grupinis)
    - Pavyzdys: `/api/activities?session_type=Group`

3. **city** - miesto filtras
    - Galimos reikšmės: "Vilnius", "Kaunas", "Alytus" ir kt.
    - Pavyzdys: `/api/activities?city=Vilnius`

4. **start_date** - datos filtras
    - Formatas: YYYY-MM-DD
    - Pavyzdys: `/api/activities?start_date=2025-01-01`

Galima naudoti kelių filtrų kombinaciją, pvz:
```
/api/activities?activity_type=Pilates&session_type=Group&city=Vilnius&start_date=2025-01-01
```

Jei nėra rasta veiklų pagal nurodytus filtrus, grąžinamas tuščias masyvas.

---

## Testai
Parašiau keletą testų. Juos paleisti galite naudodami:
```bash 
   docker compose run --rm artisan test
```

---

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
