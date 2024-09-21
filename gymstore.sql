-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 04:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gymstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `binhluan`
--

CREATE TABLE `binhluan` (
  `ContactID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `gopy` varchar(255) NOT NULL,
  `newsID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `binhluan`
--

INSERT INTO `binhluan` (`ContactID`, `email`, `name`, `phone`, `gopy`, `newsID`) VALUES
(14, 'nguyentrungthuan417@gmail.com', 'Nguyen Trung Thuan', NULL, 'đâs', 13),
(37, 'ADAS@gmail.com', 'Hiếu nguễn', NULL, '1212', 14),
(39, 'ADAS@gmail.com', 'Hiếu nguễn', NULL, 'tuệt\r\n', 13),
(40, 'ADAS@gmail.com', 'Hiếu nguễn', NULL, 'đấ', 16),
(41, 'Hihihaha@gmail', 'Thuận DepZai', NULL, 'thuận\r\n', 15);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandID` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL,
  `mota` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandID`, `brandName`, `mota`) VALUES
(1, 'MUTANT', '1 serving N1Protein BCAA1 90 servings cung cấp:  7g BCAAs hỗ trợ cơ bắp 2g Citrulline tăng lưu lượng máu cho cơ bắp Tiết kiệm với 90 lần dùng Hương vị thơm ngon, dễ uống'),
(2, 'NUTRICOST', '1 serving N1Protein BCAA1 90 servings cung cấp:  7g BCAAs hỗ trợ cơ bắp 2g Citrulline tăng lưu lượng máu cho cơ bắp Tiết kiệm với 90 lần dùng Hương vị thơm ngon, dễ uống'),
(3, 'NUTRABOLICS', NULL),
(4, 'RULEONE', NULL),
(5, 'APPLIED NUTRITION', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `mota` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `mota`) VALUES
(1, 'Bcaa', '1 serving N1Protein BCAA1 90 servings cung cấp:  7g BCAAs hỗ trợ cơ bắp 2g Citrulline tăng lưu lượng máu cho cơ bắp Tiết kiệm với 90 lần dùng Hương vị thơm ngon, dễ uống'),
(2, 'Mass', NULL),
(3, 'Whey', '1 serving N1Protein BCAA1 90 servings cung cấp:  7g BCAAs hỗ trợ cơ bắp 2g Citrulline tăng lưu lượng máu cho cơ bắp Tiết kiệm với 90 lần dùng Hương vị thơm ngon, dễ uống'),
(4, 'Createin', '1 serving N1Protein BCAA1 90 servings cung cấp:  7g BCAAs hỗ trợ cơ bắp 2g Citrulline tăng lưu lượng máu cho cơ bắp Tiết kiệm với 90 lần dùng Hương vị thơm ngon, dễ uống'),
(12, 'Pre Workout', '1 serving N1Protein BCAA1 90 servings cung cấp:  7g BCAAs hỗ trợ cơ bắp 2g Citrulline tăng lưu lượng máu cho cơ bắp Tiết kiệm với 90 lần dùng Hương vị thơm ngon, dễ uống');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ContactID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL,
  `gopy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ContactID`, `name`, `email`, `phone`, `gopy`) VALUES
(1, 'Nguyen Trung Thuan', 'ntthuana23127@cusc.ctu.edu.vn', 388509046, '1234');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(4) NOT NULL,
  `CompanyName` varchar(40) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(24) DEFAULT NULL,
  `Fax` varchar(24) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `ContactID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `CompanyName`, `OrderID`, `Email`, `Phone`, `Fax`, `pass`, `role`, `ContactID`) VALUES
(1, 'Nguyen Trung Thuan', 0, 'giahy123@gmail.com', NULL, NULL, 'giahy123@gmail.com', 0, 0),
(3, 'Thuận Nguyễn', 0, 'nguyentrungthuan417@gmail.com', NULL, NULL, 'thuan417', 1, 0),
(6, 'Tấn Bo', 0, 'tanbo@gmail.com', NULL, NULL, '123456', 0, 0),
(7, 'tấn bo', 0, 'tanbo123@gmail.com', NULL, NULL, 'tanbo123@gmail.com', 0, NULL),
(8, 'Datcuto', 0, 'datcutodatcutodatcutodatcutodatcutodatcutodatcutodatcuto@gmail.com', NULL, NULL, 'thuan417', 0, NULL),
(9, 'hiếu', 0, 'hieu123@gmail.com', NULL, NULL, 'hieu123@gmail.com', 0, NULL),
(10, 'kimoc', 0, 'aaaaaa@gmail.com', NULL, NULL, 'aaaaaa@gmail.com', 0, NULL),
(11, 'ThuanNg', 0, 'aaaaaa@gmail.com', NULL, NULL, 'aaaaaa@gmail.com', 0, NULL),
(12, 'đá', 0, 'sadasd@xn--sd-oia1q', NULL, NULL, 'áds', 0, NULL),
(13, 'Hy', 0, '', NULL, NULL, 'hihihaha', 0, NULL),
(14, 'hyyyy', 0, 'giahy123@gmail.com', NULL, NULL, 'giahy123@gmail.com', 0, NULL),
(15, 'Hyhy', 0, 'giacomhy1234@gmail.com', NULL, NULL, 'giacomhy1234@gmail.com', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsID` int(4) NOT NULL,
  `newsName` varchar(55) NOT NULL,
  `image` varchar(255) NOT NULL,
  `mota` longtext NOT NULL,
  `ngaythang` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsID`, `newsName`, `image`, `mota`, `ngaythang`) VALUES
(13, 'ấdas', 'news-bg-5.jpg', '1 serving N1Protein BCAA1 90 servings cung cấp:  7g BCAAs hỗ trợ cơ bắp 2g Citrulline tăng lưu lượng máu cho cơ bắp Tiết kiệm với 90 lần dùng Hương vị thơm ngon, dễ uống', '2024-05-16 20:54:58'),
(14, 'Chi tiết cách làm bột protein', 'cach-lam-bot-protein-thuc-vat_1716197994.jpg.webp', 'Chi tiết cách làm bột protein thực vật đơn giản nhất cho gymer Bột protein thực vật (bột protein chay, bột đạm chay) chủ yếu được làm từ các loại đậu. Chúng có ưu điểm là giàu protein và các loại amino axit thiết yếu, đồng thời có giá thành khá rẻ. Bạn hoàn toàn có thể tự làm ra thành phẩm bột protein chay tại nhà thơm ngon, bổ dưỡng theo hướng dẫn chi tiết cách làm bột protein thực vật của WheyStore.  Tổng quan về bột protein thực vật Protein là một trong những nguồn dinh dưỡng thiết yếu mà cơ thể cần bổ sung mỗi ngày để bảo đảm sự sống và giúp cơ thể khỏe mạnh. Có hai nguồn thức ăn chính mà chúng ta có thể khai thác protein từ chúng. Đó là động vật và thực vật.   Bột protein thực vật là gì? Bột protein thực vật là bột protein được làm từ hỗn hợp nhiều loại ngũ cốc khác nhau. Phổ biến nhất là các loại đậu như đậu nành, đậu đen, đậu đỏ,... và các loại hạt khác như gạo lứt, yến mạch,... Sở dĩ cần phải sử dụng nhiều loại thực vật để tạo ra thành phẩm là vì đa số các loại thực vật đều thiếu hụt một vài loại amino axit thiết yếu. Sự kết hợp này làm nâng cao giá trị dinh dưỡng của hỗn hợp bột protein thực vật, đảm bảo lượng amino axit thiết yếu đầy đủ cho cơ thể. Đồng thời việc này cũng khiến bột protein có mùi vị ngon hơn và đa dạng hóa nguồn vitamin khoáng chất.  Ưu - nhược điểm của bột protein thực vật Ưu điểm của bột protein thực vật:  Hoàn toàn thuần chay, phù hợp với những người đang theo chế độ ăn chay trường  Giàu vitamin khoáng chất và chất xơ, trong khi lượng chất béo và cholesterol thấp hơn hẳn protein động vật  Tốt cho sức khỏe, nhất là đối với những người có vấn đề về tim mạch, mỡ máu,...  Lượng calo khá ít, phù hợp với các chế độ ăn kiêng giảm cân  Không chứa đường lactose  Mùi vị thơm, thanh nhẹ dễ uống, có thể điều chỉnh độ ngọt theo ý muốn  Nguyên liệu giá rẻ, dễ tìm kiếm  Tuy nhiên loại bột này cũng có một số nhược điểm:  Không phải là nguồn protein hoàn chỉnh do thành phần có thể thiếu hụt một vài loại amino axit thiết yếu  Một số thành phần trong các loại hạt như Isoflavone (trong đậu nành), Purine (trong đỗ) có thể gây ảnh hưởng đến sức khỏe', '2024-05-25 12:30:50'),
(15, 'Chất béo tốt', 'cac-chat-beo-tot-cho-nguoi-giam-can_1715585230.jpg.webp', 'Các chất béo tốt cho người giảm cân hiệu quả nhất Chất béo là một trong 3 loại dinh dưỡng chính của cơ thể, bao gồm đạm (protein), tinh bột (carb) và chất béo. Chất có vai trò rất quan trọng để cơ thể hoạt động bình thường, cung cấp năng lượng để hấp thụ vitamin, khoáng chất; từ đó nâng cao sức khỏe tim mạch, não và còn có khả năng hỗ trợ giảm cân. Tuy nhiên, không phải loại chất béo nào cũng giống nhau. Có hai loại nhóm chất béo chính là chất béo tốt và chất béo xấu. Vậy chất béo tốt là gì? Các chất béo tốt cho người giảm cân thường có trong những loại thực phẩm nào? Mời các bạn theo dõi bài viết dưới đây của WheyStore để có thêm thông tin về chất béo tốt nhé!  Chất béo tốt là gì? Theo khoa học, chất béo được chia làm 2 loại là chất béo tốt và chất béo xấu.  Chất béo tốt Những thực phẩm chứa chất béo tốt  Những thực phẩm chứa chất béo tốt  Chất béo tốt còn được gọi là chất béo không bão hòa, được tồn tại dưới hai  dạng không bão hòa đa và không bão hòa đơn.  Chất béo không bão hòa đơnđược tìm thấy trong các loại hạt, ô liu và quả bơ. Những loại thực phẩm này sẽ cung cấp cho bạn hàm lượng chất béo tốt (khi ăn với lượng vừa phải) thay thế cho những loại chất béo bão hòa xấu khác. Chất béo không bão hòa đa có thể phân loại thêm thành chất béo omega 3 và omega 6. Chất béo này không đông đặc ở nhiệt độ thường. Omega 6 có thể tìm thấy ở các loại dầu (dầu đậu nành, dầu hướng dương, dầu lạc, dầu bắp, dầu hoa anh thảo, dầu lạc,…), thịt, trứng, các sản phẩm từ sữa có chứa Arachidonic Acid. Còn omega 3 có trong các loại thực phẩm như cá (cá hồi, cá trích, cá thu, cá mòi,…), dầu gan cá tuyết, hàu, hạt lanh, hạt chia, quả óc chó,… Nhìn chung, loại chất béo này rất tốt cho sức khỏe, giúp giảm cholesterol trong máu, sản sinh cholesterol tốt cho cơ thể, hỗ trợ tăng cường sức khỏe tim mạch, giảm nguy cơ xơ vữa động mạch,…  Chất béo xấu Những thực phẩm chứa chất béo xấu  Những thực phẩm chứa chất béo xấu  Chất béo xấu bao gồm chất béo chuyển hóa và chất béo bão hòa.  Chất béo chuyển hóa (chất béo trans) có thể tìm thấy trong các loại thịt, các loại bánh, thực phẩm chiên rán,.... Ngoài ra, các chất béo trans nhân tạo còn có thể tìm thấy ở trong các chế phẩm từ sữa. Chúng sẽ làm tăng hàm lượng cholesterol xấu (LDL) và làm giảm cholesterol tốt (HDL), khiến nguy cơ mắc các bệnh như tiểu đường loại 2, tim mạch, đột quỵ diễn ra nhiều hơn. Chất béo bão hòa: chất béo bão hòa cũng có trong hầu hết các loại thịt đỏ (thịt bò, thịt lợn, thịt cừu), các sản phẩm từ sữa nguyên chất (kem, phomai, sữa), bơ, dầu dừa, dầu cọ. Chúng có khả năng đông đặc ở nhiệt độ thường, làm cơ thể sản sinh ra cholesterol xấu và có khả năng làm tăng nguy cơ mắc các bệnh về tim mạch nếu bạn ăn quá nhiều. Điểm danh 10 chất béo tốt cho người giảm cân 1. Bơ tươi Acid béo trong quả bơ là chất béo không bão hòa đơn rất tốt cho sức khỏe  Acid béo trong quả bơ là chất béo không bão hòa đơn rất tốt cho sức khỏe  Theo nghiên cứu, trong quả bơ có chứa tới khoảng 77% chất béo. Đây là loại quả có hàm lượng chất béo còn cao hơn những loại thực phẩm có nguồn gốc từ động vật. Bên cạnh đó, acid béo trong quả bơ là chất béo không bão hòa đơn (acid oleic) – loại acid béo chiếm ưu thế trong dầu ô liu, rất có lợi cho sức khỏe. Ăn bơ sẽ giúp cơ thể bổ sung chất xơ và chất béo tốt, làm giảm cholesterol LDL, giảm triglyceride và tăng cholesterol HDL. Ngoài hàm lượng chất béo tốt cao thì lượng calo trong quả bơ cũng cao. Tuy nhiên, đây vẫn là loại thực phẩm thường xuyên xuất hiện trong chế độ giảm cân của nhiều người.  2. Các loại quả hạch Chất béo trong các loại quả hạch hỗ trợ giảm cân rất tốt  Chất béo trong các loại quả hạch hỗ trợ giảm cân rất tốt  Các loại quả hạch là thực phẩm chứa nhiều chất béo tốt, giàu chất xơ và giàu protein. Đây cũng là loại thực phẩm lành mạnh nhất mà mọi người nên bổ sung vào chế độ ăn hàng ngày. Bổ sung các loại quả hạch phổ biến như óc chó, hạnh nhân và hạt macca sẽ giúp cơ thể khỏe mạnh hơn và có ít nguy cơ bị béo phì hơn.  3. Hạt chia Hạt chia có nhiều chất béo tốt, dễ ăn và hỗ trợ giảm cân hiệu quả  Hạt chia có nhiều chất béo tốt, dễ ăn và hỗ trợ giảm cân hiệu quả  Hạt chia là loại hạt rất dễ ăn, dễ uống mà lại có nhiều dưỡng chất. Theo nghiên cứu, trong 28g hạt chia có chứa tới 9g chất béo tốt. Hạt chia chứa axit béo omega-3 lành mạnh. Do vậy, bổ sung hạt chia vào chế độ ăn hàng ngày sẽ giúp tăng cường sức khỏe của tim mạch. Đồng thời hỗ trợ quá trình giảm cân tốt hơn.  4.Hạt lanh Chất béo trong hạt lạnh giúp giảm cholesterol xấu trong cơ thể Chất béo trong hạt lạnh giúp giảm cholesterol xấu trong cơ thể  Hạt lanh là một loại chất béo không bão hòa, chứa nhiều axit béo omega-3 và giàu chất xơ. Đây cũng là thực phẩm chất béo tốt mà bạn có thể bổ sung trong thực đơn của mình, giúp hỗ trợ giảm cân tốt hơn và giảm mức cholesterol xấu trong cơ thể.  5. Trứng Trứng chứa nhiều chất dinh dưỡng và chất béo tốt  Trứng chứa nhiều chất dinh dưỡng và chất béo tốt  Lòng đỏ trứng rất giàu chất béo và giàu cholesterol. Trung bình, một quả trứng sẽ khoảng 212mg cholesterol, tương đương với 71% hàm lượng cần được bổ sung một ngày. Theo nghiên cứu, cholesterol trong trứng không gây ảnh hưởng xấu đến lượng cholesterol trong máu, nếu bạn bổ sung lượng trứng vừa đủ trong khẩu phần ăn. Không những vậy, trong trứng còn có 62% calo đến từ chất béo. Ngoài ta, trứng còn là thực phẩm suy nhất chứa mọi dưỡng chất cần thiết cho cơ thể con người. Do đó, bổ sung trứng trong chế độ ăn của mọi người sẽ giúp cơ thể có đầy đủ dưỡng chất và khỏe mạnh hơn.  6. Socola đen (>70% cacao) Socola đen chứa nhiều acid béo không bão hòa đơn, hỗ trợ giảm cân rất tốt  Socola đen chứa nhiều axit béo không bão hòa đơn, có khả năng thúc đẩy quá trình trao đổi chất và đốt cháy calo nhanh hơn. . Đó là lý do vì sao socola đen là thực phẩm được nhiều người sử dụng trong quá trình giảm cân. Ngoài ra, thực phẩm này có hàm lượng chất chống oxy hóa cao nhất giúp kiểm soát cholesterol và huyết áp ở trong cơ thể con người. Ăn socola đen với hàm lượng đủ còn có thể giúp cải thiện trí nhớ, giảm căng thẳng và lo âu.  7. Cá béo Các loại cá béo rất giàu omega-3 tốt cho sức khỏe  Các loại cá béo rất giàu omega-3 tốt cho sức khỏe  Các loại cá như cá hồi, cá thu, cá mòi, cá trích,…. Là những loại thực phẩm có chứa nhiều axit béo omega-3, rất tốt cho sức khỏe. Bổ sung các loại cá này sẽ giúp bổ sung omega-3 cho cơ thể, giúp cơ thể khỏe mạnh hơn, cải thiện tình trạng sức khỏe tim mạch và não bộ. Bên cạnh đó, những loại cá béo này cũng chứa rất nhiều protein đem lại cảm giác no, giảm cảm giác thèm ăn giúp hỗ trợ giảm cân tốt hơn.  8. Dầu oliu nguyên chất Dầu oliu là một trong những thực phẩm chứa nhiều chất béo tốt nhất  Dầu oliu là một trong những thực phẩm chứa nhiều chất béo tốt nhất  Dầu oliu là một trong những thực phẩm lành mạnh, giàu chất béo lành mạnh và giàu vitamin E, K.  Loại chất béo chính có trong thực phẩm này là chất béo không bão hòa rất tốt cho cơ thể. Nghiên cứu cho thấy, trong 11% chất béo có trong dầu oliu có chứa cả hai loại omega-3 và omega-6. Hai chất béo có tác dụng hỗ trợ tăng cường sức khỏe, nâng cao hệ miễn dịch tim mạch và não bộ, điều hòa huyết áp, tránh tình trạng đông máu và cân bằng phản ứng hệ miễn dịch. Ngoài ra, trong dầu oliu cũng chứa hàm lượng chất chống oxy hóa có tác dụng chống viêm. Do đó, sử dụng dầu oliu đúng liều lượng sẽ giúp bạn giảm cân nhanh chóng hơn.  9. Sữa chua Sữa chua giàu chất béo, men vi sinh, canxi và protein  Sữa chua là thực phẩm giàu chất béo, rất tốt cho việc giảm cân  Không những giàu chất béo mà sữa chua còn chứa men vi sinh, canxi và protein. Bổ sung sữa chua hàng ngày vừa giúp hỗ trợ hệ tiêu hóa, giúp cơ thể khỏe mạnh hơn, đồng thời là thực phẩm cực kỳ hữu ích cho những ai đang trong quá trình giảm cân.  10. Phomai Phomai xanh là một trong những loại bơ thích hợp để ăn kiêng  Phomai xanh là một trong những loại bơ thích hợp để ăn kiêng  Phomai chứa rất nhiều canxi, chất béo và protein. Các loại phomai được làm từ 100% các loài động vật ăn có có giá trị dinh dưỡng cao, đồng thời chứa axit béo omega-3, vitamin K2 và CLA (axit linoleic – hỗ trợ ngăn ngừa béo phì, bệnh tim mạch và giảm viêm). Sử dụng các loại phomai như phomai xanh, phomai mozzarella, phomai feta,… sẽ giúp bạn bổ sung protein và các dưỡng chất khác, giúp bảo toàn cơ nạc cho những ai đang trong quá trình giảm cân.  Qua bài viết trên, mọi người có thể thấy chất béo là một loại dinh dưỡng quan trọng của cơ thể. Do đó, việc bỏ hoàn toàn chất béo ra khỏi chế độ giảm cân là điều không nên. Thay vào đó, mọi người có thể dựa vào 10 thực phẩm có chứa các chất béo tốt cho người giảm cân để thay thế các loại chất béo xấu khác. Ngoài ra, dựa vào các chất béo tốt kể trên, bạn có thể xây dựng một chế độ ăn kiêng lành mạnh, đa dạng và phong phú; giúp quá trình giảm cân của bạn trở nên dễ dàng và nhanh chóng hơn.', '2024-05-25 12:28:59'),
(16, 'Amix Nutrition', 'gioi-thieu-amix-nutrition_1716524915.jpg.webp', 'Amix Nutrition - Thương hiệu Châu Âu sở hữu loại Creatine cao cấp nhất hành tinh Nơi thành lập: Manchester, Vương Quốc Anh  Năm thành lập: 2003  Độ phủ: Hơn 45 quốc gia và vùng lãnh thổ (Trung, Tây và Đông Âu, Trung Đông, Nam Mỹ, Chile, Mexico, Bắc Phi, Trung Quốc….)  Sản phẩm chủ đạo: Thực phẩm bổ sung thể hình và phụ kiện thể thao  Amix Nutrition là thương hiệu chuyên sản xuất và phân phối toàn cầu các loại TPBS thể hình, dinh dưỡng thể thao trực thuộc tập đoàn The LargeLife Limited.  Trụ sở Amix Nutrition tại Châu Âu  Trụ sở Amix Nutrition tại Châu Âu  Trụ sở Amix Nutrition tại Châu Âu  Bạn có thể tìm thấy nhiều dòng sản phẩm chất lượng cao tại Amix, bao gồm whey protein, creatine, bánh protein, vitamin khoáng chất,... Thương hiệu này sở hữu hơn 1700+ mã sản phẩm. Mỗi ngày thương hiệu này xử lý hơn 10 tấn hàng trong khu vực kho rộng 22.000 mét vuông.  Khởi điểm của Amix bắt nguồn tại Châu Âu - Một trong những thị trường khó tính nhất trên thế giới. Amix không sản xuất hàng loạt sản phẩm đại trà mà tập trung nghiên cứu các công thức tối ưu nhất. Do đầu tư tập trung vào nghiên cứu và phát triển, Amix Nutrition đảm bảo các tiêu chuẩn chất lượng cao nhất trong quá trình sản xuất và đóng gói sản phẩm. Thương hiệu này ngày càng trở nên phổ biến trong lãnh thổ Châu Âu và toàn thế giới.  100% sản phẩm của Amix vượt qua các cuộc kiểm tra chất lượng nghiêm ngặt, thỏa mãn các yêu cầu khắt khe về chất lượng. Điều này đồng nghĩa với việc Amix cam kết:  Sản phẩm không tồn dư tạp chất độc hại  Đạt chuẩn yêu cầu trong tất cả các khâu sản xuất  Người tiêu dùng nhận được nguồn dinh dưỡng lành mạnh và an toàn nhất  Dây chuyền sản xuất trong nhà máy của Amix Nutrition  Dây chuyền sản xuất trong nhà máy của Amix Nutrition  Dây chuyền sản xuất trong nhà máy của Amix Nutrition  Dây chuyền sản xuất trong nhà máy của Amix Nutrition  LargeLifeTM Limited, chủ sở hữu thương hiệu Amix Nutrition rất chú trọng đến hệ sinh thái và hướng đến tăng trưởng bền vững. Do đó mức tiêu thụ năng lượng của toàn bộ cơ sở sản xuất phần lớn được chi trả bởi ĐIỆN XANH (điện được tạo ra hoàn toàn từ các nguồn tái tạo).  Amix hoạt động dưới sự giám sát liên tục của Cơ quan Thanh tra Thực phẩm và Nông nghiệp Séc. Hệ thống chứng nhận của Amix Nutrition bao gồm:  HACCP, ISO 9001, ISO 22000 và GMP Chứng nhận an toàn thực phẩm FSSC 22000 Giành giải thưởng ATUSALVD của Bộ Y tế Tây Ban Nha cho danh hiệu thương hiệu dinh dưỡng thể thao tốt nhất về chất lượng và sự đổi mới trong năm 2017 Các sản phẩm của Amix không chỉ dành cho người tập thể hình. Bất cứ ai đang theo đuổi một lối sống lành mạnh, có nhu cầu cải thiện sức khỏe bằng cách bổ sung dinh dưỡng sạch đều có thể sử dụng sản phẩm của Amix.', '2024-05-25 12:29:35'),
(17, 'Hướng dẫn cách phân biệt whey thật giả, whey kém chất l', 'cach-phan-biet-whey-that-gia-1_1717039763.jpg.webp', 'Đăng bởi: Nguyễn Mỹ Linh Ngày 29-05-2024 Hướng dẫn cách phân biệt whey thật giả, whey kém chất lượng chuẩn nhất Sử dụng whey protein giả có thể dẫn đến rối loạn tiêu hóa, thậm chỉ là suy gan, suy thận. Những cách phân biệt whey thật giả dưới đây dễ dàng giúp bạn nhận biết đâu mới là whey chính hãng để đưa ra quyết định mua hàng chính xác nhất và bảo vệ sức khỏe của mình. Mục lục nội dung [xem] Hướng dẫn cách phân biệt whey thật giả, whey kém chất lượng chuẩn nhất Whey protein là sản phẩm cung cấp đạm từ sữa rất phổ biến trong giới thể hình. Whey được gymer lựa chọn bởi khả năng hỗ trợ tăng cơ bắp nhanh chóng, hiệu quả cao. Tuy nhiên tình trạng làm giả whey protein ngày càng phổ biến, dẫn đến việc nhiều người sử dụng phải hàng kém chất lượng gây ảnh hưởng xấu đến sức khỏe.  WheyStore sẽ giúp bạn trang bị kỹ năng phân biệt whey thật giả chuẩn nhất, tránh rơi vào tình trạng “tiền mất tật mang”.  Hướng dẫn cách phân biệt whey thật giả chuẩn nhất Đặc thù của dòng sản phẩm whey protein hiện nay là được nhập khẩu 100% từ nước ngoài (Anh, Mỹ, Canada,...). Việt Nam chưa có thương hiệu sản xuất whey protein. Vì thế để đảm bảo mua đúng sản phẩm chính hãng bạn cần phải kiểm tra thông tin của cả nhà sản xuất tại nước ngoài lẫn đơn vị được hãng ủy quyền nhập khẩu tại Việt Nam.  Đối chiếu mẫu mã và quy cách đóng gói sản phẩm Hình thức mẫu mã bề ngoài là đặc điểm dễ nhận biết nhất khi phân biệt whey thật giả.', '2024-06-12 20:40:31'),
(18, 'Lợi ích của compound Tăng cường cơ bắp', 'compound-la-gi_1717649735.jpg.webp', 'Lợi ích của compound Tăng cường cơ bắp: Bài tập compound tác động lên nhiều nhóm cơ cùng một lúc, kích hoạt cơ bắp với tần suất cao hơn, nhờ đó các khối cơ sẽ tăng trưởng đồng đều. Tập được khối lượng tạ lớn hơn. Cải thiện sự phối hợp giữa các nhóm cơ: Compound bắt buộc cơ và khớp của bạn phải kết hợp ăn ý nhằm kiểm soát lực và tư thế. Cải thiện tính linh hoạt và phạm vi chuyển động và khả năng phối hợp của các nhóm cơ, xương khớp: Compound thực chất là một hình thức giãn cơ năng động. Chúng giúp bạn thực hiện nhiều chuyển động có tác dụng kéo dài và co cơ. Sau mỗi lần thực hiện compound cải thiện tính linh hoạt một cách tự nhiên và tối ưu hóa khả năng vận động của khớp Tăng cường tính linh hoạt năng động, phạm vi chuyển động và khả năng phối hợp của các nhóm cơ, xương khớp: Điều này góp phần giúp cơ thể dẻo dai bền bỉ hơn và hạn chế chấn thương. Tăng Testosterone và hormone tăng trưởng: Nghiên cứu cho thấy rằng các bài tập compound  tạo ra mức tăng hormone đồng hóa (testosterone và hormone tăng trưởng) lớn hơn nhiều so với các bài tập isolation. Đó cũng là lý do vì sao tốc độ tăng trưởng cơ bắp khi tập compound có xu hướng nhanh hơn là chỉ tập trung vào 1 nhóm cơ nhất định. Tăng mật độ xương, giúp xương chắc khỏe hơn Đốt cháy nhiều calo hơn: Các bài tập compound có mức tiêu hao năng lượng khá lớn. Việc kết hợp compound với cardio giúp bạn giảm cân đốt mỡ hiệu quả hơn, đồng thời tăng cường cơ bắp nhanh chóng. Ai nên tập compound? Nếu bạn đang đi tập gym với mục đích tăng cường cơ bắp, rèn luyện thể hình săn chắc hơn thì chắc chắn nên tập các bài tập compound. Thời lượng cho bài tập này có thể chiếm 40 - 70% thời gian mỗi buổi tập tùy theo giáo trình. Mỗi vùng cơ lớn trên cơ thể cần ít nhất một bài compound. Ví dụ:  Squat: Cơ đùi trước, đùi sau và cơ mông Deadlift: Cơ lưng, đùi, lưng và vai Bench Press: Cơ ngực, vai, tay sau Overhead Press: Cơ core, vai, tay sau Compound là bài tập tuyệt vời để xây dựng cơ bắp, cải thiện sức mạnh và độ linh hoạt của hệ thống cơ xương khớp. Tuy nhiên nếu bạn đang đặt mục tiêu giảm mỡ lên trên hết thì nên ưu tiên các bài tập cardio. Có thể kết hợp thêm compound để tăng cường đốt cháy calories và phát triển cơ bắp.', '2024-06-12 20:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderDetailID` int(11) NOT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `unitprice` decimal(13,3) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `CustomerID` int(4) NOT NULL,
  `ngaythang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tinhtrang` int(4) DEFAULT NULL,
  `huydon` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`OrderDetailID`, `ProductName`, `unitprice`, `quantity`, `image`, `OrderID`, `CustomerID`, `ngaythang`, `tinhtrang`, `huydon`) VALUES
(66, 'Z Nadasdas', 1.400, 1, 'bcaa2.jpg', 39, 3, '2024-05-25 15:55:05', 2, 0),
(67, 'Z Nutrition N1Protein', 900.000, 1, 'whey1.jpg', 40, 3, '2024-05-25 15:55:08', 2, 0),
(68, 'Pre workout ', 2.000, 1, 'whey3.jpg', 40, 3, '2024-05-25 15:55:08', 2, 0),
(69, 'Hiếu', 1.400, 1, 'bcaa1.jpg', 40, 3, '2024-05-25 15:55:08', 2, 0),
(82, 'Z Nutrition N1Protein', 4500.000, 5, 'whey1.jpg', 47, 3, '2024-05-25 04:45:21', 0, 0),
(83, 'Pre workout ', 8.000, 4, 'whey3.jpg', 47, 3, '2024-05-25 04:45:21', 0, 0),
(84, 'Z Nutrition N1Protein', 900.000, 1, 'whey1.jpg', 48, 3, '2024-05-25 04:48:19', 0, 0),
(85, 'Pre workout ', 4.000, 2, 'whey3.jpg', 48, 3, '2024-05-25 04:48:19', 0, 0),
(86, 'Hiếu', 1.400, 1, 'bcaa1.jpg', 48, 3, '2024-05-25 04:48:19', 0, 0),
(87, 'Z Nadasdas', 2.800, 2, 'bcaa2.jpg', 48, 3, '2024-05-25 04:48:19', 0, 0),
(88, 'Z Nutrition N1Protein', 900.000, 1, 'whey1.jpg', 49, 3, '2024-05-25 04:50:39', 0, 0),
(89, 'Pre workout ', 2.000, 1, 'whey3.jpg', 49, 3, '2024-05-25 04:50:39', 0, 0),
(90, 'Hiếu', 1.400, 1, 'bcaa1.jpg', 49, 3, '2024-05-25 04:50:39', 0, 0),
(91, 'Z Nutrition N1Protein', 900.000, 1, 'whey1.jpg', 50, 3, '2024-05-25 05:38:33', 0, 0),
(92, 'Pre workout ', 2.000, 1, 'whey3.jpg', 50, 3, '2024-05-25 05:38:33', 0, 0),
(93, 'Hiếu', 1.400, 1, 'bcaa1.jpg', 50, 3, '2024-05-25 05:38:33', 0, 0),
(94, 'Z Nadasdas', 5.600, 4, 'bcaa2.jpg', 51, 10, '2024-05-25 16:21:30', 0, 0),
(95, 'Z Nutrition N1Protein', 3600.000, 4, 'whey1.jpg', 51, 10, '2024-05-25 16:21:30', 0, 0),
(96, 'Z Nutrition N1Protein', 900.000, 1, 'whey1.jpg', 52, 10, '2024-05-25 16:23:33', 0, 0),
(97, 'Z Nutrition N1Protein', 1800.000, 2, 'whey1.jpg', 53, 10, '2024-05-25 16:25:06', 0, 0),
(98, 'Z Nutrition N1Protein', 900.000, 1, 'whey1.jpg', 54, 10, '2024-05-25 16:26:55', 0, 0),
(99, 'Z Nutrition N1Protein', 900.000, 1, 'whey1.jpg', 55, 10, '2024-05-25 16:27:29', 0, 0),
(100, 'Z Nutrition N1Protein', 4500.000, 5, 'whey1.jpg', 56, 15, '2024-06-02 14:03:13', 2, 1),
(101, 'Pre workout ', 200.000, 1, 'whey3.jpg', 56, 15, '2024-06-02 14:03:13', 2, 1),
(102, 'Z Nadasdas', 800.000, 1, 'bcaa2.jpg', 56, 15, '2024-06-02 14:03:13', 2, 1),
(103, 'Pre workout ', 200.000, 1, 'whey3.jpg', 57, 15, '2024-06-02 14:02:41', 1, 0),
(104, 'Z Nutrition N1Protein', 900.000, 1, 'whey1.jpg', 57, 15, '2024-06-02 14:02:41', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `tinhtrang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CompanyName`, `email`, `phone`, `Address`, `tinhtrang`) VALUES
(22, 'Nguyen Trung Thuan', 'thuannguyen@gmail.com', '0388509046', 'hentai\r\n', 0),
(23, 'Tấn Bo', 'tanbo@gmail.com', '0388509046', 'chắc được mà', 0),
(24, 'Tấn Bo', 'tanbo@gmail.com', '0388509046', 'Thjuannja 123', 0),
(25, 'Tấn Bo', 'tanbo@gmail.com', '0388509046', 'Thjuannja 123', 0),
(26, 'Tấn Bo', 'tanbo@gmail.com', '0388509046', 'Thjuannja 123', 0),
(27, 'Tấn Bo', 'tanbo@gmail.com', '0388509046', 'Thjuannja 123', 0),
(28, 'Tấn Bo', 'tanbo@gmail.com', '0388509046', 'chào em', 0),
(29, 'Tấn Bo', 'tanbo@gmail.com', '0388509046', 'chào em', 0),
(30, 'Tấn Bo', 'tanbo@gmail.com', '0388509046', 'Thjuannja 123', 0),
(31, 'Tấn Bo', 'tanbo@gmail.com', '0388509046', 'sdasdasdasdasdasdasdasdasd', 0),
(32, 'Tấn Bo', 'tanbo@gmail.com', '0388509046', 'sdasdasdasdasdasdasdasdasd', 0),
(33, 'Tấn Bo', 'tanbo@gmail.com', '0388509046', 'sdasdasdasdasdasdasdasdasd', 0),
(34, 'Tấn Bo', 'tanbo@gmail.com', '0388509046', 'ố7', 0),
(35, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'eheh', 0),
(36, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'sdasdasdasdasdasdasdasdasd', 0),
(37, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'Thjuannja 123', 0),
(38, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'Thjuannja 123', 0),
(39, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'eheh', 0),
(40, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'Khoai to', 0),
(41, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'Khoai to', 0),
(42, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'cảm ơn bạn', 0),
(43, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'chào em', 0),
(44, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'chắc được mà', 0),
(45, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'hihii', 0),
(46, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'hihii', 0),
(47, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', '231', 0),
(48, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'Thjuannja 123', 0),
(49, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'cảm ơn bạn', 0),
(50, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'chắc được mà', 0),
(51, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'ádas', 0),
(52, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'Thjuannja 123', 0),
(53, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'chào em', 0),
(54, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'cảm ơn bạn', 0),
(55, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'chào em', 0),
(56, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'Thjuannja 123', 0),
(57, 'Nguyen Trung Thuan', 'nguyentrungthuan417@gmail.com', '0388509046', 'Thjuannja 123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(40) NOT NULL,
  `motaa` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `UnitPrice` decimal(10,3) DEFAULT 0.000,
  `categoryID` int(11) DEFAULT NULL,
  `hot` int(11) DEFAULT NULL,
  `brandID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `motaa`, `image`, `UnitPrice`, `categoryID`, `hot`, `brandID`) VALUES
(58, 'Z Nutrition N1Protein', '1 serving N1Protein BCAA1 90 servings cung cấp:  7g BCAAs hỗ trợ cơ bắp 2g Citrulline tăng lưu lượng máu cho cơ bắp Tiết kiệm với 90 lần dùng Hương vị thơm ngon, dễ uống', 'whey1.jpg', 900.000, 3, 1, 3),
(74, 'Pre workout ', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'whey3.jpg', 200.000, 3, 1, 1),
(87, 'Z Nadasdas', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'bcaa2.jpg', 800.000, 1, 1, 3),
(96, 'Mutant BCAA', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'bcaa1.jpg', 600.000, 1, 1, 1),
(97, 'Compe BCAA', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'bcaa2.jpg', 600.000, 1, 0, 3),
(98, '6000 BCAA', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'bcaa3.jpg', 700.000, 1, 1, 2),
(99, 'BEST BCAA', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'bcaa4.jpg', 560.000, 1, 1, 1),
(100, 'EEA NUTRABO', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'bcaa7.webp', 340.000, 4, 0, 3),
(101, 'EEA 1150', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'bcaa8.webp', 540.000, 1, 0, 1),
(102, 'Createin blue', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'cre1.webp', 540.000, 4, 0, 4),
(103, 'Createin MonoHydrart', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'cre3.webp', 540.000, 4, 0, 5),
(104, 'Createin MonoHydrart', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'cre4.webp', 740.000, 1, 0, 1),
(105, 'Createin MonoHydrart', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'cre5.webp', 240.000, 1, 0, 1),
(106, 'Bcaa Mutan 3', '12312', 'bcaa1.jpg', 900.000, 1, 0, 1),
(107, 'Mass Fusion', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'mass1.webp', 999.000, 2, 0, 4),
(108, 'Mass Up ', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'mass2.webp', 670.000, 2, 0, 2),
(109, 'Mass Muscle Genner', '12312', 'mass3.webp', 780.000, 2, 0, 2),
(110, 'Mass Whey', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'mass4.webp', 1.000, 3, 0, 4),
(111, 'Pre workout 1', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'whey10.webp', 230.000, 12, 0, 5),
(112, 'Pre workout ISO', 'Được hình thành vào năm 1986 tại Mỹ, đến nay Optimum Nutrition đã phát triển được 38 năm, và đang là thương hiệu thực phẩm bổ sung được các vận động viên chuyên nghiệp và những người đam mê thể thao, thể hình trên toàn thế giới tin dùng.', 'whey9.webp', 390.000, 12, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `sliderID` int(11) NOT NULL,
  `sliderName` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`sliderID`, `sliderName`, `image`) VALUES
(27, 'anh3', '7L4A1383_4a57aaf7-0a21-45fe-a041-1be07f03b79a_1512x.webp'),
(28, 'anh1', 'pre.jpeg'),
(29, 'anh3', 'login.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`ContactID`),
  ADD KEY `newsID` (`newsID`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ContactID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`OrderDetailID`),
  ADD KEY `customers_ibfk_1` (`CustomerID`),
  ADD KEY `orderdetailss_ibfk_2` (`OrderID`),
  ADD KEY `producID_fk` (`ProductName`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `orderdetails_ibfk_1` (`categoryID`),
  ADD KEY `brand_fk1` (`brandID`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`sliderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `ContactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ContactID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `OrderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `sliderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`newsID`) REFERENCES `news` (`newsID`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`),
  ADD CONSTRAINT `orderdetailss_ibfk_2` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `brand_fk1` FOREIGN KEY (`brandID`) REFERENCES `brand` (`brandID`),
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
