CREATE TABLE users
(
    id int(11) NOT NULL auto_increment,
    name varchar(32) NOT NULL,
    email varchar(256) NOT NULL,
    password varchar(256) NOT NULL,
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(id)
)ENGINE=Innodb;