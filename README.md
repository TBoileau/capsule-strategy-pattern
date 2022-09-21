# Capsule PHP Symfony - Design Pattern Strategy

## Installation
```
git clone git@github.com:TBoileau/capsule-strategy-pattern.git
composer install
```

## Execution
```
bin/phpunit
```

Vous regarder le fichier `var/coverage/junit.xml` pour vérifier les temps d'exécution.

## Explication
Nous avons mis en place 3 implémentations du pattern **Strategy**.

### Implémentation du pattern en PHP pur.

Avantage : 
* Très rapide.

Inconvénients :
* Déclarer et enregistrer chaque stratégie dans le contexte.
* Si nos stratégies possèdent des dépendances, on doit toutes les gérer à la main.

Exemple d'utilisation :
* Classe : [ImportContext](src/Import/ImportContext.php)
* Test : [ImportTest::testImport](tests/ImportTest.php#L54-L64)

### Implémentation du pattern en utilisant la notion de `tagged_iterator`

Avantages :
* Relativement rapide.
* Ne nécessite pas de déclarer les stratégies. (Utilisation du [`_instanceof`](config/services.yaml#L15-L17))

Inconvénients :
* Le contexte reçoit une liste de stratégies déjà instanciées.

Exemple d'utilisation :
* Déclaration des services [services.yaml](config/services.yaml#L26-L28)
* Classe : [ImportTaggedIteratorContext](src/Import/ImportTaggedIteratorContext.php)
* Test : [ImportTest::testImportWithTaggedIterator](tests/ImportTest.php#L38-L49)


### Implémentation du pattern en utilisant la notion de `tagged_locator`

Avantages :
* Ne nécessite pas de déclarer les stratégies. (Utilisation du [`_instanceof`](config/services.yaml#L15-L17))
* Instancie la stratégie que lorsqu'elle est demandée.

Inconvénients :
* Moins rapide que les précédents. 

Exemple d'utilisation :
* Déclaration des services [services.yaml](config/services.yaml#L30-L32)
* Classe : [ImportTaggedLocatorContext](src/Import/ImportTaggedLocatorContext.php)
* Test : [ImportTest::testImportWithTaggedLocator](tests/ImportTest.php#L22-L33)
