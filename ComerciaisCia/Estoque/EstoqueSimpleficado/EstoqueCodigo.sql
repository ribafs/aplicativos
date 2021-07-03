CREATE TABLE produtos (
    id INT NOT NULL AUTO_INCREMENT,
    descricao VARCHAR(50) NULL DEFAULT NULL,
    estoque_minimo INT NULL DEFAULT NULL,
    estoque_maximo INT NULL DEFAULT NULL,
    PRIMARY KEY (id)
);

insert into produtos (descricao, estoque_minimo, estoque_maximo) values 
('Banana Maçã', 3, 110),
('Manga Rosa', 4, 120),
('Manga Moscatel', 5, 130),
('Manga Jasmin', 6, 140),
('Banana Prata', 7, 150);


CREATE TABLE compras (
    id INT NOT NULL AUTO_INCREMENT,
    produto_id INT NOT NULL,
    quantidade INT NULL DEFAULT NULL,
    preco DECIMAL(9,2) NULL DEFAULT '0.00',
    data DATE NULL DEFAULT NULL,
    PRIMARY KEY (id),
	constraint compra_fk foreign key (produto_id) references produtos(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE estoques (
    id INT NOT NULL AUTO_INCREMENT,
    produto_id INT NOT NULL,
    compra_id INT NOT NULL,
    quantidade INT NULL DEFAULT NULL,
    PRIMARY KEY (id),
	constraint estoque_fk foreign key (produto_id) references produtos(id) ON DELETE CASCADE ON UPDATE CASCADE,
	constraint estoque_compra_fk foreign key (compra_id) references compras(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE vendas (
    id INT NOT NULL AUTO_INCREMENT,
    produto_id INT NOT NULL,
    estoque_id INT NOT NULL,
    quantidade INT NULL DEFAULT NULL,
    data DATE NULL DEFAULT NULL,
    preco DECIMAL(9,2) NULL DEFAULT '0.00',
    PRIMARY KEY (id),
	constraint estoque_venda_fk foreign key (estoque_id) references estoques(id) ON DELETE CASCADE ON UPDATE CASCADE,
	constraint venda_fk foreign key (produto_id) references produtos(id) ON DELETE CASCADE ON UPDATE CASCADE
);

