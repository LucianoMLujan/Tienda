CREATE DATABASE tienda;
USE tienda;

CREATE TABLE usuarios(
    id int not null auto_increment,
    nombre varchar(100) not null,
    apellido varchar(100) not null,
    email varchar(255) not null,
    password varchar(255) not null,
    rol varchar(20),
    imagen varchar(255),
    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

INSERT INTO usuarios VALUES(NULL, 'Admin', 'Admin', 'admin@admin.com', 'admin', 'Admin', NULL);

CREATE TABLE categorias(
    id int not null auto_increment,
    descripcion varchar(255) not null,
    CONSTRAINT pk_categoria PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO categorias VALUES(null, 'Manga Corta');
INSERT INTO categorias VALUES(null, 'Manga Larga');
INSERT INTO categorias VALUES(null, 'Sudaderas');

CREATE TABLE productos(
    id int not null auto_increment,
    categoria_id int not null,
    nombre varchar(100) not null,
    descripcion text not null,
    precion float(100,2) not null,
    stock int not null,
    oferta VARCHAR(2),
    fecha date not null,
    imagen varchar(255),
    CONSTRAINT pk_productos PRIMARY KEY(id),
    CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;


CREATE TABLE pedidos(
    id int not null auto_increment,
    usuario_id int not null,
    provincia varchar(100) not null,
    localidad varchar(100) not null,
    direccion varchar(255) not null,
    coste float(200,2) not null,
    estado VARCHAR(20),
    fecha date not null,
    hora time not null,
    CONSTRAINT pk_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_pedidos(
    id int not null auto_increment,
    pedido_id int not null,
    producto_id int not null,
    unidades int,
    CONSTRAINT pk_lineas_pedido PRIMARY KEY(id),
    CONSTRAINT fk_linea_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
    CONSTRAINT fk_linea_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=InnoDb;


