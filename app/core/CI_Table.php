<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CI_Table extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->tbladminusers = 'tbladminusers';
        $this->tblcommonmaster = 'tblcommonmaster';

    }
}
?>