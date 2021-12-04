CREATE TABLE product_img(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    product_id INT UNSIGNED NOT NULL,
    image VARCHAR(300) NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(product_id)
        REFERENCES product(id)
);
