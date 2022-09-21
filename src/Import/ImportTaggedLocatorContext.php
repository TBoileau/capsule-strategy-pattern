<?php

declare(strict_types=1);

namespace App\Import;

use RuntimeException;
use Symfony\Component\DependencyInjection\ServiceLocator;

final class ImportTaggedLocatorContext implements ImportContextInterface
{
    public function __construct(private ServiceLocator $serviceLocator)
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(string $uri): array
    {
        foreach ($this->serviceLocator->getProvidedServices() as $service) {
            if ($service::supports($uri)) {
                return $this->serviceLocator->get($service)->import($uri);
            }
        }

        throw new RuntimeException('No import service found for uri: '.$uri);
    }
}
