		public static function DefaultPartySelectBuilder(&$query)
		{

			$query->addselect("Party.*")
			->addselect(DB::raw("CASE WHEN ISNULL(Party.LastContactDate,0) = 0 OR Party.LastContactDate = 0 OR Party.LastContactDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.LastContactDate-36163 as DateTime),106) END AS FormattedLastContactDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(Party.FirstContactDate,0) = 0 OR Party.FirstContactDate = 0 OR Party.FirstContactDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.FirstContactDate-36163 as DateTime),106) END AS FormattedFirstContactDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(Party.UpdatedByDate,0) = 0 OR Party.UpdatedByDate = 0 OR Party.UpdatedByDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.UpdatedByDate-36163 as DateTime),106) END AS FormattedUpdatedByDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(Party.UpdatedByTime,0) = 0 OR Party.UpdatedByTime = 0 OR Party.UpdatedByTime > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.UpdatedByTime-36163 as DateTime),106) END AS FormattedUpdatedByTime"))
			->addselect(DB::raw("CASE WHEN ISNULL(Party.LastInstructedDate,0) = 0 OR Party.LastInstructedDate = 0 OR Party.LastInstructedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.LastInstructedDate-36163 as DateTime),106) END AS FormattedLastInstructedDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(Party.LastBirthdayEventDate,0) = 0 OR Party.LastBirthdayEventDate = 0 OR Party.LastBirthdayEventDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.LastBirthdayEventDate-36163 as DateTime),106) END AS FormattedLastBirthdayEventDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(Party.FicaRequestDate,0) = 0 OR Party.FicaRequestDate = 0 OR Party.FicaRequestDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.FicaRequestDate-36163 as DateTime),106) END AS FormattedFicaRequestDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(Party.CreatedDate,0) = 0 OR Party.CreatedDate = 0 OR Party.CreatedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.CreatedDate-36163 as DateTime),106) END AS FormattedCreatedDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(Party.DateResolutionSigned,0) = 0 OR Party.DateResolutionSigned = 0 OR Party.DateResolutionSigned > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.DateResolutionSigned-36163 as DateTime),106) END AS FormattedDateResolutionSigned"))


			->addselect(DB::raw("CASE WHEN ISNULL(Party.UpdatedByTime,0) = 0 OR Party.UpdatedByTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(Party.UpdatedByTime * 10) ,0),108) END AS FormattedUpdatedByTime"))
			->addselect(DB::raw("CASE WHEN ISNULL(Party.CreatedTime,0) = 0 OR Party.CreatedTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(Party.CreatedTime * 10) ,0),108) END AS FormattedCreatedTime"))

			return $query;
		}


-------------------------------------------
		if ($TableName == 'Party') {

			$classFileContent .= $this->addDateMutation('LastContactDate');
			$classFileContent .= $this->addDateMutation('FirstContactDate');
			$classFileContent .= $this->addDateMutation('UpdatedByDate');
			$classFileContent .= $this->addDateMutation('UpdatedByTime');
			$classFileContent .= $this->addDateMutation('LastInstructedDate');
			$classFileContent .= $this->addDateMutation('LastBirthdayEventDate');
			$classFileContent .= $this->addDateMutation('FicaRequestDate');
			$classFileContent .= $this->addDateMutation('CreatedDate');
			$classFileContent .= $this->addDateMutation('DateResolutionSigned');
			$classFileContent .= $this->addTimeMutation('UpdatedByTime');
			$classFileContent .= $this->addTimeMutation('CreatedTime');

		}
