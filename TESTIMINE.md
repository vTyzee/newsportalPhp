# Testimine ja testikate — Newsportal

## Eesmärk ja praegune seis

Testimise eesmärk on kontrollida uudisteportaali põhifunktsioone ja enne lõplikku esitamist tõendada, et automaattestide **mõõdetud koodikate ületab 60%**.

**Seis dokumentatsiooni koostamise ajal:** automaattestide käivitamise tulemust, edukate testide arvu ja koodikatte protsenti ei ole esitatud. Seega ei saa praegu väita, et üle 60% nõue oleks täidetud. Allolev tabel on testimisplaan, mitte juba toimunud testide protokoll.

## Testkeskkond

- Lokaalne XAMPP (Apache, PHP, MySQL), brauser ja phpMyAdmin.
- Eraldi **testandmebaas** (nt `newsportal_test`) või taastatav näidisandmebaas, et testid ei kustutaks tööandmeid.
- Automaatseks PHP testimiseks sobib näiteks PHPUnit; koodikatte mõõtmiseks on vaja PHP Xdebugi või PCOV-i. Konkreetsed tööriistad ja nende versioonid märgitakse pärast paigaldamist.

## Käsitsi kontrollitavad testjuhtumid

| ID | Tegevus | Oodatav tulemus | Tulemus |
| --- | --- | --- | --- |
| TC-01 | Ava avaleht. | Kuvatakse kuni 3 viimast uudist. | Kontrollimata |
| TC-02 | Ava kõigi uudiste ja ühe kategooria vaade. | Kuvatakse vastavad uudised. | Kontrollimata |
| TC-03 | Ava uudis. | Kuvatakse pealkiri, tekst ja pilt. | Kontrollimata |
| TC-04 | Lisa uudisele kommentaar. | Kommentaar kuvatakse ja loendur muutub. | Kontrollimata |
| TC-05 | Registreeri korrektne uus e-post. | Lisandub kasutaja rolliga `user`. | Kontrollimata |
| TC-06 | Registreeri sama e-post või erinevate paroolidega. | Kasutajat ei lisata; kuvatakse selgitav viga. | Kontrollimata |
| TC-07 | Proovi vale parooliga ja õige parooliga sisse logida. | Vale parool ei luba sisse; õige lubab. | Kontrollimata |
| TC-08 | Ava `newsAdmin` tavakasutajana. | Haldustegevust ei lubata. | Kontrollimata |
| TC-09 | Lisa uudis koos kuni 5 MB pildiga. | Uudis ja pilt ilmuvad nii admini nimekirjas kui avalikul lehel. | Kontrollimata |
| TC-10 | Muuda uudise pealkirja ilma uut pilti valimata. | Tekst muutub; vana pilt jääb alles. | Kontrollimata |
| TC-11 | Kustuta testuudis koos kommentaaridega. | Uudis ja seotud kommentaarid eemaldatakse; tühistamine ei kustuta midagi. | Kontrollimata |
| TC-12 | Logi välja ja proovi admini URL-i uuesti avada. | Admini sisule ei pääse ilma admin-rolliga sisse logimata. | Kontrollimata |

## Automaattestide plaan

1. Eralda võimalusel sisendi kontroll ja andmebaasipäringud testitavateks meetoditeks; väldi päris tootmisandmebaasile tuginevaid teste.
2. Loo PHPUnit testid esmalt registreerimise valideerimisele (tühi nimi, vigane/duplikaatne e-post, lühike ja erinev parool), seejärel uudiste ja kategooriate päringutele, admini ligipääsukontrollile ning CRUD-ile.
3. Kasuta testimiseks eraldi DB-d ja puhasta testandmed pärast iga testi; kustutamistesti ära käivita pärisandmebaasis.
4. Konfigureeri koodikatte raportisse projekti PHP lähtekood (`model`, `controller`, `admin/modelAdmin`, `admin/controllerAdmin`; vajadusel ka ülejäänud oma PHP-kood). Ära arvesta kolmandate osapoolte CSS/JS faile või `vendor` kausta projekti PHP koodikatteks.
5. Käivita testid ja salvesta HTML- või tekstiraport koos kuupäeva, versioonide ja **kõikide testide tulemusega**. Paranda vead ning käivita testid uuesti, kuni mõõdetud katvus on **üle 60%**.

Näidis käsk pärast PHPUnit-i ja koodikatte draiveri seadistamist (Windows PowerShell, projekti juurkaustast):

```powershell
$env:XDEBUG_MODE = 'coverage'
.\vendor\bin\phpunit --coverage-text --coverage-html coverage
```

**NB!** Käsk on juhis tulevaseks käivitamiseks, mitte tõend, et projektis on juba PHPUnit, `vendor` kaust, testid või Xdebug seadistatud. Kui valitakse PCOV, tuleb kasutada vastava draiveri seadistust. Ära lisa GitHubi suurt automaatselt loodud `coverage/` kausta; lisa pigem kokkuvõte ja vajadusel raporti kuvatõmmis.

## Täidetav tulemuste kokkuvõte

| Väli | Tulemus |
| --- | --- |
| Testimise kuupäev | Täitmata |
| PHP / PHPUnit / Xdebug või PCOV versioon | Täitmata |
| Testide arv (läbitud / ebaõnnestunud) | Täitmata |
| Line coverage / koodikate | **Mõõtmata** |
| Raporti asukoht / tõend | Täitmata |
| Lõppjäreldus: üle 60% | **Veel kinnitamata** |

Alles pärast tegeliku raporti saamist võib asendada „Mõõtmata“ mõõdetud protsendiga ja märkida nõude täidetuks.
