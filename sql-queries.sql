create DATABASE accounts;

use accounts;

create table users(
    user_id int AUTO_INCREMENT,
    first_name varchar(30) not null,
    last_name varchar(30) not null,
    email varchar(50) not null UNIQUE,
    password varchar(12) not null,
    PRIMARY KEY(user_id)
);

INSERT INTO users (first_name, last_name, email, password)
VALUES ("fyan", "lyan", "yan@email.com", "123");
