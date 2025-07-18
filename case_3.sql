-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Июл 16 2025 г., 20:37
-- Версия сервера: 8.2.0
-- Версия PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `case_3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`) VALUES
(1, 7, 2, 'тест коммент'),
(2, 7, 2, 'второй коммент'),
(3, 7, 2, 'павва'),
(4, 7, 2, 'рлррдд'),
(5, 7, 2, 'рлррдд'),
(6, 7, 2, 'вымвыпыип'),
(7, 7, 2, 'fssgsgg');

-- --------------------------------------------------------

--
-- Структура таблицы `on_requests`
--

CREATE TABLE `on_requests` (
  `id` int NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `request_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `on_request` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `post_img`, `on_request`) VALUES
(7, 2, 'Подходит ли мелкий помол для заваривания кофе во френч-прессе?', 'Френч-пресс — один из самых простых и недорогих способов заваривания кофе. Даже тот, кто заваривает кофе впервые, сможет легко разобраться с этим методом и приготовить чашку хорошего кофе. Но можно ли заварить во френч-пресс не просто хороший кофе, а что-то более исключительное, например, попробовав уменьшить помол?\r\n\r\nЭто противоречит тому, к чему мы привыкли, но на самом деле мелкий помол во френч-прессе может пойти на пользу завариванию. Расскажем, почему в этой статье.\r\n\r\n\r\nКак обычно заваривают френч-пресс?\r\nВ заваривании спешалти кофе все уже привыкли регулировать время экстракции, размер помола и другие факторы, чтобы получить идеальную чашку. Это обычная практика с воронками, эспрессо и аэропрессом, а в случае с френч-прессом мы этим почему-то пренебрегаем.\r\n\r\nСамым распространенным считается примерно такой рецепт: берем кофе крупного помола и воду с температурой чуть ниже температуры кипения. Оставляем кофе завариваться на 3-5 минут и получаем неплохую чашку.\r\nНа самом деле, все три переменные в этом методе можно варьировать. И все они будут влиять друг на друга, поэтому, если менять одну из них, нужно обязательно учитывать и все остальные.\r\n\r\nПочему обычно используется крупный помол?\r\nМожет показаться странным покупать хорошую дорогую кофемолку только для френч-пресса, но если вы хотите пить вкусный кофе, стоит об этом задуматься. Качественная кофемолка позволяет получать равномерный помол.\r\n\r\nЕсли помол не равномерен, то вы получаете частички кофе разного размера. Иногда даже могут образовываться настолько маленькие частички, что они похожи на кофейную пыль. Из-за нее кофе получается грязным и горьким.\r\n\r\nКогда мы выбираем кофе крупного помола, вероятность, что в нем будут мелкие частицы, меньше. Это значит получить мутную чашку кофе со странным привкусом тоже меньше. Но на самом деле этого можно избежать, если для мелкого помола использовать качественную кофемолку и сито.\r\n\r\nФренч-пресс — это метод заваривания, при котором весь объем кофе сразу же погружается в воду и экстрагируется дольше, чем в других способах. Именно поэтому для френч-пресса чаще всего выбирают крупный помол, чтобы замедлить экстракцию и избежать переэкстракции.\r\n\r\nВ воронках мелкий помол может препятствовать протеканию воды, во френч-прессе такого проблемы нет, поэтому можно поэкспериментировать. Тем не менее, важно будет учесть время заваривания при изменении помола, чтобы не переэкстрагировать кофе.\r\n\r\nАргумент в пользу мелкого помола\r\nБлагодаря мелкому помолу происходит более быстрая экстракция составляющих кофе, ответственных за его аромат. Благодаря бОльшей площади соприкосновения кофе и воды, растворимые соединения быстро экстрагируются.\r\nМэтт Пергер, основатель Barista Hustle, говорит: «Размер помола не влияет на то, что экстрагируется, но на то, в какой момент — да. Весь вкус уже присутствует в кофе и готов раскрыться. Размер помола влияет на то, как сильно он раскроется».\r\nМэтт подчеркивает: «Чем дольше вода будет взаимодействовать с кофе, тем лучше раскроется вкус». Это можно сделать, увеличив время заваривания, но так как вода постепенно остывает, это может оказаться менее эффективным, чем более быстрое заваривание при мелком помоле.\r\n\r\nОдно из опасений, связанных с использованием мелкого помола, заключается в том, что кофе может получиться мутным или илистым, из-за того, что мелкие частички кофе просочатся через фильтр. На самом деле, у качественных френч-прессов фильтр не пропускает помол среднего размера, и тут стоит учитывать, что частички кофе в воде увеличиваются.\r\nДжеймс Хоффман, автор Всемирного атласа кофе, советует брать кофе среднего помола, помешать его через 4 минуты, а затем дать ему настояться в течение 5-7 минут. Он считает, что «френч-пресс - один из самых простых способов приготовления кофе. Длительное время настаивания позволяет легко получить хорошую экстракцию.\r\nЯ бы посоветовал экспериментировать и уменьшать помол каждый раз. Кофе будет становиться вкуснее, а затем станет горьким. В этой точке надо будет увеличить помол, и вы получите максимум от этого кофе».\r\nСуществует точка переэкстракции. Если помол будет слишком мелкий, то получится кофе, в котором сильно раскроется горечь. Такой напиток неприятно пить.\r\n\r\nКак заваривать кофе мелкого помола?\r\nЕсть такой метод, который можно использовать в качестве отправной точки для ваших собственных экспериментов с размером помола.\r\n\r\nКофе\r\nИспользуйте 35 г кофе и 475 мл воды. Джеймс советует использовать кухонные весы, чтобы точно знать, сколько кофе и воды вы используете, и регулировать по мере необходимости. Измельчите кофе от среднего до средне-крупного помола, с помощью хорошей кофемолки.\r\nЕсли для вас важен чистый кофе, попробуйте использовать кофейные сита для удаления мелкой фракции или крупных частиц. Время заваривания можно сократить, используя сита 600 или 800 микрон. Так убираются самые крупные частицы, что дает более равномерную экстракцию.\r\n\r\nМетод\r\nДля первых проб используйте воду с температурой 93 ℃. Чтобы получить воду такой температуры, сразу после закипания подождите примерно 30 секунд.\r\n\r\nХорошенько перемешайте кофе, чтобы все частички равномерно взаимодействовали с водой, затем закройте крышкой и немного продвиньте плунжер, но так, чтобы он не касался кофе. В стеклянном френч-прессе вода остывает быстро, с закрытой крышкой вода во время экстракции остывает чуть медленнее.\r\n\r\nЧерез 7-10 минут почти все частицы кофе осядут. Следите за этим и будьте готовы опустить плунжер. Продавите его осторожно и медленно, чтобы не растревожить мелкие частицы.\r\n\r\nОставьте небольшое пространство между кофе и фильтром. После этого мы просто даем кофе пропитаться настолько, чтобы он окончательно спустился на дно, и напиток не получился вязким.\r\n\r\nОсторожно налейте кофе так, чтобы сильно не растрясти кофейную гущу, оставьте небольшое количество кофе во френч-прессе под фильтром. Это неприятная илистая жидкость, пить ее не стоит.\r\n\r\nЗатем повторите всё сначала с более мелким помолом и посмотрите, заметите ли вы разницу.\r\nМэтт Перджер говорит: «Для достижения наилучшего результата выберите помол кофе меньше, чем вы когда-либо измельчали для френч-пресса, а затем сделайте еще пару щелчков».\r\n\r\nВыбор температуры воды для мелкого помола\r\nПри изменении помола важно учитывать температуру воды. Поскольку при мелком помоле у кофе больше площадь соприкосновения с водой, он будет экстрагироваться быстрее. Более низкая температура воды может замедлить процесс экстракции и помочь избежать горечи от переэкстракции.\r\n\r\nПри использовании среднего помола мы можем снизить температуру воды с рекомендуемых 93 ℃ до 91 ℃. При такой температуре заваривая кофе немного дольше, мы можем получить достаточно насыщенную чашку, но без горьких нот от переэкстракции.\r\nЕсли понизить температуру воды при крупном помоле, то получится недоэкстрагированный напиток, если только не компенсировать это увеличением времени настаивания. Важно помнить, что все факторы влияют друг на друга. Если вы измените один, скорее всего, надо будет подстраивать и другие.\r\n\r\nСуществует множество способов заваривания кофе, тут главное понять, как работает экстракция, и играть с ней. Вы играете с переменными и находите свой идеальный метод. Попробуйте разную температуру воды, размер помола и время заваривания и посмотрите, что получится.\r\n\r\nКакой френч-пресс выбрать?\r\nТакже стоит упомянуть, что стандартный стеклянный френч-пресс не может поддерживать постоянную температуру заваривания.\r\nЕсли вы серьезно хотите поиграться с переменными в поиске лучшего метода, лучше выбрать керамический заварник или добавить изоляционный слой в стеклянный.\r\n\r\nЗаварники из нержавеющей стали обеспечивают хорошую изоляцию, но в них у напитка могут появляться неприятные нотки вкуса, которые не всем нравятся.\r\n\r\nПонимание экстракции может открыть вам целый мир экспериментов в заваривании. И с френч-прессом можно экспериментировать и придумывать что-то новое так же, как и с другими методами заваривания.\r\nЕсли вы используете качественную кофемолку, создаете условия для хорошего насыщения кофе, а затем медленно продавливаете плунжер, у вас получится чистая и вкусная чашка.\r\n\r\nНе бойтесь экспериментировать, измененяя переменные заваривания. Выбирайте размер помола, температуру воды и время заваривания и делайте заметки о том, что работает, а что нет.', '/uploads/67d039a65bdca_Скриншот 11-03-2025 162429.jpg', 1),
(8, 3, 'Котик на полке — хранитель уюта', 'Когда ты думаешь, что знаешь все укромные уголки своей квартиры — приходит кот и выбирает самое неожиданное место. Сегодня наш пушистый друг решил, что лучшая точка обзора — это верхняя полка! 🧸📚\n\nСидит, как будто он тут главный дизайнер интерьера.\nГлазами говорит: “Не мешай, я наблюдаю за миром сверху. И вообще, эта полка теперь моя”. 😼\n\n🐱 Кто ещё так же неожиданно находит своего кота в самых странных местах?\nДелитесь фотками и историями! ', '/uploads/67d481efdcb7e_2020-08-29 00-32-07.JPG', 0),
(9, 4, 'Подробный разбор всех 4 видов зайцев России.', 'Все знают, что в России есть зайцы. Но мало кто знает, что их у нас водится целых четыре вида! Это краткий гайд на всех лопоухих обитателей нашей страны.\r\n\r\nЗаяц-беляк — король севера и России\r\nЕсли вы когда-нибудь видели зайца, почти наверняка это был именно беляк. Ушастый проныра захватил почти всю территорию России: его ареал простирается от Калининграда до Владивостока! Мало того, он ещё и крайний север освоил. Беляк — единственный заяц нашей страны, что способен выжить в суровых условиях Арктики.\r\n\r\nКогда так и не определился: на улице холодно или тепло.\r\nЕстественно, без особых эволюционных прибамбасов в крае зубодробительного мороза не выжить. Первая и самая известная фишка беляка — его шуба. Зимой — белая, весной — серая, это мы с детства знаем. Кроме цвета меняется и структура волоса: зимний мех тоньше, но длиннее. Благодаря этому создается воздушная прослойка между окружающей средой и телом, и заяц не мерзнет. По тому же принципу работают наши пуховики.\r\n\r\nЛиньку запускает продолжительность светового дня, а её интенсивность зависит от окружающей температуры. В среднем смена шубы длится 2-2,5 месяца.\r\nВторую фишку беляка вы заметите, если поглядите на его следы. Лапы зайца, что у хоббита — просто гигантские! Их ширина — 7–12 см. Это в несколько раз больше, чем у других зайцев! Не конечность, а лыжня какая-то! В общем-то, как лыжи лапы беляка и работают: благодаря большей площади поверхности нагрузка на 1 см² стопы составляет всего 8-12 граммов. Для сравнения: у лисы такая нагрузка составляет около 40 граммов. Так заяц без труда скачет даже по самому рыхлому снегу, не проваливаясь в сугробы!\r\n\r\nСошел с лыжни.\r\nТретья фишка менее эффектная, но от этого не менее эффективная. Среди всех лопоухих локаторы беляка самые скромные. То же касается и хвоста. Всё для того, чтобы их не отморозить! Чем меньше площадь поверхности тела, тем медленнее ты остываешь. Потому все выпирающие части тела полярных жителей — хвост и уши — становятся меньше.\r\n\r\nЗаяц-русак — самый крупный, самый быстрый, самый желанный\r\nЭтот товарищ обладатель сразу трёх почетных титулов. Во-первых, это самый крупный заяц России и один из крупнейших представителей зайцеобразных в целом. Средний вес русака — 4-6 кг, но крупнейшие особи вырастают до 7,5.\r\n\r\nКогда мама ставит тебя к стенке, чтобы замерить, насколько ты вырос за лето.\r\nВо-вторых, это самый быстрый заяц в мире. Обитает русак на открытых пространствах Европейской и Южной части России. В чисто поле не спрятаться, не скрыться — русаки не роют норы. Единственное, на что зверь может положиться — скорость.\r\n\r\nГлотай пыль, пёс!\r\nРусак разгоняется до 70-75 км/ч! Мало того, на такой скорости он дрифтует так, как Вину Дизелю и не снилось! Резкие развороты на 180 градусов прямо в разгар погони? Легко! Внезапный прыжок на три метра в высоту? Запросто! Головокружительные зигзаги, что сбивают с толку даже опытных гончих? Раз плюнуть!\r\n\r\nОхотиться на русака способны лишь средние и крупные хищники. Но даже им заяц способен дать достойный отпор. Внезапный удар задними лапами может сломать кости!\r\nНо даже самый быстрый заяц в мире не способен обогнать пулю. Столетиями русак оставался желанной добычей для охотников. Ежегодно по всей Европе добывали до 5 млн особей в год. Русак кормил весь Старый Свет! По этой причине его называют важнейшим млекопитающим целого континента!\r\n\r\nМаньчжурский заяц — трусишка зайка\r\nЭтот кроха — самый маленький и скрытный заяц нашей страны. Вес маньчжурского зайца — всего 2,5 кг. Он в два раза меньше русака! Его обитель — дремучие леса Дальнего Востока на границе с Китаем. Его оружие — скрытность, а не скорость.\r\n\r\nПривет, я просто пушистый пенек, листай дальше!\r\nКак настоящий отшельник, лишний раз из убежища он не выбирается. В особо снежные зимы маньчжурский заяц прокладывает ходы прямо под сугробами, чтобы не светиться на поверхности. В любой непонятной ситуации зверек ищет укрытие: нора, куст или даже дупло дерева!\r\n\r\nФотографий с маньчжурским зайцем крайне мало — зверек редкий и скрытный.\r\nМаньчжурский заяц настолько беззащитен, что едят его все местные хищники: от леопардов до горностаев. Особенную любовь к косым питает колонок. Это хищник из семейства куньих, что в два раза мельче самого зайца. В удачный для охотника сезон он способен истребить до 12% от местной популяции маньчжурского зайца!\r\n\r\nЗаяц-толай — терминатор-выживатор\r\nЗаяц-толай смотрит смерти в лицо и смеется. Он не боится людей и охотников, каждый день он сражается с противником посерьезнее. Сами силы природы — вот его визави.\r\n\r\nЯ уже не зверь, я уже кремень!\r\nТолай обжился в степях, пустынях и полупустынях нашей страны — на границе со Средней Азией. Он освоил суровые пустоши, где зимой -50, а летом +40. Заяц научился добывать воду там, где земля трескается и вспухает. Часть необходимой организму влаги он научился получать из растительности, которую ест. Вырасти большим и сильным в таких условиях никак не получится — максимальный вес толая — не больше 2,8 кг.\r\n\r\nУши зайца-толая работают как радиаторы. Они отводят лишнее тепло и помогают не поджариться на солнце.\r\nВ суровых краях, где каждый жизненно важный ресурс достается с боем, заяц не испытывает большого страха перед человеком. В древнем Китае их даже пытались приручать! На стоянках возрастом 5 тыс. лет палеонтологи обнаружили места, где зайцев кормили просом — культурным растением. А значит, в Китае бронзового века толая держали в качестве питомца!', '/uploads/6877e2d79a368_2342345.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `post_tags`
--

CREATE TABLE `post_tags` (
  `post_id` int NOT NULL,
  `tag_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `post_tags`
--

INSERT INTO `post_tags` (`post_id`, `tag_id`) VALUES
(8, 1),
(8, 2),
(8, 3),
(7, 4),
(7, 5),
(7, 6),
(7, 7),
(9, 8),
(9, 9),
(9, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `subscribes`
--

CREATE TABLE `subscribes` (
  `id` int NOT NULL,
  `author_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subscribes`
--

INSERT INTO `subscribes` (`id`, `author_id`, `user_id`) VALUES
(2, 2, 3),
(3, 2, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(7, 'еда'),
(8, 'Заяц'),
(4, 'кофе'),
(5, 'кулинария'),
(10, 'познание'),
(3, 'покупки'),
(2, 'права потребителей'),
(9, 'природа'),
(1, 'телефон'),
(6, 'утро');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `avatar`, `password`) VALUES
(2, 'Денис', 'Мижеревич', 'denismizherevich@gmail.com', 'uploads/default.png', '$2y$10$ueQH1KwkMI7taJXhPwXWU.90IwLIfx3HJon0GUZHGzEWeM3fW.hce'),
(3, 'Денис', 'Мижеревич', 'dmezha@yandex.by', 'uploads/1741533416Для фриланса2.jpg', '$2y$10$Gldp0OZvBGBK2ba23/P6juxQkX4dI.sFiMv7UO85lN07zm9w5w9RK'),
(4, 'Тест', 'Профиль', 'test@mail.ru', 'uploads/1752686715Скриншот 16-07-2025 202441.jpg', '$2y$10$/ugym5N8hytczxr0BSNgzOSCCzzjHMukZH2vw4L4eV58iry.cO94u');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `on_requests`
--
ALTER TABLE `on_requests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`post_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Индексы таблицы `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `on_requests`
--
ALTER TABLE `on_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `post_tags`
--
ALTER TABLE `post_tags`
  ADD CONSTRAINT `post_tags_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
