CREATE TABLE accounts (
    account_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(255),
    date_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE guitars (
    guitar_id INT AUTO_INCREMENT PRIMARY KEY,
    guitar_name VARCHAR(100),
    guitar_type VARCHAR(50),
    quantity INT,
    price DECIMAL(10,2),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE other_products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100),
    category VARCHAR(50),
    quantity INT,
    price DECIMAL(10,2),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE shopping_cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT,
    item_name VARCHAR(100),
    item_type VARCHAR(50),
    quantity INT,
    price DECIMAL(10,2),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO guitars (guitar_name, guitar_type, quantity, price) VALUES
('Yamaha F315', 'Acoustic', 10, 7500.00),
('Fender Stratocaster', 'Electric', 5, 35000.00),
('Gibson Les Paul', 'Electric', 3, 45000.00),
('Ibanez GSR200', 'Bass', 7, 12000.00),
('Taylor 214ce', 'Acoustic', 4, 55000.00),
('Epiphone SG Standard', 'Electric', 6, 18000.00),
('Cordoba C5', 'Classical', 8, 9500.00),
('Squier Affinity Jazz Bass', 'Bass', 5, 14000.00);


INSERT INTO other_products (product_name, category, quantity, price) VALUES
('Dunlop Trigger Capo', 'Capo', 20, 450.00),
('Ernie Ball Regular Slinky', 'Strings', 50, 350.00),
('Fender Frontman 10G', 'Amplifier', 8, 4500.00),
('Dunlop Tortex 0.73mm (12pcs)', 'Guitar Pick', 30, 250.00),
('Rockbag Acoustic Gig Bag', 'Guitar Bag', 12, 1500.00),
('DAddario EJ16 Phosphor Bronze', 'Strings', 40, 400.00),
('Boss DS-1 Distortion Pedal', 'Amplifier', 6, 3500.00),
('Kyser Quick-Change Capo', 'Capo', 15, 600.00),
('Fender Premium Picks (12pcs)', 'Guitar Pick', 25, 300.00),
('Reunion Blues Continental Bag', 'Guitar Bag', 5, 3000.00);
