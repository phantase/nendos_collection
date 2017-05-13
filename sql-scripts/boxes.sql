-- Create the table
CREATE TABLE `boxes` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(5) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `series` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `price` double DEFAULT NULL,
  `releasedate` date DEFAULT NULL,
  `specifications` varchar(200) DEFAULT NULL,
  `sculptor` varchar(50) DEFAULT NULL,
  `cooperation` varchar(50) DEFAULT NULL,
  `officialurl` varchar(200) DEFAULT NULL,
  `creatorid` bigint(20) UNSIGNED NOT NULL,
  `creationdate` datetime NOT NULL,
  `editorid` bigint(20) UNSIGNED NOT NULL,
  `editiondate` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `validatorid` bigint(20) UNSIGNED DEFAULT NULL,
  `validationdate` datetime DEFAULT NULL,
  `haspicture` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `boxes`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD KEY `creator` (`creatorid`),
  ADD KEY `editor` (`editorid`),
  ADD KEY `validatorid` (`validatorid`);
-- Add the auto increment
ALTER TABLE `boxes`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `boxes`
  ADD CONSTRAINT `boxes_ibfk_1` FOREIGN KEY (`creatorid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `boxes_ibfk_2` FOREIGN KEY (`editorid`) REFERENCES `users` (`internalid`),
  ADD CONSTRAINT `boxes_ibfk_3` FOREIGN KEY (`validatorid`) REFERENCES `users` (`internalid`);
