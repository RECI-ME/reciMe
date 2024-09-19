IF EXISTS test DROP DATABASE test;

USE recime;

SOURCE users.sql;
SOURCE food.sql;
SOURCE other.sql;

SHOW TABLES;
