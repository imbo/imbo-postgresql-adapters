<?php declare(strict_types=1);
namespace Imbo\Database;

use PDO;

/**
 * @coversDefaultClass Imbo\Database\PostgreSQL
 */
class PostgreSQLIntegrationTest extends DatabaseTests
{
    private PDO $pdo;

    protected function insertImage(array $image): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO imageinfo (
                user, imageIdentifier, size, extension, mime, added, updated, width, height,
                checksum, originalChecksum
            ) VALUES (
                :user, :imageIdentifier, :size, :extension, :mime, :added, :updated, :width,
                :height, :checksum, :originalChecksum
            )
        ");
        $stmt->execute([
            ':user'             => $image['user'],
            ':imageIdentifier'  => $image['imageIdentifier'],
            ':size'             => $image['size'],
            ':extension'        => $image['extension'],
            ':mime'             => $image['mime'],
            ':added'            => $image['added'],
            ':updated'          => $image['updated'],
            ':width'            => $image['width'],
            ':height'           => $image['height'],
            ':checksum'         => $image['checksum'],
            ':originalChecksum' => $image['originalChecksum'],
        ]);
    }

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

        $this->pdo = new PDO(
            (string) getenv('DB_DSN'),
            (string) getenv('DB_USERNAME'),
            (string) getenv('DB_PASSWORD'),
        );

        $tables = [
            PostgreSQL::IMAGEINFO_TABLE,
            PostgreSQL::SHORTURL_TABLE,
        ];

        foreach ($tables as $table) {
            $this->pdo->query(sprintf('DELETE FROM "%s"', $table));
        }
    }
}
