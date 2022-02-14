<?php
namespace App\Libraries;

class Paginator
{
    protected int $limit = 10;
    protected int $offsetRecord;
    //for data beyond 10 page set limit 10 below code
    protected $pageBreak=10;
    protected $pageCount;
    protected $pageNumber = array();
    protected $recordCount;
    protected $page_url;
    protected $currentPage;
    protected $groupData;
    protected $prefix_url = 'page_';
    protected $queryString = null;

    function __construct(int $limit,string $page_url,string $groupData)
    {
        $this->limit = $limit;
        $this->page_url = $page_url;
        $this->groupData = $groupData;
    }

    public function get_page_break()
    {
        return $this->pageBreak;
    }

    public function set_query_string(string $queryName, string $queryString)
    {
        $this->queryString = array(
            'name'=>$queryName,
            'string'=>$queryString
        );
    }

    public function get_query_string()
    {
        return $this->queryString;
    }

    public function set_page_number($currentPage)
    {
        if(is_null($currentPage)) {
            $this->currentPage=1;
            $currentPage = 1;
        } else {
            $this->currentPage = $currentPage;            
        }
        $this->pageCount = ceil($this->recordCount / $this->limit);
        for($i=1;$i<=$this->pageCount;$i++) {
            $temp['active'] = ($currentPage==$i) ? true: false;
            $temp['title'] = $i;
            if(is_null($this->queryString)) {
                $temp['uri'] = $this->page_url.'?'.$this->prefix_url.$this->groupData.'='.$i;
            } else
            {
                $temp['uri'] = $this->page_url.'?'.$this->prefix_url.$this->groupData.'='.$i.'&'.$this->queryString['name'].'='.$this->queryString['string'];
            }
            array_push($this->pageNumber,$temp);
        }  
    }

    public function set_limit(int $limit)
    {
        $this->limit = $limit;
    }

    public function get_limit()
    {
        return $this->limit;
    }

    public function set_record_count(int $recordCount)
    {
        $this->recordCount = $recordCount;
    }

    public function get_record_count()
    {
        return $this->recordCount;
    }

    public function set_offset_record(int $offsetRecord)
    {
        $this->offsetRecord = $offsetRecord;
    }

    public function has_next_page()
    {
        if($this->currentPage>=$this->pageCount) {
            return false;
        }
        return true;
    }

    public function get_last_page()
    {
        if(is_null($this->queryString)) {
            return $this->page_url.'?'.$this->prefix_url.$this->groupData.'='.$this->pageCount;
        }
        return $this->page_url.'?'.$this->prefix_url.$this->groupData.'='.$this->pageCount.'&'.$this->queryString['name'].'='.$this->queryString['string'];
    }

    public function get_next_page()
    {
        if(is_null($this->queryString)) {
            return $this->page_url.'?'.$this->prefix_url.$this->groupData.'='.($this->currentPage+1);
        }
        return $this->page_url.'?'.$this->prefix_url.$this->groupData.'='.($this->currentPage+1).'&'.$this->queryString['name'].'='.$this->queryString['string'];
    }

    public function has_previous_page()
    {
        if($this->currentPage<=1) {
            return false;
        }
        return true;
    }

    public function get_first_page()
    {
        if(is_null($this->queryString)) {
            return $this->page_url.'?'.$this->prefix_url.$this->groupData.'=1';    
        }
        return $this->page_url.'?'.$this->prefix_url.$this->groupData.'=1'.'&'.$this->queryString['name'].'='.$this->queryString['string'];
    }

    public function get_previous_page()
    {
        if(is_null($this->queryString)) {
            return $this->page_url.'?'.$this->prefix_url.$this->groupData.'='.($this->currentPage-1);
        }
        return $this->page_url.'?'.$this->prefix_url.$this->groupData.'='.($this->currentPage-1).'&'.$this->queryString['name'].'='.$this->queryString['string'];
    }

    public function links()
    {
        return array_slice($this->pageNumber,$this->currentPage-1,$this->pageBreak);
    }

    public function get_first_index()
    {
        if (is_null($this->currentPage)) {
            return 1;
        }
        else if($this->currentPage===1) {
            return 1;
        } else {
            return 1 + ($this->limit * ($this->currentPage - 1));
        }
    }

    public function get_offset_record(int $page_number=null)
    {
        // (page_number-1) * limit;
        if(is_null($page_number)) {
            return 0;
        } else if($page_number===1) {
            return 0;
        } 
		else if($page_number===2) {
            $this->set_offset_record($this->limit);
            return $this->limit;
        }
        $offset = ($page_number-1)*$this->limit;
		// $offset = $page_number*$this->limit;
        $this->set_offset_record($offset);
        return $offset;
    }
}