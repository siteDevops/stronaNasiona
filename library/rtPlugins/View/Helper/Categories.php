<?php

class rtPlugins_View_Helper_Categories extends Zend_View_Helper_Abstract {

    private $_activeCategory;

    public function Categories($type = "links", $active_category = NULL) {
        if(!is_null($active_category)){
            $this->_activeCategory = $active_category;
        }
        switch($type) {
            case 'links':
                return self::getCategories(Application_Model_Categories::getList());
                break;
            case 'select':
                return self::getCategoriesAsSelectOptions(Application_Model_Categories::getList());
                break;
        }
    }

    public function getCategories($categories, $parent = 0) {
        $html = '';
        foreach ($categories as $category) {
            if ($category->parent_id == $parent) {
                $subcategories = self::getCategories(Application_Model_Categories::getList(), $category->id);

                $subcatList = empty($subcategories) ? '' : '<div class="subcategories">' . $subcategories . '</div>';
                $arrow = empty($subcategories) ? '<span class="toggleList"></span>' : '<span class="fa fa-sort-down toggleList"></span>';

                $html.='<div class="category">'
                    . '<div class="titleCategory">'
                    . $arrow
                    . '<a href="/services/c/' . $category->id . '">'
                    . $category->name
                    . '</a>'
                    . '</div>'
                    . $subcatList
                    . '</div>';
            }
        }
        return $html;
    }

    public function getCategoriesAsSelectOptions($categories, $parent = 0, $indent="") {
        $html = '';
        foreach ($categories as $category) {
            if ($category->parent_id == $parent) {
                $subcategories = self::getCategoriesAsSelectOptions(Application_Model_Categories::getList(), $category->id, $indent."&nbsp;&nbsp;");

                $subcatList = empty($subcategories) ? '' : $subcategories;

                $selected = '';
                if($category->id == $this->_activeCategory){
                    $selected = 'selected';
                }

                $html.='<option value="'.$category->id.'" '.$selected.'>'
                    . $indent.' '.$category->name
                    . '</option>'
                    . $subcatList;
            }
        }
        return $html;
    }
}
?>