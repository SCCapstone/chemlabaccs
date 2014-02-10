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


CREATE TABLE `section`(
	section_id int(10) NOT NULL,
	institute_id int(10) NOT NULL,
	building_id int(10) NOT NULL,
	room_num varchar(10)
	section_date date NOT NULL,
	Primary Key(section_id)
	);
	

CREATE TABLE `lab_user`(
	user_id int(10) NOT NULL,
	section_id int(10) NOT NULL,
	Primary Key(user_id, section_id)
	);

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `password_hash` varchar(40) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `theme` int(1) NOT NULL DEFAULT '0',
  `userlvl` varchar(32) NOT NULL,
  `institute_id` int(10) NOT NULL,
  FOREIGN KEY (`institute_id`) REFERENCES institution(`id`),
  PRIMARY KEY (`id`) 
);