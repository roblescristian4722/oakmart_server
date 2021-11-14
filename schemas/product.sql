CREATE TABLE product(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    stock INT UNSIGNED NOT NULL,
    category VARCHAR(150) NOT NULL,
    description VARCHAR(2000) NOT NULL,
    price FLOAT NOT NULL,
    location VARCHAR(400) NOT NULL,

    user_id INT UNSIGNED NOT NULL,
    
    PRIMARY KEY(id),
    FOREIGN KEY (user_id)
        REFERENCES user(id)
);
