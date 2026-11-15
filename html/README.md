# Predajňa čaju – responzívne HTML a CSS

Statická implementácia dvoch wireframov semestrálneho projektu VAII. Zachováva zelenú hlavičku, svetlé mätové pozadie, krémové plochy a mätovú pätičku. Ukazuje zákaznícke rozhranie s katalógom čajov na osobný odber.

## Otvorenie a odovzdanie

1. Rozbaľte celý ZIP. Neotvárajte stránku priamo v archíve.
2. V priečinku `html` otvorte dvojklikom súbor `index.html` vo webovom prehliadači.
3. Odkazom **Čaje** alebo **Prejsť do katalógu** prejdite na konkrétnu stránku. Súbor `katalog.html` môžete otvoriť aj samostatne.
4. Do koreňa svojho repozitára skopírujte celý priečinok `html` vrátane jeho podpriečinkov. Výsledné umiestnenia majú byť napríklad `html/index.html` a `html/css/style.css`.

Nie je potrebný server, internet, inštalácia balíkov ani zostavenie projektu. Súbory používajú relatívne cesty, preto zachovajte ich vzájomné umiestnenie. Ak už priečinok `html` v repozitári máte, vložte súbory priamo doň, aby nevzniklo `html/html`.

## Súbory

| Súbor | Účel |
| --- | --- |
| `index.html` | Základné rozloženie: logo, hlavička, navigácia, zástupný hlavný obsah a pätička. |
| `katalog.html` | Netriviálna stránka: vyhľadávanie, výber kategórie a šesť produktových kariet s cenami a ovládacími prvkami. |
| `css/style.css` | Spoločný vzhľad oboch stránok a pravidlá pre rôzne šírky obrazovky. |
| `images/logo.svg` | Jednoduché vektorové logo, použité aj ako ikona karty prehliadača. |
| `images/cart.svg` | Ikona košíka. |
| `images/search.svg` | Ikona vyhľadávania. |
| `images/caj-placeholder.svg` | Zástupný obrázok čaju podľa wireframu. |

## Rozsah tejto úlohy

Ide o HTML/CSS prototyp. Odkazy medzi dvoma stránkami fungujú. Do vyhľadávacieho poľa možno písať a kategóriu možno vybrať pomocou natívneho prepínača. Tlačidlo **Zrušiť filtre** vráti formulár do pôvodného stavu.

Vyhľadávanie ani výber kategórie zatiaľ nemenia zoznam čajov. Tlačidlá detailu, košíka, objednávok a odhlásenia sú vizuálne pripravené bez aplikačnej funkcionality. Počet produktov, ceny a obsah kariet sú ukážkové údaje zapísané priamo v HTML. Projekt neobsahuje JavaScript, databázové pripojenie ani backend.

## Ako je kód usporiadaný

HTML určuje význam a poradie obsahu. CSS určuje jeho vzhľad a rozloženie. Atribút `class` prepája prvok v HTML s príslušným pravidlom v CSS, napríklad `class="product-card"` s pravidlom `.product-card`.

- `header` obsahuje hlavičku aplikácie alebo úvod hlavného obsahu.
- `nav` označuje hlavnú navigáciu.
- `main` obsahuje hlavný obsah konkrétnej stránky; každý dokument má jeden hlavný nadpis `h1`.
- `aside` zoskupuje filtre súvisiace s katalógom.
- `section` tvorí tematickú časť, napríklad ponuku produktov.
- `article` predstavuje samostatnú kartu jedného čaju.
- `form`, `label` a `fieldset` tvoria vyhľadávacie pole a pomenovanú skupinu kategórií.
- `footer` obsahuje spoločnú pätičku.

Hlavička a pätička sú v oboch HTML súboroch, takže ich obsah treba pri zmene upraviť na oboch miestach. CSS je spoločné a jeho úpravy sa prejavia na oboch stránkach.

## Responzívne rozloženie

Mriežka **CSS Grid** vytvára panel filtrov a stĺpce produktov. **Flexbox** rozkladá hlavičku, tlačidlá a pätičku. Pravidlá `@media` menia rozloženie podľa šírky okna:

| Šírka okna | Správanie |
| --- | --- |
| Nad 1200 px | Filtre vľavo, tri stĺpce produktov, hlavička na jednom riadku. |
| 901–1200 px | Filtre vľavo, dva stĺpce produktov, navigácia na ďalšom riadku. |
| 601–900 px | Filtre nad produktmi, dva stĺpce produktov. |
| Do 600 px | Jeden stĺpec produktov, vyhľadávacie tlačidlo pod vstupom, preskupená hlavička a pätička. |
| Do 360 px | Kategórie v jednom stĺpci, skrytý pomocný text „Zákazník“ pre viac miesta v hlavičke. |

`meta name="viewport"` umožňuje správnu mierku na mobile. Relatívne šírky, `minmax(0, 1fr)` a zalamovanie prvkov pomáhajú predchádzať nežiaducemu horizontálnemu posúvaniu.

## Jednoduché úpravy

- **Farby:** premenné v `:root` na začiatku `css/style.css`. Napríklad `--footer` mení mätovú pätičku a súvisiace plochy.
- **Čaje a ceny:** obsah jednotlivých prvkov `<article class="product-card">` v `katalog.html`. Pri zmene ceny upravte viditeľný text aj číselnú hodnotu atribútu `value`.
- **Nový produkt:** skopírujte celú kartu, zmeňte údaje, použite jedinečné `id` nadpisu a rovnakú hodnotu v `aria-labelledby`. Upravte aj názvy v `aria-label` tlačidiel a počty produktov.
- **Fotografie:** vložte súbor do `images`, zmeňte `src` na karte a doplňte zmysluplný alternatívny text `alt`. Súčasné placeholdery majú prázdne `alt`, pretože nenesú informáciu navyše oproti textu karty.
- **Responzivita:** pravidlá sú na konci CSS a majú slovenské komentáre.

Odkaz „Preskočiť na hlavný obsah“ sa zobrazí pri ovládaní klávesnicou. Interaktívne prvky majú viditeľné zvýraznenie fokusu a formulárové polia majú popisy.

## Overenie

Obe stránky boli skontrolované v prehliadači pri šírkach 320, 390, 768, 1024 a 1440 px. Pri týchto šírkach nebolo zistené horizontálne pretekanie dokumentu. Katalóg má podľa šírky jeden, dva alebo tri stĺpce. Skontrolované boli aj lokálne odkazy a zdroje.
