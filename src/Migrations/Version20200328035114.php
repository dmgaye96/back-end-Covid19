<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328035114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE envoi (id INT AUTO_INCREMENT NOT NULL, piece_id INT DEFAULT NULL, paysenvoi_id INT DEFAULT NULL, pays_id INT DEFAULT NULL, guichetier_id INT DEFAULT NULL, dateenvoi DATETIME DEFAULT NULL, nom_e VARCHAR(255) NOT NULL, prenom_e VARCHAR(255) NOT NULL, telephone_e BIGINT NOT NULL, adresse_e VARCHAR(255) DEFAULT NULL, montant NUMERIC(10, 0) NOT NULL, numeropiece BIGINT DEFAULT NULL, datedelivrance DATE DEFAULT NULL, datedevalidite DATE DEFAULT NULL, nom_b VARCHAR(255) NOT NULL, prenom_b VARCHAR(255) NOT NULL, telephone_b BIGINT NOT NULL, adresse_b VARCHAR(255) DEFAULT NULL, commitionttc BIGINT DEFAULT NULL, codeenvoi BIGINT NOT NULL, numero BIGINT DEFAULT NULL, total NUMERIC(10, 0) NOT NULL, commissionetat NUMERIC(10, 0) DEFAULT NULL, commissionsysteme NUMERIC(10, 0) DEFAULT NULL, commissionguichetenvoie NUMERIC(10, 0) DEFAULT NULL, commissionguicheretrait NUMERIC(10, 0) DEFAULT NULL, INDEX IDX_CA7E3566C40FCFA8 (piece_id), INDEX IDX_CA7E356657026CAD (paysenvoi_id), INDEX IDX_CA7E3566A6E44244 (pays_id), INDEX IDX_CA7E356690DCD06F (guichetier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typedepiece (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commissions (id INT AUTO_INCREMENT NOT NULL, borninf NUMERIC(10, 0) NOT NULL, bornesup NUMERIC(10, 0) DEFAULT NULL, commissionttc NUMERIC(10, 0) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, raisonsociale VARCHAR(255) NOT NULL, ninea VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, statut VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, partenaire_id INT DEFAULT NULL, profile_id INT DEFAULT NULL, compte_id INT DEFAULT NULL, ajouterpar_id INT DEFAULT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3AA08CB10 (login), UNIQUE INDEX UNIQ_1D1C63B335C246D5 (password), UNIQUE INDEX UNIQ_1D1C63B3450FF010 (telephone), INDEX IDX_1D1C63B398DE13AC (partenaire_id), INDEX IDX_1D1C63B3CCFA12B8 (profile_id), INDEX IDX_1D1C63B3F2C56620 (compte_id), INDEX IDX_1D1C63B374CD371F (ajouterpar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE retrait (id INT AUTO_INCREMENT NOT NULL, guichetier_id INT DEFAULT NULL, typedepiece_id INT DEFAULT NULL, date DATETIME NOT NULL, numeropiece BIGINT DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, INDEX IDX_D9846A5190DCD06F (guichetier_id), INDEX IDX_D9846A517505F85B (typedepiece_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, partenaire_id INT NOT NULL, numerocompte VARCHAR(255) NOT NULL, solde NUMERIC(9, 0) NOT NULL, INDEX IDX_CFF6526098DE13AC (partenaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depot (id INT AUTO_INCREMENT NOT NULL, compte_id INT NOT NULL, caissier_id INT NOT NULL, montant NUMERIC(9, 0) NOT NULL, date DATETIME NOT NULL, INDEX IDX_47948BBCF2C56620 (compte_id), INDEX IDX_47948BBCB514973B (caissier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE envoi ADD CONSTRAINT FK_CA7E3566C40FCFA8 FOREIGN KEY (piece_id) REFERENCES typedepiece (id)');
        $this->addSql('ALTER TABLE envoi ADD CONSTRAINT FK_CA7E356657026CAD FOREIGN KEY (paysenvoi_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE envoi ADD CONSTRAINT FK_CA7E3566A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE envoi ADD CONSTRAINT FK_CA7E356690DCD06F FOREIGN KEY (guichetier_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B398DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B374CD371F FOREIGN KEY (ajouterpar_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE retrait ADD CONSTRAINT FK_D9846A5190DCD06F FOREIGN KEY (guichetier_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE retrait ADD CONSTRAINT FK_D9846A517505F85B FOREIGN KEY (typedepiece_id) REFERENCES typedepiece (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526098DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBCF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBCB514973B FOREIGN KEY (caissier_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE envoi DROP FOREIGN KEY FK_CA7E3566C40FCFA8');
        $this->addSql('ALTER TABLE retrait DROP FOREIGN KEY FK_D9846A517505F85B');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3CCFA12B8');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B398DE13AC');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526098DE13AC');
        $this->addSql('ALTER TABLE envoi DROP FOREIGN KEY FK_CA7E356690DCD06F');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B374CD371F');
        $this->addSql('ALTER TABLE retrait DROP FOREIGN KEY FK_D9846A5190DCD06F');
        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBCB514973B');
        $this->addSql('ALTER TABLE envoi DROP FOREIGN KEY FK_CA7E356657026CAD');
        $this->addSql('ALTER TABLE envoi DROP FOREIGN KEY FK_CA7E3566A6E44244');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3F2C56620');
        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBCF2C56620');
        $this->addSql('DROP TABLE envoi');
        $this->addSql('DROP TABLE typedepiece');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE commissions');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE retrait');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE depot');
    }
}
