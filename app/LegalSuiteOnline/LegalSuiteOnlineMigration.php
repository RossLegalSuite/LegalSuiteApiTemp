<?php

namespace App\LegalSuiteOnline;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\GenericTableModels\lolsystemtemplate;
use App\GenericTableModels\lolcomponent;
use App\GenericTableModels\lolsettings;


class LegalSuiteOnlineMigration
{

    /* For Testing
    $controller = new \App\LegalSuiteOnline\LegalSuiteOnlineMigration;$controller->createTables()
    $controller = new \App\LegalSuiteOnline\LegalSuiteOnlineMigration;$controller->dropTables()
    See: https://laravel.com/docs/5.0/schema
    */

    public function createTables() {

        try {

            // To reset...
            //drop table lolsettings;drop table lolsystemtemplate;drop table lolcomponent;

            $tableName = 'lolsettings';

            if ( !Schema::connection('sqlsrv')->hasTable($tableName) ) {

                Schema::connection('sqlsrv')->create($tableName, function (Blueprint $table) {
                    $table->increments('recordid');

                    $table->string('dateFormat')->default('DD MMM YYYY');
                    $table->string('currencySymbol')->default('R');
                    $table->string('currencyCode')->default('ZAR');
                    $table->string('countryCode')->default('ZA');
                    $table->string('timeZone')->default('+02:00 Pretoria');
                    $table->string('paperSize')->default('A4');
                    $table->string('region')->default('af-south-1');


                    $table->string('website')->nullable();
                    $table->string('twitter')->nullable();
                    $table->string('facebook')->nullable();
                    $table->string('instagram')->nullable();
                    $table->string('google')->nullable();
                    $table->string('whatsapp')->nullable();
                    $table->string('otherChannel')->nullable();
                    $table->string('otherPlatform')->nullable();


                    $table->string('logo')->nullable();
                    $table->string('letterheadpdffile')->nullable();
                    $table->string('letterheadfilename')->nullable();

                    $table->string('smtpserver')->nullable();
                    $table->string('smtpport')->nullable();
                    $table->enum('smtpencryption', ['None', 'tls', 'ssl'])->default('None');
                    $table->enum('smtpauthentication', ['No', 'Yes'])->default('Yes');
        
                    $table->string('incomingserver')->nullable();
                    $table->string('incomingport')->nullable();
                    $table->string('incomingencryption')->nullable();


                    $table->unsignedInteger('reportTemplateId')->nullable();
                    $table->unsignedInteger('debtorsAccountTemplateId')->nullable();
                    $table->unsignedInteger('reportEmailTemplateId')->nullable();
                    $table->unsignedInteger('partiesEmailTemplateId')->nullable();
                    $table->unsignedInteger('matPartiesEmailTemplateId')->nullable();
                    $table->unsignedInteger('documentEmailTemplateId')->nullable();

                });

                // Create a blank record
                $settings = new lolsettings;
                $settings->save();

            }

            $tableName = 'lolsystemtemplate';

            if ( !Schema::connection('sqlsrv')->hasTable($tableName) ) {

                Schema::connection('sqlsrv')->create($tableName, function (Blueprint $table) {
                    $table->increments('recordid');
                    $table->string('source');
                    $table->string('type');
                    $table->unsignedInteger('roleid')->nullable(); // To repeat the Document for a MatParty
                    $table->unsignedInteger('docgenid')->nullable(); // Filter Templates by Document Set
                    $table->string('title')->unique();
                    $table->string('description');
                    $table->text('contents')->nullable();
                    $table->text('subject')->nullable();
                    $table->text('footer')->nullable();
                    $table->text('header')->nullable();
                    $table->enum('orientation', ['Portrait', 'Landscape'])->default('Portrait');
                    $table->string('papersize',20)->default('A4');
                    $table->string('password')->nullable();
                    $table->boolean('allowprint')->default(1);
                    $table->boolean('allowedit')->default(0);
                    $table->boolean('allowcopy')->default(1);
                    $table->string('bottommargin')->default('5');
                    $table->string('topmargin')->default('5');
                    $table->string('leftmargin')->default('5');
                    $table->string('rightmargin')->default('5');

                    $table->index(['description']);
                    $table->index(['source']);
                    $table->index(['type']);

                });

                $this->seedTemplates();

            }

            $tableName = 'lolcomponent';

            if ( !Schema::connection('sqlsrv')->hasTable($tableName) ) {

                Schema::connection('sqlsrv')->create($tableName, function (Blueprint $table) {
                    $table->increments('recordid');
                    $table->string('title')->unique();
                    $table->string('description');
                    $table->string('source');
                    $table->text('contents')->nullable();

                    $table->index(['description']);
                    $table->index(['source']);

                });

                $this->seedComponents();

            }

            $tableName = 'lolclientreport';

            if ( !Schema::connection('sqlsrv')->hasTable($tableName) ) {

                Schema::connection('sqlsrv')->create($tableName, function (Blueprint $table) {
                    $table->increments('recordid');
                    $table->string('title')->unique();
                    $table->string('description');
                    $table->text('contents')->nullable();
                    $table->text('footer')->nullable();
                    $table->text('header')->nullable();
                    $table->enum('orientation', ['Portrait', 'Landscape'])->default('Portrait');
                    $table->string('papersize',20)->default('A4');
                    $table->string('bottommargin')->default('5');
                    $table->string('topmargin')->default('5');
                    $table->string('leftmargin')->default('5');
                    $table->string('rightmargin')->default('5');

                    $table->index(['description']);

                });

                $this->seedClientReports();

            }



            if ( !Schema::connection('sqlsrv')->hasTable('LolTagged') ) {

                Schema::connection('sqlsrv')->create('LolTagged', function (Blueprint $table) {
                    //$table->increments('recordId');
                    $table->string('tableName',20);
                    $table->unsignedInteger('employeeId');
                    $table->unsignedInteger('taggedId');

                    $table->primary(['tableName', 'employeeId','taggedId']);

                    $table->foreign('employeeId')
                    ->references('recordid')->on('employee')
                    ->onDelete('cascade');
        

                    //$table->index(['tableName', 'employeeId']);
                    //$table->index(['employeeId']);

                });

            }


            // Add smtpUserName and smtpPassword columns to the LegalSuite Employee table
            $tableName = 'Employee';

            if ( !Schema::connection('sqlsrv')->hasColumn($tableName, 'smtpUserName') ) {

                Schema::connection('sqlsrv')->table($tableName, function (Blueprint $table)    {
                    $table->string('smtpUserName',50)->nullable();
                    $table->string('smtpPassword',50)->nullable();
                });

            }


            // Add overdueFlag as a computed column to the LegalSuite ToDoNote table
            if ( !Schema::connection('sqlsrv')->hasColumn('ToDoNote', 'overdueFlag') ) {

                DB::connection('sqlsrv')->statement("ALTER TABLE ToDoNote ADD OverdueFlag AS (CASE WHEN ISNULL(DateDone,0) = 0 OR DateDone = 0 THEN 0 ELSE CASE WHEN DATEDIFF(day, CAST(Date-36163 as DateTime),GETDATE()) > 0 THEN 1 ELSE 0 END END)");

            }

        } catch(\Exception $e)  {
            throw new \Exception('An error was encountered modifying the LegalSuite database ' . $e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage());
        }

    }

    public function migrateTables() {
        // Put any migrations here
    }

    private function seedClientReports() {
        // TO DO
    }

    private function seedTemplates() {

        try {

            $settings = lolsettings::first();

            $templatePath = base_path() . '/app/LegalSuiteOnline/Templates/';

            $contents = file_get_contents($templatePath . 'report.html');
            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Table Report';
            $template->description = 'Layout used when printing a table report';
            $template->source = 'Report';
            $template->type = 'Report';
            $template->orientation = 'Landscape';
            $template->contents = $contents;
            $template->save();

            $settings->reportTemplateId = $template->recordid;

            $contents = file_get_contents($templatePath . 'debtorsAccountReport.html');
            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Debtors Account Report';
            $template->description = 'Layout for the Debtors Account report';
            $template->source = 'Report';
            $template->type = 'Report';
            $template->orientation = 'Landscape';
            $template->contents = $contents;
            $template->save();

            $settings->debtorsAccountTemplateId = $template->recordid;

            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Report Email';
            $template->description = 'Email message when sending a report as an attachment';
            $template->source = 'Party';
            $template->type = 'Email';
            $template->contents = file_get_contents($templatePath . 'reportEmail.html');
            
            $template->save();
            
            $settings->reportEmailTemplateId = $template->recordid;
    
    
            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Parties Email';
            $template->description = 'Email message when sending an email to a Party';
            $template->source = 'Party';
            $template->type = 'Email';
            $template->contents = file_get_contents($templatePath . 'partiesEmail.html');
            
            $template->save();
            
            $settings->partiesEmailTemplateId = $template->recordid;

            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Matter Parties Email';
            $template->description = 'Email message when sending an email to a Matter Party';
            $template->source = 'MatParty';
            $template->type = 'Email';
            $template->subject = "Your Matter: {{matter.fileref + ' ' + matter.description}}";
            $template->contents = file_get_contents($templatePath . 'matPartiesEmail.html');
            
            $template->save();
            
            $settings->matPartiesEmailTemplateId = $template->recordid;

            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Matter Document Example';
            $template->description = 'Example of a document for a Matter';
            $template->source = 'Matter';
            $template->type = 'Document';
            $template->contents = file_get_contents($templatePath . 'matter_document.html');
    
            $template->save();


            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Document Attachment Email';
            $template->description = 'Email message when sending a document as an attachment';
            $template->source = 'Documents';
            $template->type = 'Email';
            $template->contents = file_get_contents($templatePath . 'documentEmail.html');
            
            $template->save();
            
            $settings->documentEmailTemplateId = $template->recordid;

            //**************************************************
            // Document Examples
            //**************************************************
            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Address Book Letter Example';
            $template->description = 'Example of a letter to a Party in the Address Book';
            $template->source = 'Party';
            $template->type = 'Document';
            $template->contents = file_get_contents($templatePath . 'partyLetter.html');
            $template->save();

            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Matter Party Letter Example';
            $template->description = 'Example of a letter to a Matter Party';
            $template->source = 'MatParty';
            $template->type = 'Document';
            $template->contents = file_get_contents($templatePath . 'matPartyLetter.html');
            $template->save();

            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Letter Of Demand';
            $template->description = 'Example of a Letter Of Demand';
            $template->source = 'Matter';
            $template->type = 'Document';
            $template->roleid = 2;
            $template->contents = file_get_contents($templatePath . 'letterOfDemand.html');
            $template->save();

            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Party Document Example';
            $template->description = 'Example of a document for a Party';
            $template->source = 'Party';
            $template->type = 'Document';
            $template->contents = file_get_contents($templatePath . 'party_document.html');
            $template->save();


            /*
            
            $contents = file_get_contents($templatePath . 'trialBalance.html');
            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Trial Balance';
            $template->description = 'The layout of the trial balance report';
            $template->source = 'Accounts';
            $template->contents = $contents;
    
            $template->save();
            $settings->trialBalanceTemplateId = $template->recordid;
    
            $contents = file_get_contents($templatePath . 'incomeStatement.html');
            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Income Statement';
            $template->description = 'The layout of the income statement report';
            $template->source = 'Accounts';
            $template->contents = $contents;
    
            $template->save();
            $settings->incomeStatementTemplateId = $template->recordid;
    
            $contents = file_get_contents($templatePath . 'balanceSheet.html');
            $template = new lolsystemtemplate;
            $template->password = time();
            $template->title = 'Balance Sheet';
            $template->description = 'The layout of the balance sheet report';
            $template->source = 'Accounts';
            $template->contents = $contents;
    
            $template->save();
            $settings->balanceSheetTemplateId = $template->recordid;
            */



            // Save the Template Ids 
            $settings->save();

        } catch(\Exception $e)  {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage());
        }

    }

    private function seedComponents() {

        try {


            $templatePath = base_path() . '/app/LegalSuiteOnline/Components/';

            $component = new lolcomponent;
            $component->title = 'debtorsAccountTable';
            $component->description = 'Debtor\'s transactions in a table';
            $component->source = 'Company';
            $component->contents = file_get_contents($templatePath . 'debtorsAccountTable.html');
    
            $component->save();

            $component = new lolcomponent;
            $component->title = 'reportHeader';
            $component->description = 'Heading for table reports';
            $component->source = 'Company';
            $component->contents = file_get_contents($templatePath . 'reportHeader.html');
    
            $component->save();

            $component = new lolcomponent;
            $component->title = 'letterhead';
            $component->description = 'The company letterhead';
            $component->source = 'Company';
            $component->contents = file_get_contents($templatePath . 'letterhead.html');
    
            $component->save();
    
            $component = new lolcomponent;
            $component->title = 'companyLogo';
            $component->description = 'Company Logo (or name)';
            $component->source = 'Company';
            $component->contents = file_get_contents($templatePath . 'companyLogo.html');
    
            $component->save();
            
            $component = new lolcomponent;
            $component->title = 'companyAddress';
            $component->description = 'Company Address details';
            $component->source = 'Company';
            $component->contents = file_get_contents($templatePath . 'companyAddress.html');
    
            $component->save();
            
            // $component = new lolcomponent;
            // $component->title = 'bankDetailsBlock';
            // $component->description = 'The company\'s banking details in a block format';
            // $component->source = 'Company';
            // $component->contents = file_get_contents($templatePath . 'bankDetailsBlock.html');
    
            // $component->save();
    
            // $component = new lolcomponent;
            // $component->title = 'bankDetailsLine';
            // $component->description = 'The company\'s banking details on a single line';
            // $component->source = 'Company';
            // $component->contents = file_get_contents($templatePath . 'bankDetailsLine.html');
    
            // $component->save();
    
            $component = new lolcomponent;
            $component->title = 'companyPostalLine';
            $component->description = 'The company\'s banking details in a horizontal line';
            $component->source = 'Company';
            $component->contents = file_get_contents($templatePath . 'companyPostalLine.html');
    
            $component->save();
            
            $component = new lolcomponent;
            $component->title = 'companyPostalBlock';
            $component->description = 'The company\'s banking details in a block format';
            $component->source = 'Company';
            $component->contents = file_get_contents($templatePath . 'companyPostalBlock.html');
    
            $component->save();
            
            $component = new lolcomponent;
            $component->title = 'valediction';
            $component->description = 'The ending of a letter or email';
            $component->source = 'Employee';
            $component->contents = file_get_contents($templatePath . 'valediction.html');
    
            $component->save();
    
            $component = new lolcomponent;
            $component->title = 'salutation';
            $component->description = 'The salutation at the beginning of a letter or email';
            $component->source = 'Party';
            $component->contents = file_get_contents($templatePath . 'salutation.html');
    
            $component->save();
    
            $component = new lolcomponent;
            $component->title = 'partyPostal';
            $component->description = 'The party\'s postal address';
            $component->source = 'Party';
            $component->contents = file_get_contents($templatePath . 'partyPostal.html');
    
            $component->save();
    
            $component = new lolcomponent;
            $component->title = 'partyName';
            $component->description = 'The party\'s name';
            $component->source = 'Party';
            $component->contents = file_get_contents($templatePath . 'partyName.html');
    
            $component->save();

    
            $component = new lolcomponent;
            $component->title = 'partyPhysical';
            $component->description = 'The party\'s physical address';
            $component->source = 'Party';
            $component->contents = file_get_contents($templatePath . 'partyPhysical.html');
    
            $component->save();
    
    
        } catch(\Exception $e)  {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage());
        }

    }

    public function dropTables() {
        $tableName = 'lolsettings';
        Schema::connection('sqlsrv')->dropIfExists($tableName);

        $tableName = 'lolsystemtemplate';
        Schema::connection('sqlsrv')->dropIfExists($tableName);

        $tableName = 'lolcomponent';
        Schema::connection('sqlsrv')->dropIfExists($tableName);

        $tableName = 'LolTagged';
        Schema::connection('sqlsrv')->dropIfExists($tableName);

    }

}
