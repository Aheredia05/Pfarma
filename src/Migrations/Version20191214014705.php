<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191214014705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE detallefactura (id INT AUTO_INCREMENT NOT NULL, producto_id INT NOT NULL, factura_id INT NOT NULL, cantidad INT NOT NULL, preciototal DOUBLE PRECISION NOT NULL, INDEX IDX_6C00A42D7645698E (producto_id), INDEX IDX_6C00A42DF04F795F (factura_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detallefactura ADD CONSTRAINT FK_6C00A42D7645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE detallefactura ADD CONSTRAINT FK_6C00A42DF04F795F FOREIGN KEY (factura_id) REFERENCES factura (id)');
        $this->addSql('ALTER TABLE factura ADD usuario_id INT NOT NULL, ADD cliente_id INT NOT NULL');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA009DB38439E FOREIGN KEY (usuario_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA009DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('CREATE INDEX IDX_F9EBA009DB38439E ON factura (usuario_id)');
        $this->addSql('CREATE INDEX IDX_F9EBA009DE734E51 ON factura (cliente_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE detallefactura');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA009DB38439E');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA009DE734E51');
        $this->addSql('DROP INDEX IDX_F9EBA009DB38439E ON factura');
        $this->addSql('DROP INDEX IDX_F9EBA009DE734E51 ON factura');
        $this->addSql('ALTER TABLE factura DROP usuario_id, DROP cliente_id');
    }
}
