-- Database schema for Florist & General Shop POS
-- Create database manually first (e.g. CREATE DATABASE florist_pos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;)

SET NAMES utf8mb4;
SET time_zone = '+00:00';

-- Users table: one record per person, roles per module via columns.
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    username VARCHAR(60) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    -- role per module: 'admin', 'keeper' or NULL (no access)
    role_general ENUM('admin', 'keeper') NULL,
    role_florist ENUM('admin', 'keeper') NULL,
    can_view_reports_general TINYINT(1) NOT NULL DEFAULT 0,
    can_view_reports_florist TINYINT(1) NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Product categories (shared by both modules, but can be module-specific if needed).
CREATE TABLE IF NOT EXISTS categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NULL,
    module ENUM('general', 'florist') NOT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1
);

-- Products table.
CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    sku VARCHAR(64) NULL UNIQUE,
    category_id INT UNSIGNED NULL,
    module ENUM('general', 'florist') NOT NULL,
    unit VARCHAR(30) NOT NULL DEFAULT 'piece', -- e.g. piece, bunch, stem, vase
    cost_price DECIMAL(12, 2) NOT NULL DEFAULT 0,
    sell_price DECIMAL(12, 2) NOT NULL DEFAULT 0,
    is_bundle TINYINT(1) NOT NULL DEFAULT 0, -- for florist bundles/arrangements
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_products_category FOREIGN KEY (category_id) REFERENCES categories(id)
        ON UPDATE CASCADE ON DELETE SET NULL
);

-- For bundled products: mapping of bundle -> component product + quantity.
CREATE TABLE IF NOT EXISTS product_bundle_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    bundle_product_id INT UNSIGNED NOT NULL,
    component_product_id INT UNSIGNED NOT NULL,
    quantity DECIMAL(12, 3) NOT NULL DEFAULT 1,
    CONSTRAINT fk_bundle_product FOREIGN KEY (bundle_product_id) REFERENCES products(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_component_product FOREIGN KEY (component_product_id) REFERENCES products(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

-- Inventory movements (stock in / out / adjustments).
CREATE TABLE IF NOT EXISTS inventory_movements (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id INT UNSIGNED NOT NULL,
    module ENUM('general', 'florist') NOT NULL,
    quantity_change DECIMAL(12, 3) NOT NULL,
    movement_type ENUM('purchase', 'sale', 'adjustment', 'wastage') NOT NULL,
    reason VARCHAR(255) NULL,
    user_id INT UNSIGNED NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_inv_product FOREIGN KEY (product_id) REFERENCES products(id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_inv_user FOREIGN KEY (user_id) REFERENCES users(id)
        ON UPDATE CASCADE ON DELETE SET NULL
);

-- Sales (one row per sale/receipt).
CREATE TABLE IF NOT EXISTS sales (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    module ENUM('general', 'florist') NOT NULL,
    user_id INT UNSIGNED NOT NULL, -- who made the sale (keeper or admin)
    total_amount DECIMAL(12, 2) NOT NULL,
    total_cost DECIMAL(12, 2) NOT NULL DEFAULT 0,
    discount_amount DECIMAL(12, 2) NOT NULL DEFAULT 0,
    payment_method VARCHAR(30) NOT NULL DEFAULT 'cash',
    status ENUM('completed', 'voided') NOT NULL DEFAULT 'completed',
    occasion VARCHAR(100) NULL, -- florist-specific tagging (wedding, funeral, etc.)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_sales_user FOREIGN KEY (user_id) REFERENCES users(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

-- Sale items (line items per sale).
CREATE TABLE IF NOT EXISTS sale_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sale_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    quantity DECIMAL(12, 3) NOT NULL,
    unit_price DECIMAL(12, 2) NOT NULL,
    line_total DECIMAL(12, 2) NOT NULL,
    CONSTRAINT fk_sale_items_sale FOREIGN KEY (sale_id) REFERENCES sales(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_sale_items_product FOREIGN KEY (product_id) REFERENCES products(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

-- Simple audit log for key events (optional, can be extended).
CREATE TABLE IF NOT EXISTS audit_logs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NULL,
    action VARCHAR(100) NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_audit_user FOREIGN KEY (user_id) REFERENCES users(id)
        ON UPDATE CASCADE ON DELETE SET NULL
);

-- Seed an initial admin user (change password after first login).
INSERT INTO users (name, email, username, password_hash, role_general, role_florist, can_view_reports_general, can_view_reports_florist, is_active)
VALUES (
    'Super Admin',
    'admin@example.com',
    'admin',
    -- password: Admin@123 (hashed using PHP password_hash and inserted here as a fixed value)
    '$2y$10$5meG7Wb4AoR0F1L6XCzHKezFJa/8tkC9VQinFwRSqB3OLd7GpebUu',
    'admin',
    'admin',
    1,
    1,
    1
)
ON DUPLICATE KEY UPDATE email = email;

