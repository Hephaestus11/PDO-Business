-- Accounts table (handles login/registration and user info)
CREATE TABLE accounts (
    account_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(255),
    added_by VARCHAR(50),
    updated_by VARCHAR(50),
    date_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Guitars table with added_by and updated_by
CREATE TABLE guitars (
    guitar_id INT AUTO_INCREMENT PRIMARY KEY,
    guitar_name VARCHAR(100),
    guitar_type VARCHAR(50),
    quantity INT,
    price DECIMAL(10,2),
    added_by VARCHAR(50),
    updated_by VARCHAR(50),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Other products table with added_by and updated_by
CREATE TABLE other_products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100),
    category VARCHAR(50),
    quantity INT,
    price DECIMAL(10,2),
    added_by VARCHAR(50),
    updated_by VARCHAR(50),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Shopping cart table with added_by and updated_by
CREATE TABLE shopping_cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT,
    item_name VARCHAR(100),
    item_type VARCHAR(50),
    quantity INT,
    price DECIMAL(10,2),
    added_by VARCHAR(50),
    updated_by VARCHAR(50),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data for guitars
INSERT INTO guitars (guitar_name, guitar_type, quantity, price, added_by) VALUES
('Yamaha F315', 'Acoustic', 10, 7500.00, 'admin'),
('Fender Stratocaster', 'Electric', 5, 35000.00, 'admin'),
('Gibson Les Paul', 'Electric', 3, 45000.00, 'admin'),
('Ibanez GSR200', 'Bass', 7, 12000.00, 'admin'),
('Taylor 214ce', 'Acoustic', 4, 55000.00, 'admin'),
('Epiphone SG Standard', 'Electric', 6, 18000.00, 'admin'),
('Cordoba C5', 'Classical', 8, 9500.00, 'admin'),
('Squier Affinity Jazz Bass', 'Bass', 5, 14000.00, 'admin');

-- Sample data for other products
INSERT INTO other_products (product_name, category, quantity, price, added_by) VALUES
('Dunlop Trigger Capo', 'Capo', 20, 450.00, 'admin'),
('Ernie Ball Regular Slinky', 'Strings', 50, 350.00, 'admin'),
('Fender Frontman 10G', 'Amplifier', 8, 4500.00, 'admin'),
('Dunlop Tortex 0.73mm (12pcs)', 'Guitar Pick', 30, 250.00, 'admin'),
('Rockbag Acoustic Gig Bag', 'Guitar Bag', 12, 1500.00, 'admin'),
('DAddario EJ16 Phosphor Bronze', 'Strings', 40, 400.00, 'admin'),
('Boss DS-1 Distortion Pedal', 'Amplifier', 6, 3500.00, 'admin'),
('Kyser Quick-Change Capo', 'Capo', 15, 600.00, 'admin'),
('Fender Premium Picks (12pcs)', 'Guitar Pick', 25, 300.00, 'admin'),
('Reunion Blues Continental Bag', 'Guitar Bag', 5, 3000.00, 'admin');
