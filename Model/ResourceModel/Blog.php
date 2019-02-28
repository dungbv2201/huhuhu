<?php
/**
 * Created by PhpStorm.
 * User: vandung
 * Date: 27/02/2019
 * Time: 11:43
 */

namespace Dung\Blog\Model\ResourceModel;


use Magento\Framework\App\ObjectManager;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;



/**
 * Class Blog
 * @package Dungbv\Blog\Model\ResourceModel
 */
class Blog extends AbstractDb
{
    public function _construct()
    {
        $this->_init('blog','id');
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return AbstractDb|void
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $image = $object->getData('image');
        if($image != null){
            $imageUpload = ObjectManager::getInstance()->create('Dung\Virtual\Blog\Model\ImageUploader');
            $imageUpload->moveFileFromTmp($image);
        }
    }
}