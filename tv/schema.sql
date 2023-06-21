CREATE TABLE `tv_series` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `title` varchar(255) NOT NULL,
                             `channel` varchar(45) DEFAULT NULL,
                             `gender` varchar(45) DEFAULT NULL,
                             PRIMARY KEY (`id`),
                             UNIQUE KEY `series_id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `tv_series_intervals` (
                                       `id` int(11) NOT NULL,
                                       `id_tv_series` int(11) NOT NULL,
                                       `week_day` int(11) NOT NULL,
                                       `show_time` int(11) NOT NULL,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


insert into tv_series (id, title, channel, gender) values (1, 'Lonesome', 'Jabbersphere', 'Comedy|Drama|Romance');
insert into tv_series (id, title, channel, gender) values (2, 'Raising Helen', 'Meezzy', 'Comedy|Drama|Romance');
insert into tv_series (id, title, channel, gender) values (3, 'Confessor, The (a.k.a. The Good Shepherd)', 'Gigaclub', 'Drama|Thriller');
insert into tv_series (id, title, channel, gender) values (4, 'Last Polka, The', 'Centidel', 'Comedy|Musical');
insert into tv_series (id, title, channel, gender) values (5, 'Cambridge Spies', 'Livetube', 'Drama');

insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (1, 2, 4, 57600);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (2, 3, 3, 18000);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (3, 1, 7, 36000);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (4, 2, 1, 43200);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (5, 4, 4, 43200);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (6, 5, 3, 57600);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (7, 3, 7, 32400);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (8, 1, 5, 7200);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (9, 5, 3, 28800);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (10, 2, 7, 43200);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (11, 5, 2, 18000);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (12, 1, 4, 43200);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (13, 5, 4, 18000);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (14, 2, 2, 39600);
insert into tv_series_intervals (id, id_tv_series, week_day, show_time) values (15, 3, 6, 0);