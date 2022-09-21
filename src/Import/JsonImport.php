<?php

declare(strict_types=1);

namespace App\Import;

use App\Entity\User;

final class JsonImport implements ImportInterface
{
    public function import(string $uri): array
    {
        $json = file_get_contents($uri);

        /** @var array<array-key, array{firstName: string, lastName: string, email: string}> $data */
        $data = json_decode($json, true);

        return array_map(
            static fn (array $user): User => new User($user['firstName'], $user['lastName'], $user['email']),
            $data
        );
    }

    public static function supports(string $uri): bool
    {
        return 'json' === pathinfo($uri, PATHINFO_EXTENSION);
    }
}
