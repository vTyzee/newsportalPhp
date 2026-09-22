# Kasutusdokumentatsioon — Newsportal

## 1. Eesmärk ja kasutajarollid

Newsportal on veebileht uudiste lugemiseks ja kommenteerimiseks. Veebilehte saab sirvida ilma sisse logimata. Külastaja saab registreerida tavakasutaja konto. Sisseloginud kasutaja näeb oma kasutajavaadet; administraatori rolliga kasutaja saab avada uudiste haldamise vaate.

**Märkus:** selles õppeprojekti versioonis salvestatakse kommentaarid näidiskasutaja (`user_id = 2`) nimele, mitte sisseloginud kommenteerija kontole. Ära tõlgenda kommentaaride autoriandmeid tegeliku kasutaja identiteedina.

## 2. Projekti käivitamine

Vaja on Windowsi/XAMPP-i või samaväärset Apache + PHP + MySQL keskkonda. Apache'is peab toimima `mod_rewrite` ja `.htaccess` failide kasutamine; PHP-l peavad olema MySQL PDO ja pilditöötluseks kasutatav `getimagesize` saadaval.

1. Kopeeri kaust `Newsportal_emil` XAMPP-i `htdocs` kausta.
2. Käivita XAMPP-is **Apache** ja **MySQL**.
3. Ava `http://localhost/phpmyadmin/` ja loo andmebaas nimega `newsportal`.
4. Vali andmebaas ning kasuta **Import** vahekaarti faili `database/newsportal.sql` importimiseks. Faili asukoht on repositooriumi kaustas `database`, mitte projekti veebijuurkaustas.
5. Kontrolli `Newsportal_emil/inc/db.php` lokaalse ühenduse seadeid.
6. Ava brauseris `http://localhost/Newsportal_emil/`.

Kui sinu tegelik kaustatee on `C:\xampp\htdocs\newsportal_emil\Newsportal_emil\index.php`, on aadress hoopis `http://localhost/newsportal_emil/Newsportal_emil/`. Sama põhimõte kehtib allpool toodud aadressidele: **asenda baas-URL enda töötava aadressiga**.

Kui suure pildi laadimisel tekib `Data too long for column 'picture'`, kontrolli andmebaasi veeru tüüpi. Olemasoleva vana `BLOB`-tüüpi andmebaasi puhul saab ühe korra käivitada `database/upgrade_picture.sql`. Kaasasolevas värskes SQL-failis on `picture` juba `MEDIUMBLOB`.

## 3. Uudiste lugemine

- **Avaleht** (`/`) näitab kolme viimast uudist.
- **Kategooriad** võimaldab valida kategooria ning vaadata selle uudiseid.
- **Info** (`/all`) avab kõigi uudiste loendi.
- **Edasi** avab valitud uudise täisteksti ja pildi (`/news?id=4`, kus `4` on näidis-ID, mis võib sinu andmebaasis erineda).

Kui lehte ei leita, kuvab rakendus 404-vaate. Uudiste arv ja sisu sõltuvad imporditud andmebaasist.

## 4. Kommentaari lisamine

1. Ava soovitud uudis, klõpsates **Edasi**.
2. Loe uudise juures olevaid kommentaare ja nende kuupäevi.
3. Sisesta tekst väljale **Teie kommentaar** ning klõpsa **Saada**.
4. Veebileht avab uudise uuesti; kommentaar peaks ilmuma selle kommentaaride loendis ning loendur suurenema.

Ära sisesta näidisrakendusse paroole, aadresse ega muid tundlikke andmeid: kommentaarivorm on õppeotstarbeline.

## 5. Kasutaja registreerimine

1. Vali menüüst **Registreeru** (`/registerForm`).
2. Täida väljad **Kasutajanimi**, **E-post**, **Parool**, **Korda parooli**.
3. Klõpsa **Registreeri**.
4. Õnnestumisel kuvatakse teade **Kasutaja on lisatud**; vea korral kuvatakse veateade ja tagasilink.

Nõuded: e-post peab olema korrektses vormingus ja varem kasutamata; parool vähemalt kuus märki ning mõlemas parooliväljas sama. Registreerumisel määratakse roll `user`, mitte `admin`. Registreerumine ei ole automaatne sisselogimine.

## 6. Sisselogimine ja väljalogimine

1. Ava avaliku lehe menüüst **Logi sisse** või mine aadressile `/admin/`.
2. Sisesta andmebaasis oleva konto e-post ja parool.
3. Klõpsa **Logi sisse**. Vale andmete korral kuvatakse veateade.
4. Kasutajavaates on konto nimi ja nupp **Välju**. Väljalogimiseks klõpsa **Välju**.

Tavakasutaja ei tohi pääseda administraatori uudiste haldamise marsruutidele isegi siis, kui kirjutab nende URL-i käsitsi. Näidisandmebaasis olevaid testkontosid ja paroole ei tohi kasutada avalikus veebiserveris.

## 7. Administraator: uudiste haldamine

Logi sisse administraatori rolliga kontoga, siis ava `/admin/newsAdmin`. Loendis kuvatakse ID, pealkiri, kategooria ja autor ning tegevused **Lisa uudis**, **Muuda**, **Kustuta**.

### Uudise lisamine

1. Ava **Lisa uudis** (`/admin/newsAdd`).
2. Sisesta pealkiri, uudise tekst ja kategooria.
3. Vali pildifail (JPG, PNG, GIF või WebP; rakenduse kood piirab suuruse kuni 5 MB).
4. Klõpsa **Lisa uudis** ning kontrolli õnnestumise teadet.
5. Ava uudiste loend ja seejärel avalik leht, et kontrollida uue uudise ilmumist koos pildiga.

### Uudise muutmine

1. Klõpsa uudise reas **Muuda**.
2. Muuda pealkirja, teksti või kategooriat.
3. Uus pilt on valikuline: kui pilti ei vali, jääb olemasolev pilt alles.
4. Klõpsa **Salvesta muudatused** ja kontrolli andmete muutumist.

### Uudise kustutamine

1. Klõpsa uudise reas **Kustuta**.
2. Kontrolli kinnituselehel, et tegemist on õige uudisega.
3. Klõpsa kinnituseks **Jah, kustuta** või loobumiseks **Tühista**.
4. Kustutamisel eemaldatakse ka selle uudise kommentaarid. Toimingut ei saa rakenduses tagasi võtta.

## 8. Sagedasemad vead

| Probleem | Kontrolli |
| --- | --- |
| `Unknown database 'newsportal'` | Loo `newsportal` ja impordi SQL-fail phpMyAdminis. |
| `Index of /...` | Veendu, et brauseri aadress vastab sellele kaustale, kus asub `index.php`. |
| Admini alamleht annab Apache 404 | Kontrolli `Newsportal_emil/.htaccess`, `Newsportal_emil/admin/.htaccess` ja Apache `mod_rewrite` seadistust. |
| Vale e-post või parool | Kontrolli kasutajat tabelist `users`; ära jaga parooli ekraanipildil. |
| Pilt ei ilmu või laadimine ebaõnnestub | Kontrolli pilditüüpi, 5 MB piirangut ja `news.picture` veeru tüüpi. |

## 9. Piirangud

Rakendus on õppeprojekt. Praegune kommentaaride lisamine ei tuvasta kommentaari tegelikku autorit, konto profiili/parooli muutmist ei ole kirjeldatud kasutajale toimiva funktsioonina ning avalikku kasutuskeskkonda paigaldamist ei ole dokumentatsiooni koostamisel kontrollitud.
