create table usuario(
  email varchar(20) not null primary key,
  nombre varchar(20),
  apellido varchar(20),
  password varchar(20)
);

create table cliente(
  nick varchar(20) not null primary key,
  email varchar(20) not null references usuario(email) on update cascade on delete cascade
);

create table administrador(
  nick varchar(20) not null primary key,
  email varchar(20) not null references usuario(email)
);

create sequence canciones_usuario_id;

create table canciones_usuario(
  id_cancion_usuario int default nextval('canciones_usuario_id') not null primary key,
  nick varchar(35) not null,
  titulo varchar(70) not null,
  artista varchar(20) not null,
  album varchar(50),
  genero varchar(20),
  megusta boolean default false,
  ubicacion varchar(150),
  foreign key(nick) references cliente(nick) on delete cascade
);

create sequence cancionesenventa_id;

create table cancionesenventa(
  id_cancion_venta int default nextval('cancionesenventa_id')not null primary key,
  nick varchar(20) not null references administrador(nick),
  titulo varchar(20) not null,
  artista varchar(20) not null,
  album varchar(20),
  genero varchar(20),
  foto varchar(150),
  precio int,
  ubicacion_cancion varchar(150),
  recomendado boolean default false
);

/* -Inicia- Agregado el 5 de diciembre 2012 */

create sequence lista_reproduccion_id;

create table lista_reproduccion(
  id_lista_reproduccion int default nextval('lista_reproduccion_id') not null primary key,
  nombre_lista varchar(45) not null,
  id_cliente varchar(20) not null,
  foreign key(id_cliente) references cliente(nick) ON DELETE CASCADE
);

create sequence canciones_en_lista_id;

create table canciones_en_lista(
  id_cancion_en_lista int default nextval('canciones_en_lista_id') not null primary key,
  id_lista int not null,
  id_cancion int not null,
  foreign key(id_lista) references lista_reproduccion(id_lista_reproduccion) ON DELETE CASCADE,
  foreign key(id_cancion) references canciones_usuario(id_cancion_usuario) ON DELETE CASCADE
);

create sequence canciones_compartidas_id;

create table canciones_compartidas(
  id_cancion_compartida int default nextval('canciones_compartidas_id') not null primary key,
  cliente_key varchar(20) not null,
  id_cancion_user int not null,
  foreign key(cliente_key) references cliente(nick) on delete cascade,
  foreign key(id_cancion_user) references canciones_usuario(id_cancion_usuario) on delete cascade
);

/* -Fin- Agregado el 5 de diciembre 2012 */

create sequence venta_id;

create table venta(
  id_venta int default nextval('venta_id') not null primary key,
  nick_cliente varchar(20) not null references cliente(nick),
  primary key(id_venta, nick_cliente)
);

create table factura(
id_venta int not null references venta(id_venta),
titulo varchar(20) not null references canciones_usuario(titulo),
artista varchar(20) not null references canciones_usuario(artista),
fecha date not null,
primary key(id_venta, titulo, artista)
);

insert into usuario values('admingo@gmail.com','Administrador','Admin','1234');
insert into usuario values('clientengo@gmail.com','Cliente','tengo','1234');
insert into cliente values('Cliente','clientengo@gmail.com');
insert into administrador values('Admin','admingo@gmail.com');

insert into cancionesEnVenta values('Admin','Loba','Shakira','Perraloba','Popo','1.jpg', 10.00, false);
insert into cancionesEnVenta values('Admin','Somebody that i used to know','Gotye','skjd','Popo','2.jpg', 20.00, false);
insert into cancionesEnVenta values('Admin','I wanna fuck ya','Akon','move','hip hop','3.jpg', 10.00, false);