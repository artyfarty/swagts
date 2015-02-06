<?php
/**
 * @author artyfarty
 */

namespace SwagTSTests\TestClasses;

/**
 * @SWG\Model(id="SimpleClass")
 */
class SimpleClass {
    /**
     * @SWG\Property(name="int_prop",type="integer")
     */
    public $int_prop;

    /**
     * @SWG\Property(name="float_prop",type="float")
     */
    public $float_prop;

    /**
     * @SWG\Property(name="string_prop",type="string")
     */
    public $string_prop;

    /**
     * @SWG\Property(name="bool_prop",type="boolean")
     */
    public $bool_prop;


    /**
     * @SWG\Property(name="cls_prop",type="SubClass")
     */
    public $cls_prop;

    /**
     * @SWG\Property(name="comment_prop",type="integer",description="comment")
     */
    public $comment_prop;

    /**
     * @SWG\Property(name="ml_comment_prop",type="integer",description="comment
       multiline")
     */
    public $ml_comment_prop;

    /**
     * @SWG\Property(name="untyped_array",type="array")
     */
    public $untyped_array;

    /**
     * @SWG\Property(name="str_array",type="array",@SWG\Items(type="string"))
     */
    public $str_array;

    /**
     * @SWG\Property(name="cls_array",type="array",@SWG\Items(type="SubClass"))
     */
    public $cls_array;
}