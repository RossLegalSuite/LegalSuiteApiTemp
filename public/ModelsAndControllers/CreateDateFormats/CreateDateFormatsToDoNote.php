		public static function DefaultToDoNoteSelectBuilder(&$query)
		{

			$query->addselect("ToDoNote.*")
			->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.Date,0) = 0 OR ToDoNote.Date = 0 OR ToDoNote.Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.Date-36163 as DateTime),106) END AS FormattedDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.DateDone,0) = 0 OR ToDoNote.DateDone = 0 OR ToDoNote.DateDone > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.DateDone-36163 as DateTime),106) END AS FormattedDateDone"))
			->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.AutoNotifyDate,0) = 0 OR ToDoNote.AutoNotifyDate = 0 OR ToDoNote.AutoNotifyDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.AutoNotifyDate-36163 as DateTime),106) END AS FormattedAutoNotifyDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.CreatedDate,0) = 0 OR ToDoNote.CreatedDate = 0 OR ToDoNote.CreatedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.CreatedDate-36163 as DateTime),106) END AS FormattedCreatedDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.DateAdjustment,0) = 0 OR ToDoNote.DateAdjustment = 0 OR ToDoNote.DateAdjustment > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.DateAdjustment-36163 as DateTime),106) END AS FormattedDateAdjustment"))

			return $query;
		}


-------------------------------------------
		if ($TableName == 'ToDoNote') {

			$classFileContent .= $this->addDateMutation('date');
			$classFileContent .= $this->addDateMutation('datedone');
			$classFileContent .= $this->addDateMutation('autonotifydate');
			$classFileContent .= $this->addDateMutation('createddate');
			$classFileContent .= $this->addDateMutation('dateadjustment');

		}
