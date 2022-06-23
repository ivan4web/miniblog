CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(155) NOT NULL,
  `txt` text NOT NULL,
  `submit_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `blog_tags` (
  `id` int(11) NOT NULL,
  `id_blog` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `img` (
  `id` int(11) NOT NULL,
  `id_blog` int(11) NOT NULL,
  `filename` varchar(40) NOT NULL,
  `onm` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `login` varchar(12) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `email` varchar(80) NOT NULL,
  `submit_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_blog` (`id_blog`),
  ADD KEY `id_tag` (`id_tag`);

ALTER TABLE `img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_blog` (`id_blog`),
  ADD KEY `onm` (`onm`);

ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `blog_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

