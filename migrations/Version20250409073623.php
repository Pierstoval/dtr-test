<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250409073623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product_product_file (product_id INT NOT NULL, product_file_id INT NOT NULL, PRIMARY KEY(product_id, product_file_id))');
        $this->addSql('CREATE INDEX IDX_8CD336DA4584665A ON product_product_file (product_id)');
        $this->addSql('CREATE INDEX IDX_8CD336DA421262DC ON product_product_file (product_file_id)');
        $this->addSql('CREATE TABLE product_file (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE product_product_file ADD CONSTRAINT FK_8CD336DA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_product_file ADD CONSTRAINT FK_8CD336DA421262DC FOREIGN KEY (product_file_id) REFERENCES product_file (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product_product_file DROP CONSTRAINT FK_8CD336DA4584665A');
        $this->addSql('ALTER TABLE product_product_file DROP CONSTRAINT FK_8CD336DA421262DC');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_product_file');
        $this->addSql('DROP TABLE product_file');
    }
}
