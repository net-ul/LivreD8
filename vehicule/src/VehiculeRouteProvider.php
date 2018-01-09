<?php

namespace Drupal\vehicule;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Routing\EntityRouteProviderInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Gestionnaire des routes.
 */
class VehiculeRouteProvider implements EntityRouteProviderInterface {

  /**
   * {@inheritdoc}
   */
  public function getRoutes(EntityTypeInterface $entity_type) {

    // Nom et l'identifiant de type d'entité.
    $label = "" . $entity_type->getLabel();
    $id = $entity_type->id();

    //Routes.
    $route_collection = new RouteCollection();

    // Canonical, Visualisation des entité.
    if ($entity_type->hasLinkTemplate('canonical')) {
      $route = (new Route($entity_type->getLinkTemplate('canonical')))
        ->setDefault('_entity_view', "$id")
        ->setDefault('_title', $label)
        ->setRequirement('_entity_access', "$id.view");
      $route_collection->add("entity.$id.canonical", $route);
    }

    // Liste.
    if ($entity_type->hasLinkTemplate('collection')) {
      $route = (new Route($entity_type->getLinkTemplate('collection')))
        ->setDefault('_entity_list', $id)
        ->setDefault('_title', "$label list")
        ->setRequirement('_permission', "vehicule view");
      $route_collection->add("entity.$id.collection", $route);
    }

    // Les forms.
    $actions = [
      'edit' => 'Edit',
      'delete' => 'Delete',
    ];
    foreach ($actions as $action => $action_label) {
      $action_form = $action . "-form";
      if ($entity_type->hasLinkTemplate($action_form)) {
        $route = (new Route($entity_type->getLinkTemplate($action_form)))
          ->setDefault('_entity_form', "$id.$action")
          ->setDefault('_title', "$action_label $label")
          ->setRequirement('_entity_access', "$id.$action");
        $route_collection->add("entity.$id.$action"."_form", $route);
      }
    }

    return $route_collection;
  }

}
