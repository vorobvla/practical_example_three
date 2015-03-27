# BI-PWT - Úloha 1 - Blog B142 - zadání a hodnocení

## Zadání

Implementujte datový model a služby pro aplikaci Blog podle připravených rozhraní:

  * Cvut\Fit\BiPwt\BlogBundle\Entity\ImageInterface
  * Cvut\Fit\BiPwt\BlogBundle\Entity\UserInterface
  * Cvut\Fit\BiPwt\BlogBundle\Entity\PostInterface
  * Cvut\Fit\BiPwt\BlogBundle\Entity\TagInterface
  * Cvut\Fit\BiPwt\BlogBundle\Entity\FileInterface
  * Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface
  * Cvut\Fit\BiPwt\BlogBundle\Service\BlogInterface
  * Cvut\Fit\BiPwt\BlogBundle\Service\UserInterface

Jako základ Vašeho řešení použijte fork zadání [https://gitlab.fit.cvut.cz/bi-pwt/blog-b142](https://gitlab.fit.cvut.cz/bi-pwt/blog-b142) do Vašeho namespacu (https://gitlab.fit.cvut.cz/LOGIN/blog-b142).

  * Na stránce projektu použijte odkaz Fork vpravo nahoře vlevo [tento odkaz](https://gitlab.fit.cvut.cz/bi-pwt/blog-b142/fork/new).

Při implementaci zohledněte [diagram](object_model.png). Vazby označené v diagramu (```= NULL```) jsou nepovinné.

Při nastavování hodnot atributů dbejte na konzistenci dat, např.
  
  * ```$post->setAuthor($user)``` znamená existenci instance ```$post``` v kolekci ```$user->getPosts()``` a naopak
  * ```$user->addPost($post)``` znamená ```$post->getAuthor() == $user```.

## Hodnocení

Úloha bude hodnocena automatizovaným testem (jednotkové testy). Bodový výsledek bude určen vztahem:
> (počet bodů za úlohu * počet úspěšných testů / počet testů celkem).

Úloha bude hodnocena 0 body, pokud bude splněna libovolná z následujících podmínek:

  * Úloha je předložena k hodnocení po termínu. Toto neplatí v odůvodněných případech (např. nemoc).
  * Z logu nástroje git není patrná průběžná práce (tj. log bude obsahovat minimum záznamů) bude hodnocena 0 body. Posouzení přísluší osobě vyučujícího!
  * Z logu nástroje git není možno jasně identifikovat osobu (osoby), která(é)  prováděla(y) většinu změn. Za vhodnou identifikaci považujeme jméno, příjmení a fakultní e-mailovou adresu.

Přístup do repozitáře musí být povolen pro *Deploy Key* (Settings -> Deploy Keys):

```
ssh-dss AAAAB3NzaC1kc3MAAACBANpZpTpv/SzJ2CDYPFj8HYZ+K6uKgLgkNEdU/V3H9r7CzWqwyNPei1bjPkpXr4Zow01PwbkjTtQ/jH2GyCwTURJkZBSPuePMGZqgZpfKsrqmrRVBnGmzRTrx6OccHFgvCV02U2yx06AfjEZfPqiJ8OvEFEdsNmVCKU2TmUaDWDexAAAAFQDsaOS9uZYJ5BYIqqwaxXTZUjqzewAAAIA8lNZ+uLdHUmfFdfOch7UXu6M/CC0YiKHX3+GuwYL1+BFBb0lATBNlw0rIk1Opq7O9TJ/fWqj+C5Z4GXPNTIISq2g5azPN+6JiQIl4j84gSrr/rZb1gcSrmKmJQdDBzo1aDecgIIM/qaoQLqMimbpman7A381CKXWva0HMxir3GgAAAIEA1+tRVR9MK454KrOPOm0ORRq8nddPuMh1nVe7sbyFnx88eM1Ovio+t/FSA23u91DP26VlHh3yEI2Zjd3g+TYf0F8hqTnLGjVTSnApturndJC5ZZ960Fu4NFs5tMcg8GMN0L9R/ojUAuoraZkPoISUr0JpdcVhZU7UrH9t7hrwqeE= kadleto2@webdev-fit-01
```

## Termín hodnocení

Termín automatického vyhodnocení bude upřesněn.

## Postup vyhodnocení

  1. Z vašeho repozitáře (https://gitlab.fit.cvut.cz/LOGIN/blog-b142) bude staženo vaše řešení.
  1. Budou porovnány třídy testů ve vašem projektu a v zadání.
  1. Bude doplněn soubor composer.json o klíč pro GitHub, pokud jej nebude již obsahovat.
  1. Budou stažen nástroj composer a pomocí něj nainstalovány závislosti.
  1. Budou spuštěny testy a vypočítáno hodnocení (vizte výše).

Pokud jakákoliv z popsaných operací skončí chybou zaviňenou vámi (např. nedodržení zadání, neošetřené chyby v kódu), znamená to hodnocení vašeho řešení 1. úlohy 0 body.

Celý postup vyhodnocení bude zalogován, log bude k nahlédnutí na cvičení.

# BI-PWT - Úloha 2 - Blog B142 - zadání a hodnocení

## Zadání

Implementujte webovou aplikaci podle požadavků [pozadavky.md]. Dodržte implementaci následujících tříd podle připravených rozhraní:

  * Cvut\Fit\BiPwt\BlogBundle\Entity\ImageInterface
  * Cvut\Fit\BiPwt\BlogBundle\Entity\UserInterface
  * Cvut\Fit\BiPwt\BlogBundle\Entity\PostInterface
  * Cvut\Fit\BiPwt\BlogBundle\Entity\TagInterface
  * Cvut\Fit\BiPwt\BlogBundle\Entity\FileInterface
  * Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface
  * Cvut\Fit\BiPwt\BlogBundle\Service\BlogInterface
  * Cvut\Fit\BiPwt\BlogBundle\Service\UserInterface

## Hodnocení
  
Hodnocení úlohy bude provedeno dle míry splnění funkčních požadavků. Celkový výsledek bude určen vztahem:
> (počet splněných funkčních požadavků / celkový počet funkčních požadavků) * maximální počet bodů z úlohy 2.

Úloha bude hodnocena 0 body, pokud bude splněna libovolná z následujících podmínek:

  * Nesplnění nefunkčních požadavků.
  * Úloha je předložena k hodnocení po termínu. Toto neplatí v odůvodněných případech (např. nemoc).
  * Z logu nástroje git není patrná průběžná práce (tj. log bude obsahovat minimum záznamů) bude hodnocena 0 body. Posouzení přísluší osobě vyučujícího!
  * Z logu nástroje git není možno jasně identifikovat osobu (osoby), která(é) prováděla(y) většinu změn. Za vhodnou identifikaci považujeme jméno, příjmení a fakultní e-mailovou adresu.

Přístup do repozitáře musí být povolen pro Deploy Key (Settings -> Deploy Keys):

```
ssh-dss AAAAB3NzaC1kc3MAAACBANpZpTpv/SzJ2CDYPFj8HYZ+K6uKgLgkNEdU/V3H9r7CzWqwyNPei1bjPkpXr4Zow01PwbkjTtQ/jH2GyCwTURJkZBSPuePMGZqgZpfKsrqmrRVBnGmzRTrx6OccHFgvCV02U2yx06AfjEZfPqiJ8OvEFEdsNmVCKU2TmUaDWDexAAAAFQDsaOS9uZYJ5BYIqqwaxXTZUjqzewAAAIA8lNZ+uLdHUmfFdfOch7UXu6M/CC0YiKHX3+GuwYL1+BFBb0lATBNlw0rIk1Opq7O9TJ/fWqj+C5Z4GXPNTIISq2g5azPN+6JiQIl4j84gSrr/rZb1gcSrmKmJQdDBzo1aDecgIIM/qaoQLqMimbpman7A381CKXWva0HMxir3GgAAAIEA1+tRVR9MK454KrOPOm0ORRq8nddPuMh1nVe7sbyFnx88eM1Ovio+t/FSA23u91DP26VlHh3yEI2Zjd3g+TYf0F8hqTnLGjVTSnApturndJC5ZZ960Fu4NFs5tMcg8GMN0L9R/ojUAuoraZkPoISUr0JpdcVhZU7UrH9t7hrwqeE= kadleto2@webdev-fit-01
```

## Termín hodnocení

Termín automatického vyhodnocení bude upřesněn.