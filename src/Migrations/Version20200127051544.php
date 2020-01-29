<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200127051544 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE val_critere ADD critere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE val_critere ADD CONSTRAINT FK_97628AE59E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
        $this->addSql('CREATE INDEX IDX_97628AE59E5F45AB ON val_critere (critere_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE val_critere DROP FOREIGN KEY FK_97628AE59E5F45AB');
        $this->addSql('DROP INDEX IDX_97628AE59E5F45AB ON val_critere');
        $this->addSql('ALTER TABLE val_critere DROP critere_id');
    }
}
