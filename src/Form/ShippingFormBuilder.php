<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class ShippingFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ShippingFormBuilder extends MultipleFormBuilder
{

    /**
     * The form buttons.
     *
     * @var array
     */
    protected $actions = [
        'submit',
    ];

    /**
     * Fired when ready to build.
     */
    public function onReady()
    {
        $this->addForm('shipment', app(ShipmentFormBuilder::class));
    }
}
