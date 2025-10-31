-- create posts table
CREATE TABLE IF NOT EXISTS `posts` (
  `id` VARCHAR(24) NOT NULL PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- seed post data
INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
('1', 'First Post', 'This is the content of the first post.', NOW(), NOW()),
('2', 'Second Post', 'This is the content of the second post.', NOW(), NOW()),
('3', 'Third Post', 'This is the content of the third post.', NOW(), NOW());
