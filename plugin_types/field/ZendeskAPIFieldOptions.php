<?php

/**
 * @file
 * Contains \ZendeskAPIFieldOptions
 */

class ZendeskAPIFieldOptions extends \ZendeskAPIFieldBase implements \ZendeskAPIFieldInterface {

  /**
   * Overrides \ZendeskAPIFieldBase::defaults()
   */
  public function render(array &$element) {
    parent::render($element);
    $field_name = $element['#name'] . '_zendesk_field';

    $element[$field_name]['#type'] = 'select';

    $field_info = $this->getFieldInfo($element);

    foreach ($field_info->ticket_field->custom_field_options as $option) {
      $element[$field_name]['#options'][$option->value] = $option->name;
    }
  }

}