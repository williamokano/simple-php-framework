<?php

namespace App;

class Paginator
{
    private $data = array();
    private $qttItems = 0;
    private $itemsPerPage = 5;
    private $actualPage = 1;
    private $totalPages = 1;

    public function __construct(array $data, array $config = array())
    {
        $this->itemsPerPage = isset($config["itemsPerPage"]) && is_int($config["itemsPerPage"]) ? $config["itemsPerPage"] : $this->itemsPerPage;
        $this->actualPage = isset($config["actualPage"]) && is_int($config["actualPage"]) ? $config["actualPage"] : $this->actualPage;

        $this->setData($data);
    }

    public function setData(array $data)
    {
        $this->data = $data;
        $this->recalcPages();
    }

    public function setPage($page = 1)
    {
        if (!is_numeric($page) || intval($page) < 1)
            throw new \InvalidArgumentException("setPage requires a positive integer");

        //if (intval($page) <= $this->totalPages) {
        $this->actualPage = intval($page);
        $this->recalcPages();
        //}
    }

    public function setItemsPerPage($qttItemsPerPage = 1)
    {
        if (!is_numeric($qttItemsPerPage) || intval($qttItemsPerPage) < 1)
            throw new \InvalidArgumentException("setItemsPerPage requires a positive integer");
        $this->itemsPerPage = $qttItemsPerPage;
        $this->recalcPages();
    }

    private function recalcPages()
    {
        $this->qttItems = sizeof($this->data);
        if ($this->qttItems == 0) {
            $this->actualPage = 1;
            $this->totalPages = 1;
        } else {
            $this->totalPages = intval(ceil($this->qttItems / $this->itemsPerPage));
        }

    }

    public function getPaginatedData()
    {
        return array_slice($this->data, ($this->actualPage - 1) * $this->itemsPerPage, $this->itemsPerPage);
    }

    public function paginate($url = "")
    {
        if ($this->totalPages == 1)
            return "";
            
        $doc = new \DOMDocument();

        $paginationList = $doc->createElement("ul");
        $paginationList->setAttribute("class", "pagination");

        //Create previous page node
        $prevItemList = $doc->createElement("li");

        $prevItem = $doc->createElement("a");
        $prevItem->nodeValue = "«";

        if ($this->actualPage == 1) {
            $prevItemList->setAttribute("class", "disabled");
            $prevItem->setAttribute("href", "#");
        } else {
            $prevItem->setAttribute("href", sprintf($url, ($this->actualPage - 1)));
        }

        $prevItemList->appendChild($prevItem);
        $paginationList->appendChild($prevItemList);

        for ($i = 1; $i <= $this->totalPages; $i++) {
            $listItem = $doc->createElement("li");

            $item = $doc->createElement("a");
            $item->setAttribute("href", sprintf($url, $i));
            $item->nodeValue = $i;

            if ($i == $this->actualPage)
                $listItem->setAttribute("class", "active");

            $listItem->appendChild($item);
            $paginationList->appendChild($listItem);
        }

        //Create next item
        $nextListItem = $doc->createElement("li");

        $nextItem = $doc->createElement("a");
        $nextItem->nodeValue = "»";

        if ($this->actualPage == $this->totalPages) {
            $nextListItem->setAttribute("class", "disabled");
            $nextItem->setAttribute("href", "#");
        } else {
            $nextItem->setAttribute("href", sprintf($url, ($this->actualPage + 1)));
        }

        $nextListItem->appendChild($nextItem);
        $paginationList->appendChild($nextListItem);

        $doc->appendChild($paginationList);
        return $doc->saveHTML();
    }
}
