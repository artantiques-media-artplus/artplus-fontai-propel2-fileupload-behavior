
/**
 * Sets the <?= $column->getName() ?> file
 *
 * @param  File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
 *
 * @return $this|<?= $objectClassName ?> The current object (for fluent API support)
 */
public function set<?= $column->getPhpName() ?>File(\Symfony\Component\HttpFoundation\File\UploadedFile $file = NULL)
{
  $this->getCurrentTranslation()->set<?= $column->getPhpName() ?>File($file);

  return $this;
}
