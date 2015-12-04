CREATE USER 'sec_user'@'localhost' IDENTIFIED BY 'eKcGZr59zAa2BEWU';
GRANT SELECT, INSERT, UPDATE ON `secure_login`.* TO 'sec_user'@'localhost';

CREATE USER 'data_user'@'localhost' IDENTIFIED BY 'zGBhc6uccB2PKxPS';
GRANT SELECT, INSERT, UPDATE, DELETE ON `shop_app_db`.* TO 'data_user'@'localhost';