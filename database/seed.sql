-- Seed data for the 'posts' table
DELETE FROM posts;

INSERT INTO posts
(id, title, content, created_at, updated_at) VALUES
(1, 'Welcome to the Blog!', 'Exploring the basics of our new blog platform. Stay tuned for updates!', NOW(), NOW()),
(2, 'Feature Highlights', 'A quick overview of the features we plan to implement.', NOW(), NOW()),
(3, 'Getting Started Guide', 'How to get started with your first post and customize your profile.', NOW(), NOW()),
(4, 'Writing Tips', 'Tips and tricks for writing engaging content that attracts readers.', NOW(), NOW()),
(5, 'Understanding Analytics', 'Understanding the analytics dashboard and tracking your growth.', NOW(), NOW()),
(6, 'Developer Interview', 'Interview with our lead developer about the project vision.', NOW(), NOW()),
(7, 'Community Roundup', 'A roundup of the best posts from our community this week.', NOW(), NOW()),
(8, 'Organizing Content', 'How to use tags and categories to organize your posts.', NOW(), NOW()),
(9, 'Writing Contest Announced', 'Announcing our upcoming writing contest with exciting prizes.', NOW(), NOW()),
(10, 'Backend Insights', 'Behind the scenes: Building a scalable backend for the blog.', NOW(), NOW()),
(11, 'User Spotlight', 'User spotlight: Meet one of our most active contributors.', NOW(), NOW()),
(12, 'Media Embedding', 'How to embed images and videos in your articles.', NOW(), NOW()),
(13, 'Account Security', 'Security tips for keeping your account safe and secure.', NOW(), NOW()),
(14, 'Giving Feedback', 'The importance of feedback and how to give constructive comments.', NOW(), NOW()),
(15, 'Mobile Blogging', 'Mobile experience: Writing and reading posts on the go.', NOW(), NOW()),
(16, 'Data Privacy', 'How we handle data privacy and user information.', NOW(), NOW()),
(17, 'Upcoming Features', 'Upcoming features: What’s next for our blogging platform?', NOW(), NOW()),
(18, 'Collaborative Writing', 'A guide to collaborating with other writers on shared posts.', NOW(), NOW()),
(19, 'Troubleshooting Login', 'How to recover your password and troubleshoot login issues.', NOW(), NOW()),
(20, 'Thank You!', 'Thank you for being part of our growing community!', NOW(), NOW());
