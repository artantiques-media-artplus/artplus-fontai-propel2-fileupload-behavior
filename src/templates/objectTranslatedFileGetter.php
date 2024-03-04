
/**
 * Gets the <?= $column->getName() ?> file
 *
 * @return \Symfony\Component\HttpFoundation\File\File object
 */
public function get<?= $column->getPhpName() ?>File()
{
  return $this->getCurrentTranslation()->get<?= $column->getPhpName() ?>File();
}
