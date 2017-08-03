<?php namespace Anomaly\BasicCheckoutExtension;

use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class BasicCheckoutExtension
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BasicCheckoutExtension extends Extension
{

    /**
     * This extension provides a basic
     * checkout for the checkouts module.
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.checkouts::checkout.basic';

}
