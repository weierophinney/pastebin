<?php
class Paste_Service
{
    /**
     * @var Paste
     */
    protected $_paste;

    /**
     * Constructor
     * 
     * @param  Paste|null $paste 
     * @return void
     */
    public function __construct(Paste $paste = null)
    {
        if (null !== $paste) {
            $this->_setPaste($paste);
        }
    }

    /**
     * Add a paste to the pastebin
     *
     * $data should contain the following keys:
     * - code (req): the code being pasted
     * - type (opt): the type of code being pasted; defaults to "php"
     * - summary (opt): summary of what the code represents
     * - user (opt): name of the user pasting the code
     * - parent (opt): if pasting a followup, the ID of the parent paste
     * - expires (opt): the date at which the paste should expire
     *
     * Returns a struct. On success, the struct consists of a single key:
     * - success: <id of new paste>
     * On failure, it returns a struct with two keys:
     * - error:    true
     * - messages: array (label/[messages] pairs)
     * 
     * @param  struct $data 
     * @return struct
     */
    public function add(array $data)
    {
        $paste  = $this->_getPaste();
        $result = $this->_getPaste()->add($data);
        if ($result) {
            return array(
                'success' => $result,
            );
        }

        $form     = $paste->getForm();
        $messages = array();
        $info     = $form->getMessages();
        if (isset($info['pasteform'])) {
            $info = $info['pasteform'];
        } elseif (isset($info['followupform'])) {
            $info = $info['followupform'];
        }
        foreach ($info as $name => $errors) {
            if (!isset($form->{$name})) {
                throw new Exception('Invalid element: ' . $name);
            }
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

    /**
     * Retrieve a paste by identifier
     *
     * On failure, returns boolean false.
     *
     * On success, returns a struct with the following:
     * - code: the code pasted
     * - type: the type of code pasted
     * - summary: summary of what the code represents
     * - user: name of the user who pasted the code
     * - parent: if pasted as a followup, the ID of the parent paste
     * - children: false, if paste has no followups; array of string identifiers if it does
     * - created: the date at which the paste was created
     * - expires: the date at which the paste should expire
     * 
     * @param  string $id 
     * @return struct|false
     */
    public function get($id)
    {
        return $this->_getPaste($id);
    }

    /**
     * Fetch active pastes, ordered by creation date (desc)
     *
     * Can also specify criteria:
     * - start: what record to start on
     * - count: how many records to return
     * - sort:  what field and direction to sort on. Separate field and direction with a '-'
     * 
     * @param  array|struct $criteria 
     * @return array
     */
    public function fetchActive($criteria = null)
    {
        return $this->_getPaste()->fetchActive($criteria);
    }

    /**
     * Fetch count of active pastes
     *
     * @return int
     */
    public function fetchActiveCount()
    {
        return $this->_getPaste()->fetchActiveCount();
    }

    /**
     * Set paste object
     * 
     * @param  Paste $paste 
     * @return Paste_Service
     */
    protected function _setPaste(Paste $paste)
    {
        $this->_paste = $paste;
        return $this;
    }

    /**
     * Retrieve paste object
     * 
     * @return Paste
     */
    protected function _getPaste()
    {
        if (null === $this->_paste) {
            $this->_paste = new Paste;
        }
        return $this->_paste;
    }
}
