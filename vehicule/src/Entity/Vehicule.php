<?php

namespace Drupal\vehicule\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Définit le type d'entité vehicule.
 *
 * @ingroup vehicule
 *
 * @ContentEntityType(
 *   id = "vehicule",
 *   label = @Translation("Véhicule"),
 *   handlers = {
 *     "access" = "Drupal\vehicule\VehiculeAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\vehicule\VehiculeRouteProvider",
 *     },
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "list_builder" = "Drupal\Core\Entity\EntityListBuilder",
 *     "form" = {
 *       "default" = "Drupal\Core\Entity\ContentEntityForm",
 *       "add" = "Drupal\Core\Entity\ContentEntityForm",
 *       "edit" = "Drupal\Core\Entity\ContentEntityForm",
 *     },
 *   },
 *   admin_permission = "vehicule admin",
 *   base_table = "vehicule",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "label" = "immatriculation",
 *     "numeroserie" = "numeroserie",
 *   }, 
 *   field_ui_base_route = "entity.vehicule.settings",
 *   links = {
 *     "canonical" = "/vehicule/{vehicule}",
 *     "add-form" = "/vehicule/add",
 *     "edit-form" = "/vehicule/{vehicule}/edit",
 *     "collection" = "/vehicule/list"
 *   },
 * )
 */
class Vehicule extends ContentEntityBase {
  
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    // Ajout des champs géré par defaut par la classe ContentEntityBase.
    $fields = parent::baseFieldDefinitions($entity_type);

    // Pour l'exemple, le Label est le numero d'immatriculation.
    if ($entity_type->hasKey('label')) {
      $fields[$entity_type->getKey('label')] = BaseFieldDefinition::create('string')
        ->setLabel(t('Immatriculation'))
        // Ce champ est obligatoire.
        ->setRequired(TRUE)
        ->setTranslatable(TRUE)
        ->setDescription(t('Le numero d\'immatriculation.'))
        ->setSettings([
          'max_length' => 16,
          'text_processing' => 0,
        ])
        ->setDisplayOptions('form', ['type' => 'string'])
        ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string']);
    }

    // Note : Contrairement aux exemples, pour les chaine de caractére comme label ou description, 
    // Le bonne pratique est d'utiliser la fonction t() ou TranslatableMarkup (new Drupal\Core\StringTranslation\TranslatableMarkup()) et écrire en anglais.
    // 
    // 
    //string : Une chain de caractères courte.
    // Ce type est idéale si la taill est relativement courte (par exemple inférieur à 128 caractères). Selon les context on peut l'utiliser pour des text meme supérieure à 1000 caractères.
    // ATTENTION : Si vous utilisez le champ comme un indice, il faut etre compatible avec la base de données.
    // Exemple : Numero de serie du vehicule.
    $fields['numeroserie'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Numero de serie')) // Le libellé du champ.
      ->setRequired(TRUE)
      // Nombres de caractères maximum.
      ->setSetting('max_length', 65)
      ->setDisplayOptions('form', ['type' => 'string'])
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string']);

    //string_long : Un texte ou une chaîne de caractères long.
    // Sur MySQL, cela utilise le type 'longtext' par conséquent on peut mettre jusqu'à 4GO de données.
    $fields['description'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Description'))
      ->setTranslatable(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'string_textarea',
        'weight' => 10,
        'settings' => ['rows' => 4],
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ])
      // NOTE : les paramétrage setDisplayOptions() et setDisplayConfigurable() sont optionnelle, plus de détails sur la partie gestionnaires. 
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // boolean Un booléen comme Oui/Non, Vrai/Faux ....
    $fields['clim'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Véhicule climatisé'))
      ->setDisplayOptions('form', ['type' => 'boolean_checkbox']);

    //integer : Un entier.
    // Sur MySQL, cela utilise le type 'int'
    $fields['nombrepassager'] = BaseFieldDefinition::create('integer')
      ->setLabel(new TranslatableMarkup('Nombre de passager'))
      // Indique que l'entier est signé ou pas.
      ->setSetting('unsigned', TRUE);

    //decimal : Un nombre décimale.
    // Sur MySQL, cela ulilise le type 'decimal'
    $fields['kilometrage'] = BaseFieldDefinition::create('decimal')
      ->setLabel(new TranslatableMarkup('Kilométrage'))
      ->setDefaultValue(0) // Definire la valeur par défaut.
      ->setDescription(t('En Km, Par exemple : 1000.1'));

    //float : Un nombre flottant.
    // Sur MySQL, cela ulilise le type 'float'
    $fields['poids'] = BaseFieldDefinition::create('float')
      ->setLabel(new TranslatableMarkup('Poids du vehicule'))
      ->setDescription(t('En Kg, Par exemple : 500.123'));

    //timestamp : Date et l'heur au format UNIX.
    $fields['daterevision'] = BaseFieldDefinition::create('timestamp')
      ->setLabel(t('Date de dernier revision'));

    //datetime : Date au format ISO 8601.
    $fields['dateachat'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Date de mise en circulation'))
      ->setSetting('datetime_type', 'date')
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'datetime_default',
        'settings' => ['format_type' => 'medium'],
      ])
      ->setDisplayOptions('form', ['type' => 'datetime'])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    //email : Un adresse e-mail.
    $fields['email'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Email'))
      ->setDisplayOptions('form', [
      'type' => 'email',
    ]);

    //list_string  : Une liste de sélection.
    //Energie
    $fields['energie'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Type de l\'energie'))
      ->setSettings([
        'default_value' => 'essence',
        'allowed_values' => [
          'essence' => 'Essence',
          'diesel' => 'diesel',
          'electrique' => 'electrique',
        ],
      ])
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string' ])
      ->setDisplayOptions('form', ['type' => 'options_select']);

    //entity_reference : Référencement d’un entité.
    // Pour l'exemple, on référence les termes de taxonomie 'tags'.
    $fields['tags'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Les tags'))
      ->setCardinality(BaseFieldDefinition::CARDINALITY_UNLIMITED)
      ->setSetting('target_type', 'taxonomy_term')
      ->setSetting('handler_settings', [
        'target_bundles' => [
          'tags' => 'tags'
        ]
        ]
      )
      ->setDisplayOptions('view', ['label' => 'above',
      ])
      ->setDisplayOptions('form', ['type' => 'entity_reference_autocomplete',
      'settings' => [
        'match_operator' => 'CONTAINS',
        'size' => 60,
        'placeholder' => 'Les termes',
      ],
    ]);

    //map : Un objet sérialisable.
    $fields['data'] = BaseFieldDefinition::create('map')
      ->setLabel(new TranslatableMarkup('Data'));
    
    return $fields;
  }

}
