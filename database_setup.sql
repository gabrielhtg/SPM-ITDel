CREATE USER 'userAMI'@'localhost' IDENTIFIED BY 'userAMIPassword';
create database ami_database;
GRANT ALL PRIVILEGES ON ami_database.* TO 'userAMI'@'localhost';
FLUSH PRIVILEGES;
