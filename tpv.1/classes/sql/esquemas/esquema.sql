create database admin default character set utf8 collate utf8_unicode_ci;

create user admin@localhost identified by '1234';

grant all on admin.* to admin@localhost;

flush privileges;

use admin;

create table if not exists usuario (
    id bigint not null auto_increment,
    nombre varchar(40),
    apellidos varchar(40),
    nombreusuario varchar(20) not null unique,
    correo varchar(40) not null unique,
    clave varchar(250) not null,
    tipo varchar (15) not null,
    fechaalta datetime not null,
    verificado tinyint(1) not null default 0,
    primary key (id)
) engine = innodb default character set = utf8 collate utf8_unicode_ci;