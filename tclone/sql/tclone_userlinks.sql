CREATE TABLE userlinks
(
    id int(11) NOT NULL auto_increment,
    following_user_id int(11) NOT NULL,
    followed_user_id int(11) NOT NULL,
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(id)
)ENGINE=Innodb;