# Restaurant Management System

The Restaurant Management System is a web-based application developed to simplify restaurant operations such as customer ordering, staff management, and order tracking.

This system allows customers to register, log in, place food orders, and generate a bill. Staff members can log in and view all customer orders along with the items ordered.

The project is built using PHP, MySQL, HTML, CSS, and XAMPP to simulate a real restaurant ordering workflow.

# Project Overview

This project simulates a restaurant ordering and management platform.

The system allows different users to interact with the application:

# Customer

Customers can:

Register an account

Login to the system

View menu items

Select multiple food items

Choose quantity

Select payment mode

Place an order

Generate a bill with GST calculation

# Staff

Staff members can:

Login to the system

View all customer orders

View items ordered in each order

Monitor order status

# System Architecture

The application follows a three-tier architecture.

## 1️. Presentation Layer

The user interface is built using:

HTML

CSS

# Basic styling components

This layer provides:

Login and registration pages

Menu display page

Order placement page

Staff dashboard for viewing orders

## 2️. Application Logic Layer

The application logic is implemented using PHP.

It handles:

User authentication

Session management

Order processing

Bill generation

Database communication

Staff access control

## 3️. Database Layer

The system uses MySQL as the database.

The database stores all restaurant information including:

Customer accounts

Staff accounts

Menu items

Orders

Order details

All operations are executed using SQL queries.

# Technologies Used

The project is developed using the following technologies:

HTML – Web page structure

CSS – Styling and layout

PHP – Backend logic

MySQL – Database management

XAMPP – Local server environment

phpMyAdmin – Database administration

GitHub – Version control and project hosting

 # Project Structure

Restaurant-Management-System



- db_connect.php
Database connection file.

- login.php
Handles login for customers and staff.

- register.php
Allows customers to create an account.

- order.php
Displays menu items and allows customers to place orders.

- view_orders.php
Allows staff to view all customer orders and ordered items.

- staff.php
Staff dashboard.

- style.css
Contains styling for the entire application.

. Database Tables

The system uses the following tables:

customer

Stores customer details.

## Fields:

CustomerID

Name

Phone

Email

Password

Role

staff

Stores staff login information.

## Fields:

StaffID

Name

Email

Password

Role

Salary

BranchID

menu_item

Stores available food items.

## Fields:

ItemID

ItemName

Price

CategoryID

orders

Stores order information.

## Fields:

OrderID

OrderDate

OrderStatus

CustomerID

BranchID

TableID

StaffID

TotalAmount

order_details

Stores ordered items.

## Fields:

OrderDetailID

OrderID

ItemID

Quantity

## Features

The system provides the following features:

Customer registration system

Customer login system

Staff login system

Menu item display

Multiple item selection

Quantity selection

Payment mode selection

Automatic bill generation

GST calculation

Order storage in database

Staff dashboard for viewing orders

Display ordered items per order

. How to Run the Project
- Method 1: Using XAMPP

Install XAMPP.

Start the following services:

Apache

MySQL

Copy the project folder into:

xampp/htdocs/

Example:

xampp/htdocs/restaurant

Open phpMyAdmin.

http://localhost/phpmyadmin

Create a database:

restaurant_db

Import or create the required tables.

Run the Project

Open your browser and go to:

http://localhost/restaurant/login.php

🔄 System Workflow

Customer Flow

Register
-->
Login
-->
Select Menu Items
-->
Choose Quantity
-->
Place Order
-->
Bill Generated
-->
Order Stored in Database

Staff Flow

Staff Login
-->
View Customer Orders
-->
View Ordered Items
