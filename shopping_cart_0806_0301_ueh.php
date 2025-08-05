<?php
// 代码生成时间: 2025-08-06 03:01:51
class Shopping_cart extends CI_Controller {

    private $cart_items = [];

    public function __construct() {
        parent::__construct();
        $this->load->model('cart_model');
    }

    /**
     * Add item to the cart
     *
     * @param array $item Item details to add to cart
     */
    public function add($item) {
        if (!isset($item['id']) || !isset($item['name']) || !isset($item['price'])) {
            // Handle error
            return false;
        }

        if (isset($this->cart_items[$item['id']])) {
            // If item already exists in cart, increment quantity
            $this->cart_items[$item['id']]['quantity'] += 1;
        } else {
            // Add new item to cart
            $this->cart_items[$item['id']] = $item + ['quantity' => 1];
        }

        return true;
    }

    /**
     * Remove item from the cart
     *
     * @param int $id Item ID to remove from cart
     */
    public function remove($id) {
        if (isset($this->cart_items[$id])) {
            unset($this->cart_items[$id]);
            return true;
        }

        return false;
    }

    /**
     * Update cart item quantity
     *
     * @param int $id Item ID to update
     * @param int $quantity New quantity of the item
     */
    public function update($id, $quantity) {
        if (isset($this->cart_items[$id])) {
            $this->cart_items[$id]['quantity'] = $quantity;
            return true;
        }

        return false;
    }

    /**
     * Get all items in the cart
     *
     * @return array Cart items
     */
    public function get_items() {
        return $this->cart_items;
    }

    /**
     * Clear the cart
     */
    public function clear() {
        $this->cart_items = [];
    }
}
