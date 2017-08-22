-- Create the table
CREATE TABLE `tags_faces` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `faceid` bigint(20) UNSIGNED NOT NULL,
  `additiondate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `grade` int(11) NOT NULL DEFAULT '1',
  `tag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `tags_faces`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `faceid` (`faceid`);
-- Add the auto increment
ALTER TABLE `tags_faces`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `tags_faces`
  ADD CONSTRAINT `tags_faces_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `tags_faces_ibfk_2` FOREIGN KEY (`faceid`) REFERENCES `faces` (`internalid`);
