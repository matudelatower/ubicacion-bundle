[![SensioLabsInsight](https://insight.sensiolabs.com/projects/bed70b5b-89fc-487b-bc8a-b48f0bdb079f/mini.png)](https://insight.sensiolabs.com/projects/bed70b5b-89fc-487b-bc8a-b48f0bdb079f)
[![Latest Stable Version](https://poser.pugx.org/matudelatower/ubicacion-bundle/v/stable)](https://packagist.org/packages/matudelatower/ubicacion-bundle)
[![Total Downloads](https://poser.pugx.org/matudelatower/ubicacion-bundle/downloads)](https://packagist.org/packages/matudelatower/ubicacion-bundle)
[![Latest Unstable Version](https://poser.pugx.org/matudelatower/ubicacion-bundle/v/unstable)](https://packagist.org/packages/matudelatower/ubicacion-bundle)
[![License](https://poser.pugx.org/matudelatower/ubicacion-bundle/license)](https://packagist.org/packages/matudelatower/ubicacion-bundle)

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require matudelatower/ubicacion-bundle "^1.0"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Matudelatower\UbicacionBundle\UbicacionBundle(),
        );

        // ...
    }

    // ...
}
```
Step 3: Configure
-------------------------
```yml
# app/config/config.yml

matudelatower_ubicacion:
    base_template: your_layout_base.html.twig
```

Step 4: Update database
-------------------------

```bash
$ php app/console doc:sch:update --dump-sql
```

to dump the SQL statements to the screen


Step 5: Load Fixtures
-------------------------

```bash
$ php app/console doctrine:fixtures:load
```

Step 6: Import UbicacionBundle routing files
-------------------------

```yml
# app/config/routing.yml
ubicacion:
    resource: "@UbicacionBundle/Resources/config/routing.yml"
    prefix:   /ubicacion
```

##Enjoy!

## TODO

- [ ] País, provincia, departamento, localidad dependent combo widget.
