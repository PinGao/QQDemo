--创建数据库
set names gb2312;
create database qq_demo;
use qq_demo;

--用户表,用户id,用户姓名,用户密码,用户性别,用户出生日期,用户地址,用户电话,用户状态(0:不在线,1:在线)
create table users (
	user_id int primary key not null auto_increment,
	user_name varchar(32) not null default '',
	user_pwd char(32) not null default '',
	user_gender char(2) default '男',
	user_brithday date not null default '1992-07-05',
	user_address varchar(128) not null default '',
	user_tel varchar(16) not null,
	user_state int not null default 0
);

insert into users values(null,'闻品高',md5('wenpingao'),'男','1992-07-05','红河学院豪翰乙楼412','18287368151',0);
insert into users values(null,'lajigao',md5('wenpingao'),'男','1992-07-05','红河学院豪翰乙楼412','18287368151',0);
create unique index index_name on users(user_name);
--好友表,成为好友id,用户id,好友id,成为好友的日期,好友昵称
create table friends(
	friend_id int primary key not null auto_increment,
	user_id int not null,
	friend_user_id int not null,
	foreign key (user_id) references users(user_id),
	foreign key (friend_user_id) references users(user_id),
	friend_add_time date not null,
	friend_nick_name varchar(64) default ''
);
select * from users u1 join friends f on u1.user_id = f.user_id join users u2 on f.friend_user_id = u2.user_id;
--查询指定user_id的全部在线好友的所有信息
select * from users where user_state = 1 and user_id in(select f.friend_user_id from users u1 join friends f on u1.user_id = f.user_id where u1.user_id = 2); 


--聊天表,信息id,发送者,接受者,信息内容,发送日期,是否被接收(0:没有被接收,1:已经被接收)
create table content(
	content_id int primary key not null auto_increment,
	content_sender_id int not null,
	content_Receiver_id int not null,
	content_message varchar(2048) not null default '',
	content_time datetime not null,
	content_state int default 0,
	foreign key (content_sender_id) references users(user_id),
	foreign key (content_Receiver_id) references users(user_id)
);
insert into content values(null,2,1,"hello",'2015-05-16 21:41:25',0);
--查询指定用户的好友发来的信息(未被接收)
select u1.user_id,u2.user_id,u2.user_name,c.content_message,c.content_time from users u1 join content c on u1.user_id = c.content_sender_id join users u2 on c.content_Receiver_id = u2.user_id where u2.user_id = 2 and c.content_state = 0 order by u2.user_id;









mysql> desc users;
+---------------+--------------+------+-----+------------+----------------+
| Field         | Type         | Null | Key | Default    | Extra          |
+---------------+--------------+------+-----+------------+----------------+
| user_id       | int(11)      | NO   | PRI | NULL       | auto_increment |
| user_name     | varchar(32)  | NO   | UNI |            |                |
| user_pwd      | char(32)     | NO   |     |            |                |
| user_gender   | varchar(2)  | YES  |     | 男         |                |
| user_brithday | date         | NO   |     | 1992-07-05 |                |
| user_address  | varchar(128) | NO   |     |            |                |
| user_tel      | varchar(16)  | NO   |     | NULL       |                |
| user_state    | int(11)      | NO   |     | 0          |                |
+---------------+--------------+------+-----+------------+----------------+
8 rows in set (0.87 sec)

mysql> desc friends;
+------------------+-------------+------+-----+---------+----------------+
| Field            | Type        | Null | Key | Default | Extra          |
+------------------+-------------+------+-----+---------+----------------+
| friend_id        | int(11)     | NO   | PRI | NULL    | auto_increment |
| user_id          | int(11)     | NO   | MUL | NULL    |                |
| friend_user_id   | int(11)     | NO   | MUL | NULL    |                |
| friend_add_time  | date        | NO   |     | NULL    |                |
| friend_nick_name | varchar(64) | YES  |     |         |                |
+------------------+-------------+------+-----+---------+----------------+
5 rows in set (0.03 sec)

mysql> desc content;
+---------------------+---------------+------+-----+---------+----------------+
| Field               | Type          | Null | Key | Default | Extra          |
+---------------------+---------------+------+-----+---------+----------------+
| content_id          | int(11)       | NO   | PRI | NULL    | auto_increment |
| content_sender_id   | int(11)       | NO   | MUL | NULL    |                |
| content_Receiver_id | int(11)       | NO   | MUL | NULL    |                |
| content_message     | varchar(2048) | NO   |     |         |                |
| content_time        | datetime      | NO   |     | NULL    |                |
| content_state       | int(11)       | YES  |     | 0       |                |
+---------------------+---------------+------+-----+---------+----------------+
6 rows in set (0.02 sec)

mysql>


