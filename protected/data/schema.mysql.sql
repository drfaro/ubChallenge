
CREATE TABLE `urls`(
    `id` INT NOT NULL AUTO_INCREMENT ,
    `url` VARCHAR(255) ,
    `visited` ENUM('yes','no') DEFAULT 'no' ,
    PRIMARY KEY (`id`) );

CREATE TABLE `emails`(
    `id` INT NOT NULL AUTO_INCREMENT ,
    `email` VARCHAR(255) ,
    PRIMARY KEY (`id`)  );


INSERT INTO `urls`(url) VALUES('http://www.inf.ufpr.br/dinf/faqs_suporte.html');
INSERT INTO `urls`(url) VALUES('http://www.inf.ufpr.br/dinf/principal.html');
