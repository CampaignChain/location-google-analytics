<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170913095254 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaignchain_location_google_analytics DROP FOREIGN KEY FK_F67C58EB64D218E');
        $this->addSql('ALTER TABLE campaignchain_location_google_analytics ADD CONSTRAINT FK_F67C58EB64D218E FOREIGN KEY (location_id) REFERENCES campaignchain_location (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaignchain_location_google_analytics DROP FOREIGN KEY FK_F67C58EB64D218E');
        $this->addSql('ALTER TABLE campaignchain_location_google_analytics ADD CONSTRAINT FK_F67C58EB64D218E FOREIGN KEY (location_id) REFERENCES campaignchain_location (id) ON DELETE SET NULL');
    }
}
