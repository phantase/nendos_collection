-- Create the table
CREATE TABLE `usersstagedforgot` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `usermail` varchar(50) NOT NULL,
  `requestdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `requestcode` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `usersstagedforgot`
  ADD PRIMARY KEY (`internalid`);
-- Add the auto increment
ALTER TABLE `usersstagedforgot`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Add the constraints
ALTER TABLE `usersstagedforgot`
  ADD CONSTRAINT `usersstagedforgot_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`internalid`);
