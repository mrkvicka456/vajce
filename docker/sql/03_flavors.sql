CREATE TABLE IF NOT EXISTS flavors (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    description VARCHAR(240) NOT NULL DEFAULT '',
    PRIMARY KEY (id),
    CONSTRAINT uq_flavors_name UNIQUE (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS tea_flavors (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    tea_id INT UNSIGNED NOT NULL,
    flavor_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT uq_tea_flavors UNIQUE (tea_id, flavor_id),
    KEY idx_tea_flavors_flavor (flavor_id),
    CONSTRAINT fk_tea_flavors_tea FOREIGN KEY (tea_id)
        REFERENCES teas (id) ON DELETE CASCADE,
    CONSTRAINT fk_tea_flavors_flavor FOREIGN KEY (flavor_id)
        REFERENCES flavors (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
