<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250111074257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album_track (album_id INT NOT NULL, track_id INT NOT NULL, PRIMARY KEY(album_id, track_id))');
        $this->addSql('CREATE INDEX IDX_A05BB2801137ABCF ON album_track (album_id)');
        $this->addSql('CREATE INDEX IDX_A05BB2805ED23C43 ON album_track (track_id)');
        $this->addSql('CREATE TABLE artist_track (artist_id INT NOT NULL, track_id INT NOT NULL, PRIMARY KEY(artist_id, track_id))');
        $this->addSql('CREATE INDEX IDX_B6EFC8F5B7970CF8 ON artist_track (artist_id)');
        $this->addSql('CREATE INDEX IDX_B6EFC8F55ED23C43 ON artist_track (track_id)');
        $this->addSql('CREATE TABLE playlist (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE playlist_track (playlist_id INT NOT NULL, track_id INT NOT NULL, PRIMARY KEY(playlist_id, track_id))');
        $this->addSql('CREATE INDEX IDX_75FFE1E56BBD148 ON playlist_track (playlist_id)');
        $this->addSql('CREATE INDEX IDX_75FFE1E55ED23C43 ON playlist_track (track_id)');
        $this->addSql('ALTER TABLE album_track ADD CONSTRAINT FK_A05BB2801137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE album_track ADD CONSTRAINT FK_A05BB2805ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE artist_track ADD CONSTRAINT FK_B6EFC8F5B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE artist_track ADD CONSTRAINT FK_B6EFC8F55ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE playlist_track ADD CONSTRAINT FK_75FFE1E56BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE playlist_track ADD CONSTRAINT FK_75FFE1E55ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE track DROP track_number');
        $this->addSql('ALTER TABLE track DROP duration_ms');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE album_track DROP CONSTRAINT FK_A05BB2801137ABCF');
        $this->addSql('ALTER TABLE album_track DROP CONSTRAINT FK_A05BB2805ED23C43');
        $this->addSql('ALTER TABLE artist_track DROP CONSTRAINT FK_B6EFC8F5B7970CF8');
        $this->addSql('ALTER TABLE artist_track DROP CONSTRAINT FK_B6EFC8F55ED23C43');
        $this->addSql('ALTER TABLE playlist_track DROP CONSTRAINT FK_75FFE1E56BBD148');
        $this->addSql('ALTER TABLE playlist_track DROP CONSTRAINT FK_75FFE1E55ED23C43');
        $this->addSql('DROP TABLE album_track');
        $this->addSql('DROP TABLE artist_track');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE playlist_track');
        $this->addSql('ALTER TABLE track ADD track_number INT NOT NULL');
        $this->addSql('ALTER TABLE track ADD duration_ms INT NOT NULL');
    }
}
