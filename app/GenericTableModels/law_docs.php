<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class law_docs extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'LAW_Docs';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'documentname',
        'rtffilename',
        'language',
        'suiteid',
        'loan_type_x_1',
        'loan_type_x_2',
        'loan_type_x_3',
        'loan_type_x_4',
        'loan_type_x_5',
        'loan_type_x_6',
        'loan_type_x_7',
        'loan_type_x_8',
        'loan_type_x_9',
        'loan_type_x_10',
        'loan_type_x_11',
        'loan_type_x_12',
        'loan_type_x_13',
        'loan_type_x_14',
        'loan_type_x_15',
        'loan_type_x_16',
        'loan_type_x_17',
        'loan_type_x_18',
        'loan_type_x_19',
        'loan_type_x_20',
        'prpty_type_x_1',
        'prpty_type_x_2',
        'prpty_type_x_3',
        'prpty_type_x_4',
        'prpty_type_x_5',
        'prpty_type_x_6',
        'prpty_type_x_7',
        'prpty_type_x_8',
        'prpty_type_x_9',
        'prpty_type_x_10',
        'prpty_type_x_11',
        'prpty_type_x_12',
        'prpty_type_x_13',
        'prpty_type_x_14',
        'prpty_type_x_15',
        'prpty_type_x_16',
        'prpty_type_x_17',
        'prpty_type_x_18',
        'prpty_type_x_19',
        'prpty_type_x_20',
        'message_no_1',
        'message_no_2',
        'message_no_3',
        'message_no_4',
        'message_no_5',
        'filterstring',
        'printpermortgagor',
        'truecondition',
    ];

    public function setdateAttribute($value)
    {
        $this->attributes['date'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setcreateddateAttribute($value)
    {
        $this->attributes['createddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }
}
