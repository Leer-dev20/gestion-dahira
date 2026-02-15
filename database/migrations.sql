-- database/migrations.sql

CREATE TABLE cells (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    short_name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO cells (name, short_name, description) VALUES
('Dahira Khidmatoul Khadim Bourgogne', 'Bourgogne', 'Cellule N°1 — Quartier Bourgogne'),
('Dahira Khidmatoul Khadim Oulfa', 'Oulfa', 'Cellule N°2 — Quartier Oulfa'),
('Dahira Khidmatoul Khadim Sidi Maarouf', 'Sidi Maarouf', 'Cellule N°3 — Quartier Sidi Maarouf');

CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cell_id INT NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL DEFAULT '',
    email VARCHAR(255) NOT NULL DEFAULT '',
    address TEXT,  -- pas de DEFAULT
    join_date DATE NOT NULL DEFAULT (CURRENT_DATE),
    role VARCHAR(50) NOT NULL DEFAULT 'Membre',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cell_id) REFERENCES cells(id) ON DELETE CASCADE
);

CREATE TABLE cotisations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    cell_id INT NOT NULL,
    month INT NOT NULL CHECK (month BETWEEN 1 AND 12),
    year INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL DEFAULT 100,
    paid BOOLEAN NOT NULL DEFAULT FALSE,
    paid_date DATE,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_member_month_year (member_id, month, year),
    FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE,
    FOREIGN KEY (cell_id) REFERENCES cells(id) ON DELETE CASCADE
);