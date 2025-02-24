<?php declare(strict_types=1);
namespace Imbo\EventListener\ImageVariations\Database;

use PDO;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PostgreSQL::class)]
class PostgreSQLIntegrationTest extends DatabaseTests
{
    protected function getAdapter(): PostgreSQL
    {
        return new PostgreSQL(
            (string) getenv('DB_DSN'),
            (string) getenv('DB_USERNAME'),
            (string) getenv('DB_PASSWORD'),
        );
    }

    protected function setUp(): void
    {
        parent::setUp();

        $pdo = new PDO(
            (string) getenv('DB_DSN'),
            (string) getenv('DB_USERNAME'),
            (string) getenv('DB_PASSWORD'),
        );

        $pdo->exec(sprintf('DELETE FROM "%s"', PostgreSQL::IMAGEVARIATIONS_TABLE));
    }
}
