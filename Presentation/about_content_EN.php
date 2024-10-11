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

        <p>This project explores the creation of a functional online ordering system for a pizzeria. Implemented following the MVC model, the system integrates different aspects of an e-commerce platform, from pizza viewing to order processing and inventory management. Visitors can browse the available pizzas and add items to the cart without needing to create an account, providing a simplified and smooth user experience.</p>

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

        <?php require_once "presentation/components/footer.html"; ?>
    </div>

</body>


</html>