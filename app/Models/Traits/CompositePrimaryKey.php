<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CompositePrimaryKey {
    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getIncrementing()
    {
        return false;
    }
    
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }
    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
    /**
   * Perform the actual delete query on this model instance.
   *
   * @return void
   */
  protected function runSoftDelete()
  {
    $query = $this->newQueryWithoutScopes()->where($this->getKeyName()[0], $this->attributes[$this->getKeyName()[0]])
    ->where($this->getKeyName()[1], $this->attributes[$this->getKeyName()[1]]);
    $time = $this->freshTimestamp();
    $columns = [$this->getDeletedAtColumn() => $this->fromDateTime($time)];
    $this->{$this->getDeletedAtColumn()} = $time;
    if ($this->timestamps && ! is_null($this->getUpdatedAtColumn())) {
      $this->{$this->getUpdatedAtColumn()} = $time;

      $columns[$this->getUpdatedAtColumn()] = $this->fromDateTime($time);
    }
    $query->update($columns);
  }

}

?>