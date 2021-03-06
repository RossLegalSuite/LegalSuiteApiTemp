SetColDebitTotals    PROCEDURE  (<TheMatterID>,<CalculatePaymentPlanFlag>,<TheInterestDate>,<StartingDate>) ! Declare Procedure

LOC:InDuplumOption  BYTE
LOC:InterestMaxed   BYTE
LOC:FeesMaxed       BYTE
LOC:CommissionMaxed BYTE
LOC:FeesLimit       BYTE
LOC:CommissionLimit BYTE
LOC:Counter         LONG
LOC:StartingFrom    LONG
LOC:Date            LONG
LOC:TheDay          LONG
LOC:TheMonth        LONG
LOC:TheYear         LONG
LOC:MonthCounter    LONG
LOC:YearCounter     LONG
LOC:MonthOverFlow   LONG
PREV:Balance        DECIMAL(13,2)
LOC:FinalPayment    DECIMAL(13,2)
LOC:FinalCommission DECIMAL(13,2)
LOC:CollCommPerc    DECIMAL(13,2)
SAV:PaymentAmount   DECIMAL(13,2)
LOC:CommissionPercent   DECIMAL(13,2)
LOC:GrossPayment    DECIMAL(13,2)
LOC:AmountInclVatAvailable    DECIMAL(13,2)
LOC:BalanceLeftOver           DECIMAL(13,2)
LOC:ReduceCostsFlag        BYTE
LOC:DebtorsTotalCosts      DECIMAL(13,2)
LOC:DebtorsTotalCommission DECIMAL(13,2)
LOC:DebtorsTotalInterest   DECIMAL(13,2)
LOC:DebtorsTotalDebits     DECIMAL(13,2)
LOC:DebtorsTotalCredits    DECIMAL(13,2)
LOC:DebtorsTotalReceipts   DECIMAL(13,2)

PREVIOUS:DebtorsTotalInterest   DECIMAL(13,2)
PREVIOUS:DebtorsTotalCosts      DECIMAL(13,2)
PREVIOUS:DebtorsTotalCommission DECIMAL(13,2)

LOC:InDuplumMaxed               BYTE

LOC:FromDate                   LONG
LOC:NoOfDays                   LONG

LOC:EndOfYearDate              LONG
LOC:InterestCapitalDifference  DECIMAL(13,2)
LOC:NewAmountToReduceCapitalBy DECIMAL(13,2)
LOC:AmountToReduceInterestBy   DECIMAL(13,2)
LOC:TheCapitalAmount           DECIMAL(13,2)
LOC:TotalCapitalBalance   DECIMAL(13,2) ! USING THIS NOW BECAUSE THE USER CAN INCREASE THE CAPITAL VIA A JOURNAL ENTRY  15/1/2010

LOC:DaysInTheYear          SHORT

LOC:MonthEndFlag           BYTE
LOC:ThisMonthsInterest     DECIMAL(13,2)
LOC:AmountToReduceCostsBy  DECIMAL(13,2)
SAV:CDQ:Amount             DECIMAL(13,2)

LOC:SavedDate            LONG
LOC:TheNextInterestDate          LONG
LOC:Commission           DECIMAL(13,5)

LOC:CalculateInterestOn  DECIMAL(13,2)
LOC:ThisInterestDate     DATE

LOC:PeriodFromDate      LONG
LOC:PeriodToDate        LONG

LOC:BreakLoop           BYTE
LOC:TimerStamp          LONG

LOC:MonthEndDate           LONG

LOC:InterestFromDate        LONG
LOC:InterestToDate          LONG

LOC:AmountToReduceCapitalBy  DECIMAL(13,2)
LOC:CurrentDate              LONG

LOC:InDuplumAmount          DECIMAL(13,2)
LOC:InDuplumFlag            BYTE
LOC:NextScheduleDate        LONG
LOC:VatRate              DECIMAL(13,2)
LOC:ThisDayOnlyFlag      BYTE

Balances           GROUP,PRE(LOC)
CostBalance           DECIMAL(13,2)
InterestBalance       DECIMAL(13,2)
RunningCapitalBalance DECIMAL(13,2)
Balance               DECIMAL(13,2)

DuringTheMonthInterest  DECIMAL(13,2)
LastInterestBalance DECIMAL(13,2)
Interest            DECIMAL(13,2)
Days                LONG
LastInterestDate    LONG
                  END


GetControlFile()


IF CalculatePaymentPlanFlag

   DO ReCalculateEverything


ELSE

   IF TheMatterID

      MAT:RecordID = TheMatterID
      IF ~Access:Matter.Fetch(MAT:PrimaryKey)

            CLEAR(COL:Record)
            COL:MatterID = MAT:RecordID
            IF Access:ColData.Fetch(COL:MatterKey) THEN DO ProcedureReturn.

            DO ReCalculateEverything


            IF Access:Matter.Update()
               MESSAGE('Unable to Update the totals for this Matter - ' & MAT:FileRef & '||Error = ' & ERROR(),'Error updating Matter',ICON:Exclamation)
            END


      ELSE

         MESSAGE('Error received trying to get the Matter (' & CLIP(LEFT(FORMAT(TheMatterID,@n_7))) & ') while calulating Debtor Totals: ' & ERROR(),'SetColDebitTotals',ICON:Exclamation)

      END

   END
END
DO ProcedureReturn



ReCalculateEverything        ROUTINE

   SETCURSOR(CURSOR:WAIT)

   LOC:TotalCapitalBalance = MAT:InterestOnAmount
   IF ~LOC:TotalCapitalBalance THEN LOC:TotalCapitalBalance = MAT:DebtorsOpeningBalance.

   LOC:InDuplumMaxed = 0
   LOC:InterestMaxed = 0
   LOC:FeesMaxed = 0
   LOC:CommissionMaxed = 0
   LOC:FeesLimit = 0
   LOC:CommissionLimit = 0


   IF COL:OverrideInDuplumSetting
      LOC:InDuplumOption = COL:InDuplumOption
   ELSE
      LOC:InDuplumOption = CTL:InDuplumOption
   END



! NEED THIS TO CHECK IF THE ENTRIES IN THE PAYMENT PLAN ARE IN DUPLUM

IF CalculatePaymentPlanFlag           ! ADDED BY RICK 25/9/2013

    PROPSQLNext('SELECT SUM(Amount + VatAmount) FROM ColDebit Where Type IN (''D'') AND MatterID = ' & MAT:RecordID)
    LOC:DebtorsTotalCosts = ROW:Counter
    PREVIOUS:DebtorsTotalCosts = LOC:DebtorsTotalCosts

    PROPSQLNext('SELECT SUM(Amount + VatAmount) FROM ColDebit Where Type IN (''X'',''W'') AND MatterID = ' & MAT:RecordID)
    LOC:DebtorsTotalCommission = ROW:Counter
    PREVIOUS:DebtorsTotalCommission = LOC:DebtorsTotalCommission

    PROPSQLNext('SELECT SUM(Amount)FROM ColDebit Where Type IN (''I'',''J'') AND MatterID = ' & MAT:RecordID)
    LOC:DebtorsTotalInterest = ROW:Counter
    PREVIOUS:DebtorsTotalInterest = LOC:DebtorsTotalInterest

END

IF CalculatePaymentPlanFlag = 1 OR CalculatePaymentPlanFlag = 3 OR CalculatePaymentPlanFlag = 5 OR CalculatePaymentPlanFlag = 6

    DO CalculateMonthlyPaymentPlan

ELSIF CalculatePaymentPlanFlag = 2 OR CalculatePaymentPlanFlag = 4

    DO CalculateWeeklyPaymentPlan

ELSE


    CLEAR(CDQ:ColDebitQueue)
    FREE(CDQ:ColDebitQueue)

    DO ReadTransactions

END
SETCURSOR


IF GLO:DebuggingFlag
MESSAGE('Finished Recalculation of Debtors Totals','Debugging',ICON:Exclamation)
END


ReadTransactions  ROUTINE


IF CTL:SaveColDebitTransactionsFlag ! SOME USERS  (BAYPORT) WANT THE INTEREST AND COLLCOMM TRANSACTIONS SAVED SO THEY CAN USE THE DATA

    PROPSQL('DELETE ColDebit WHERE (Type = ''I'' OR Type = ''V'' OR Type = ''X'') AND MatterID = ' & MAT:RecordID,'SetColDebitTotals')  ! DELETE ALL SO WE CAN RE-ADD THEM

END


LOC:TimerStamp = 0
CLEAR(CD1:Record)
CD1:MatterID = MAT:RecordID
SET(CD1:MatterKey,CD1:MatterKey)
LOOP UNTIL  Access:ColDebitAlias.Next()
        IF ~(CD1:MatterID = MAT:RecordID) THEN BREAK.

        IF MAT:ExcludeDocumentCostsFlag AND CD1:DocumentCode THEN CYCLE.

        IF INLIST(CD1:Type,'V','X','I') THEN CYCLE.  ! THESE ARE VIRTUAL TRANSACTIONS
                                                    ! THEY WILL EVENTUALLY FALL AWAY

        CDQ:RecordID = CD1:RecordID
        CDQ:Date = CD1:Date
        CDQ:Type = CD1:Type
        CDQ:Category = CD1:Category
        CDQ:Description = CD1:Description
        CDQ:TotalAmount = CD1:Amount + CD1:VatAmount
        CDQ:Amount = CD1:Amount
        CDQ:VatAmount = CD1:VatAmount
        CDQ:VatFlag = CD1:VatFlag
        CDQ:MatterID = CD1:MatterID
        CDQ:CollCommFlag = CD1:CollCommFlag
        CDQ:OverrideEMOCommFlag = CD1:OverrideEMOCommFlag
        CDQ:DocumentCode = CD1:DocumentCode
        CDQ:EmployeeName = ''

        IF CDQ:Type = 'P' OR CDQ:Type = 'W' OR CDQ:Category = 'J' !FB 905 - adding W (Manual Commission)
            LOC:TimerStamp += 10       ! PUT CAPITAL ADJUSTMENTS AT THE END AND ALLOW COLL COMM TO BE JUST AFTER IT
            CDQ:TimerStamp = LOC:TimerStamp
        ELSIF CDQ:Type = 'J'          ! INTEREST AT THE BEGINNING
            CDQ:TimerStamp = 0
        ELSE
            CDQ:TimerStamp = 1         ! COSTS
        END

        ADD(CDQ:ColDebitQueue,CDQ:Date,CDQ:TimerStamp)


        !LOC:VatRate = SetCurrentVatRate(CDQ:Date)


        IF CDQ:Type = 'P' AND CDQ:Category <> 'J'

            SAV:PaymentAmount = CDQ:Amount

            DO AddEmployerCommissionRecord

            IF CDQ:CollCommFlag
                DO AddCommissionRecord
            END

        END


END


LOC:InterestFromDate = MAT:InterestFrom

IF ~GLO:TodaysDate THEN GLO:TodaysDate = TODAY().  ! NEEDED BY UPDATEDEBTORTOTALS.EXE
LOC:InterestToDate = GLO:TodaysDate

! OVERRIDE 
IF MAT:InterestEndDate AND MAT:InterestEndDate < LOC:InterestToDate THEN LOC:InterestToDate = MAT:InterestEndDate.

! OVERRIDE
IF TheInterestDate THEN LOC:InterestToDate = TheInterestDate.  ! THIS PROCEDURE CAN CALCULATE THE BALANCE UP TO A CERTAIN DATE


DO InsertInterestTransactions

DO CalculateBalances



InsertInterestTransactions   ROUTINE


IF ~LOC:InterestFromDate THEN EXIT.
IF ~LOC:InterestToDate THEN EXIT.

IF LOC:InterestFromDate >= LOC:InterestToDate THEN EXIT.

LOC:LastInterestDate = LOC:InterestFromDate
LOC:BreakLoop = False

LOOP 
        IF MONTH(LOC:LastInterestDate) = 12
            LOC:MonthEndDate = DATE(12,31,YEAR(LOC:LastInterestDate))   ! FIND THE END OF THE MONTH
        ELSE
            LOC:MonthEndDate = DATE(MONTH(LOC:LastInterestDate)+1,1,YEAR(LOC:LastInterestDate))-1   ! FIND THE END OF THE MONTH
        END

        LOC:ThisInterestDate = LOC:MonthEndDate

        LOC:PeriodFromDate = LOC:LastInterestDate
        LOC:PeriodToDate =  LOC:MonthEndDate

        DO CheckTheInterestForThisPeriod

        IF MAT:IntRateScheduleID   ! CHECK TO SEE IF THERE IS AN INTEREST RATE DURING THIS PERIOD
            LOC:NextScheduleDate = GetNextScheduleDate(LOC:PeriodFromDate)
            IF LOC:NextScheduleDate AND LOC:NextScheduleDate < LOC:ThisInterestDate
            LOC:ThisInterestDate = LOC:NextScheduleDate
            END
        END

        IF LOC:ThisInterestDate > LOC:InterestToDate

            LOC:ThisInterestDate = LOC:InterestToDate
            LOC:BreakLoop = True
        END



        DO AddInteresttoCDQ:ColDebitQueue

        IF LOC:BreakLoop THEN BREAK.

        LOC:LastInterestDate = LOC:ThisInterestDate + 1
        IF LOC:LastInterestDate > LOC:InterestToDate THEN BREAK.

END

CheckTheInterestForThisPeriod     ROUTINE

CLEAR(CDQ:ColDebitQueue)
SORT(CDQ:ColDebitQueue,CDQ:Date)
If ErrorCode() Then Message('ERROR: ' & ErrorCode() & ' ' & Error()).
CDQ:Date = LOC:PeriodFromDate
Z# = POSITION(CDQ:ColDebitQueue)

MESSAGE('Check Period (' & FORMAT(LOC:PeriodFromDate,@D6) & ' - ' & FORMAT(LOC:PeriodtoDate,@D6) & ') for any Interest bearing transactions')

LOOP Y# = Z# TO RECORDS(CDQ:ColDebitQueue)

    GET(CDQ:ColDebitQueue,Y#)
    IF ERRORCODE() THEN BREAK.

    IF CDQ:Date > LOC:PeriodToDate  ! LOOP THROUGH THIS PERIOD ONLY
        BREAK
    END


    ! IF THERE ARE ANY TRANSACTIONS THAT MAY CHANGE THE CAPITAL BALANCE
    ! E.G. A PAYMENT OR A JOURNAL ENTRY
    ! THEN ADJUST THE INTEREST TO DATE TO INSERT INTEREST JUST BEFORE THIS TRANSACTION
    ! SO THAT FURTHER INTEREST IS CALCULATED ON THE NEW CAPITAL BALANCE.

    IF CDQ:Type = 'P' OR CDQ:Category = 'J' OR (MAT:InterestOnCostsFlag AND CDQ:Type = 'D') ! PAYMENT OR JOURNAL OR COST (IF INTEREST ON COSTS)
        IF CDQ:Date >= LOC:InterestFromDate AND CDQ:Date <= LOC:InterestToDate  ! IF THIS IS DURING THE INTEREST DATE RANGE
            LOC:ThisInterestDate = CDQ:Date
            BREAK
        END
    END

END





AddInteresttoCDQ:ColDebitQueue    ROUTINE

    // TRY AND COMBINE MANY INTEREST TRANS INTO ONE TO SAVE SPACE
    IF ~MAT:InterestCompoundedFlag  

        CLEAR(CDQ:ColDebitQueue)
        SORT(CDQ:ColDebitQueue,CDQ:Date)
        If ErrorCode() Then Message('ERROR: ' & ErrorCode() & ' ' & Error()).
        CDQ:Date = LOC:ThisInterestDate              ! FIND THE NEXT TRANSACTION
        Z# = POSITION(CDQ:ColDebitQueue)             ! STORE IT IN LOC:TheNextInterestDate
        GET(CDQ:ColDebitQueue,Z#)
        IF ~ERROR()
            LOC:TheNextInterestDate = CDQ:Date
        ELSE
            LOC:TheNextInterestDate = LOC:InterestToDate
        END


        IF MAT:IntRateScheduleID
            LOC:NextScheduleDate = GetNextScheduleDate(LOC:LastInterestDate)
            IF LOC:NextScheduleDate < LOC:TheNextInterestDate

            LOC:TheNextInterestDate = LOC:NextScheduleDate

            END
        END


        IF LOC:TheNextInterestDate > LOC:InterestToDate THEN LOC:TheNextInterestDate = LOC:InterestToDate.



        IF LOC:TheNextInterestDate - LOC:LastInterestDate > 62     ! IF THERE IS A LONG WAY TO GO TO THE NEXT TRANSACTION


            IF ~LOC:SavedDate THEN LOC:SavedDate = LOC:LastInterestDate.  ! DON'T BOTHER INSERTING THE INTEREST YET - SAVE THE DATE AND EXIT
            EXIT


        END

    END




    CLEAR(CDQ:ColDebitQueue)
    CDQ:MatterID = MAT:RecordID
    CDQ:Date = LOC:ThisInterestDate

    CDQ:Type = 'I'
    CDQ:Category = 'I'
    CDQ:TranType = 'Interest'

    CDQ:InterestRate = GetCurrentInterestRate(LOC:ThisInterestDate)
    IF LOC:SavedDate
        CDQ:LastInterestDate = LOC:SavedDate
        LOC:SavedDate = 0
    ELSE
        CDQ:LastInterestDate = LOC:LastInterestDate
    END
    CDQ:TimerStamp = 0    ! INTEREST AT THE BEGINNING
    CDQ:EmployeeName = 'System'
    ADD(CDQ:ColDebitQueue,CDQ:Date,CDQ:Timerstamp)



CalculateBalances     ROUTINE


CLEAR(Balances)

CLEAR(LOC:DebtorsTotalCosts)               ! Total Costs (Fees and Disbursements) (does not include Collection Commission, Interest, and Cost Journal Adjustments)
CLEAR(LOC:DebtorsTotalCommission)          ! Total Collection Commission
CLEAR(LOC:DebtorsTotalInterest)            ! Total Interest charged
CLEAR(LOC:DebtorsTotalDebits)              ! Total Cost Journal Adjustments (Manually inserted cost Adjustments)
CLEAR(LOC:DebtorsTotalCredits)             ! Total Payment Journal Adjustments (Manually inserted Payment Adjustments)
CLEAR(LOC:DebtorsTotalReceipts)            ! Total Receipts to date (does not include Payment Journal Adjustments)

IF MAT:InterestOnAmount
    LOC:CostBalance = MAT:DebtorsOpeningBalance - MAT:InterestOnAmount
END

LOC:RunningCapitalBalance = MAT:InterestOnAmount
IF ~LOC:RunningCapitalBalance THEN LOC:RunningCapitalBalance = MAT:DebtorsOpeningBalance.

DO AddOpeningBalance

LOOP Y# = 1 TO RECORDS(CDQ:ColDebitQueue)

    GET(CDQ:ColDebitQueue,Y#)
    IF ERRORCODE() THEN BREAK.

    DO AdjustTheBalances

END

MAT:DebtorsTotalCosts       = LOC:DebtorsTotalCosts
MAT:DebtorsTotalCommission  = LOC:DebtorsTotalCommission
MAT:DebtorsTotalInterest    = LOC:DebtorsTotalInterest
MAT:DebtorsTotalDebits      = LOC:DebtorsTotalDebits
MAT:DebtorsTotalCredits     = LOC:DebtorsTotalCredits
MAT:DebtorsTotalReceipts    = LOC:DebtorsTotalReceipts


MAT:DebtorsCapitalBalance  = LOC:RunningCapitalBalance
MAT:DebtorsCostsBalance    = LOC:CostBalance
MAT:DebtorsInterestBalance = LOC:InterestBalance
MAT:DebtorsBalance = LOC:InterestBalance + LOC:CostBalance + LOC:RunningCapitalBalance


AddEmployerCommissionRecord        ROUTINE

    IF CDQ:OverrideEMOCommFlag THEN EXIT.


    LOC:Commission = GetEmployerCommAmount(MAT:RecordID,SAV:PaymentAmount,CDQ:Date)

    IF LOC:Commission

        CDQ:Type = 'V'
        CDQ:Category = 'P'
        CDQ:TranType = 'Employer'
        CDQ:Amount = LOC:Commission
        CDQ:TotalAmount = CDQ:Amount 

        LOC:GrossPayment = Round(  ((SAV:PaymentAmount*100)/(100 - COL:EMOCommissionPercent))  ,.01)

        IF MAT:DocumentLanguageID = CTL:AfrikaansID
            CDQ:Description = 'Werkgewerskommissie van ' & CLIP(LEFT(FORMAT(COL:EMOCommissionPercent,@n_9.4~%~))) & ' op '& GLO:CurrencySymbol & CLIP(LEFT(FORMAT(LOC:GrossPayment,@n-15.2)))
        ELSE
            CDQ:Description = 'Employer''s Commission of ' & CLIP(LEFT(FORMAT(COL:EMOCommissionPercent,@n_9.4~%~))) & ' on '& GLO:CurrencySymbol & CLIP(LEFT(FORMAT(LOC:GrossPayment,@n-15.2)))
        END

        CDQ:Timerstamp = CDQ:TimerStamp + 1         ! JUST AFTER THE PAYMENT
        CDQ:EmployeeName = 'System'

        ADD(CDQ:ColDebitQueue,CDQ:Date,CDQ:TimerStamp)

        IF CalculatePaymentPlanFlag THEN DO AdjustTheBalances.

    END

AddCommissionRecord        ROUTINE

LOC:VatRate = SetCurrentVatRate(CDQ:Date)

LOC:Commission = GetCollCommAmount(MAT:RecordID,SAV:PaymentAmount,LOC:VatRate,CDQ:Date)

IF LOC:Commission
    CDQ:Type = 'X'                     ! MAKING COLLECTION COMMISSION = 'X' SO IT APPEARS AFTER PAYMENTS IN KEY ORDER
    CDQ:Category = 'X'
    CDQ:TranType = 'Commission'

    !RICK FB# 1521 -ROUNDING ISSUE WHEN SUBTRACTING THE VAT IN GET COLLCOMMAMOUNT

    CDQ:Amount = ROUND(LOC:Commission,.01)

    IF LOC:VatRate > 0
            CDQ:VatFlag = True

            !RICK FB# 1521 -ROUNDING ISSUE WHEN SUBTRACTING THE VAT IN GET COLLCOMMAMOUNT
            CDQ:VatAmount = ROUND(LOC:Commission * (LOC:VatRate / 100),.01)

    END

    CDQ:TotalAmount = CDQ:Amount + CDQ:VatAmount


    LOC:CommissionPercent = GetCollCommMatterPercent(CDQ:Date,MAT:RecordID)

    IF MAT:DocumentLanguageID = CTL:AfrikaansID
        CDQ:Description = 'Invorderingskommissie van ' & CLIP(LEFT(FORMAT(LOC:CommissionPercent,@n_9.2~%~))) & ' op '& GLO:CurrencySymbol & CLIP(LEFT(FORMAT(SAV:PaymentAmount,@n-15.2)))
    ELSE
        CDQ:Description = 'Collection Commission of ' & CLIP(LEFT(FORMAT(LOC:CommissionPercent,@n_9.2~%~))) & ' on '& GLO:CurrencySymbol & CLIP(LEFT(FORMAT(SAV:PaymentAmount,@n-15.2)))
    END

    CDQ:Timerstamp = CDQ:TimerStamp + 1         ! JUST AFTER THE PAYMENT
    CDQ:EmployeeName = 'System'

    ADD(CDQ:ColDebitQueue,CDQ:Date,CDQ:TimerStamp)

    IF CalculatePaymentPlanFlag THEN DO AdjustTheBalances.

END

AddOpeningBalance  ROUTINE

Clear(CDQ:ColDebitQueue)
CDQ:MatterID = MAT:RecordID
CDQ:Date = 0
IF MAT:DocumentLanguageID = CTL:AfrikaansID
    CDQ:Description = 'Balans'
ELSE
    CDQ:Description = 'Opening Balance'
END
CDQ:Type            = 'A'      ! GIVING ARBITARY CODE SO CAN DISPLAY MESSAGE IF USER TRIES TO DELETE
CDQ:TranType        = 'Balance'


CDQ:InterestBalance = LOC:InterestBalance
CDQ:CostBalance = LOC:CostBalance
CDQ:CapitalBalance = LOC:RunningCapitalBalance
CDQ:Balance = CDQ:CapitalBalance  + CDQ:CostBalance + CDQ:InterestBalance
CDQ:TotalAmount = CDQ:Balance

CDQ:TimerStamp = 0
CDQ:EmployeeName = 'System'
ADD(CDQ:ColDebitQueue,CDQ:Date,CDQ:TimerStamp)


SaveVirtualTransaction  ROUTINE

IF CTL:SaveColDebitTransactionsFlag AND ~CalculatePaymentPlanFlag

    CLEAR(CD1:Record)
    CD1:Date = CDQ:Date
    CD1:Type = CDQ:Type
    CD1:Category = CDQ:Category
    CD1:Description = CDQ:Description
    CD1:Amount = CDQ:Amount
    CD1:VatAmount = CDQ:VatAmount
    CD1:Amount = CDQ:Amount
    CD1:VatAmount = CDQ:VatAmount
    CD1:VatFlag = CDQ:VatFlag
    CD1:MatterID = CDQ:MatterID
    CD1:CollCommFlag = CDQ:CollCommFlag
    CD1:OverrideEMOCommFlag = CDQ:OverrideEMOCommFlag
    CD1:DocumentCode = CDQ:DocumentCode
    CD1:TimerStamp = CDQ:TimerStamp
    CD1:EmployeeID = 0
    CD1:ExportedFlag = 0


    ! ADDED BY RICK 1/5/2013 - WHY WEREN'T WE DOING THIS BEFORE. HELPS WITH LOL ETC.
    CD1:InterestBalance = LOC:InterestBalance
    CD1:CostBalance = LOC:CostBalance
    CD1:CapitalBalance = LOC:RunningCapitalBalance


    Access:ColDebitAlias.Insert

END



UpdateTransactionBalances  ROUTINE

IF CTL:SaveColDebitTransactionsFlag AND ~CalculatePaymentPlanFlag

    PROPSQL('UPDATE ColDebit SET InterestBalance = ' & LOC:InterestBalance & ', CostBalance = ' & LOC:CostBalance & ', CapitalBalance = ' & LOC:RunningCapitalBalance & ' WHERE RecordID = ' & CDQ:RecordID)

END


AdjustTheBalances    ROUTINE


    LOC:VatRate = SetCurrentVatRate(CDQ:Date)

    IF CDQ:Type = 'A'    ! OPENING BALANCE

        EXIT

    ELSIF CDQ:Type = 'D'    ! COST

        IF CDQ:Category = 'J'

            LOC:RunningCapitalBalance += CDQ:Amount + CDQ:VatAmount    ! JOURNALS NOW ADJUST THE CAPITAL BALANCE

            LOC:TotalCapitalBalance += CDQ:Amount + CDQ:VatAmount    ! JOURNALS NOW ADJUST THE CAPITAL BALANCE

            LOC:DebtorsTotalDebits += CDQ:Amount + CDQ:VatAmount

        ELSE

            !FB449
            IF LOC:FeesMaxed  OR LOC:FeesLimit

            CDQ:Amount = 0
            CDQ:VatAmount = 0

            ELSE

                !FB449
                IF COL:FeesUntilDate AND CDQ:Date > COL:FeesUntilDate
                    LOC:FeesLimit = true
                    CDQ:Amount = 0
                    CDQ:VatAmount = 0
                !END FB449
                ELSE

                        IF CDQ:Amount AND COL:MaxFees


                            IF LOC:DebtorsTotalCosts + CDQ:Amount + CDQ:VatAmount > COL:MaxFees

                                LOC:AmountInclVatAvailable = COL:MaxFees - LOC:DebtorsTotalCosts

                                IF LOC:VatRate

                                    CDQ:Amount = ROUND( (LOC:AmountInclVatAvailable * 100) / (100 + LOC:VatRate) ,.01)
                                    CDQ:VatAmount = LOC:AmountInclVatAvailable - CDQ:Amount

                                ELSE

                                    CDQ:Amount = LOC:AmountInclVatAvailable
                                    CDQ:VatAmount = 0

                                END

                                LOC:FeesMaxed = TRUE


                            END

                        END
                END
            END

            IF LOC:FeesMaxed

                CDQ:Description = '* ' & CDQ:Description & ' (Fee Limit)'

            END
            !FB449
            IF LOC:FeesLimit

                CDQ:Description = '* ' & CDQ:Description & ' (Fee Date Limit)'

            END
            !END FB449

            LOC:CostBalance += CDQ:Amount + CDQ:VatAmount

            DO AdjustCostsForInduplumRule      ! NEW: ITO THE NCA ACT

            LOC:DebtorsTotalCosts += CDQ:Amount + CDQ:VatAmount

        END

        DO UpdateTransactionBalances

    ELSIF CDQ:Type = 'W'    ! COLLECTION COMMISSION ADDED BY THE USER

        DO CheckIfCommissionMaxed

        LOC:CostBalance += CDQ:Amount + CDQ:VatAmount

        DO AdjustCostsForInduplumRule      ! NEW: ITO THE NCA ACT

        LOC:DebtorsTotalCommission += CDQ:Amount + CDQ:VatAmount

        DO UpdateTransactionBalances

    ELSIF CDQ:Type = 'X' 


        DO CheckIfCommissionMaxed


        LOC:CostBalance += CDQ:Amount + CDQ:VatAmount

        DO AdjustCostsForInduplumRule      ! NEW: ITO THE NCA ACT

        LOC:DebtorsTotalCommission += CDQ:Amount + CDQ:VatAmount

        DO SaveVirtualTransaction   ! SAVE THE COLDEBIT RECORD IF SETUP IN PROGRAM SETTINGS


    ELSIF CDQ:Type = 'J'    ! INTEREST MANUALLY INSERTED BY USER


        DO AdjustInterestForInduplumRule      ! NEW: ITO THE NCA ACT (USER MUST SET COL:NewInDuplumRuleFlag)

        LOC:InterestBalance += CDQ:Amount 

        LOC:DebtorsTotalInterest += CDQ:Amount

        DO UpdateTransactionBalances


    ELSIF CDQ:Type = 'V'   ! EMPLOYER'S COMMISSION

            LOC:DebtorsTotalReceipts += CDQ:Amount + CDQ:VatAmount

            DO ReduceTheBalances       ! EMPLOYER'S COMMISSION MUST BE TREATED AS A "PAYMENT" BY THE DEBTOR - EXCEPT IT GOES TO THE EMPLOYER AND NOT TO THE CLIENT

            DO SaveVirtualTransaction   ! SAVE THE COLDEBIT RECORD IF SETUP IN PROGRAM SETTINGS


    ELSIF CDQ:Type = 'P'   ! PAYMENT 

        IF CDQ:Category = 'J'                   ! A JOURNAL ENTRY

            LOC:RunningCapitalBalance -= CDQ:Amount + CDQ:VatAmount    ! JOURNALS NOW ADJUST THE CAPITAL BALANCE

            LOC:TotalCapitalBalance -= CDQ:Amount + CDQ:VatAmount      ! JOURNALS NOW ADJUST THE CAPITAL BALANCE
                        
            LOC:DebtorsTotalCredits += CDQ:Amount + CDQ:VatAmount

        ELSE

            LOC:DebtorsTotalReceipts += CDQ:Amount + CDQ:VatAmount

            DO ReduceTheBalances       ! IF ANYTHING WAS PAID BY THE DEBTOR - REDUCE THE CAPTITAL BALANCE

        END

        DO UpdateTransactionBalances

    ELSIF CDQ:Type = 'I'

        IF MONTH(CDQ:LastInterestDate) = 12
            LOC:MonthEndDate = DATE(12,31,YEAR(CDQ:LastInterestDate))   ! FIND THE END OF THE MONTH
        ELSE
            LOC:MonthEndDate = DATE(MONTH(CDQ:LastInterestDate)+1,1,YEAR(CDQ:LastInterestDate))-1   ! FIND THE END OF THE MONTH
        END

        IF CDQ:Date = LOC:MonthEndDate
            LOC:MonthEndFlag = 1
        ELSE
            LOC:MonthEndFlag = 0
        END

        LOC:CalculateInterestOn = LOC:RunningCapitalBalance           ! ADJUSTED BY REDUCE THE BALANCES

        IF MAT:InterestOnCostsFlag                             ! IF INTEREST ON COSTS
            LOC:CalculateInterestOn += LOC:CostBalance
        END

        IF MAT:InterestCompoundedFlag                          ! IF INTEREST IS COMPOUNDED
            LOC:CalculateInterestOn += LOC:InterestBalance
            LOC:CalculateInterestOn -= LOC:ThisMonthsInterest         ! ONLY CALCULATE STRAIGHT INTEREST DURING THE MONTH
        END

        IF LOC:CalculateInterestOn > 0 AND CDQ:InterestRate
            LOC:NoOfDays = CDQ:Date - CDQ:LastInterestDate + 1
            IF LOC:NoOfDays > 0 THEN
            CDQ:Amount = 0
            LOC:FromDate =  CDQ:LastInterestDate
            LOOP WHILE (YEAR(LOC:FromDate) < YEAR(CDQ:Date))
                LOC:EndOfYearDate = DATE(12,31,YEAR(LOC:FromDate))
                LOC:DaysInTheYear = 365
                IF IsALeapYear(LOC:FromDate)
                        LOC:DaysInTheYear = 366
                END
                LOC:NoOfDays = LOC:EndOfYearDate - LOC:FromDate + 1
                CDQ:Amount += ROUND((LOC:CalculateInterestOn * CDQ:InterestRate /100 * LOC:NoOfDays/LOC:DaysInTheYear),.01)
                LOC:FromDate = DATE(1,1,YEAR(LOC:FromDate)+1)
            END
            LOC:DaysInTheYear = 365
            IF IsALeapYear(LOC:FromDate)
                LOC:DaysInTheYear = 366
            END
            LOC:NoOfDays = CDQ:Date - LOC:FromDate + 1
            CDQ:Amount += ROUND((LOC:CalculateInterestOn * CDQ:InterestRate /100 * LOC:NoOfDays/LOC:DaysInTheYear),.01)
            END

            IF LOC:InterestMaxed 

                CDQ:Amount = 0

            ELSE

                DO AdjustInterestForInduplumRule      ! NEW: ITO THE NCA ACT (USER MUST SET COL:NewInDuplumRuleFlag)

            END


            IF CDQ:Amount AND COL:InterestEndAmount

                IF LOC:DebtorsTotalInterest + CDQ:Amount > COL:InterestEndAmount

                    CDQ:Amount = CDQ:Amount - ( (LOC:DebtorsTotalInterest + CDQ:Amount) - COL:InterestEndAmount)

                    IF CDQ:Amount < 0  THEN CDQ:Amount = 0.

                    LOC:InterestMaxed = TRUE


                END

            END

        END


        LOC:InterestBalance += CDQ:Amount
        LOC:DebtorsTotalInterest += CDQ:Amount


        IF LOC:CalculateInterestOn > 0 AND CDQ:InterestRate
            IF MAT:DocumentLanguageID = CTL:AfrikaansID
            CDQ:Description = 'Rente van ' & CLIP(LEFT(FORMAT(CDQ:InterestRate,@n_9.4~%~))) & ' op '& GLO:CurrencySymbol & CLIP(LEFT(FORMAT(LOC:CalculateInterestOn,@n-15.2))) & ' vanaf ' & FORMAT(CDQ:LastInterestDate,@D6) & ' tot ' & FORMAT(CDQ:Date,@D6)
            ELSE
            CDQ:Description = 'Interest at ' & CLIP(LEFT(FORMAT(CDQ:InterestRate,@n_9.4~%~))) & ' on '& GLO:CurrencySymbol & CLIP(LEFT(FORMAT(LOC:CalculateInterestOn,@n-15.2))) & ' from ' & FORMAT(CDQ:LastInterestDate,@D6) & ' to ' & FORMAT(CDQ:Date,@D6)
            END
        ELSE
            IF MAT:DocumentLanguageID = CTL:AfrikaansID
            CDQ:Description = 'Rente vanaf ' & FORMAT(CDQ:LastInterestDate,@D6) & ' tot ' & FORMAT(CDQ:Date,@D6)
            ELSE
            CDQ:Description = 'Interest from ' & FORMAT(CDQ:LastInterestDate,@D6) & ' to ' & FORMAT(CDQ:Date,@D6)
            END
        END

        IF LOC:InterestMaxed

            CDQ:Description = '* ' & CDQ:Description & ' (Interest Limit)'

        END



        IF LOC:InDuplumFlag OR LOC:InDuplumMaxed

            CDQ:Description = '# ' & CDQ:Description & ' (In Duplum)'
            LOC:InDuplumFlag = 0


        END

        IF MAT:InterestCompoundedFlag                          ! IF INTEREST IS COMPOUNDED
            IF LOC:MonthEndFlag = 1
            LOC:ThisMonthsInterest = 0
            ELSE
            LOC:ThisMonthsInterest += CDQ:Amount
            END                      
        END


        DO SaveVirtualTransaction   ! SAVE THE COLDEBIT RECORD IF SETUP IN PROGRAM SETTINGS

    END


    CDQ:TotalAmount = CDQ:Amount + CDQ:VatAmount

    CDQ:InterestBalance = LOC:InterestBalance
    CDQ:CostBalance = LOC:CostBalance
    CDQ:CapitalBalance = LOC:RunningCapitalBalance
    CDQ:Balance = CDQ:CapitalBalance  + CDQ:CostBalance + CDQ:InterestBalance
    PUT(CDQ:ColDebitQueue)

CheckIfCommissionMaxed  ROUTINE


    LOC:VatRate = SetCurrentVatRate(CDQ:Date)

    !FB449
    IF LOC:CommissionMaxed OR LOC:CommissionLimit

        CDQ:Amount = 0
        CDQ:VatAmount = 0

    ELSE

!jess
    !FB449
    IF COL:CommissionUntilDate AND CDQ:Date > COL:CommissionUntilDate
            LOC:CommissionLimit = true
            CDQ:Amount = 0
            CDQ:VatAmount = 0
    !END FB449
    ELSE
            IF CDQ:Amount AND (COL:MaxCommission OR MAT:DebtorCollCommLimit)
            IF LOC:DebtorsTotalCommission + CDQ:Amount + CDQ:VatAmount > COL:MaxCommission AND COL:MaxCommission
                LOC:AmountInclVatAvailable = COL:MaxCommission - LOC:DebtorsTotalCommission
                IF LOC:VatRate
                    CDQ:Amount = ROUND( (LOC:AmountInclVatAvailable * 100) / (100 + LOC:VatRate) ,.01)
                    CDQ:VatAmount = LOC:AmountInclVatAvailable - CDQ:Amount
                ELSE
                    CDQ:Amount = LOC:AmountInclVatAvailable
                    CDQ:VatAmount = 0
                END
                LOC:CommissionMaxed = TRUE
            END
            END
    END
    END
    IF LOC:CommissionMaxed

        CDQ:Description = '* ' & CDQ:Description & ' (Commission Limit)'

    END
    !FB449
    IF LOC:CommissionLimit

        CDQ:Description = '* ' & CDQ:Description & ' (Commission Date Limit)'

    END
    !END FB449



ReduceTheBalances    ROUTINE

        LOC:AmountToReduceCapitalBy = CDQ:Amount
        LOC:AmountToReduceCostsBy = 0
        LOC:ReduceCostsFlag = FALSE


        IF COL:ReceiptPercentToCostsFlag

            IF MAT:ReceiptPercentToDate

                IF CDQ:Date <= MAT:ReceiptPercentToDate

                    LOC:ReduceCostsFlag = TRUE

                END


            ELSE

                LOC:ReduceCostsFlag = TRUE


            END

        END

        IF LOC:ReduceCostsFlag

            LOC:AmountToReduceCostsBy = CDQ:Amount * MAT:ReceiptPercentToCosts/100
            

            LOC:AmountToReduceCapitalBy = CDQ:Amount - LOC:AmountToReduceCostsBy
            

        END

        DO ReduceCapitalBalance


        LOC:LastInterestBalance = LOC:InterestBalance


ReduceCapitalBalance    ROUTINE

            LOC:BalanceLeftOver = 0

            IF COL:ReduceCapitalFlag = 1 ! REDUCE THE CAPITAL AMOUNT FIRST AND THEN PAY OFF COSTS, THEN INTEREST.

            LOC:RunningCapitalBalance -= LOC:AmountToReduceCapitalBy
            IF LOC:RunningCapitalBalance < 0      
                LOC:CostBalance += LOC:RunningCapitalBalance
                LOC:RunningCapitalBalance = 0
                IF LOC:CostBalance < 0
                    LOC:InterestBalance += LOC:CostBalance
                    LOC:CostBalance = 0
                END
            END
            IF LOC:ReduceCostsFlag
                LOC:CostBalance -= LOC:AmountToReduceCostsBy
                IF LOC:CostBalance < 0
                    LOC:InterestBalance += LOC:CostBalance
                    LOC:CostBalance = 0                      
                END
            END


            ELSIF COL:ReduceCapitalFlag = 2 ! REDUCE THE INTEREST FIRST AND THEN PAY OFF COSTS, THEN CAPITAL.
            !FB 1630
            LOC:InterestBalance -= LOC:AmountToReduceCapitalBy
            IF LOC:InterestBalance < 0      
                LOC:CostBalance += LOC:InterestBalance
                LOC:InterestBalance = 0
                IF LOC:CostBalance < 0
                    LOC:RunningCapitalBalance+= LOC:CostBalance
                    LOC:CostBalance = 0
                END
            END

            IF LOC:ReduceCostsFlag
                LOC:CostBalance -= LOC:AmountToReduceCostsBy
                IF LOC:CostBalance < 0
                    LOC:RunningCapitalBalance += LOC:CostBalance
                    LOC:CostBalance = 0
                END
            END

            ELSIF COL:ReduceCapitalFlag = 3 ! REDUCE THE CAPITAL AMOUNT FIRST AND THEN INTEREST THEN COSTS.

            LOC:RunningCapitalBalance -= LOC:AmountToReduceCapitalBy
            IF LOC:RunningCapitalBalance < 0      
                LOC:InterestBalance += LOC:RunningCapitalBalance
                LOC:RunningCapitalBalance = 0
                IF LOC:InterestBalance < 0
                    LOC:CostBalance += LOC:InterestBalance
                    LOC:InterestBalance = 0
                END
            END

            IF LOC:ReduceCostsFlag

                LOC:CostBalance -= LOC:AmountToReduceCostsBy


                IF LOC:CostBalance < 0


                    LOC:RunningCapitalBalance += LOC:CostBalance
                    LOC:CostBalance = 0
                    IF LOC:RunningCapitalBalance < 0      
                        LOC:InterestBalance += LOC:RunningCapitalBalance
                        LOC:RunningCapitalBalance = 0
                        IF LOC:InterestBalance < 0
                        LOC:CostBalance += LOC:InterestBalance
                        LOC:InterestBalance = 0
                        END
                    END
                END

            END



            ELSIF COL:ReduceCapitalFlag = 4 ! REDUCE THE INTEREST FIRST AND THEN CAPITAL AND THEN COSTS.

            LOC:InterestBalance -= LOC:AmountToReduceCapitalBy
            IF LOC:InterestBalance < 0                 
                LOC:RunningCapitalBalance += LOC:InterestBalance
                LOC:InterestBalance = 0   
                IF LOC:RunningCapitalBalance < 0
                    LOC:CostBalance += LOC:RunningCapitalBalance
                    LOC:RunningCapitalBalance = 0
                END
            END

            IF LOC:ReduceCostsFlag

                LOC:CostBalance -= LOC:AmountToReduceCostsBy

                IF LOC:CostBalance < 0

                    LOC:InterestBalance += LOC:CostBalance
                    LOC:CostBalance = 0
                    IF LOC:InterestBalance < 0
                        LOC:RunningCapitalBalance += LOC:InterestBalance
                        LOC:InterestBalance = 0   
                        IF LOC:RunningCapitalBalance < 0
                        LOC:CostBalance += LOC:RunningCapitalBalance
                        LOC:RunningCapitalBalance = 0
                        END
                    END

                END

            END

            ELSE     ! PAY OFF COSTS, THEN INTEREST THEN ONLY REDUCE THE CAPITAL


            IF LOC:ReduceCostsFlag
                LOC:CostBalance -= LOC:AmountToReduceCostsBy
            ELSE
                LOC:CostBalance -= LOC:AmountToReduceCapitalBy
            END


            IF LOC:ReduceCostsFlag

                IF LOC:CostBalance < 0

                    ! HAVE REDUCED ALL THE COSTS SO WE NEED TO ADD THE EXTRA AMOUNT SO IT CAN BE DEDUCTED FROM THE OTHER BALANCES
                    LOC:BalanceLeftOver = ABS(LOC:CostBalance) + LOC:AmountToReduceCapitalBy
                    LOC:CostBalance = 0

                ELSE

                    LOC:BalanceLeftOver = LOC:AmountToReduceCapitalBy

                END

                LOC:InterestBalance -= LOC:BalanceLeftOver
                IF LOC:InterestBalance < 0                    
                    LOC:RunningCapitalBalance += LOC:InterestBalance
                    LOC:InterestBalance = 0                    
                END


            ELSE

                IF LOC:CostBalance < 0

                    LOC:InterestBalance += LOC:CostBalance
                    LOC:CostBalance = 0

                    IF LOC:InterestBalance < 0
                        LOC:RunningCapitalBalance += LOC:InterestBalance
                        LOC:InterestBalance = 0                    
                    END

                END

            END

            END



AdjustCostsForInduplumRule      ROUTINE


    LOC:VatRate = SetCurrentVatRate(CDQ:Date)

    IF LOC:InDuplumOption = 1
        LOC:TheCapitalAmount = LOC:TotalCapitalBalance
    ELSIF LOC:InDuplumOption = 2
        LOC:TheCapitalAmount = LOC:RunningCapitalBalance
    ELSE
        LOC:InDuplumFlag = 0
        LOC:InDuplumAmount = 0
        EXIT
    END

    IF COL:InDuplumAmount
        LOC:TheCapitalAmount = EVALUATE(COL:InDuplumAmount)
        IF ERRORCODE() = 800 OR ERRORCODE() = 801 THEN EXIT.
    END

    IF LOC:InDuplumMaxed  ! TOTAL COSTS AND TOTAL INTEREST = ORIGINAL CAPITAL AMOUNT

        LOC:CostBalance -= CDQ:Amount + CDQ:VatAmount

        CDQ:Description = CDQ:Description & ' (in duplum)'
        CDQ:Amount = 0
        CDQ:VatAmount = 0

        EXIT

    END

    IF ~COL:NewInDuplumRuleFlag THEN EXIT.  ! COSTS ONLY APPLY TO NEW IN DUPLUM RULE (NCA)

    IF  COL:NewInDuplumRuleFromDate AND CDQ:Date <  COL:NewInDuplumRuleFromDate THEN EXIT.  ! ONLY APPLY NEW IN DUPLUM RULE (NCA) AFTER THIS DATE

    IF LOC:InDuplumOption = 0

        LOC:InDuplumFlag = 0
        LOC:InDuplumAmount = 0

    ELSE

        IF GLO:DebuggingFlag AND CDQ:Type = 'X'
            MESSAGE('1 DOING ' & FORMAT(CDQ:Date,@D6b) & ' ' & CDQ:Description &|
            '|LOC:InDuplumOption = ' & LOC:InDuplumOption &|
            '|LOC:InDuplumMaxed = ' & LOC:InDuplumMaxed &|
            '|LOC:TheCapitalAmount = ' & LOC:TheCapitalAmount &|
            '|CDQ:Amount + CDQ:VatAmount = ' & CDQ:Amount + CDQ:VatAmount &|
            '|LOC:DebtorsTotalCosts = ' & LOC:DebtorsTotalCosts &|
            '|LOC:DebtorsTotalCommission = ' & LOC:DebtorsTotalCommission &|
            '|LOC:DebtorsTotalInterest = ' & LOC:DebtorsTotalInterest &|
            '|These 5 = ' & CDQ:Amount + CDQ:VatAmount + LOC:DebtorsTotalCosts + LOC:DebtorsTotalCommission + LOC:DebtorsTotalInterest &|
            '|In duplumn should  = ' & LOC:TheCapitalAmount -  (CDQ:Amount + CDQ:VatAmount + LOC:DebtorsTotalCosts + LOC:DebtorsTotalCommission + LOC:DebtorsTotalInterest))
        END

        IF CDQ:Amount + CDQ:VatAmount + LOC:DebtorsTotalCosts + LOC:DebtorsTotalCommission + LOC:DebtorsTotalInterest > LOC:TheCapitalAmount AND LOC:TheCapitalAmount > 0


            CDQ:Description = CDQ:Description & ' (in duplum)'      ! WE ARE IN DUPLUM

            LOC:InDuplumFlag = 1
            LOC:InDuplumMaxed = 1


            ! CHECK IF WE ARE IN DUPLUM EVEN WITHOUT THIS CDQ:Amount

            IF LOC:DebtorsTotalCosts + LOC:DebtorsTotalCommission + LOC:DebtorsTotalInterest > LOC:TheCapitalAmount

            ! WE ARE ALREADY IN DUPLUM WITHOUT THIS COST SO WE CANNOT ADD ANY MORE COSTS
            LOC:CostBalance -= (CDQ:Amount + CDQ:VatAmount)
            CDQ:Amount = 0
            CDQ:VatAmount = 0

            ELSE

            LOC:InDuplumAmount = (LOC:DebtorsTotalCosts + LOC:DebtorsTotalCommission + LOC:DebtorsTotalInterest + CDQ:Amount + CDQ:VatAmount) - LOC:TheCapitalAmount

            IF CDQ:VATFlag

                SAV:CDQ:Amount = (CDQ:Amount + CDQ:VatAmount) - LOC:InDuplumAmount

                CDQ:Amount = ROUND(SAV:CDQ:Amount * 100 /(100+LOC:VatRate),.01)

                CDQ:VatAmount = ROUND(CDQ:Amount * LOC:VatRate /100,.01)

            ELSE

                CDQ:Amount -= LOC:InDuplumAmount
                CDQ:VatAmount = 0

            END


            LOC:CostBalance -= LOC:InDuplumAmount

        END


        ELSE

            LOC:InDuplumFlag = 0

        END

    END


AdjustInterestForInduplumRule      ROUTINE

    IF LOC:InDuplumOption = 1
        LOC:TheCapitalAmount = LOC:TotalCapitalBalance
    ELSIF LOC:InDuplumOption = 2
        LOC:TheCapitalAmount = LOC:RunningCapitalBalance
    ELSE
        LOC:InDuplumFlag = 0
        LOC:InDuplumAmount = 0
        EXIT
    END

    IF COL:InDuplumAmount
        LOC:TheCapitalAmount = EVALUATE(COL:InDuplumAmount)
        IF ERRORCODE() = 800 OR ERRORCODE() = 801 THEN EXIT.
    END

    IF LOC:InDuplumMaxed  ! TOTAL COSTS AND TOTAL INTEREST = ORIGINAL CAPITAL AMOUNT

        !LOC:InterestBalance -= CDQ:Amount + CDQ:VatAmount

        CDQ:Description = CDQ:Description & ' (in duplum)'
        CDQ:Amount = 0
        CDQ:VatAmount = 0

        EXIT

    END

    IF LOC:InDuplumOption = 0

        LOC:InDuplumFlag = 0
        LOC:InDuplumAmount = 0

    ELSE

        IF COL:NewInDuplumRuleFlag

            IF CDQ:Amount + CDQ:VatAmount + LOC:DebtorsTotalCosts + LOC:DebtorsTotalCommission + LOC:DebtorsTotalInterest > LOC:TheCapitalAmount AND LOC:TheCapitalAmount > 0

            LOC:InDuplumAmount =   (LOC:DebtorsTotalCosts + LOC:DebtorsTotalCommission + LOC:DebtorsTotalInterest + CDQ:Amount + CDQ:VatAmount) - LOC:TheCapitalAmount

            LOC:InDuplumFlag = 1
            LOC:InDuplumMaxed = 1

            CDQ:Amount -= LOC:InDuplumAmount

!       ADDED BY RICK 25/9/2013
            IF CDQ:Amount < 0 THEN CDQ:Amount = 0.

            CDQ:Description = CDQ:Description & ' (in duplum)'


            ELSE

            LOC:InDuplumFlag = 0

            END

        ELSE

            IF LOC:InterestBalance + CDQ:Amount  > LOC:TheCapitalAmount AND LOC:TheCapitalAmount > 0


            LOC:InDuplumAmount = LOC:InterestBalance + CDQ:Amount - LOC:TheCapitalAmount

            LOC:InDuplumFlag = 1
            CDQ:Amount -= LOC:InDuplumAmount
            CDQ:Description = CDQ:Description & ' (in duplum)'

!       ADDED BY RICK 25/9/2013
            IF CDQ:Amount < 0 THEN CDQ:Amount = 0.


            ELSE
            LOC:InDuplumFlag = 0
            END

        END


    END





CheckInterestEndDate PROCEDURE(LONG TheDate)

CODE

! SEND BACK "TRUE" IF INTEREST MUST NOT BE APPLIED

IF ~MAT:InterestEndDate THEN Return(FALSE).  ! APPLY INTEREST

IF MAT:InterestEndDate AND TheDate <= MAT:InterestEndDate THEN Return(FALSE).  ! APPLY INTEREST

IF COL:InterestEndAmount AND LOC:DebtorsTotalInterest < COL:InterestEndAmount THEN Return(FALSE).  ! APPLY INTEREST

RETURN(TRUE)
