-- Create the table
CREATE TABLE `hairs` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `boxid` bigint(20) UNSIGNED DEFAULT NULL,
  `nendoroidid` bigint(20) UNSIGNED DEFAULT NULL,
  `main_color` varchar(30) NOT NULL,
  `other_color` varchar(30) NOT NULL,
  `haircut` varchar(30) NOT NULL,
  `description` varchar(150) NOT NULL,
  `frontback` varchar(20) NOT NULL,
  `creatorid` bigint(20) UNSIGNED NOT NULL,
  `creationdate` datetime NOT NULL,
  `editorid` bigint(20) UNSIGNED NOT NULL,
  `editiondate` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `validatorid` bigint(20) UNSIGNED DEFAULT NULL,
  `validationdate` datetime DEFAULT NULL,
  `haspicture` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `hairs`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `box_id` (`boxid`),
  ADD KEY `nendoroid_id` (`nendoroidid`),
  ADD KEY `creator` (`creatorid`),
  ADD KEY `editor` (`editorid`),
  ADD KEY `validatorid` (`validatorid`);
-- Add the auto increment
ALTER TABLE `hairs`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `hairs`
  ADD CONSTRAINT `hairs_ibfk_1` FOREIGN KEY (`boxid`) REFERENCES `boxes` (`internalid`),
  ADD CONSTRAINT `hairs_ibfk_2` FOREIGN KEY (`nendoroidid`) REFERENCES `nendoroids` (`internalid`),
  ADD CONSTRAINT `hairs_ibfk_3` FOREIGN KEY (`creatorid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `hairs_ibfk_4` FOREIGN KEY (`editorid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `hairs_ibfk_5` FOREIGN KEY (`validatorid`) REFERENCES `users` (`internalid`);
