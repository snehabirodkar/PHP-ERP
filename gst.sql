CREATE TABLE `gst` (
  `id` int(11) NOT NULL,
  `hsn_code` int(8) NOT NULL,
  `gst_rate` float NOT NULL,
  `with_effect_from` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gst`
--

INSERT INTO `gst` (`id`, `hsn_code`, `gst_rate`, `with_effect_from`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 10120407, 5, '2019-12-31 15:18:41', '2019-12-31 15:18:41', '2019-12-31 15:18:41', 0),
(2, 20134407, 12, '2019-12-31 15:18:41', '2019-12-31 15:18:41', '2019-12-31 15:18:41', 0),
(3, 30134407, 18, '2019-12-31 15:18:41', '2019-12-31 15:18:41', '2019-12-31 15:18:41', 0),
(4, 40134407, 5, '2019-12-31 15:18:41', '2019-12-31 15:18:41', '2019-12-31 15:18:41', 0),
(5, 50134407, 12, '2019-12-31 15:18:41', '2019-12-31 15:18:41', '2019-12-31 15:18:41', 0),
(6, 60134407, 18, '2019-12-31 15:18:41', '2019-12-31 15:18:41', '2019-12-31 15:18:41', 0),
(7, 70120407, 5, '2019-12-31 15:18:41', '2019-12-31 15:18:41', '2019-12-31 15:18:41', 0),
(8, 54134407, 12, '2019-12-31 15:18:41', '2019-12-31 15:18:41', '2019-12-31 15:18:41', 0),
(9, 80134407, 18, '2019-12-31 15:18:41', '2019-12-31 15:18:41', '2019-12-31 15:18:41', 0),
(10, 90134407, 5, '2019-12-31 15:18:41', '2019-12-31 15:18:41', '2019-12-31 15:18:41', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gst`
--
ALTER TABLE `gst`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gst`
--
ALTER TABLE `gst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
