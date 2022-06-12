drop database teadb;
create database teadb;
use teadb;


create table users(
u_ID int unsigned primary key auto_increment,
u_fname varchar(20) not null,
u_lname varchar(20) not null,
u_phone varchar(11) not null,
u_gender enum('Male', 'Female') not null,
u_username varchar(25) not null,
u_password varchar(15) not null
);

insert into users(u_fname, u_lname, u_phone, u_gender, u_username, u_password) values('Ahmed', 'Shark', '1122335566', 1, 'aha' ,'121');
insert into users(u_fname, u_lname, u_phone, u_gender, u_username, u_password) values('Mateusz', 'Drząkowski ', '666555444', 1, 'Mat' ,'321');
insert into users(u_fname, u_lname, u_phone, u_gender, u_username, u_password) values('Alaa', 'Al-Dayyeni', '111222333', 1, 'Ala' ,'123');
insert into users(u_fname, u_lname, u_phone, u_gender, u_username, u_password) values('Zhela', 'Sarbast', '555444333', 2, 'Zhelo' ,'111');
insert into users(u_fname, u_lname, u_phone, u_gender, u_username, u_password) values('Sara', 'Mardin', '44556644', 2, 'Sara' ,'231');


create table roles(
r_ID int unsigned primary key auto_increment,
r_role enum('Admin', 'Mod', 'User') not null,
r_fk_user_id int unsigned not null,
foreign key (`r_fk_user_id`) references `users` (`u_ID`)
);
/*1233*/

insert into roles(r_role, r_fk_user_id) values('Admin', 1);
insert into roles(r_role, r_fk_user_id) values('Admin', 2);
insert into roles(r_role, r_fk_user_id) values('User', 3);
insert into roles(r_role, r_fk_user_id) values('User', 4);
insert into roles(r_role, r_fk_user_id) values('User', 5);

create table toys(
t_ID int unsigned primary key auto_increment,
t_name varchar(75) not null,
t_description text,
t_photo char(75),
t_fk_user_id int unsigned not null,
foreign key (`t_fk_user_id`) references `users` (`u_ID`)
);

insert into toys(t_name, t_description, t_photo, t_fk_user_id) values('Toy 1', "Lorem Ipsum is simply dummy text of the printing and typesetting industry.", './uploads/photos/toys/1.jpg', 3);
insert into toys(t_name, t_description, t_photo, t_fk_user_id) values('Toy 2', "Lorem Ipsum is simply dummy text of the printing and typesetting industry.", '', 4);
insert into toys(t_name, t_description, t_photo, t_fk_user_id) values('Toy 3', "Lorem Ipsum is simply dummy text of the printing and typesetting industry.", './uploads/photos/toys/3.jpg', 4);
insert into toys(t_name, t_description, t_photo, t_fk_user_id) values('Toy 4', "Lorem Ipsum is simply dummy text of the printing and typesetting industry.", './uploads/photos/toys/4.jpg', 3);

create table offer(
o_ID int unsigned primary key auto_increment,
o_city varchar(75) not null,
o_age_min tinyint,
o_type enum('sell', 'exchange', 'sellexchange') not null,
o_price int not null,
o_delivery enum('courier', 'pickup_in_person') not null,
o_fk_user_id int unsigned not null,
o_fk_toy_id int unsigned not null,
foreign key (`o_fk_user_id`) references `users` (`u_ID`),
foreign key (`o_fk_toy_id`) references `toys` (`t_ID`)
);

insert into offer(o_city, o_age_min, o_type, o_price, o_delivery, o_fk_user_id, o_fk_toy_id) values('Wroclaw', 5, 2, 0, 2, 3, 1);
insert into offer(o_city, o_age_min, o_type, o_price, o_delivery, o_fk_user_id, o_fk_toy_id) values('Warsaw', 8, 1, 12, 1, 4, 2);
insert into offer(o_city, o_age_min, o_type, o_price, o_delivery, o_fk_user_id, o_fk_toy_id) values('Ludz', 8, 3, 5, 1, 5, 3);
insert into offer(o_city, o_age_min, o_type, o_price, o_delivery, o_fk_user_id, o_fk_toy_id) values('Wroclaw', 7, 2, 0, 2, 4, 4);


create table comments(
c_ID int unsigned primary key auto_increment,
c_comment text not null,
c_fk_commenter_id int unsigned not null,
c_fk_user_id int unsigned not null,
foreign key (`c_fk_commenter_id`) references `users` (`u_ID`),
foreign key (`c_fk_user_id`) references `users` (`u_ID`)
);

insert into comments(c_comment, c_fk_commenter_id, c_fk_user_id) values('Amazing toy, thanks', 3, 5);
insert into comments(c_comment, c_fk_commenter_id, c_fk_user_id) values('the toy was broken', 3, 4);
insert into comments(c_comment, c_fk_commenter_id, c_fk_user_id) values('The toy was very chefull for the child', 4, 5);

