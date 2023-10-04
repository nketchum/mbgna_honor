<?php

namespace Drupal\mbgna_honor\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Honor type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "honor_type",
 *   label = @Translation("Honor type"),
 *   label_collection = @Translation("Honor types"),
 *   label_singular = @Translation("honor type"),
 *   label_plural = @Translation("honors types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count honors type",
 *     plural = "@count honors types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\mbgna_honor\Form\HonorTypeForm",
 *       "edit" = "Drupal\mbgna_honor\Form\HonorTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\mbgna_honor\HonorTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   admin_permission = "administer honor types",
 *   bundle_of = "honor",
 *   config_prefix = "honor_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/honor_types/add",
 *     "edit-form" = "/admin/structure/honor_types/manage/{honor_type}",
 *     "delete-form" = "/admin/structure/honor_types/manage/{honor_type}/delete",
 *     "collection" = "/admin/structure/honor_types"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   }
 * )
 */
class HonorType extends ConfigEntityBundleBase {

  /**
   * The machine name of this honor type.
   *
   * @var string
   */
  protected $id;

  /**
   * The human-readable name of the honor type.
   *
   * @var string
   */
  protected $label;

}
