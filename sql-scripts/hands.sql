-- Create the table
CREATE TABLE `hands` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `boxid` bigint(20) UNSIGNED DEFAULT NULL,
  `nendoroidid` bigint(20) UNSIGNED DEFAULT NULL,
  `skin_color` varchar(30) NOT NULL,
  `leftright` varchar(10) NOT NULL,
  `posture` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  `creatorid` bigint(20) UNSIGNED NOT NULL,
  `creationdate` datetime NOT NULL,
  `editorid` bigint(20) UNSIGNED NOT NULL,
  `editiondate` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `validatorid` bigint(20) UNSIGNED DEFAULT NULL,
  `validationdate` datetime DEFAULT NULL,
  `haspicture` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `hands`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `box_id` (`boxid`),
  ADD KEY `nendoroid_id` (`nendoroidid`),
  ADD KEY `creator` (`creatorid`),
  ADD KEY `editor` (`editorid`),
  ADD KEY `validatorid` (`validatorid`);
-- Add the auto increment
ALTER TABLE `hands`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `hands`
  ADD CONSTRAINT `hands_ibfk_1` FOREIGN KEY (`boxid`) REFERENCES `boxes` (`internalid`),
  ADD CONSTRAINT `hands_ibfk_2` FOREIGN KEY (`nendoroidid`) REFERENCES `nendoroids` (`internalid`),
  ADD CONSTRAINT `hands_ibfk_3` FOREIGN KEY (`creatorid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `hands_ibfk_4` FOREIGN KEY (`editorid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `hands_ibfk_5` FOREIGN KEY (`validatorid`) REFERENCES `users` (`internalid`);
