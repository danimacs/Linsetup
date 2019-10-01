CREATE TABLE software(
id              int(255) auto_increment not null,
name           varchar(255) not null,
source          varchar(255),
download        int(255) DEFAULT 0 null,
CONSTRAINT pk_software_snap PRIMARY KEY(id)
);

CREATE TABLE users(
id 			              int (255) auto_increment not null,
user				      varchar	(100) not null UNIQUE,
email		              varchar (255) not null UNIQUE,
password                  varchar (255) not null,
create_datetime           datetime not null,
last_connection_datetime  datetime null,
staff                     bit DEFAULT 0 not null,
verificate                bit DEFAULT 0 not null,
try                       varchar (255) DEFAULT 0 null,
blocked                   bit DEFAULT 0 null,
CONSTRAINT pk_users PRIMARY KEY (id)
);


CREATE TABLE tokens(
id              int(255) auto_increment not null,
user              int(255) not null,
token               varchar(255) not null,
create_datetime           datetime not null,
CONSTRAINT pk_token PRIMARY KEY (id),
CONSTRAINT fk_users_token FOREIGN KEY (user) REFERENCES users(id)
);

CREATE TABLE saveautoinstaller(
id              int(255) auto_increment not null,
user              int(255) not null,
software         varchar(255) not null,
create_datetime           datetime not null,
CONSTRAINT pk_saveautoinstaller PRIMARY KEY (id),
CONSTRAINT fk_users_saveautoinstaller FOREIGN KEY (user) REFERENCES users(id)
);


