<?php

namespace Drupal\owlcarousel\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\owlcarousel\Entity\OwlCarouselStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class OwlCarouselStyleBaseForm
 */
class OwlCarouselStyleBaseForm extends EntityForm {

  /**
   * The Owl carousel style entity storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $owlCarouselStyleStorage;

  /**
   * Constructs a base class for image style add and edit forms.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $owl_carousel_style_storage
   *   The Owl carousel style entity storage.
   */
  public function __construct(EntityStorageInterface $owl_carousel_style_storage) {
    $this->owlCarouselStyleStorage = $owl_carousel_style_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager')->getStorage('owl_carousel_style')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    /** @var OwlCarouselStyle $entity */
    $entity = $this->entity;

    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Image style name'),
      '#default_value' => $entity->label(),
      '#required' => TRUE,
    );
    $form['name'] = array(
      '#type' => 'machine_name',
      '#machine_name' => array(
        'exists' => array($this->owlCarouselStyleStorage, 'load'),
      ),
      '#default_value' => $entity->id(),
      '#required' => TRUE,
    );
    $form['items'] = array(
      '#type' => 'number',
      '#title' => $this->t('Items'),
      '#description' => $this->t('This variable allows you to set the maximum amount of items displayed at a time with the widest browser width'),
      '#default_value' => $entity->getItems(),
      '#required' => TRUE,
    );

    return parent::form($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    parent::save($form, $form_state);
    $form_state->setRedirectUrl($this->entity->urlInfo('collection'));
  }
}
