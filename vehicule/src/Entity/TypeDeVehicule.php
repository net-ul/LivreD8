<?php

namespace Drupal\vehicule\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

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
 *   bundle_of = "vehicule",
 * )
 */
class TypeDeVehicule extends ConfigEntityBundleBase {

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
