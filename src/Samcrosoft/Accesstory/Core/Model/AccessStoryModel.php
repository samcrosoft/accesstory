<?php
/**
 * Created by PhpStorm.
 * User: Adebola
 * Date: 01/09/2014
 * Time: 10:19
 */

namespace Samcrosoft\Accesstory\Core\Model;

use Samcrosoft\Accesstory\Config\Reader;


/**
 * Class AccessStoryModel
 * @package Samcrosoft\Accesstory\Core\Model
 */
class AccessStoryModel extends \Eloquent {

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string
     */
    protected $table;


	/**
	 * @param array $attributes
	 */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes); 

        // set the table name
        $this->table = Reader::getTableName();
    }

}
