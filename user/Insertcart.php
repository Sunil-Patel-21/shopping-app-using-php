<?php
session_start(); // Start the session to use $_SESSION variables

// Check if the user is logged in
if (isset($_SESSION["user"])) {

    // If cart does not exist in session, create an empty cart array
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Getting product details from POST (using null coalescing operator to avoid errors)
    $product_name = $_POST['PName'] ?? '';
    $product_price = $_POST['PPrice'] ?? '';
    $product_quantity = $_POST['PQuantity'] ?? '';

    // ---------------------------
    // ADD TO CART FUNCTIONALITY
    // ---------------------------
    if (isset($_POST['addCart'])) {

        // Extract all product names from existing cart to check duplicates
        $check_product = array_column($_SESSION['cart'], 'productName');

        // Check if product already exists in cart
        if (in_array($product_name, $check_product)) {

            // If product exists, show alert and redirect to home
            echo "
            <script>
                alert('Product is already added in the cart');
                window.location.href='index.php';
            </script>
            ";

        } else {

            // Add new product item into the cart session
            $_SESSION['cart'][] = [
                'productName' => $product_name,
                'productPrice' => $product_price,
                'productQuantity' => $product_quantity
            ];

            // Redirect to viewCart page
            header('location: viewCart.php');
            exit;
        }
    }

    // ---------------------------
    // REMOVE ITEM FROM CART
    // ---------------------------
    if (isset($_POST['remove'])) {

        // Loop through cart items
        foreach ($_SESSION['cart'] as $key => $value) {

            // Match product using product name
            if ($value['productName'] === $_POST['item']) {

                // Remove the item from cart array
                unset($_SESSION['cart'][$key]);

                // Re-index array to remove gaps
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;
            }
        }

        // Redirect to cart page after removing
        header('location: viewCart.php');
        exit;
    }

    // ---------------------------
    // UPDATE ITEM IN CART
    // ---------------------------
    if (isset($_POST['update'])) {

        // Loop through cart items to find and update matching product
        foreach ($_SESSION['cart'] as $key => $value) {

            if ($value['productName'] === $_POST['item']) {

                // Update the cart item with new values
                $_SESSION['cart'][$key] = [
                    'productName' => $product_name,
                    'productPrice' => $product_price,
                    'productQuantity' => $product_quantity
                ];
            }
        }

        // Redirect to cart page after update
        header('location: viewCart.php');
        exit;
    }

// If user is not logged in → redirect to login page
} else {
    header("location:form/login.php");
}

?>
