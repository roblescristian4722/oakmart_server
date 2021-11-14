CREATE TABLE product_img(
    product_id INT UNSIGNED NOT NULL,
    image VARCHAR(300) NOT NULL,

    FOREIGN KEY(product_id)
        REFERENCES product(id)
);
