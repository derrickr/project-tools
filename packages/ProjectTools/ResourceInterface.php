<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ProjectTools;

/**
 *
 * @author kistha
 */
interface ResourceInterface {
    //put your code here
    public function getList($inputs);
    public function searchField();
    public function create($inputs);
    public function getById($id);
    public function update($id,$inputs=null);
}
