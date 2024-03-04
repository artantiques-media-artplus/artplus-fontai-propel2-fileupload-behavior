
/**
 * Deletes the <?= $column->getName() ?> file
 *
 * @return $this|<?= $objectClassName ?> The current object (for fluent API support)
 */
public function delete<?= $column->getPhpName() ?>File()
{
  if ($this->get<?= $column->getPhpName() ?>())
  {
    global $kernel;
    $container = $kernel->getContainer();

    $path = sprintf(
      '%s/%s/%s',
      $container->getParameter('kernel.project_dir'),
      $this->uploadDir_<?= $column->getCamelCaseName() ?>,
      $this->get<?= $column->getPhpName() ?>()
    );
    
    if (file_exists($path))
    {
      unlink($path);
    }
  }

  return $this;
}
