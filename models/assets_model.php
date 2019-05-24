<?php

class Assets_Model extends Model {

    function __construct() {        
        parent::__construct();
    }

    function listAssets() {
        // this rubbish is basically for for the list view in the index screen!
        
        $sth = $this->db->prepare(
                'SELECT assets.id, assets.name, assets.notes, assets.assetnumber, '.
                'assets.notes, assets.man, assets.model, assettypes.name as type, '. 
                'assets.temp_status as status, assets.serial '.
                'FROM assets, assettypes '.
                'WHERE assets.typeid=assettypes.id');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }
    
    function getAssetDetails($id) {
        
        return Asset::getAssetFromID($id);
        
    }
}