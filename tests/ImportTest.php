<?php

declare(strict_types=1);

namespace App\Tests;

use App\Entity\User;
use App\Import\CsvImport;
use App\Import\ImportContext;
use App\Import\ImportContextInterface;
use App\Import\ImportTaggedIteratorContext;
use App\Import\ImportTaggedLocatorContext;
use App\Import\JsonImport;
use Generator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class ImportTest extends KernelTestCase
{
    /**
     * @dataProvider provideUri
     */
    public function testImportWithTaggedLocator(string $uri): void
    {
        self::bootKernel();

        /** @var ImportContextInterface $importContext */
        $importContext = static::getContainer()->get(ImportTaggedLocatorContext::class);

        $users = $importContext->execute($uri);

        self::assertCount(3, $users);
        self::assertContainsOnlyInstancesOf(User::class, $users);
    }

    /**
     * @dataProvider provideUri
     */
    public function testImportWithTaggedIterator(string $uri): void
    {
        self::bootKernel();

        /** @var ImportContextInterface $importContext */
        $importContext = static::getContainer()->get(ImportTaggedIteratorContext::class);

        $users = $importContext->execute($uri);

        self::assertCount(3, $users);
        self::assertContainsOnlyInstancesOf(User::class, $users);
    }

    /**
     * @dataProvider provideUri
     */
    public function testImport(string $uri): void
    {
        $importContext = (new ImportContext())
            ->register(new CsvImport())
            ->register(new JsonImport());

        $users = $importContext->execute($uri);

        self::assertCount(3, $users);
        self::assertContainsOnlyInstancesOf(User::class, $users);
    }

    public function provideUri(): Generator
    {
        yield 'csv' => [__DIR__.'/Fixtures/users.csv'];
        yield 'json' => [__DIR__.'/Fixtures/users.json'];
    }
}
