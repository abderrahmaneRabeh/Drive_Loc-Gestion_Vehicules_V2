CREATE Table themes(
    id_theme INT PRIMARY KEY AUTO_INCREMENT,
    theme_name VARCHAR(50),
);

CREATE Table tags(
    id_tag INT PRIMARY KEY AUTO_INCREMENT,
    tag_name VARCHAR(50),
);

CREATE Table article_body(
    id_body INT PRIMARY KEY AUTO_INCREMENT,
    subtitle_body VARCHAR(50),
    content_body VARCHAR(50),
    image_body VARCHAR(50),
    video_body VARCHAR(50),
);

CREATE Table articles(
    id_article INT PRIMARY KEY AUTO_INCREMENT,
    article_title VARCHAR(50),
    active_article INT,
    image_article VARCHAR(50),
    video_article VARCHAR(50),
    id_theme INT,
    utilisateur_id INT,
    artcile_body_id INT,
    FOREIGN KEY (id_theme) REFERENCES themes(id_theme) ON DELETE CASCADE,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (artcile_body_id) REFERENCES article_body(id_body) ON DELETE CASCADE
);

CREATE Table tag_article(
    id_tag INT,
    id_article INT,
    PRIMARY KEY (id_tag, id_article),
    FOREIGN KEY (id_tag) REFERENCES tags(id_tag) ON DELETE CASCADE,
    FOREIGN KEY (id_article) REFERENCES articles(id_article) ON DELETE CASCADE,
);

CREATE TABLE favorites(
    id_fav INT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INT,
    id_article INT,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_article) REFERENCES articles(id_article) ON DELETE CASCADE,
);

CREATE TABLE commentaires(
    id_comment INT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INT,
    id_article INT,
    commentaire VARCHAR(50),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_article) REFERENCES articles(id_article) ON DELETE CASCADE,
);