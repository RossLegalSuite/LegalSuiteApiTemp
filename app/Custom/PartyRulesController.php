<?php

namespace App\Custom;

use App\Custom\ControllerHelper;
use App\Custom\ModelHelper;
use App\GenericTableModels\control;
use App\GenericTableModels\parlang;
use App\GenericTableModels\partele;
use App\GenericTableModels\party;

class PartyRulesController
{
    public function storeRecord($request)
    {

        // Check if createdid was sent as part of the $request
        if (! isset($request['createdid'])) {
            $returnData['errors'] = 'Party.CreatedId was not specified. This is required to record who created the Party. Please set Party.CreatedId to the RecordID of the logged in Employee';

            return $returnData;
        }

        // Check if parlang object was sent as part of the $request
        if (isset($request['parlang'])) {
            $parlang = (object) $request['parlang'];
        } else {
            $returnData['errors'] = 'No ParLang record was sent - it must be sent as a sub object of the Party object, i.e. party->parlang.';

            return $returnData;
        }

        //Convert the $request array into an object (for better syntax)
        $party = (object) $request;

        // Check if the Parlang name was sent - it is needed to create the matterprefix
        if (! isset($parlang->name)) {
            $returnData['errors'] = 'Please give the Party a name';

            return $returnData;
        }

        //***********************************************************
        // Set the MatterPrefix
        //***********************************************************
        $control = control::select('MatterPrefixOption')->first();

        if (! $control) {
            $returnData['errors'] = 'Could not get the Control table. It is required to create the FileRef of the Matter.';

            return $returnData;
        }

        $matterPrefixOption = $control->MatterPrefixOption;

        $party->matterprefix = $this->createMatterPrefix($parlang->name, $matterPrefixOption);

        $this->sanitizeData($party, $parlang);

        date_default_timezone_set('Africa/Johannesburg');
        $party->createddate = ModelHelper::convertClarionDate(date('Y-m-d'));
        $party->createdtime = ModelHelper::convertClarionTime(date('H:i:s'));

        $returnData = party::create((array) $party);

        $party->recordid = $returnData['recordid'];

        // ******************************************
        // Create the ParLang in the Default Language
        // ******************************************

        $recordid = parlang::max('recordid');
        $parlang->recordid = $recordid + 1;

        $parlang->partyid = $party->recordid;
        $parlang->languageid = $returnData['defaultlanguageid'];

        $parlangData1 = parlang::create((array) $parlang);

        // ******************************************
        // Create the ParLang in the Other Language
        // ******************************************
        $recordid = parlang::max('recordid');
        $parlang->recordid = $recordid + 1;

        $parlang->languageid = $parlang->languageid == 1 ? 2 : 1;

        $parlangData2 = parlang::create((array) $parlang);

        // ******************************************
        // Create the Email Address
        // ******************************************
        if (isset($party->emailaddress)) {
            $emailPhoneId = control::pluck('emailphoneid')->first();

            $parTele = [
                'partyid' => $party->recordid,
                'telephonetypeid' => $emailPhoneId,
                'number' => $party->emailaddress,
                'sorter' => 1,
                'internalflag' => 0,
                'defaultemailflag' => 1,
            ];

            partele::create($parTele);
        }

        // ******************************************
        // Create the Cell Phone Number
        // ******************************************
        if (isset($party->cellphone)) {
            $cellPhoneId = control::pluck('cellphoneid')->first();

            $parTele = [
                'partyid' => $party->recordid,
                'telephonetypeid' => $cellPhoneId,
                'number' => $party->cellphone,
                'sorter' => 1,
                'internalflag' => 0,
            ];

            partele::create($parTele);
        }

        // ******************************************
        // Create the Work Phone Number
        // ******************************************
        if (isset($party->workphone)) {
            $workPhoneId = control::pluck('workphoneid')->first();

            $parTele = [
                'partyid' => $party->recordid,
                'telephonetypeid' => $workPhoneId,
                'number' => $party->workphone,
                'sorter' => 1,
                'internalflag' => 0,
            ];

            partele::create($parTele);
        }

        return $returnData;
    }

    public function updateRecord($request)
    {

        // Check if updatedbyid was sent as part of the $request
        if (! isset($request['updatedbyid'])) {
            $returnData['errors'] = 'Party.UpdatedById was not specified. This is required to record who updated the Party. Please set Party.UpdatedById to the RecordID of the logged in Employee.';

            return $returnData;
        }

        // Check if parlang object was sent as part of the $request
        if (isset($request['parlang'])) {
            $parlang = (object) $request['parlang'];
        } else {
            $returnData['errors'] = 'No ParLang record was sent - it must be sent as a sub object of the Party object, i.e. party->parlang.';

            return $returnData;
        }

        //Convert the $request array into an object (for better syntax)
        $party = (object) $request;

        $this->sanitizeData($party, $parlang);

        date_default_timezone_set('Africa/Johannesburg');
        $party->updatedbydate = ModelHelper::convertClarionDate(date('Y-m-d'));
        $party->updatedbytime = ModelHelper::convertClarionTime(date('H:i:s'));

        // Save the Party
        $returnData = party::findOrFail($party->recordid);

        //logger('$returnData',[$returnData]);

        unset($party->recordid);
        $returnData->update((array) $party);

        //logger('BEFORE UPDATE $parlang',(array) $parlang);

        // Save the ParLang
        $parlangRecord = parlang::findOrFail($parlang->recordid);

        //logger('Original $parlangRecord',[$parlangRecord]);

        unset($parlang->recordid);
        $parlangRecord->update((array) $parlang);

        //logger('AFTER UPDATE $parlangRecord',[$parlangRecord]);

        return $returnData;
    }

    private function sanitizeData(&$party, &$parlang)
    {

        // ******************************************
        // Convert dates
        // ******************************************
        if (isset($parlang->trustdate)) {
            $parlang->trustdate = ModelHelper::convertClarionDate($parlang->trustdate);
        }

        if (isset($parlang->marriagedate)) {
            $parlang->marriagedate = ModelHelper::convertClarionDate($parlang->marriagedate);
        }

        if (isset($parlang->birthdate)) {
            $parlang->birthdate = ModelHelper::convertClarionDate($parlang->birthdate);
        }

        if (isset($parlang->spousebirthdate)) {
            $parlang->spousebirthdate = ModelHelper::convertClarionDate($parlang->spousebirthdate);
        }

        if (isset($parlang->gpasignedon)) {
            $parlang->gpasignedon = ModelHelper::convertClarionDate($parlang->gpasignedon);
        }

        if (isset($party->dateresolutionsigned)) {
            $party->dateresolutionsigned = ModelHelper::convertClarionDate($party->dateresolutionsigned);
        }

        if (isset($party->remoteaccessexpiry)) {
            $party->remoteaccessexpiry = ModelHelper::convertClarionDate($party->remoteaccessexpiry);
        }

        // ******************************************
        //Check data and set defaults if missing
        // ******************************************
        if (! isset($party->defaultroleid)) {
            $party->defaultroleid = control::pluck('clientroleid')->first();
        }

        if (! isset($party->defaultlanguageid)) {
            $party->defaultlanguageid = control::pluck('defaultlanguageid')->first();
        }

        $party->entityid = isset($party->entityid) ? $party->entityid : 1;
        $party->partytypeid = isset($party->partytypeid) ? $party->partytypeid : 1;
        $party->identitydocumenttype = isset($party->identitydocumenttype) ? $party->identitydocumenttype : 'I';
        $party->maritalstatus = isset($party->maritalstatus) ? $party->maritalstatus : 'UNM';
        $party->unmarriedstatus = isset($party->unmarriedstatus) ? $party->unmarriedstatus : 0;
        $party->postalcountryid = isset($party->postalcountryid) ? $party->postalcountryid : 1;
        $party->physicalcountryid = isset($party->physicalcountryid) ? $party->physicalcountryid : 1;
        $party->clientflag = isset($party->clientflag) ? $party->clientflag : 0;
        $party->inactiveflag = isset($party->inactiveflag) ? $party->inactiveflag : 0;
        $party->parcategoryid = isset($party->parcategoryid) ? $party->parcategoryid : 3;
        $party->birthdaysmsflag = isset($party->birthdaysmsflag) ? $party->birthdaysmsflag : 0;

        $party->taxpayer = isset($party->taxpayer) ? $party->taxpayer : 'Y';
        $party->taxnumber = isset($party->taxnumber) ? $party->taxnumber : '';
        $party->taxnumber = $party->taxpayer !== 'Y' ? '' : $party->taxnumber;

        $party->spousetaxpayer = isset($party->spousetaxpayer) ? $party->spousetaxpayer : 'Y';
        $party->spousetaxnumber = isset($party->spousetaxnumber) ? $party->spousetaxnumber : '';
        $party->spousetaxnumber = $party->spousetaxpayer !== 'Y' ? '' : $party->spousetaxnumber;

        if (isset($parlang->identitynumber)) {
            $party->identitynumber = $parlang->identitynumber;
        }

        // ******************************************
        // SOLVE OLD CLARION CONVERSION ISSUES
        // ******************************************
        if (isset($party->birthmonth)) {
            $party->birthmonth = (int) $party->birthmonth > 12 ? '0' : $party->birthmonth;
        }
        if (isset($party->birthday)) {
            $party->birthday = (int) $party->birthday > 31 ? '0' : $party->birthday;
        }

        if (! isset($parlang->birthdate)) {
            $party->birthdaysmsflag = 0;
        }

        if (isset($parlang->birthdate)) {
            if ((int) $parlang->birthdate < 1) {
                $party->birthdaysmsflag = 0;
            }
        }

        if (isset($party->recordid)) {
            $party->remoteaccesspassword = isset($party->remoteaccesspassword) ? $party->remoteaccesspassword : $party->recordid;
        }

        // ******************************************
        // Set the Party name
        // and clear redundant data if it is juristic
        // ******************************************

        if ($this->isJursitic($party)) {
            $parlang->spousename = '';
            $parlang->spousefirstname = '';
            $parlang->spouseidentitynumber = '';
            $parlang->spousebirthdate = '';
            $parlang->domiciledin = '';
            $parlang->maritaldescription = '';
            $parlang->deedsregistry = '';
            $parlang->marriagedate = 0;
            $parlang->marriageplace = '';
            $parlang->marriagecountry = '';
            $parlang->ancnumber = '';
            $parlang->spouseprincipalflag = '0';

            $party->maritalstatus = '';

            if (isset($parlang->alternativename)) {
                $party->name = $parlang->alternativename.' ('.$parlang->name.')';
            } else {
                $party->name = $parlang->name;
            }

            $party->spousetaxnumber = '';
        } else {
            $party->name = $parlang->name;

            if (isset($parlang->initials)) {
                $party->name = $parlang->name.' '.$parlang->initials;
            }

            if (isset($parlang->alternativename)) {
                $party->name = $party->name.' ('.$parlang->alternativename.')';
            } elseif (isset($parlang->firstname)) {
                $party->name = $party->name.' ('.$parlang->firstname.')';
            }
        }
    }

    private function isJursitic($party)
    {
        return $party->entityid > 2 && $party->entityid !== 16 ? true : false;
    }

    private function createMatterPrefix($name, $matterPrefixOption)
    {
        $returnString = '';
        $matterPrefix = substr(strtoupper($name), 0, 20);
        $matterPrefix = preg_replace('/[^A-Z0-9]/', '', $matterPrefix);
        $prefixCounter = 0;

        if ($matterPrefixOption == '1') {
            $matterPrefix = substr(trim($matterPrefix), 0, 1);

            $prefixCounter += $this->countParties($matterPrefix);

            if ($prefixCounter == 0) {
                $prefixCounter = 1;
            }

            for ($i = 0; $i < 1000; $i++) {
                if ($prefixCounter > 9999999) {
                    $returnString = $matterPrefix.str_pad($prefixCounter, 9, '0', STR_PAD_LEFT);
                } elseif ($prefixCounter > 999999) {
                    $returnString = $matterPrefix.str_pad($prefixCounter, 7, '0', STR_PAD_LEFT);
                } elseif ($prefixCounter > 99999) {
                    $returnString = $matterPrefix.str_pad($prefixCounter, 6, '0', STR_PAD_LEFT);
                } elseif ($prefixCounter > 9999) {
                    $returnString = $matterPrefix.str_pad($prefixCounter, 5, '0', STR_PAD_LEFT);
                } else {
                    $returnString = $matterPrefix.str_pad($prefixCounter, 4, '0', STR_PAD_LEFT);
                }

                $duplicateExists = $this->checkDuplicateMatterPrefix($matterPrefix);

                if (! $duplicateExists) {
                    break;
                }

                $prefixCounter++;
            }
        } else {
            $matterPrefix = substr(trim($matterPrefix), 0, 3);

            $prefixCounter += $this->countParties($matterPrefix);

            if ($prefixCounter == 0) {
                $prefixCounter = 1;
            }

            for ($i = 0; $i < 1000; $i++) {
                $returnString = $matterPrefix.$prefixCounter;

                $duplicateExists = $this->checkDuplicateMatterPrefix($returnString);

                if (! $duplicateExists) {
                    break;
                }

                $prefixCounter++;
            }
        }

        return $returnString;
    }

    private function checkDuplicateMatterPrefix($matterPrefix)
    {
        return party::whereRaw("matterprefix = '".$matterPrefix."'")->count();
    }

    private function countParties($matterPrefix)
    {
        return party::whereRaw("matterprefix like '".$matterPrefix."%'")->count();
    }
}
