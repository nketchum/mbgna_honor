<?php

namespace Drupal\mbgna_honor\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the honor entity edit forms.
 */
class HonorForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);

    $entity = $this->getEntity();

    $message_arguments = ['%label' => $entity->toLink()->toString()];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New honor has been created.'));
        $this->logger('mbgna_honor')->notice('Created new honor.');
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The honor has been updated.'));
        $this->logger('mbgna_honor')->notice('Updated honor.');
        break;
    }

    $form_state->setRedirect('entity.honor.canonical', ['honor' => $entity->id()]);

    return $result;
  }

}
