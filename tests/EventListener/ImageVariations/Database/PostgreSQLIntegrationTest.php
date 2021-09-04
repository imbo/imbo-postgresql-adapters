<?php declare(strict_types=1);
namespace Imbo\EventListener\ImageVariations\Database;

use PDO;

/**
 * @coversDefaultClass Imbo\EventListener\ImageVariations\Database\PostgreSQL
 */
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

        $pdo->query(sprintf('DELETE FROM "%s"', PostgreSQL::IMAGEVARIATIONS_TABLE));
    }
}
