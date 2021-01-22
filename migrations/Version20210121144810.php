<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121144810 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE failure_login_attempt (id INT AUTO_INCREMENT NOT NULL, ip VARCHAR(45) NOT NULL, username VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX ip (ip), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE form_add CHANGE typ typ VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE gen CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE psi DROP cmku_pref, DROP vyska, DROP prezdivka, DROP majitel, DROP web, DROP patella_l, DROP patella_r, CHANGE pohlavi pohlavi VARCHAR(2) NOT NULL, CHANGE vloz_datum vloz_datum DATE NOT NULL, CHANGE vloz_osoba vloz_osoba INT NOT NULL, CHANGE pes_jmeno jmeno VARCHAR(60) NOT NULL');
        $this->addSql('ALTER TABLE psi_detail CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE psi_text CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE vrh ADD otec INT NOT NULL, ADD matka INT NOT NULL, ADD chovatel INT NOT NULL, DROP otec_jmeno, DROP otec_chov, DROP matka_jmeno, DROP matka_chov, DROP chovatel_jmeno, CHANGE stanice stanice INT NOT NULL, CHANGE vloz_datum vloz_datum DATE NOT NULL, CHANGE vloz_osoba vloz_osoba INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE failure_login_attempt');
        $this->addSql('ALTER TABLE form_add CHANGE typ typ VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'text\' NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE gen CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE psi ADD cmku_pref VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, ADD vyska INT NOT NULL, ADD prezdivka VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, ADD majitel VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, ADD web VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, ADD patella_l VARCHAR(2) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, ADD patella_r VARCHAR(2) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE pohlavi pohlavi VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE vloz_datum vloz_datum DATETIME NOT NULL, CHANGE vloz_osoba vloz_osoba VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE jmeno pes_jmeno VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE psi_detail CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE psi_text CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE vrh ADD otec_jmeno VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, ADD otec_chov VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, ADD matka_jmeno VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, ADD matka_chov VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, ADD chovatel_jmeno VARCHAR(80) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, DROP otec, DROP matka, DROP chovatel, CHANGE stanice stanice VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE vloz_datum vloz_datum DATETIME NOT NULL, CHANGE vloz_osoba vloz_osoba VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`');
    }
}
