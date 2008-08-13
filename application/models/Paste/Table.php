<?php
/**
 * Table data gateway for paste table
 * 
 * @uses    Zend_Db_Table_Abstract
 * @package Paste
 * @license New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version $Id: $
 */
class Paste_Table extends Zend_Db_Table_Abstract
{
    /**
     * @var string Table name
     */
    protected $_name    = 'paste';

    /**
     * @var string Primary key
     */
    protected $_primary = 'id';

    /**
     * Insert
     *
     * Calculates a unique ID and commits the new data
     * 
     * @param  array $data 
     * @return string
     */
    public function insert(array $data)
    {
        $adapter = $this->getAdapter();
        $adapter->beginTransaction();
        do {
            $uniqId = uniqid();
            $select = $adapter->select()->from($this->_name, 'COUNT(*)')
                                        ->where('id = ?', $uniqId);
            $found = $adapter->fetchOne($select);
        } while ($found > 0);

        $data['id']      = $uniqId;
        $data['created'] = date('Y-m-d H:i:s');

        $created = strtotime($data['created']);

        if (array_key_exists('expires', $data) 
            && (is_int($data['expires']) || ($data['expires'] == intval($data['expires'])))
        ) {
            $expires = $data['expires'];
            if ((0 < $expires) && ($expires < $created)) {
                $data['expires'] = date('Y-m-d H:i:s', $created + $expires);
            }
        } elseif (array_key_exists('expires', $data) && is_string($data['expires'])) {
            $expires = strtotime($data['expires']);
            if ((0 < $expires) && ($expires < $created)) {
                unset($data['expires']);
            }
        } elseif (array_key_exists('expires', $data)) {
            unset($data['expires']);
        }

        parent::insert($data);

        $adapter->commit();

        return $uniqId;
    }

    /**
     * Do not allow updates
     * 
     * @param  array $data 
     * @param  mixed $where 
     * @return void
     * @throws Model_Exception
     */
    public function update(array $data, $where)
    {
        require_once dirname(__FILE__) . '/../Exception.php';
        throw new Model_Exception('Pastebin does not allow updates');
    }

    /**
     * Do not allow deletions
     * 
     * @param  mixed $where 
     * @return void
     * @throws Model_Exception
     */
    public function delete($where)
    {
        require_once dirname(__FILE__) . '/../Exception.php';
        throw new Model_Exception('Pastebin does not allow deletes');
    }
}
