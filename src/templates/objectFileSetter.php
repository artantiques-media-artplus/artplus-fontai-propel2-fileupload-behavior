
/**
 * Sets the <?= $column->getName() ?> file
 *
 * @param  File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
 *
 * @return $this|<?= $objectClassName ?> The current object (for fluent API support)
 */
public function set<?= $column->getPhpName() ?>File(\Symfony\Component\HttpFoundation\File\UploadedFile $file = NULL)
{
  $this->uploaded_<?= $column->getName() ?>_file = $file;
  $this->modifiedColumns[<?= $columnConstant ?>] = true;

  return $this;
}
