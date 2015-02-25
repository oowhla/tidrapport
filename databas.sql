set FOREIGN_KEY_CHECKS = 0;
drop table if exists Names;
drop table if exists Activities;
drop table if exists Timereports;

create table Names (
	name varchar(30),
	primary key(name)
);

create table Activities (
	activity varchar(50),
	primary key(activity)
);

create table Timereports (
	name varchar(30),
	activity varchar(50),
	week int,
	day varchar(10),
	minutes int,
	primary key(name, week, day, activity),
	foreign key (name) references Names(name),
	foreign key (activity) references Activities(activity)
);

insert into Names(name) values
	('Ola'), 
	('Max');

insert into Activities(activity) values 
	('Rapportskrivning'), 
	('Undersökning'),
	('Design'),
	('Programmering'),
	('Testning');

insert into Timereports(name, activity, week, day, minutes) values
	('Ola', 'Design', 9, 'Wednesday', '80');


select sum(minutes) from Timereports where name='Ola';
