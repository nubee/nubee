<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProjectTable extends Doctrine_Table
{
  public function construct()
  {
    $this->setOption('orderBy', 'name ASC');
  }
  
  public function findByProductQuery($product) {
    $q = $this->createQuery('p')
      ->where('p.product_id = ?', $product->getId());
    return $q;
  }

  public function findMostActive($limit) {
    $q = Doctrine_Query::create()
      ->select('p.*')
      ->addSelect('(SELECT count(*) FROM Task t1 WHERE t1.story_id = s.id) as count_tasks')
      ->addSelect('(SELECT count(*) FROM Story s1 WHERE s1.iteration_id = i.id) as count_stories')
      ->addSelect('(SELECT count(*) FROM Iteration i1 WHERE i1.project_id = p.id) as count_iterations')
      ->from('Project p')
      ->leftJoin('p.Iterations i')
      ->leftJoin('i.Stories s')
      ->where('(p.status = ?)', 'enabled')
      ->having('count_tasks > 0')
      ->orderBy('count_tasks DESC')
      ->addOrderBy('count_stories DESC')
      ->addOrderBy('count_iterations DESC');

    return $q->execute();
  }
  
  public function findMineUncomplete(sfGuardUser $user) {
    $q = Doctrine_Query::create()
      ->select('p.*')
      ->addSelect('(SELECT count(*) FROM Task t1 WHERE t1.story_id = s.id WHERE t1.status <> \'done\') as count_tasks')
      ->from('Project p')
      ->leftJoin('p.Iterations i')
      ->leftJoin('i.Stories s')
      ->leftJoin('p.Manager m')
      ->where('p.status = ?', 'enabled')
      ->andWhere('m.id = ?', $user->getId())
      ->having('count_tasks > 0');

    return $q->execute();
  }  
}