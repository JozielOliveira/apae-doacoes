<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CollectionModel extends CI_Model {

  var $table = "collection";

  public function getAllByAssociateId($associateId, $limit=null, $offset=null) {
    return $this->db
    ->get_where($this->table, ['id_associate'=>$associateId], $limit, $offset)
    ->result();
  }

  public function totalCountByAssociateId($associateId) {
    $this->db->where(['id_associate'=>$associateId]);
    return $this->db->count_all($this->table);
  }

  public function getAllByAssociateIdBetweenDate($associateId, $startDate, $endDate, $limit=null, $offset=null) {
    $this->db->where('duo_date_collection', $startDate);
    $this->db->where('duo_date_collection', $endDate);
    return $this->db->get_where($this->table, array('associate_id'=>$associateId), $limit, $offset)->result_array();
  }

  public function createCollections($associate) {
    $countFrequency = $this->FrequencyModel->getCountFrequencyByFrequencyId($associate->id_frequency);
    if ($countFrequency != null && $countFrequency != 0) {
      $collections = array();
      for ($i=0;$i<$countFrequency;$i++) {
        $duoDate = date('Y-m-d', strtotime($i. " months", strtotime($associate->duo_date)));
        var_dump($duoDate);
        $collection = (object) [
          'value_collection' => $associate->value_frequency,
          'duo_date_collection' => $duoDate,
          'id_associate' => $associate->id_associate
        ];
        array_push($collections, $collection);
      }
      $this->CollectionModel->saveBatch($collections);
    }
  }

  public function saveBatch($collections) {
    return $this->db->insert_batch($this->table, $collections);
  }

  public function update($collection) {
    $this->db->where('id_collection', $collection['id_collection']);
    return $this->db->update($this->table, $collection);
  }

  public function delete($collectionId) {
    $this->db->where('id_collection', $collectionId);
    return $this->db->delete($this->table);
  }

  public function deleteByAssociateId($associateId) {
    $this->db->where('id_associate', $associateId);
    return $this->db->delete($this->table);
  }

}
