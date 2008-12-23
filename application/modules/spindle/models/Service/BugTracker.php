<?php
class Spindle_Model_Service_BugTracker
{
    protected $_bugTracker;

    public function __construct(Spindle_Model_BugTracker $bugTracker = null)
    {
        if (null !== $bugTracker) {
            $this->_bugTracker = $bugTracker;
        }
    }

    /**
     * Add a new bug
     *
     * Return is an object. On success, the 'success' property will indicate the 
     * new bug id. On failure, the 'error' property will be true, and the 
     * 'messages' property will be an object of label/message array pairs.
     * 
     * @param  struct $data 
     * @return struct
     */
    public function add(array $data)
    {
        if (array_key_exists('id', $data)) {
            unset($data['id']);
        }
        
        $model = $this->_getBugTracker();

        if (!$id = $model->save($data)) {
            $validator = $model->getBugForm();
            $messages = array();
            foreach ($form->getMessages() as $name => $errors) {
                $label = $form->$name->getLabel();
                $messages[] = array(
                    'label'    => $label,
                    'messages' => array_values($errors),
                );
            }
            return array(
                'error'    => true,
                'request'  => $data,
                'messages' => $messages,
            );
        }

        return array('success' => $id);
    }

    /**
     * Update a bug 
     * 
     * @param  struct $data 
     * @return int
     */
    public function update(array $data)
    {
        if (!array_key_exists('id', $data)) {
            throw new Spindle_Model_Exception('Update expects a bug id');
        }
        return $this->_getBugTracker()->save($data);
    }

    protected function _getBugTracker()
    {
        if (null === $this->_bugTracker) {
            $this->_bugTracker = new Spindle_Model_BugTracker();
        }
        return $this->_bugTracker;
    }

    protected function _error($message, $type = 'General') 
    {
        return array(
            'error'   => true,
            'messages' => array(
                array(
                    'label'    => $type,
                    'messages' => array($message),
                ),
            )
        );
    }
}
