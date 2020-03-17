<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317143953 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_2B5BA98CF16F4AC6');
        $this->addSql('DROP INDEX IDX_2B5BA98CD2C9B65');
        $this->addSql('DROP INDEX IDX_2B5BA98C36855DE8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__trajet AS SELECT id, conducteur_id, point_depart_id, point_arrivee_id, temps_trajet, prix, nb_places, vehicule, options, date FROM trajet');
        $this->addSql('DROP TABLE trajet');
        $this->addSql('CREATE TABLE trajet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, conducteur_id INTEGER NOT NULL, point_depart_id INTEGER NOT NULL, point_arrivee_id INTEGER NOT NULL, temps_trajet INTEGER DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, nb_places INTEGER NOT NULL, vehicule VARCHAR(255) NOT NULL COLLATE BINARY, options CLOB DEFAULT NULL --(DC2Type:array)
        , date DATE NOT NULL, CONSTRAINT FK_2B5BA98CF16F4AC6 FOREIGN KEY (conducteur_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2B5BA98CD2C9B65 FOREIGN KEY (point_depart_id) REFERENCES destination (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2B5BA98C36855DE8 FOREIGN KEY (point_arrivee_id) REFERENCES destination (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO trajet (id, conducteur_id, point_depart_id, point_arrivee_id, temps_trajet, prix, nb_places, vehicule, options, date) SELECT id, conducteur_id, point_depart_id, point_arrivee_id, temps_trajet, prix, nb_places, vehicule, options, date FROM __temp__trajet');
        $this->addSql('DROP TABLE __temp__trajet');
        $this->addSql('CREATE INDEX IDX_2B5BA98CF16F4AC6 ON trajet (conducteur_id)');
        $this->addSql('CREATE INDEX IDX_2B5BA98CD2C9B65 ON trajet (point_depart_id)');
        $this->addSql('CREATE INDEX IDX_2B5BA98C36855DE8 ON trajet (point_arrivee_id)');
        $this->addSql('DROP INDEX IDX_42C84955D12A823');
        $this->addSql('DROP INDEX IDX_42C8495571A51189');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reservation AS SELECT id, trajet_id, passager_id, paye, nb_personnes FROM reservation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, trajet_id INTEGER NOT NULL, passager_id INTEGER NOT NULL, paye BOOLEAN NOT NULL, nb_personnes INTEGER NOT NULL, CONSTRAINT FK_42C84955D12A823 FOREIGN KEY (trajet_id) REFERENCES trajet (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_42C8495571A51189 FOREIGN KEY (passager_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reservation (id, trajet_id, passager_id, paye, nb_personnes) SELECT id, trajet_id, passager_id, paye, nb_personnes FROM __temp__reservation');
        $this->addSql('DROP TABLE __temp__reservation');
        $this->addSql('CREATE INDEX IDX_42C84955D12A823 ON reservation (trajet_id)');
        $this->addSql('CREATE INDEX IDX_42C8495571A51189 ON reservation (passager_id)');
        $this->addSql('DROP INDEX IDX_67F068BC9DDC44B3');
        $this->addSql('DROP INDEX IDX_67F068BCD12A823');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, posteur_id, trajet_id, message, note FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, posteur_id INTEGER NOT NULL, trajet_id INTEGER NOT NULL, message VARCHAR(255) NOT NULL COLLATE BINARY, note DOUBLE PRECISION NOT NULL, CONSTRAINT FK_67F068BC9DDC44B3 FOREIGN KEY (posteur_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_67F068BCD12A823 FOREIGN KEY (trajet_id) REFERENCES trajet (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaire (id, posteur_id, trajet_id, message, note) SELECT id, posteur_id, trajet_id, message, note FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC9DDC44B3 ON commentaire (posteur_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCD12A823 ON commentaire (trajet_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_67F068BC9DDC44B3');
        $this->addSql('DROP INDEX IDX_67F068BCD12A823');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, posteur_id, trajet_id, message, note FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, posteur_id INTEGER NOT NULL, trajet_id INTEGER NOT NULL, message VARCHAR(255) NOT NULL, note DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO commentaire (id, posteur_id, trajet_id, message, note) SELECT id, posteur_id, trajet_id, message, note FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC9DDC44B3 ON commentaire (posteur_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCD12A823 ON commentaire (trajet_id)');
        $this->addSql('DROP INDEX IDX_42C84955D12A823');
        $this->addSql('DROP INDEX IDX_42C8495571A51189');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reservation AS SELECT id, trajet_id, passager_id, paye, nb_personnes FROM reservation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, trajet_id INTEGER NOT NULL, passager_id INTEGER NOT NULL, paye BOOLEAN NOT NULL, nb_personnes INTEGER NOT NULL)');
        $this->addSql('INSERT INTO reservation (id, trajet_id, passager_id, paye, nb_personnes) SELECT id, trajet_id, passager_id, paye, nb_personnes FROM __temp__reservation');
        $this->addSql('DROP TABLE __temp__reservation');
        $this->addSql('CREATE INDEX IDX_42C84955D12A823 ON reservation (trajet_id)');
        $this->addSql('CREATE INDEX IDX_42C8495571A51189 ON reservation (passager_id)');
        $this->addSql('DROP INDEX IDX_2B5BA98CF16F4AC6');
        $this->addSql('DROP INDEX IDX_2B5BA98CD2C9B65');
        $this->addSql('DROP INDEX IDX_2B5BA98C36855DE8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__trajet AS SELECT id, conducteur_id, point_depart_id, point_arrivee_id, temps_trajet, prix, nb_places, vehicule, options, date FROM trajet');
        $this->addSql('DROP TABLE trajet');
        $this->addSql('CREATE TABLE trajet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, conducteur_id INTEGER NOT NULL, point_depart_id INTEGER NOT NULL, point_arrivee_id INTEGER NOT NULL, temps_trajet INTEGER DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, nb_places INTEGER NOT NULL, vehicule VARCHAR(255) NOT NULL, options CLOB DEFAULT \'NULL --(DC2Type:array)\' COLLATE BINARY --(DC2Type:array)
        , date VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO trajet (id, conducteur_id, point_depart_id, point_arrivee_id, temps_trajet, prix, nb_places, vehicule, options, date) SELECT id, conducteur_id, point_depart_id, point_arrivee_id, temps_trajet, prix, nb_places, vehicule, options, date FROM __temp__trajet');
        $this->addSql('DROP TABLE __temp__trajet');
        $this->addSql('CREATE INDEX IDX_2B5BA98CF16F4AC6 ON trajet (conducteur_id)');
        $this->addSql('CREATE INDEX IDX_2B5BA98CD2C9B65 ON trajet (point_depart_id)');
        $this->addSql('CREATE INDEX IDX_2B5BA98C36855DE8 ON trajet (point_arrivee_id)');
    }
}
