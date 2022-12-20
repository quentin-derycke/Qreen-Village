<?php

namespace App\Factory;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\OrderItem;
use App\Entity\Address;


// The OrderFactory factory will help us to create Order and OrderItem entities with default data. It also allows you to change the Order entity easily.

/**
 *
 * Class OrderFactory
 * @package App\Factory
 */


class OrderFactory
{
    /**
     * Creates an order.
     *
     * @return Order
     */
    public function create(): Order
    {
        $order = new Order();
        $order
            ->setStatus(Order::STATUS_CART)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());

        return $order;
    }


    /**
     * Creates an item for a product.
     *
     * @param Product $product
     *
     * @return OrderItem
     */
    public function createItem(Product $product): OrderItem
    {
        $item = new OrderItem();
        $item->setProduct($product);
        $item->setQuantity(1);

        return $item;
    }
    /**
     * Edits an order with a new status and address.
     *
     * @param Order $order
     *
     * @return Order
     */
    public function edit($order): Order
    {
        $order->setStatus(Order::STATUS_CHECK);
        $order->setUpdatedAt(new \DateTime());

        return $order;
    }
}