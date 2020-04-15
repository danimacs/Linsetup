-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Temps de generació: 05-11-2019 a les 08:51:30
-- Versió del servidor: 5.7.27-0ubuntu0.18.04.1
-- Versió de PHP: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `linsetup`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Web Browsers\r\n'),
(2, 'File Sharing\r\n'),
(3, 'Messaging'),
(4, 'Media'),
(5, 'Development'),
(6, 'System'),
(7, 'Documents'),
(8, 'Developer Tools\r\n'),
(9, 'Imaging');

-- --------------------------------------------------------

--
-- Estructura de la taula `saveautoinstaller`
--

CREATE TABLE `saveautoinstaller` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user` int(255) NOT NULL,
  `software` varchar(255) NOT NULL,
  `commands` longtext,
  `share` bit(1) NOT NULL DEFAULT b'0',
  `create_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `software`
--

CREATE TABLE `software` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `category` int(255) DEFAULT NULL,
  `add_repository` varchar(255) DEFAULT NULL,
  `name_packet` varchar(255) NOT NULL,
  `download` int(255) DEFAULT '0',
  `source` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `software`
--

INSERT INTO `software` (`id`, `name`, `logo`, `category`, `add_repository`, `name_packet`, `download`, `source`) VALUES
(1, 'Google Chrome', 'google-chrome-logo.png', 1, 'wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add - | sudo sh -c \'echo \"deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main\" >> /etc/apt/sources.list.d/google.list\'\n\n', 'google-chrome-stable', 0, 'apt install'),
(2, 'Opera', 'opera-logo.png', 1, NULL, 'opera', 0, 'snap install'),
(3, 'Firefox', 'firefox-logo.png', 1, NULL, 'firefox', 0, 'apt install'),
(4, 'Tor', 'tor-logo.png', 1, NULL, 'tor', 0, 'apt install'),
(5, 'Transmission', 'transmission-logo.png', 2, NULL, 'transmission', 0, 'apt install'),
(6, 'Deluge', 'deluge-logo.png', 2, NULL, 'deluge', 0, 'apt install'),
(7, 'qBittorrent', 'qbittorrent-logo.png', 2, NULL, 'qbittorrent', 0, 'apt install'),
(8, 'Skype', 'skype-logo.png', 3, NULL, 'skype', 0, 'snap install'),
(9, 'Telegram Desktop', 'telegram-logo.png', 3, NULL, 'telegram-desktop', 0, 'apt install'),
(10, 'Mailspring', 'mailspring-logo.png', 3, NULL, 'mailspring', 0, 'apt install'),
(11, 'Thunderbird', 'thunderbird-logo.png', 3, NULL, 'thunderbird', 0, 'apt install'),
(12, 'VLC', 'vlc-logo.png', 4, NULL, 'vlc', 0, 'snap install'),
(13, 'Spotify', 'spotify-logo.png', 4, NULL, 'spotify', 0, 'snap install'),
(14, 'Python', 'python-logo.png', 5, NULL, 'python', 0, 'apt install'),
(15, 'Build Essential', 'default-logo.png', 5, NULL, 'build-essential', 0, 'apt install'),
(16, 'OpenJDK 8', 'openjdk-logo.png', 5, NULL, 'openjdk-8-jre', 0, 'apt install'),
(17, 'OpenJDK 7 ', 'openjdk-logo.png', 5, NULL, 'openjdk-7-jre', 0, 'apt install'),
(18, 'PHP', 'php-logo.png', 5, NULL, 'php', 0, 'apt install'),
(19, 'Apache2', 'apache2-logo.png', 5, NULL, 'apache2', 0, 'apt install'),
(20, 'MySQL', 'mysql-logo.svg', 5, NULL, 'mysql-server', 0, 'apt install'),
(21, 'Kotlin', 'kotlin-logo.svg', 5, NULL, 'kotlin', 0, 'snap install'),
(22, 'Ruby', 'ruby-logo.png', 5, NULL, 'ruby-full', 0, 'apt install'),
(23, 'Update', 'default-logo.png', 6, NULL, 'update', 0, 'apt'),
(24, 'Upgrade', 'default-logo.png', 6, NULL, 'upgrade', 0, 'apt'),
(25, 'LibreOffice', 'libreoffice-logo.png', 7, NULL, 'libreoffice', 0, 'snap install'),
(26, 'WPS OFFICE', 'wpsoffice-logo.png', 7, NULL, 'wps-office ', 0, 'snap install'),
(27, 'OnlyOffice', 'onlyoffice-logo.png', 7, NULL, 'onlyoffice-desktopeditors', 0, 'snap install'),
(28, 'Evince', 'evince-logo.svg', 7, NULL, 'evince', 0, 'apt install'),
(29, 'Sublime Text', 'sublime-text-logo.png', 8, NULL, 'sublime-text --classic', 0, 'snap install'),
(30, 'Atom', 'atom-logo.png', 8, NULL, 'atom --classic', 0, 'snap install'),
(31, 'VSCode', 'vscode-logo.png', 8, NULL, 'code --classic', 0, 'snap install'),
(32, 'FileZilla', 'filezilla-logo.png', 8, NULL, 'filezilla', 0, 'apt install'),
(33, 'GIMP', 'gimp-logo.png', 9, NULL, 'gimp', 0, 'snap install'),
(34, 'Blender', 'blender-logo.png', 9, NULL, 'blender --classic', 0, 'snap install'),
(35, 'Audacity', 'audacity-logo.png', 9, NULL, 'audacity', 0, 'apt install'),
(36, 'SweetHome3d', 'sweethome3d-logo.png', 9, NULL, 'sweethome3d', 0, 'apt install'),
(37, 'Inkscape', 'inkscape-logo.png', 9, NULL, 'inkscape', 0, 'snap install');

-- --------------------------------------------------------

--
-- Estructura de la taula `tokens`
--

CREATE TABLE `tokens` (
  `id` int(255) NOT NULL,
  `user` int(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` int(255) DEFAULT NULL,
  `create_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `last_connection_datetime` datetime DEFAULT NULL,
  `staff` bit(1) NOT NULL DEFAULT b'0',
  `verificate` bit(1) NOT NULL DEFAULT b'0',
  `try` varchar(255) DEFAULT '0',
  `blocked` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index de la taula `saveautoinstaller`
--
ALTER TABLE `saveautoinstaller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_saveautoinstaller` (`user`);

--
-- Index de la taula `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_software` (`category`);

--
-- Index de la taula `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_token` (`user`);

--
-- Index de la taula `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT per la taula `saveautoinstaller`
--
ALTER TABLE `saveautoinstaller`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la taula `software`
--
ALTER TABLE `software`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT per la taula `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la taula `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `saveautoinstaller`
--
ALTER TABLE `saveautoinstaller`
  ADD CONSTRAINT `fk_users_saveautoinstaller` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Restriccions per la taula `software`
--
ALTER TABLE `software`
  ADD CONSTRAINT `fk_category_software` FOREIGN KEY (`category`) REFERENCES `categories` (`id`);

--
-- Restriccions per la taula `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `fk_users_token` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;