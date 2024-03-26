use twitter_clone;


  CREATE TABLE users (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
	location VARCHAR(50),
	date TIMESTAMP
);
  CREATE TABLE tweets (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	user_id INT(11) UNSIGNED,
  FOREIGN KEY (user_id)
    REFERENCES users(id),
	content VARCHAR(140) NOT NULL,
	date TIMESTAMP
);
  CREATE TABLE follows (
    id INT(11) UNSIGNED,
    follows_id INT(11) UNSIGNED
  );