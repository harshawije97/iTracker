CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    estate_code VARCHAR(3) DEFAULT NULL,
    role ENUM('chief-clerk', 'estate-manager', 'it-manager', 'assistant-it-manager', 'it-admin') NOT NULL,
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

-- Table Updates
ALTER TABLE inventory 
ADD COLUMN is_head_office BOOLEAN DEFAULT FALSE;

ALTER TABLE inventory
ADD COLUMN is_archived BOOLEAN DEFAULT FALSE;

ALTER TABLE inventory 
MODIFY COLUMN item_status ENUM('in stock', 'on repair') NOT NULL;

ALTER TABLE inventory 
MODIFY COLUMN estate_code VARCHAR(3) NULL;

ALTER TABLE inventory 
MODIFY COLUMN serial_number VARCHAR(50) NOT NULL UNIQUE;


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

ALTER TABLE incidents 
MODIFY COLUMN manager_email TEXT NOT NULL;

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

CREATE TABLE IF NOT EXISTS notification(
    id INT PRIMARY KEY AUTO_INCREMENT,
    notification_id VARCHAR(255) NOT NULL,
    body JSON NOT NULL,
    is_opened BOOLEAN DEFAULT FALSE,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP

    INDEX (notification_id),
    INDEX (is_opened)
);


-- Values
INSERT INTO auth (user_id, username, password) 
VALUES 
    (1, 'buddika@bogestate.lk', SHA2('password@123', 256)),
    (2, 'jayawijesinghe@gmail.com', SHA2('admin@123', 256))

-- Users
INSERT INTO users (first_name, last_name, email, estate_code, role, is_registered) 
VALUES
    ('Buddika', 'Siriwardana', 'buddika@bogestate.lk', 'NOR', 'chief-clerk', TRUE),
    ('Jayatha', 'Wijesinghe', 'jayawijesinghe@gmail.com', NULL, 'it-manager', TRUE)

INSERT INTO estates (estate_code, estate_name) 
VALUES 
    ('BOG', 'Bogawana'),
    ('BOW', 'Bogawantalawa'),
    ('CAM', 'Campion'),
    ('FET', 'Fetteresso'),
    ('KOT', 'Kotigala'),
    ('LET', 'Lethenty'),
    ('LOI', 'Loinorn'),
    ('NOR', 'Norwood'),
    ('OSB', 'Osbrne'),
    ('POY', 'Poyston'),
    ('WAN', 'Wanarajah');

INSERT INTO head_office (head_office_code, head_office_name, location) 
VALUES 
    ('HOB', 'Bogawantalawa Head Office', 'Bogawanthalawa, Central province');


INSERT INTO inventory (serial_number, name, category, description, estate_code, is_head_office, user_id, item_status) 
VALUES
    ('KO/CPU/3', 'Assemble PC', 'Desktop', NULL, 'KOT', FALSE, 1, 'in stock'),
    ('BTE/BO/CPU/11', 'HP Prodesk', 'Desktop', NULL, 'KOT', FALSE, 1, 'in stock'),
    ('NXB17SG0013290F8787600', 'ACER TMP216', 'Laptop', NULL, 'KOT', FALSE, 1, 'in stock'),
    ('Z5SVB8GC7B000Vl', 'Samsung ML1886', 'Printer', NULL, 'KOT', FALSE, 1, 'in stock'),
    ('FT8Y077455', 'EPSON LQ-2090', 'Printer', NULL, 'KOT', FALSE, 1, 'in stock');