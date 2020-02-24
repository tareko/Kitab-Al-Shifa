# create databases
CREATE DATABASE IF NOT EXISTS `kitab`;
CREATE DATABASE IF NOT EXISTS `joomla`;

# grant rights to myapp user
GRANT ALL PRIVILEGES ON *.* TO 'myapp';
