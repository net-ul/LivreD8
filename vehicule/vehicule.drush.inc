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

  // Entity update operations.
  $items['vehicule'] = [
    'description' => 'Exemple pour le module vehicule',
  ];

  return $items;
}

/**
 * Call back function of vehicule.
 */
function drush_vehicule() {

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
