create table courses(
	id int(10) not null primary key auto_increment,
	course varchar(100),
	course_abbr varchar(50),
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);