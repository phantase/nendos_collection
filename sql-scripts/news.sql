-- Create the table
CREATE TABLE `news` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `summary` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `authorid` bigint(20) UNSIGNED NOT NULL,
  `creationdate` datetime NOT NULL,
  `editorid` bigint(20) UNSIGNED NOT NULL,
  `editiondate` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `news`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `author` (`authorid`),
  ADD KEY `editor` (`editorid`);
-- Add the auto increment
ALTER TABLE `news`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`authorid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`editorid`) REFERENCES `users` (`internalid`);
