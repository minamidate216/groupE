-- Admins テーブル
CREATE TABLE Admins (
    admin_id VARCHAR(8) PRIMARY KEY,
    admin_name VARCHAR(50) UNIQUE,
    password VARCHAR(30) NOT NULL,
    email VARCHAR(100) NOT NULL
);

-- Users テーブル
CREATE TABLE Users (
    user_id VARCHAR(20) PRIMARY KEY,
    user_name VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    address VARCHAR(200) NOT NULL
);

-- Category テーブル
CREATE TABLE Category (
    category_id INT(8) AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(20) NOT NULL
);

-- Products テーブル
CREATE TABLE Products (
    product_id INT(8) AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(30) NOT NULL,
    description VARCHAR(500) NOT NULL,
    price INT(8) NOT NULL,
    quantity INT(8) NOT NULL,
    product_img VARCHAR(100) NOT NULL,
    category_id INT(8) NOT NULL,
    capacity VARCHAR(5) NOT NULL,
    admin_id VARCHAR(8) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES Category(category_id),
    FOREIGN KEY (admin_id) REFERENCES Admins(admin_id)
);

-- Columns テーブル
CREATE TABLE Columns (
    column_id INT(8) AUTO_INCREMENT PRIMARY KEY,
    column_title VARCHAR(40) NOT NULL,
    content TEXT NOT NULL,
    post_data DATE NOT NULL,
    post_img VARCHAR(50) NOT NULL,
    admin_id VARCHAR(8) NOT NULL,
    FOREIGN KEY (admin_id) REFERENCES Admins(admin_id)
);

-- Orders テーブル
CREATE TABLE Orders (
    order_id INT(8) AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(8) NOT NULL,
    date DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- OrdersDetails テーブル
CREATE TABLE OrdersDetails (
    orderdetail_id INT(8) AUTO_INCREMENT PRIMARY KEY,
    order_id INT(8) NOT NULL,
    product_id INT(8) NOT NULL,
    quantity INT(8) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);
