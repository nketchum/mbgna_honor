<?php

namespace Drupal\mbgna_honor\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\mbgna_honor\HonorInterface;

/**
 * Defines the honor entity class.
 *
 * @ContentEntityType(
 *   id = "honor",
 *   label = @Translation("Honor"),
 *   label_collection = @Translation("Honors"),
 *   label_singular = @Translation("honor"),
 *   label_plural = @Translation("honors"),
 *   label_count = @PluralTranslation(
 *     singular = "@count honors",
 *     plural = "@count honors",
 *   ),
 *   bundle_label = @Translation("Honor type"),
 *   handlers = {
 *     "list_builder" = "Drupal\mbgna_honor\HonorListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\mbgna_honor\HonorAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\mbgna_honor\Form\HonorForm",
 *       "edit" = "Drupal\mbgna_honor\Form\HonorForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *       "revision" = Drupal\Core\Entity\Routing\RevisionHtmlRouteProvider::class,
 *     }
 *   },
 *   base_table = "honor",
 *   revision_table = "honor_revision",
 *   show_revision_ui = TRUE,
 *   admin_permission = "administer honor types",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "revision_id",
 *     "bundle" = "bundle",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   revision_metadata_keys = {
 *     "revision_user" = "revision_uid",
 *     "revision_created" = "revision_timestamp",
 *     "revision_log_message" = "revision_log",
 *   },
 *   links = {
 *     "collection" = "/admin/content/honor",
 *     "add-form" = "/honor/add/{honor_type}",
 *     "add-page" = "/honor/add",
 *     "canonical" = "/honor/{honor}",
 *     "edit-form" = "/honor/{honor}/edit",
 *     "delete-form" = "/honor/{honor}/delete",
 *     "version-history" = "/resource/{resource}/revisions",
 *     "revision" = "/resource/{resource}/revisions/{resource_revision}/view",
 *     "revision_revert" = "/resource/{resource}/revisions/{resource_revision}/revert",
 *     "revision_delete" = "/resource/{resource}/revisions/{resource_revision}/delete",
 *   },
 *   bundle_entity_type = "honor_type",
 *   field_ui_base_route = "entity.honor_type.edit_form",
 * )
 */
class Honor extends RevisionableContentEntityBase implements HonorInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['label'] = BaseFieldDefinition::create('string')
      ->setRevisionable(TRUE)
      ->setLabel(t('Label'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setRevisionable(TRUE)
      ->setLabel(t('Status'))
      ->setDefaultValue(TRUE)
      ->setSetting('on_label', 'Enabled')
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => FALSE,
        ],
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'label' => 'above',
        'weight' => 0,
        'settings' => [
          'format' => 'enabled-disabled',
        ],
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Authored on'))
      ->setDescription(t('The time that the honor was created.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the honor was last edited.'));

    return $fields;
  }

}
