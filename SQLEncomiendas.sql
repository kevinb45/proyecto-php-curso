CREATE DATABASE encomiendas_kevin; 

USE encomiendas_kevin;


CREATE TABLE Estado(
			IdEstado INT(8) PRIMARY KEY AUTO_INCREMENT,
			Nombre VARCHAR(25) NOT NULL
);

INSERT INTO Estado(Nombre)
VALUES
		("Pendiente"),
		("Despachado"),
		("Eliminada/Cancelada");
		
CREATE TABLE Origen(
			Ido INT(8) PRIMARY KEY AUTO_INCREMENT,
			Nombre VARCHAR(25) NOT NULL
);

INSERT INTO Origen(Nombre)
VALUES
		("Artigas"),
		("Canelones"),
		("Carro Largo"),
		("Colonia"),
		("Durazno"),
		("Flores"),
		("Florida"),
		("Lavalleja"),
		("Maldonado"),
		("Montevideo"),
		("Paysandú"),
		("Río Negro"),
		("Rivera"),
		("Rocha"),
		("Salto"),
		("San José"),
		("Soriano"),
		("Tacuarembó"),
		("Treinta y Tres");
		
CREATE TABLE Destino(
			Idd INT(8) PRIMARY KEY AUTO_INCREMENT,
			Nombre VARCHAR(25) NOT NULL
);

INSERT INTO Destino(Nombre)
VALUES
		("Artigas"),
		("Canelones"),
		("Carro Largo"),
		("Colonia"),
		("Durazno"),
		("Flores"),
		("Florida"),
		("Lavalleja"),
		("Maldonado"),
		("Montevideo"),
		("Paysandú"),
		("Río Negro"),
		("Rivera"),
		("Rocha"),
		("Salto"),
		("San José"),
		("Soriano"),
		("Tacuarembó"),
		("Treinta y Tres");		
		
CREATE TABLE Encomiendas(
			Id INT(8) PRIMARY KEY AUTO_INCREMENT,
			Fecha DATE NOT NULL,
			Hora TIME NOT NULL,
			Origen INT(8),
			Destino INT(8),
			Estado INT (8),
			Nombredest VARCHAR(25) NOT NULL,
			Nombredesp VARCHAR(25) NOT NULL,
			Tipo VARCHAR(25) NOT NULL,
			
			FOREIGN KEY(Origen) REFERENCES Origen(Ido),
			FOREIGN KEY(Destino) REFERENCES Destino(Idd),
			FOREIGN KEY(Estado) REFERENCES Estado(Id)
);

INSERT INTO encomiendas (fecha, hora, nombredest, nombredesp, destino, origen,  tipo, estado) 
VALUES 
		("2017-05-06","11:12:00","Francisco Rodriguez","Maria Lopez",1,10,"Sobre",1),		
		("2017-04-10","16:15:00","Rodrigo","Damian",11,10,"Paquete",3),		
		("2017-10-08","10:15:00","Manuel","Lucia",1,8,"Paquete",1),		
		("2018-03-01","15:05:00","Yane","Ricardo",5,7,"Bicicleta",2),		
		("2017-11-20","14:00:00","Ricardo","Lucia",10,19,"Sobre",1),		
		("2017-12-05","18:30:00","Emanuel Dominguez","Mario Rodriguez",15,18,"Paquete",1),		
		("2016-03-10","10:15:00","Luciana","Maria Lopez",11,15,"Sobre",1),		
		("2016-09-15","11:49:00","Domingo Rodriguez","Mario",5,6,"Paquete",1),		
		("2016-05-13","16:30:00","Juana","Enrique VII",8,10,"Sobre",3);		
		

CREATE TABLE Usuarios(
			Cedula INT(8) PRIMARY KEY,
			Nombre VARCHAR(25) NOT NULL,
			Apellido VARCHAR(25) NOT NULL,
			Nombreusuario VARCHAR(25) UNIQUE KEY NOT NULL,
			Clave VARCHAR(32) NOT NULL,
			Tipousuario VARCHAR(25) NOT NULL,
			Encomiendas INT(8),
			
			FOREIGN KEY(Encomiendas) REFERENCES Encomiendas(Id)
);

INSERT INTO Usuarios(Cedula, Nombre, Apellido, Nombreusuario, Clave, Tipousuario)
VALUES
		("45338026", "Kevin", "Grassi", "admin", "81dc9bdb52d04dc20036dbd8313ed055", "Administrador"),
		("46857895", "Fernando", "Rodrigo", "fern", "81dc9bdb52d04dc20036dbd8313ed055", "Administrador"),
		("34892376", "Juana", "Rodriquez", "juan", "81dc9bdb52d04dc20036dbd8313ed055", "Recepcion"),
		("34879721", "Ricardo", "Estevez", "ric", "81dc9bdb52d04dc20036dbd8313ed055", "Recepcion");

CREATE TABLE Contacto(
			IdContacto INT(8) PRIMARY KEY AUTO_INCREMENT,
			Nombre VARCHAR(25) NOT NULL,
			Email VARCHAR(25) NOT NULL,
			Telefono VARCHAR(25) NOT NULL,
			Asunto VARCHAR(50) NOT NULL,
			Mensaje VARCHAR(300) NOT NULL,
			FechaHora TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
			Estado VARCHAR (10) NOT NULL			
);

INSERT INTO contacto (nombre, email, asunto, telefono, mensaje, estado) 
VALUES 
		("Francisco", "francisco@gmail.com","Quiero saber de mi paquete","095878987","Lo ingrese hoy en el día pero no se si ya partió y...", "No Leido"),	
		("Lucia", "lucia@gmail.com","Quiero saber de mi paquete","096897117","Lo ingrese hoy en el día pero no se si ya partió y...", "No Leido"),	
		("Manuel", "manuel@gmail.com","Quiero saber de mi paquete","095353454","Lo ingrese hoy en el día pero no se si ya partió y...", "Leido"),	
		("Ricardo", "ricardo@gmail.com","Quiero saber de mi paquete","095435443","Lo ingrese hoy en el día pero no se si ya partió y...", "No Leido"),	
		("Juan", "juan@gmail.com","Quiero saber de mi paquete","095435435","Lo ingrese hoy en el día pero no se si ya partió y...", "No Leido"),	
		("Emanuel", "emanuel@gmail.com","Quiero saber de mi paquete","095567756","Lo ingrese hoy en el día pero no se si ya partió y...", "Leido"),	
		("Fernanda", "fer@gmail.com","Quiero saber de mi paquete","095787688","Lo ingrese hoy en el día pero no se si ya partió y...", "No Leido"),	
		("Esteban", "esteban@gmail.com","Quiero saber de mi paquete","095656868","Lo ingrese hoy en el día pero no se si ya partió y...", "Leido"),	
		("Sebastian", "seba@gmail.com","Quiero saber de mi paquete","095987988","Lo ingrese hoy en el día pero no se si ya partió y...", "Leido");














