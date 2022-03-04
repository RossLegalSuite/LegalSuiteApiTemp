		public static function DefaultParFicaSelectBuilder(&$query)
		{

			$query->addselect("ParFica.*")
			->addselect(DB::raw("CASE WHEN ISNULL(ParFica.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParFica.Date-36163 as DateTime),106) END AS FormattedDate"))

			return $query;
		}


-------------------------------------------
		if ($TableName == 'ParFica') {

			$classFileContent .= $this->addDateMutation('date');

		}
