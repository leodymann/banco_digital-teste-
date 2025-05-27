CREATE DATABASE banco_digital;

USE banco_digital;

CREATE TABLE usuarios (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    saldo DECIMAL(10,2) DEFAULT 0.00
    );

CREATE TABLE transacoes (
	id INT AUTO_INCREMENT PRIMARY KEY,
    remetente_id INT NOT NULL,
    destinatario_id INT NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    data_data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (remetente_id) REFERENCES usuarios(id),
    FOREIGN KEY (destinatario_id) REFERENCES usuarios(id)
);

ALTER TABLE usuarios ADD COLUMN senha VARCHAR(255) NOT NULL;
ALTER TABLE transacoes ADD COLUMN hash VARCHAR(64);
ALTER TABLE transacoes ADD COLUMN prev_hash VARCHAR(64);


CREATE TABLE deposits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    hash VARCHAR(64) NOT NULL,
    prev_hash VARCHAR(64) DEFAULT 'GENESIS',
    FOREIGN KEY (user_id) REFERENCES usuarios(id)
);
CREATE INDEX idx_user_date ON deposits (user_id, data);

CREATE TABLE blocos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hash VARCHAR(255) NOT NULL,
    prev_hash VARCHAR(255),
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE transacoes ADD bloco_id INT, 
ADD CONSTRAINT fk_bloco FOREIGN KEY (bloco_id) REFERENCES blocos(id);

SELECT id, bloco_id FROM transacoes ORDER BY id DESC LIMIT 10;

SHOW COLUMNS FROM transacoes LIKE 'bloco_id';
DESCRIBE blocos;
 
 ALTER TABLE usuarios ADD COLUMN is_admin TINYINT(1) NOT NULL DEFAULT 0;

