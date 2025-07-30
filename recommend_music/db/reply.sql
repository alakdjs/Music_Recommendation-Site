create table reply (
   re_num int not null auto_increment,
   bo_num int not null,
   re_id char(15) not null,
   re_name char(10) not null,
   re_content text not null,        
   re_regist_day char(20) not null,
   primary key(re_num)
);

