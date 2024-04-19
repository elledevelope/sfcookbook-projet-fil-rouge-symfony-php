-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 02:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sfcookbook`
--
CREATE DATABASE IF NOT EXISTS `sfcookbook` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sfcookbook`;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240205184327', '2024-02-05 19:45:07', 225),
('DoctrineMigrations\\Version20240206143852', '2024-02-06 15:39:51', 108),
('DoctrineMigrations\\Version20240206144635', '2024-02-06 15:46:45', 169),
('DoctrineMigrations\\Version20240206154644', '2024-02-06 16:46:59', 283),
('DoctrineMigrations\\Version20240206155201', '2024-02-06 16:52:08', 16),
('DoctrineMigrations\\Version20240206162711', '2024-02-06 17:27:17', 48);

-- --------------------------------------------------------

--
-- Table structure for table `favorite_recipes`
--

CREATE TABLE `favorite_recipes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recipe_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorite_recipes`
--

INSERT INTO `favorite_recipes` (`id`, `user_id`, `recipe_id`) VALUES
(36, 3, 20),
(38, 3, 4),
(126, 1, 27),
(127, 1, 20),
(128, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ingredients` varchar(1000) NOT NULL,
  `instructions` varchar(2000) NOT NULL,
  `level` varchar(20) NOT NULL,
  `budget` varchar(50) NOT NULL,
  `cuisine` varchar(20) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `description`, `ingredients`, `instructions`, `level`, `budget`, `cuisine`, `image`, `created_at`, `user_id`) VALUES
(1, 'Pan-Roasted Chicken', 'Pan-roasted chicken is a delicious and easy-to-make dish that combines juicy chicken with flavorful lemon-garlic Brussels sprouts and potatoes. This one-pan meal is perfect for a quick and satisfying dinner.', '4 bone-in, skin-on chicken thighs; Salt and pepper to taste; 1 pound Brussels sprouts, trimmed and halved; 1 pound baby potatoes, halved; 4 cloves garlic, minced; 1 lemon, zested and juiced; 2 tablespoons olive oil; 1 teaspoon dried thyme', 'Preheat your oven to 425°F (220°C);Season the chicken thighs with salt and pepper on both sides;Heat olive oil in an oven-safe skillet over medium-high heat;Place the chicken thighs skin-side down and sear for 3-4 minutes until the skin is golden brown;Flip and sear the other side for an additional 3-4 minutes;Remove the chicken from the skillet and set aside; In the same skillet, add Brussels sprouts and potatoes;Cook for 5-7 minutes, stirring occasionally, until they start to brown;Add minced garlic to the vegetables and sauté for 1-2 minutes until fragrant;Place the seared chicken thighs back into the skillet, nestled among the Brussels sprouts and potatoes;In a small bowl, mix lemon zest, lemon juice, thyme, and paprika;Pour this mixture over the chicken, Brussels sprouts, and potatoes;Transfer the skillet to the preheated oven and roast for 25-30 minutes or until the chicken reaches an internal temperature of 165°F (74°C) and the vegetables are tender', 'Easy', 'Medium', 'Mediterranean', 'pan-roasted-chicken-65aa8de559a54.jpg', '2024-01-09 15:24:00', NULL),
(2, 'Kale Salad', 'A refreshing and nutritious Kale Salad that combines the robust flavors of kale with the sweetness of dried cranberries, the crunch of toasted almonds, and the tanginess of a lemon vinaigrette. This salad is not only delicious but also packed with health.', '1 bunch kale, stems removed and leaves thinly sliced; 1/2 cup dried cranberries; 1/3 cup sliced almonds, toasted; 1/4 cup grated Parmesan cheese; 1/4 cup olive oil; 2 tablespoons lemon juice; 1 teaspoon Dijon mustard; 1 teaspoon honey', 'In a large bowl, massage the kale with a bit of olive oil for a few minutes to soften it;Add dried cranberries, toasted almonds, and Parmesan cheese to the kale;In a small bowl, whisk together olive oil, lemon juice, Dijon mustard, honey, salt, and pepper to make the dressing;Pour the dressing over the kale mixture and toss until well coated; Let the salad sit for a few minutes to allow the flavors to meld;Serve the kale salad as a side dish or add grilled chicken or tofu for a complete meal', 'Beginner', 'Medium', 'American', 'kale-salad-659ec1ec2e1ec.jpg', '2024-01-10 14:59:00', NULL),
(3, 'Souvlaki', 'Souvlaki is a classic Greek dish consisting of skewered and grilled meat, often served with pita bread, tomatoes, onions, and a flavorful tzatziki sauce.', '1.5 lbs (700g) boneless chicken or lamb, cut into bite-sized pieces; 1/4 cup olive oil; 3 tablespoons lemon juice; 2 teaspoons dried oregano; 3 cloves garlic, minced; Salt and pepper to taste; Wooden skewers, soaked in water', 'In a bowl, mix olive oil, lemon juice, oregano, garlic, salt, and pepper to create the marinade; Thread the meat onto the soaked skewers and place them in a shallow dish; Pour the marinade over the skewered meat, ensuring it\'s well-coated; Marinate for at least 1 hour or overnight in the refrigerator; Preheat the grill or grill pan over medium-high heat;Grill the skewers for about 10-15 minutes, turning occasionally, until the meat is cooked through and has a nice char;Serve the souvlaki with pita bread, tomatoes, onions, and a side of tzatziki sauce', 'Intermediate', 'Medium', 'Mediterranean', 'souvlaki-659ebdec60ac6.jpg', '2024-01-10 15:31:00', NULL),
(4, 'Stir-Fried Ginger Sesame Noodles', 'Experience the vibrant flavors of Asian cuisine with our Stir-Fried Ginger Sesame Noodles. This dish combines the bold essence of ginger and sesame with perfectly cooked noodles, creating a delightful fusion of savory and satisfying goodness.', '225g (8 oz) egg noodles; 2 tablespoons sesame oil; 2 tablespoons soy sauce; 1 tablespoon oyster sauce; 1 tablespoon hoisin sauce; 1 tablespoon fresh ginger, minced; 2 cloves garlic, minced; 1 cup mixed vegetables (carrots, bell peppers)', 'Cook the Asian egg noodles according to package instructions. Drain and set aside; In a wok or large pan, heat sesame oil over medium-high heat; Add minced ginger and garlic, sauté for 1-2 minutes until fragrant; Add mixed vegetables and tofu (if using) to the wok, stir-frying until the vegetables are tender-crisp; In a small bowl, mix soy sauce, oyster sauce, and hoisin sauce; Pour the sauce over the vegetables and tofu, stirring to coat evenly; Add the cooked noodles to the wok, tossing them with the vegetables and sauce until well combined and heated through; Garnish with sliced green onions and sesame seeds before serving', 'Beginner', 'Low', 'Asian', 'stir-fried-noodles-659ebd00b5e30.jpg', '2024-01-10 15:33:00', NULL),
(5, 'Spaghetti Bolognese', 'This traditional Italian dish boasts a rich and savory meat sauce, slow-cooked to perfection, and served over al dente spaghetti. Experience the true essence of Italian comfort food with every forkful.', '1 pound (450g) ground beef; 1/2 pound (225g) ground pork; 1 onion, finely chopped; 2 carrots, finely chopped; 2 celery stalks, finely chopped; 3 cloves garlic, minced; 1 can (28 oz) crushed tomatoes; 1/2 cup red wine; 2 tablespoons tomato paste; 1 teaspoo', 'In a large pot, brown ground beef and pork over medium heat until cooked through. Drain excess fat; Add chopped onions, carrots, celery, and minced garlic. Cook until vegetables are softened; Pour in red wine, scraping up any browned bits from the bottom of the pot; Stir in crushed tomatoes, tomato paste, dried oregano, dried basil, salt, and pepper; Simmer for at least 1 hour, stirring occasionally; Pour in the milk and simmer for an additional 30 minutes to enhance the richness of the sauce; Cook spaghetti according to package instructions; Drain and toss with a bit of olive oil; Serve the Bolognese sauce over the cooked spaghetti. Top with grated Parmesan cheese', 'Beginner', 'Medium', 'Italian', 'spaghetti-bolognese-659eaf9d23e50.jpg', '2024-01-10 15:52:00', NULL),
(20, 'Creamy Mushroom Risotto', 'Indulge in the velvety richness of this creamy mushroom risotto, a classic Italian dish that\'s perfect for a cozy night in.', 'Arborio rice;Mushrooms (such as cremini or porcini);Onion;Garlic;White wine;Vegetable broth;Parmesan cheese;Butter;Fresh parsley', 'Sauté mushrooms;Cook onions and garlic;Add rice and wine;Gradually add broth and stir until creamy;Finish with cheese and herbs', 'Intermediate', 'Medium', 'Italian', 'yalamber-limbu-708OpfCW4H8-unsplash.jpg', '2024-01-25 12:12:41', NULL),
(26, 'Veggie Bruschetta', 'Elevate your bruschetta game with this flavorful combination of ripe tomatoes, creamy cream cheese, tangy olives, and aromatic garlic. Perfect for a quick appetizer or snack, these bruschetta are sure to impress your guests.', '1 baguette, sliced; 2 ripe tomatoes, diced; 100 grams cream cheese; 50 grams black olives, sliced; 2 cloves garlic, minced; Fresh basil leaves, for garnish; Extra virgin olive oil, for drizzling; Balsamic glaze, for drizzling; Salt and pepper to taste', 'Preheat the oven to 375°F (190°C); Place the baguette slices on a baking sheet and drizzle with olive oil; Toast in the oven for 5-7 minutes, or until lightly golden and crispy; In a small bowl, mix the diced tomatoes with minced garlic; Season with salt and pepper to taste; Spread a layer of cream cheese on each toasted baguette slice; Top the cream cheese with the tomato and garlic mixture; Arrange sliced black olives on top of the tomatoes; Garnish with fresh basil leaves; Drizzle the bruschetta with extra virgin olive oil and balsamic glaze; Serve immediately and enjoy', 'Easy', 'Medium', 'Italian', 'calum-lewis-rPkgYDh2bmo-unsplash-65ec7c95e4a0a.jpg', '2024-02-06 16:26:32', 3),
(27, 'Pancakes', 'Indulge in a classic breakfast favorite with this simple and delicious pancake recipe. These fluffy pancakes are sure to be a hit with the whole family!', '200 grams all-purpose flour; 2 tablespoons granulated sugar; 1 teaspoon baking powder; 1/2 teaspoon baking soda; 1/4 teaspoon salt; 250 milliliters milk; 1 large egg; 2 tablespoons unsalted butter, melted; Butter or oil for cooking', 'In a large mixing bowl, whisk together the flour, sugar, baking powder, baking soda, and salt; In a separate bowl, whisk together the milk, egg, and melted butter; Pour the wet ingredients into the dry ingredients and stir until just combined. Be careful not to overmix; a few lumps are okay; Heat a non-stick skillet or griddle over medium heat and lightly grease with butter or oil; Pour about 1/4 cup of batter onto the skillet for each pancake; Cook until bubbles form on the surface of the pancake, then flip and cook until golden brown on the other side; Repeat with the remaining batter, greasing the skillet as needed; Serve the pancakes warm with your favorite toppings, such as maple syrup, fresh fruit, or whipped cream', 'Easy', 'Low', 'American', 'sam-moghadam-khamseh-yxZSAjyToP4-unsplash-65ec72453405e.jpg', '2024-02-06 17:58:45', 1),
(28, 'Tomato Bowl Recipe', 'This tomato bowl recipe is a refreshing and healthy dish, perfect for a light lunch or dinner. It\'s packed with flavor and nutrients, making it a satisfying meal option.', '250 grams cherry tomatoes, halved;\r\n    1 cucumber, diced;\r\n    1 red onion, thinly sliced;\r\n    100 grams feta cheese, crumbled;\r\n    50 grams black olives, pitted;\r\n    2 tablespoons extra virgin olive oil;\r\n    1 tablespoon balsamic vinegar;\r\n    Salt and pepper to taste', 'In a large bowl, combine the cherry tomatoes, cucumber, red onion, feta cheese, and black olives;\r\n    Drizzle the extra virgin olive oil and balsamic vinegar over the salad;\r\n    Season with salt and pepper according to your taste preference;\r\n    Toss everything together until well combined;\r\n    Serve the tomato bowl salad immediately, or refrigerate for a while to let the flavors meld together before serving', 'Easy', 'Medium', 'Mediterranean', 'mariana-medvedeva-fk6IiypMWss-unsplash-65ec7c7e4cd2b.jpg', '2024-02-10 22:11:05', 3),
(29, 'French Onion Soup', 'French Onion Soup is a comforting and flavorful dish, perfect for warming up on a chilly day. Enjoy its rich flavors and gooey cheese topping! Bon appétit!', '4 large onions, thinly sliced;\r\n    2 tablespoons butter;\r\n    2 tablespoons olive oil;\r\n    1 teaspoon sugar;\r\n    4 cloves garlic, minced;\r\n    6 cups beef broth;\r\n    1/2 cup dry white wine;\r\n    1 bay leaf;\r\n    4 slices of French bread, toasted;\r\n    1 cup grated Gruyère cheese;\r\n    Salt and pepper to taste;\r\n    Chopped fresh parsley for garnish', 'In a large pot, melt the butter and olive oil over medium heat. Add the thinly sliced onions and sugar, and cook, stirring occasionally, until the onions are caramelized and golden brown, about 30-40 minutes;\r\n    Stir in the minced garlic and cook for an additional 1-2 minutes.\r\n    Pour in the beef broth and white wine, and add the bay leaf. Bring the soup to a simmer, then reduce the heat to low and let it simmer for about 20-30 minutes to allow the flavors to meld. Season with salt and pepper to taste;\r\n    Preheat your broiler;\r\n    Ladle the soup into oven-safe bowls. Top each bowl with a slice of toasted French bread and sprinkle generously with grated Gruyère cheese;\r\n    Place the bowls on a baking sheet and broil in the oven until the cheese is melted and bubbly, about 2-3 minutes;\r\n    Carefully remove the bowls from the oven using oven mitts, as they will be hot. Garnish with chopped fresh parsley, and serve hot', 'Medium', 'Medium', 'French', 'recipe_.jpg', '2024-04-19 14:18:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `about` varchar(500) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`, `about`, `avatar`, `created_at`) VALUES
(1, 'jane@gmail.com', '[\"ROLE_USER\"]', '$2y$13$MVlE0A1iepK8cmLugUMVWuVx21w5TMRBaN7KuPpdMk7dgsF/QhpuO', 'Jane', 'I enjoy exploring various cuisines. I believe that food brings people together and I love to share my delicious creations with the Cookbook community.', 'avatar-65beabe01584e-65ec71a288d4b.svg', '2024-01-19 17:22:48'),
(2, 'admin@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$jVvy.vol4sHDR0bvQt3mEOUV85INoJ6qJz3HHmpdhNgFcYjan8laa', 'ImAdmin', NULL, NULL, '2024-01-28 16:20:14'),
(3, 'jack@doe.com', '[\"ROLE_USER\"]', '$2y$13$MpO/4S6RKTtx95UjR5IDzeAgXxInLhwk.PsGPYEfz4pMZM8Vqgdau', 'Jack', NULL, NULL, '2024-02-03 22:35:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `favorite_recipes`
--
ALTER TABLE `favorite_recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FE3D4CDBA76ED395` (`user_id`),
  ADD KEY `IDX_FE3D4CDB59D8A214` (`recipe_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A369E2B5A76ED395` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorite_recipes`
--
ALTER TABLE `favorite_recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorite_recipes`
--
ALTER TABLE `favorite_recipes`
  ADD CONSTRAINT `FK_FE3D4CDB59D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  ADD CONSTRAINT `FK_FE3D4CDBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `FK_A369E2B5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
