CREATE TABLE `comments`(
comment_id int(10) NOT NULL,
user_id int(10) NOT NULL,
accident_id int(10) NOT NULL,
message varchar(1000) NOT NULL,
image_url varchar(250),
comment_date date NOT NULL,
comment_time time NOT NULL,
Primary Key(comment_id)
);


CREATE TABLE `institution`(
id int(10) NOT NULL,
name varchar(50) NOT NULL,
join_date date NOT NULL,
primary_admin int(10) NOT NULL,
Primary Key(id)
);