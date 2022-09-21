<?php

declare(strict_types=1);

namespace App\Import;

use RuntimeException;

final class ImportTaggedIteratorContext implements ImportContextInterface
{
    public function __construct(private iterable $imports)
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(string $uri): array
    {
        foreach ($this->imports as $import) {
            if ($import::supports($uri)) {
                return $import->import($uri);
            }
        }

        throw new RuntimeException('No import service found for uri: '.$uri);
    }
}
