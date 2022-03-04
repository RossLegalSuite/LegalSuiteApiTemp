		public static function DefaultparlangSelectBuilder(&$query)
		{

			$query->addselect("parlang.*")
			->addselect(DB::raw("CASE WHEN ISNULL(parlang.BirthDate,0) = 0 OR parlang.BirthDate = 0 OR parlang.BirthDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(parlang.BirthDate-36163 as DateTime),106) END AS FormattedBirthDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(parlang.SpouseBirthDate,0) = 0 OR parlang.SpouseBirthDate = 0 OR parlang.SpouseBirthDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(parlang.SpouseBirthDate-36163 as DateTime),106) END AS FormattedSpouseBirthDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(parlang.MarriageDate,0) = 0 OR parlang.MarriageDate = 0 OR parlang.MarriageDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(parlang.MarriageDate-36163 as DateTime),106) END AS FormattedMarriageDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(parlang.TrustDate,0) = 0 OR parlang.TrustDate = 0 OR parlang.TrustDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(parlang.TrustDate-36163 as DateTime),106) END AS FormattedTrustDate"))



			return $query;
		}


-------------------------------------------
		if ($TableName == 'parlang') {

			$classFileContent .= $this->addDateMutation('birthdate');
			$classFileContent .= $this->addDateMutation('spousebirthdate');
			$classFileContent .= $this->addDateMutation('marriagedate');
			$classFileContent .= $this->addDateMutation('trustdate');

		}
