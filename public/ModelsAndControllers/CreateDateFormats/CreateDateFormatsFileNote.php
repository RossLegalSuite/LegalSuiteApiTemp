		public static function DefaultfilenoteSelectBuilder(&$query)
		{

			$query->addselect("filenote.*")
			->addselect(DB::raw("CASE WHEN ISNULL(filenote.Date,0) = 0 OR filenote.Date = 0 OR filenote.Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(filenote.Date-36163 as DateTime),106) END AS FormattedDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(filenote.AutoNotifyDate,0) = 0 OR filenote.AutoNotifyDate = 0 OR filenote.AutoNotifyDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(filenote.AutoNotifyDate-36163 as DateTime),106) END AS FormattedAutoNotifyDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(filenote.CreatedDate,0) = 0 OR filenote.CreatedDate = 0 OR filenote.CreatedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(filenote.CreatedDate-36163 as DateTime),106) END AS FormattedCreatedDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(filenote.Time,0) = 0 OR filenote.Time = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(filenote.Time * 10) ,0),108) END AS FormattedTime"))
			->addselect(DB::raw("CASE WHEN ISNULL(filenote.CreatedTime,0) = 0 OR filenote.CreatedTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(filenote.CreatedTime * 10) ,0),108) END AS FormattedCreatedTime"))

			return $query;
		}


-------------------------------------------
		if ($TableName == 'filenote') {

			$classFileContent .= $this->addDateMutation('date');
			$classFileContent .= $this->addDateMutation('autonotifydate');
			$classFileContent .= $this->addDateMutation('createddate');

		}
