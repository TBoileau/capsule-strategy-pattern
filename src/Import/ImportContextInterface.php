<?php

declare(strict_types=1);

namespace App\Import;

use App\Entity\User;

interface ImportContextInterface
{
    /**
     * @return array<array-key, User>
     */
    public function execute(string $uri): array;
}
