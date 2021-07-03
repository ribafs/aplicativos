CREATE TABLE produtos (
    id INT NOT NULL AUTO_INCREMENT,
    descricao VARCHAR(50) NULL DEFAULT NULL,
    estoque_minimo INT NULL DEFAULT NULL,
    estoque_maximo INT NULL DEFAULT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE compras (
    id INT NOT NULL AUTO_INCREMENT,
    produto_id INT NULL DEFAULT NULL,
    quantidade INT NULL DEFAULT NULL,
    valor_unitario DECIMAL(9,2) NULL DEFAULT '0.00',
    data DATE NULL DEFAULT NULL,
    PRIMARY KEY (id),
	constraint compra_fk foreign key (produto_id) references produtos(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE estoques (
    id INT NOT NULL AUTO_INCREMENT,
    produto_id INT NULL DEFAULT NULL,
    quantidade INT NULL DEFAULT NULL,
    PRIMARY KEY (id),
	constraint estoque_fk foreign key (produto_id) references produtos(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE vendas (
    id INT NOT NULL AUTO_INCREMENT,
    produto_id INT NULL DEFAULT NULL,
    quantidade INT NULL DEFAULT NULL,
    data DATE NULL DEFAULT NULL,
    valor_unitario DECIMAL(9,2) NULL DEFAULT '0.00',
    PRIMARY KEY (id),
	constraint venda_fk foreign key (produto_id) references produtos(id) ON DELETE CASCADE ON UPDATE CASCADE
);

