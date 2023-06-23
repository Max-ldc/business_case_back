<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230623130827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, road VARCHAR(255) NOT NULL, postal_code VARCHAR(5) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_nft (category_id INT NOT NULL, nft_id INT NOT NULL, INDEX IDX_FC05EB6612469DE2 (category_id), INDEX IDX_FC05EB66E813668D (nft_id), PRIMARY KEY(category_id, nft_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nft (id INT AUTO_INCREMENT NOT NULL, img VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, country VARCHAR(255) NOT NULL, drop_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nftpurchase (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nft_id INT NOT NULL, date DATE NOT NULL, eth_purchase_price DOUBLE PRECISION NOT NULL, eur_purchase_price DOUBLE PRECISION NOT NULL, INDEX IDX_1CA6E46EA76ED395 (user_id), INDEX IDX_1CA6E46EE813668D (nft_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price_infos (id INT AUTO_INCREMENT NOT NULL, nft_id INT NOT NULL, date DATE NOT NULL, eth_price DOUBLE PRECISION NOT NULL, INDEX IDX_C5038A0DE813668D (nft_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, gender INT DEFAULT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_nft ADD CONSTRAINT FK_FC05EB6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_nft ADD CONSTRAINT FK_FC05EB66E813668D FOREIGN KEY (nft_id) REFERENCES nft (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nftpurchase ADD CONSTRAINT FK_1CA6E46EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE nftpurchase ADD CONSTRAINT FK_1CA6E46EE813668D FOREIGN KEY (nft_id) REFERENCES nft (id)');
        $this->addSql('ALTER TABLE price_infos ADD CONSTRAINT FK_C5038A0DE813668D FOREIGN KEY (nft_id) REFERENCES nft (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_nft DROP FOREIGN KEY FK_FC05EB6612469DE2');
        $this->addSql('ALTER TABLE category_nft DROP FOREIGN KEY FK_FC05EB66E813668D');
        $this->addSql('ALTER TABLE nftpurchase DROP FOREIGN KEY FK_1CA6E46EA76ED395');
        $this->addSql('ALTER TABLE nftpurchase DROP FOREIGN KEY FK_1CA6E46EE813668D');
        $this->addSql('ALTER TABLE price_infos DROP FOREIGN KEY FK_C5038A0DE813668D');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_nft');
        $this->addSql('DROP TABLE nft');
        $this->addSql('DROP TABLE nftpurchase');
        $this->addSql('DROP TABLE price_infos');
        $this->addSql('DROP TABLE user');
    }
}
