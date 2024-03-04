
/**
 * Gets the <?= $column->getName() ?> file
 *
 * @return \Symfony\Component\HttpFoundation\File\File object
 */
public function get<?= $column->getPhpName() ?>File()
{
  if ($this->uploaded_<?= $column->getName() ?>_file)
  {
    return $this->uploaded_<?= $column->getName() ?>_file;
  }

  if (!$this->get<?= $column->getPhpName() ?>())
  {
    return NULL;
  }

  global $kernel;
  $container = $kernel->getContainer();

  $path = sprintf(
    '%s/%s/%s',
    $container->getParameter('kernel.project_dir'),
    $this->uploadDir_<?= $column->getCamelCaseName() ?>,
    $this->get<?= $column->getPhpName() ?>()
  );
  
  return file_exists($path) ? new \Symfony\Component\HttpFoundation\File\File($path) : NULL;
}
