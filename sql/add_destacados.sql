-- Tabla para guardar destacados de noticias
CREATE TABLE IF NOT EXISTS destacados (
  id INT(11) NOT NULL AUTO_INCREMENT,
  noticia_id INT(11) NOT NULL,
  usuario_id INT(11) NOT NULL,
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (id),
  KEY noticia_id (noticia_id),
  KEY usuario_id (usuario_id),
  CONSTRAINT destacados_noticia_fk FOREIGN KEY (noticia_id) REFERENCES noticias(id),
  CONSTRAINT destacados_usuario_fk FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
