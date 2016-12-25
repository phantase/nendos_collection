-- Create the table
CREATE TABLE `photos_nendoroids` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `photoid` bigint(20) UNSIGNED NOT NULL,
  `nendoroidid` bigint(20) UNSIGNED NOT NULL,
  `xmin` int(11) DEFAULT NULL,
  `ymin` int(11) DEFAULT NULL,
  `xmax` int(11) DEFAULT NULL,
  `ymax` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `photos_nendoroids`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `photoid` (`photoid`),
  ADD KEY `nendoroidid` (`nendoroidid`);
-- Add the auto increment
ALTER TABLE `photos_nendoroids`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `photos_nendoroids`
  ADD CONSTRAINT `photos_nendoroids_ibfk_1` FOREIGN KEY (`photoid`) REFERENCES `photos` (`internalid`),
  ADD CONSTRAINT `photos_nendoroids_ibfk_2` FOREIGN KEY (`nendoroidid`) REFERENCES `nendoroids` (`internalid`);
