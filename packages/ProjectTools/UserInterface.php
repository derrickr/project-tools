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
interface UserInterface {
    public function getList($input);
    public function create($inputs);
    public function getById($id);
    public function update($id,$inputs=null); 
    public function searchField();
}
