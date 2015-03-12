DROP TABLE IF EXISTS task;
DROP TABLE IF EXISTS project;


CREATE TABLE IF NOT EXISTS project (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title varchar(45) DEFAULT NULL,
  description varchar(200) DEFAULT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS task (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_project int(11) DEFAULT NULL,
  title varchar(45) DEFAULT NULL,
  description varchar(200) DEFAULT NULL,
  FOREIGN KEY fk_id_project(id_project) REFERENCES project(id)
  ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;



-- INSERT INTO `gtd`.`project` (`id`, `title`, `description`) VALUES (NULL, 'a project', 'a project''s description');
