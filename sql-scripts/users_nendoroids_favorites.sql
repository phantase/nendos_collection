-- Create the table
CREATE TABLE `users_nendoroids_favorites` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `nendoroidid` bigint(20) UNSIGNED NOT NULL,
  `additiondate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `users_nendoroids_favorites`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `nendoroidid` (`nendoroidid`);
-- Add the auto increment
ALTER TABLE `users_nendoroids_favorites`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `users_nendoroids_favorites`
  ADD CONSTRAINT `users_nendoroids_favorites_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `users_nendoroids_favorites_ibfk_2` FOREIGN KEY (`nendoroidid`) REFERENCES `nendoroids` (`internalid`);
