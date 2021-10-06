<?php namespace ProcessWire;

/**
 * Session Viewer for ProcessWire
 * Description...
 *
 * @author tech-c.net
 * @license Licensed under GNU/GPL v2
 * @link https://tech-c.net/posts/session-viewer-for-processwire/
 * @version 1.0.0
 * 
 * @see Forum Thread: https://processwire.com/talk/topic/.../
 * @see Donate: https://www.paypal.me/techcnet/
 */

class SessionViewerConfig extends ModuleConfig {
  /**
   * Get default configuration, automatically passed to input fields.
   * @return array
   */
  public function getDefaults() {
    return array(
      'row_limit' => 100,
      'time_format' => 'Y-m-d H:i:s',
      'time_zone' => 'UTC',
      'asort' => 0,
      'use_nicer' => 1
    );
  }
  /**
   * Render input fields on config Page.
   * @return string
   */
  public function getInputfields() {
    $fields = parent::getInputfields();

    $field = $this->modules->get('InputfieldSelect');
    $field->name = 'row_limit';
    $field->label = __('Row limit');
    $field->description = __('Number of rows visible per page.');
    $field->required = true;
    $field->addOptions(array(
      '10' => '10',
      '20' => '20',
      '25' => '25',
      '50' => '50', 
      '75' => '75', 
      '100' => '100',
      '250' => '250',
      '500' => '500',
      '750' => '750',
      '1000' => '1000'
    ));
    $fields->add($field);

    $dt = new \DateTime();
    $field = $this->modules->get('InputfieldSelect');
    $field->name = 'time_format';
    $field->label = __('Date and time format');
    $field->description = __('Format of the displayed date and time.');
    $field->required = true;
    $field->addOptions(array(
      'Y-m-d H:i:s' => $dt->format('Y-m-d H:i:s'),
      'd.m.Y H:i:s' => $dt->format('d.m.Y H:i:s'),
      'j. M Y H:i:s' => $dt->format('j. M Y H:i:s'),
      'j. F Y H:i:s' => $dt->format('j. F Y H:i:s'),
      'M j. Y H:i:s' => $dt->format('M j. Y H:i:s'),
      'F j. Y H:i:s' => $dt->format('F j. Y H:i:s'),
      'm/d/Y H:i:s' => $dt->format('m/d/Y H:i:s'),
      'd/m/Y H:i:s' => $dt->format('d/m/Y H:i:s'),
      'Y-m-d h:i:s A' => $dt->format('Y-m-d h:i:s A'),
      'd.m.Y h:i:s A' => $dt->format('d.m.Y h:i:s A'),
      'j. M Y h:i:s A' => $dt->format('j. M Y h:i:s A'),
      'j. F Y h:i:s A' => $dt->format('j. F Y h:i:s A'),
      'M j. Y h:i:s A' => $dt->format('M j. Y h:i:s A'),
      'F j. Y h:i:s A' => $dt->format('F j. Y h:i:s A'),
      'm/d/Y h:i:s A' => $dt->format('m/d/Y h:i:s A'),
      'd/m/Y h:i:s A' => $dt->format('d/m/Y h:i:s A')
    ));
    $fields->add($field);

    $timezoneIdentifiers = \DateTimeZone::listIdentifiers();
    $utcTime = new \DateTime(null, new \DateTimeZone('UTC'));
    $timezones = array();
    foreach ($timezoneIdentifiers as $timezoneIdentifier) {
      $currentTimezone = new \DateTimeZone($timezoneIdentifier);
      $sign = ((int)$currentTimezone->getOffset($utcTime) > 0) ? '+' : '-';
      $offset = gmdate('H:i', abs((int)$currentTimezone->getOffset($utcTime)));
      $timezones[$timezoneIdentifier] = 'UTC '.$sign.' '.$offset.' '.str_replace('_', ' ', $timezoneIdentifier);
    }
    $field = $this->modules->get('InputfieldSelect');
    $field->name = 'time_zone';
    $field->label = __('Timezone');
    $field->description = __('Timezone of the displayed date and time.');
    $field->required = true;
    $field->addOptions($timezones);
    $fields->add($field);

    $field = $this->modules->get('InputfieldCheckbox');
    $field->name = 'asort';
    $field->label = __('Sort ascending');
    $field->label2 = __('Enable');
    $field->description = __('Sorts the files by last changed time ascending.');
    $field->attr('name', 'asort');
    $fields->add($field);

    $field = $this->modules->get('InputfieldCheckbox');
    $field->name = 'use_nicer';
    $field->label = __('Use nice_r()');
    $field->label2 = __('Enable');
    $field->description = __('Use nice_r() to display the session data.');
    $field->attr('name', 'use_nicer');
    $fields->add($field);

    $field = $this->modules->get('InputfieldMarkup');
    $field->value = '<p style="text-align:center">'.__('This module uses:').' <a target="_blank" href="https://github.com/uuf6429/nice_r">nice_r()</a></p><p style="text-align:center">Session Viewer @ <a href="https://modules.processwire.com/modules/session-viewer/">processwire.com</a><br>Session Viewer @ <a href="https://github.com/techcnet/SessionViewer">github.com</a><br>Session Viewer @ <a href="https://tech-c.net/posts/session-viewer-for-processwire/">tech-c.net</a></p><a target="_blank" href="https://www.paypal.me/techcnet/"><img style="margin:auto;" src="'.wire('config')->urls->siteModules.'SessionViewer'.'/donate.png" /></a>';
    $field->collapsed = Inputfield::collapsedNever;
    $fields->add($field);

    return $fields;
  }
}