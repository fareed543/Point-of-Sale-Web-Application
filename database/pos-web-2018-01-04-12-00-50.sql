SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--Database: `pos-web`




CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO category VALUES
("13","PASTRIES","1","2017-10-30 16:05:37","0","0000-00-00 00:00:00","1"),
("14","CHOUX (N-Size)","1","2017-10-30 16:06:12","1","2017-10-30 16:06:27","1"),
("15","CHOUX (B-Size)","1","2017-10-30 16:06:38","0","0000-00-00 00:00:00","1"),
("16","TARTS (S-Size)","1","2017-10-30 16:07:03","0","0000-00-00 00:00:00","1"),
("17","TARTS (B-Size)","1","2017-10-30 16:07:26","0","0000-00-00 00:00:00","1"),
("18","CUPS","1","2017-10-30 16:07:34","0","0000-00-00 00:00:00","1"),
("19","CAKES","1","2017-10-30 16:07:42","0","0000-00-00 00:00:00","1"),
("20","DONUTS","1","2017-10-30 16:07:52","0","0000-00-00 00:00:00","1"),
("21","BREAD","1","2017-10-30 16:07:59","0","0000-00-00 00:00:00","1"),
("22","VIENNESE  PASTRY","1","2017-10-30 16:08:10","0","0000-00-00 00:00:00","1"),
("23","BUISCUITS","1","2017-10-30 16:08:19","0","0000-00-00 00:00:00","1"),
("24","OTHERS","1","2017-10-30 16:08:26","0","0000-00-00 00:00:00","1");




CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO ci_sessions VALUES
("d57aad477ef8b00323335f12a0149d2fda7fbf95","::1","1510538717","__ci_last_regenerate|i:1510538717;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("ad30009d03a060ac52c5ce49780c96fdc119fa31","::1","1510538226","__ci_last_regenerate|i:1510538188;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("8110bf9bfd77502f7e4bb101b448c68af7208579","::1","1510244142","__ci_last_regenerate|i:1510244119;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("4aadd510d785ea2b4f49392e0e6130eebef7aa45","::1","1510243598","__ci_last_regenerate|i:1510241215;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("744210c15cf0689c5549a2633a6815acafddd66d","::1","1510537636","__ci_last_regenerate|i:1510537635;"),
("550cf2a7ad17427be407bd725fbb854fcd2ebce5","::1","1510233183","__ci_last_regenerate|i:1510232888;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("0a061cb1f6d9093ae5bf9b6bcfabb758911ac996","::1","1510241200","__ci_last_regenerate|i:1510240909;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("70f14a6a8dabb3b5803bc8cd8101e2a547580323","::1","1510219079","__ci_last_regenerate|i:1510218846;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("2e58c0c6e608bbfa19cf6d7cac0ccaee1f6ba830","::1","1510218246","__ci_last_regenerate|i:1510218246;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("7804fb97d4cc088e9a3d411047a3b419c2a247b2","::1","1510218229","__ci_last_regenerate|i:1510217935;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("cea8fd5a4333b3d007339d7380d9c12291fbe4a3","::1","1510177163","__ci_last_regenerate|i:1510177011;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("dfb0cc0bc9c3189dbe8ed4acb2bde2b09c6c36f1","::1","1510176994","__ci_last_regenerate|i:1510176704;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("1f759d0cf3285cd7be31e0d1e2cd3b6fe2acd2b8","::1","1510176455","__ci_last_regenerate|i:1510176387;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("8632d35ff572fcc930a935b95295c5fbcef1b985","::1","1510176220","__ci_last_regenerate|i:1510175994;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("247cdf584941121e5f8863ae92514b954e945e17","::1","1510175873","__ci_last_regenerate|i:1510175577;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("3d3256a1cdbc1f2cf1667e17ba35bdf3e5af0adf","::1","1510173732","__ci_last_regenerate|i:1510173732;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("1872cf772405d1ecd67b5adbb4613f92cbe1ac3a","::1","1510173689","__ci_last_regenerate|i:1510173409;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("e8734b9def0675e4fbe43e9ea8553e97cbbbb7fb","::1","1510173077","__ci_last_regenerate|i:1510172777;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("2038b6fd14f319f9c0ac709da5b25965e911c798","::1","1510173406","__ci_last_regenerate|i:1510173107;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("cd793a7ef91eefc79073a70a804f8437c0457a97","::1","1510172734","__ci_last_regenerate|i:1510172449;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("0eb9bb6557bf6513d9f319b4a1716a73849da702","::1","1510172315","__ci_last_regenerate|i:1510172062;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("6f36d9b372081d75b3208eb85128d89c124c24ab","::1","1510171685","__ci_last_regenerate|i:1510171416;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("427189b94c86eb39126ac6a19961aee4041dc941","::1","1510171058","__ci_last_regenerate|i:1510170770;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("fd74e2da067583df0635d499a33350acbd377dac","::1","1510171405","__ci_last_regenerate|i:1510171107;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("ac17e28cb8876d80500735863594673ec321a551","::1","1510170760","__ci_last_regenerate|i:1510170439;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("ea7946dcb1bbf7b184d75fbb9fa18e952d5e20b8","::1","1510170273","__ci_last_regenerate|i:1510170102;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("4b4d92fcffb91b88a167fafacb87b3c79dbea382","::1","1510170073","__ci_last_regenerate|i:1510169799;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("adbf0445f32fe7b189c8560e6331220587f8cc76","::1","1510169267","__ci_last_regenerate|i:1510169005;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("fe7f91cb1ec71e67bc84ece294a28c337dcc042d","::1","1510169557","__ci_last_regenerate|i:1510169316;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("7b9c8ff5dff87ef7f195e1a308f3857c7e9b0f6e","::1","1510168894","__ci_last_regenerate|i:1510168653;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("3bd19f02bfad005a14e1b8df5f28f45d6a4a1ea2","::1","1510168545","__ci_last_regenerate|i:1510168328;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("4f9ea16be419ed1075ac1f2951790bc024e8b7fe","::1","1510172043","__ci_last_regenerate|i:1510171741;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("440c3972dcd5714c429fe6cbf13ad5bab06f6f85","::1","1510167646","__ci_last_regenerate|i:1510167341;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("d750a4105e619ac9342f69a565d3ec2ee41e8373","::1","1510167810","__ci_last_regenerate|i:1510167650;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("b1005882c6ce062373636f08feb7442096396fc9","::1","1510168314","__ci_last_regenerate|i:1510168026;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("02b79454b29d2c9cca88643e1297be2e33371b6a","::1","1514973006","__ci_last_regenerate|i:1514972781;"),
("32f2ad0d4430a1f2f7190dc2fadf4d2558f4da12","::1","1514973415","__ci_last_regenerate|i:1514973145;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("ce3ba6d4079ad759af3c4272f15d9ac2c031a50b","::1","1514974214","__ci_last_regenerate|i:1514974014;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("8220be320ab917a77e522b2fe35d44fc04c1dfd2","::1","1514974531","__ci_last_regenerate|i:1514974347;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("6537039674b74d80c37744eccee64c0ac84c774d","::1","1514975034","__ci_last_regenerate|i:1514974736;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("f9b8ef76781f134ed1b887d15e797390a859beec","::1","1514975345","__ci_last_regenerate|i:1514975047;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("1383ab855f359f314340fb7afe7f9cd151873f16","::1","1514975819","__ci_last_regenerate|i:1514975696;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("f8b1e215d1c709c8ea31ee24d2c173ba98055761","::1","1514976074","__ci_last_regenerate|i:1514976017;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("eb36f17b55953920b40018b7707c65634dd55969","::1","1514979277","__ci_last_regenerate|i:1514978982;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("3925dacb85d09d13fc3aa7cf528405df78512865","::1","1514979309","__ci_last_regenerate|i:1514979309;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("abac9f7446f2e2efb4b3688513127e22cc768960","::1","1514984102","__ci_last_regenerate|i:1514983947;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("03d9ce139636fd6b19ab0e103b191de9cacb1c4c","::1","1514984479","__ci_last_regenerate|i:1514984295;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("b023e7e36be71bddf8d4f2234ba12151c34024c1","::1","1514985798","__ci_last_regenerate|i:1514985528;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("c11a1603f3c5e38416ffbff3f7c077adef83b72f","::1","1514986245","__ci_last_regenerate|i:1514985945;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("5a977b5c5276b1de5c77340df7363415c0d266dc","::1","1514986486","__ci_last_regenerate|i:1514986261;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("4d71d5d48168748c5ebe1c6e08670818c800b52d","::1","1514986889","__ci_last_regenerate|i:1514986609;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("56db172e120a501c3236f9fdd3dedf3565aa85a3","::1","1514987324","__ci_last_regenerate|i:1514987044;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("4fd855afed31adb0c555d238ecae133bbe864985","::1","1514987561","__ci_last_regenerate|i:1514987381;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("200f8e12adafa3d27614e78a018864e51baf3941","::1","1514988083","__ci_last_regenerate|i:1514987840;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("49a6659ea3223cf55b664d37f62da961ec102418","::1","1514988367","__ci_last_regenerate|i:1514988150;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("c4f9ca05a702063644f462971a88d4ea82f2f95f","::1","1514988666","__ci_last_regenerate|i:1514988502;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("67489d17893aefd80a4fdc0d49c27d206c3d3c97","::1","1515044134","__ci_last_regenerate|i:1515043984;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("88470f1e3781d4d4eee0ab5e8b5b91a87bbcde4b","::1","1515044389","__ci_last_regenerate|i:1515044389;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("b8b91a52817301ac9388413f25007a10c665bd8b","::1","1515044753","__ci_last_regenerate|i:1515044748;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("f1ceecb2ad9b8661447118d3f6d47786ee1e002d","::1","1515045685","__ci_last_regenerate|i:1515045389;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("0c76ca3b49a1a3562d3267c3e9e3a8a31a068b10","::1","1515045872","__ci_last_regenerate|i:1515045713;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("4f8292e5d0dec1502f59b1e326519bf67a50531f","::1","1515046362","__ci_last_regenerate|i:1515046175;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("c0c4e4dac94bc003d2cb2ace794ca0f2ea2c07ab","::1","1515047036","__ci_last_regenerate|i:1515046738;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("65bd1eda3355e2d7e731b83163ba93ff68c5cd24","::1","1515047299","__ci_last_regenerate|i:1515047040;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("d0cdd683498a20db1a020155bf5695e7fa259ff0","::1","1515047580","__ci_last_regenerate|i:1515047373;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("d3783a40f116754256f5bb8a632729a698dcc2e7","::1","1515048039","__ci_last_regenerate|i:1515048033;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("7c4b3596b49b6c1fca7726213a03385aa4652799","::1","1515048504","__ci_last_regenerate|i:1515048371;"),
("91b1dced9567360210e59a7ee576a358eb8a9fd8","::1","1515049377","__ci_last_regenerate|i:1515049091;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("e1658e2bfb63de96dc1eb2a802719332bf3f837a","::1","1515049710","__ci_last_regenerate|i:1515049421;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("ff1b4fb832ace2f3a524131057fab5bc7bbf274c","::1","1515049973","__ci_last_regenerate|i:1515049741;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("51b0c3ea9e62dc287a98ea5ccb63e1faf9c24134","::1","1515050403","__ci_last_regenerate|i:1515050134;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("73ad77007709fb2a29510e6994d840d6605baa9d","::1","1515050514","__ci_last_regenerate|i:1515050458;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("462b61dd3407a7be543ba726dd5f0a56754448d2","::1","1515051199","__ci_last_regenerate|i:1515051140;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("0c3bb71d1e98f021df335f4fd73ddeba22b84af4","::1","1515052689","__ci_last_regenerate|i:1515052689;"),
("c796ac0ebb3fac788f841fa047e3f290c4707609","::1","1515053477","__ci_last_regenerate|i:1515053331;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("377520666d77e6f406f7c6abd86a7e6b3f9ce3ed","::1","1515053972","__ci_last_regenerate|i:1515053690;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("4c6e0d1216320400105ff8462341ee5feb2ed617","::1","1515054372","__ci_last_regenerate|i:1515054098;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("d13efa3d20506017f7a192ed5f0007f0dd33dafb","::1","1515054661","__ci_last_regenerate|i:1515054447;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("c2ffcd9c662abe0415ae1f764b07483524a2e1ec","::1","1515055173","__ci_last_regenerate|i:1515054964;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("9f2a6dd8ede449840e3606876491bd43f5c661dd","::1","1515055659","__ci_last_regenerate|i:1515055609;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("e4e893ab995ac5100317ec28d26e4ffc1a8e1075","::1","1515059680","__ci_last_regenerate|i:1515059675;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("cfccad7b31068056264c787272b4f2778ff83459","::1","1515059897","__ci_last_regenerate|i:1515059876;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("f169baec37e01e89e6f8a444a0d525df6c04f771","::1","1515060510","__ci_last_regenerate|i:1515060229;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("8e67a8c30cb6b4dedc97b068ec8fd085b43ce030","::1","1515060846","__ci_last_regenerate|i:1515060582;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("fe8d3bc1698a03878696885ae708cd05c96871a9","::1","1515061223","__ci_last_regenerate|i:1515060928;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("e44f40f33e8f5c612abf44c50343d92cbc84e218","::1","1515061515","__ci_last_regenerate|i:1515061237;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("ee9ba7154a1b744facdc2789fe0ef9d531fbc74a","::1","1515061838","__ci_last_regenerate|i:1515061567;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("184a8bda60a6b6c030f410ef59cef6f7efb1b270","::1","1515061920","__ci_last_regenerate|i:1515061884;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("4b66e192b78f8fd1c7cbcf7836709eed571be30c","::1","1515062496","__ci_last_regenerate|i:1515062306;sessionid|s:3:\"pos\";user_id|s:1:\"1\";user_email|s:15:\"owner@gmail.com\";user_role|s:1:\"1\";user_outlet|s:1:\"0\";"),
("75b87019118ca239656c64f817759404900d819c","::1","1515062996","__ci_last_regenerate|i:1515062703;"),
("c8e6070bc817e4696e46854791144d26c945030c","::1","1515063350","__ci_last_regenerate|i:1515063063;"),
("c4b4f37be6c44377ca36f43483b4ba74c71e6277","::1","1515063649","__ci_last_regenerate|i:1515063373;");




CREATE TABLE `currency` (
  `iso` char(3) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`iso`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO currency VALUES
("KRW","(South) Korean Won"),
("AFA","Afghanistan Afghani"),
("ALL","Albanian Lek"),
("DZD","Algerian Dinar"),
("ADP","Andorran Peseta"),
("AOK","Angolan Kwanza"),
("ARS","Argentine Peso"),
("AMD","Armenian Dram"),
("AWG","Aruban Florin"),
("AUD","Australian Dollar"),
("BSD","Bahamian Dollar"),
("BHD","Bahraini Dinar"),
("BDT","Bangladeshi Taka"),
("BBD","Barbados Dollar"),
("BZD","Belize Dollar"),
("BMD","Bermudian Dollar"),
("BTN","Bhutan Ngultrum"),
("BOB","Bolivian Boliviano"),
("BWP","Botswanian Pula"),
("BRL","Brazilian Real"),
("GBP","British Pound"),
("BND","Brunei Dollar"),
("BGN","Bulgarian Lev"),
("BUK","Burma Kyat"),
("BIF","Burundi Franc"),
("CAD","Canadian Dollar"),
("CVE","Cape Verde Escudo"),
("KYD","Cayman Islands Dollar"),
("CLP","Chilean Peso"),
("CLF","Chilean Unidades de Fomento"),
("COP","Colombian Peso"),
("XOF","Communauté Financière Africaine BCEAO - Francs"),
("XAF","Communauté Financière Africaine BEAC, Francs"),
("KMF","Comoros Franc"),
("XPF","Comptoirs Français du Pacifique Francs"),
("CRC","Costa Rican Colon"),
("CUP","Cuban Peso"),
("CYP","Cyprus Pound"),
("CZK","Czech Republic Koruna"),
("DKK","Danish Krone"),
("YDD","Democratic Yemeni Dinar"),
("DOP","Dominican Peso"),
("XCD","East Caribbean Dollar"),
("TPE","East Timor Escudo"),
("ECS","Ecuador Sucre"),
("EGP","Egyptian Pound"),
("SVC","El Salvador Colon"),
("EEK","Estonian Kroon (EEK)"),
("ETB","Ethiopian Birr"),
("EUR","Euro"),
("FKP","Falkland Islands Pound"),
("FJD","Fiji Dollar"),
("GMD","Gambian Dalasi"),
("GHC","Ghanaian Cedi"),
("GIP","Gibraltar Pound"),
("XAU","Gold, Ounces"),
("GTQ","Guatemalan Quetzal"),
("GNF","Guinea Franc"),
("GWP","Guinea-Bissau Peso"),
("GYD","Guyanan Dollar"),
("HTG","Haitian Gourde"),
("HNL","Honduran Lempira"),
("HKD","Hong Kong Dollar"),
("HUF","Hungarian Forint"),
("INR","Indian Rupee"),
("IDR","Indonesian Rupiah"),
("XDR","International Monetary Fund (IMF) Special Drawing Rights"),
("IRR","Iranian Rial"),
("IQD","Iraqi Dinar"),
("IEP","Irish Punt"),
("ILS","Israeli Shekel"),
("JMD","Jamaican Dollar"),
("JPY","Japanese Yen"),
("JOD","Jordanian Dinar"),
("KHR","Kampuchean (Cambodian) Riel"),
("KES","Kenyan Schilling"),
("KWD","Kuwaiti Dinar"),
("LAK","Lao Kip"),
("LBP","Lebanese Pound"),
("LSL","Lesotho Loti"),
("LRD","Liberian Dollar"),
("LYD","Libyan Dinar"),
("MOP","Macau Pataca"),
("MGF","Malagasy Franc"),
("MWK","Malawi Kwacha"),
("MYR","Malaysian Ringgit"),
("MVR","Maldive Rufiyaa"),
("MTL","Maltese Lira"),
("MRO","Mauritanian Ouguiya"),
("MUR","Mauritius Rupee"),
("MXP","Mexican Peso"),
("MNT","Mongolian Tugrik"),
("MAD","Moroccan Dirham"),
("MZM","Mozambique Metical"),
("NAD","Namibian Dollar"),
("NPR","Nepalese Rupee"),
("ANG","Netherlands Antillian Guilder"),
("YUD","New Yugoslavia Dinar"),
("NZD","New Zealand Dollar"),
("NIO","Nicaraguan Cordoba");
INSERT INTO currency VALUES
("NGN","Nigerian Naira"),
("KPW","North Korean Won"),
("NOK","Norwegian Kroner"),
("OMR","Omani Rial"),
("PKR","Pakistan Rupee"),
("XPD","Palladium Ounces"),
("PAB","Panamanian Balboa"),
("PGK","Papua New Guinea Kina"),
("PYG","Paraguay Guarani"),
("PEN","Peruvian Nuevo Sol"),
("PHP","Philippine Peso"),
("XPT","Platinum, Ounces"),
("PLN","Polish Zloty"),
("QAR","Qatari Rial"),
("RON","Romanian Leu"),
("RUB","Russian Ruble"),
("RWF","Rwanda Franc"),
("WST","Samoan Tala"),
("STD","Sao Tome and Principe Dobra"),
("SAR","Saudi Arabian Riyal"),
("SCR","Seychelles Rupee"),
("SLL","Sierra Leone Leone"),
("XAG","Silver, Ounces"),
("SGD","Singapore Dollar"),
("SKK","Slovak Koruna"),
("SBD","Solomon Islands Dollar"),
("SOS","Somali Schilling"),
("ZAR","South African Rand"),
("LKR","Sri Lanka Rupee"),
("SHP","St. Helena Pound"),
("SDP","Sudanese Pound"),
("SRG","Suriname Guilder"),
("SZL","Swaziland Lilangeni"),
("SEK","Swedish Krona"),
("CHF","Swiss Franc"),
("SYP","Syrian Potmd"),
("TWD","Taiwan Dollar"),
("TZS","Tanzanian Schilling"),
("THB","Thai Baht"),
("TOP","Tongan Paanga"),
("TTD","Trinidad and Tobago Dollar"),
("TND","Tunisian Dinar"),
("TRY","Turkish Lira"),
("UGX","Uganda Shilling"),
("AED","United Arab Emirates Dirham"),
("UYU","Uruguayan Peso"),
("USD","US Dollar"),
("VUV","Vanuatu Vatu"),
("VEF","Venezualan Bolivar"),
("VND","Vietnamese Dong"),
("YER","Yemeni Rial"),
("CNY","Yuan (Chinese) Renminbi"),
("ZRZ","Zaire Zaire"),
("ZMK","Zambian Kwacha"),
("ZWD","Zimbabwe Dollar");




CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO customers VALUES
("1","Walk In Customer","","","1","2016-10-18 00:00:00"),
("3","Complimentrory","email@email.com","000000000","1","2017-11-01 12:03:37"),
("4","Expired / Damaged","","","1","2017-11-02 00:45:52");




CREATE TABLE `expense_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '0: Inactive, 1: Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO expense_categories VALUES
("2","Rent","1","2017-10-28 11:04:40","0","0000-00-00 00:00:00","1");




CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expenses_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expense_category` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `outlet_name` varchar(4999) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` double(11,2) NOT NULL,
  `reason` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO expenses VALUES
("2","88787787","2","3","","2017-11-01","1000.00","test","1509644697.png","1","2017-11-02 23:14:57","0","0000-00-00 00:00:00","1");




CREATE TABLE `gift_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_number` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `value` double(11,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '0: haven''t use, 1: used',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO inventory VALUES
("4","068","3","990");




CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_code` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `product_category` int(11) NOT NULL,
  `cost` double(11,2) NOT NULL,
  `price` double(11,2) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO order_items VALUES
("2","2","8123712","jjj","12","100.00","150.00","2"),
("3","3","8123712","jjj","12","100.00","150.00","5"),
("4","4","8123712","jjj","12","100.00","150.00","5"),
("5","5","8123712","jjj","12","100.00","150.00","10"),
("45","47","068","PLAIN FLAN SLICE","24","1.00","0.00","1"),
("46","48","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("47","49","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("48","50","068","PLAIN FLAN SLICE","24","1.00","0.00","1"),
("44","46","068","PLAIN FLAN SLICE","24","1.00","0.00","1"),
("43","45","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("83","86","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("51","53","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("53","55","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("54","56","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("55","57","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("56","58","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("57","59","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("58","60","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("59","61","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("60","62","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("61","63","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("70","73","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("69","72","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("81","84","068","PLAIN FLAN SLICE","24","1.00","1000.00","1"),
("82","85","068","PLAIN FLAN SLICE","24","1.00","1000.00","1");




CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `customer_mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordered_datetime` datetime NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `outlet_name` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `outlet_address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `outlet_contact` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `outlet_receipt_footer` longtext COLLATE utf8_unicode_ci NOT NULL,
  `gift_card` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` double(11,2) NOT NULL,
  `discount_total` double(11,2) NOT NULL,
  `discount_percentage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax` double(11,2) NOT NULL,
  `grandtotal` double(11,2) NOT NULL,
  `total_items` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `payment_method_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cheque_number` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `paid_amt` double(11,2) NOT NULL,
  `advance` int(1) NOT NULL,
  `adv_payment_method` int(11) NOT NULL,
  `adv_payment_method_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adv_card_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `adv_cheque_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adv_paid_amt` double(11,2) NOT NULL,
  `adv_ordered_datetime` datetime NOT NULL,
  `return_change` double(11,2) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `vt_status` int(11) NOT NULL COMMENT '0: Debit Payment, 1: Completed',
  `status` int(11) NOT NULL COMMENT '1: Sales, 2: Return',
  `refund_status` int(11) NOT NULL COMMENT '1: Full Refund, 2: Partial Refund',
  `remark` longtext COLLATE utf8_unicode_ci NOT NULL,
  `card_number` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO orders VALUES
("56","1","Walk In Customer","","","2017-11-03 23:51:02","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","2","Wire Transfer","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-03 23:51:02","0","0000-00-00 00:00:00","1","1","0","",""),
("55","1","Walk In Customer","","","2017-11-03 23:48:14","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","4","Card","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-03 23:48:14","1","2017-11-08 00:52:41","1","1","0","","9898"),
("45","1","Walk In Customer","","","2017-11-02 01:17:59","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","1","Cash","","2000.00","0","0","","","","0.00","0000-00-00 00:00:00","1000.00","1","2017-11-02 01:17:59","0","0000-00-00 00:00:00","1","1","0","",""),
("53","1","Walk In Customer","","","2017-11-03 23:16:17","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","1","Cash","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-03 23:16:17","1","2017-11-03 23:19:12","1","1","0","",""),
("49","1","Walk In Customer","","","2017-11-03 00:30:09","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","1","Cash","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-03 00:30:09","0","0000-00-00 00:00:00","1","1","0","",""),
("50","3","Complimentrory","email@email.com","000000000","2017-11-03 00:30:36","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","0.00","0.00","","0.00","0.00","1","0","","","0.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-03 00:30:36","0","0000-00-00 00:00:00","1","1","0","","coooo"),
("48","1","Walk In Customer","","","2017-11-02 01:21:06","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","2","Wire Transfer","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-02 01:21:06","0","0000-00-00 00:00:00","1","1","0","",""),
("47","4","Expired / Damaged","","","2017-11-02 01:19:58","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","0.00","0.00","","0.00","0.00","1","0","","","0.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-02 01:19:58","0","0000-00-00 00:00:00","1","1","0","","damaged"),
("46","3","Complimentrory","email@email.com","000000000","2017-11-02 01:18:55","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","0.00","0.00","","0.00","0.00","1","0","","","0.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-02 01:18:55","0","0000-00-00 00:00:00","1","1","0","","free as friend"),
("57","1","Walk In Customer","","","2017-11-03 23:57:00","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","4","Card","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-03 23:57:00","1","2017-11-04 00:04:59","1","1","0","","9898"),
("58","1","Walk In Customer","","","2017-11-03 23:58:41","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","1","Cash","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-03 23:58:41","1","2017-11-04 00:00:44","1","1","0","",""),
("59","1","Walk In Customer","","","2017-11-04 00:02:00","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","4","Card","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-04 00:02:00","1","2017-11-04 00:02:43","1","1","0","","123"),
("60","1","Walk In Customer","","","2017-11-06 23:23:56","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","4","Card","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-06 23:23:56","1","2017-11-06 23:27:21","1","1","0","","asfsgfs"),
("61","1","Walk In Customer","","","2017-11-06 23:28:43","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","1","Cash","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-06 23:28:43","0","0000-00-00 00:00:00","1","1","0","",""),
("62","1","Walk In Customer","","","2017-11-07 00:23:05","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","4","Card","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-07 00:23:05","0","0000-00-00 00:00:00","1","1","0","","1111"),
("63","1","Walk In Customer","","","2017-11-07 23:55:03","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","1","Cash","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-07 23:55:03","0","0000-00-00 00:00:00","1","1","0","","1000 paid"),
("73","1","Walk In Customer","","","2017-11-08 21:38:23","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","1","Cash","","400.00","1","4","Card","Paid 600 Cash","","600.00","0000-00-00 00:00:00","-600.00","1","2017-11-08 21:38:23","1","2017-11-08 21:39:25","1","1","0","","Paid 400"),
("72","1","Walk In Customer","","","2017-11-07 20:42:53","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","4","Card","","300.00","1","1","Cash","","","700.00","0000-00-00 00:00:00","-700.00","1","2017-11-08 20:42:53","1","2017-11-08 20:54:52","1","1","0","","23424"),
("84","1","Walk In Customer","","","2017-11-09 20:53:02","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","1","Cash","","1000.00","0","0","","","","0.00","0000-00-00 00:00:00","0.00","1","2017-11-09 20:53:02","0","0000-00-00 00:00:00","1","1","0","",""),
("85","1","Walk In Customer","","","2017-11-09 20:55:53","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","5","Cheque","878977","200.00","1","5","Cheque","","786876","800.00","2017-11-09 20:56:55","-800.00","1","2017-11-09 20:55:53","1","2017-11-09 20:56:55","1","1","0","",""),
("86","1","Walk In Customer","","","2017-11-07 20:58:06","3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","","1000.00","0.00","","0.00","1000.00","1","1","Cash","","100.00","1","2","Wire Transfer","","","900.00","2017-11-09 21:01:01","-900.00","1","2017-11-09 20:58:06","1","2017-11-09 21:01:01","1","1","0","","");




CREATE TABLE `outlets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `receipt_header` longtext COLLATE utf8_unicode_ci NOT NULL,
  `receipt_footer` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '1: Active, 0: Inactive',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO outlets VALUES
("3","Le Delice - The French Bakery","Boulevard Road, Opp. Ghat No.9, Srinagar, J&K INDIA - 190001","+91-9596 588 211","","<p><em>Boulevard Road, Opp. Ghat No.9, Srinagar, J&amp;K INDIA - 190001</em></p><p><em>Contact :</em><strong><em>&nbsp;+91-9596 588 211</em></strong></p><p>Thank you for your Vist !</p>","1","2016-09-11 19:25:52","1","2017-10-30 10:30:42","1"),
("6","Test1","Addres 2","Test2","","<p>Address 2</p>","1","2018-01-03 15:26:53","0","0000-00-00 00:00:00","1"),
("7","t","t","t","","<p>t</p>","1","2018-01-04 15:39:50","0","0000-00-00 00:00:00","1");




CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO payment_method VALUES
("1","Cash","1","2016-09-25 01:43:41","0","0000-00-00 00:00:00","1"),
("2","Wire Transfer","1","2016-09-25 01:43:45","1","2017-10-29 20:20:03","1"),
("3","VISA","1","2016-09-25 01:43:50","1","2017-10-30 11:22:11","0"),
("4","Card","1","2016-09-25 01:43:58","1","2017-10-29 19:41:09","1"),
("5","Cheque","1","2016-09-25 01:44:02","1","2017-10-29 19:51:15","1"),
("7","Gift Card","1","2016-10-16 01:23:05","1","2017-10-28 19:15:24","0");




CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `purchase_price` double(11,2) NOT NULL,
  `retail_price` double(11,2) NOT NULL,
  `thumbnail` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `color` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO products VALUES
("18","001","CHOCOLATE MOUSSE PASTRY","13","1.00","1.00","no_image.jpg","1","2017-10-30 16:11:59","0","0000-00-00 00:00:00","1",""),
("19","002","PINE APPLE PASTRY","13","1.00","1.00","no_image.jpg","1","2017-10-30 16:12:19","0","0000-00-00 00:00:00","1",""),
("20","003","MIXED FRUIT PASTRY","13","1.00","1.00","no_image.jpg","1","2017-10-30 16:12:52","0","0000-00-00 00:00:00","1",""),
("21","004","BLACK FOREST PASTRY","13","1.00","1.00","no_image.jpg","1","2017-10-30 16:13:13","0","0000-00-00 00:00:00","1",""),
("22","005","RASBERRY CHOCO PASTRY","13","1.00","1.00","no_image.jpg","1","2017-10-30 16:13:38","0","0000-00-00 00:00:00","1",""),
("23","006","RASBERRY PASTRY","13","1.00","1.00","no_image.jpg","1","2017-10-30 16:13:53","0","0000-00-00 00:00:00","1",""),
("24","007","SEASONAL PASTRY","13","1.00","1.00","no_image.jpg","1","2017-10-30 16:14:06","0","0000-00-00 00:00:00","1",""),
("25","008","SEASONAL PASTRY","13","1.00","1.00","no_image.jpg","1","2017-10-30 16:14:18","0","0000-00-00 00:00:00","1",""),
("26","009","SPECIAL PASTRY","13","1.00","1.00","no_image.jpg","1","2017-10-30 16:14:35","0","0000-00-00 00:00:00","1",""),
("27","010","SPECIAL PASTRY","13","1.00","1.00","no_image.jpg","1","2017-10-30 16:14:54","0","0000-00-00 00:00:00","1",""),
("28","012","PARIS BREST","14","1.00","1.00","no_image.jpg","1","2017-10-30 16:15:32","0","0000-00-00 00:00:00","1",""),
("29","013","CHOUX VANILLA","14","1.00","1.00","no_image.jpg","1","2017-10-30 16:15:46","0","0000-00-00 00:00:00","1",""),
("30","014","CHOUX CHOCOLAT","14","1.00","1.00","no_image.jpg","1","2017-10-30 16:16:00","0","0000-00-00 00:00:00","1",""),
("31","015","CHOUX SPECIAL","14","1.00","1.00","no_image.jpg","1","2017-10-30 16:16:13","0","0000-00-00 00:00:00","1",""),
("32","016","ECLAIR CHOCO","14","1.00","1.00","no_image.jpg","1","2017-10-30 16:16:25","0","0000-00-00 00:00:00","1",""),
("33","017","ECLAIR COFFEE","14","1.00","1.00","no_image.jpg","1","2017-10-30 16:16:49","0","0000-00-00 00:00:00","1",""),
("34","018","ECLAIR SPECIAL","14","1.00","1.00","no_image.jpg","1","2017-10-30 16:19:07","0","0000-00-00 00:00:00","1",""),
("35","019","ECLAIR SPECIAL","14","1.00","1.00","no_image.jpg","1","2017-10-30 16:19:32","0","0000-00-00 00:00:00","1",""),
("36","020","WALNUT TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:19:58","0","0000-00-00 00:00:00","1",""),
("37","021","CHOCO CHIPS TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:20:14","0","0000-00-00 00:00:00","1",""),
("38","022","CHOCO CHIPS TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:20:35","0","0000-00-00 00:00:00","1",""),
("39","023","PECANNUT TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:20:52","0","0000-00-00 00:00:00","1",""),
("40","024","CARAMEL TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:21:07","0","0000-00-00 00:00:00","1",""),
("41","025","LEMON TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:21:39","0","0000-00-00 00:00:00","1",""),
("42","026","APPLE TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:21:56","0","0000-00-00 00:00:00","1",""),
("43","027","PEAR TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:22:11","0","0000-00-00 00:00:00","1",""),
("44","028","APPLE TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:22:27","0","0000-00-00 00:00:00","1",""),
("45","029","MIXED FRUIT TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:22:42","0","0000-00-00 00:00:00","1",""),
("46","030","SEASONAL FRUIT TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:23:02","0","0000-00-00 00:00:00","1",""),
("47","031","SEASONAL FRUIT TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:23:27","0","0000-00-00 00:00:00","1",""),
("48","032","SPECIAL TART","16","1.00","1.00","no_image.jpg","1","2017-10-30 16:23:45","0","0000-00-00 00:00:00","1",""),
("49","033","CHOCO MOUSSE CUPS","18","1.00","1.00","no_image.jpg","1","2017-10-30 16:24:09","0","0000-00-00 00:00:00","1",""),
("50","034","RASBERRY MIXED FRUIT CUPS","18","1.00","1.00","no_image.jpg","1","2017-10-30 16:25:59","0","0000-00-00 00:00:00","1",""),
("51","035","SPECIAL FRUIT CUPS","18","1.00","1.00","no_image.jpg","1","2017-10-30 16:26:17","0","0000-00-00 00:00:00","1",""),
("52","036","POUND CAKE","19","1.00","1.00","no_image.jpg","1","2017-10-30 16:26:54","0","0000-00-00 00:00:00","1",""),
("53","037","BUTTER CAKE","19","1.00","1.00","no_image.jpg","1","2017-10-30 16:28:06","0","0000-00-00 00:00:00","1",""),
("54","038","CHOCOLATE CAKE","19","1.00","1.00","no_image.jpg","1","2017-10-30 16:28:53","0","0000-00-00 00:00:00","1",""),
("55","039","ALMOND CAKE","19","1.00","1.00","no_image.jpg","1","2017-10-30 16:29:31","0","0000-00-00 00:00:00","1",""),
("56","040","LEMON CAKE","19","1.00","1.00","no_image.jpg","1","2017-10-30 16:29:53","0","0000-00-00 00:00:00","1",""),
("57","041","MIXED FRUIT CAKE","19","1.00","1.00","no_image.jpg","1","2017-10-30 16:30:08","0","0000-00-00 00:00:00","1",""),
("58","042","COFFEE CAKE","19","1.00","1.00","no_image.jpg","1","2017-10-30 16:30:36","0","0000-00-00 00:00:00","1",""),
("59","043","SPECIAL POUND CAKE","19","1.00","1.00","no_image.jpg","1","2017-10-30 16:30:57","0","0000-00-00 00:00:00","1",""),
("60","044","DONUT - 80","20","1.00","1.00","no_image.jpg","1","2017-10-30 16:31:36","0","0000-00-00 00:00:00","1",""),
("61","045","DONUT","20","1.00","1.00","no_image.jpg","1","2017-10-30 16:31:50","0","0000-00-00 00:00:00","1",""),
("62","056","BAGUETTE","21","1.00","1.00","no_image.jpg","1","2017-10-30 16:32:35","0","0000-00-00 00:00:00","1",""),
("63","047","POPY MILK BREAD","21","1.00","1.00","no_image.jpg","1","2017-10-30 16:33:05","0","0000-00-00 00:00:00","1",""),
("64","048","OATS MILK BREAD","21","1.00","1.00","no_image.jpg","1","2017-10-30 16:33:47","0","0000-00-00 00:00:00","1",""),
("65","049","LOAF","21","1.00","1.00","no_image.jpg","1","2017-10-30 16:34:19","0","0000-00-00 00:00:00","1",""),
("66","050","CHOCO LOAF","21","1.00","1.00","no_image.jpg","1","2017-10-30 16:34:38","0","0000-00-00 00:00:00","1",""),
("67","051","BROWN BREAD","21","1.00","1.00","no_image.jpg","1","2017-10-30 16:34:53","0","0000-00-00 00:00:00","1",""),
("68","052","SPECIAL BREAD","21","1.00","1.00","no_image.jpg","1","2017-10-30 16:35:15","0","0000-00-00 00:00:00","1",""),
("69","053","PLAIN CROISSANT","22","1.00","1.00","no_image.jpg","1","2017-10-30 16:35:35","0","0000-00-00 00:00:00","1",""),
("70","054","CHOCOLATE CROISSANT","22","1.00","1.00","no_image.jpg","1","2017-10-30 16:35:52","0","0000-00-00 00:00:00","1",""),
("71","055","ALMOND CROISSANT","22","1.00","1.00","no_image.jpg","1","2017-10-30 16:36:17","0","0000-00-00 00:00:00","1",""),
("72","057","ALMOND COOKIES","23","1.00","1.00","no_image.jpg","1","2017-10-30 16:36:54","0","0000-00-00 00:00:00","1",""),
("73","058","ALMOND ORANGE COOKIES","23","1.00","1.00","no_image.jpg","1","2017-10-30 16:37:10","0","0000-00-00 00:00:00","1",""),
("74","059","HAZELNUT CHOCO CHIPS COOKIES","23","1.00","1.00","no_image.jpg","1","2017-10-30 16:37:25","0","0000-00-00 00:00:00","1",""),
("75","060","OATS COOKIES","23","1.00","1.00","no_image.jpg","1","2017-10-30 16:37:55","0","0000-00-00 00:00:00","1",""),
("76","061","CHOCO CHIPS COOKIES","23","1.00","1.00","no_image.jpg","1","2017-10-30 16:38:17","0","0000-00-00 00:00:00","1",""),
("77","062","COFFEE COOKIES","23","1.00","1.00","no_image.jpg","1","2017-10-30 16:38:41","0","0000-00-00 00:00:00","1",""),
("78","063","BUTTER COOKIES","23","1.00","1.00","no_image.jpg","1","2017-10-30 16:38:57","0","0000-00-00 00:00:00","1",""),
("79","064","COCONUT COOKIES","23","1.00","1.00","no_image.jpg","1","2017-10-30 16:39:28","0","0000-00-00 00:00:00","1",""),
("80","065","CONGOLAIS","23","1.00","1.00","no_image.jpg","1","2017-10-30 16:40:24","0","0000-00-00 00:00:00","1",""),
("81","066","FRENCH HEART","23","1.00","1.00","no_image.jpg","1","2017-10-30 16:40:39","0","0000-00-00 00:00:00","1",""),
("82","067","SPECIAL COOKIES","23","1.00","1.00","no_image.jpg","1","2017-10-30 16:41:06","0","0000-00-00 00:00:00","1",""),
("83","068","PLAIN FLAN SLICE","24","1.00","1000.00","no_image.jpg","1","2017-10-30 16:41:35","1","2017-11-06 23:17:23","1","00FF04"),
("84","fareed","fareed ","19","100.00","100.00","fareed.png","1","2017-11-03 23:24:00","1","2017-11-06 22:37:35","1","green"),
("85","Pink","Pink","24","100.00","100.00","Pink.png","1","2017-11-06 22:49:05","1","2017-11-06 23:16:22","1","FF1616");




CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_number` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `discount_amount` double(11,2) NOT NULL,
  `discount_percentage` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `subTotal` double(11,2) NOT NULL,
  `tax` double(11,2) NOT NULL,
  `grandTotal` double(11,2) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `supplier_tax` double(11,2) NOT NULL,
  `supplier_name` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_email` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `supplier_tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_fax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `outlet_name` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `outlet_address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `outlet_contact` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `po_date` date NOT NULL,
  `attachment_file` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `received_user_id` int(11) NOT NULL,
  `received_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `purchase_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) NOT NULL,
  `product_code` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `ordered_qty` int(11) NOT NULL,
  `received_qty` int(11) NOT NULL,
  `cost` double(11,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `purchase_order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO purchase_order_status VALUES
("1","Created","1","2016-09-10 00:00:00","0","0000-00-00 00:00:00","1"),
("2","Sent To Supplier","1","2016-09-10 00:00:00","0","0000-00-00 00:00:00","1"),
("3","Received From Supplier","1","2016-09-10 00:00:00","0","0000-00-00 00:00:00","1");




CREATE TABLE `return_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_code` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `price` double(11,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `item_condition` int(11) NOT NULL COMMENT '1: Good, 2: Not Good',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `site_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `site_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `pagination` int(11) NOT NULL,
  `tax` double(11,2) NOT NULL,
  `currency` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `datetime_format` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `display_product` int(11) NOT NULL,
  `display_keyboard` int(11) NOT NULL,
  `default_customer_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO site_setting VALUES
("1","Le Delice - The French Bakery","logo.jpg","Asia/Kolkata","10","0.00","INR","d-m-Y","1","1","1","1","2017-10-30 16:43:29");




CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(4999) COLLATE utf8_unicode_ci NOT NULL,
  `tax` double(11,2) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `suspend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `fullname` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ref_number` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `subtotal` double(11,2) NOT NULL,
  `discount_total` double(11,2) NOT NULL,
  `tax` double(11,2) NOT NULL,
  `grandtotal` double(11,2) NOT NULL,
  `total_items` int(11) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO suspend VALUES
("1","1","Walk In Customer","","","888","1","0.00","0.00","0.00","0.00","0","1","2017-10-27 16:43:20","1","2017-10-27 21:01:02","1");




CREATE TABLE `suspend_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suspend_id` int(11) NOT NULL,
  `product_code` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_cost` double(11,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `product_price` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `timezones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=422 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO timezones VALUES
("1","AD","Europe/Andorra"),
("2","AE","Asia/Dubai"),
("3","AF","Asia/Kabul"),
("4","AG","America/Antigua"),
("5","AI","America/Anguilla"),
("6","AL","Europe/Tirane"),
("7","AM","Asia/Yerevan"),
("8","AO","Africa/Luanda"),
("9","AQ","Antarctica/McMurdo"),
("10","AQ","Antarctica/Casey"),
("11","AQ","Antarctica/Davis"),
("12","AQ","Antarctica/DumontDUrville"),
("13","AQ","Antarctica/Mawson"),
("14","AQ","Antarctica/Palmer"),
("15","AQ","Antarctica/Rothera"),
("16","AQ","Antarctica/Syowa"),
("17","AQ","Antarctica/Troll"),
("18","AQ","Antarctica/Vostok"),
("19","AR","America/Argentina/Buenos_Aires"),
("20","AR","America/Argentina/Cordoba"),
("21","AR","America/Argentina/Salta"),
("22","AR","America/Argentina/Jujuy"),
("23","AR","America/Argentina/Tucuman"),
("24","AR","America/Argentina/Catamarca"),
("25","AR","America/Argentina/La_Rioja"),
("26","AR","America/Argentina/San_Juan"),
("27","AR","America/Argentina/Mendoza"),
("28","AR","America/Argentina/San_Luis"),
("29","AR","America/Argentina/Rio_Gallegos"),
("30","AR","America/Argentina/Ushuaia"),
("31","AS","Pacific/Pago_Pago"),
("32","AT","Europe/Vienna"),
("33","AU","Australia/Lord_Howe"),
("34","AU","Antarctica/Macquarie"),
("35","AU","Australia/Hobart"),
("36","AU","Australia/Currie"),
("37","AU","Australia/Melbourne"),
("38","AU","Australia/Sydney"),
("39","AU","Australia/Broken_Hill"),
("40","AU","Australia/Brisbane"),
("41","AU","Australia/Lindeman"),
("42","AU","Australia/Adelaide"),
("43","AU","Australia/Darwin"),
("44","AU","Australia/Perth"),
("45","AU","Australia/Eucla"),
("46","AW","America/Aruba"),
("47","AX","Europe/Mariehamn"),
("48","AZ","Asia/Baku"),
("49","BA","Europe/Sarajevo"),
("50","BB","America/Barbados"),
("51","BD","Asia/Dhaka"),
("52","BE","Europe/Brussels"),
("53","BF","Africa/Ouagadougou"),
("54","BG","Europe/Sofia"),
("55","BH","Asia/Bahrain"),
("56","BI","Africa/Bujumbura"),
("57","BJ","Africa/Porto-Novo"),
("58","BL","America/St_Barthelemy"),
("59","BM","Atlantic/Bermuda"),
("60","BN","Asia/Brunei"),
("61","BO","America/La_Paz"),
("62","BQ","America/Kralendijk"),
("63","BR","America/Noronha"),
("64","BR","America/Belem"),
("65","BR","America/Fortaleza"),
("66","BR","America/Recife"),
("67","BR","America/Araguaina"),
("68","BR","America/Maceio"),
("69","BR","America/Bahia"),
("70","BR","America/Sao_Paulo"),
("71","BR","America/Campo_Grande"),
("72","BR","America/Cuiaba"),
("73","BR","America/Santarem"),
("74","BR","America/Porto_Velho"),
("75","BR","America/Boa_Vista"),
("76","BR","America/Manaus"),
("77","BR","America/Eirunepe"),
("78","BR","America/Rio_Branco"),
("79","BS","America/Nassau"),
("80","BT","Asia/Thimphu"),
("81","BW","Africa/Gaborone"),
("82","BY","Europe/Minsk"),
("83","BZ","America/Belize"),
("84","CA","America/St_Johns"),
("85","CA","America/Halifax"),
("86","CA","America/Glace_Bay"),
("87","CA","America/Moncton"),
("88","CA","America/Goose_Bay"),
("89","CA","America/Blanc-Sablon"),
("90","CA","America/Toronto"),
("91","CA","America/Nipigon"),
("92","CA","America/Thunder_Bay"),
("93","CA","America/Iqaluit"),
("94","CA","America/Pangnirtung"),
("95","CA","America/Atikokan"),
("96","CA","America/Winnipeg"),
("97","CA","America/Rainy_River"),
("98","CA","America/Resolute"),
("99","CA","America/Rankin_Inlet"),
("100","CA","America/Regina");
INSERT INTO timezones VALUES
("101","CA","America/Swift_Current"),
("102","CA","America/Edmonton"),
("103","CA","America/Cambridge_Bay"),
("104","CA","America/Yellowknife"),
("105","CA","America/Inuvik"),
("106","CA","America/Creston"),
("107","CA","America/Dawson_Creek"),
("108","CA","America/Fort_Nelson"),
("109","CA","America/Vancouver"),
("110","CA","America/Whitehorse"),
("111","CA","America/Dawson"),
("112","CC","Indian/Cocos"),
("113","CD","Africa/Kinshasa"),
("114","CD","Africa/Lubumbashi"),
("115","CF","Africa/Bangui"),
("116","CG","Africa/Brazzaville"),
("117","CH","Europe/Zurich"),
("118","CI","Africa/Abidjan"),
("119","CK","Pacific/Rarotonga"),
("120","CL","America/Santiago"),
("121","CL","Pacific/Easter"),
("122","CM","Africa/Douala"),
("123","CN","Asia/Shanghai"),
("124","CN","Asia/Urumqi"),
("125","CO","America/Bogota"),
("126","CR","America/Costa_Rica"),
("127","CU","America/Havana"),
("128","CV","Atlantic/Cape_Verde"),
("129","CW","America/Curacao"),
("130","CX","Indian/Christmas"),
("131","CY","Asia/Nicosia"),
("132","CZ","Europe/Prague"),
("133","DE","Europe/Berlin"),
("134","DE","Europe/Busingen"),
("135","DJ","Africa/Djibouti"),
("136","DK","Europe/Copenhagen"),
("137","DM","America/Dominica"),
("138","DO","America/Santo_Domingo"),
("139","DZ","Africa/Algiers"),
("140","EC","America/Guayaquil"),
("141","EC","Pacific/Galapagos"),
("142","EE","Europe/Tallinn"),
("143","EG","Africa/Cairo"),
("144","EH","Africa/El_Aaiun"),
("145","ER","Africa/Asmara"),
("146","ES","Europe/Madrid"),
("147","ES","Africa/Ceuta"),
("148","ES","Atlantic/Canary"),
("149","ET","Africa/Addis_Ababa"),
("150","FI","Europe/Helsinki"),
("151","FJ","Pacific/Fiji"),
("152","FK","Atlantic/Stanley"),
("153","FM","Pacific/Chuuk"),
("154","FM","Pacific/Pohnpei"),
("155","FM","Pacific/Kosrae"),
("156","FO","Atlantic/Faroe"),
("157","FR","Europe/Paris"),
("158","GA","Africa/Libreville"),
("159","GB","Europe/London"),
("160","GD","America/Grenada"),
("161","GE","Asia/Tbilisi"),
("162","GF","America/Cayenne"),
("163","GG","Europe/Guernsey"),
("164","GH","Africa/Accra"),
("165","GI","Europe/Gibraltar"),
("166","GL","America/Godthab"),
("167","GL","America/Danmarkshavn"),
("168","GL","America/Scoresbysund"),
("169","GL","America/Thule"),
("170","GM","Africa/Banjul"),
("171","GN","Africa/Conakry"),
("172","GP","America/Guadeloupe"),
("173","GQ","Africa/Malabo"),
("174","GR","Europe/Athens"),
("175","GS","Atlantic/South_Georgia"),
("176","GT","America/Guatemala"),
("177","GU","Pacific/Guam"),
("178","GW","Africa/Bissau"),
("179","GY","America/Guyana"),
("180","HK","Asia/Hong_Kong"),
("181","HN","America/Tegucigalpa"),
("182","HR","Europe/Zagreb"),
("183","HT","America/Port-au-Prince"),
("184","HU","Europe/Budapest"),
("185","ID","Asia/Jakarta"),
("186","ID","Asia/Pontianak"),
("187","ID","Asia/Makassar"),
("188","ID","Asia/Jayapura"),
("189","IE","Europe/Dublin"),
("190","IL","Asia/Jerusalem"),
("191","IM","Europe/Isle_of_Man"),
("192","IN","Asia/Kolkata"),
("193","IO","Indian/Chagos"),
("194","IQ","Asia/Baghdad"),
("195","IR","Asia/Tehran"),
("196","IS","Atlantic/Reykjavik"),
("197","IT","Europe/Rome"),
("198","JE","Europe/Jersey"),
("199","JM","America/Jamaica"),
("200","JO","Asia/Amman");
INSERT INTO timezones VALUES
("201","JP","Asia/Tokyo"),
("202","KE","Africa/Nairobi"),
("203","KG","Asia/Bishkek"),
("204","KH","Asia/Phnom_Penh"),
("205","KI","Pacific/Tarawa"),
("206","KI","Pacific/Enderbury"),
("207","KI","Pacific/Kiritimati"),
("208","KM","Indian/Comoro"),
("209","KN","America/St_Kitts"),
("210","KP","Asia/Pyongyang"),
("211","KR","Asia/Seoul"),
("212","KW","Asia/Kuwait"),
("213","KY","America/Cayman"),
("214","KZ","Asia/Almaty"),
("215","KZ","Asia/Qyzylorda"),
("216","KZ","Asia/Aqtobe"),
("217","KZ","Asia/Aqtau"),
("218","KZ","Asia/Oral"),
("219","LA","Asia/Vientiane"),
("220","LB","Asia/Beirut"),
("221","LC","America/St_Lucia"),
("222","LI","Europe/Vaduz"),
("223","LK","Asia/Colombo"),
("224","LR","Africa/Monrovia"),
("225","LS","Africa/Maseru"),
("226","LT","Europe/Vilnius"),
("227","LU","Europe/Luxembourg"),
("228","LV","Europe/Riga"),
("229","LY","Africa/Tripoli"),
("230","MA","Africa/Casablanca"),
("231","MC","Europe/Monaco"),
("232","MD","Europe/Chisinau"),
("233","ME","Europe/Podgorica"),
("234","MF","America/Marigot"),
("235","MG","Indian/Antananarivo"),
("236","MH","Pacific/Majuro"),
("237","MH","Pacific/Kwajalein"),
("238","MK","Europe/Skopje"),
("239","ML","Africa/Bamako"),
("240","MM","Asia/Rangoon"),
("241","MN","Asia/Ulaanbaatar"),
("242","MN","Asia/Hovd"),
("243","MN","Asia/Choibalsan"),
("244","MO","Asia/Macau"),
("245","MP","Pacific/Saipan"),
("246","MQ","America/Martinique"),
("247","MR","Africa/Nouakchott"),
("248","MS","America/Montserrat"),
("249","MT","Europe/Malta"),
("250","MU","Indian/Mauritius"),
("251","MV","Indian/Maldives"),
("252","MW","Africa/Blantyre"),
("253","MX","America/Mexico_City"),
("254","MX","America/Cancun"),
("255","MX","America/Merida"),
("256","MX","America/Monterrey"),
("257","MX","America/Matamoros"),
("258","MX","America/Mazatlan"),
("259","MX","America/Chihuahua"),
("260","MX","America/Ojinaga"),
("261","MX","America/Hermosillo"),
("262","MX","America/Tijuana"),
("263","MX","America/Bahia_Banderas"),
("264","MY","Asia/Kuala_Lumpur"),
("265","MY","Asia/Kuching"),
("266","MZ","Africa/Maputo"),
("267","NA","Africa/Windhoek"),
("268","NC","Pacific/Noumea"),
("269","NE","Africa/Niamey"),
("270","NF","Pacific/Norfolk"),
("271","NG","Africa/Lagos"),
("272","NI","America/Managua"),
("273","NL","Europe/Amsterdam"),
("274","NO","Europe/Oslo"),
("275","NP","Asia/Kathmandu"),
("276","NR","Pacific/Nauru"),
("277","NU","Pacific/Niue"),
("278","NZ","Pacific/Auckland"),
("279","NZ","Pacific/Chatham"),
("280","OM","Asia/Muscat"),
("281","PA","America/Panama"),
("282","PE","America/Lima"),
("283","PF","Pacific/Tahiti"),
("284","PF","Pacific/Marquesas"),
("285","PF","Pacific/Gambier"),
("286","PG","Pacific/Port_Moresby"),
("287","PG","Pacific/Bougainville"),
("288","PH","Asia/Manila"),
("289","PK","Asia/Karachi"),
("290","PL","Europe/Warsaw"),
("291","PM","America/Miquelon"),
("292","PN","Pacific/Pitcairn"),
("293","PR","America/Puerto_Rico"),
("294","PS","Asia/Gaza"),
("295","PS","Asia/Hebron"),
("296","PT","Europe/Lisbon"),
("297","PT","Atlantic/Madeira"),
("298","PT","Atlantic/Azores"),
("299","PW","Pacific/Palau"),
("300","PY","America/Asuncion");
INSERT INTO timezones VALUES
("301","QA","Asia/Qatar"),
("302","RE","Indian/Reunion"),
("303","RO","Europe/Bucharest"),
("304","RS","Europe/Belgrade"),
("305","RU","Europe/Kaliningrad"),
("306","RU","Europe/Moscow"),
("307","RU","Europe/Simferopol"),
("308","RU","Europe/Volgograd"),
("309","RU","Europe/Kirov"),
("310","RU","Europe/Astrakhan"),
("311","RU","Europe/Samara"),
("312","RU","Europe/Ulyanovsk"),
("313","RU","Asia/Yekaterinburg"),
("314","RU","Asia/Omsk"),
("315","RU","Asia/Novosibirsk"),
("316","RU","Asia/Barnaul"),
("317","RU","Asia/Tomsk"),
("318","RU","Asia/Novokuznetsk"),
("319","RU","Asia/Krasnoyarsk"),
("320","RU","Asia/Irkutsk"),
("321","RU","Asia/Chita"),
("322","RU","Asia/Yakutsk"),
("323","RU","Asia/Khandyga"),
("324","RU","Asia/Vladivostok"),
("325","RU","Asia/Ust-Nera"),
("326","RU","Asia/Magadan"),
("327","RU","Asia/Sakhalin"),
("328","RU","Asia/Srednekolymsk"),
("329","RU","Asia/Kamchatka"),
("330","RU","Asia/Anadyr"),
("331","RW","Africa/Kigali"),
("332","SA","Asia/Riyadh"),
("333","SB","Pacific/Guadalcanal"),
("334","SC","Indian/Mahe"),
("335","SD","Africa/Khartoum"),
("336","SE","Europe/Stockholm"),
("337","SG","Asia/Singapore"),
("338","SH","Atlantic/St_Helena"),
("339","SI","Europe/Ljubljana"),
("340","SJ","Arctic/Longyearbyen"),
("341","SK","Europe/Bratislava"),
("342","SL","Africa/Freetown"),
("343","SM","Europe/San_Marino"),
("344","SN","Africa/Dakar"),
("345","SO","Africa/Mogadishu"),
("346","SR","America/Paramaribo"),
("347","SS","Africa/Juba"),
("348","ST","Africa/Sao_Tome"),
("349","SV","America/El_Salvador"),
("350","SX","America/Lower_Princes"),
("351","SY","Asia/Damascus"),
("352","SZ","Africa/Mbabane"),
("353","TC","America/Grand_Turk"),
("354","TD","Africa/Ndjamena"),
("355","TF","Indian/Kerguelen"),
("356","TG","Africa/Lome"),
("357","TH","Asia/Bangkok"),
("358","TJ","Asia/Dushanbe"),
("359","TK","Pacific/Fakaofo"),
("360","TL","Asia/Dili"),
("361","TM","Asia/Ashgabat"),
("362","TN","Africa/Tunis"),
("363","TO","Pacific/Tongatapu"),
("364","TR","Europe/Istanbul"),
("365","TT","America/Port_of_Spain"),
("366","TV","Pacific/Funafuti"),
("367","TW","Asia/Taipei"),
("368","TZ","Africa/Dar_es_Salaam"),
("369","UA","Europe/Kiev"),
("370","UA","Europe/Uzhgorod"),
("371","UA","Europe/Zaporozhye"),
("372","UG","Africa/Kampala"),
("373","UM","Pacific/Johnston"),
("374","UM","Pacific/Midway"),
("375","UM","Pacific/Wake"),
("376","US","America/New_York"),
("377","US","America/Detroit"),
("378","US","America/Kentucky/Louisville"),
("379","US","America/Kentucky/Monticello"),
("380","US","America/Indiana/Indianapolis"),
("381","US","America/Indiana/Vincennes"),
("382","US","America/Indiana/Winamac"),
("383","US","America/Indiana/Marengo"),
("384","US","America/Indiana/Petersburg"),
("385","US","America/Indiana/Vevay"),
("386","US","America/Chicago"),
("387","US","America/Indiana/Tell_City"),
("388","US","America/Indiana/Knox"),
("389","US","America/Menominee"),
("390","US","America/North_Dakota/Center"),
("391","US","America/North_Dakota/New_Salem"),
("392","US","America/North_Dakota/Beulah"),
("393","US","America/Denver"),
("394","US","America/Boise"),
("395","US","America/Phoenix"),
("396","US","America/Los_Angeles"),
("397","US","America/Anchorage"),
("398","US","America/Juneau"),
("399","US","America/Sitka"),
("400","US","America/Metlakatla");
INSERT INTO timezones VALUES
("401","US","America/Yakutat"),
("402","US","America/Nome"),
("403","US","America/Adak"),
("404","US","Pacific/Honolulu"),
("405","UY","America/Montevideo"),
("406","UZ","Asia/Samarkand"),
("407","UZ","Asia/Tashkent"),
("408","VA","Europe/Vatican"),
("409","VC","America/St_Vincent"),
("410","VE","America/Caracas"),
("411","VG","America/Tortola"),
("412","VI","America/St_Thomas"),
("413","VN","Asia/Ho_Chi_Minh"),
("414","VU","Pacific/Efate"),
("415","WF","Pacific/Wallis"),
("416","WS","Pacific/Apia"),
("417","YE","Asia/Aden"),
("418","YT","Indian/Mayotte"),
("419","ZA","Africa/Johannesburg"),
("420","ZM","Africa/Lusaka"),
("421","ZW","Africa/Harare");




CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO user_roles VALUES
("1","Administrator","1","2016-08-16 00:00:00","0","0000-00-00 00:00:00"),
("2","Manager","1","2016-08-16 00:00:00","0","0000-00-00 00:00:00"),
("3","Sales Person","1","2016-08-16 00:00:00","0","0000-00-00 00:00:00");




CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(499) COLLATE utf8_unicode_ci NOT NULL,
  `pin` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO users VALUES
("1","Owner","owner@gmail.com","5f4dcc3b5aa765d61d8327deb882cf99","1234","1","0","1","2016-08-27 00:00:00","1","2016-09-03 18:15:48","1"),
("14","Sales","sales@sales.com","9ed083b1436e5f40ef984b28255eef18","","3","3","1","2017-10-27 21:08:57","1","2017-10-31 02:42:01","1"),
("15","1","1@gmail.com","c4ca4238a0b923820dcc509a6f75849b","1","3","0","1","2018-01-03 19:19:54","0","0000-00-00 00:00:00","1"),
("16","2","2@gamil.com","c81e728d9d4c2f636f067f89cc14862c","2","3","0","1","2018-01-03 19:21:07","0","0000-00-00 00:00:00","1"),
("17","t","t@gmail.com","e358efa489f58062f10dd7316b65649e","1212","1","3","1","2018-01-03 19:21:56","0","0000-00-00 00:00:00","1");




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;