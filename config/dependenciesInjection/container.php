<?php

// Nouvelle instance du constructeur du conteneur 
    $builder = new DI\ContainerBuilder();

// Ajout des définitions
// Les définitions représentent les dépendences internes dont notre application
    $builder->addDefinitions(__DIR__ . "/dependencies.php");

// Création d'une conteneur grâce à son builder
    $container = $builder->build();

// Dès que ce fichier container sera appelé (require) quelque part,
// il doit nous retourner le conteneur
    return $container;
