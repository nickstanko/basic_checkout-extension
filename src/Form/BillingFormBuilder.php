<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormCollection;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class BillingFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BillingFormBuilder extends MultipleFormBuilder
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

        $this->forms->add('address', app(BillingAddressFormBuilder::class));
        $this->forms->add('payment', app(PaymentFormBuilder::class));
    }

    public function onReady()
    {
        $this->forms->get('address')->setEntry($this->getEntry());
        $this->forms->get('payment')->setOption('order_id', $this->getEntry());
    }
}
