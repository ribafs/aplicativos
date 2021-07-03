<?php namespace Visiosoft\MultipleFieldType\Support\Config;

use Anomaly\SelectFieldType\SelectFieldType;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

class RelatedHandler
{

    /**
     * Handle the options.
     *
     * @param SelectFieldType           $fieldType
     * @param StreamRepositoryInterface $streams
     */
    public function handle(SelectFieldType $fieldType, StreamRepositoryInterface $streams)
    {
        $options = [];

        /* @var StreamInterface as $stream */
        foreach ($streams->visible() as $stream) {

            $addon = ucwords(str_replace('_', ' ', $stream->getNamespace()));

            $model = $stream->getEntryModelName();

            array_set($options, "{$addon}.{$model}", $stream->getName());
        }

        foreach ($options as $namespace) {
            ksort($namespace);
        }

        ksort($options);

        $fieldType->setOptions($options);
    }
}
