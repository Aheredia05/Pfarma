<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213223345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE proveedor ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE proveedor ADD CONSTRAINT FK_16C068CEDB38439E FOREIGN KEY (usuario_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_16C068CEDB38439E ON proveedor (usuario_id)');
        $this->addSql('ALTER TABLE producto ADD proveedor_id INT NOT NULL, ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB0615CB305D73 FOREIGN KEY (proveedor_id) REFERENCES proveedor (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB0615DB38439E FOREIGN KEY (usuario_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_A7BB0615CB305D73 ON producto (proveedor_id)');
        $this->addSql('CREATE INDEX IDX_A7BB0615DB38439E ON producto (usuario_id)');
        $this->addSql('ALTER TABLE entradas ADD producto_id INT NOT NULL');
        $this->addSql('ALTER TABLE entradas ADD CONSTRAINT FK_4CAF338C7645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('CREATE INDEX IDX_4CAF338C7645698E ON entradas (producto_id)');
        $this->addSql('ALTER TABLE detalleproduct ADD producto_id INT NOT NULL');
        $this->addSql('ALTER TABLE detalleproduct ADD CONSTRAINT FK_46A100897645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('CREATE INDEX IDX_46A100897645698E ON detalleproduct (producto_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detalleproduct DROP FOREIGN KEY FK_46A100897645698E');
        $this->addSql('DROP INDEX IDX_46A100897645698E ON detalleproduct');
        $this->addSql('ALTER TABLE detalleproduct DROP producto_id');
        $this->addSql('ALTER TABLE entradas DROP FOREIGN KEY FK_4CAF338C7645698E');
        $this->addSql('DROP INDEX IDX_4CAF338C7645698E ON entradas');
        $this->addSql('ALTER TABLE entradas DROP producto_id');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB0615CB305D73');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB0615DB38439E');
        $this->addSql('DROP INDEX IDX_A7BB0615CB305D73 ON producto');
        $this->addSql('DROP INDEX IDX_A7BB0615DB38439E ON producto');
        $this->addSql('ALTER TABLE producto DROP proveedor_id, DROP usuario_id');
        $this->addSql('ALTER TABLE proveedor DROP FOREIGN KEY FK_16C068CEDB38439E');
        $this->addSql('DROP INDEX IDX_16C068CEDB38439E ON proveedor');
        $this->addSql('ALTER TABLE proveedor DROP usuario_id');
    }
}
