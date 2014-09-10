<?php

/**
 * @file
 * Contains \ZendeskAPIFieldBase
 */

class ZendeskAPIFieldBase extends \ZendeskAPIPluginBase implements \ZendeskAPIFieldInterface {

  /**
   * @var string
   *
   * The field name in Zendesk.
   */
  protected $name;

  /**
   * @var string
   *
   * The field type in Zendesk.
   */
  protected $type;

  /**
   * @var \ZendeskAPIEndpointInterface
   *
   * The endpoint for the field resource.
   */
  protected $endpoint;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->name;
  }

  /**
   * {@inheritdoc}
   */
  public function getType() {
    return $this->type;
  }

  /**
   * Constructor
   *
   * @param array $plugin
   *   Plugin definition array.
   *
   * @throws \ZendeskAPIException
   *   If there is no URI to get the field info.
   */
  public function __construct(array $plugin) {
    parent::__construct($plugin);

    if (empty($plugin['uri'])) {
      throw new \ZendeskAPIException('Missing URI for the options field endpoint');
    }
  }

  /**
   * {@inheritdoc}
   */
  public function defaults(array &$element) {
    // Set the defaults for the element.
    $info = $this->getPuginInfo();

    if (isset($info['default_value'])) {
      $element['#default_value'] = $info['default_value'];
    }

    // Initialize the default value for the endpoint.
    $endpoint_name = empty($info['endpoint']) ? 'default' : $info['endpoint'];
    if (!empty($element['#zendesk_endpoint'])) {
      $endpoint_name = $element['#zendesk_endpoint'];
    }
    $this->endpoint = zendesk_api_get_plugin_handler($endpoint_name, 'endpoint');
    $this->endpoint->setUri($info['uri']);
  }

  /**
   * {@inheritdoc}
   */
  public function render(array &$element) {
    $field_name = $element['#name'] . '_zendesk_field';
    // Array of properties the field should inherit from the parent.
    $properties = array(
      '#title',
      '#description',
      '#name',
      '#attributes',
    );

    foreach ($properties as $property) {
      if (!empty($element[$property])) {
        $element[$field_name][$property] = $element[$property];
      }
    }

    $field_info = $this->getFieldInfo($element);

    if (!$field_info->ticket_field->active) {
      throw new \ZendeskAPIException(format_string('The field with id @id is not active.', array(
        '@id' => $element['#zendesk_id'],
      )));
    }

    $element[$field_name] += array(
      '#title' => $field_info->ticket_field->title,
      '#description' => $field_info->ticket_field->description,
      '#required' => $field_info->ticket_field->required,
    );

    if (!empty($element['#value'])) {
      $element[$field_name]['#value'] = $element['#value'];
    }
  }

  /**
   * Gets field information from Zendesk.
   *
   * @param array $element
   *   The form element array.
   *
   * @return stdClass
   *   The remote information about the field.
   */
  public function getFieldInfo(array $element) {
    $field_info = &drupal_static(__CLASS__ . '::render::' . $element['#zendesk_id']);

    // Replace {id} placeholder with the actual id.
    $uri = $this->endpoint->getUri();
    if (strpos($uri, '{id}') !== FALSE) {
      $uri = str_replace('{id}', $element['#zendesk_id'], $uri);
      $this->endpoint->setUri($uri);
    }

    if (!isset($field_info)) {
      $cache = cache_get('zendesk::field::' . $element['#zendesk_id']);
      if (isset($cache->data)) {
        $field_info = $cache->data;
      }
      else {
        // Get the field info from Zendesk.
        $field_info = $this->endpoint->call('GET');
        // Set the cache for future calls.
        cache_set('zendesk::field::' . $element['#zendesk_id'], $field_info);
      }
    }

    return $field_info;
  }

}