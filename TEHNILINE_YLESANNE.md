# Tehniline ülesanne — Newsportal

## 1. Üldandmed

**Projekti nimetus:** Newsportal  
**Projekti liik:** uudisteportaali veebirakendus, õppeprojekt  
**Teostus:** PHP ja MySQL, MVC põhimõttel  
**Eesmärk:** võimaldada uudiste avaldamist ja lugemist kategooriate järgi, uudiste kommenteerimist ning administraatori kaudu uudiste haldamist.

Dokument kirjeldab projektile seatud funktsionaalseid ja tehnilisi nõudeid ning eristab lähtekoodis nähtavat teostust veel kontrollimist vajavast tööst. See ei ole automaattestide läbimise ega kasutusvalmiduse tõend.

## 2. Kasutajarollid

| Roll | Õigused |
| --- | --- |
| Külastaja | Uudiste loendi, kategooriate ja üksiku uudise avamine; registreerimisvormi kasutamine. |
| Tavakasutaja (`user`) | Sisselogimine ja kasutajavaade; uudiste lugemine. |
| Administraator (`admin`) | Sisselogimine ja uudiste loendi vaatamine, uudise lisamine, muutmine ja kustutamine. |

**Märkus:** olemasolev kommentaaride sisestamise funktsioon on avalikul veebilehel ja kasutab koodis näidiskonto ID-d `2`. Seetõttu ei ole kommentaari autoriseerimine ega tegeliku autoriga sidumine selles versioonis täielikult teostatud.

## 3. Funktsionaalsed nõuded

| ID | Nõue | Teostuse/seisu märkus |
| --- | --- | --- |
| F-01 | Avalehel kuvatakse kolm viimast uudist. | Lähtekoodis olemas. |
| F-02 | Uudiseid saab vaadata kõiki koos ja kategooria kaupa. | Lähtekoodis olemas. |
| F-03 | Iga uudise juures saab avada pealkirja, teksti ja pildi. | Lähtekoodis olemas. |
| F-04 | Uudise juures saab näha kommentaare ja nende arvu ning lisada kommentaari. | Lähtekoodis olemas; autor seotakse näidiskontoga. |
| F-05 | Külastaja saab registreeruda e-posti ja parooliga; e-post on kordumatu ning uus roll on `user`. | Lähtekoodis olemas. |
| F-06 | Registreeritud konto saab sisse ja välja logida. | Lähtekoodis olemas; kontrollida mõlema rolliga. |
| F-07 | Ainult `admin` saab avada uudiste haldamise marsruute. | Rollikontroll on admin-kontrolleris olemas; kontrollida URL-i otse sisestamisega. |
| F-08 | Admin näeb uudiste loendit koos kategooria ja autoriga. | Lähtekoodis olemas. |
| F-09 | Admin saab lisada uudise, määrata kategooria ja üles laadida pildi. | Lähtekoodis olemas; kontrollida andmebaasiga. |
| F-10 | Admin saab muuta uudise andmeid ning soovi korral pilti vahetada. | Lähtekoodis olemas; kontrollida andmebaasiga. |
| F-11 | Admin saab kinnituse järel uudise kustutada koos seotud kommentaaridega. | Lähtekoodis olemas; kontrollida andmebaasiga. |
| F-12 | Vigase marsruudi puhul kuvatakse 404-leht. | Avaliku ja admin-poole vaated olemas. |

**Täiendavad või lõpetamist vajavad nõuded:** kooli algses sisselogimise ülesandes on mainitud administraatori võimalust muuta oma kasutajanime ja parooli. Seda funktsiooni ei ole dokumentatsiooni aluseks olnud arhiivi koodis. Kui see on hindamisel kohustuslik, tuleb see enne töö lõpetamist teostada. Samuti tuleb kommentaarid siduda tegeliku autoriga, kui nõutakse kasutajakontopõhist kommenteerimist.

## 4. Mittefunktsionaalsed nõuded

- **Kasutatavus:** menüü, vormid ja veateated peavad olema arusaadavad ning eesti keeles; muudatustest teavitatakse kasutajat.
- **Turvalisus:** paroole salvestatakse räsi kujul, andmebaasipäringutes kasutatakse seotud parameetreid; haldusmarsruudid on piiratud admin-rolliga. Avalikku keskkonda viimine nõuab eraldi turvaülevaatust.
- **Andmeterviklus:** uudised viitavad olemasolevale kategooriale ja kasutajale; uudise kustutamise korral tuleb arvestada seotud kommentaaridega.
- **Paigaldus:** rakendus peab töötama Apache/PHP/MySQL lokaalses XAMPP-keskkonnas. Vajalik on `mod_rewrite` ja PHP `pdo_mysql`.
- **Testitavus:** enne lõplikku esitamist peab automaattestide **mõõdetud koodikate olema üle 60%**; ainult käsitsi tehtud kontroll või süntaksikontroll seda ei tõenda.

## 5. Tehniline lahendus

**Arhitektuur:** MVC. Marsruudifail valib kontrolleri meetodi, mudel teeb PDO kaudu MySQL-päringud ning vaade vormistab HTML-väljundi. Avaliku lehe ja admin-poole jaoks on eraldi `index.php` ja route/controller/view failid.

**Peamised failid/kaustad:** `Newsportal_emil/index.php`, `inc/db.php`, `model/`, `controller/`, `route/`, `view/`, `admin/` ning `database/newsportal.sql`. Admin-poole halduskood paikneb `admin/modelAdmin/`, `admin/controllerAdmin/`, `admin/routeAdmin/` ja `admin/viewAdmin/` all.

**Andmebaas:** `newsportal`.

| Tabel | Peamised väljad | Seos |
| --- | --- | --- |
| `category` | `id`, `name` | Kategooria võib sisaldada mitut uudist. |
| `users` | `id`, `username`, `email`, `password`, `status`, `registration_date`, `pass` | Kasutaja võib olla uudise autor. Vana näidisvälja `pass` ei tohiks kasutada päris paroolide hoidmiseks. |
| `news` | `id`, `title`, `text`, `picture`, `category_id`, `user_id` | Viitab kategooriale ja autorile. Pildi sisu paikneb DB-s `MEDIUMBLOB`-ina kaasa pandud värskes SQL-is. |
| `comments` | `id`, `user_id`, `news_id`, `text`, `date` | Viitab uudisele ja kasutajale. |

## 6. Vastuvõtukriteeriumid

Töö saab pidada kontrollituks, kui:

1. Projekti saab juhendi järgi käivitada puhtas XAMPP-keskkonnas ja andmebaasi import õnnestub.
2. Avalikud vaated, kategooriad, uudise detailvaade, kommentaaride lisamine ja registreerimine töötavad.
3. Nii `user` kui ka `admin` saavad sisse ja välja logida ning tavakasutaja ei pääse admini uudiste haldamise URL-idele.
4. Uudise lisamine koos pildiga, muutmine ja kustutamine on brauseris ning andmebaasis kontrollitud.
5. Automaattestid on käivitatud ja mõõdetud koodikate on **üle 60%**, lisatud on käivituskäsk ja tulemuse tõend.
6. GitHubis on lähtekood, paigaldamiseks vajalik **näidis**-SQL, README, kasutusdokumentatsioon, tehniline ülesanne ja testimistulemused; salajasi paroole ega päris isikuandmeid ei avaldata.

## 7. Töö hetkeseis / teadaolevad piirangud

Arhiivi põhjal on uudiste põhifunktsioonid, sisselogimine ja admini CRUD-kood olemas. Viimati kasutaja arvutis tehtud värvi-/kujundusmuudatusi ei saa sellest vanemast arhiivist eraldi kinnitada. Administraatori kontoandmete muutmine puudub. Kommenteerimise autor on fikseeritud testkasutaja. Üle 60% testikatte mõõtmise tulemus ja täielik brauseripõhine lõppkontroll on **esitamata**.
