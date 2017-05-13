-- Create the table
CREATE TABLE `bodyparts` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `boxid` bigint(20) UNSIGNED DEFAULT NULL,
  `nendoroidid` bigint(20) UNSIGNED DEFAULT NULL,
  `part` varchar(25) NOT NULL,
  `main_color` varchar(30) NOT NULL,
  `other_color` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `creatorid` bigint(20) UNSIGNED NOT NULL,
  `creationdate` datetime NOT NULL,
  `editorid` bigint(20) UNSIGNED NOT NULL,
  `editiondate` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `validatorid` bigint(20) UNSIGNED DEFAULT NULL,
  `validationdate` datetime DEFAULT NULL,
  `haspicture` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `bodyparts`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `box_id` (`boxid`),
  ADD KEY `nendoroid_id` (`nendoroidid`),
  ADD KEY `creator` (`creatorid`),
  ADD KEY `editor` (`editorid`),
  ADD KEY `validatorid` (`validatorid`);
-- Add the auto increment
ALTER TABLE `bodyparts`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `bodyparts`
  ADD CONSTRAINT `bodyparts_ibfk_1` FOREIGN KEY (`boxid`) REFERENCES `boxes` (`internalid`),
  ADD CONSTRAINT `bodyparts_ibfk_2` FOREIGN KEY (`nendoroidid`) REFERENCES `nendoroids` (`internalid`),
  ADD CONSTRAINT `bodyparts_ibfk_3` FOREIGN KEY (`creatorid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `bodyparts_ibfk_4` FOREIGN KEY (`editorid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `bodyparts_ibfk_5` FOREIGN KEY (`validatorid`) REFERENCES `users` (`internalid`);
