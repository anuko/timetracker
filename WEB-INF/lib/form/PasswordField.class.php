<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

import('form.FormElement');

class PasswordField extends FormElement {

  function __construct($name)
  {
    $this->class = 'PasswordField';
    $this->css_class = 'password-field';
    $this->name = $name;
  }

  function getHtml() {
    if ($this->id == '') $this->id = $this->name;

    $html = "\n\t<input type=\"password\"";
    $html .= " class=\"$this->css_class\"";
    $html.= ' id="'.$this->id.'"';
    $html.= ' name="'.$this->name.'"';

    if ($this->size != '')
      $html.= ' size="'.$this->size.'"';

    if ($this->style != '')
      $html.= ' style="'.$this->style.'"';

    if ($this->max_length != '')
      $html.= ' maxlength="'.$this->max_length.'"';

    if ($this->on_change != '')
      $html.= ' onchange="'.$this->on_change.'"';

    $html.= ' value="'.htmlspecialchars($this->getValue()).'"';
    $html.= '>';
    return $html;
  }
}
