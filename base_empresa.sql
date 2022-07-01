create database empresa;
create table persona(id serial unique,tipoDocumento integer, documento integer, nombres text, apellidos text, sexo integer, departamento integer, municipio integer, email varchar(60),contrasena varchar(20), primary key(tipoDocumento,documento));
create table sexo(id_sexo serial ,descripcion varchar(20), primary key(id_sexo));
create table tipoDocumento(id_tipo_doc serial ,descripcion varchar(30), primary key(id_tipo_doc));
create table departamento(id_depart serial ,descripcion varchar(40), primary key(id_depart));
create table municipio(id_munici serial, id_depart integer,descripcion varchar(70), primary key(id_munici));
create view v_persona_data as select p.*,s.descripcion as des_sexo,d.descripcion as des_depart,m.descripcion as des_munici from persona p inner join sexo s on p.sexo = s.id_sexo inner join departamento d on p.departamento = d.id_depart inner join municipio m on p.municipio = m.id_munici;
