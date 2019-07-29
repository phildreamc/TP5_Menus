TP5--WEB菜单统计系统
============

create mysql base "menu"

create table :
    menu_menus--
    
    +-------+------------------+------+-----+---------+----------------+
    | Field | Type             | Null | Key | Default | Extra          |
    +-------+------------------+------+-----+---------+----------------+
    | id    | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
    | name  | varchar(100)     | NO   |     | NULL    |                |
    | type  | varchar(100)     | NO   |     | NULL    |                |
    | pics  | varchar(255)     | NO   |     | NULL    |                |
    +-------+------------------+------+-----+---------+----------------+
    
    menu_mid--
    
    +--------+--------------+------+-----+---------+-------+
    | Field  | Type         | Null | Key | Default | Extra |
    +--------+--------------+------+-----+---------+-------+
    | mid    | varchar(100) | NO   | PRI | NULL    |       |
    | menu   | varchar(255) | NO   |     | NULL    |       |
    | off    | tinyint(1)   | NO   |     | NULL    |       |
    | orders | varchar(255) | YES  |     | NULL    |       |
    +--------+--------------+------+-----+---------+-------+
