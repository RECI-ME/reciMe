DROP TABLE IF EXISTS 
    Users CASCADE,


CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    since TIMESTAMP NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE Chefs (
    chef_id INT PRIMARY KEY AUTO_INCREMENT,
    since TIMESTAMP NOT NULL,
    user_id INT UNIQUE,
    FOREIGN KEY (user_id) 
        REFERENCES Users(user_id)
        ON DELETE CASCADE
);

CREATE TABLE CertifiedChefs (
    certified_chef_id INT PRIMARY KEY AUTO_INCREMENT,
    since TIMESTAMP NOT NULL,
    chef_id INT,
    FOREIGN KEY (chef_id) 
        REFERENCES Chefs(chef_id)
        ON DELETE CASCADE
);

