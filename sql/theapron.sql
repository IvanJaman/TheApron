CREATE DATABASE IF NOT EXISTS thapron;
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
('Pasta'),
('Pizza'),
('Breakfast'),
('Dessert'),
('Salad'),
('Soup');

INSERT INTO recipes (title, description, ingredients, instructions, image_url, category_id) VALUES
('Spaghetti Carbonara',
'Classic Italian pasta dish with eggs, cheese and pancetta.',
'Spaghetti, eggs, parmesan, pancetta, black pepper',
'Cook pasta. Fry pancetta. Mix eggs and cheese. Combine everything off heat.',
'/images/carbonara.jpg',
1),
('Margherita Pizza',
'Simple pizza with tomato, mozzarella and basil.',
'Dough, tomato sauce, mozzarella, basil',
'Spread sauce, add cheese, bake at high temp, add basil.',
'/images/margherita.jpg',
2),
('Pancakes',
'Fluffy breakfast pancakes.',
'Flour, milk, eggs, sugar, baking powder',
'Mix ingredients, cook on pan until golden.',
'/images/pancakes.jpg',
3),
('Chocolate Cake',
'Rich and moist chocolate cake.',
'Flour, cocoa, eggs, sugar, butter',
'Mix, bake, cool, add frosting.',
'/images/chocolate_cake.jpg',
4),
('Caesar Salad',
'Fresh salad with creamy dressing.',
'Lettuce, chicken, parmesan, croutons, dressing',
'Mix all ingredients and serve cold.',
'/images/caesar_salad.jpg',
5),
('Tomato Soup',
'Simple homemade tomato soup.',
'Tomatoes, onion, garlic, broth',
'Cook ingredients, blend, simmer.',
'/images/tomato_soup.jpg',
6),
('Beef Burger',
'Juicy homemade burger.',
'Beef patty, bun, cheese, lettuce, tomato',
'Grill patty, assemble burger.',
'/images/burger.jpg',
2),
('French Toast',
'Sweet breakfast toast.',
'Bread, eggs, milk, cinnamon, sugar',
'Dip bread in mix, fry until golden.',
'/images/french_toast.jpg',
3),
('Lasagna',
'Layered pasta with meat and cheese.',
'Lasagna sheets, beef, tomato sauce, cheese',
'Layer ingredients and bake.',
'/images/lasagna.jpg',
1),
('Apple Pie',
'Classic baked apple dessert.',
'Apples, flour, butter, sugar',
'Prepare crust, fill apples, bake.',
'/images/apple_pie.jpg',
4),
('Greek Salad',
'Fresh Mediterranean salad.',
'Tomatoes, cucumber, olives, feta',
'Mix all ingredients.',
'/images/greek_salad.jpg',
5),
('Minestrone Soup',
'Italian vegetable soup.',
'Beans, pasta, vegetables, broth',
'Cook everything together until soft.',
'/images/minestrone.jpg',
6);

INSERT INTO users (username, email, password, role)
VALUES (
'admin',
'admin@apron.com',
'$2y$10$examplehashedpassword',
'admin'
);