
/**
 * Moves the uploaded <?= $column->getName() ?> file
 *
 * @return void
 */
protected function moveUploaded<?= $column->getPhpName() ?>File()
{
  if (!$this->uploaded_<?= $column->getName() ?>_file)
  {
    return;
  }

  global $kernel;
  $container = $kernel->getContainer();
  
  $fileName = $this->getId()<?php if ($localeColumn): ?> . '_' . $this->get<?= $localeColumn->getPhpName() ?>()<?php endif; ?> . '.' . $this->uploaded_<?= $column->getName() ?>_file->guessExtension();

  $this->uploaded_<?= $column->getName() ?>_file->move(
    sprintf('%s/%s', $container->getParameter('kernel.project_dir'), $this->uploadDir_<?= $column->getCamelCaseName() ?>),
    $fileName
  );

  $this->set<?= $column->getPhpName() ?>($fileName);
  $this->uploaded_<?= $column->getName() ?>_file = NULL;
  
  $this->save();
}
