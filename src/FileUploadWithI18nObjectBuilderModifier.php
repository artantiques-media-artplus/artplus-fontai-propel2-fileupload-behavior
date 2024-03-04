<?php
namespace Fontai;

use Propel\Generator\Builder\Om\ObjectBuilder;
use Propel\Generator\Model\Behavior;
use Propel\Generator\Util\PhpParser;


class FileUploadWithI18nObjectBuilderModifier
{
  protected $behavior;

  public function __construct(Behavior $behavior)
  {
    $this->behavior = $behavior;
  }

  protected function getColumn()
  {
    return $this->behavior->getI18nColumn();
  }

  public function objectMethods(ObjectBuilder $builder)
  {
    $column = $this->behavior->getI18nColumn();

    $script  = '';
    $script .= $this->addTranslatedFileGetter($builder);
    $script .= $this->addTranslatedFileSetter($builder);

    return $script;
  }

  protected function addTranslatedFileGetter(ObjectBuilder $builder)
  {
    return $this->behavior->renderTemplate('objectTranslatedFileGetter', [
      'column' => $this->getColumn()
    ]);
  }

  protected function addTranslatedFileSetter(ObjectBuilder $builder)
  {
    return $this->behavior->renderTemplate('objectTranslatedFileSetter', [
      'column' => $this->getColumn(),
      'objectClassName' => $builder->getObjectClassName(TRUE)
    ]);
  }
}