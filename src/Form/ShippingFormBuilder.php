<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\CartsModule\Cart\CartProcessor;
use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormCollection;
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

    public function __construct(Form $form, FormCollection $forms)
    {
        parent::__construct($form, $forms);

        $this->addForm('shipment', app(ShipmentFormBuilder::class));
    }

    public function onReady()
    {
        $this->forms->map(
            function ($form) {
                $form->setOption('cart_id', $this->getEntry());
            }
        );
    }
}
