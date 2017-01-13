<?php

class rtPlugins_View_Helper_Categories extends Zend_View_Helper_Abstract {

    public function Categories() {
        return self::getCategories(Application_Model_Categories::getList());
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

}

?>
