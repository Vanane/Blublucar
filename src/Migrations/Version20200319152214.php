<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200319152214 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE trajet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, conducteur_id INTEGER NOT NULL, point_depart_id INTEGER NOT NULL, point_arrivee_id INTEGER NOT NULL, temps_trajet INTEGER DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, nb_places INTEGER NOT NULL, vehicule VARCHAR(255) NOT NULL, options CLOB DEFAULT NULL --(DC2Type:array)
        , date DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_2B5BA98CF16F4AC6 ON trajet (conducteur_id)');
        $this->addSql('CREATE INDEX IDX_2B5BA98CD2C9B65 ON trajet (point_depart_id)');
        $this->addSql('CREATE INDEX IDX_2B5BA98C36855DE8 ON trajet (point_arrivee_id)');
        $this->addSql('CREATE TABLE destination (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, latitude VARCHAR(255) NOT NULL, longitude VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, posteur_id INTEGER NOT NULL, trajet_id INTEGER NOT NULL, message VARCHAR(255) NOT NULL, note DOUBLE PRECISION NOT NULL, date_post DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_67F068BC9DDC44B3 ON commentaire (posteur_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCD12A823 ON commentaire (trajet_id)');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, trajet_id INTEGER NOT NULL, passager_id INTEGER NOT NULL, paye BOOLEAN NOT NULL, nb_personnes INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_42C84955D12A823 ON reservation (trajet_id)');
        $this->addSql('CREATE INDEX IDX_42C8495571A51189 ON reservation (passager_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE trajet');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE reservation');
    }
}
