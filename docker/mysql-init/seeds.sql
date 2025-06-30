INSERT INTO `ci4db`.`type_user` (`HASH`, `DESCRIPTION`) VALUES (UUID(), 'ADMIN');
INSERT INTO `ci4db`.`type_user` (`HASH`, `DESCRIPTION`) VALUES (UUID(), 'USER');
INSERT INTO `ci4db`.`users` (`HASH`, `NAME`, `EMAIL`, `PHONE`, `PASSWORD`, `FK_USER_TYPE`) VALUES (UUID(), 'ADMIN', 'admin@gmail.com', '31910011001', '$2y$10$lyL87W7thqvUqUdf5iyECu4ym1iaPnYShISrlwH5t3x8lqTvKkgcW', '1');