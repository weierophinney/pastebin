<?php
class My_PubSub_Handle
{
    protected $_callback;
    protected $_topic;

    public function __construct($topic, $context, $handler)
    {
        $this->_topic = $topic;

        if (null === $handler) {
            $this->_callback = $context;
        } else {
            $this->_callback = array($context, $handler);
        }
    }

    public function getTopic()
    {
        return $this->_topic;
    }

    public function call(array $args)
    {
        call_user_func_array($this->_callback, $args);
    }
}
