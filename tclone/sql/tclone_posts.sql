CREATE TABLE posts
(
    id int(11) NOT NULL auto_increment,
    user_id int(11) NOT NULL,
    post varchar(256) NOT NULL,
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(id)
)ENGINE=Innodb;