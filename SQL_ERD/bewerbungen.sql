CREATE TABLE `bewerbungen` (
  `bew_id` int NOT NULL,
  `datum` date NOT NULL,
  `firma` varchar(100) NOT NULL,
  `rechtsart` int DEFAULT NULL,
  `stadt` varchar(100) NOT NULL,
  `plz` int NOT NULL,
  `strasse_nr` varchar(100) DEFAULT NULL,
  `ansprech_person` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `feedback` int DEFAULT NULL,
  `bemerkung` varchar(255) CHARACTER SET utf8 COLLATE utf8_german2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `bewerbungen`
--

INSERT INTO `bewerbungen` (`bew_id`, `datum`, `firma`, `rechtsart`, `stadt`, `plz`, `strasse_nr`, `ansprech_person`, `email`, `feedback`, `bemerkung`) VALUES
(2, '2021-10-23', 'VLG Verlagsgesellschaft', 7, 'Bremen', 28217, 'Am Wall 50-54', 'Frau Tina Völkerink-Pankoff', 'tklustig.thomas@gmail.com', 1, 'Absage am 27.10.\'21 um 14:07 Uhr'),
(3, '2021-10-23', 'YTPI Internetagentur', 7, 'Suthfeld', 31555, 'Seewiese 1', 'Herr Paul Schmidt', 'info@ytpi.de', 1, 'Vorstellungsgespräch: Herr Maxim z.H. Hr. Schmidt am 12.11.2021 gegen 14.00 Uhr b. Bhf. Haste Nähe Wunstdorf');

--
-- Tabellenstruktur für Tabelle `nachricht`
--

CREATE TABLE `nachricht` (
  `id_message` int NOT NULL,
  `notiz` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `nachricht`
--

INSERT INTO `nachricht` (`id_message`, `notiz`) VALUES
(1, 'Ja'),
(2, 'Nein'),
(3, 'steht noch aus');

--
-- Tabellenstruktur für Tabelle `rechtsform`
--

CREATE TABLE `rechtsform` (
  `id_recht` int NOT NULL,
  `art` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `rechtsform`
--

INSERT INTO `rechtsform` (`id_recht`, `art`) VALUES
(6, 'AG'),
(8, 'eG'),
(1, 'Einzelunternehmen'),
(2, 'GbR'),
(7, 'GmbH'),
(3, 'GmbH & Co.KG'),
(4, 'KG'),
(9, 'KGaA'),
(5, 'OHG'),
(10, 'Stiftung');

--
-- Tabellenstruktur für Tabelle `l_jobboersen`
--

CREATE TABLE `l_jobboersen` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `homepage` varchar(255) DEFAULT NULL,
  `ergebnis_seite` text,
  `fachrichtung` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Daten für Tabelle `l_jobboersen`
--

INSERT INTO `l_jobboersen` (`id`, `name`, `homepage`, `ergebnis_seite`, `fachrichtung`) VALUES
(1, 'Indeed', 'http://de.indeed.com', 'http://de.indeed.com/Jobs?q=###&l=&&&', 'Assistenz'),
(2, 'Stepstone', 'https://www.stepstone.de', 'https://www.stepstone.de/5/ergebnisliste.html?stf=freeText&ns=1&qs=[{%22type%22%3A%22jd%22%2C%22description%22%3A%22###%22%2C%22id%22%3A-3184}%2C{%22type%22%3A%22geocity%22%2C%22description%22%3A%22&&&%22%2C%22id%22%3A-84462}]&selectString=&widgetID=0&cityID=0&longitude=0&latitude=0&basicRadius=0&selectStringWhat=&sourceOfTheSearchField=front&whereRadius=0&ke=###&ws=&&&', 'Alle Fachrichtungen'),
(3, 'Xing Jobbörse', 'http://https://www.jobbörse.com', 'https://www.jobbörse.com/?action=stellenangebote-jobs&j=###&s=&&&&country=', 'IT, Vertrieb, Rechnungswesen, Ingenierwesen'),
(4, 'Monster.de', 'http://jobsuche.monster.de', 'http://jobsuche.monster.de/Jobs/?q=###&where=&&&&intcid=HP_HeroSearch', 'Alle Fachrichtungen'),
(5, 'Job Scout 24', 'http://www.jobs.de', 'http://www.jobs.de/jobs_ergebnisliste.html?exCrit=st%3da%3buse%3dALL%3brawWords%3d###%3bTID%3d0%3bCTY%3d&&&%3bCID%3dDE%3bLOCCID%3dDE%3bENR%3dNO%3bDTP%3dDRNS%3bYDI%3dYES%3bIND%3dALL%3bPDQ%3dAll%3bPDQ%3dAll%3bPAYL%3d0%3bPAYH%3dgt120%3bPOY%3dNO%3bETD%3dALL%3bRE%3dALL%3bMGT%3dDC%3bSUP%3dDC%3bFRE%3d30%3bCHL%3dIL%3bQS%3dsid_unknown%3bSS%3dNO%3bTITL%3d0%3bRAD%3d25%3bJQT%3dRAD%3bJDV%3dFalse%3bSITEENT%3dJSJ%3bMaxLowExp%3d-1%3bRecsPerPage%3d25&sc_cmp1=JS_JS_QSB_GEN&IPath=QH', 'Alle Fachrichtungen'),
(6, 'Stellenanzeigen.de', 'http://www.stellenanzeigen.de', 'http://www.stellenanzeigen.de/suche/?voll=###&plz=&&&', 'Alle Fachrichtungen'),
(7, 'Meinestadt.de', 'http://jobs.meinestadt.de', 'http://jobs.meinestadt.de/&&&/suche?words=###', 'Alle Fachrichtungen'),
(8, 'Careerjet', 'http://www.careerjet.de', 'http://www.careerjet.de/suchen/stellenangebote?s=###&l=&&&', 'Alle Fachrichtungen'),
(9, 'Jobrobot', 'http://www.jobrobot.de', 'http://www.jobrobot.de/content_0400_jobsuche.htm?cmd=res&keywords=###&umkreissuche_ort=&&&&umkreissuche_entfernung=40&useindex=0&keine_praktika=ja&zeitraum=all', 'Alle Fachrichtungen'),
(10, 'Kimeta', 'http://www.kimeta.de', '', 'Alle Fachrichtungen'),
(11, 'Jobrapido', 'http://de.jobrapido.com', 'http://de.jobrapido.com/?w=###&l=&&&&r=auto', 'Alle Fachrichtungen'),
(12, 'IT-Treff', 'https://www.it-treff.de/', 'https://www.it-treff.de/search/it-jobs-stellenangebote/?se=###&v=1,10,0,&&&,3', 'IT'),
(13, 'Absolventa', 'http://www.absolventa.de', 'http://www.absolventa.de/jobs/channel/it?utf8=%E2%9C%93&query[text]=###&query[city]=&&&&query[radius]=100&query[dep][]=10409&query[dep][]=10410&query[dep][]=10411&query[dep][]=10412&query[dep][]=10413&query[dep][]=10414&query[dep][]=10415&query[dep][]=10416&query[dep][]=10417&query[dep][]=3&query[dep][]=10418&query[dep][]=10430', 'IT (f?r Studenten, Absolventen) '),
(14, 'Areitsagentur', 'https://jobboerse.arbeitsagentur.de/', '', 'Alle Fachrichtungen'),
(15, 'Jobware', 'http://www.jobware.de', '', 'Alle Fachrichtungen'),
(16, 'HAZ-Jobs', 'http://www.haz-job.de/Search', '', 'Alle Fachrichtungen'),
(26, 'Hotel Career', 'http://http://www.hotelcareer.de/', '', 'Hotellerie & Gastronomie'),
(27, 'Hoteljob-Deutschland', 'http://http://www.hoteljob-deutschland.de/index.php?a=fulltext&option=com_jobportal&task=jobsearch&filter%5Bbranche%5D%5B%5D=all&filter%5Bbereich%5D%5B%5D=all&filter%5Bvon%5D=all&filter%5Bbis%5D=all&filter%5Brang%5D%5B%5D=2&filter%5Bverhaeltnis%5D%5B%5D=4', '', 'Hotellerie & Gastronomie'),
(28, 'Jobsterne', 'http://http://www.jobsterne.de/Search.aspx', '', 'Hotellerie & Gastronomie'),
(29, 'HoGaPage', 'http://http://www.hogapage.de/bewerber/stellen/stellenangebote.html', '', 'Hotellerie & Gastronomie'),
(36, 'ebay kleinanzeigen', 'http://www.ebay-kleinanzeigen.de', 'http://www.ebay-kleinanzeigen.de/s-jobs/&&&/###/k0c102l3155r30', 'Alle Fachrichtungen');

--
-- Indizes für die Tabelle `rechtsform`
--
ALTER TABLE `rechtsform`
  ADD PRIMARY KEY (`id_recht`),
  ADD KEY `art` (`art`);
  
--
-- Indizes für die Tabelle `bewerbungen`
--
ALTER TABLE `bewerbungen`
  ADD PRIMARY KEY (`bew_id`),
  ADD KEY `feedback` (`feedback`),
  ADD KEY `rechtsart` (`rechtsart`);
  
--
-- Indizes für die Tabelle `nachricht`
--
ALTER TABLE `nachricht`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `notiz` (`notiz`);
  
--
-- Indizes für die Tabelle `l_jobboersen`
--
ALTER TABLE `l_jobboersen`
  ADD PRIMARY KEY (`id`);
  
--
-- AUTO_INCREMENT für Tabelle `rechtsform`
--
ALTER TABLE `rechtsform`
  MODIFY `id_recht` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
  
--
-- AUTO_INCREMENT für Tabelle `bewerbungen`
--
ALTER TABLE `bewerbungen`
  MODIFY `bew_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
  
--
-- AUTO_INCREMENT für Tabelle `nachricht`
--
ALTER TABLE `nachricht`
  MODIFY `id_message` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
  
--
-- AUTO_INCREMENT für Tabelle `l_jobboersen`
--
ALTER TABLE `l_jobboersen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
  
--
-- Constraints der Tabelle `bewerbungen`
--
ALTER TABLE `bewerbungen`
  ADD CONSTRAINT `bewerbungen_ibfk_1` FOREIGN KEY (`feedback`) REFERENCES `nachricht` (`id_message`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `bewerbungen_ibfk_2` FOREIGN KEY (`rechtsart`) REFERENCES `rechtsform` (`id_recht`) ON DELETE RESTRICT ON UPDATE CASCADE;
  