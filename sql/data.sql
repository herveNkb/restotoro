#Avant d'exécuter les requêtes, assurez-vous d'avoir créé le compte Admin, avec l'id 1 et le role "ROLE_ADMIN" dans la table users.

#1. Créer les catégories:
insert into categories (id, dish_categorie) values (1, 'Les entrées');
insert into categories (id, dish_categorie) values (2, 'Les plats');
insert into categories (id, dish_categorie) values (3, 'Les desserts');

#2. Créer la carte des plats:
insert into menus (id, dish_title, dish_price, users_id, dish_description, categories_id ) values (1, 'Salade', '19', 1, 'sapien varius ut blandit non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et', 1);
insert into menus (id, dish_title, dish_price, users_id, dish_description, categories_id ) values (2, 'Soupe', '10', 1,'vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus', 1);
insert into menus (id, dish_title, dish_price, users_id, dish_description, categories_id ) values (3, 'Carottes râpées', '25', 1, 'eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur', 1);
insert into menus (id, dish_title, dish_price, users_id, dish_description, categories_id ) values (4, 'Petit-pois farcis', '26', 1, 'in consequat ut nulla sed accumsan felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio donec vitae nisi nam', 1);
insert into menus (id, dish_title, dish_price, users_id, dish_description, categories_id ) values (5, 'Omelette', '27', 1, 'duis at velit eu est congue elementum in hac habitasse platea dictumst morbi vestibulum velit id pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat', 2);
insert into menus (id, dish_title, dish_price, users_id, dish_description, categories_id ) values (6, 'Filet de truite', '13', 1, 'a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio condimentum id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat', 2);
insert into menus (id, dish_title, dish_price, users_id, dish_description, categories_id ) values (7, 'Bob l\'éponge', '22', 1, 'phasellus id sapien in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae nisl', 2);
insert into menus (id, dish_title, dish_price, users_id, dish_description, categories_id ) values (8, 'Jambon d\'Ewoks', '16', 1, 'sapien a libero nam dui proin leo odio porttitor id consequat in consequat ut nulla sed accumsan felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero non mattis', 2);
insert into menus (id, dish_title, dish_price, users_id, dish_description, categories_id ) values (9, 'Mousse au chocolat', '17', 1, 'nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus vel',3);
insert into menus (id, dish_title, dish_price, users_id, dish_description, categories_id ) values (10, 'Banane givrée', '20', 1, 'ante vivamus tortor duis mattis egestas metus aenean fermentum donec ut mauris eget massa tempor convallis nulla neque libero convallis eget eleifend luctus ultricies eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae nulla dapibus dolor', 3);
insert into menus (id, dish_title, dish_price, users_id, dish_description, categories_id ) values (11, 'Flan aux poivres', '25', 1, 'porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis', 3);
insert into menus (id, dish_title, dish_price, users_id, dish_description, categories_id ) values (12, 'Tarte Tatin', '15', 1, 'tellus in sagittis dui vel nisl duis ac nibh fusce lacus purus aliquet at feugiat non pretium quis lectus suspendisse potenti in eleifend quam a odio in hac habitasse platea dictumst maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur', 3);

#3. Créer les menus :
insert into formulas (id, formula_title, `description`, formula_price, users_id) values (1, 'Menu Bambino', 'vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien', '15', 1);
insert into formulas (id, formula_title, `description`, formula_price, users_id) values (2, 'Menu du marché', 'justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut', '26', 1);
insert into formulas (id, formula_title, `description`, formula_price, users_id) values (3, 'Formule végétarien', 'semper rutrum nulla nunc purus phasellus in felis donec semper sapien a libero nam dui proin leo odio porttitor id consequat in consequat ut nulla sed accumsan felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero', '98', 1);

#4 Créer les paramètres de réservation :
insert into reservations_settings (id, lunch_opening_time, lunch_closing_time, dinner_opening_time, dinner_closing_time, max_customers) values (1, '12:00', '14:15', '19:00', '22:15', 25);

#5 Créer les horaires d'ouvertures pour l'affichage dans la vue :
insert into openings (id, opening_day, opening_morning, opening_afternoon, users_id ) values (1, 'Lundi', '12:00 - 15:00', '19:00 - 23:00', 1);
insert into openings (id, opening_day, opening_morning, opening_afternoon, users_id ) values (2, 'Mardi', '12:00 - 15:00', '19:00 - 23:00', 1);
insert into openings (id, opening_day, opening_morning, opening_afternoon, users_id ) values (3, 'Mercredi', '12:00 - 15:00', 'Fermé', 1);
insert into openings (id, opening_day, opening_morning, opening_afternoon, users_id ) values (4, 'Jeudi', 'Fermé', '19:00 - 23:00', 1);
insert into openings (id, opening_day, opening_morning, opening_afternoon, users_id ) values (5, 'Vendredi', '12:00 - 15:00', '19:00 - 23:00', 1);
insert into openings (id, opening_day, opening_morning, opening_afternoon, users_id ) values (6, 'Samedi', '12:00 - 15:00', '19:00 - 23:00', 1);
insert into openings (id, opening_day, opening_morning, opening_afternoon, users_id ) values (7, 'Dimanche', '12:00 - 15:00', '19:00 - 23:00', 1);