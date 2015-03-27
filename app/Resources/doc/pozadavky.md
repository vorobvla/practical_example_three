# Požadavky

## Uživatelské role

  * R.1 Nepřihlášený uživatel
    * prohlíží příspěvky, které nejsou označeny jako *soukromé* (*private*)
  * R.2 Přihlášený uživatel - autentizuje se proti lokální databázi uživatelů (v tomto případě proti MySQL)
    * R.2.1 Autor 
      * vkládá nové příspěvky
      * upravuje a maže vlastní příspěvky vč. příslušných komentářů byť není jejich autorem
      * nastavuje dobu publikace příspěvku
    * R.2.2 Čtenář 
      * prohlíží příspěvky označené jako *soukromé* (*private*)
      * vkládá komentáře
    * R.2.3 Správce 
      * má stejná oprávnění jako všechny předchozí role nezávisle na vlastnictví příspěvku či komentáře

## Funkční požadavky

  * F.1 Autentizace uživatele
    * F.1.1 Přihlášení uživatele
    * F.1.2 Odhlášení uživatele
  * F.2 Zobrazení příspěvků
    * F.2.1 Zobrazení příspěvků podle role uživatele
        * F.2.1.1 Zobrazení dle platnosti příspěvku (publikace od - do)
        * F.2.1.2 Stránkování seznamu příspěvků
        * F.2.1.3 Řazení příspěvků sestupne dle data vytvoření
    * F.2.2 Zobrazení detailu příspěvku 
      * F.2.2.1 Zobrazení komentářů
        * F.2.2.1.1 Stránkování výpisu komentářů
        * F.2.2.1.2 Řazení komentářů vzestupně dle data vytvoření
      * F.2.2.2 Zobrazení příloh (či náhledů příloh), pokud to Internet Media Type umožňuje (typicky obrázky)
      * F.2.2.3 Přílohy, které nelze zobrazit nabídnout ke stažení
    * F.2.3 Filtrování seznamu příspěvků podle
      * F.2.3.1 autora
      * F.2.3.2 tagů
  * F.3 Příspěvky
    * F.3.1 Vložení příspěvku
      * F.3.1.1 Autorizace uživatele
      * F.3.1.2 Vložení textu příspěvku
      * F.3.1.3 Přidání přílohy příspěvku
      * F.3.1.4 Platnost příspěvku (publikace od - do)
      * F.3.1.5 Soukromý příspěvek
      * F.3.1.6 Nastavení tagů
    * F.3.2 Úprava příspěvku
      * F.3.2.1 Autorizace uživatele
      * F.3.2.2 Úprava textu příspěvku
      * F.3.2.3 Přidání přílohy příspěvku
      * F.3.2.4 Smazání přílohy příspěvku
      * F.3.2.5 Platnost příspěvku (publikace od - do)
      * F.3.2.6 Soukromý příspěvek
      * F.3.2.7 Úprava tagů
    * F.3.3 Smazání příspěvku
      * F.3.3.1 Autorizace uživatele
      * F.3.3.2 Smazání příspěvku
      * F.3.3.3 Smazání příloh
      * F.3.3.4 Smazání komentářů (opakováním postupu dle F.4.3)
  * F.4 Komentáře
    * F.4.1 Vložení komentáře k příspěvku či jinému komentáři
      * F.4.1.1 Autorizace uživatele
      * F.4.1.2 Vložení textu komentáře
      * F.4.1.3 Přidání přílohy komentáře
    * F.4.2 Úprava komentáře
      * F.4.2.1 Autorizace uživatele
      * F.4.2.2 Úprava textu komentáře
      * F.4.2.3 Přidání přílohy komentáře
      * F.4.2.4 Smazání přílohy komentáře
    * F.4.3 Smazání komentáře
      * F.4.3.1 Autorizace uživatele
      * F.4.3.2 Smazání komentáře
      * F.4.3.3 Smazání příloh
  * F.5 Podpora tisku (CSS)

## Nefunkční požadavky

  1. PHP
  1. ORM Doctrine 2
  1. Symfony 2
  1. Testování PHPunit
  1. Validní HTML
  1. Validní CSS
