<?php

/**
 * @file
 * Vehicule module (vehicule).
 *
 * This file provide drush commands tasks.
 */

/**
 * Implements hook_drush_command().
 */
function vehicule_drush_command() {
  $items = [];

  // Base.
  $items['vehicule'] = [
    'description' => 'Exemple pour le module vehicule',
  ];

  // Create an entity. Example 01.
  $items['vehicule-type-create'] = [
    'description' => "Crée un entité de type TypeDeVehicule",
  ];


  return $items;
}

/**
 * Call back function of vehicule.
 */
function drush_vehicule() {
  drush_log("Rien à faire !!!", 'cancel');
}

/**
 * Call back function of vehicule.
 */
function drush_vehicule_type_create() {

  try {

    $values = [
      'id' => 'monospace',
      'label' => 'Monospace',
    ];
    $entity = Drupal\vehicule\Entity\TypeDeVehicule::create($values);
    $entity->save();

    drush_log("Un nouveau type est créé", 'ok');
  }
  catch (Exception $ex) {
    drush_log($ex->getMessage(), 'error');
  }
}
