# Zendesk API

This module uses CTools plugins to help you interact with the Zendesk API.
Currently there are 2 supported plugins.

This module will also give you new Drupal API's form fields that will allow you
to seamlessly integrate your Zendesk fields in Drupal forms and submit those
forms over to Zendesk.

## Endpoints
The endpoint plugin will help you store your credentials and make calls to the
API.

To submit a form to Zendesk do something like:

```php
…
$body = array(
  'ticket' => array(…),
);
try {
  $ticket = zendesk_api_get_plugin_handler('submit_ticket', 'endpoint');
  $data = $ticket->call('POST', $body);
}
catch (\ZendeskAPIException $e) {
  watchdog_exception('zendesk_forms', $e);
}
```

## Fields
The fields plugin is used by the new _zendesk\_field_ form element to allow you
to use custom fields as defined in Zendesk in Drupal's Form API.

Supported field types are:

  * Options: A select field with options defined in Zendesk. It will also pull
    title and description from Zendesk.
  * Text: A text field that will pull title and description from Zendesk.
