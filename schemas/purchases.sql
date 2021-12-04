CREATE TABLE purchase(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,

    user_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    pieces INT UNSIGNED NOT NULL,
    price FLOAT NOT NULL,
    price_total FLOAT NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (user_id)
        REFERENCES user(id),
    FOREIGN KEY (product_id)
        REFERENCES product(id)
);
