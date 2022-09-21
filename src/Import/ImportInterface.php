<?php

declare(strict_types=1);

namespace App\Import;

use App\Entity\User;

interface ImportInterface
{
    /**
     * @return array<array-key, User>
     */
    public function import(string $uri): array;

    public static function supports(string $uri): bool;
}
