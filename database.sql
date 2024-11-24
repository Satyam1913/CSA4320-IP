USE ram_infotech1;

CREATE TABLE admin_login (
    admin_id INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each admin
    username VARCHAR(255) NOT NULL UNIQUE,   -- Admin's username (must be unique)
    password_hash VARCHAR(255) NOT NULL,     -- Admin's hashed password
    email VARCHAR(255) NOT NULL UNIQUE,      -- Admin's email address (must be unique)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Account creation timestamp
    last_login TIMESTAMP NULL                -- Timestamp of the last login
);
