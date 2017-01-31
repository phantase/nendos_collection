-- Create the table
CREATE TABLE `history` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `boxid` bigint(20) UNSIGNED DEFAULT NULL,
  `nendoroidid` bigint(20) UNSIGNED DEFAULT NULL,
  `accessoryid` bigint(20) UNSIGNED DEFAULT NULL,
  `bodypartid` bigint(20) UNSIGNED DEFAULT NULL,
  `faceid` bigint(20) UNSIGNED DEFAULT NULL,
  `hairid` bigint(20) UNSIGNED DEFAULT NULL,
  `handid` bigint(20) UNSIGNED DEFAULT NULL,
  `photoid` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(20) NOT NULL,
  `actiondate` datetime NOT NULL,
  `detail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `history`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `boxid` (`boxid`),
  ADD KEY `nendoroidid` (`nendoroidid`),
  ADD KEY `accessoryid` (`accessoryid`),
  ADD KEY `bodypartid` (`bodypartid`),
  ADD KEY `faceid` (`faceid`),
  ADD KEY `hairid` (`hairid`),
  ADD KEY `handid` (`handid`),
  ADD KEY `photoid` (`photoid`),
  ADD KEY `userid` (`userid`);
-- Add the auto increment
ALTER TABLE `history`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`boxid`) REFERENCES `boxes` (`internalid`),
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`nendoroidid`) REFERENCES `nendoroids` (`internalid`),
  ADD CONSTRAINT `history_ibfk_3` FOREIGN KEY (`accessoryid`) REFERENCES `accessories` (`internalid`),
  ADD CONSTRAINT `history_ibfk_4` FOREIGN KEY (`bodypartid`) REFERENCES `bodyparts` (`internalid`),
  ADD CONSTRAINT `history_ibfk_5` FOREIGN KEY (`faceid`) REFERENCES `faces` (`internalid`),
  ADD CONSTRAINT `history_ibfk_6` FOREIGN KEY (`hairid`) REFERENCES `hairs` (`internalid`),
  ADD CONSTRAINT `history_ibfk_7` FOREIGN KEY (`handid`) REFERENCES `hands` (`internalid`),
  ADD CONSTRAINT `history_ibfk_8` FOREIGN KEY (`userid`) REFERENCES `users` (`internalid`);
  ADD CONSTRAINT `history_ibfk_9` FOREIGN KEY (`photoid`) REFERENCES `photos` (`internalid`);
