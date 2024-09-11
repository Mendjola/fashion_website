<?php

/* Add Products in Cart */

if (isset($_POST['add_to_cart'])) {
    if ($user_id != '') {
        $product_id = $_POST['product_id'];
        $qty = $_POST['qty'];

        // Check if the product is in stock
        $select_product_stock = $conn->prepare("SELECT stock FROM `products` WHERE id = ?");
        $select_product_stock->execute([$product_id]);
        $product_stock = $select_product_stock->fetchColumn();

        if ($product_stock > 0) {
            // Product is in stock, proceed to add it to the cart

            // Check if the product already exists in the user's cart
            $existing_cart_item_query = $conn->prepare("SELECT * FROM `cart` WHERE product_id = ? AND user_id = ?");
            $existing_cart_item_query->execute([$product_id, $user_id]);

            if ($existing_cart_item_query->rowCount() > 0) {
                // Product already exists, update its quantity
                $existing_cart_item = $existing_cart_item_query->fetch(PDO::FETCH_ASSOC);
                $new_qty = $existing_cart_item['qty'] + $qty;

                // Update the quantity of the existing cart item
                $update_cart_item_query = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
                $update_cart_item_query->execute([$new_qty, $existing_cart_item['id']]);
                $success[] = 'Quantity updated in the cart!';
            } else {
                // Product doesn't exist, insert it into the cart
                $select_product_info = $conn->prepare("SELECT seller_id, price, image FROM `products` WHERE id = ?");
                $select_product_info->execute([$product_id]);
                $product_info = $select_product_info->fetch(PDO::FETCH_ASSOC);

                $id = unique_id();
                $insert_cart = $conn->prepare("INSERT INTO `cart`(id, user_id, product_id, seller_id, price, qty, image) VALUES(?,?,?,?,?,?,?)");
                $insert_cart->execute([$id, $user_id, $product_id, $product_info['seller_id'], $product_info['price'], $qty, $product_info['image']]);
                $success[] = 'Added to cart!';
            }
        } else {
            // Product is out of stock, display a message
            $warning[] = 'This product is out of stock and cannot be added to the cart.';
        }gi
    } else {
        $warning[] = 'Please login first!';
    }
}

?>
