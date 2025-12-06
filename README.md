# Online Computer Store

A fully functional e-commerce web application built using PHP and MySQL for the course **COSC-2956-F02 – Internet Tools**.

## Student Information

- **Name:** Shivam Sharma  
- **Course:** COSC-2956-F02 – Internet Tools  
- **Professor:** Ben Kam  

---

# ⭐ Project Overview

This project implements a complete online computer store where customers can browse products, add items to their cart, submit reviews, place orders, and view their order history.  
The system also includes a robust admin panel for managing products and viewing all customer orders.

The application uses:
- PHP (procedural, mysqli)
- MySQL database
- HTML, CSS, JavaScript
- Sessions for login & cart management
- A custom cyberpunk-inspired UI theme

---

# ⭐ Features

## 🛒 Customer Features

### ✔ User Authentication
- Register, Login, Logout  
- Secure password storage using `password_hash()`  
- Sessions used for login state  

### ✔ Product Browsing
- View all products  
- Detailed product pages  
- Product images  
- Categories and descriptions  

### ✔ Shopping Cart
- Add to cart  
- Remove from cart  
- View cart with real-time totals  
- Checkout and place orders  
- Inventory now auto-updates after each order  

### ✔ Order Management
- View personal order history  
- Displays order total, date, and items  

### ✔ Product Reviews & Ratings (NEW)
- Logged-in users can leave reviews  
- 1–5 star rating system  
- Reviews displayed on product page with username  
- Average rating displayed at the top of each product  

---

## 🔐 Admin Features

### ✔ Admin Dashboard
- Access restricted using `is_admin = 1`

### ✔ Product Management
- Add new products  
- Edit existing products  
- Delete products  
- Manage images, categories, stock, and descriptions  

### ✔ Orders Management
- View all orders from every user  
- See customer name, email, total, and date  
- Inventory reduces based on orders (NEW)

---

# ⭐ Database Structure

Tables used in the project:

### `users`
- id  
- name  
- email  
- password_hash  
- is_admin  

### `products`
- id  
- name  
- description  
- price  
- image_url  
- category  
- stock  

### `cart`
- id  
- user_id  
- product_id  
- quantity  

### `orders`
- id  
- user_id  
- total_price  
- order_date  

### `reviews` (NEW)
- id  
- product_id  
- user_id  
- rating (1–5)  
- review_text  
- created_at  

---

# ⭐ Technologies Used

- PHP (Procedural, mysqli)  
- MySQL with phpMyAdmin  
- HTML5  
- CSS3 (Cyberpunk theme added)  
- JavaScript (basic validation)  
- XAMPP (Apache + MySQL)

---

# ⭐ Setup Instructions

Follow these steps to run the project successfully:

---

## 1️⃣ Move Project Folder
Place the entire folder named:

