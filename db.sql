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
SELECT token FROM users WHERE username = 'user1';

insert into `users` values(12, 'notoken1', 'password1', CURRENT_TIMESTAMP, null);
insert into `users` values(13, 'notoken2', 'password2', CURRENT_TIMESTAMP, null);
insert into `users` values(14, 'notoken3', 'password3', CURRENT_TIMESTAMP, null);