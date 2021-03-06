-- Create the table
CREATE TABLE `photos_accessories` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `photoid` bigint(20) UNSIGNED NOT NULL,
  `accessoryid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `xmin` int(11) DEFAULT NULL,
  `ymin` int(11) DEFAULT NULL,
  `xmax` int(11) DEFAULT NULL,
  `ymax` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `photos_accessories`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `photoid` (`photoid`),
  ADD KEY `accessoryid` (`accessoryid`),
  ADD KEY `userid` (`userid`);
-- Add the auto increment
ALTER TABLE `photos_accessories`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `photos_accessories`
  ADD CONSTRAINT `photos_accessories_ibfk_1` FOREIGN KEY (`photoid`) REFERENCES `photos` (`internalid`),
  ADD CONSTRAINT `photos_accessories_ibfk_2` FOREIGN KEY (`accessoryid`) REFERENCES `accessories` (`internalid`),
  ADD CONSTRAINT `photos_accessories_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `users` (`internalid`);
