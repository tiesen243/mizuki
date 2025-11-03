-- create `users` table
CREATE TABLE IF NOT EXISTS `users` (
  `id` VARCHAR(24) NOT NULL PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- seed `users` data
INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
('1', 'john_doe', 'john@mizuki.com', 'hashed_password_1', NOW(), NOW()),
('2', 'jane_smith', 'jane@mizuki.com', 'hashed_password_2', NOW(), NOW()),
('3', 'alice_wonder', 'alice@mizuki.com', 'hashed_password_3', NOW(), NOW()),
('4', 'bob_builder', 'bob@mizuki.com', 'hashed_password_4', NOW(), NOW()),
('5', 'charlie_brown', 'charlie@mizuki.com', 'hashed_password_5', NOW(), NOW()),
('6', 'diana_prince', 'diana@mizuki.com', 'hashed_password_6', NOW(), NOW()),
('7', 'eve_online', 'eve@mizuki.com', 'hashed_password_7', NOW(), NOW()),
('8', 'frank_castle', 'frank@mizuki.com', 'hashed_password_8', NOW(), NOW()),
('9', 'grace_hopper', 'grace@mizuki.com', 'hashed_password_9', NOW(), NOW()),
('10', 'harry_potter', 'harry@mizuki.com', 'hashed_password_10', NOW(), NOW());
