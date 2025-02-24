<?php declare(strict_types=1);
namespace Imbo\Database;

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
            [
                PDO::ATTR_PERSISTENT => true,
            ],
        );

        $tables = [
            PostgreSQL::IMAGEINFO_TABLE,
            PostgreSQL::SHORTURL_TABLE,
        ];

        foreach ($tables as $table) {
            $pdo->exec(sprintf('DELETE FROM "%s"', $table));
        }
    }
}
