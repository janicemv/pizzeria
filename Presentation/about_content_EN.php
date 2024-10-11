<?php
// Presentation/about_content.php

declare(strict_types=1);

$title = "About";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php"; ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>

    <div class="container">
        <h1><?= $title ?></h1>

        <p>This project, developed as a final PHP exercise, explores the creation of a functional online ordering system for a pizzeria. Implemented following the MVC model, the system integrates different aspects of an e-commerce platform, from pizza viewing to order processing and inventory management. Visitors can browse the available pizzas and add items to the cart without needing to create an account, providing a simplified and smooth user experience.</p>

        <p>The system's goal is to simulate a real online ordering environment, where customers can register, log in, and track their orders. Additionally, the system includes advanced features such as promotions handling, delivery address validation, and order management, offering a comprehensive view of how to develop a robust and scalable PHP application. This project demonstrates how best programming practices and an efficient database structure can be applied to meet the needs of a real-world client.</p>

        <h2 class="p-2">Basic features implemented in the project:</h2>

        <h4>User Registration and Login:</h4>
        <ul class="p-3">
            <li>Users can create an account or log in using their email and password.</li>
            <li>Option to place orders as a guest without creating an account.</li>
        </ul class="p-3">

        <h4>Pizza Catalog:</h4>
        <ul class="p-3">
            <li>Display all available pizzas with names, prices, and descriptions.</li>
            <li>Add pizzas to the shopping cart and view the cart contents at any time.</li>
        </ul class="p-3">

        <h4>Shopping Cart:</h4>
        <ul class="p-3">
            <li>Add, remove, or adjust pizza quantities in the cart.</li>
            <li>Real-time update of total price based on cart contents.</li>
        </ul class="p-3">

        <h4>Order Checkout:</h4>
        <ul class="p-3">
            <li>Address validation during the checkout process, restricting orders to certain postal codes.</li>
            <li>A summary page to review and confirm the order before finalizing.</li>
        </ul class="p-3">

        <h4>Order Management:</h4>
        <ul class="p-3">
            <li>Track the status of orders (ordered, prepared, delivered).</li>
            <li>Option for the admin or user to update the order status.</li>
        </ul class="p-3">

        <h4>Promotions:</h4>
        <ul class="p-3">
            <li>Apply discounts and special prices for eligible customers.</li>
            <li>Handle promotional pricing dynamically during checkout.</li>
        </ul class="p-3">

        <h4>Database Integration:</h4>
        <ul class="p-3">
            <li>MySQL database to store and retrieve user data, orders, and pizza information.</li>
            <li>Use of SQL queries for efficient data management.</li>
        </ul class="p-3">

        <p>These functionalities offer a complete online ordering workflow, from browsing products to tracking the status of placed orders.</p>

        <div class="container mt-5">
            <pre class="bg-light p-3 rounded">
            <code>
# WORKING METHOD (translation of the full assignment)

The test consists of two parts.

[X] In the first part, you determine the database structure and create a rough sketch of the user interface.

_Then discuss your results with the permanent instructor._

[X] In the second part, you start from this database structure and implement it in MySQL.

[X] Develop the application following an MVC model.  
**[X] Don’t forget to implement proper error handling where necessary.**  
[X] Although somewhat subordinate, also try to take care of the layout of the web pages.

You have five days to complete the entire project.

[X] It is important that the result works, that the underlying architecture is built according to best practices, and that it is driven by a user-friendly interface.

# THE CASE  
The operator of a pizzeria wishes to expand their services to include the ability to order pizzas online and have them delivered to customers' homes. To avoid disturbing customers who are dining on-site, picking up pizzas is not allowed.

## Overview and Ordering

[X] Non-registered visitors can view the entire range of pizzas.  
[X] Alongside product information, they can also find the price.  
[X] Users can add pizzas to a virtual shopping cart and remove pizzas from this cart at any time.  
[X] To enhance user-friendliness, the contents of the shopping cart should always be visible when viewing the range of pizzas.  
[X] When users are satisfied with the contents of the cart, there is a "Checkout" button available.  
[X] If the visitor is already logged in with an existing account, they will be immediately redirected to a page showing an overview of the order (see section “Checkout”).

[X] If the visitor is not logged in, a page with two options will first be displayed:

- I have an account  
- I do not have an account  

[X] For the option “I have an account,” an input box for the email address and password will be provided. If the correct details for an existing account are filled in, the visitor will be automatically logged in and redirected to a page showing an overview of the order (see section “Checkout”).

[X] For the option “I do not have an account,” the following details must be filled in on the spot: name, first name, address, postal code, city, and phone number.  
[X] There is also a checkbox available that the visitor can tick to create a new account based on this information (in that case, an email address and password will also be requested).  
[X] After that, they will automatically be redirected to the “Checkout” page.

## Checkout

[X] Finally, the visitor will see an overview page with all the details of the order, as well as the total price of the order.  
[X] Note that home delivery is not possible in all municipalities. The visitor will receive an error message when entering a postal code where delivery cannot be made.  
[X] There are links provided on the checkout page that the visitor can follow to update their address details or the contents of the shopping cart last minute.

## Other Facilities and Miscellaneous

### Products

[X] For products, the name and price are the most important.  
[X] Additionally, composition/nutritional values, availability (seasonal products), etc., can also be advantages for a good site (optional).  
[X] A promotional price can also be set, which becomes active when a customer qualifies for it (see section “Customers”).

### Customers

[X] For each customer, name, first name, street, house number, postal code, city of residence, phone or mobile number, email address, password **(encrypted with MD5)**, and any special remarks will be stored. It is also possible to determine whether a particular customer is eligible for promotional prices.  
[X] Ensure that the email address of the last correct login is always remembered in a cookie, so the customer does not have to enter their email address again to log in. Note that the password must always be entered again.

### General Information – Who We Are (optional)

_[X] Information about the business, ongoing promotions, terms, guestbook, etc._

### Order Information

[X] Of course, the customer number, date, and time of the order will be kept track of here, as well as quantities, types, extras, cost price, and any information for the pizza delivery person.
        </code>
        </pre>
        </div>


        <?php require_once "presentation/components/footer.html"; ?>
    </div>

</body>


</html>