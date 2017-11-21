<?php

namespace Drupal\vehicule\Entity;

use Drupal\Core\Entity\ContentEntityBase;

/**
 * Définit le type d'entité vehicule.
 *
 * @ingroup vehicule
 *
 * @ContentEntityType(
 *   id = "vehicule",
 *   label = @Translation("Véhicule"),
 *   entity_keys = {
 *     "id" = "id",
 *   },
 * )
 */
class Vehicule extends ContentEntityBase {

}
