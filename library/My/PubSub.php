<?php
class My_PubSub
{
    protected static $_topics = array();

    public static function publish($topic, $args = null)
    {
        if (empty(self::$_topics[$topic])) {
            throw new My_PubSub_Exception('Cannot publish topic; topic does not exist');
        }
        $args = func_get_args();
        array_shift($args);
        foreach (self::$_topics[$topic] as $handle) {
            $handle->call($args);
        }
    }

    public static function subscribe($topic, $context, $handler = null)
    {
        if (empty(self::$_topics[$topic])) {
            self::$_topics[$topic] = array();
        }
        $handle = new My_PubSub_Handle($topic, $context, $handler);
        if (in_array($handle, self::$_topics[$topic])) {
            $index = array_search($handle, self::$_topics[$topic]);
            return self::$_topics[$topic][$index];
        }
        self::$_topics[$topic][] = $handle;
        return $handle;
    }

    public static function unsubscribe(My_PubSub_Handle $handle)
    {
        $topic = $handle->getTopic();
        if (empty(self::$_topics[$topic])) {
            throw new My_PubSub_Exception('Cannot unsubscribe handle; topic does not exist');
        }
        if (!$index = array_search($handle, self::$_topics[$topic])) {
            throw new My_PubSub_Exception('Cannot unsubscribe handle; not found');
        }
        unset(self::$_topics[$topic][$index]);
        return true;
    }

    public static function getTopics()
    {
        return array_keys(self::$_topics);
    }

    public static function getSubscribedHandles($topic)
    {
        if (empty(self::$_topics[$topic])) {
            throw new My_PubSub_Exception('Cannot retrieve handles; topic does not exist');
        }
        return self::$_topics[$topic];
    }

    public static function clearHandles($topic)
    {
        if (!empty(self::$_topics[$topic])) {
            self::$_topics[$topic] = array();
        }
    }
}
