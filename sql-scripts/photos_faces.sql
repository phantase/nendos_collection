-- Create the table
CREATE TABLE `photos_faces` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `photoid` bigint(20) UNSIGNED NOT NULL,
  `faceid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `xmin` int(11) DEFAULT NULL,
  `ymin` int(11) DEFAULT NULL,
  `xmax` int(11) DEFAULT NULL,
  `ymax` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `photos_faces`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `photoid` (`photoid`),
  ADD KEY `faceid` (`faceid`),
  ADD KEY `userid` (`userid`);
-- Add the auto increment
ALTER TABLE `photos_faces`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `photos_faces`
  ADD CONSTRAINT `photos_faces_ibfk_1` FOREIGN KEY (`photoid`) REFERENCES `photos` (`internalid`),
  ADD CONSTRAINT `photos_faces_ibfk_2` FOREIGN KEY (`faceid`) REFERENCES `faces` (`internalid`),
  ADD CONSTRAINT `photos_faces_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `users` (`internalid`);
