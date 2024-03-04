<?php
namespace Fontai;

use Propel\Generator\Builder\Om\ObjectBuilder;
use Propel\Generator\Model\Behavior;
use Propel\Generator\Util\PhpParser;


class FileUploadObjectBuilderModifier
{
  protected $behavior;

  public function __construct(Behavior $behavior)
  {
    $this->behavior = $behavior;
  }

  protected function getParameter($key)
  {
    return $this->behavior->getParameter($key);
  }

  protected function getColumn()
  {
    return $this->behavior->getTable()->getColumn($this->getParameter('column'));
  }

  public function objectAttributes(ObjectBuilder $builder)
  {
    return $this->behavior->renderTemplate('objectAttributes', [
      'column' => $this->getColumn(),
      'uploadDir' => $this->getParameter('upload_dir'),
      'imageFormat' => $this->getParameter('image_format')
    ]);
  }

  public function objectMethods(ObjectBuilder $builder)
  {
    $script  = '';
    $script .= $this->addFileGetter($builder);
    $script .= $this->addFileSetter($builder);
    $script .= $this->addFileMove($builder);
    $script .= $this->addFileDelete($builder);

    return $script;
  }

  public function postSave(ObjectBuilder $builder)
  {
    return $this->behavior->renderTemplate('objectPostSave', [
      'column' => $this->getColumn()
    ]);
  }

  public function postDelete(ObjectBuilder $builder)
  {
    return $this->behavior->renderTemplate('objectPostDelete', [
      'column' => $this->getColumn()
    ]);
  }

  protected function addFileGetter(ObjectBuilder $builder)
  {
    return $this->behavior->renderTemplate('objectFileGetter', [
      'column' => $this->getColumn()
    ]);
  }

  protected function addFileSetter(ObjectBuilder $builder)
  {
    $column = $this->getColumn();
    
    return $this->behavior->renderTemplate('objectFileSetter', [
      'column' => $column,
      'objectClassName' => $builder->getObjectClassName(TRUE),
      'columnConstant' => $builder->getColumnConstant($column)
    ]);
  }

  protected function addFileMove(ObjectBuilder $builder)
  {
    return $this->behavior->renderTemplate('objectFileMove', [
      'column' => $this->getColumn(),
      'localeColumn' => $this->behavior->getI18nLocaleColumn()
    ]);
  }

  protected function addFileDelete(ObjectBuilder $builder)
  {
    return $this->behavior->renderTemplate('objectFileDelete', [
      'column' => $this->getColumn(),
      'objectClassName' => $builder->getObjectClassName(TRUE)
    ]);
  }
}