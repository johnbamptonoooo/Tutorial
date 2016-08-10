USE `pokervelvet`;

--
-- Add user & privileges
--

CREATE USER 'pokeruser'@'IP_address' IDENTIFIED BY 'dsaewq321!';
GRANT DELETE, EXECUTE, INSERT, SELECT,  SHOW VIEW, UPDATE ON pokervelvet.* TO 'pokeruser'@'IP_address';