		public static function DefaultmatterSelectBuilder(&$query)
		{

			$query->addselect("matter.*")
			->addselect(DB::raw("CASE WHEN ISNULL(matter.PrescriptionDate,0) = 0 OR matter.PrescriptionDate = 0 OR matter.PrescriptionDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.PrescriptionDate-36163 as DateTime),106) END AS FormattedPrescriptionDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.DateInstructed,0) = 0 OR matter.DateInstructed = 0 OR matter.DateInstructed > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.DateInstructed-36163 as DateTime),106) END AS FormattedDateInstructed"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.InterestFrom,0) = 0 OR matter.InterestFrom = 0 OR matter.InterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.InterestFrom-36163 as DateTime),106) END AS FormattedInterestFrom"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.LastInvoiceDate,0) = 0 OR matter.LastInvoiceDate = 0 OR matter.LastInvoiceDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.LastInvoiceDate-36163 as DateTime),106) END AS FormattedLastInvoiceDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.LODDate,0) = 0 OR matter.LODDate = 0 OR matter.LODDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.LODDate-36163 as DateTime),106) END AS FormattedLODDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.SummonsDate,0) = 0 OR matter.SummonsDate = 0 OR matter.SummonsDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.SummonsDate-36163 as DateTime),106) END AS FormattedSummonsDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.ReturnOfServiceDate,0) = 0 OR matter.ReturnOfServiceDate = 0 OR matter.ReturnOfServiceDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.ReturnOfServiceDate-36163 as DateTime),106) END AS FormattedReturnOfServiceDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.RDJDate,0) = 0 OR matter.RDJDate = 0 OR matter.RDJDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.RDJDate-36163 as DateTime),106) END AS FormattedRDJDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.JudgmentDate,0) = 0 OR matter.JudgmentDate = 0 OR matter.JudgmentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.JudgmentDate-36163 as DateTime),106) END AS FormattedJudgmentDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.WritDate,0) = 0 OR matter.WritDate = 0 OR matter.WritDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.WritDate-36163 as DateTime),106) END AS FormattedWritDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.S65Date,0) = 0 OR matter.S65Date = 0 OR matter.S65Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.S65Date-36163 as DateTime),106) END AS FormattedS65Date"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.TotalConsolidatedMatters,0) = 0 OR matter.TotalConsolidatedMatters = 0 OR matter.TotalConsolidatedMatters > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.TotalConsolidatedMatters-36163 as DateTime),106) END AS FormattedTotalConsolidatedMatters"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.InterestEndDate,0) = 0 OR matter.InterestEndDate = 0 OR matter.InterestEndDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.InterestEndDate-36163 as DateTime),106) END AS FormattedInterestEndDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.EMODate,0) = 0 OR matter.EMODate = 0 OR matter.EMODate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.EMODate-36163 as DateTime),106) END AS FormattedEMODate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.DateOfDebt,0) = 0 OR matter.DateOfDebt = 0 OR matter.DateOfDebt > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.DateOfDebt-36163 as DateTime),106) END AS FormattedDateOfDebt"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.StorageDate,0) = 0 OR matter.StorageDate = 0 OR matter.StorageDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.StorageDate-36163 as DateTime),106) END AS FormattedStorageDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.StorageTakenOutDate,0) = 0 OR matter.StorageTakenOutDate = 0 OR matter.StorageTakenOutDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.StorageTakenOutDate-36163 as DateTime),106) END AS FormattedStorageTakenOutDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.StorageReturnDate,0) = 0 OR matter.StorageReturnDate = 0 OR matter.StorageReturnDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.StorageReturnDate-36163 as DateTime),106) END AS FormattedStorageReturnDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.LastDebtorReceiptDate,0) = 0 OR matter.LastDebtorReceiptDate = 0 OR matter.LastDebtorReceiptDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.LastDebtorReceiptDate-36163 as DateTime),106) END AS FormattedLastDebtorReceiptDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.LastClientReceiptDate,0) = 0 OR matter.LastClientReceiptDate = 0 OR matter.LastClientReceiptDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.LastClientReceiptDate-36163 as DateTime),106) END AS FormattedLastClientReceiptDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.LastStatementDate,0) = 0 OR matter.LastStatementDate = 0 OR matter.LastStatementDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.LastStatementDate-36163 as DateTime),106) END AS FormattedLastStatementDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.ArchiveDate,0) = 0 OR matter.ArchiveDate = 0 OR matter.ArchiveDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.ArchiveDate-36163 as DateTime),106) END AS FormattedArchiveDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.S57Date,0) = 0 OR matter.S57Date = 0 OR matter.S57Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.S57Date-36163 as DateTime),106) END AS FormattedS57Date"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.DateWithDrawn,0) = 0 OR matter.DateWithDrawn = 0 OR matter.DateWithDrawn > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.DateWithDrawn-36163 as DateTime),106) END AS FormattedDateWithDrawn"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.ReceiptPercentToDate,0) = 0 OR matter.ReceiptPercentToDate = 0 OR matter.ReceiptPercentToDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.ReceiptPercentToDate-36163 as DateTime),106) END AS FormattedReceiptPercentToDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.ImportantDate,0) = 0 OR matter.ImportantDate = 0 OR matter.ImportantDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.ImportantDate-36163 as DateTime),106) END AS FormattedImportantDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.UpdatedByDate,0) = 0 OR matter.UpdatedByDate = 0 OR matter.UpdatedByDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.UpdatedByDate-36163 as DateTime),106) END AS FormattedUpdatedByDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.UpdatedByTime,0) = 0 OR matter.UpdatedByTime = 0 OR matter.UpdatedByTime > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.UpdatedByTime-36163 as DateTime),106) END AS FormattedUpdatedByTime"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.TBDate,0) = 0 OR matter.TBDate = 0 OR matter.TBDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.TBDate-36163 as DateTime),106) END AS FormattedTBDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.TBNTUDate,0) = 0 OR matter.TBNTUDate = 0 OR matter.TBNTUDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.TBNTUDate-36163 as DateTime),106) END AS FormattedTBNTUDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.NTURequestDate,0) = 0 OR matter.NTURequestDate = 0 OR matter.NTURequestDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.NTURequestDate-36163 as DateTime),106) END AS FormattedNTURequestDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.NTUReceiveDate,0) = 0 OR matter.NTUReceiveDate = 0 OR matter.NTUReceiveDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.NTUReceiveDate-36163 as DateTime),106) END AS FormattedNTUReceiveDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.CancelToReassignDate,0) = 0 OR matter.CancelToReassignDate = 0 OR matter.CancelToReassignDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.CancelToReassignDate-36163 as DateTime),106) END AS FormattedCancelToReassignDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(matter.LastStageDate,0) = 0 OR matter.LastStageDate = 0 OR matter.LastStageDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(matter.LastStageDate-36163 as DateTime),106) END AS FormattedLastStageDate"))


			->addselect(DB::raw("CASE WHEN ISNULL(matter.UpdatedByTime,0) = 0 OR matter.UpdatedByTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(matter.UpdatedByTime * 10) ,0),108) END AS FormattedUpdatedByTime"))

			return $query;
		}


-------------------------------------------
		if ($TableName == 'matter') {

			$classFileContent .= $this->addDateMutation('PrescriptionDate');
			$classFileContent .= $this->addDateMutation('DateInstructed');
			$classFileContent .= $this->addDateMutation('InterestFrom');
			$classFileContent .= $this->addDateMutation('LastInvoiceDate');
			$classFileContent .= $this->addDateMutation('LODDate');
			$classFileContent .= $this->addDateMutation('SummonsDate');
			$classFileContent .= $this->addDateMutation('ReturnOfServiceDate');
			$classFileContent .= $this->addDateMutation('RDJDate');
			$classFileContent .= $this->addDateMutation('JudgmentDate');
			$classFileContent .= $this->addDateMutation('WritDate');
			$classFileContent .= $this->addDateMutation('S65Date');
			$classFileContent .= $this->addDateMutation('TotalConsolidatedMatters');
			$classFileContent .= $this->addDateMutation('InterestEndDate');
			$classFileContent .= $this->addDateMutation('EMODate');
			$classFileContent .= $this->addDateMutation('DateOfDebt');
			$classFileContent .= $this->addDateMutation('StorageDate');
			$classFileContent .= $this->addDateMutation('StorageTakenOutDate');
			$classFileContent .= $this->addDateMutation('StorageReturnDate');
			$classFileContent .= $this->addDateMutation('LastDebtorReceiptDate');
			$classFileContent .= $this->addDateMutation('LastClientReceiptDate');
			$classFileContent .= $this->addDateMutation('LastStatementDate');
			$classFileContent .= $this->addDateMutation('ArchiveDate');
			$classFileContent .= $this->addDateMutation('S57Date');
			$classFileContent .= $this->addDateMutation('DateWithDrawn');
			$classFileContent .= $this->addDateMutation('ReceiptPercentToDate');
			$classFileContent .= $this->addDateMutation('ImportantDate');
			$classFileContent .= $this->addDateMutation('UpdatedByDate');
			$classFileContent .= $this->addDateMutation('UpdatedByTime');
			$classFileContent .= $this->addDateMutation('TBDate');
			$classFileContent .= $this->addDateMutation('TBNTUDate');
			$classFileContent .= $this->addDateMutation('NTURequestDate');
			$classFileContent .= $this->addDateMutation('NTUReceiveDate');
			$classFileContent .= $this->addDateMutation('CancelToReassignDate');
			$classFileContent .= $this->addDateMutation('LastStageDate');
			$classFileContent .= $this->addTimeMutation('UpdatedByTime');

		}
