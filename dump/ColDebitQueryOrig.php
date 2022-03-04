<?php
	$query = " SELECT '' AS 'Date','Opening Balance' as Description,'' as Type,DebtorsOpeningBalance as Amount,0 as RecordID,-1 as 'ColDebitDate', '' as Sorter";
	$query .= " FROM Matter WHERE RecordID =" . $_REQUEST['MatterID'];
	$query .= " UNION";
	$query .= " SELECT CASE WHEN Date > 0 THEN CONVERT(VarChar(10),CAST(Date-36163 as SmallDateTime),103) ELSE '' END as ' Date',";
	$query .= " ColDebit.Description,";
	$query .= " CASE WHEN Type = 'P' AND Category = 'P' THEN 'Payment' ";
	$query .= " WHEN Type = 'P' AND Category = 'J' THEN 'Journal' ";
	$query .= " WHEN Type = 'A' THEN 'Balance' ";
	$query .= " WHEN Type = 'I' OR Type = 'J' THEN 'Interest' ";
	$query .= " WHEN Type = 'V' THEN 'Employer''s Commission' ";
	$query .= " WHEN Type = 'X' OR Type = 'W' THEN 'Commission' ";
	$query .= " WHEN Category = 'C' THEN 'Fee' ";
	$query .= " WHEN Category = 'O' THEN 'Other' ";
	$query .= " WHEN Category = 'A' THEN 'Admin Fee' ";
	$query .= " WHEN Category = 'S' THEN 'Sheriffs Fee' ";
	$query .= " WHEN Category = 'T' THEN 'Tracing Fee' ";
	$query .= " WHEN Category = 'R' THEN 'Revenue Stamp' ";
	$query .= " WHEN Category = 'P' THEN 'Postage' ";
	$query .= " WHEN Category = 'J' THEN 'Journal' ";
	$query .= " ELSE 'Unknown' END as ' Type',";
	$query .= " CASE WHEN Type = 'P' OR Type = 'V' THEN -(ColDebit.Amount + ColDebit.VatAmount) ELSE ColDebit.Amount + ColDebit.VatAmount END as ' Amount' ,";
	$query .= " ColDebit.RecordID,ColDebit.Date as 'ColDebitDate', Type as Sorter";
	$query .= " FROM ColDebit";
	$query .= " JOIN Matter ON ColDebit.MatterID = Matter.RecordID";
	$query .= " WHERE ColDebit.MatterID = " . $_REQUEST['MatterID'];
	$query .= " ORDER BY ColDebitDate, Sorter, RecordID ";
?>