CREATE TABLE categories(
id             int(255) auto_increment not null,
name           varchar(255) not null,
CONSTRAINT pk_categories PRIMARY KEY(id)
);


CREATE TABLE software(
id             int(255) auto_increment not null,
name           varchar(255) not null,
logo           varchar(255) not null,
category       int(255) null,
add_repository varchar(255) null,
name_packet    varchar(255) not null,
download       int(255) DEFAULT 0 null,
CONSTRAINT pk_software PRIMARY KEY(id),
CONSTRAINT fk_category_software FOREIGN KEY (category) REFERENCES categories(id)
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
status              int(255) null,
create_datetime           datetime not null,
CONSTRAINT pk_token PRIMARY KEY (id),
CONSTRAINT fk_users_token FOREIGN KEY (user) REFERENCES users(id)
);

CREATE TABLE saveautoinstaller(
id                  int(255) auto_increment not null,
name                varchar(255) null,
user                int(255) not null,
software            varchar(255) not null,
commands      longtext null,
create_datetime     datetime not null,
CONSTRAINT pk_saveautoinstaller PRIMARY KEY (id),
CONSTRAINT fk_users_saveautoinstaller FOREIGN KEY (user) REFERENCES users(id)
);


