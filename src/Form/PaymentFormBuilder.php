<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\PaymentsModule\Card\Support\SelectFieldType\CardTypes;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class PaymentFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PaymentFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'number'           => [
            'required' => true,
            'label'    => 'Card Number',
            'type'     => 'anomaly.field_type.text',
        ],
        'expiration_month' => [
            'required' => true,
            'label'    => 'Expiration Month',
            'type'     => 'anomaly.field_type.integer',
            'rules'    => [
                'date_format:n',
            ],
        ],
        'expiration_year'  => [
            'required' => true,
            'label'    => 'Expiration Year',
            'type'     => 'anomaly.field_type.integer',
            'rules'    => [
                'date_format:Y',
            ],
        ],
        'type'             => [
            'required' => true,
            'label'    => 'Card Type',
            'type'     => 'anomaly.field_type.select',
            'config'   => [
                'handler' => CardTypes::class,
            ],
        ],
        'security_code'    => [
            'required' => true,
            'label'    => 'Security Code',
            'type'     => 'anomaly.field_type.integer',
        ],
    ];

}
