-- create `posts` table
CREATE TABLE IF NOT EXISTS `posts` (
  `id` VARCHAR(24) NOT NULL PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `author_id` VARCHAR(24) DEFAULT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,

  FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- seed `posts` data
INSERT INTO `posts` (`id`, `title`, `content`, `author_id`, `created_at`, `updated_at`) VALUES
('1', 'First Post', 'This is the content of the first post.', '1', NOW(), NOW()),
('2', 'Second Post', 'This is the content of the second post.', '2', NOW(), NOW()),
('3', 'Third Post', 'This is the content of the third post.', '3', NOW(), NOW()),
('4', 'Fourth Post', 'This is the content of the fourth post.', '4', NOW(), NOW()),
('5', 'Fifth Post', 'This is the content of the fifth post.', '5', NOW(), NOW()),
('6', 'Sixth Post', 'This is the content of the sixth post.', '6', NOW(), NOW()),
('7', 'Seventh Post', 'This is the content of the seventh post.', '7', NOW(), NOW()),
('8', 'Eighth Post', 'This is the content of the eighth post.', '8', NOW(), NOW()),
('9', 'Ninth Post', 'This is the content of the ninth post.', '9', NOW(), NOW()),
('10', 'Tenth Post', 'This is the content of the tenth post.', '10', NOW(), NOW());
