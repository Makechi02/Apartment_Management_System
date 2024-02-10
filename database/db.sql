CREATE TABLE admin (
    user_id INT AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    contact VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    added_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id)
);

INSERT INTO admin (name, email, contact, password)
VALUES
    ('mkuu', 'mkuu@example.com', '0712345678', 'mkuu');


CREATE TABLE tenants (
    tenant_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    contact VARCHAR(100),
    DOB DATE
);

INSERT INTO tenants (name, contact, DOB)
VALUES
    ('John Doe', '+254123456789', '1990-05-15'),
    ('Jane Smith', '+254987654321', '1985-10-20');



CREATE TABLE staff (
    staff_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    role VARCHAR(50),
    contact VARCHAR(100)
);

INSERT INTO staff (name, role, contact)
VALUES
    ('Alice Johnson', 'Manager', '+254712345678'),
    ('Bob Williams', 'Maintenance', '+254798765432');



CREATE TABLE payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    tenant_id INT,
    amount DECIMAL(10,2) NOT NULL,
    payment_date DATE DEFAULT CURRENT_DATE,
    payment_method VARCHAR(50),
    FOREIGN KEY (tenant_id) REFERENCES tenants(tenant_id)
);

INSERT INTO payments (tenant_id, amount, payment_date, payment_method)
VALUES
    (1, 20000.00, '2023-01-05', 'Cash'),
    (2, 25000.00, '2023-01-10', 'Bank Transfer');



CREATE TABLE owners (
    owner_id INT AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    contact VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100) NOT NULL,
    PRIMARY KEY (owner_id)
);

INSERT INTO owners (name, contact, email, password)
VALUES
    ('David Kimani', '+254712345678', 'david@example.com', '123456'),
    ('Grace Mwangi', '+254798765432', 'grace@example.com', '123456');



CREATE TABLE apartment (
    apartment_id INT PRIMARY KEY AUTO_INCREMENT,
    owner_id INT,
    address VARCHAR(100),
    number VARCHAR(20) NOT NULL,
    size DECIMAL(10,2),
    rent DECIMAL(10,2),
    status ENUM('VACANT', 'OCCUPIED') DEFAULT 'VACANT',
    created_date TIMESTAMP default CURRENT_TIMESTAMP,
    FOREIGN KEY (owner_id) REFERENCES owners(owner_id)
);

INSERT INTO apartment (owner_id, number, size, rent, status)
VALUES
    (1, 'A101', 80.00, 20000.00, 'OCCUPIED'),
    (2, 'B202', 100.00, 25000.00, 'VACANT');



