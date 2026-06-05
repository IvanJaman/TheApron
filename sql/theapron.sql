CREATE DATABASE IF NOT EXISTS theapron;
USE theapron;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    image_url VARCHAR(255),
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE favourites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    recipe_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE,
    UNIQUE(user_id, recipe_id)
);

CREATE TABLE ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    recipe_id INT NOT NULL,
    rating TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE,
    UNIQUE(user_id, recipe_id)
);

INSERT INTO categories (name) VALUES
('Tjestenina'),
('Pizza'),
('Doručak'),
('Desert'),
('Salata'),
('Juha');

INSERT INTO recipes (title, description, ingredients, instructions, image_url, category_id) VALUES

('Špageti Carbonara',
'Klasično rimsko jelo od tjestenine s kremastim umakom od jaja, hrskavom pancetom i svježe ribanim Pecorino sirom. Jednostavni sastojci, bogat okus i bez vrhnja.',
'Špageti, jaja (2 velika), Pecorino Romano sir, panceta, crni papar, sol',
'Skuhaj špagete u posoljenoj vodi do al dente. Na tavi poprži pancetu dok ne postane hrskava. U zdjeli umutiti jaja sa sirom i paprom. Ocijedi tjesteninu, sačuvaj malo vode, i brzo pomiješaj s pancetom maknuto s vatre. Dodaj smjesu jaja i miješaj energično dok se ne stvori kremasti umak. Po potrebi dodaj vodu od tjestenine.',

'/images/carbonara.jpg',
1),

('Pizza Margherita',
'Tradicionalna napuljska pizza sa svježim umakom od rajčice, mozzarellom i bosiljkom. Savršena ravnoteža jednostavnosti i okusa.',
'Tijesto za pizzu, umak od rajčice, svježa mozzarella, svježi bosiljak, maslinovo ulje, sol',
'Razvuci tijesto u krug. Ravnomjerno rasporedi umak od rajčice. Dodaj narezanu mozzarellu. Peci na visokoj temperaturi (250°C+) dok korica ne postane zlatna. Dodaj svježi bosiljak i pokapaj maslinovo ulje prije posluživanja.',

'/images/margherita.jpg',
2),

('Palačinke',
'Mekane i pahuljaste palačinke savršene za doručak ili brunch, poslužene s medom, voćem ili maslacem.',
'Brašno, mlijeko, jaja, šećer, prašak za pecivo, sol, maslac',
'Pomiješaj suhe sastojke u jednoj zdjeli, a mokre u drugoj. Spoji smjese do glatke teksture. Zagrij tavu s maslacem i ulij tijesto u krugove. Peci dok se ne pojave mjehurići, okreni i peci do zlatne boje. Poslužiti toplo.',

'/images/pancakes.jpg',
3),

('Čokoladna torta',
'Bogata i sočna čokoladna torta intenzivnog okusa kakaa, savršena za proslave i desertne trenutke.',
'Brašno, kakao prah, šećer, jaja, maslac, prašak za pecivo, mlijeko, vanilija',
'Pomiješaj suhe sastojke odvojeno od mokrih, zatim ih spoji. Ulij u kalup i peci na 180°C oko 30–35 minuta. Ohladi prije dodavanja glazure ili posluživanja.',

'/images/chocolate_cake.jpg',
4),

('Cezar salata',
'Krispna rimska salata s kremastim Cezar dresingom, hrskavim krutonima i parmezanom.',
'Rimska salata, pileća prsa, parmezan, krutoni, Cezar dresing, maslinovo ulje',
'Ispeci piletinu i nareži je. Operi i nasjeckaj salatu. Pomiješaj salatu s dresingom, dodaj krutone i parmezan. Na vrh stavi piletinu i posluži odmah.',

'/images/caesar_salad.jpg',
5),

('Juha od rajčice',
'Kremasta domaća juha od rajčice s češnjakom i aromatičnim biljem.',
'Rajčice, luk, češnjak, povrtni temeljac, maslinovo ulje, sol, papar, bosiljak',
'Na maslinovom ulju pirjaj luk i češnjak. Dodaj rajčice i kuhaj dok ne omekšaju. Ulij temeljac i kuhaj 20 minuta. Izblendaj i začini po ukusu. Poslužiti toplo.',

'/images/tomato_soup.jpg',
6),

('Hamburger',
'Sočni domaći hamburger s topljenim sirom i svježim povrćem u tostiranoj lepinji.',
'Mljevena govedina, peciva za hamburger, sir, salata, rajčica, luk, sol, papar, kečap',
'Oblikuj pljeskavice i začini. Ispeci ih na roštilju. Lagano tostiraj peciva. Složi burger sa sirom, salatom, rajčicom, lukom i umacima.',

'/images/burger.jpg',
2),

('Pohani kruh',
'Slatko jelo od kruha namočenog u jaja i mlijeko, zatim prženog do zlatne boje.',
'Kruh, jaja, mlijeko, cimet, šećer, maslac, vanilija',
'Umuti jaja, mlijeko, cimet, šećer i vaniliju. Umoči kruh u smjesu. Prži na maslacu do zlatno-smeđe boje. Poslužiti s medom ili voćem.',

'/images/french_toast.jpg',
3),

('Lazanje',
'Slojevito talijansko jelo s bogatim mesnim umakom, bešamelom i sirom.',
'Listovi za lazanje, mljevena govedina, umak od rajčice, luk, češnjak, bešamel, mozzarella, parmezan',
'Kuhaj meso s lukom i češnjakom, dodaj umak od rajčice i kuhaj. U posudi slaži slojeve tjestenine, mesa, bešamela i sira. Ponavljaj. Peci na 180°C 40 minuta.',

'/images/lasagna.jpg',
1),

('Pita od jabuka',
'Klasična domaća pita od jabuka s prhkim tijestom i cimetom aromatiziranim punjenjem.',
'Jabuke, brašno, maslac, šećer, cimet, limunov sok, sol',
'Pripremi tijesto i ohladi. Nareži jabuke i pomiješaj sa šećerom, cimetom i limunom. Napuni koru, poklopi i peci na 180°C 45–50 minuta.',

'/images/apple_pie.jpg',
4),

('Grčka salata',
'Svježa mediteranska salata s maslinama, fetom i hrskavim povrćem.',
'Rajčice, krastavac, crveni luk, masline, feta sir, maslinovo ulje, origano, sol',
'Nareži povrće i pomiješaj u zdjeli. Dodaj masline i fetu. Pokapaj maslinovim uljem i pospi origanom. Lagano promiješaj.',

'/images/greek_salad.jpg',
5),

('Minestrone juha',
'Bogata talijanska juha s povrćem, grahom i tjesteninom.',
'Grah, tjestenina, mrkva, celer, luk, češnjak, rajčica, povrtni temeljac, maslinovo ulje',
'Pirjaj luk, češnjak, mrkvu i celer. Dodaj rajčicu i temeljac. Kuhaj, dodaj grah i tjesteninu. Kuhaj dok ne omekša. Začini i posluži toplo.',

'/images/minestrone.jpg',
6);

INSERT INTO users (username, email, password, role)
VALUES (
'admin',
'admin@apron.com',
'$2y$10$examplehashedpassword',
'admin'
);