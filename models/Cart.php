<?php

class Cart
{
	public static function getCart(): array
	{
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = [];
		}
		return $_SESSION['cart'];
	}

	public static function addItem(int $productId, int $quantity = 1): void
	{
		$cart = self::getCart();
		if (isset($cart[$productId])) {
			$cart[$productId] += max(1, $quantity);
		} else {
			$cart[$productId] = max(1, $quantity);
		}
		$_SESSION['cart'] = $cart;
	}

	public static function updateQuantities(array $quantities): void
	{
		$cart = self::getCart();
		foreach ($quantities as $pid => $qty) {
			$pid = (int)$pid; $qty = (int)$qty;
			if ($qty <= 0) {
				unset($cart[$pid]);
			} else {
				$cart[$pid] = $qty;
			}
		}
		$_SESSION['cart'] = $cart;
	}

	public static function remove(int $productId): void
	{
		$cart = self::getCart();
		unset($cart[$productId]);
		$_SESSION['cart'] = $cart;
	}

	public static function clear(): void
	{
		unset($_SESSION['cart']);
	}

	public static function countItems(): int
	{
		return array_sum(self::getCart());
	}
} 