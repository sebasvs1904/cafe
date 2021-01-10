CREATE TABLE actualiza (
  administradoridadmin  int(10) NOT NULL, 
  inventarioidproductos int(10) NOT NULL, 
  FechaActual           int(10), 
  PRIMARY KEY (administradoridadmin, 
  inventarioidproductos)) CHARACTER SET UTF8;
CREATE TABLE administrador (
  idadmin    int(10) NOT NULL AUTO_INCREMENT, 
  email      int(10) NOT NULL, 
  password1   varchar(200) NOT NULL, 
  nombrea    varchar(25) NOT NULL, 
  apelliidoP varchar(25) NOT NULL, 
  apellidoM  varchar(25) NOT NULL, 
  rfc        varchar(13) NOT NULL, 
  tarjeta    varchar(18) NOT NULL, 
  turno      varchar(1), 
  ntelefono  varchar(10) NOT NULL, 
  salario    double NOT NULL, 
  PRIMARY KEY (idadmin)) CHARACTER SET UTF8;
CREATE TABLE cliente (
  idcliente        int(10) NOT NULL AUTO_INCREMENT, 
  nombre           varchar(25) NOT NULL, 
  apellidoP        varchar(25) NOT NULL, 
  apellidoM        varchar(25) NOT NULL, 
  password1        varchar(200) NOT NULL, 
  email            varchar(25) NOT NULL, 
  firmaelectronica longblob, 
  PRIMARY KEY (idcliente)) CHARACTER SET UTF8;
CREATE TABLE direccion (
  iddireccion int(10) NOT NULL AUTO_INCREMENT, 
  cp          varchar(5) NOT NULL, 
  ciudad      varchar(50) NOT NULL, 
  colonia     int(10) NOT NULL, 
  calle       varchar(50) NOT NULL, 
  numcasa     varchar(5), 
  idcliente   int(10) NOT NULL, 
  PRIMARY KEY (iddireccion)) CHARACTER SET UTF8;
CREATE TABLE ofertas (
  codigooferta          varchar(10) NOT NULL, 
  nombre                varchar(25) NOT NULL, 
  Precio                real NOT NULL, 
  descripcion           varchar(255), 
  idproductos           int(10) NOT NULL, 
  productosidproductos  int(10) NOT NULL, 
  productosidproductos2 int(10) NOT NULL, 
  PRIMARY KEY (codigooferta, 
  productosidproductos, 
  productosidproductos2)) CHARACTER SET UTF8;
CREATE TABLE pedidos (
  Folio                 varchar(7) NOT NULL, 
  fecha                 date NOT NULL, 
  cantproducto          int(10) NOT NULL, 
  Descripcion           varchar(255), 
  inventarioidproductos int(10) NOT NULL, 
  clienteidcliente      int(10) NOT NULL, 
  PRIMARY KEY (Folio, 
  inventarioidproductos, 
  clienteidcliente)) CHARACTER SET UTF8;
CREATE TABLE productos (
  idproductos  int(10) NOT NULL AUTO_INCREMENT, 
  nombre       varchar(25) NOT NULL 					, 
  cantidad     int(10) NOT NULL 		, 
  precio       int(10) NOT NULL, 
  descripcion  varchar(255) NOT NULL, 
  categoria    varchar(30) NOT NULL, 
  ingredientes varchar(255) NOT NULL, 
  imagen       longblob NOT NULL, 
  PRIMARY KEY (idproductos)) CHARACTER SET UTF8;
CREATE TABLE tarjeta (
  idtarjeta  int(10) NOT NULL AUTO_INCREMENT, 
  numtarjeta int(10) NOT NULL, 
  CVV        int(10) NOT NULL, 
  idcliente  int(10) NOT NULL, 
  PRIMARY KEY (idtarjeta)) CHARACTER SET UTF8;
ALTER TABLE actualiza ADD CONSTRAINT FKactualiza547324 FOREIGN KEY (administradoridadmin) REFERENCES administrador (idadmin);
ALTER TABLE actualiza ADD CONSTRAINT FKactualiza232366 FOREIGN KEY (inventarioidproductos) REFERENCES productos (idproductos);
ALTER TABLE pedidos ADD CONSTRAINT FKpedidos314186 FOREIGN KEY (inventarioidproductos) REFERENCES productos (idproductos);
ALTER TABLE pedidos ADD CONSTRAINT FKpedidos309395 FOREIGN KEY (clienteidcliente) REFERENCES cliente (idcliente);
ALTER TABLE tarjeta ADD CONSTRAINT FKtarjeta975725 FOREIGN KEY (idcliente) REFERENCES cliente (idcliente);
ALTER TABLE direccion ADD CONSTRAINT FKdireccion66768 FOREIGN KEY (idcliente) REFERENCES cliente (idcliente);
ALTER TABLE ofertas ADD CONSTRAINT FKofertas372274 FOREIGN KEY (productosidproductos) REFERENCES productos (idproductos);
ALTER TABLE ofertas ADD CONSTRAINT FKofertas981568 FOREIGN KEY (productosidproductos2) REFERENCES productos (idproductos);
ALTER TABLE ofertas ADD CONSTRAINT FKofertas527015 FOREIGN KEY (idproductos) REFERENCES productos (idproductos);
