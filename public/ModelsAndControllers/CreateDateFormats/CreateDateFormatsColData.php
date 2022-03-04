		public static function DefaultColDataSelectBuilder(&$query)
		{

			$query->addselect("ColData.*")
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.AODDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.AODDate-36163 as DateTime),106) END AS FormattedAODDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOInterestTo,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOInterestTo-36163 as DateTime),106) END AS FormattedEMOInterestTo"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.CCJInterestTo,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.CCJInterestTo-36163 as DateTime),106) END AS FormattedCCJInterestTo"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.CCJInterestFrom,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.CCJInterestFrom-36163 as DateTime),106) END AS FormattedCCJInterestFrom"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOInterestFrom,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOInterestFrom-36163 as DateTime),106) END AS FormattedEMOInterestFrom"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.ChequeDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.ChequeDate-36163 as DateTime),106) END AS FormattedChequeDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMODate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMODate-36163 as DateTime),106) END AS FormattedEMODate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOFirstDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOFirstDate-36163 as DateTime),106) END AS FormattedEMOFirstDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.JudgmentDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.JudgmentDate-36163 as DateTime),106) END AS FormattedJudgmentDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.LODDateToRespond,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.LODDateToRespond-36163 as DateTime),106) END AS FormattedLODDateToRespond"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.R41LastDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.R41LastDate-36163 as DateTime),106) END AS FormattedR41LastDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.R41NewDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.R41NewDate-36163 as DateTime),106) END AS FormattedR41NewDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.RDJInterestFromDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.RDJInterestFromDate-36163 as DateTime),106) END AS FormattedRDJInterestFromDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.MOVSaleDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.MOVSaleDate-36163 as DateTime),106) END AS FormattedMOVSaleDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.IMMSaleDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.IMMSaleDate-36163 as DateTime),106) END AS FormattedIMMSaleDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.S57InterestFrom,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S57InterestFrom-36163 as DateTime),106) END AS FormattedS57InterestFrom"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.S57InterestTo,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S57InterestTo-36163 as DateTime),106) END AS FormattedS57InterestTo"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.S57FirstPaymentDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S57FirstPaymentDate-36163 as DateTime),106) END AS FormattedS57FirstPaymentDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.S65Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S65Date-36163 as DateTime),106) END AS FormattedS65Date"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.S65FirstPaymentDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S65FirstPaymentDate-36163 as DateTime),106) END AS FormattedS65FirstPaymentDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.S65InterestFrom,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S65InterestFrom-36163 as DateTime),106) END AS FormattedS65InterestFrom"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.S65InterestTo,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S65InterestTo-36163 as DateTime),106) END AS FormattedS65InterestTo"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.WRIInterestTo,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.WRIInterestTo-36163 as DateTime),106) END AS FormattedWRIInterestTo"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.REWRIInterestTo,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REWRIInterestTo-36163 as DateTime),106) END AS FormattedREWRIInterestTo"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.RES65InterestTo,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.RES65InterestTo-36163 as DateTime),106) END AS FormattedRES65InterestTo"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.REEMOInterestTo,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REEMOInterestTo-36163 as DateTime),106) END AS FormattedREEMOInterestTo"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.WRIInterestFrom,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.WRIInterestFrom-36163 as DateTime),106) END AS FormattedWRIInterestFrom"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.REWRIInterestFrom,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REWRIInterestFrom-36163 as DateTime),106) END AS FormattedREWRIInterestFrom"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.RES65InterestFrom,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.RES65InterestFrom-36163 as DateTime),106) END AS FormattedRES65InterestFrom"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.REEMOInterestFrom,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REEMOInterestFrom-36163 as DateTime),106) END AS FormattedREEMOInterestFrom"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.CourtDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.CourtDate-36163 as DateTime),106) END AS FormattedCourtDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.ApplicationDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.ApplicationDate-36163 as DateTime),106) END AS FormattedApplicationDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.PaymentDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.PaymentDate-36163 as DateTime),106) END AS FormattedPaymentDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.LastInstallmentDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.LastInstallmentDate-36163 as DateTime),106) END AS FormattedLastInstallmentDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.NextInstallmentDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.NextInstallmentDate-36163 as DateTime),106) END AS FormattedNextInstallmentDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.PTPStartDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.PTPStartDate-36163 as DateTime),106) END AS FormattedPTPStartDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.NewInDuplumRuleFromDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.NewInDuplumRuleFromDate-36163 as DateTime),106) END AS FormattedNewInDuplumRuleFromDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOReturnOfServiceDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOReturnOfServiceDate-36163 as DateTime),106) END AS FormattedEMOReturnOfServiceDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.REEMOReturnOfServiceDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REEMOReturnOfServiceDate-36163 as DateTime),106) END AS FormattedREEMOReturnOfServiceDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOEndDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOEndDate-36163 as DateTime),106) END AS FormattedEMOEndDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.FeesUntilDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.FeesUntilDate-36163 as DateTime),106) END AS FormattedFeesUntilDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.CommissionUntilDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.CommissionUntilDate-36163 as DateTime),106) END AS FormattedCommissionUntilDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.LastPaymentDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.LastPaymentDate-36163 as DateTime),106) END AS FormattedLastPaymentDate"))
			->addselect(DB::raw("CASE WHEN ISNULL(ColData.NextPaymentDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.NextPaymentDate-36163 as DateTime),106) END AS FormattedNextPaymentDate"))

			return $query;
		}


-------------------------------------------
		if ($TableName == 'ColData') {

			$classFileContent .= $this->addDateMutation('aoddate');
			$classFileContent .= $this->addDateMutation('emointerestto');
			$classFileContent .= $this->addDateMutation('ccjinterestto');
			$classFileContent .= $this->addDateMutation('ccjinterestfrom');
			$classFileContent .= $this->addDateMutation('emointerestfrom');
			$classFileContent .= $this->addDateMutation('chequedate');
			$classFileContent .= $this->addDateMutation('emodate');
			$classFileContent .= $this->addDateMutation('emofirstdate');
			$classFileContent .= $this->addDateMutation('judgmentdate');
			$classFileContent .= $this->addDateMutation('loddatetorespond');
			$classFileContent .= $this->addDateMutation('r41lastdate');
			$classFileContent .= $this->addDateMutation('r41newdate');
			$classFileContent .= $this->addDateMutation('rdjinterestfromdate');
			$classFileContent .= $this->addDateMutation('movsaledate');
			$classFileContent .= $this->addDateMutation('immsaledate');
			$classFileContent .= $this->addDateMutation('s57interestfrom');
			$classFileContent .= $this->addDateMutation('s57interestto');
			$classFileContent .= $this->addDateMutation('s57firstpaymentdate');
			$classFileContent .= $this->addDateMutation('s65date');
			$classFileContent .= $this->addDateMutation('s65firstpaymentdate');
			$classFileContent .= $this->addDateMutation('s65interestfrom');
			$classFileContent .= $this->addDateMutation('s65interestto');
			$classFileContent .= $this->addDateMutation('wriinterestto');
			$classFileContent .= $this->addDateMutation('rewriinterestto');
			$classFileContent .= $this->addDateMutation('res65interestto');
			$classFileContent .= $this->addDateMutation('reemointerestto');
			$classFileContent .= $this->addDateMutation('wriinterestfrom');
			$classFileContent .= $this->addDateMutation('rewriinterestfrom');
			$classFileContent .= $this->addDateMutation('res65interestfrom');
			$classFileContent .= $this->addDateMutation('reemointerestfrom');
			$classFileContent .= $this->addDateMutation('courtdate');
			$classFileContent .= $this->addDateMutation('applicationdate');
			$classFileContent .= $this->addDateMutation('paymentdate');
			$classFileContent .= $this->addDateMutation('lastinstallmentdate');
			$classFileContent .= $this->addDateMutation('nextinstallmentdate');
			$classFileContent .= $this->addDateMutation('ptpstartdate');
			$classFileContent .= $this->addDateMutation('newinduplumrulefromdate');
			$classFileContent .= $this->addDateMutation('emoreturnofservicedate');
			$classFileContent .= $this->addDateMutation('reemoreturnofservicedate');
			$classFileContent .= $this->addDateMutation('emoenddate');
			$classFileContent .= $this->addDateMutation('feesuntildate');
			$classFileContent .= $this->addDateMutation('commissionuntildate');
			$classFileContent .= $this->addDateMutation('lastpaymentdate');
			$classFileContent .= $this->addDateMutation('nextpaymentdate');

		}
