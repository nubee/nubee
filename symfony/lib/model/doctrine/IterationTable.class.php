<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class IterationTable extends Doctrine_Table
{
  public function findByProduct(Product $product) {
    $q = $this->createQuery('i')
      ->leftJoin('i.Project p')
      ->where('p.product_id = ?', $product->getId());

    return $q->execute();
  }

  public function findByProjectQuery(Project $project) {
    $q = $this->createQuery('i')
      ->where('i.project_id = ?', $project->getId());
    return $q;
  }
 
}