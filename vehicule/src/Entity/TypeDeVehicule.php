<?php

namespace Drupal\vehicule\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Définit le type d'entité vehicule_type.
 *
 * @ingroup vehicule
 *
 * @ConfigEntityType(
 *   id = "vehicule_type",
 *   label = @Translation("Type De Véhicule"),
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label"
 *   },
 * )
 */
class TypeDeVehicule extends ConfigEntityBase {

  /**
   * L'identifiant de l'entité.
   *
   * @var string
   */
  public $id;

  /**
   * L'identifiant unique (sur le site).
   *
   * @var string
   */
  public $uuid;

  /**
   * Le label.
   *
   * @var string
   */
  public $label;

}
