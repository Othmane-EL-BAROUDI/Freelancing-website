-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 06 avr. 2023 à 16:46
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lancer`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `first_name_admin` varchar(255) NOT NULL,
  `last_name_admin` varchar(255) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  `exentation` varchar(255) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `first_name_admin`, `last_name_admin`, `email_admin`, `password_admin`, `exentation`, `statut`) VALUES
(1, 'Othmane', 'EL BAROUDI', 'othmane.admin@gmail.com', 'othmanox98', 'jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(255) NOT NULL,
  `first_name_cli` varchar(255) NOT NULL,
  `last_name_cli` varchar(255) NOT NULL,
  `email_client` varchar(255) NOT NULL,
  `password_client` varchar(255) NOT NULL,
  `exentation` varchar(255) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `first_name_cli`, `last_name_cli`, `email_client`, `password_client`, `exentation`, `statut`) VALUES
(1, 'Abdellah', 'Ait Nacer', 'abdellah.client@gmail.com', 'abdellah', 'jpg', 1),
(2, 'Hicham', 'INTAZGA', 'hicham.client@gmail.com', 'hicham12', 'jpg', 1),
(3, 'Charaf-Eddine', 'CHHAIB', 'charaf.client@gmail.com', 'charaf12', 'jpg', 1),
(4, 'Simo', 'KERROUMI', 'simo.client@gmail.com', 'simo1234', 'jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact_us`
--

CREATE TABLE `contact_us` (
  `id_contact` int(11) NOT NULL,
  `idsend` int(11) NOT NULL,
  `first_name_contact` varchar(255) NOT NULL,
  `last_name_contact` varchar(255) NOT NULL,
  `email_contact` varchar(255) NOT NULL,
  `subject_contact` varchar(255) NOT NULL,
  `message_contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact_us`
--

INSERT INTO `contact_us` (`id_contact`, `idsend`, `first_name_contact`, `last_name_contact`, `email_contact`, `subject_contact`, `message_contact`) VALUES
(30, 2, 'Hicham', 'INTAZGA', 'hicham@gmail.com', 'Inquiry about availability', 'Hello, I am interested in hiring a freelancer for a project. Could you let me know if you are available?'),
(31, 3, 'Charaf', 'Chhaib', 'charaf@gmail.com', 'Complaint', 'Hello, I would like to file a complaint about a freelancer I worked with on your platform.'),
(32, 1, 'abdellah', 'Ait', 'abdellah@gmail.com', 'Technical issue', 'Hello, I am experiencing a technical issue with your platform and I would like to report it.'),
(33, 4, 'Simo', 'kerroumi', 'simo@gmail.com', 'Request for quote', 'Hello, I would like to request a quote for a project I am considering.');

-- --------------------------------------------------------

--
-- Structure de la table `freelancer`
--

CREATE TABLE `freelancer` (
  `id_freelancer` int(255) NOT NULL,
  `first_name_free` varchar(255) NOT NULL,
  `last_name_free` varchar(255) NOT NULL,
  `email_freelancer` varchar(255) NOT NULL,
  `password_freelancer` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `hourly_rate` decimal(10,2) NOT NULL,
  `profile_views` int(11) NOT NULL DEFAULT 0,
  `skills` varchar(255) NOT NULL,
  `languages` varchar(255) NOT NULL,
  `description_free` text NOT NULL,
  `experiences` text NOT NULL,
  `joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `statut` int(11) NOT NULL DEFAULT 0,
  `exentation` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `freelancer`
--

INSERT INTO `freelancer` (`id_freelancer`, `first_name_free`, `last_name_free`, `email_freelancer`, `password_freelancer`, `profession`, `hourly_rate`, `profile_views`, `skills`, `languages`, `description_free`, `experiences`, `joined`, `statut`, `exentation`) VALUES
(1, 'Ziad', 'EL BAROUDI', 'ziad.freelancer@gmail.com', 'ziad1234', 'Developer', '25.00', 607, 'PHP, JavaScript, HTML, CSS', 'Arabic, French, English', 'Experienced web developer with expertise in ecommerce and blogging platforms. Skilled in creating responsive designs and optimizing website speed and performance.', 'Worked on multiple ecommerce projects, including customizing payment and shipping modules, managing inventory and orders, and improving site speed. Also created several blogs for clients, including content creation, layout design, and search engine optimization.', '2023-03-10 19:59:39', 1, 'jpg'),
(2, 'Med Amine', 'Aboudrar', 'aboudrar.freelancer@gmail.com', 'aboudrar', 'Designer', '30.00', 760, 'Photoshop, Illustrator, InDesign', 'Arabic, English, Spanish', 'Creative graphic designer with experience in branding and advertising. Skilled in creating eye-catching designs that effectively communicate clients\' messages.', 'Designed logos and branding materials for multiple clients, including a local restaurant chain and a beauty products company. Also created social media ads and print materials, such as flyers and brochures, for various businesses.', '2023-03-10 19:59:39', 1, 'jpg'),
(3, 'Amine', 'ED-DOUIRY', 'amine.freelancer@gmail.com', 'amine123', 'Developer', '40.00', 1005, 'Java, Kotlin, Swift, React Native', 'Arabic, French, English', 'Innovative mobile app developer with expertise in both native and cross-platform development. Skilled in creating intuitive user interfaces and optimizing app performance.', 'Developed multiple mobile apps for clients in various industries, including healthcare, entertainment, and e-commerce. Also created custom software solutions for businesses, such as inventory management systems and customer relationship management tools.', '2023-03-10 19:59:39', 1, 'jpg'),
(4, 'Aya', 'Didi', 'didi.freelancer@gmail.com', 'aya12345', 'Copywriter', '20.00', 265, 'SEO, WordPress', 'Arabic, English, French', 'Talented content writer with experience in creating engaging and informative articles for various niches. Skilled in conducting research and optimizing content for search engines.', 'Created blog articles and website copy for clients in industries such as health and wellness, finance, and travel. Also optimized content for SEO, resulting in increased traffic and higher search engine rankings.', '2023-03-10 19:59:39', 1, 'jpg'),
(5, 'Hamza', 'EL BAKRI', 'hamza.freelancer@gmail.com', 'hamza123', 'Project Manager', '35.00', 604, 'Facebook, Instagram, Twitter, LinkedIn', 'Arabic, English, Spanish', 'Experienced social media manager with a track record of creating successful social media campaigns. Skilled in developing and implementing strategies that increase brand awareness and engagement.', 'Managed social media accounts for multiple clients, including a fashion brand, a tech startup, and a local restaurant. Developed social media strategies and created engaging content that increased follower counts and engagement rates.', '2023-03-10 19:59:39', 1, 'jpg');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id_job` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `budget` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `job_status` enum('public','private','completed') DEFAULT 'public',
  `id_client` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jobs`
--

INSERT INTO `jobs` (`id_job`, `title`, `type`, `category`, `budget`, `description`, `time`, `job_status`, `id_client`) VALUES
(69, 'Web design for Moroccan restaurant', 'Fixed-Price', 'Graphic Design', 3000, 'We need a new website design for our Moroccan restaurant. The site should have an authentic feel and include our menu, photos of our restaurant, and contact information.', 30, 'public', 1),
(70, 'English to French translation', 'Hourly project', 'Translation', 45, 'We need someone to translate a 10-page document from English to French. The content is legal in nature and must be translated accurately.', 5, 'completed', 1),
(71, 'Social media management for beauty brand', 'Contract', 'Social Media Management', 4200, 'We are looking for someone to manage our social media accounts on a monthly basis.', 30, 'private', 3),
(72, 'Data entry for e-commerce store', 'Hourly project', 'Data Entry', 100, 'We need someone to enter product information into our e-commerce store. The job includes adding product descriptions, prices, and photos.', 8, 'public', 3),
(73, 'Graphic design for event poster', 'Fixed-Price', 'Graphic Design', 750, 'We need a poster designed for our upcoming charity event. The poster should be eye-catching and include all the necessary information about the event.', 7, 'public', 4),
(74, 'WordPress website setup for travel agency', 'Fixed-Price', 'Web Development', 5000, 'We need a new WordPress website set up for our travel agency. The site should include information about our services, destinations, and packages.', 21, 'public', 4),
(75, 'Content writing for health blog', 'Hourly project', 'Writing', 200, 'We are looking for someone to write articles for our health blog on a regular basis. The articles should be informative and engaging.', 3, 'public', 2),
(76, 'Video editing for YouTube channel', 'Hourly project', 'Video & Animation', 5000, 'We need someone to edit our YouTube videos on a regular basis. The videos are travel vlogs and should be edited in a fun and engaging way.', 20, 'public', 2),
(77, 'Content Writer for Blog', 'Full-Time', 'Writing', 2000, 'Seeking a skilled content writer to create high-quality blog posts on a variety of topics, including technology, travel, and lifestyle.', 30, 'public', 2),
(78, 'Web Developer for E-commerce Site', 'Fixed-Price', 'Web Development', 500, 'Looking for an experienced web developer to build an e-commerce site for a small business. Must have knowledge of HTML, CSS, and Javascript.', 14, 'public', 4),
(79, 'Graphic Designer for Logo Design', 'Fixed-Price', 'Graphic Design', 250, 'In need of a creative graphic designer to design a unique logo for a new brand. Must have experience in logo design and knowledge of Adobe Illustrator.', 7, 'completed', 3),
(80, 'Social Media Manager', 'Hourly project', 'Social Media Management', 50, 'Looking for a social media manager to help create and execute a social media strategy for a small business. Must have experience with Facebook, Instagram, and Twitter.', 12, 'private', 1);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_freelancer` int(11) NOT NULL,
  `message_fc` varchar(255) NOT NULL,
  `time_sent_message` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `id_sender`, `id_client`, `id_freelancer`, `message_fc`, `time_sent_message`) VALUES
(42, 1, 1, 1, 'Bonjour', '2023-03-25 02:10:29'),
(43, 1, 1, 1, '??', '2023-03-25 02:12:37'),
(44, 1, 1, 1, 'dddd', '2023-03-25 12:21:56'),
(45, 1, 1, 1, 'xls;sù', '2023-03-25 12:23:16');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id_review` int(11) NOT NULL,
  `id_freelancer` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `description` text NOT NULL,
  `rating` int(1) NOT NULL,
  `created__at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id_review`, `id_freelancer`, `id_client`, `description`, `rating`, `created__at`) VALUES
(39, 1, 4, 'Excellent work, very professional and timely delivery. Highly recommend!', 5, '2023-03-10 22:08:12'),
(40, 3, 4, 'Good work but took a bit longer than expected to complete the project.', 3, '2023-03-10 22:08:58'),
(41, 2, 1, 'Impressed with the quality of work and attention to detail. Will hire again.', 4, '2023-03-10 22:09:35'),
(42, 4, 1, 'Great communication and fast delivery. Highly recommended!', 4, '2023-03-10 22:11:00'),
(43, 5, 1, 'I was impressed with the quality of work and attention to detail.', 4, '2023-03-10 22:12:13'),
(44, 4, 3, 'Excellent experience, the freelancer delivered on time and exceeded my expectations.', 5, '2023-03-10 22:13:38'),
(45, 1, 3, 'I had a few revisions but the freelancer was patient and accommodating.', 3, '2023-03-10 22:14:17'),
(46, 2, 3, 'Excellent work! The freelancer went above and beyond to deliver a high-quality project on time.', 5, '2023-03-10 22:15:37'),
(47, 3, 3, 'Unfortunately, the freelancer missed some important details in the project and it had to be revised multiple times.', 2, '2023-03-10 22:17:10'),
(48, 1, 2, 'The freelancer delivered the project on time and provided great support throughout the entire process.', 3, '2023-03-10 22:21:13'),
(49, 1, 1, 'ddd', 1, '2023-03-11 16:11:20');

-- --------------------------------------------------------

--
-- Structure de la table `suivi_job`
--

CREATE TABLE `suivi_job` (
  `id_request` int(11) NOT NULL,
  `id_job` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_freelancer` int(11) NOT NULL,
  `message_job` varchar(255) NOT NULL,
  `status` enum('pending','accepted','rejected','completed') NOT NULL DEFAULT 'pending',
  `time_sent` timestamp NOT NULL DEFAULT current_timestamp(),
  `time_accepted` datetime NOT NULL,
  `time_completed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `suivi_job`
--

INSERT INTO `suivi_job` (`id_request`, `id_job`, `id_client`, `id_freelancer`, `message_job`, `status`, `time_sent`, `time_accepted`, `time_completed`) VALUES
(1, 69, 1, 1, 'Dear Client, I would like to express my interest in this job and would be happy to discuss the details further.', 'pending', '2022-02-05 09:30:00', '2023-03-13 21:38:58', '0000-00-00 00:00:00'),
(2, 70, 1, 2, 'Hello! I am interested in your job posting and would like to discuss the details further.', 'completed', '2022-05-10 08:00:00', '2023-03-11 00:28:16', '2023-03-11 00:28:20'),
(3, 80, 1, 3, 'Hi! I would like to apply for this job. I have the necessary skills and experience to complete it.', 'accepted', '2022-06-05 10:30:00', '2023-03-11 00:28:13', '0000-00-00 00:00:00'),
(4, 75, 2, 4, 'Hi! I am a skilled freelancer who can complete this job to your satisfaction. Please consider my application.', 'pending', '2022-03-04 10:25:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 76, 2, 5, 'Greetings! I am available to take on this project and deliver high-quality work within the given timeframe.', 'completed', '2022-07-12 13:45:00', '2023-03-11 00:30:12', '2023-03-11 00:30:14'),
(6, 77, 2, 1, 'Dear Client, I am a skilled and experienced freelancer who can complete this job according to your requirements.', 'accepted', '2022-08-20 09:15:00', '2023-03-11 00:30:06', '0000-00-00 00:00:00'),
(7, 71, 3, 2, 'Dear client, I am interested in the job you posted. I have experience in graphic design and can provide you with high quality work.', 'accepted', '2022-01-01 09:20:00', '2023-03-11 00:29:25', '0000-00-00 00:00:00'),
(8, 72, 3, 3, 'Hello! I have gone through your job description and I am confident that I can complete it with the required skills and expertise.', 'pending', '2022-09-01 14:30:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 79, 3, 4, 'Hi! I am interested in this job and can provide quality work within the given budget and timeframe.', 'completed', '2022-10-07 07:45:00', '2023-03-11 00:29:29', '2023-03-11 00:29:31'),
(10, 73, 4, 5, 'Hello, I would like to apply for this job. I have experience in web development and can complete this task within the given deadline.', 'accepted', '2022-01-25 08:00:00', '2023-03-11 00:30:42', '0000-00-00 00:00:00'),
(11, 74, 4, 1, 'Greetings! I am a professional freelancer with years of experience in this field. Please consider my application for this job.', 'completed', '2022-11-13 12:00:00', '2023-03-11 00:30:47', '2023-03-11 00:30:51'),
(12, 78, 4, 2, 'Hello! I have the skills and experience required for this job and can deliver quality work within the given time and budget.', 'pending', '2022-12-20 13:30:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id_contact`);

--
-- Index pour la table `freelancer`
--
ALTER TABLE `freelancer`
  ADD PRIMARY KEY (`id_freelancer`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id_job`),
  ADD KEY `fk_clientjob` (`id_client`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `fk_clientmessages` (`id_client`),
  ADD KEY `fk_freelancermessages` (`id_freelancer`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `fk_reviewcli` (`id_client`),
  ADD KEY `fk_reviewfree` (`id_freelancer`);

--
-- Index pour la table `suivi_job`
--
ALTER TABLE `suivi_job`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `fk_suivifreelancer` (`id_freelancer`),
  ADD KEY `fk_suivijob` (`id_job`),
  ADD KEY `fk_suiviclient` (`id_client`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `freelancer`
--
ALTER TABLE `freelancer`
  MODIFY `id_freelancer` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id_job` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `suivi_job`
--
ALTER TABLE `suivi_job`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `fk_clientjob` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_clientmessages` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_freelancermessages` FOREIGN KEY (`id_freelancer`) REFERENCES `freelancer` (`id_freelancer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviewcli` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reviewfree` FOREIGN KEY (`id_freelancer`) REFERENCES `freelancer` (`id_freelancer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `suivi_job`
--
ALTER TABLE `suivi_job`
  ADD CONSTRAINT `fk_suiviclient` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_suivifreelancer` FOREIGN KEY (`id_freelancer`) REFERENCES `freelancer` (`id_freelancer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_suivijob` FOREIGN KEY (`id_job`) REFERENCES `jobs` (`id_job`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
