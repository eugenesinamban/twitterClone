CREATE TABLE pre_users
(
    id int(11) NOT NULL auto_increment,
    email varchar(256) NOT NULL,
    link varchar(256) NOT NULL,
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(id)
)ENGINE=Innodb;