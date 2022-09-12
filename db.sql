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
