-- Stored procedure

DELIMITER //
  CREATE PROCEDURE `sp_atualizaestoque`( `id_prod` int, `qtde_comprada` int)
BEGIN
    declare contador int(11);

    SELECT count(*) into contador FROM estoques WHERE produto_id = id_prod;

    IF contador > 0 THEN
        UPDATE estoques SET quantidade=quantidade + qtde_comprada WHERE produto_id = id_prod;
    ELSE
        INSERT INTO estoques (produto_id, quantidade) values (id_prod, qtde_comprada);
    END IF;
END //
DELIMITER ;

-- Trigger

DELIMITER //
CREATE TRIGGER `tg_vendas_ad` AFTER DELETE ON `vendas`
FOR EACH ROW
BEGIN
      CALL sp_atualizaestoque (old.produto_id, old.quantidade);
END //
DELIMITER ;

-- Trigger

DELIMITER //
CREATE TRIGGER `tg_compras_ad` AFTER DELETE ON `compras`
FOR EACH ROW
BEGIN
      CALL sp_atualizaestoque (old.produto_id, old.quantidade * -1);
END //
DELIMITER ;

-- Trigger

DELIMITER //
CREATE TRIGGER `tg_compras_ai` AFTER INSERT ON `compras`
FOR EACH ROW
BEGIN
      CALL sp_atualizaestoque (new.produto_id, new.quantidade);
END //
DELIMITER ;

-- Trigger

DELIMITER //
CREATE TRIGGER `tg_compras_au` AFTER UPDATE ON `compras`
FOR EACH ROW
BEGIN
      CALL sp_atualizaestoque (new.produto_id, new.quantidade - old.quantidade);
END //
DELIMITER ;

-- Trigger

DELIMITER //
CREATE TRIGGER `tg_vendas_ai` AFTER INSERT ON `vendas`
FOR EACH ROW
BEGIN
      CALL sp_atualizaestoque (new.produto_id, new.quantidade * -1);
END //
DELIMITER ;

-- Trigger

DELIMITER //
CREATE TRIGGER `tg_vendas_au` AFTER UPDATE ON `vendas`
FOR EACH ROW
BEGIN
      CALL sp_atualizaestoque (new.produto_id, old.quantidade - new.quantidade);
END //
DELIMITER ;


