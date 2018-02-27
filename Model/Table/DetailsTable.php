<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Books Model
 *
 * @method \App\Model\Entity\Book get($primaryKey, $options = [])
 * @method \App\Model\Entity\Book newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Book[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Book|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Book patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Book[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Book findOrCreate($search, callable $callback = null, $options = [])
 */
class DetailsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('magazinedatas');
        
        $this->belongsTo("magaginegroups",[
            'bindingKey' => 'id', 
            'foreignKey' => 'magazinegroup_id',
            'joinType' => 'INNER'
        ]);
        /*
        $this->belongsTo('magazinetitles', [
            'bindingKey' => 'id', 
            'foreignKey' => 'magaginetitle_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('magazinedatas', [
            'bindingKey' => 'magazinetitle_id', 
            'foreignKey' => 'id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('categories', [
            'bindingKey' => 'id', 
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
         * */
        
        $this->belongsTo('users', [
            'bindingKey' => 'id', 
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);
        
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        
        
        $validator
            ->scalar('title')
            ->requirePresence('title')
            ->notEmpty('title');

        return $validator;
    }
}
