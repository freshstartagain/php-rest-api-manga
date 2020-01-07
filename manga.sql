CREATE TABLE `authors` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

INSERT INTO `authors` (`name`) VALUES
('Umino, Chika'),
('Yukimura, Makoto'),
('Fujimoto, Tatsuki'),
('Endou, Tatsuya'),
('Togashi, Yoshihiro');



CREATE TABLE `manga` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `synopsis` TEXT NOT NULL,
    `status` varchar(255) NOT NULL,
    `author_id` int(11) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

INSERT INTO `manga` (`name`, `synopsis`, `status`, `author_id`) VALUES
('3-gatsu no Lion', 'The protagonist is Rei, a 17-year-old shogi player. He lives by himself, not having a family, and does not go to school and has scarcely any friends. Among his acquaintances is a family, which consists of a young woman, Akari, and two young girls, Momo and Hinata, and who also keep a numerous number of cats.', 'Publishing', '1'),
('Vinland Saga', 'Thorfinn, son of one of the Vikings greatest warriors, is among the finest fighters in the merry band of mercenaries run by the cunning Askeladd, an impressive feat for a person his age. However, Thorfinn is not part of the group for the plunder it entails—instead, for having caused his family great tragedy, the boy has vowed to kill Askeladd in a fair duel. Not yet skilled enough to defeat him, but unable to abandon his vengeance, Thorfinn spends his boyhood with the mercenary crew, honing his skills on the battlefield among the war-loving Danes, where killing is just another pleasure of life.', 'Publishing', '2'),
('Chainsaw Man', 'Madness begins with the story of a dark hero who will rock the world. A new era of devils, hunters, and chainsaws begins!', 'Publishing', '3'),
('Spy x Family', 'Under the guise of "The Forgers," the spy, the assassin, and the esper must act as a family while carrying out their own agendas. Although these liars and misfits are only playing parts, they soon find that family is about far more than blood relations.', 'Publishing', '4'),
('Hunter x Hunter', 'During the Hunter Exam, Gon befriends many other potential Hunters, such as the mysterious Killua; the revenge-driven Kurapika; and Leorio, who aims to become a doctor. Theres a world of adventure and peril awaiting, and those who embrace it with open arms can become the greatest Hunters of them all!', 'Publishing', '5');
