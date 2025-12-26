-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+deb12u1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 26 déc. 2025 à 23:06
-- Version du serveur : 10.11.14-MariaDB-0+deb12u2
-- Version de PHP : 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dx06_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `Chapter`
--

CREATE TABLE `Chapter` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Chapter`
--

INSERT INTO `Chapter` (`id`, `content`, `image`) VALUES
(1, 'Le ciel est lourd ce soir sur le village du Val Perdu, dissimulé entre les montagnes. La petite taverne, dernier refuge avant l\'immense forêt, est étrangement calme quand le bourgmestre s’approche de vous. Homme d’apparence usée par les années et les soucis, il vous adresse un regard désespéré. « Ma fille… elle a disparu dans la forêt. Personne n’a osé la chercher… sauf vous, peut-être ? On raconte qu’un sorcier vit dans un château en ruines, caché au cœur des bois. Depuis des mois, des jeunes filles disparaissent… J\'ai besoin de vous pour la retrouver. » Vous sentez le poids de la mission qui s’annonce, et un frisson parcourt votre échine. Bientôt, la forêt s\'ouvre devant vous, sombre et menaçante.', '/DungeonXplorer/public/images/chapitre1.jpg'),
(2, 'Vous franchissez la lisière des arbres, la pénombre de la forêt avalant le sentier devant vous. Un vent froid glisse entre les troncs, et le bruissement des feuilles ressemble à un murmure menaçant. Deux chemins s’offrent à vous : l’un sinueux, bordé de vieux arbres noueux ; l’autre droit mais envahi par des ronces épaisses.', '/DungeonXplorer/public/images/chapitre2.jpg'),
(3, 'Votre choix vous mène devant un vieux chêne aux branches tordues, grouillant de corbeaux noirs qui vous observent en silence. À vos pieds, des traces de pas légers, probablement récents, mènent plus loin dans les bois. Soudain, un bruit de pas feutrés se fait entendre. Vous ressentez la présence d’un prédateur.', '/DungeonXplorer/public/images/chapitre3.jpg'),
(4, 'En progressant, le calme de la forêt est soudain brisé par un grognement. Surgissant des buissons, un énorme sanglier, au pelage épais et aux yeux injectés de sang, se dirige vers vous. Sa rage est palpable, et il semble prêt à en découdre. Le voici qui décide brutalement de vous charger !', '/DungeonXplorer/public/images/chapitre4.jpg'),
(5, 'Tandis que vous progressez, une voix humaine s’élève, interrompant le silence de la forêt. Vous tombez sur un vieux paysan, accroupi près de champignons aux couleurs vives. Il sursaute en vous voyant, puis se détend, vous souriant tristement. « Vous devriez faire attention, étranger, murmure-t-il. La nuit, des cris terrifiants retentissent depuis le cœur de la forêt… Des créatures rôdent. » Après l\'avoir écouté, vous pouvez continuer votre progression.', '/DungeonXplorer/public/images/chapitre5.jpg'),
(6, 'À mesure que vous avancez, un bruissement attire votre attention. Une silhouette sombre s’élance soudainement devant vous : un loup noir aux yeux perçants. Son poil est hérissé et sa gueule laisse entrevoir des crocs acérés. Vous sentez son regard fixé sur vous, prêt à bondir. Le combat est inévitable.', '/DungeonXplorer/public/images/chapitre6.jpg'),
(7, 'Après votre rencontre, vous atteignez une clairière étrange, entourée de pierres dressées, comme un ancien autel oublié par le temps. Une légère brume rampe au sol, et les ombres des pierres semblent danser sous la lueur de la lune.', '/DungeonXplorer/public/images/chapitre7.jpg'),
(8, 'Essoufflé mais déterminé, vous arrivez près d’un petit ruisseau qui serpente au milieu des arbres. Le chant de l’eau vous apaise quelque peu, mais des murmures étranges semblent émaner de la rive. Vous apercevez des inscriptions anciennes gravées dans une pierre moussue.', '/DungeonXplorer/public/images/chapitre8.jpg'),
(9, 'La forêt se disperse enfin, et devant vous se dresse une colline escarpée. Au sommet, le château en ruines projette une ombre menaçante sous le clair de lune. Les murs effrités et les tours en partie effondrées ajoutent à la sinistre réputation du lieu. Vous sentez que la véritable aventure commence ici, et que l’influence du sorcier n’est peut-être pas qu’une légende… Rendez-vous sans perdre de temps à la porte du chateau', '/DungeonXplorer/public/images/chapitre9.jpg'),
(10, 'Le monde se dérobe sous vos pieds, et une obscurité profonde vous enveloppe. Vous ne sentez plus le poids de votre équipement. Une voix murmure : « Brave âme, ton chemin n\'est pas achevé... À ceux qui échouent, une seconde chance est accordée. » La lumière s\'intensifie.', '/DungeonXplorer/public/images/chapitre10.jpg'),
(11, 'Qu’avez-vous fait, Malheureux ! Vous avez touché la pierre maudite.', '/DungeonXplorer/public/images/chapitre11.jpg'),
(12, 'Vous défoncez la lourde porte en bois. À l\'intérieur, vous affrontez les ombres du Sorcier. Le combat est rude, mais vous triomphez. Au fond d\'une crypte, vous la trouvez : Lucy, l\'elfe disparue. Elle est inconsciente mais vivante. Vous la portez hors du château, triomphant. Le village vous acclame. Mais alors que vous redescendez vers la vallée pour fêter cela, une sensation étrange vous parcourt. Comme si cette victoire était trop simple. Comme si le destin vous réservait une dernière épreuve, bien plus cruelle que des monstres de chair et d\'os. Vous décidez de fêter cette victoire à la taverne avec votre compagnon d\'armes, celui qui vous a rejoint à la sortie du château.', '/DungeonXplorer/public/images/chapitre12.jpg'),
(13, 'Le soleil se couche sur les plaines d\'Eldoria. L\'air sent le chèvrefeuille et la magie brute. Vous êtes assis dans une taverne en bois de chêne, une chope d\'hydromel à la main. À votre gauche, Lucy, l\'elfe qui a volé votre cœur. Ses oreilles pointues frémissent de joie, ses yeux verts pétillent. Vous êtes fou d\'elle. Tout va bien. En face de vous, Andres Nigales. C\'est votre meilleur ami. Un nain trapu, barbu, jovial, qui enchaîne les blagues grasses. Il ne ressemble pas à grand-chose assis là, mais vous savez qu\'il possède une force brute colossale et un mana surdéveloppé pour sa taille. — \"À nous, mon frère !\" hurle Andres en levant sa chope. \"À notre gloire éternelle et à ta belle Lucy !\" Lucy vous sourit tendrement, posant sa main fine sur la vôtre. Vous ressentez une chaleur immense, une énergie qui semble infinie. C\'est le bonheur absolu. Andres vous offre un dernier verre, un liquide étrange, violacé. \"C\'est une spécialité de ma famille,\" dit-il avec un clin d\'œil. \"Pour sceller notre amitié.\" Vous buvez. Le monde se met à tourner. Le visage d\'Andres se déforme, son sourire devient carnassier. La main de Lucy sur la vôtre devient glaciale. Le décor de la taverne fond comme de la cire. Le noir complet. Que s\'est-il passé ? Vous ne vous en souvenez plus.', '/DungeonXplorer/public/images/chapitre13.jpg'),
(14, 'Froid. Humide. Une odeur d\'huile de moteur brûlée et d\'ozone. Vous ouvrez les yeux. La douleur vous transperce le crâne. Vous n\'êtes plus dans la taverne. Le ciel n\'est plus bleu, il est gris fer, saturé de néons publicitaires holographiques qui clignotent à travers une pluie acide incessante. Vous essayez de bouger. Vos muscles sont raides. Vous êtes adossé contre quelque chose de métallique et froid. Vous regardez vos vêtements : fini la tunique de cuir, vous portez un long manteau noir en synthétique usé, un pantalon tactique et des bottes lourdes. Vous êtes dans une ruelle sombre, jonchée de déchets cybernétiques. Au loin, les sirènes de police hurlent, et le bruit sourd de basses techno fait trembler le sol. Vous ne savez pas comment, mais vous savez que vous êtes en 2077. Le monde a changé. La magie a laissé place à la technologie, mais la crasse est pire. Vous tâtez vos poches. Vide. Sauf un objet. Une clé de voiture. Une vieille clé physique, pas une carte magnétique. Le logo bavarois est à peine visible sous la rouille.', '/DungeonXplorer/public/images/chapitre14.jpg'),
(15, 'Vous tournez la tête. Vous étiez adossé à une épave... non, pas une épave. Une légende. C\'est une BMW E36. La peinture est partie depuis longtemps, remplacée par de la rouille de surface et des plaques de métal riveté façon Mad Max. Elle a l\'air d\'avoir traversé l\'enfer. Elle est garée de travers, comme abandonnée à la hâte. Mais en y regardant de plus près, ce n\'est pas une voiture normale. Les ailes sont élargies grossièrement pour accueillir des pneus slicks immenses à l\'arrière. Le capot est percé, laissant dépasser un filtre à air gros comme un tonneau. À travers la calandre édentée, vous apercevez ce qui semble être un V8 suralimenté greffé au chausse-pied, bardé de câbles lumineux au néon bleu. C\'est une monstruosité anachronique. Et pourtant, en la touchant, vous ressentez une connexion. Comme si c\'était votre destrier. Elle vous attendait. Vous mettez la clé dans la serrure. Click. Ça s\'ouvre. L\'intérieur est dépouillé : arceau cage, siège baquet usé, et un levier de vitesse hydraulique (frein à main) immense. Sur le tableau de bord, une photo Polaroid jaunie est scotchée.', '/DungeonXplorer/public/images/chapitre15.jpg'),
(16, 'Vous ignorez la voiture pour l\'instant et vous vous dirigez vers la sortie de la ruelle, chancelant. La ville s\'étend devant vous, verticale et oppressante. Des tours de verre et d\'acier percent les nuages acides. Au-dessus, des voitures volantes de la milice patrouillent. En bas, c\'est la jungle. Sur le mur de briques à votre droite, une série d\'affiches holographiques sont placardées. Votre sang se glace. L\'affiche montre un homme... ou plutôt une créature. Il est petit, mais incroyablement large, assis sur un trône fait de crânes et de pièces de moteur. Il porte une armure assistée plaquée or. \"LE SUPRÊME LEADER : ANDRES NIGALES.\" C\'est lui. Votre meilleur ami. Mais ses yeux sont rouges, cybernétiques. Une légende défile en dessous : \"Obéissez ou soyez recyclés. Le Grand Tournoi approche.\" Juste à côté, une autre affiche, plus petite. \"Le Prix du Vainqueur : La Relique Elfique, LUCY.\" On y voit Lucy, enfermée dans une capsule de stase, l\'air terrifié. Elle est le trophée. La rage monte en vous. Une rage pure, brute. Vous sentez une énergie ancienne crépiter au bout de vos doigts. Soudain, deux loubards aux bras cybernétiques sortent de l\'ombre, des couteaux à cran d\'arrêt laser à la main. \"Eh, le clodo. T\'as de beaux yeux. On va te les prendre.\"', '/DungeonXplorer/public/images/chapitre16.jpg'),
(17, 'Vous prenez la photo Polaroid. Elle est abîmée par le temps. On y voit trois personnes devant cette même BMW, mais elle était peinte en noir brillant à l\'époque. Il y a vous, souriant. Il y a Andres, faisant un doigt d\'honneur à la caméra en riant. Et au milieu, Lucy, assise sur le capot. Au dos de la photo, une inscription gribouillée au marqueur : \"Avant la trahison. N\'oublie jamais le plan.\" Quelle trahison ? Quel plan ? Votre mémoire est un gruyère. Soudain, vous entendez des bruits de pas lourds et métalliques venant de l\'entrée de la ruelle. \"Hé ! Qui touche à la caisse du Fantôme ?\" Deux punks avec des implants oculaires bas de gamme s\'approchent. Ils ont l\'air agressifs.', '/DungeonXplorer/public/images/chapitre17.jpg'),
(18, 'Vous sautez dans le siège baquet. L\'odeur de vieux cuir et d\'essence vous est familière. C\'est rassurant. Vous tournez la clé. Il n\'y a pas de démarreur poussif. Le moteur explose littéralement à la vie. Un grondement sourd, guttural, qui fait trembler les vitres des immeubles alentours. Le V8 suralimenté n\'est pas d\'origine, c\'est un monstre hybride, mélangeant combustion archaïque et injection plasma. Les deux punks s\'arrêtent net, effrayés par le bruit. Sur le tableau de bord, un écran holographique s\'allume par-dessus les compteurs analogiques : SYSTEME E36 ONLINE. BIENVENUE, PILOTE. NIVEAU DE NITRO : 100%. Ils chargent vers vous. Vous enclenchez la première. Le levier est dur, mécanique. Vous écrasez la pédale de droite. Les roues arrières, larges comme des tonneaux, patinent sur le bitume humide, dégageant une fumée bleue électrique. La voiture bondit en avant, percutant les poubelles et évitant de justesse les agresseurs qui plongent sur le côté. Vous sortez de la ruelle en dérapage contrôlé, le pare-choc arrière raclant le mur dans une gerbe d\'étincelles.', '/DungeonXplorer/public/images/chapitre18.jpg'),
(19, 'Votre parade est trop lente. La masse du chef loubard fracasse votre garde et vous projette violemment dans la poussière, le souffle coupé. Avant même de pouvoir ramper, une botte lourde vous écrase la poitrine. Les rires cruels des brigands résonnent au-dessus de vous alors qu’une lame froide s’insère dans votre ventre. Une douleur fulgurante vous traverse, suivie instantanément par un froid envahissant. Votre vision s\'obscurcit. Le monde s\'efface. Votre aventure s\'achève ici, dans cette ruelle désaffectée.', '/DungeonXplorer/public/images/chapitre19.jpg'),
(20, 'Vous sprintez vers la BMW. Votre cœur bat à tout rompre. Les sirènes de police se rapprochent. Un drone de surveillance de la Milice du Suprême Leader vous scanne depuis le ciel avec un projecteur rouge. \"CITOYEN NON IDENTIFIÉ. ARRÊTEZ-VOUS IMMÉDIATEMENT.\" Vous glissez sur le capot de la voiture, et vous vous engouffrez à l\'intérieur. Les balles commencent à ricocher sur la carrosserie blindée. Vous démarrez en trombe.', '/DungeonXplorer/public/images/chapitre20.jpg'),
(21, 'Vous sortez de la voiture, les poings serrés. Les deux punks sortent des lames crantées. Le combat est brutal. Vous n\'avez pas votre force d\'antan, mais vous avez la technique. Un coup de pied dans le genou du premier (le bruit de l\'implant qui casse est satisfaisant). Une esquive, un coup de coude dans la gorge du second. Ils sont au sol, gémissant. Vous les fouillez rapidement. Vous trouvez : Une carte d\'accès magnétique périmée. Un paquet de chewing-gum au goût \"Chromium Mint\". Un Flyer froissé. Le flyer annonce : \"RASSO SOUTERRAIN - CE SOIR - ZONE INDUSTRIELLE NORD. Inscription au Tournoi de la Mort possible. Pas de flics, pas de règles.\" C\'est votre seule piste. Vous remontez dans la voiture.', '/DungeonXplorer/public/images/chapitre21.jpg'),
(22, 'Vous êtes sur l\'avenue principale. La voiture vibre de puissance. Mais vous n\'êtes pas seul. Dans le rétroviseur, les gyrophares bleus et rouges de la Milice. Ce ne sont pas des voitures normales, ce sont des intercepteurs blindés. La voix d\'Andres Nigales résonne à travers les haut-parleurs de la ville : \"La criminalité est une maladie. Je suis le remède. Arrêtez le fuyard.\" Vous devez semer les flics pour rejoindre la Zone Industrielle (le lieu du Rasso). La BMW E36 a des modifications que vous ne comprenez pas encore toutes. Sur le volant, trois boutons colorés.', '/DungeonXplorer/public/images/chapitre22.jpg'),
(23, 'Vous pressez le bouton ROUGE. L\'arrière de la BMW s\'ouvre et déverse des litres d\'huile noire bouillante sur la chaussée, suivis d\'une étincelle d\'allumage. VWOUF ! Votre Voiture prend feu et s’arrête. La police vous trouve carbonisé dedans.', '/DungeonXplorer/public/images/chapitre23.jpg'),
(24, 'Vous pressez le bouton BLEU. Le système Spintronic de la voiture projette trois hologrammes identiques de votre BMW qui partent dans des directions différentes. Les flics, dupés par leurs scanners automatiques, se séparent pour poursuivre les fantômes. Vous éteignez vos phares et coupez le moteur pour passer en mode \"Roue Libre Silencieuse\" et glissez dans une ruelle latérale. C\'était malin.', '/DungeonXplorer/public/images/chapitre24.jpg'),
(25, 'Vous braquez violemment à gauche. Le frein à main hydraulique se lève. La voiture se met à l\'équerre, à 140 km/h. Vous entrez sur la bretelle de sortie en marche arrière, face au trafic qui arrive. Les klaxons hurlent. C\'est le chaos. Vous slalomez entre les camions de livraison et les taxis-drones. C\'est magnifique. C\'est de l\'art. Mais vous frottez une glissière de sécurité. L\'aile droite est arrachée, et la voiture est désormais couverte de boue projetée par les bas-côtés. Elle a l\'air d\'une épave, mais elle roule encore fort. État de la voiture : Boueuse, rouillée, aile manquante. Le look parfait pour le Rasso.', '/DungeonXplorer/public/images/chapitre25.jpg'),
(26, 'Zone Industrielle Nord. C\'est un désert de béton, d\'usines désaffectées et de cheminées crachant une fumée verte. Au centre d\'un immense entrepôt dont le toit s\'est effondré, vous voyez des lumières. Des centaines de voitures modifiées sont garées. De la techno hardcore (probablement du \"Schranz\" ou de la \"Phonk\") fait vibrer l\'air. Vous entrez lentement avec votre BMW E36. Le moteur hoquète un peu, elle est sale, couverte de boue, rouillée. Le silence se fait autour de vous. Des gars avec des néons sous la peau et des filles avec des cheveux en fibre optique vous regardent. Ils ont des voitures futuristes : des Teslas volantes tunées, des hypercars japonaises antigravité. Votre E36 fait tache. Elle fait \"vieux monde\". Un groupe s\'approche. Ils ont des éponges et des seaux. Ce ne sont pas des hostiles. \"Wouah... C\'est une relique, mec ?\" demande une jeune fille. Sans un mot, ils commencent à nettoyer la boue sur vos phares et votre pare-brise. C\'est ça, l\'esprit du Rasso. Le respect de la mécanique. C\'est alors qu\'un homme s\'avance. Il porte un survêtement Adidas vintage (très rare), une casquette à l\'envers, et il fume une chicha portative électronique. Il a l\'air détendu, mais son regard scanne tout. C\'est Little Jimmy. \"Salam mon pote,\" dit-il avec un accent à couper au couteau. \"Jolie bête. Mais elle a besoin de réglages si tu veux survivre ici. T\'es là pour le Tournoi, c\'est ça ?\"', '/DungeonXplorer/public/images/chapitre26.jpg'),
(27, 'Little Jimmy tire une latte sur sa chicha électronique. La fumée sent la pomme-double et le liquide de refroidissement. \"Sauver quelqu\'un des griffes du Nain ? Wesh, t\'as du courage, ou t\'es complètement taré. J\'aime ça.\" Il s\'accroupit près de votre jante arrière gauche, tapotant le métal rouillé. \"Écoute, le Tournoi du Suprême Leader, c\'est pas une course de karts. C\'est un massacre sur un mois. Les participants ? C\'est l\'élite de la crasse :\" Il compte sur ses doigts : Adam Smasher, L\'Omerta Chinoise, Yvan, Thanos, Le Vigil de l\'IUT Campus 3. \"Si tu veux survivre, ta caisse suffit pas. Faut que tu saches te battre ici,\" dit Jimmy en pointant sa tempe, puis ses poings. \"Je vais t\'apprendre les bases du Street Fight 2077. C\'est gratuit, c\'est pour la beauté du geste.\"', '/DungeonXplorer/public/images/chapitre27.jpg'),
(28, 'Jimmy vous emmène derrière un conteneur. \"Règle 1 : Ici, y\'a pas d\'honneur. On tape dans les parties, on tire les cheveux, on utilise le décor.\" Il vous lance une clé à molette. Vous l\'attrapez au vol. \"Bien. T\'as des réflexes. Ton style, c\'est quoi ? La force brute ou la technique ?\" Sans attendre, il vous attaque. C\'est amical, mais rapide. Vous apprenez à parer les coups augmentés par cybernétique et à contre-attaquer en visant les points faibles (les joints des prothèses, les batteries externes). À la fin de la séance, vous transpirez, mais vous vous sentez plus affûté. \"Pas mal pour un ancêtre,\" dit Jimmy. \"Mais pour le mental, t\'es trop rigide. Il te faut un coach plus... instable. Je vais t\'envoyer voir le Joker. C\'est un fou, mais il connait les règles du Tournoi par cœur.\"', '/DungeonXplorer/public/images/chapitre28.jpg'),
(29, 'Jimmy vous guide vers un coin sombre du hangar, éclairé par des néons violets qui grésillent. Un homme est assis en tailleur sur le toit d\'une voiture de police retournée. Il porte un costume violet délavé et un maquillage qui coule. Il rit tout seul en jouant avec un couteau papillon. Ce n\'est pas le Joker des comics, c\'est un homme qui a vu beaucoup de choses dans sa vie et qui est devenu à moitié fou après un mauvais trip neurologique. \"Hihihi ! Un nouveau jouet pour Andres !\" glousse-t-il en sautant à terre. \"Jimmy m\'a dit que tu pouvais m\'aider pour le tournoi,\" dites-vous calmement. Le Joker s\'arrête net, son visage à deux centimètres du vôtre. \"Le tournoi ? C\'est une blague ! Une grande blague cosmique ! Tu sais comment on gagne ? Pas en étant le plus fort. En étant le plus imprévisible.\" Il vous tend deux objets et vous demande d\'en choisir un pour votre premier combat. C\'est son \"cadeau\".', '/DungeonXplorer/public/images/chapitre29.jpg'),
(30, 'Vous quittez le Joker (avec votre objet en poche) et retournez vers votre BMW. Elle brille presque, nettoyée par les gars du rasso. Mais quelqu\'un est appuyé contre votre portière. C\'est une jeune femme. Cheveux bleus foncés, long manteau de cuir, lunettes tactiques relevées sur le front. Elle tient un immense fusil de précision futuriste (un Railgun portatif) avec une aisance déconcertante. Elle mâchouille un cure-dent. C\'est Drx Caitlyn. Elle vous regarde de haut en bas, puis regarde la BMW. \"Moteur V8 atmosphérique modifié compresseur. Châssis E36. C\'est rustique. J\'aime bien,\" dit-elle d\'une voix calme et posée. \"Je m\'appelle Caitlyn. Je cherche un pilote. Je suis la meilleure tireuse de ce secteur, mais je ne sais pas conduire. Et vu comment tu as conduit tout à l\'heure, t\'es pas mauvais.\" Elle se redresse. \"Le tournoi se fait en duo. Pilote et Artilleur. Tu veux sauver ta princesse elfe ? Seul, tu vas te faire dévorer par Adam Smasher en 10 secondes. Avec moi ? On a une chance.\" Son regard est intense. Vous sentez une loyauté inébranlable chez elle, même si vous ne vous connaissez que depuis 30 secondes.', '/DungeonXplorer/public/images/chapitre30.jpg'),
(31, 'Caitlyn monte côté passager. Elle range son sniper à l\'arrière, entre l\'arceau de sécurité. \"Direction le bureau d\'inscription, au fond du hangar,\" ordonne-t-elle. Vous avancez la voiture jusqu\'à un guichet tenu par un droïde protocolaire doré et usé. \"NOM DE L\'ÉQUIPE ?\" demande le droïde. Vous regardez Caitlyn, puis la BMW. \"La Team E36,\" répondez-vous Le droïde imprime un ticket holographique. \"INSCRIPTION VALIDÉE. PREMIER COMBAT DANS 24 HEURES. ADVERSAIRE DÉSIGNÉ...\" Le nom s\'affiche en rouge sang dans l\'air. LAURENT JEANPIERRE & Albrecht Zimmermann Spécialité : Attaque de Patrons & Bureaucratie Violente. Caitlyn siffle entre ses dents. \"Laurent JeanPierre et Albrecht Zimmermann... Ce sont des professeurs de javafx et de patrons de conception java. Ils n\'utilise pas d\'armes conventionnelles. Jeanpierre invoque des Patrons et Zimmermann a une force dantesque dans les jambes. Ça va être chiant.\" Vous avez 24h pour faire une dernière modification sur la voiture avant le combat.', '/DungeonXplorer/public/images/chapitre31.jpg'),
(32, 'Vous croisez les bras devant votre E36. « Pourquoi cette épave ? Avec tous ces vaisseaux high-tech, c\'est du suicide. » Caitlyn sourit. Elle sort un gadget et pointe une Tesla volante voisine. CLIC. La voiture se verrouille instantanément, hurlant : \"ERREUR SYSTÈME. CONTRÔLE RESTREINT.\" « Tu vois ? Andres possède le Réseau. Tout ce qui est connecté lui appartient. » Elle caresse le capot rouillé de la BMW avec respect. « J\'étais dans les forces spéciales. Le jour de notre rébellion, ils nous ont juste éteints à distance. Mes amis sont morts piégés dans leurs armures. J\'ai survécu parce que j\'utilise ce vieux fusil mécanique. » Elle vous regarde droit dans les yeux. « Ta voiture, c\'est pareil. Pas de puce, pas de satellite. Juste de la mécanique. Pour Andres, nous sommes invisibles. Des fantômes analogiques. J\'ai la visée, tu as le volant. On y va ? »', '/DungeonXplorer/public/images/chapitre32.jpg'),
(33, '« Les mots, c\'est facile, » grognez-vous en faisant craquer vos jointures. « Mais dans l\'arène, il n\'y a pas de discours. Si tu veux monter dans ma voiture, tu vas devoir me prouver que tu sais te défendre sans ton jouet longue distance. » Caitlyn soupire, mais son sourire s\'élargit. Elle pose délicatement son immense fusil Railgun sur la banquette arrière de la BMW, puis retire son long manteau de cuir, révélant une tenue tactique légère et des bras couverts de cicatrices. « Ok, Pilote. Un round. Premier au sol a perdu. » Elle a pivoté avec une vitesse inhumaine. Un implant de réflexes Sandevistan de classe militaire. Avant que vous ne puissiez vous retourner, vous sentez le canon froid d\'un pistolet compact contre votre nuque. « Pan, » murmure-t-elle à votre oreille. Elle rengaine son pistolet et vous tend la main pour vous aider à vous redresser. « J\'ai vu tes mouvements. Tu as anticipé mon Sandevistan. C\'est... impressionnant pour un \'humain standard\'. Tu feras l\'affaire. ».', '/DungeonXplorer/public/images/chapitre33.jpg'),
(34, 'Le jour J. L\'arène est un ancien stade de foot reconverti en champ de bataille bitumé. Les gradins sont pleins à craquer. La foule hurle. Sur l\'écran géant, le visage d\'Andres Nigales apparaît. Il a l\'air ennuyé. À côté de lui, dans une cage suspendue, Lucy. Elle semble dormir, ou être droguée. Votre cœur se serre. Caitlyn pose sa main sur votre épaule. \"Concentre-toi. On la sortira de là. Mais d\'abord, on s\'occupe du tournoi.\" En face de vous, deux hommes sur un vélo rouge entre dans l\'arène. Un homme en costume cravate, lunettes ronde, et un autre qui pédale avec son casque sur la tête. C\'est Laurent JeanPierre et Albrecht Zimmermann.', '/DungeonXplorer/public/images/chapitre34.jpg'),
(35, 'Vous tentez de percuter le vélo rouge, mais Albrecht Zimmermann pédale avec une fluidité effrayante. Soudain, ses jambes se mettent à luire d\'une couleur étrange, indéfinissable. \"Désolé,\" crie-t-il, \"Mes jambes sont en visibilité package-protected ! Tu n\'es pas dans le même package, tu ne peux pas les toucher !\" Vos attaques passent au travers de lui comme s\'il n\'existait pas. C\'est de l\'encapsulation de haut niveau. Pendant ce temps, Laurent JeanPierre déploie un diagramme de classe UML géant dans le ciel. \"Votre architecture est faible ! Vous avez trop de dépendances !\" Il invoque un Design Pattern Observer. À chaque fois que vous bougez le volant, le vélo rouge réagit instantanément avant même que vous ayez tourné. C\'est impossible. Vous êtes contrés à chaque virage. Finalement, JeanPierre lance une exception FatalError. Le moteur de la BMW cale net. Caitlyn est éjectée de son siège par un Thread mal géré. Vous êtes à terre, vaincus. Le duo terrifiant s\'arrête devant vous. JeanPierre ajuste ses lunettes. \"Nous pourrions vous Garbage Collect, mais cela serait un gaspillage de ressources CPU,\" dit-il froidement. \"Et puis, nous avons un cours de JavaFX en amphi B dans 10 minutes.\" Zimmermann hoche la tête : \"Allez, on compile et on se casse.\" Ils vous épargnent par pur mépris académique et quittent l\'arène sous les applaudissements de l\'IUT entier.', '/DungeonXplorer/public/images/chapitre35.jpg'),
(36, 'De retour au stand, l\'ambiance est morose. Little Jimmy vous tape dans le dos. \"Wesh, t\'inquiète. Personne bat les profs. C\'est des bugs dans la matrice. Mais le prochain combat... c\'est du lourd. Enfin, littéralement.\" L\'annonceur du tournoi prend la parole : \"COMBAT SUIVANT : L\'ÉQUIPE SÉCURITÉ ! LE VIGIL DE L\'IUT CAMPUS 3 ET YVAN !\" Une grille s\'ouvre. Un moteur de tondeuse à gazon se fait entendre. Une Fiat 500 rose pâle (l\'ancien modèle, minuscule) entre dans l\'arène. Elle est tellement petite qu\'elle semble être une voiture de clown. À l\'intérieur, on distingue deux silhouettes. Au volant, Yvan, l\'air stressé. Côté passager, Le Vigil de l\'IUT. Un homme bâti comme une armoire normande, large comme trois distributeurs de boissons. Il porte un gilet jaune fluo \"SÉCURITÉ\" trop petit qui craque aux coutures. Le problème, c\'est l\'espace. Le Vigil essaie de se mettre à l\'aise pour le combat. Il écarte les épaules. CRAAACK. Il écrase littéralement Yvan contre la portière conducteur. Yvan, compressé entre le Vigil et la vitre, lâche un petit couinement, les yeux exorbités, et tombe inconscient sur le klaxon. Poooouet. Le Vigil soupire, ouvre le toit ouvrant avec sa tête, s\'extirpe de la Fiat 500 comme Hulk qui sort d\'un t-shirt, et s\'avance seul vers vous. Il sort une matraque télescopique et un scanner de badges. Yvan est HS dans la Fiat.', '/DungeonXplorer/public/images/chapitre36.jpg'),
(37, 'Vous choisissez la force mécanique. Vous faites vrombir le V8 et foncez droit sur le Vigil. Il ne bouge pas. Il lève la main, paume ouverte. \"STOP ! CARTE ÉTUDIANTE OU CERTIFICAT DE SCOLARITÉ !\" hurle-t-il. Son aura d\'autorité est telle que votre pied hésite sur l\'accélérateur. C\'est le pouvoir du Campus 3. Le Vigil profite de votre hésitation pour frapper le capot de la BMW avec sa matraque. BONG ! La tôle se plie. Ce mec a une force surnaturelle développée à force d\'expulser des étudiants bourrés. Il attrape votre pare-choc à mains nues et commence à soulever l\'avant de la voiture. Les roues arrière patinent dans le vide. \"Caitlyn, fais quelque chose !\" criez-vous.', '/DungeonXplorer/public/images/chapitre37.jpg'),
(38, 'Le Vigil, massif et rapide, charge. Son poing rate votre tête, mais l\'onde de choc vous fait vaciller. Vous tentez un coup de pied au genou. C\'est comme frapper un mur de béton. Le Vigil ne bouge pas. Paniqué par sa force brute, vous tentez de rouler vers la Fiat 500 pour remonter. \"OH NON, TU RESTERAS LÀ !\" rugit le Vigil. Malgré sa taille, il fait un bond incroyable, atterrissant juste devant vous et bloquant votre retraite. Le sol craque sous ses pieds. Il lève lentement sa matraque télescopique au-dessus de sa tête. Vous êtes piégé entre sa masse et le véhicule. Vous fermez les yeux. CRAAC. La matraque s\'abat. Ce n\'est pas un coup, c\'est un impact : vos côtes cèdent sous la force d\'une poutre en acier. Vos poumons se vident d\'un coup, le souffle coupé pour de bon. La douleur est totale et finale. Vous êtes projeté contre la carrosserie de votre voiture et glissez au sol. Le Vigil baisse sa matraque avec un soupir. \"Faut pas essayer de fuir, petit.\" Vos yeux se brouillent. Vous entendez un faible pooouet lointain : Yvan est toujours inconscient sur le klaxon de la Fiat. Et puis, le noir. VOUS ÊTES MORT.', '/DungeonXplorer/public/images/chapitre38.jpg'),
(39, 'Caitlyn épaule son fusil. \"Je vise le lecteur de carte !\" Le coup part. La balle pulvérise le boîtier électronique à la ceinture du Vigil. \"MON SCANNER !\" hurle-t-il, désemparé. \"COMMENT JE VAIS VÉRIFIER LES QUOTAS D\'IMPRESSION ??\" Déstabilisé, il perd sa posture de combat. Il court vers la Fiat 500 pour essayer de réveiller Yvan (toujours encastré dans la portière) pour lui demander une batterie de rechange. C\'est votre chance. Il est de dos, penché vers la petite voiture.', '/DungeonXplorer/public/images/chapitre39.jpg'),
(40, 'La pauvre Fiat, déjà au bout de sa vie avec Yvan écrasé dedans, cède sous le poids du colosse. Les suspensions explosent, les roues partent sur les côtés. La voiture s\'aplatit comme une crêpe. Le Vigil est coincé dans les débris de la Fiat, les jambes en l\'air, agitant sa matraque. \"C\'EST INTERDIT DE STATIONNER SUR MES JAMBES !\" L\'arbitre drone s\'approche. \"IMPOSSIBILITÉ DE COMBATTRE. YVAN : KO. VIGIL : COINCÉ.\" VAINQUEUR : TEAM E36. C\'était laborieux, mais vous passez au tour suivant.', '/DungeonXplorer/public/images/chapitre40.jpg'),
(41, 'L\'arène est nettoyée des débris de la Fiat 500 et du Vigil (qui a été évacué par une grue). L\'ambiance change. Les lumières deviennent rouges et or. Une musique traditionnelle chinoise mélangée à de la Dubstep agressive retentit. Le speaker annonce : \"DEMI-FINALE : TEAM E36 CONTRE... L\'OMERTA CHINOISE !\" Ce n\'est pas une seule voiture qui entre. Ce sont trois berlines noires identiques, des ibishu pigeon futuristes, blindées, aux vitres teintées impénétrables. Elles avancent en formation triangulaire parfaite, pare-chocs contre pare-chocs, comme si elles étaient reliées par des aimants. Caitlyn charge son fusil. \"Ils ne se battent pas comme des individus. Ils ont une conscience collective connectée par neural-link. Si tu en attaques un, les deux autres réagissent instantanément.\" Les trois berlines se séparent et vous encerclent. Les vitres arrières descendent en même temps. Six hommes en costumes noirs, lunettes noires, sortent des pistolets mitrailleurs Type-79 plaqués or.', '/DungeonXplorer/public/images/chapitre41.jpg'),
(42, 'Vous tirez le frein à main. La BMW tournoie dans la fumée, mais les balles de l\'Omerta traversent la carrosserie de toutes parts. Le cercle de berlines se referme inexorablement.\r\nPris au piège, vous tentez le tout pour le tout : utiliser une plaque d\'égout comme tremplin pour sauter par-dessus le barrage. Moteur hurlant, vous foncez.\r\nL\'échec est brutal. Votre voiture percute le toit d\'une berline en plein vol et s\'écrase lourdement au centre de l\'arène. La vision trouble, coincé dans l\'épave, vous voyez une silhouette approcher. \"Pas de témoins.\" Un coup de feu claque. Noir complet.\r\n', '/DungeonXplorer/public/images/chapitre42.jpg'),
(43, 'Vous décidez que la meilleure défense, c\'est l\'attaque frontale. Vous visez la voiture du milieu, celle qui semble coordonner les autres. \"Accroche-toi !\" Vous enclenchez la seconde, le V8 hurle. Les deux autres berlines tentent de vous bloquer en \"sandwich\", mais vous êtes trop rapide. BAM ! Vous percutez l\'arrière de la voiture de tête. Le choc est violent. Les hommes en costard à l\'arrière sont secoués, leurs lunettes de soleil tombent. Mais l\'Omerta est vicieuse. Le coffre de la voiture que vous poussez s\'ouvre. À l\'intérieur, pas de roue de secours, mais un lance-roquettes automatique. Il commence à biper. Verrouillage en cours. Caitlyn hurle : \"Freine ou dégage de là !\".', '/DungeonXplorer/public/images/chapitre43.jpg'),
(44, 'La situation est critique. Les trois voitures se regroupent pour l\'assaut final. Elles foncent vers vous, de front, formant un mur de métal impénétrable. C\'est le moment de gloire de Caitlyn. \"J\'ai compris leur pattern !\" dit-elle. \"Ils sont synchronisés à la milliseconde. Si on en fait planter un, les autres suivront !\" Elle vise non pas les conducteurs, mais un petit boîtier récepteur sur le toit de la voiture de gauche. Elle inspire. Le temps se fige. BANG. La balle explose le récepteur. La voiture de gauche perd la connexion. Elle braque brusquement à droite, pensant éviter un obstacle qui n\'existe pas. Elle percute la voiture du milieu, qui percute celle de droite. C\'est un carambolage spectaculaire à 150 km/h. Les berlines volent en éclats, des pièces de Hongqi et des pistolets en or volent partout. Une explosion cinématique illumine l\'arène. Vous passez à travers les flammes avec votre BMW, tel un phénix de la casse. L\'écran géant affiche : OMERTA : DISSOLUTION. VAINQUEUR : TEAM E36. Vous avez gagné votre place en finale. Mais à quel prix ? La BMW fume, elle a des trous de balles partout.', '/DungeonXplorer/public/images/chapitre44.jpg'),
(45, 'C\'est la nuit avant la finale contre Andres Nigales. Cette fois, c\'est la vraie. Vous êtes dans votre repaire (le hangar désaffecté). Little Jimmy est parti parier sur votre victoire (cote à 50 contre 1). Vous êtes seuls avec Caitlyn et la voiture. Elle passe sa main sur le capot troué de la BMW. \"Elle a tenu le coup,\" dit-elle doucement. \"Contre les profs, contre le vigil, contre la mafia... C\'est une bonne voiture.\" Elle se tourne vers vous. Elle a nettoyé la suie sur son visage, mais ses yeux sont tristes. Elle sait qui est votre adversaire demain. Elle sait que c\'est votre meilleur ami. Elle sait qu\'il y a Lucy. \"Demain, ça se finit,\" dit-elle. Elle sort deux bières tièdes d\'une glacière. Elle vous en tend une. \"À nous. Aux parias.\" Vous trinquez. Le silence est lourd. Soudain, elle pose sa bière et fouille dans sa veste. Elle en sort la fameuse Puce Spintronic. \"Tiens. Je voulais te la donner avant le combat. C\'est un prototype militaire. Si tu la branches sur le moteur, tu auras un boost unique. Si tu la branches sur une arme... ça fait des dégâts irréversibles.\" Elle vous regarde intensément. \"Promets-moi une chose. Quoi qu\'il arrive dans cette arène... ne m\'oublie pas quand tu auras retrouvé ta princesse.\"', '/DungeonXplorer/public/images/chapitre45.jpg'),
(46, 'Le soleil se lève sur 2077. Le ciel est orange toxique. Vous arrivez sur la place centrale. La foule est immense. Des drones filment tout. Au centre, le trône de pièces détachées. Et lui. Andres Nigales. Sur son tricycle. Il vous voit arriver. Il sourit, dévoilant des dents en chrome. \"Enfin ! J\'ai cru que l\'Omerta t\'avait transformé en nem !\" Il regarde votre voiture défoncée. \"T\'as l\'air fatigué, mon pote. T\'as besoin de repos.\" Il claque des doigts. La cage de Lucy descend du ciel. Le décor est planté pour le drame que nous connaissons. Andres active son mode \"Loup\". Il grandit. L\'aura rouge apparaît. Il pose l\'ultimatum. \"Tue ta copine aux cheveux bleus, et je te rends l\'elfe.\"', '/DungeonXplorer/public/images/chapitre46.jpg'),
(47, 'Peu importe votre choix. Le destin, ou plutôt la cruauté d\'Andres, a décidé pour vous. Alors que vous amorcez un geste, Andres lâche un rire guttural. \"Trop lent !\" Le rayon rouge part de sa main cybernétique. Il ne vise pas votre voiture. Il ne vise pas le moteur. Il vise le cœur de celle qui vous rend fort. Caitlyn le voit. Elle ne plonge pas à l\'abri. Au contraire, elle se redresse sur le siège passager, s\'interposant parfaitement entre vous et la mort. ZZAAP. Le bruit est écœurant. L\'odeur de chair brûlée et d\'ozone remplit l\'habitacle de la BMW. Le silence tombe sur l\'arène. Même la foule se tait. La musique change. Les basses lourdes du combat s\'arrêtent. Une mélodie vaporeuse, mélancolique, commence à résonner dans votre tête (et étrangement via les haut-parleurs de la ville hackés par le destin) : In The Pool. Caitlyn s\'effondre contre vous. Sa main, tachée d\'huile de moteur et de sang, cherche votre visage. Vous coupez le moteur. Le V8 se tait par respect. \"Hé...\" souffle-t-elle, du sang aux lèvres. \"T\'as vu ? J\'ai protégé le pilote...\" Ses yeux perdent leur focus. Elle glisse quelque chose dans votre main. C\'est son Sniper Futuriste. Il est lourd, froid. \"Le... le collier d\'Andres...\" murmure-t-elle difficilement. \"C\'est un Spintronic de régulation... Tire dessus... Coupe-lui ses stats...\" Elle vous sourit une dernière fois. Une larme nettoie une trace de crasse sur sa joue. \"Merci d\'avoir été là jusqu\'au bout. Je t\'aime.\" Sa main retombe. Le moniteur cardiaque de son implant bipe une fois, longuement. Drx Caitlyn est morte. Dans la cage, Lucy hurle votre nom, mais ça sonne faux. En face, Andres applaudit lentement, assis sur son petit tricycle. \"Bravo ! Quelle scène ! On dirait du Shakespeare, mais avec plus de cambouis !\" La tristesse disparaît. Elle est remplacée par quelque chose de froid et dur comme le diamant. La Haine.', '/DungeonXplorer/public/images/chapitre47.jpg'),
(48, 'Vous sortez de la BMW. Vous ne courez pas. Vous marchez. Andres fronce les sourcils. \"Quoi ? Tu ne pleures pas ? Tu ne supplies pas ?\" Il active son Aura Rouge. Il hurle et se transforme totalement. Ses implants s\'ouvrent, libérant une énergie colossale. Il devient une bête de trois mètres de haut, un loup de métal et de chair, prêt à vous dévorer. Son tricycle gémit sous le poids mais tient bon (c\'est du solide allemand aussi). Vous levez le fusil de Caitlyn. La lunette s\'aligne automatiquement avec votre rétine. Vous voyez le point faible : un petit disque bleu pulsant incrusté dans sa gorge massive. Le Spintronic. Andres bondit vers vous. \"MEURS !\" Vous pressez la détente. BANG. Ce n\'est pas une balle normale. C\'est un trait de lumière pure. Le projectile traverse l\'air, passe entre les griffes d\'Andres, et percute le disque bleu. CRACK. Le Spintronic explose. L\'effet est immédiat. Andres s\'arrête en plein saut, comme si on avait coupé les fils d\'une marionnette. Son aura rouge disparaît. Ses muscles cybernétiques se dégonflent. Il retombe lourdement au sol, reprenant sa forme de nain trapu, s\'écrasant le nez sur le guidon de son tricycle. Il est au sol, vulnérable, ses stats réduites à 1. Il tousse, rampant vers vous. \"Non... ma force... mon mana...\" Vous le surplombez. Vous armez le fusil pour le coup de grâce. C\'est fini. Vous avez gagné. Vous allez libérer Lucy. C\'est alors que vous entendez le bruit de la cage qui s\'ouvre derrière vous. \"Mon amour !\" crie Lucy. Vous vous retournez, prêt à l\'étreindre.', '/DungeonXplorer/public/images/chapitre48.jpg'),
(49, 'Lucy court vers vous. Elle est magnifique. Ses cheveux blonds flottent. Elle a les bras ouverts. Vous baissez votre garde. Son sourire change. Il devient... cruel. Sa main ne vient pas caresser votre joue. Elle plonge dans sa tunique et en sort un Kunai (dague de jet) noir. SHLACK. La douleur est fulgurante. Elle vous plante le Kunai directement dans l\'œil droit. Vous hurlez, lâchant le fusil, portant la main à votre visage ensanglanté. Vous tombez à genoux. Vous voyez flou (littéralement, vous n\'avez plus qu\'un œil). Lucy vous enjambe, dédaigneuse. Elle marche vers Andres. \"Pauvre imbécile,\" dit-elle d\'une voix glaciale. \"Tu croyais vraiment qu\'une Elfe de Haut-Rang tomberait amoureuse d\'un humain sans mana comme toi ?\" Elle s\'agenouille près d\'Andres Nigales. Elle pose ses mains sur lui. Une lumière verte de guérison émane d\'elle. \"Relève-toi, mon maître. Ton réservoir d\'énergie est là.\" Elle vous pointe du doigt. \"Nous l\'avons attiré ici pour voler son énergie latente. Il a accumulé tellement de puissance durant ce tournoi... Il sera une batterie parfaite pour notre règne éternel.\" Andres se relève, guéri. Il rit, un rire méchant. Il remonte sur son tricycle. \"Merci, ma douce Lucy. Ce plan était génial. Faire croire que j\'étais le méchant, te faire kidnapper... On appelle ça du Storytelling, mon pote !\" Vous êtes à terre, borgne, trahi, mourant. À côté de vous, le corps froid de Caitlyn. Tout était faux. Sauf elle. Sauf Caitlyn. Votre main, tâtonnante, touche quelque chose dans votre poche. La Puce Spintronic de surcharge que Caitlyn vous a donnée la veille. Elle avait dit : \"Si tu la branches sur une arme... ou sur un système...\" Et si vous la branchiez sur un être humain ? Sur un corps fraîchement décédé avec des implants neuronaux encore actifs ?', '/DungeonXplorer/public/images/chapitre49.jpg'),
(50, 'Vous ignorez la douleur de votre œil crevé. Vous ignorez les rires de Lucy et d\'Andres qui s\'approchent pour vous achever. Vous rampez vers Caitlyn. \"Allez... reviens...\" pleurez-vous. Vous trouvez le port d\'interface derrière son oreille. Vous enfoncez la puce de surcharge. CLICK. Pendant une seconde, rien. Puis, une onde de choc bleue repousse Lucy et Andres. Le corps de Caitlyn s\'arque. Ses yeux s\'ouvrent, non plus naturels, mais brillant d\'une lumière néon blanche intense. Les blessures se referment. La peau devient métallique par endroits. Elle se relève, non pas comme une humaine, mais comme une déesse de la vengeance technologique. Elle lévite à quelques centimètres du sol. Elle tend la main vers le Sniper Futuriste. L\'arme vole dans sa main. Elle vous regarde. Sa voix est synthétisée, multiple, terrifiante et rassurante à la fois. \"PILOTE IDENTIFIÉ. MENACE DÉTECTÉE. PROTOCOLE : ANÉANTISSEMENT.\" Andres panique. \"C\'est quoi ça ? C\'est pas dans le script !\" Lucy lance des boules de feu, mais Caitlyn les arrête d\'un simple geste de la main. Caitlyn charge son fusil. L\'énergie de la puce est infinie. \"Pour le pilote,\" dit-elle. Elle tire. Un seul tir. Le rayon est si large qu\'il englobe Andres, son tricycle, et Lucy. Pas de dernier mot. Pas de défense. Ils sont atomisés instantanément. Vaporisés. Il ne reste que la sonnette du tricycle qui retombe au sol avec un petit ding. Le silence revient. Caitlyn redescend au sol. La lumière dans ses yeux s\'adoucit, redevenant humaine. Elle chancelle. La puce a grillé, mais elle est en vie. Elle vous regarde, voit votre œil crevé. Elle s\'agenouille et déchire un bout de sa tunique pour vous faire un bandeau. \"T\'as une sale tête, pilote,\" dit-elle doucement. \"Mais t\'es vivant.\" Vous êtes seuls au milieu des cendres du Suprême Leader. Vous avez gagné.', '/DungeonXplorer/public/images/chapitre50.jpg'),
(51, 'Vous regardez le corps de Caitlyn. Vous regardez Lucy qui ricane. La haine dépasse l\'entendement. \"Vous voulez de l\'énergie ?\" hurlez-vous. \"VENEZ LA CHERCHER !\" Vous plantez la Puce Spintronic de Surcharge directement dans votre tempe. La douleur est atroce. Votre cerveau bout. Vos veines deviennent noires. Votre œil crevé se régénère instantanément en une optique rougeoyante cybernétique. Vous ne ressentez plus la tristesse. Juste la Puissance. Andres tente de vous attaquer avec son tricycle. Vous arrêtez l\'engin d\'une seule main et l\'écrasez comme une canette de soda. Vous attrapez Andres par la barbe. \"Tu étais le Suprême Leader. Je suis le Suprême Désastre.\" Vous lui arrachez la tête. Lucy, terrifiée, tente de vous charmer. \"Mon amour... c\'était un test...\" Vous ne l\'écoutez pas. D\'un revers de main chargé d\'électricité statique, vous la projetez à travers trois immeubles. Vous vous asseyez sur le trône de pièces détachées. La pègre, les gangs, l\'Omerta Chinoise (ce qu\'il en reste), et même le Vigil de l\'IUT se prosternent devant vous. Vous êtes seul. Caitlyn est morte. Lucy est morte. Votre humanité est morte. Mais vous avez gagné. Vous régnez sur 2077 d\'une main de fer.', '/DungeonXplorer/public/images/chapitre51.jpg'),
(52, 'La douleur de l\'œil et le choc de la trahison sont trop forts. Vous n\'avez plus la force de vous battre. Vous rampez vers les pieds de Lucy. \"Pardon... Je ferai tout ce que vous voulez. Juste... ne me tuez pas.\" Lucy sourit doucement. Elle caresse vos cheveux. \"Chut... c\'est bien. Tu acceptes ta place.\" Andres descend de son tricycle. \"C\'est un bon toutou.\" Ils vous emmènent. Pas dans une prison, mais dans le sous-sol de la Tour Centrale. Ils vous branchent à une machine immense. Des câbles entrent dans votre dos. Ils avaient raison : votre énergie est infinie. Vous devenez le générateur principal de la ville. Vous passez le reste de vos jours dans une cuve, conscient, à voir Andres et Lucy régner en tyrans, utilisant VOTRE force pour opprimer le monde. Parfois, Laurent JeanPierre vient faire la maintenance de vos câbles en vous disant que votre rendement baisse.', '/DungeonXplorer/public/images/chapitre52.jpg'),
(53, 'Les humains vous dégoûtent. Les Elfes vous dégoûtent. Seul le métal est fidèle. Vous rampez vers votre BMW E36 fumante. \"Allez ma belle... une dernière virée.\" Vous ouvrez le capot. Vous connectez la puce Spintronic directement sur l\'injection du V8. La voiture s\'éveille. Les phares deviennent des yeux expressifs. La calandre se transforme en une sorte de bouche métallique. \"SYSTEME E36 CONSCIENT. PILOTE EN DANGER. PROTOCOLE : VITESSE LUMIÈRE.\" La voiture démarre toute seule, ouvre sa portière et vous aspire à l\'intérieur avec une ceinture de sécurité qui agit comme un tentacule bienveillant. Andres et Lucy chargent. La BMW lâche un coup de klaxon qui a la puissance d\'une corne de brume de paquebot, les repoussant par l\'onde sonore. La voiture accélère. 0 à 1000 km/h en 0.2 seconde. Vous traversez le mur de l\'arène, puis le mur de la ville, puis le mur du son. Vous filez sur l\'autoroute infinie du désert cybernétique. Caitlyn est morte, mais la voiture a absorbé une partie de sa personnalité via la puce. L\'autoradio s\'allume tout seul : \"T\'inquiète pas pilote. On est libres.\" Vous devenez une légende urbaine : Le Cavalier Borgne et sa Voiture Fantôme.', '/DungeonXplorer/public/images/chapitre53.jpg'),
(54, 'Vous embrassez Caitlyn, le goût du sang et de l\'ozone dans un baiser amer et victorieux. \"On a gagné, Pilote.\" La ville est sans leader. Le peuple est au bord de l\'émeute. Vous montez sur le trône de pièces détachées. Caitlyn se tient à vos côtés. Le Sniper Futurisque \"Vengeance\" sur l\'épaule, elle est votre Impératrice de Néo-Paris. Vous décrétez la fin du régime du tricycle. Vous promettez l\'essence gratuite et l\'absence de contrôles techniques. Les gangs, les péquenauds de l\'IUT et les ouvriers en grève vous acclament. L\'Âge Héroïque de la BMW E36 commence.', '/DungeonXplorer/public/images/chapitre54.jpg'),
(55, 'Vous aidez Caitlyn à se relever. \"La ville n\'a plus de leader. Ce n\'est pas notre guerre.\" Vous montez dans la BMW. Le V8 pétarade doucement. Les phares se rallument. Vous quittez Néo-Paris, laissant derrière vous les cendres et le chaos. Vous roulez, vous roulez. La route est longue. L\'autoradio diffuse toujours de la musique mélancolique. Caitlyn vous parle doucement. Vous trouvez une nouvelle raison de vivre, loin de la tyrannie et de la magie : la route, votre voiture, et votre coéquipière revenue d\'entre les morts. Vous passez le reste de vos jours à réparer la BMW, à la modifier, et à explorer les ruines du monde post-apocalyptique ensemble.', '/DungeonXplorer/public/images/chapitre55.jpg');
INSERT INTO `Chapter` (`id`, `content`, `image`) VALUES
(56, 'Alors que Lucy vous a crevé l\'œil et que tout semble perdu, vous vous souvenez du cadeau du Joker. Vous dégoupillez la grenade de Gaz Hilarant Modifié et la jetez au sol. Un nuage rose et vert explose. Tout le monde le respire. Vous, Andres, Lucy... et même le cadavre de Caitlyn (dont les nanites réagissent au gaz). Andres éclate de rire. Il tombe de son tricycle. \"Hahaha ! Mais qu\'est-ce qu\'on fout ? Je suis un nain sur un vélo d\'enfant ! C\'est ridicule !\" Lucy se tient les côtes. \"J\'avoue ! Et moi je suis une elfe millénaire qui sort avec un nain cyborg ! C\'est n\'importe quoi !\" L\'ambiance se détend instantanément. La haine s\'évapore. Caitlyn se réveille en toussant. \"C\'était quoi ce trip ? J\'ai rêvé que j\'étais morte.\" . Little Jimmy arrive avec des merguez et un barbecue. Le Vigil de l\'IUT sort de l\'hôpital pour ramener des bières. Andres s\'excuse : \"Désolé pour l\'œil, mec. Tiens, prends mon implant oculaire \'Vision X-Ray 3000\', c\'est cadeau.\" Lucy s\'excuse : \"Désolé pour la trahison, c\'était la pression sociale.\" Vous finissez tous autour d\'un grand feu de camp fait avec les débris de l\'arène. Vous avez perdu un œil naturel mais gagné un œil bionique, vous avez deux copines (Caitlyn et Lucy acceptent le polyamour car c\'est le futur), et votre meilleur pote est de nouveau cool. La BMW est garée à côté, brillante.', '/DungeonXplorer/public/images/chapitre56.jpg'),
(57, 'Vous ignorez Andres et visez le collier brillant au cou de Lucy avec le fusil de Caitlyn. BANG. Le Spintronic de contrôle se pulvérise. Lucy s\'effondre, puis se relève avec des yeux remplis d\'une horreur déchirante. Libérée de l\'emprise du Nain, elle voit le corps de Caitlyn et votre œil ensanglanté. \"Non... Andres... tu vas payer !\" Elle incante un sort interdit, sacrifiant toute sa magie. Un trou noir s\'ouvre sous les pieds d\'Andres et de son tricycle. Le Suprême Leader est aspiré instantanément, réduit en poussière. Lucy s\'écroule, épuisée. Elle n\'a plus la force de ressusciter Caitlyn, mais elle utilise le peu de magie qui lui reste pour soigner votre blessure à l\'œil, laissant une fine cicatrice elfique. Elle est désormais votre copilote mélancolique dans la BMW, hantée par son rôle dans la mort de Caitlyn. Votre amour est sombre, une pénitence pour elle, une compagnie pour vous. Vous roulez, honorant la mémoire de celle qui s\'est sacrifiée.', '/DungeonXplorer/public/images/chapitre57.jpg'),
(58, 'Le vrombissement du V8 s\'estompe lentement. Les néons de Néo-Paris s\'éteignent les uns après les autres, laissant place à des lignes de code vert émeraude qui défilent sur un écran noir. Vous retirez votre casque d\'interface : l\'aventure est terminée, mais l\'œuvre, elle, demeure.\r\n\r\nDerrière la brume du Val Perdu et le métal de la BMW E36, se cache une équipe de développeurs qui a donné vie à ce monde. Ce projet, baptisé DungeonXplorer, est le fruit d\'un travail acharné d\'une équipe de 5 étudiants.\r\n\r\nPour bâtir cette épopée, nous avons utilisé les reliques technologiques de notre ère:\r\n    Moteur de rendu : PHP 8 avec une architecture MVC pour une structure solide comme l\'acier.\r\nMémoire vive : Une base de données MySQL gérée via PDO pour sauvegarder chaque choix, chaque PV et chaque objet de votre inventaire.\r\n\r\nInterface Neurale : Un mélange de HTML5, CSS3 et JavaScript, le tout conforme aux normes W3C et WCAG AA 2.0\r\n\r\nTravail de groupe réalisé par les étudiants de deuxième année d\'informatique à l\'IUT Grand Ouest Normandie:\r\nAffholder Quentin\r\nPellerin Milène\r\nPelletier Antoine\r\nDectot Gaspard\r\nBarbet Adrien\r\n\r\nRemerciements\r\n\r\nNous tenons à exprimer notre gratitude à ceux qui ont permis à ce projet de franchir la ligne d\'arrivée :\r\n\r\nChristophe Vallot : Pour son encadrement, sa vision et ses conseils tout au long du développement.\r\n\r\nLa Communauté Open-Source : Pour les outils comme Visual Studio Code, Git, et Font Awesome qui ont été nos armes dans cette quête.\r\n\r\n    Note finale des développeurs : \"Que vous ayez choisi la voie du Guerrier, du Voleur ou du Mage, rappelez-vous que dans le code comme dans la vie, chaque erreur est une occasion de rebooter et de faire un meilleur choix au chapitre suivant.\" ', '/DungeonXplorer/public/images/chapitre58.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Chapter_Treasure`
--

CREATE TABLE `Chapter_Treasure` (
  `id` int(11) NOT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Chapter_Treasure`
--

INSERT INTO `Chapter_Treasure` (`id`, `chapter_id`, `item_id`, `quantity`) VALUES
(1, 4, 15, 1),
(2, 14, 8, 1),
(3, 21, 23, 1),
(4, 6, 15, 1),
(5, 47, 9, 1),
(6, 29, 18, 1),
(7, 29, 19, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Class`
--

CREATE TABLE `Class` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `base_pv` int(11) NOT NULL,
  `base_mana` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `initiative` int(11) NOT NULL,
  `max_items` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Class`
--

INSERT INTO `Class` (`id`, `name`, `description`, `base_pv`, `base_mana`, `strength`, `initiative`, `max_items`) VALUES
(1, 'Guerrier', 'Maître de l\'acier et du bouclier. Tu encaisses les coups sans broncher et tes attaques physiques sont dévastatrices. Idéal pour ceux qui préfèrent résoudre les problèmes par la force brute.', 150, 0, 75, 3, 8),
(2, 'Voleur', 'Tu privilégies l\'esquive, les coups critiques et l\'utilisation d\'objets pour surprendre tes adversaires. Ta chance te permet souvent de trouver des passages dérobés.', 75, 10, 90, 5, 4),
(3, 'Mage', 'Expert en énergies mystiques. Tes sorts peuvent frapper plusieurs ennemis ou te protéger, mais tu es plus fragile physiquement.', 50, 150, 150, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `Encounter`
--

CREATE TABLE `Encounter` (
  `id` int(11) NOT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `monster_id` int(11) DEFAULT NULL,
  `victory_chapter_id` int(11) NOT NULL,
  `defeat_chapter_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Encounter`
--

INSERT INTO `Encounter` (`id`, `chapter_id`, `monster_id`, `victory_chapter_id`, `defeat_chapter_id`) VALUES
(1, 4, 1, 8, 10),
(2, 16, 6, 21, 19),
(3, 6, 10, 7, 10),
(4, 17, 11, 21, 19),
(5, 34, 2, 35, 35),
(6, 36, 3, 37, 38),
(7, 41, 8, 43, 42);

-- --------------------------------------------------------

--
-- Structure de la table `Game_User`
--

CREATE TABLE `Game_User` (
  `User_ID` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Game_User`
--

INSERT INTO `Game_User` (`User_ID`, `username`, `email`, `password`, `admin`) VALUES
(6, 'quentin', 'quentin@quentin.quentin', '$2y$10$JqR5DkvGtImhafqBcvXf4OgJbs1Qy2WqaaL/YSPKauMmHjdKaWCwS', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Hero`
--

CREATE TABLE `Hero` (
  `id` int(11) NOT NULL,
  `user_id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `pv` int(11) NOT NULL,
  `pv_max` int(11) NOT NULL,
  `mana` int(11) NOT NULL,
  `mana_max` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `initiative` int(11) NOT NULL,
  `armor_item_id` int(11) DEFAULT NULL,
  `primary_weapon_item_id` int(11) DEFAULT NULL,
  `secondary_weapon_item_id` int(11) DEFAULT NULL,
  `shield_item_id` int(11) DEFAULT NULL,
  `xp` int(11) NOT NULL,
  `current_level` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Hero`
--

INSERT INTO `Hero` (`id`, `user_id`, `name`, `class_id`, `image`, `biography`, `pv`, `pv_max`, `mana`, `mana_max`, `strength`, `initiative`, `armor_item_id`, `primary_weapon_item_id`, `secondary_weapon_item_id`, `shield_item_id`, `xp`, `current_level`) VALUES
(1, 6, 'xX_GothBaddie_Xx', 1, '/DungeonXplorer/public/images/heroes/hero_1_1766782090.jpg', 'Wow tema le fine shyt\r\n', 999, 999, 999, 999, 1006, 6, NULL, NULL, NULL, NULL, 150, 99);

-- --------------------------------------------------------

--
-- Structure de la table `Hero_Progress`
--

CREATE TABLE `Hero_Progress` (
  `id` int(11) NOT NULL,
  `hero_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `played_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Inventory`
--

CREATE TABLE `Inventory` (
  `id` int(11) NOT NULL,
  `hero_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Items`
--

CREATE TABLE `Items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `item_type` varchar(50) NOT NULL,
  `item_image` varchar(256) NOT NULL,
  `bonus_attaque` int(11) NOT NULL,
  `bonus_defense` int(11) NOT NULL,
  `bonus_pv` int(11) NOT NULL,
  `bonus_mana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Items`
--

INSERT INTO `Items` (`id`, `name`, `description`, `item_type`, `item_image`, `bonus_attaque`, `bonus_defense`, `bonus_pv`, `bonus_mana`) VALUES
(8, 'Clé de BMW', 'Arme contondante improvisée. Bonus +2.', 'Arme', '/DungeonXplorer/public/images/CleBMW.jpg', 2, 0, 0, 0),
(9, 'Sniper de Caitlyn', 'Fusil de sniper lourd. Bonus +10.', 'Arme', '/DungeonXplorer/public/images/SniperCaitlyn.jpg', 10, 0, 0, 0),
(10, 'Matraque du Vigil', 'Aussi lourde que violente Bonus +5.', 'Arme', '/DungeonXplorer/public/images/MatraqueDuVigil.jpg', 5, 0, 0, 0),
(11, 'Manteau en Cuir Noir', 'Protection légère mais stylée. Bonus +2.', 'Armure', '/DungeonXplorer/public/images/ManteauDeCuirNoir.jpg', 0, 2, 0, 0),
(12, 'Gilet Jaune SÉCURITÉ', 'L\'armure du Vigil. Bonus +5.', 'Armure', '/DungeonXplorer/public/images/GiletJaune.jpg', 0, 5, 0, 0),
(14, 'Kebab Synthétique', 'Restaure 40 PV.', 'Potion', '/DungeonXplorer/public/images/KebabSynthetique.jpg', 0, 0, 40, 0),
(15, 'Mana Liquide Bleu', 'Restaure 15 Mana.', 'Potion', '/DungeonXplorer/public/images/ManaLiquideBleu.jpg', 0, 0, 0, 15),
(16, 'Ciao Kombucha', 'Saveur pèche, Restaure 30 pv.', 'Potion', '/DungeonXplorer/public/images/CiaoKombucha.jpg', 0, 0, 30, 0),
(17, 'Monster Blanche Périmée', 'Restaure 15 Mana et 50 PV.', 'Potion', '/DungeonXplorer/public/images/MonsterBlanche.jpg', 0, 0, 50, 15),
(18, 'Bombe Hilarante', 'Libère un gaz vert qui fait rire l\'ennemi jusqu\'à l\'étouffement. Bonus d\'attaque tactique +6.', 'Arme', '/DungeonXplorer/public/images/BombeHilarante.jpg', 6, 0, 0, 0),
(19, 'Jeu de Cartes Tranchantes', 'Cartes en titane aux bords rasoirs. Arme de jet silencieuse et imprévisible. Bonus +4.', 'Arme', '/DungeonXplorer/public/images/JeuDeCarte.jpg', 4, 0, 0, 0),
(20, 'Puce Spintronic', 'Processeur expérimental. Si branché sur le cœur : Restaure 100% PV/Mana. Usage unique.', 'Potion', '/DungeonXplorer/public/images/PuceSpintronic.jpg', 0, 0, 0, 0),
(21, 'Kunai de Lucy', 'Petit poignard de lancer utilisé pour vous crever l\'œil. Rapide et vicieux. Bonus +3.', 'Arme', '/DungeonXplorer/public/images/KunaiDeLucy.jpg', 3, 0, 0, 0),
(22, 'Tricycle en Titane', 'Ridiculement petit mais incroyablement robuste. Offre une protection mobile. Bonus Défense +10.', 'Armure', '/DungeonXplorer/public/images/TrycicleTitane.jpg', 0, 10, 0, 0),
(23, 'Flyer du Rasso', 'Papier froissé trouvé sur un punk. Indique le lieu du tournoi.', 'Indice', '/DungeonXplorer/public/images/FlyerDuRasso.jpg', 0, 0, 0, 0),
(24, 'Clef USB de JeanPierre', 'Contient les sources de son cours Java et des méthodes privées dangereuses.', 'Trophée', '/DungeonXplorer/public/images/ClefUSBJP.jpg', 0, 0, 0, 0),
(25, 'MurailleDeChine', 'Lorsqu\'un coup fatal se produit, une seule fois par combat, sauve le joueur de celui-ci. Une inscription dessus dit \"瓦洛特大人会保护你\".', 'Bouclier', '/DungeonXplorer/public/images/MurailleDeChine.jpg', 0, 0, 0, 0),
(26, 'PortièreE36', 'Portière arrachée de notre fidèle BMW E36. Réduit chaque dégâts pris de 2 points si équipé.', 'Bouclier', '/DungeonXplorer/public/images/PortièreE36.jpg', 0, 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Links`
--

CREATE TABLE `Links` (
  `id` int(11) NOT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `next_chapter_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Links`
--

INSERT INTO `Links` (`id`, `chapter_id`, `next_chapter_id`, `description`) VALUES
(52, 1, 2, 'Traverser le chemin.'),
(53, 2, 3, 'Emprunter le chemin sinueux.'),
(54, 2, 4, 'Prendre le sentier couvert de ronces.'),
(55, 3, 5, 'Rester prudent.'),
(56, 3, 6, 'Ignorer les bruits et poursuivre la route.'),
(59, 5, 7, 'Continuer après avoir écouté le paysan.'),
(62, 7, 8, 'Prendre le sentier couvert de mousse.'),
(63, 7, 9, 'Suivre le chemin tortueux à travers les racines.'),
(64, 8, 11, 'Toucher la pierre gravée.'),
(65, 8, 9, 'Ignorer la curiosité et poursuivre la route.'),
(66, 9, 12, 'Arriver à la porte du château.'),
(67, 10, 1, 'Reprendre l\'aventure au début.'),
(68, 11, 10, 'Voir l\'effet de la pierre maudite.'),
(69, 12, 13, 'Fêter votre victoire en fanfare !'),
(70, 13, 14, 'Se réveiller après le blackout.'),
(71, 14, 15, 'Examiner l\'objet sur lequel vous êtes adossé.'),
(72, 14, 16, 'Essayer de vous lever et marcher vers la sortie de la ruelle.'),
(73, 15, 17, 'Regarder la photo Polaroid.'),
(74, 15, 18, 'S\'installer au volant et tenter de démarrer le monstre.'),
(80, 18, 22, 'Sortie de la ruelle en voiture.'),
(81, 20, 22, 'Démarrer en trombe.'),
(82, 21, 22, 'Démarrer et repartir en voiture.'),
(83, 22, 23, 'Appuyer sur le bouton ROUGE (Flamme)'),
(84, 22, 24, 'Appuyer sur le bouton BLEU (Leurre holographique)'),
(85, 22, 25, 'Prendre la sortie à contresens (Test de Pilotage)'),
(86, 23, 1, 'Vous êtes mort carbonisé.'),
(87, 24, 26, 'Semer la police et arriver au Rasso.'),
(88, 25, 26, 'Semer la police et arriver au Rasso.'),
(89, 26, 27, 'Jouer la carte du mystère.'),
(90, 26, 28, 'Être honnête.'),
(91, 27, 28, 'Accepter l\'entraînement de Jimmy.'),
(92, 27, 29, 'Demander d\'abord qui est le \"Joker\".'),
(93, 28, 29, 'Voir le Joker.'),
(94, 29, 30, 'Choisir la bombe fumigène qui libère du gaz hilarant'),
(95, 30, 31, 'Accepter l\'alliance immédiatement.'),
(96, 30, 32, 'Être méfiant.'),
(100, 30, 33, '« Les mots, c\'est facile! »'),
(101, 31, 34, 'Renforcer le pare-choc.'),
(102, 31, 34, 'Plaque de blindage pour Caitlyn.'),
(103, 31, 34, 'Booster le système Nitro.'),
(104, 32, 31, 'Accepter finalement l\'alliance après explication.'),
(105, 33, 31, 'Monter en voiture après le duel de test.'),
(107, 35, 36, 'Se relever après l\'humiliation académique.'),
(110, 37, 39, 'Caitlyn tire dans le gilet jaune.'),
(112, 39, 40, 'Le percuter violemment par derrière.'),
(113, 40, 41, 'Passer en demi-finale.'),
(116, 42, 1, 'Vous êtes mort.'),
(117, 43, 44, 'Piler sec.'),
(118, 43, 44, 'Coup de volant latéral.'),
(119, 44, 45, 'Se rendre au hangar pour la dernière nuit.'),
(120, 45, 46, '« Je ne t\'oublierai jamais. »'),
(121, 45, 46, '« On fêtera ça tous les trois. »'),
(122, 45, 46, 'Garder le silence.'),
(123, 46, 47, 'Tenter de protéger Caitlyn.'),
(124, 46, 47, 'Hésiter devant Lucy.'),
(125, 47, 48, 'Sortir de la voiture pour venger Caitlyn.'),
(126, 48, 49, 'Tuer Andres immédiatement.'),
(127, 48, 57, 'Tirer sur le collier de Lucy.'),
(128, 49, 50, 'Rebooter Caitlyn.'),
(129, 49, 51, 'Mode Berserker.'),
(130, 49, 52, 'Devenir serviteur.'),
(131, 49, 53, 'Surcharger la BMW.'),
(132, 49, 56, 'Utiliser le gaz hilarant.'),
(133, 50, 54, 'Embrasser Caitlyn et régner.'),
(134, 50, 55, 'Partir explorer le monde.'),
(135, 51, 1, 'Recommencer l\'aventure.'),
(136, 52, 1, 'Recommencer l\'aventure.'),
(137, 53, 1, 'Recommencer l\'aventure.'),
(138, 54, 58, 'Fin de l\'histoire - Crédits.'),
(139, 55, 58, 'Fin de l\'histoire - Crédits.'),
(140, 56, 58, 'Fin de l\'histoire - Crédits.'),
(141, 57, 58, 'Fin de l\'histoire - Crédits.'),
(142, 29, 30, 'Choisir le jeu de cartes aux bords tranchants en titane.');

-- --------------------------------------------------------

--
-- Structure de la table `Monster`
--

CREATE TABLE `Monster` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pv` int(11) NOT NULL,
  `mana` int(11) DEFAULT NULL,
  `initiative` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `attack` text DEFAULT NULL,
  `xp` int(11) NOT NULL,
  `mon_image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Monster`
--

INSERT INTO `Monster` (`id`, `name`, `pv`, `mana`, `initiative`, `strength`, `attack`, `xp`, `mon_image`) VALUES
(1, 'Sanglier', 150, 0, 1, 50, 'Charge', 100, '/DungeonXplorer/public/images/Sanglier.jpg'),
(2, 'JeanPierre & Zimmermann ', 999, 999, 8, 100, 'Invocation de Patron et coup de Pédale', 500, '/DungeonXplorer/public/images/JPEtZimmerman.jpg'),
(3, 'Le Vigil de l\'IUT', 100, 0, 1, 80, 'Matraque', 500, '/DungeonXplorer/public/images/vigil.jpg'),
(4, 'Andres Nigales', 400, 200, 15, 25, 'Coup de Tricycle', 10000, '/DungeonXplorer/public/images/AndresNigales.jpg'),
(6, 'Loubard de Ruelle', 150, 10, 5, 50, 'Couteau à cran d\'arrêt Laser', 50, '/DungeonXplorer/public/images/Loubards.jpg'),
(8, 'L\'omerta Chinoise', 200, 40, 9, 40, 'Danse tactique de L\'omerta', 300, '/DungeonXplorer/public/images/OmertaChinoise.jpg'),
(10, 'Loup malicieux', 100, 0, 3, 60, 'Morsure', 100, '/DungeonXplorer/public/images/Loup.jpg'),
(11, 'Punks', 150, 10, 2, 50, 'Coup de pieds', 150, '/DungeonXplorer/public/images/Punks.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Monster_Loot`
--

CREATE TABLE `Monster_Loot` (
  `id` int(11) NOT NULL,
  `monster_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `drop_rate` decimal(5,2) DEFAULT 1.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Monster_Loot`
--

INSERT INTO `Monster_Loot` (`id`, `monster_id`, `item_id`, `quantity`, `drop_rate`) VALUES
(1, 3, 10, 1, 1.00),
(2, 4, 20, 1, 1.00),
(3, 6, 14, 2, 0.70),
(4, 2, 24, 1, 1.00),
(5, 8, 25, 1, 1.00),
(6, 3, 12, 1, 1.00),
(7, 11, 17, 3, 0.80),
(8, 6, 16, 3, 1.00);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Chapter`
--
ALTER TABLE `Chapter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Chapter_Treasure`
--
ALTER TABLE `Chapter_Treasure`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chapter_id` (`chapter_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Index pour la table `Class`
--
ALTER TABLE `Class`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Encounter`
--
ALTER TABLE `Encounter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapter_id` (`chapter_id`),
  ADD KEY `monster_id` (`monster_id`);

--
-- Index pour la table `Game_User`
--
ALTER TABLE `Game_User`
  ADD PRIMARY KEY (`User_ID`);

--
-- Index pour la table `Hero`
--
ALTER TABLE `Hero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `armor_item_id` (`armor_item_id`),
  ADD KEY `primary_weapon_item_id` (`primary_weapon_item_id`),
  ADD KEY `secondary_weapon_item_id` (`secondary_weapon_item_id`),
  ADD KEY `shield_item_id` (`shield_item_id`),
  ADD KEY `hero_user_id_fk` (`user_id`);

--
-- Index pour la table `Hero_Progress`
--
ALTER TABLE `Hero_Progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hero_id` (`hero_id`),
  ADD KEY `chapter_id` (`chapter_id`);

--
-- Index pour la table `Inventory`
--
ALTER TABLE `Inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hero_id` (`hero_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Index pour la table `Items`
--
ALTER TABLE `Items`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Links`
--
ALTER TABLE `Links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapter_id` (`chapter_id`),
  ADD KEY `next_chapter_id` (`next_chapter_id`);

--
-- Index pour la table `Monster`
--
ALTER TABLE `Monster`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Monster_Loot`
--
ALTER TABLE `Monster_Loot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `monster_id` (`monster_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Chapter`
--
ALTER TABLE `Chapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `Chapter_Treasure`
--
ALTER TABLE `Chapter_Treasure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `Class`
--
ALTER TABLE `Class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Encounter`
--
ALTER TABLE `Encounter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `Game_User`
--
ALTER TABLE `Game_User`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `Hero`
--
ALTER TABLE `Hero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT pour la table `Hero_Progress`
--
ALTER TABLE `Hero_Progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1655;

--
-- AUTO_INCREMENT pour la table `Inventory`
--
ALTER TABLE `Inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `Items`
--
ALTER TABLE `Items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `Links`
--
ALTER TABLE `Links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT pour la table `Monster`
--
ALTER TABLE `Monster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `Monster_Loot`
--
ALTER TABLE `Monster_Loot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Chapter_Treasure`
--
ALTER TABLE `Chapter_Treasure`
  ADD CONSTRAINT `Chapter_Treasure_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `Chapter` (`id`),
  ADD CONSTRAINT `Chapter_Treasure_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Items` (`id`);

--
-- Contraintes pour la table `Encounter`
--
ALTER TABLE `Encounter`
  ADD CONSTRAINT `Encounter_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `Chapter` (`id`),
  ADD CONSTRAINT `Encounter_ibfk_2` FOREIGN KEY (`monster_id`) REFERENCES `Monster` (`id`);

--
-- Contraintes pour la table `Hero`
--
ALTER TABLE `Hero`
  ADD CONSTRAINT `Hero_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `Class` (`id`),
  ADD CONSTRAINT `Hero_ibfk_2` FOREIGN KEY (`armor_item_id`) REFERENCES `Items` (`id`),
  ADD CONSTRAINT `Hero_ibfk_3` FOREIGN KEY (`primary_weapon_item_id`) REFERENCES `Items` (`id`),
  ADD CONSTRAINT `Hero_ibfk_4` FOREIGN KEY (`secondary_weapon_item_id`) REFERENCES `Items` (`id`),
  ADD CONSTRAINT `Hero_ibfk_5` FOREIGN KEY (`shield_item_id`) REFERENCES `Items` (`id`),
  ADD CONSTRAINT `hero_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `Game_User` (`User_ID`);

--
-- Contraintes pour la table `Hero_Progress`
--
ALTER TABLE `Hero_Progress`
  ADD CONSTRAINT `Hero_Progress_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `Hero` (`id`),
  ADD CONSTRAINT `Hero_Progress_ibfk_2` FOREIGN KEY (`chapter_id`) REFERENCES `Chapter` (`id`);

--
-- Contraintes pour la table `Inventory`
--
ALTER TABLE `Inventory`
  ADD CONSTRAINT `Inventory_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `Hero` (`id`),
  ADD CONSTRAINT `Inventory_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Items` (`id`);

--
-- Contraintes pour la table `Links`
--
ALTER TABLE `Links`
  ADD CONSTRAINT `Links_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `Chapter` (`id`),
  ADD CONSTRAINT `Links_ibfk_2` FOREIGN KEY (`next_chapter_id`) REFERENCES `Chapter` (`id`);

--
-- Contraintes pour la table `Monster_Loot`
--
ALTER TABLE `Monster_Loot`
  ADD CONSTRAINT `Monster_Loot_ibfk_1` FOREIGN KEY (`monster_id`) REFERENCES `Monster` (`id`),
  ADD CONSTRAINT `Monster_Loot_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
