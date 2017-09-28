
DROP TABLE projetocalSensores;

CREATE TABLE projetocalsensores (
  id mediumint(8) unsigned NOT NULL auto_increment,
  idSensor varchar(255) default NULL,
  temp float(5,2),
  humi float(5,2),
  datetime TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) AUTO_INCREMENT=1;
