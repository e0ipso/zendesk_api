<?php

$plugin = array(
  'label' => t('Field example'),
  'name' => 'field_example',
  'description' => t('Example of a field plugin with commented options.'),
  // This will load the class (ending with .class.php) whithout having to
  // declare it to the autoloader in the .info file. The class should implement
  // \ZendeskAPIFieldInterface (and probably extends \ZendeskAPIFieldBase).
  'class' => 'ZendeskAPIFieldFoo',
  // The default value when building the form element. This is used in
  // \ZendeskAPIFieldInterface::defaults(). If you need some custom/complex
  // logic overwrite that function.
  'default_value' => 'foo',
  // Relative path for the API to call. Use {id} to be replaced at runtime by
  // the field ID as specified in #zendesk_id in your form element.
  'uri' => 'v2/foo/{id}.json',
  // Endpoint (optional). The name of the endpoint plugin to use. It can be
  // overridden in a field basis using #zendesk_uri.
  'endpoint' => 'bar',
);
