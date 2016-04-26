TRUNCATE new_address;

TRUNCATE new_cart;
TRUNCATE new_cart_cart_rule;
TRUNCATE new_cart_product;
TRUNCATE new_cart_rule;
TRUNCATE new_cart_rule_carrier;
TRUNCATE new_cart_rule_combination;
TRUNCATE new_cart_rule_country;
TRUNCATE new_cart_rule_group;
TRUNCATE new_cart_rule_lang;
TRUNCATE new_cart_rule_product_rule;
TRUNCATE new_cart_rule_product_rule_group;
TRUNCATE new_cart_rule_product_rule_value;
TRUNCATE new_cart_rule_shop;

TRUNCATE new_customer;
TRUNCATE new_customer_group;
TRUNCATE new_customer_message;
TRUNCATE new_customer_message_sync_imap;
TRUNCATE new_customer_thread;
TRUNCATE new_customer_visit;

TRUNCATE new_message;

TRUNCATE new_orders;
TRUNCATE new_order_carrier;
TRUNCATE new_order_cart_rule;
TRUNCATE new_order_detail;
TRUNCATE new_order_detail_tax;
TRUNCATE new_order_history;
TRUNCATE new_order_invoice;
TRUNCATE new_order_invoice_payment;
TRUNCATE new_order_invoice_tax;
TRUNCATE new_order_message;
TRUNCATE new_order_message_lang;
TRUNCATE new_order_payment;
TRUNCATE new_order_return;
TRUNCATE new_order_return_detail;
TRUNCATE new_order_slip;
TRUNCATE new_order_slip_detail;

TRUNCATE new_specific_price;
TRUNCATE new_specific_price_priority;
TRUNCATE new_specific_price_rule;
TRUNCATE new_specific_price_rule_condition;
TRUNCATE new_specific_price_rule_condition_group;

TRUNCATE new_stock_available;
TRUNCATE new_stock_mvt;
TRUNCATE new_warehouse_product_location;

INSERT INTO new_stock_available ( id_product, id_product_attribute, id_shop, id_shop_group, quantity, depends_on_stock, out_of_stock)
	SELECT id_product, 0 AS id_product_attribute, 1 AS id_shop, 0 AS id_shop_group, 0 AS quantity, 1 AS depends_on_stock, 1 AS out_of_stock
	FROM new_product;
INSERT INTO new_warehouse_product_location ( id_product, id_product_attribute, id_warehouse, location)
	SELECT id_product, 0 AS id_product_attribute, 2 AS id_warehouse, "" AS location
	FROM new_product

