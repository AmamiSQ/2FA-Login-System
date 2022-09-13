create database test_base;
use test_base;

create table test(
username varchar(16),
pass varchar(16),
token int);

insert into `test` values('user1', 'pass1', null);
insert into `test` values('user2', 'pass2', null);
insert into `test` values('user3', 'pass3', null);

rename table `test` to `test_sql`;
select * from `test_sql`;

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    token INT
);

ALTER TABLE `users`
	ADD COLUMN token varchar(255);
select * from `users`;
insert into `users` values(8, 'user4', 'pass3', CURRENT_TIMESTAMP, 'test');