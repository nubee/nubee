<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TaskTable extends Doctrine_Table
{
  public function construct()
  {
    $this->setOption('orderBy', 'status ASC and priority ASC');
  }

  public function findByProduct($product) {
    $q = $this->createQuery('t')
      ->leftJoin('t.Story s')
      ->leftJoin('s.Iteration i')
      ->leftJoin('i.Project p')
      ->where('p.product_id = ?', $product->getId());

    return $q->execute();
  }

  public function findByProject($project) {
    $q = $this->createQuery('t')
      ->leftJoin('t.Story s')
      ->leftJoin('s.Iteration i')
      ->where('i.project_id = ?', $project->getId());

    return $q->execute();
  }

  public function findByIteration($iteration) {
    $q = $this->createQuery('t')
      ->leftJoin('t.Story s')
      ->where('s.iteration_id = ?', $iteration->getId());

    return $q->execute();
  }

  public function findByStory($story) {
    $q = $this->createQuery('t')
      ->where('t.story_id = ?', $story->getId())
      ->orderBy('t.priority DESC');

    return $q->execute();
  }
}