UPDATE `settings` SET `value` = '{\"version\":\"10.0.0\", \"code\":\"1000\"}' WHERE `key` = 'product_info';

-- SEPARATOR --

alter table users add user_deletion_reminder tinyint default 0 null;

-- SEPARATOR --

INSERT INTO `settings` (`key`, `value`) VALUES ('payu', '{}');

-- SEPARATOR --

INSERT INTO `settings` (`key`, `value`) VALUES ('paystack', '{}');

-- SEPARATOR --

INSERT INTO `settings` (`key`, `value`) VALUES ('razorpay', '{}');

-- SEPARATOR --

INSERT INTO `settings` (`key`, `value`) VALUES ('mollie', '{}');

-- SEPARATOR --

INSERT INTO `settings` (`key`, `value`) VALUES ('yookassa', '{}');
