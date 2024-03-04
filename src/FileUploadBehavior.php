<?php
namespace Fontai;

use Propel\Generator\Model\Behavior;
use Propel\Generator\Model\Column;


class FileUploadBehavior extends Behavior
{
  protected $parameters = [
    'column'       => NULL,
    'upload_dir'   => NULL,
    'image_format' => NULL
  ];

  /**
   * @var FileUploadObjectBuilderModifier|null
   */
  protected $objectBuilderModifier;

  /**
   * @var int
   */
  protected $tableModificationOrder = 255;

  /**
   * @var \Propel\Generator\Model\Column|null
   */
  protected $i18nColumn;

  /**
   * @var \Propel\Generator\Model\Column|null
   */
  protected $i18nLocaleColumn;

  /**
   * Multiple file uploads on the same table is OK.
   *
   * @return bool
   */
  public function allowMultiple()
  {
    return TRUE;
  }

  /**
   * @return \Propel\Generator\Model\Column|null
   */
  public function getI18nColumn()
  {
    return $this->i18nColumn;
  }

  /**
   * @return void
   */
  public function setI18nLocaleColumn(Column $column)
  {
    $this->i18nLocaleColumn = $column;
  }

  /**
   * @return \Propel\Generator\Model\Column|null
   */
  public function getI18nLocaleColumn()
  {
    return $this->i18nLocaleColumn;
  }

  /**
   * @return void
   */
  public function modifyTable()
  {
    $table = $this->getTable();
    
    if ($table->hasBehavior('i18n'))
    {
      $i18nBehavior = $table->getBehavior('i18n');
      $i18nTable = $i18nBehavior->getI18nTable();
      $columnName = $this->getParameter('column');

      if ($i18nTable->hasColumn($columnName))
      {
        $fileUploadBehavior = clone $this;
        $fileUploadBehavior->setTable($i18nTable);
        $fileUploadBehavior->setI18nLocaleColumn($i18nBehavior->getLocaleColumn());

        $i18nTable->addBehavior($fileUploadBehavior);

        $this->i18nColumn = $i18nTable->getColumn($columnName);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getObjectBuilderModifier()
  {
    if (NULL === $this->objectBuilderModifier)
    {
      $this->objectBuilderModifier = $this->i18nColumn ? new FileUploadWithI18nObjectBuilderModifier($this) : new FileUploadObjectBuilderModifier($this);
    }

    return $this->objectBuilderModifier;
  }
}