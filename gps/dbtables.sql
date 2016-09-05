#
#  dbtables.sql
#
#  Simplifies the task of creating all the database tables
#  used by the login system.
#
#  Can be run from command prompt by typing:
#
#  mysql -u yourusername -D yourdatabasename < dbtables.sql
#
#  That's with dbtables.sql in the mysql bin directory, but
#  you can just include the path to dbtables.sql and that's
#  fine too.
#
#  Please subscribe to our feeds at http://blog.geotitles.com for more such tutorials
#

#
#  Table structure for users table
#
DROP TABLE IF EXISTS blog_users;

CREATE TABLE blog_users (
 username varchar(30) primary key,
 password varchar(32),
 userid varchar(32),
 userlevel tinyint(1) unsigned not null,
 email varchar(50),
 timestamp int(11) unsigned not null
);


#
#  Table structure for active users table
#
DROP TABLE IF EXISTS blog_active_users;

CREATE TABLE blog_active_users (
 username varchar(30) primary key,
 timestamp int(11) unsigned not null
);


#
#  Table structure for active guests table
#
DROP TABLE IF EXISTS blog_active_guests;

CREATE TABLE blog_active_guests (
 ip varchar(15) primary key,
 timestamp int(11) unsigned not null
);


#
#  Table structure for banned users table
#
DROP TABLE IF EXISTS blog_banned_users;

CREATE TABLE blog_banned_users (
 username varchar(30) primary key,
 timestamp int(11) unsigned not null
);





SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";    
SET time_zone = "+06:00";

CREATE TABLE IF NOT EXISTS `current_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `recorded_datetime` datetime NOT NULL ,
   username varchar(255) NOT NULL,
   Annotation text ,
  PRIMARY KEY (`id`),
  FOREIGN KEY(username) references blog_users(username)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;




CREATE TABLE latest_location(
`id` int(11) NOT NULL AUTO_INCREMENT,
username varchar(255) NOT NULL,
 `recorded_datetime` datetime NOT NULL,    
  lat decimal(12,8) NOT NULL DEFAULT '0.00000000',    
  lon decimal(12,8) NOT NULL DEFAULT '0.00000000',    
PRIMARY KEY (id,username),
FOREIGN KEY(username) references blog_users(username)
);

create table group_user(
groupname varchar(30) primary key,
admin_name varchar(30),
catagory varchar(30)
);
 
alter table blog_users ADD column catagory varchar(30);
alter table blog_users ADD column groupname varchar(30);
alter table blog_users ADD CONSTRAINT fk_1 FOREIGN KEY (groupname) REFERENCES group_user (groupname);









