-- Create the table
CREATE TABLE `users` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `usermail` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `encpass` varchar(256) NOT NULL,
  `administrator` tinyint(1) NOT NULL DEFAULT '0',
  `validator` tinyint(1) NOT NULL DEFAULT '0',
  `editor` tinyint(1) NOT NULL DEFAULT '0',
  `signupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastviewdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `users`
  ADD PRIMARY KEY (`internalid`),
  ADD UNIQUE KEY `internalid` (`internalid`),
  ADD UNIQUE KEY `username` (`username`);
-- Add the auto increment
ALTER TABLE `users`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
