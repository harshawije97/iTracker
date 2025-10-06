CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    estate_code VARCHAR(3) DEFAULT NULL,
    role VARCHAR(25) NOT NULL,
    is_registered BOOLEAN DEFAULT FALSE,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS auth (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS estates (
	id INT PRIMARY KEY AUTO_INCREMENT,
    estate_code VARCHAR(3) NOT NULL UNIQUE,
    estate_name VARCHAR(255) NOT NULL
);


CREATE TABLE IF NOT EXISTS head_office (
	id INT PRIMARY KEY AUTO_INCREMENT,
    head_office_code VARCHAR(3) NOT NULL UNIQUE,
    head_office_name VARCHAR(255) NOT NULL,
    location VARCHAR(50) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS inventory (
	id INT PRIMARY KEY AUTO_INCREMENT,
	serial_number VARCHAR(10) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(100) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    image LONGBLOB DEFAULT NULL,
    estate_code VARCHAR(3) NOT NULL,
    user_id INT NOT NULL,
    item_status varchar(10) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (estate_code) REFERENCES estates(estate_code) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE INDEX idx_inventory_estate_code ON inventory(estate_code);
CREATE INDEX idx_inventory_user_id ON inventory(user_id);
CREATE INDEX idx_inventory_category ON inventory(category);


CREATE TABLE IF NOT EXISTS incidents (
	id INT PRIMARY KEY AUTO_INCREMENT,
    incident_code VARCHAR(10) NOT NULL UNIQUE,
    title VARCHAR(100) NOT NULL,
    inventory_id INT NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    image LONGBLOB DEFAULT NULL,
    priority ENUM('Low', 'Moderate', 'High') NOT NULL,
    manager_email VARCHAR(255) DEFAULT NULL,
    is_archived BOOLEAN DEFAULT FALSE,
    user_id INT NOT NULL,
    estate_code VARCHAR(3) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (estate_code) REFERENCES estates(estate_code) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (inventory_id) REFERENCES inventory(id) ON DELETE CASCADE
);

CREATE INDEX idx_incidents_inventory_id ON incidents(inventory_id);
CREATE INDEX idx_incidents_estate_code ON incidents(estate_code);
CREATE INDEX idx_incidents_priority ON incidents(priority);
CREATE INDEX idx_incidents_user_id ON incidents(user_id);

CREATE TABLE IF NOT EXISTS incident_updates(
	id INT PRIMARY KEY AUTO_INCREMENT,
    incident_id INT NOT NULL,
    status ENUM('Resent', 'Opened', 'In Progress', 'Resolved', 'Closed') DEFAULT 'Resent',
    description TEXT NOT NULL,
    image LONGBLOB DEFAULT NULL,
    user_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_on DATETIME NULL,
    
    FOREIGN KEY (incident_id) REFERENCES incidents(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS approval(
	id INT PRIMARY KEY AUTO_INCREMENT,
    incident_id INT NOT NULL,
    user_id INT NOT NULL,
    status ENUM('Approved','Not Approved') DEFAULT 'Not Approved',
    remarks VARCHAR(100) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (incident_id) REFERENCES incidents(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


-- Values

INSERT INTO auth (user_id, username, password) 
VALUES 
    (1, 'samantha.perera@bogestate.lk', SHA2('Samantha@2024', 256)),
    (2, 'rajesh.fernando@bogestate.lk', SHA2('Rajesh@2024', 256)),
    (3, 'dinesh.silva@headoffice.lk', SHA2('Dinesh@2024', 256)),
    (4, 'nishani.jayawardena@headoffice.lk', SHA2('Nishani@2024', 256)),
    (5, 'kamal.wijesinghe@headoffice.lk', SHA2('Kamal@2024', 256));