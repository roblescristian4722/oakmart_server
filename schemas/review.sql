CREATE TABLE review(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    
    product_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    rating FLOAT DEFAULT 0,
    commentary VARCHAR(250),

    PRIMARY KEY(id),
    FOREIGN KEY(product_id)
        REFERENCES product(id),
    FOREIGN KEY(user_id)
        REFERENCES user(id)
)
