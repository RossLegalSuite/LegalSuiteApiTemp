		public static function DefaultFeeNoteSelectBuilder(&$query)
		{

			$query->addselect("FeeNote.*")
			->addselect(DB::raw("CASE WHEN ISNULL(FeeNote.Date,0) = 0 OR FeeNote.Date = 0 OR FeeNote.Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(FeeNote.Date-36163 as DateTime),106) END AS FormattedDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(FeeNote.PostedDate,0) = 0 OR FeeNote.PostedDate = 0 OR FeeNote.PostedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(FeeNote.PostedDate-36163 as DateTime),106) END AS FormattedPostedDate"))

			return $query;
		}


-------------------------------------------
		if ($TableName == 'FeeNote') {

			$classFileContent .= $this->addDateMutation('date');
			$classFileContent .= $this->addDateMutation('posteddate');

		}
