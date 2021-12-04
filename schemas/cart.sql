CREATE TABLE cart(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    product_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    pieces INT UNSIGNED NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(product_id)
        REFERENCES product(id),
    FOREIGN KEY(user_id)
        REFERENCES user(id)
);
