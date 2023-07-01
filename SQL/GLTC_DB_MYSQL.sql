USE results

CREATE TABLE `drivers` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `full_name` varchar(255)
);

CREATE TABLE `events` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `event_name` varchar(255),
  `location` varchar(255)
);

CREATE TABLE `finishes` (
  `driver_id` int,
  `race_id` int,
  `points` int,
  PRIMARY KEY (`driver_id`, `race_id`)
);

CREATE TABLE `races` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `event_id` int,
  `race_number` int
);

ALTER TABLE `finishes` ADD FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);

ALTER TABLE `finishes` ADD FOREIGN KEY (`race_id`) REFERENCES `races` (`id`);

ALTER TABLE `races` ADD FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

