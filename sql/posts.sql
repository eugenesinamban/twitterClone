CREATE TABLE `posts` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `userId` int(11) NOT NULL,
 `post` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
 `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci