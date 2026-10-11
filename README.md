# Predajňa čaju

Meno a priezvisko študenta: Daniel Varmecký

Študijná skupina: R31

## Stručný opis projektu

Projekt bude jednoduchá webová aplikácia pre predajňu čaju. Zákazník si prezrie ponuku, vyhľadá čaj, pridá ho do košíka a po prihlásení vytvorí objednávku na osobný odber. Správca bude spravovať čaje, ich príchute a prijaté objednávky. Základná verzia bude určená pre jednu predajňu a každý čaj bude ponúkaný v jednej gramáži s aktuálnou cenou. Platba prebehne pri prevzatí.

Databázový návrh bude vychádzať z tímovej semestrálnej práce z SQL. Pre webovú aplikáciu použijem jeho zjednodušenú časť. Webové rozhranie a aplikačnú logiku vytvorím samostatne v rámci VAII.

## Role v projekte

- **Návštevník** – prezerá ponuku a detail čaju, vyhľadáva produkty a môže sa zaregistrovať.
- **Zákazník** – využíva katalóg, vytvára objednávky a prezerá svoje objednávky.
- **Správca** – spravuje čaje a príchute, prezerá všetky objednávky a mení ich stav.

## Prípady použitia podľa rolí

### Návštevník

- Vyhľadá čaj podľa názvu alebo vyfiltruje ponuku podľa kategórie.
- Zobrazí detail čaju s obrázkom, príchuťami, gramážou a cenou.
- Zaregistruje sa a prihlási do aplikácie.

### Zákazník

- Pridá čaj do košíka, upraví počet balení alebo odstráni položku.
- Odošle objednávku na osobný odber.
- Prezrie svoje objednávky, ich položky, cenu a stav.
- Odhlási sa z aplikácie.

### Správca

- Zobrazí, pridá, upraví alebo vymaže čaj a spravuje jeho obrázok.
- Zobrazí, pridá, upraví alebo vymaže príchuť a priradí ju k čaju.
- Zobrazí objednávky a zmení ich stav na prijatú, pripravenú, vybavenú alebo zrušenú.

## Plánované entity

| Entita | Účel a hlavné atribúty |
| --- | --- |
| Používateľ | Účet zákazníka alebo správcu: ID, meno, e-mail, hash hesla a rola. |
| Čaj | Produkt v ponuke: ID, názov, popis, kategória, pôvod, gramáž, cena, obrázok a príznak aktívnej ponuky. |
| Príchuť | Číselník príchutí: ID a názov príchute. |
| Čaj – príchuť | Väzobná tabuľka obsahujúca ID čaju a ID príchute. |
| Objednávka | Objednávka zákazníka: ID, ID používateľa, dátum vytvorenia a stav. |
| Položka objednávky | Objednaný čaj: ID, ID objednávky, ID čaju, počet balení, gramáž a jednotková cena v čase objednania. |

Košík bude uložený v relácii používateľa. Cena a gramáž sa pri objednaní uložia do položky objednávky, aby neskoršia úprava produktu nezmenila staršie objednávky. Samostatná evidencia dodávateľov, pobočiek a skladu nebude súčasťou základnej verzie.

## Vzťahy medzi entitami

- **Používateľ – objednávka (1:N):** zákazník môže mať viac objednávok, každá patrí jednému zákazníkovi.
- **Objednávka – položka objednávky (1:N):** objednávka obsahuje jednu alebo viac položiek.
- **Čaj – položka objednávky (1:N):** čaj sa môže nachádzať vo viacerých objednávkach.
- **Čaj – príchuť (M:N):** čaj môže mať viac príchutí a príchuť môže patriť viacerým čajom. Vzťah zabezpečuje väzobná tabuľka.

## Hlavné stránky aplikácie

1. **Katalóg čajov** – ponuka, vyhľadávanie a filtrovanie.
2. **Detail čaju** – údaje o produkte a pridanie do košíka.
3. **Registrácia a prihlásenie** – vytvorenie účtu a prístup do aplikácie.
4. **Košík** – úprava položiek, celková cena a odoslanie objednávky.
5. **Moje objednávky** – prehľad vlastných objednávok a ich stavov.
6. **Detail objednávky** – zoznam objednaných čajov, množstvá a ceny.
7. **Správa ponuky** – administrácia čajov a príchutí vrátane formulárov.
8. **Správa objednávok** – administrátorský prehľad a zmena stavu objednávok.

## Rozdelenie funkcionality

### Základné funkcie

- Katalóg, detail čaju, košík a vytváranie objednávok.
- Registrácia, prihlásenie, odhlásenie a oprávnenia podľa rolí. Zákazník má prístup iba k vlastným objednávkam.
- Úplné CRUD operácie nad čajmi a príchuťami. Čaj bez objednávok možno vymazať; už objednávaný čaj sa vyradí z ponuky. Pri vymazaní príchute sa odstránia aj jej priradenia k čajom.
- Nahrávanie, výmena a odstránenie obrázkov čajov s kontrolou typu a veľkosti súboru.
- Dve použitia AJAX: filtrovanie katalógu a zmena stavu objednávky priamo v administrátorskej tabuľke bez obnovenia stránky.
- Validácia vstupov na klientovi aj serveri, hashovanie hesiel, parametrizované SQL dopyty a kontrola oprávnení na serveri.

### Rozširujúce funkcie

- Evidencia dostupného počtu balení a kontrola množstva pri objednaní.
- Viac gramáží a cien pre jeden čaj.
- Jednoduchý prehľad počtu objednávok a hodnoty vybavených objednávok.

