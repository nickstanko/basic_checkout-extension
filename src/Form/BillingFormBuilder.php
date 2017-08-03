<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\PaymentsModule\Card\Support\SelectFieldType\CardTypes;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class BillingFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BillingFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'number'           => [
            'required' => true,
            'type'     => 'anomaly.field_type.text',
        ],
        'expiration_month' => [
            'required' => true,
            'type'     => 'anomaly.field_type.integer',
            'rules'    => [
                'date_format:n',
            ],
        ],
        'expiration_year'  => [
            'required' => true,
            'type'     => 'anomaly.field_type.integer',
            'rules'    => [
                'date_format:Y',
            ],
        ],
        'type'             => [
            'required' => true,
            'type'     => 'anomaly.field_type.select',
            'config'   => [
                'handler' => CardTypes::class,
            ],
        ],
        'security_code'    => [
            'required' => true,
            'type'     => 'anomaly.field_type.integer',
        ],
    ];

}
