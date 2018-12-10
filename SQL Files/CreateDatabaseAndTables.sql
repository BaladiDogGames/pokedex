CREATE DATABASE pokedex;

USE pokedex;

CREATE TABLE IF NOT EXISTS pokemon (
    pokemon_id INT AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (pokemon_id)
);

CREATE TABLE IF NOT EXISTS pokemonTypes (
  pokemon_type_id INT AUTO_INCREMENT,
  pokemon_id INT(11) NOT NULL,
  type1 varchar(25),
  type2 varchar(25),
  PRIMARY KEY (pokemon_type_id),
  FOREIGN KEY (pokemon_id) REFERENCES pokemon(pokemon_id)
	ON DELETE CASCADE
);
                
CREATE TABLE IF NOT EXISTS pokemonStats (
  pokemon_stats_id INT AUTO_INCREMENT,
  pokemon_id INT(11) NOT NULL,
  hp int(4),
  attack int(4),
  defense int(4),
  sp_atk int(4),
  sp_def int(4),
  speed int(4),
  PRIMARY KEY (pokemon_stats_id),
  FOREIGN KEY (pokemon_id) REFERENCES pokemon(pokemon_id)
	ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS pokemonDescriptions (
  pokemon_desc_id INT AUTO_INCREMENT,
  pokemon_id INT(11) NOT NULL,
  height int(4),
  weight int(10),
  PRIMARY KEY (pokemon_desc_id),
  FOREIGN KEY (pokemon_id) REFERENCES pokemon(pokemon_id)
	ON DELETE CASCADE
);

