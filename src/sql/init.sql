IF EXISTS test DROP DATABASE test;

USE test;

SOURCE users.sql;
SOURCE food.sql;
SOURCE other.sql;

SHOW TABLES;
