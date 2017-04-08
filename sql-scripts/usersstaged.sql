-- Create the table
CREATE TABLE `usersstaged` (
  `internalid` bigint(20) UNSIGNED NOT NULL,
  `usermail` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `encpass` varchar(256) NOT NULL,
  `registrationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `registrationcode` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Add the indexes
ALTER TABLE `usersstaged`
  ADD PRIMARY KEY (`internalid`);
-- Add the auto increment
ALTER TABLE `usersstaged`
  MODIFY `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
