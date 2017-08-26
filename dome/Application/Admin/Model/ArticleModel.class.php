<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class ArticleModel extends RelationModel{
    /**
     * 对于表单提交过来的数据进行自动验
	 * 关联表
	 * @var array
	 */
    protected $_link = array(
    	'Sort' => array(
    		'mapping_type'  => self::BELONGS_TO, // 关联属性 BELONGS_TO 一对多
    		'class_name'    => 'Sort',    		 // 关联属性 要关联的类名
    		'foreign_key'   => 'sort_id',    	 // 分类外键
    		'as_fields'     => 'sort_name',		 // 需要的关联的字段
		),
        // 'Label' => array(
        //     'mapping_type'      =>  self::MANY_TO_MANY,     //多对多属性
        //     'class_name'        =>  'Label',                //关联表
        //     'mapping_name'      =>  'art_label',            //新字段名称
        //     'relation_table'    =>  'blog_article_label',   //中间表名称  
        // )
    );




}
