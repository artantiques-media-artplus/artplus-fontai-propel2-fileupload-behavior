
protected $uploadDir_<?= $column->getCamelCaseName() ?>    = '<?= $uploadDir ?>';
protected $imageFormat_<?= $column->getCamelCaseName() ?>  = '<?= $imageFormat ?>';

/**
 * The value for the <?= $column->getName() ?> file.
 *
 * @var        \Symfony\Component\HttpFoundation\File\File
 */
protected $uploaded_<?= $column->getName() ?>_file;
