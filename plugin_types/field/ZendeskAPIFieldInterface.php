<?php

/**
 * @file
 * Contains \ZendeskAPIFieldInterface.
 */

interface ZendeskAPIFieldInterface {

  /**
   * Gets the name of the field.
   *
   * @return string
   *   The field name.
   */
  public function getName();

  /**
   * Gets the type of the field.
   *
   * @return string
   *   The field type
   */
  public function getType();

  /**
   * Adds defaults to the field.
   *
   * @param array
   *   The element array passed in by reference.
   */
  public function defaults(array &$element);

  /**
   * Adds the rendering information on the element array.
   *
   * @param array
   *   The element array passed in by reference.
   */
  public function render(array &$element);

}
