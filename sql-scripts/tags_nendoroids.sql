-- Create the table
CREATE TABLE `tags_nendoroids` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `nendoroidid` bigint(20) UNSIGNED NOT NULL,
  `additiondate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `grade` int(11) NOT NULL DEFAULT '1',
  `tag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `tags_nendoroids`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `nendoroidid` (`nendoroidid`);
-- Add the auto increment
ALTER TABLE `tags_nendoroids`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `tags_nendoroids`
  ADD CONSTRAINT `tags_nendoroids_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `tags_nendoroids_ibfk_2` FOREIGN KEY (`nendoroidid`) REFERENCES `nendoroids` (`internalid`);
