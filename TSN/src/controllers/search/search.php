<?php

namespace TSN\src\controllers\search;

require_once("./src/models/search.php");
use TSN\src\models\search\Search as ModelSearch;


class Search {

    private ModelSearch $search;

    public function getSearchPage($research){

        $this->getSearchResult($research);
        require('./src/views/search.php');
    }

    public function getSearchResult($research){

        $this->search = new ModelSearch;
        $this->search->makeSearch($research);
    }
}