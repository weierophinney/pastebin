<?php
/**
 * Phly - PHp LibrarY
 * 
 * @category  Phly
 * @package   Phly_PubSub
 * @copyright Copyright (C) 2008 - Present, Matthew Weier O'Phinney
 * @author    Matthew Weier O'Phinney <mweierophinney@gmail.com> 
 * @license   New BSD {@link http://www.opensource.org/licenses/bsd-license.php}
 */

/**
 * Phly_PubSub_Handle: unique handle subscribed to a given topic
 * 
 * @package Phly_PubSub
 * @version $Id: $
 */
class Phly_PubSub_Handle
{
    /**
     * @var string|array PHP callback to invoke
     */
    protected $_callback;

    /**
     * @var string Topic to which this handle is subscribed
     */
    protected $_topic;

    /**
     * Constructor
     * 
     * @param  string $topic Topic to which handle is subscribed
     * @param  string|object $context Function name, class name, or object instance
     * @param  string|null $handler Method name, if $context is a class or object
     * @return void
     */
    public function __construct($topic, $context, $handler = null)
    {
        $this->_topic = $topic;

        if (null === $handler) {
            $this->_callback = $context;
        } else {
            $this->_callback = array($context, $handler);
        }
    }

    /**
     * Get topic to which handle is subscribed
     * 
     * @return string
     */
    public function getTopic()
    {
        return $this->_topic;
    }

    /**
     * Retrieve registered callback
     * 
     * @return string|array
     */
    public function getCallback()
    {
        return $this->_callback;
    }

    /**
     * Invoke handler
     * 
     * @param  array $args Arguments to pass to callback
     * @return void
     */
    public function call(array $args)
    {
        call_user_func_array($this->getCallback(), $args);
    }
}
