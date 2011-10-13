<?php

/**
 * Product form.
 *
 * @package    form
 * @subpackage Product
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ProductForm extends BaseProductForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['slug']);
  }
}