-- Create the table
CREATE TABLE `users_boxes_collection` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `boxid` bigint(20) UNSIGNED NOT NULL,
  `additiondate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `users_boxes_collection`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `boxid` (`boxid`);
-- Add the auto increment
ALTER TABLE `users_boxes_collection`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `users_boxes_collection`
  ADD CONSTRAINT `users_boxes_collection_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `users_boxes_collection_ibfk_2` FOREIGN KEY (`boxid`) REFERENCES `boxes` (`internalid`);
