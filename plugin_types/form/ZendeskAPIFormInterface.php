<?php

/**
 * @file
 * Contains \ZendeskAPIFormInterface.
 */

interface ZendeskAPIFormInterface {

  /**
   * Gets the Zendesk form ID.
   */
  public function getFormId();

  /**
   * Renders a form array as returned by drupal_get_form.
   *
   * @return array
   *   The renderable form array.
   *
   * @see drupal_get_form().
   */
  public function render();

}
