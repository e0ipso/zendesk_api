<?php

/**
 * @file
 * Contains \ZendeskAPIFieldText
 */

class ZendeskAPIFieldText extends \ZendeskAPIFieldBase implements \ZendeskAPIFieldInterface {

  /**
   * Overrides \ZendeskAPIFieldBase::defaults()
   */
  public function render(array &$element) {
    parent::render($element);
    $field_name = $element['#name'] . '_zendesk_field';

    $element[$field_name]['#type'] = 'textfield';
  }

}