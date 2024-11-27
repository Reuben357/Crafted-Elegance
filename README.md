# Crafted Elegance: Virtual Leather Shop
### Crafted Elegance is a web application that allows users to browse and purchase leather goods online. It utilizes a MySQL database to store product information, user accounts, orders, and more.

## Features And Functionalities
* User Accounts:Create accounts and login for secure access.
* Product Management: View product listings, detailed descriptions, and categories.
* Shopping Cart: Add products to a cart for purchase.
* Checkout: Complete purchases and receive confirmation emails with total order cost.
* Order History: View past orders and track their status.


## Database
The application uses a MySQL database named leatherdb, with tables including:
 * products: Stores product information like name, description, price, and category.
 * categories: Organizes products by category type.
 * users: Stores user account information, including login credentials and order history.
 * orders: Tracks user orders, including details on purchased items and total cost.

## Getting Started

1. Prerequisites:
   * PHP and a web server (Apache or Nginx) with PHP support
   * MySQL database server

2. Installation:
    * Download or clone the project source code.
       > git clone https://github.com/Reuben357/Crafted-Elegance
   
    * Configure your web server to point to the project directory.
    * Import the leatherdb.sql file (or equivalent) into your MySQL database server.
    * Update the database connection details in the application configuration file (e.g., config.php).

3. Running the Application:
    * Visit the application URL in your web browser.
    * Create a user account and start shopping!

4. Contributing
   ### Feel free to contribute to this project by:
     * Reporting bugs
     * Suggesting improvements through issues
     * Forking the repo and creating pull requests with your changes
