CREATE TABLE ADDRESS(
    ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    USER_ID INT NOT NULL ,
    ADDRESS VARCHAR(255) NOT NULL,
    CITY VARCHAR(15) NOT NULL,
    STATE VARCHAR(20) NOT NULL,
    COUNTRY VARCHAR(15) NOT NULL,
    FOREIGN KEY (USER_ID) REFERENCES USERS(USER_ID)
);