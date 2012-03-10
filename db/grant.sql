CREATE USER 'www-data'@'localhost' IDENTIFIED BY 'Q8JdU5MY7dDr5XEU';

GRANT ALL PRIVILEGES ON hybrida_dev.* to 'www-data'@'localhost';

-- For å muliggjøre rask oppdatering av databasen lokalt
GRANT CREATE,DROP on *.* TO 'www-data'@'localhost';
