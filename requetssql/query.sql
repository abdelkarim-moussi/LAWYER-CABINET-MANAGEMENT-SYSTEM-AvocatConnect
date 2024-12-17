

-- ceate database syscabinetdb

create database syscabinetdb;


-- create table users
create table users(
firstname varchar(50) not null,
lastname varchar(50) not null,
email varchar(100) not null,
phonenumber varchar(20) not null,
password varchar(50) not null,
image blob not null,
role enum("client","lawyer") default "client"

);

-- create table reservations

create table reservations(
reservation_id int primary key auto_increment not null,
user_id  int not null,
reservation_date date not null,
status enum ("accept","refuse"),
foreign key(user_id) references users on delete cascade on update cascade
);

--create table lawyer info

create table lawyer_info(
lawyer_id int primary key auto_increment not null,
user_id  int not null,
biography text not null,
years_of_experience int not null,
contact_details varchar(200) not null,
speciality varchar(50) not null,
foreign key(user_id) references users on delete cascade on update cascade
);



--create table availability
create table availability(
availability_id int primary key auto_increment not null,
lawyer_id  int not null,
start_date date not null,
end_date date not null,
foreign key(lawyer_id) references lawyer_info on delete cascade on update cascade
);
