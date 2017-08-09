<?php namespace Anomaly\BasicCheckoutExtension\Http\Controller;

use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\CheckoutsModule\Checkout\Contract\CheckoutRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Session\Store;

/**
 * Class CheckoutController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CheckoutController extends PublicController
{

    /**
     * Return the address step.
     *
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function address(CheckoutRepositoryInterface $checkouts, Store $session)
    {
        if (!$checkout = $checkouts->findByStrId($session->get('checkout'))) {
            return $this->redirect->to('checkout');
        }

        return $this->view->make('anomaly.extension.basic_checkout::address', compact('checkout'));
    }

    /**
     * Return the shipping step.
     *
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function shipping(CheckoutRepositoryInterface $checkouts, Store $session)
    {
        if (!$checkout = $checkouts->findByStrId($session->get('checkout'))) {
            return $this->redirect->to('checkout');
        }

        return $this->view->make('anomaly.extension.basic_checkout::shipping', compact('checkout'));
    }

    /**
     * Return the billing step.
     *
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function billing(CheckoutRepositoryInterface $checkouts, Store $session)
    {
        if (!$checkout = $checkouts->findByStrId($session->get('checkout'))) {
            return $this->redirect->to('checkout');
        }

        return $this->view->make('anomaly.extension.basic_checkout::billing', compact('checkout'));
    }

    public function complete(Store $session, CheckoutRepositoryInterface $checkouts)
    {
        $session->forget('checkout');

        $cart = $this->dispatch(new GetCart());

        $cart->delete();

        $checkout = $checkouts->findByStrId($this->route->parameter('id'));

        return $this->view->make('anomaly.extension.basic_checkout::complete', compact('checkout'));
    }

}
